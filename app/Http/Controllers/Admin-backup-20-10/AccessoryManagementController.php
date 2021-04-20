<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccessoryModel;
use App\Models\AgentModel;
use App\Common\Services\MailService;
use App\Common\Traits\MultiActionTrait;

use DataTables;
use Validator;
use Session;

class AccessoryManagementController extends Controller
{
    use MultiActionTrait;

    function __construct(MailService $mail_service)
    {
		$this->arr_view_data                = [];
		$this->admin_panel_slug             = config('app.project.admin_panel_slug');
		$this->admin_url_path               = url(config('app.project.admin_panel_slug'));
		$this->module_url_path              = $this->admin_url_path."/accessory";
		$this->module_title                 = "Accessory";
		$this->module_view_folder           = "admin.accessory";
		$this->module_icon                  = "fa fa-user";
		$this->auth                         = auth()->guard('admin');
		$this->BaseModel					= new AccessoryModel();
		$this->AgentModel 					= new AgentModel();

		$this->accessory_image_base_img_path   = base_path().config('app.project.img_path.accessory_image');
		$this->accessory_image_public_img_path = url('/').config('app.project.img_path.accessory_image');
    }

	//accessory index     : AUTHOR (Akshay Ugale)
    public function index()
    {
		$arr_agent =[];
		$obj_agent 									=  $this->AgentModel
														   	->select('id','status','full_name')
															->where('status','=','1')->get();
		if($obj_agent)
		{
			$arr_agent = $obj_agent->toArray();
		}
		$this->arr_view_data['page_title']          		= "Manage ".$this->module_title;
        $this->arr_view_data['parent_module_icon']  		= "fa fa-home";
        $this->arr_view_data['parent_module_title'] 		= "Dashboard";
        $this->arr_view_data['parent_module_url']  	 		= url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']         		= $this->module_icon;
        $this->arr_view_data['module_title']        		= "Manage ".$this->module_title;
		$this->arr_view_data['module_url_path']     		= $this->module_url_path;
		$this->arr_view_data['admin_url_path']      		= $this->admin_url_path;
		$this->arr_view_data['admin_panel_slug']    		= $this->admin_panel_slug;
		$this->arr_view_data['arr_agent']    				= $arr_agent;
		$this->arr_view_data['accessory_image_base_path']	= $this->accessory_image_base_img_path;
		$this->arr_view_data['accessory_image_public_path']	= $this->accessory_image_public_img_path;
		return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

	//load accessory data      : AUTHOR (Akshay Ugale)
    public function load_data(Request $request)
	{	
		$build_status_btn       = '';
		$arr_data               = [];
		$arr_search_column     	= $request->input('column_filter');

		$obj_request_data = $this->BaseModel->with('get_agent_detail')/*->orderBy('created_at','DESC')*/;

		$obj_request_data = $obj_request_data->get();

		$json_result 	= DataTables::of($obj_request_data)->make(true);
		$build_result 	= $json_result->getData();

		if(isset($build_result->data) && sizeof($build_result->data)>0)
		{
			foreach ($build_result->data as $key => $data) 
			{
				$view_link_url    		= "javascript:void(0)";
				$built_delete_href 		= $this->module_url_path.'/delete/'.base64_encode($data->id);
				if($data->status != null && $data->status == "0")
				{
					$build_status_btn = '<a  href="'.$this->module_url_path.'/unblock/'.base64_encode($data->id).'" onclick="return confirm_action(this,event,\'Do you really want to activate this Accessory ?\')"><i class="fa fa-eye" title="Blocked"></i></a>&nbsp&nbsp&nbsp ';
				}
				elseif($data->status != null && $data->status == "1")
				{
					$build_status_btn = '<a  href="'.$this->module_url_path.'/block/'.base64_encode($data->id).'" onclick="return confirm_action(this,event,\'Do you really want to inactivate this Accessory ?\')"><i class="fa fa-eye-slash" title="Active"></i></a> &nbsp&nbsp&nbsp';
				}
				// dd($build_status_btn);
				$build_edit_button 		= '<a  title="" href="javascript:void(0)"  data-id="'.$data->id.'"  id="open_edit_accessory_modal"><i class="fa fa-cog" title="Edit"></i></a>&nbsp&nbsp&nbsp';
				$bulit_delete_button 	=' <a href='.$built_delete_href.'  title="delete" onclick="return confirm_action(this,event,\'Do you really want to delete this Accessory ?\')"><i class="fa fa-trash"></i></a>';
				$action_button_html 	 = $build_edit_button.$build_status_btn.$bulit_delete_button;
				
				$category_id  	= str_pad(isset($data->id)? $data->id:'000', 3, '0', STR_PAD_LEFT);
				$english_name 	= isset($data->english_name)? $data->english_name :'';
				$arabic_name 	= isset($data->arabic_name)? $data->arabic_name :'';
				$accessory_owner= isset($data->get_agent_detail->full_name)? $data->get_agent_detail->full_name :'';
				$weight 		= isset($data->weight)? $data->weight :'';
				$cost 			= isset($data->cost)? $data->cost :'';
				$margin 		= isset($data->margin)? $data->margin :'';
				$selling 		= isset($data->selling)? $data->selling :'';
				$id 	    	= isset($data->id)? base64_encode($data->id):'';
				$status 		= isset($data->status)? $data->status :'-';
				if($status==1)
				{
					$status = 'Live';
				}
				else
				{
					$status = 'Hidden';
				}
				$i = $key+1;
				$build_result->data[$key]->id         		    = $category_id;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->category_id          = $category_id;
				$build_result->data[$key]->english_name         = $english_name;
				$build_result->data[$key]->arabic_name         	= $arabic_name;
				$build_result->data[$key]->accessory_owner     	= $accessory_owner;
				$build_result->data[$key]->weight         		= $weight;
				$build_result->data[$key]->cost         		= $cost;
				$build_result->data[$key]->margin         		= $margin;
				$build_result->data[$key]->selling         		= $selling;
				$build_result->data[$key]->status        		= $status;
				$build_result->data[$key]->built_action_btns    = $action_button_html;
				
			}
			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
	}
	//store new accessory      : AUTHOR (Akshay Ugale)
	public function store(Request $request)
    {
    	$arr_rules      = $arr_data = $arr_cat = array();
		$status         = false;

		$arr_rules['en_name']      	   	= "required";
		$arr_rules['ar_name']      	   	= "required";
		$arr_rules['accessory_owner']   = "required";
		$arr_rules['weight']      	   	= "required|numeric";
		$arr_rules['cost']      	   	= "required|numeric";
		$arr_rules['margin']      	   	= "required|numeric";
		$arr_rules['selling']      	   	= "required|numeric";

		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$arr_data['english_name']    		=   $request->input('en_name', null);	
		$arr_data['arabic_name']    		=   $request->input('ar_name', null);	
		$arr_data['accessory_owner']    	=   $request->input('accessory_owner', null);	
		$arr_data['weight']    				=   $request->input('weight', null);	
		$arr_data['cost']    				=   $request->input('cost', null);	
		$arr_data['selling']    			=   $request->input('selling', null);	
		$arr_data['margin']    				=   $request->input('margin', null);	
		$arr_data['status']					=	'1';

		if($request->hasFile('add_accessory_image'))
		{
			$file_extension = strtolower($request->file('add_accessory_image')->getClientOriginalExtension());

			if(in_array($file_extension,['png','jpg','jpeg']))
			{
				$file     = $request->file('add_accessory_image');
				$filename = sha1(uniqid().uniqid()) . '.' . $file->getClientOriginalExtension();
				$path     = $this->accessory_image_base_img_path . $filename;
				$isUpload = $file->move($this->accessory_image_base_img_path , $filename);
				if($isUpload)
				{
					$arr_data['accessory_image'] = $filename;
				}
			}
			else
			{
				Session::flash('error','Invalid File type, While adding accessory.');
				return redirect()->back();
			}
		}
		// dd($arr_data);
		$create  	= $this->BaseModel->create($arr_data);
		if($create)
		{
			Session::flash('success', 'Accessory added successfully.');
			return redirect($this->module_url_path);
		}
		else
		{
			Session::flash('error', 'Error while adding Accessory ..');
			return redirect($this->module_url_path);
		}
	}
	
	//view accessory     : AUTHOR (Akshay Ugale)
	public function view($id)
    {
    	$enc_id = base64_decode($id);

    	$arr_data = [];
    	$obj_data = $this->BaseModel->where('id',$enc_id)->first();

    	if($obj_data){
    		$arr_data = $obj_data->toArray();
		}
    	if($arr_data){
			$arr_resp['status']  	= 'success';
			$arr_resp['data'] 		= $arr_data;
		}else{
			$arr_resp['status'] 	= 'error';
			$arr_resp['data'] 		= $arr_data;
		}

		return $arr_resp;
	}
	//edit accessory     : AUTHOR (Akshay Ugale)
	public function edit($id)
    {
    	$enc_id = base64_decode($id);

    	$arr_data = [];
    	$obj_data = $this->BaseModel->where('id',$enc_id)->first();

    	if($obj_data){
    		$arr_data = $obj_data->toArray();
		}
    	if($arr_data){
			$arr_resp['status']  	= 'success';
			$arr_resp['data'] 		= $arr_data;
		}else{
			$arr_resp['status'] 	= 'error';
			$arr_resp['data'] 		= $arr_data;
		}

		return $arr_resp;
	}
	
	//update accessory     : AUTHOR (Akshay Ugale)
	public function update(Request $request)
	{
		$enc_id = base64_decode($request->input('enc_id'));
		$arr_rules      = $arr_data = array();
		$status         = false;

		$arr_rules['edit_ar_name']      	   	= "required";
		$arr_rules['edit_en_name']      	   	= "required";
		$arr_rules['edit_accessory_owner']    	= "required";
		$arr_rules['edit_weight']      	   		= "required";
		$arr_rules['edit_cost']      	   		= "required";
		$arr_rules['edit_margin']      	   		= "required";
		$arr_rules['edit_selling']      	   	= "required";

		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}
		$arr_data['english_name']    		=   $request->input('edit_ar_name', null);	
		$arr_data['arabic_name']    		=   $request->input('edit_en_name', null);

		$arr_data['accessory_owner']    	=   $request->input('edit_accessory_owner', null);	
		$arr_data['weight']    				=   $request->input('edit_weight', null);	
		$arr_data['cost']    				=   $request->input('edit_cost', null);	
		$arr_data['selling']    			=   $request->input('edit_selling', null);	
		$arr_data['margin']    				=   $request->input('edit_margin', null);
	
		if($request->hasFile('edit_accessory_image'))
		{
			$file_extension = strtolower($request->file('edit_accessory_image')->getClientOriginalExtension());

			if(in_array($file_extension,['png','jpg','jpeg']))
			{
				$file     = $request->file('edit_accessory_image');
				$filename = sha1(uniqid().uniqid()) . '.' . $file->getClientOriginalExtension();
				$path     = $this->accessory_image_base_img_path . $filename;
				$isUpload = $file->move($this->accessory_image_base_img_path , $filename);
				if($isUpload)
				{

					$arr_data_edit = [];
					$obj_data = $this->BaseModel->where('id',$enc_id)->first();

					if($obj_data){
						$arr_data_edit = $obj_data->toArray();
					}
					if($arr_data_edit['accessory_image']!=null && file_exists($this->accessory_image_base_img_path."/".$arr_data_edit['accessory_image']))
					{
						unlink($this->accessory_image_base_img_path.$arr_data_edit['accessory_image']);
						// dd($arr_data_edit['accessory_image']);
					}

					$arr_data['accessory_image'] = $filename;
				}
			}
			else
			{
				Session::flash('error','Invalid File type, While adding accessory.');
				return redirect()->back();
			}
		}

		$status = $this->BaseModel->where('id',$enc_id)->update($arr_data);

		if($status)
		{
			Session::flash('success', 'Accessory Updated successfully.');
			return redirect($this->module_url_path);
		}

		Session::flash('error', 'Error while Updating Accessory.');
		return redirect($this->module_url_path);
	}

	//check english  accessory exist or not     : AUTHOR (Akshay Ugale)
	public function check_en_accessory(Request $request)
    {
    	$en_accessory = $request->input('en_accessory');

		$obj_cat = $this->BaseModel->where('english_name',$en_accessory)->first();

		if($obj_cat){
			$arr_resp['status']  	= 'error';
		}
		else{
			$arr_resp['status'] 	= 'success';
		}
		return $arr_resp;
	}

	//check  arabic accessory exist or not     : AUTHOR (Akshay Ugale)
	public function check_ar_accessory(Request $request)
    {
    	$ar_accessory = $request->input('ar_accessory');

		$obj_cat = $this->BaseModel->where('arabic_name',$ar_accessory)->first();

		if($obj_cat){
			$arr_resp['status']  	= 'error';
		}
		else{
			$arr_resp['status'] 	= 'success';
		}
		return $arr_resp;
	}
}
