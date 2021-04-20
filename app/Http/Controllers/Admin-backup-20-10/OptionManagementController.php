<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OptionModel;
use App\Models\SubOptionModel;
use App\Common\Services\MailService;
use App\Common\Traits\MultiActionTrait;

use DataTables;
use Validator;
use Session;

class OptionManagementController extends Controller
{
    use MultiActionTrait;

    function __construct(MailService $mail_service)
    {
		$this->arr_view_data                = [];
		$this->admin_panel_slug             = config('app.project.admin_panel_slug');
		$this->admin_url_path               = url(config('app.project.admin_panel_slug'));
		$this->module_url_path              = $this->admin_url_path."/option";
		$this->module_title                 = "Option";
		$this->module_view_folder           = "admin.option";
		$this->module_icon                  = "fa fa-user";
		$this->auth                         = auth()->guard('admin');
		$this->BaseModel					= new OptionModel();
		$this->SubOptionModel				= new SubOptionModel();
    }

	//Option index     : AUTHOR (Akshay Ugale)
    public function index()
    {
    	$obj_user = $this->BaseModel->get();

		$this->arr_view_data['page_title']          = "Manage ".$this->module_title;
        $this->arr_view_data['parent_module_icon']  = "fa fa-home";
        $this->arr_view_data['parent_module_title'] = "Dashboard";
        $this->arr_view_data['parent_module_url']   = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']         = $this->module_icon;
        $this->arr_view_data['module_title']        = "Manage ".$this->module_title;
		$this->arr_view_data['module_url_path']     = $this->module_url_path;
		$this->arr_view_data['admin_url_path']      = $this->admin_url_path;
		$this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;
		$this->arr_view_data['count'] 				= count($obj_user);
		
		return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

	//Load option data on ajax call      : AUTHOR (Akshay Ugale)
    public function load_data(Request $request)
	{	
		$build_status_btn       = '';
		$arr_data               = [];

		$obj_request_data = $this->BaseModel/*->orderBy('created_at','DESC')*/;

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
					$build_status_btn = '<a  href="'.$this->module_url_path.'/unblock/'.base64_encode($data->id).'" onclick="return confirm_action(this,event,\'Do you really want to activate this Option ?\')"><i class="fa fa-eye-slash" title="Blocked"></i></a>&nbsp&nbsp&nbsp ';
				}
				elseif($data->status != null && $data->status == "1")
				{
					$build_status_btn = '<a  href="'.$this->module_url_path.'/block/'.base64_encode($data->id).'" onclick="return confirm_action(this,event,\'Do you really want to inactivate this Option ?\')"><i class="fa fa-eye" title="Active"></i></a> &nbsp&nbsp&nbsp';
				}
				$build_edit_button 		= '<a  title="" href="javascript:void(0)"  data-id="'.$data->id.'"  id="open_edit_option_modal"><i class="fa fa-pencil" title="Edit"> Edit option</i></a>&nbsp&nbsp&nbsp';
				
				$build_sub_option_button 	= '<a  href="'.$this->module_url_path.'/suboption/'.base64_encode($data->id).'" ><i class="fa fa-cog" title="Manage Sub-Option"> Manage Sub-Option</i></a> ';
				
                $action_setting_button_html  = '<li class="dropdown">';
                $action_setting_button_html .= '<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-cog"></i><span></span></a>';
                $action_setting_button_html .= '<ul class="action-drop-section dropdown-menu dropdown-menu-right">';
                $action_setting_button_html .= '<li style="height: 35px;">'.$build_edit_button.'</li>';
                $action_setting_button_html .= '<li style="height: 35px;">'.$build_sub_option_button.'</li>';
				$action_setting_button_html .= '</ul>&nbsp&nbsp&nbsp';
				// $action_setting_button_html .= $build_status_btn;
				$action_setting_button_html .= '<a href='.$built_delete_href.'  title="delete" onclick="return confirm_action(this,event,\'Do you really want to delete this Option ?\')"><i class="fa fa-trash"></i></a>';
                $action_setting_button_html .= '</li>';

				$action_button_html 	 = $action_setting_button_html;
				
				$option_id  	= str_pad(isset($data->id)? $data->id :'000', 3, '0', STR_PAD_LEFT);
				$english_name 	= isset($data->english_name)? $data->english_name :'';
				$arabic_name 	= isset($data->arabic_name)? $data->arabic_name :'';
				$id 	    	= isset($data->id)? base64_encode($data->id):'';
				$status 		= isset($data->status)? $data->status :'-';
				if($status==1){
					$status = 'Active';
				}else{
					$status = 'Blocked';
				}
				$i = $key+1;
				$build_result->data[$key]->id         		    = $id;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->option_id            = $option_id;
				$build_result->data[$key]->english_name         = $english_name;
				$build_result->data[$key]->arabic_name         	= $arabic_name;
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
	//store new option     : AUTHOR (Akshay Ugale)
	public function store_option(Request $request)
    {
    	$arr_rules      = $arr_data = $arr_cat = array();
		$status         = false;

		$arr_rules['en_name']      	   	= "required";
		$arr_rules['ar_name']      	   	= "required";

		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}
		$arr_data['english_name']    		=   $request->input('en_name', null);	
		$arr_data['arabic_name']    		=   $request->input('ar_name', null);	
		$arr_data['status']					=	'1';

		$create  	= $this->BaseModel->create($arr_data);
		if($create)
		{
			Session::flash('success', 'Option created successfully.');
			return redirect($this->module_url_path);
		}
		else
		{
			Session::flash('error', 'Error while creating Option.');
			return redirect($this->module_url_path);
		}
	}
	
	//Load view option data on ajax call      : AUTHOR (Akshay Ugale)
	public function view($id)
    {
    	$enc_id = base64_decode($id);

    	$arr_data = [];
    	$obj_data = $this->BaseModel->where('id',$enc_id)->first();

    	if($obj_data){
    		$arr_data = $obj_data->toArray();
		}
		// dd($arr_data);
    	if($arr_data){
			$arr_resp['status']  	= 'success';
			$arr_resp['data'] 		= $arr_data;
		}else{
			$arr_resp['status'] 	= 'error';
			$arr_resp['data'] 		= $arr_data;
		}

		return $arr_resp;
	}
	//edit data on ajax call      : AUTHOR (Akshay Ugale)
	public function edit($id)
    {
    	$enc_id = base64_decode($id);

    	$arr_data = [];
    	$obj_data = $this->BaseModel->where('id',$enc_id)->first();

    	if($obj_data){
    		$arr_data = $obj_data->toArray();
		}
		// dd($arr_data);
    	if($arr_data){
			$arr_resp['status']  	= 'success';
			$arr_resp['data'] 		= $arr_data;
		}else{
			$arr_resp['status'] 	= 'error';
			$arr_resp['data'] 		= $arr_data;
		}

		return $arr_resp;
	}
	//update Option     : AUTHOR (Akshay Ugale)
	public function update(Request $request)
	{
		// dd($request->all());
		$enc_id = base64_decode($request->input('enc_id'));

		$arr_rules      = $arr_data = array();
		$status         = false;

		$arr_rules['edit_english_name']      	   	= "required";
		$arr_rules['edit_arabic_name']      	   	= "required";

		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}
		$arr_data['english_name']    		=   $request->input('edit_english_name', null);	
		$arr_data['arabic_name']    		=   $request->input('edit_arabic_name', null);

		$status = $this->BaseModel->where('id',$enc_id)->update($arr_data);

		if($status)
		{
			Session::flash('success', 'Category Updated successfully.');
			return redirect($this->module_url_path);
		}

		Session::flash('error', 'Error while Updating category.');
		return redirect($this->module_url_path);
	}

	//check english Option exist or not      : AUTHOR (Akshay Ugale)
	public function en_option_check(Request $request)
    {
		// dd('heer');
    	$en_option = $request->input('en_option');

		$obj_cat = $this->BaseModel->where('english_name',$en_option)->first();

		if($obj_cat)
		{
			$arr_resp['status']  	= 'error';
		}
		else
		{
			$arr_resp['status'] 	= 'success';
		}
		return $arr_resp;
	}
	//check arabic Option exist or not      : AUTHOR (Akshay Ugale)
	public function ar_option_check(Request $request)
    {
    	$ar_option = $request->input('ar_option');

		$obj_cat = $this->BaseModel->where('arabic_name',$ar_option)->first();

		if($obj_cat)
		{
			$arr_resp['status']  	= 'error';
		}
		else
		{
			$arr_resp['status'] 	= 'success';
		}
		return $arr_resp;
	}




	//SubOption Management   : AUTHOR (Akshay Ugale)

	//sub-option  index     : AUTHOR (Akshay Ugale)
	public function sub_option_index($id)
    {
		$arr_data = array();
		$enc_id 	= base64_decode($id);
		session(['session_option_id'      => $enc_id]);
		$obj_cat = $this->BaseModel->where('id','=',session('session_option_id'))->first();
		if($obj_cat)
		{
			$arr_data =  $obj_cat->toArray();
		}
		if($arr_data==null)
		{
			Session::flash('warning', 'Something went wrong.');
			return redirect($this->module_url_path);
		}
		$this->arr_view_data['page_title']          = "Manage ".$this->module_title;
        $this->arr_view_data['parent_module_icon']  = "fa fa-home";
        $this->arr_view_data['parent_module_title'] = "Dashboard";
        $this->arr_view_data['parent_module_url']   = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']         = $this->module_icon;
        $this->arr_view_data['module_title']        = "Manage ".$this->module_title;
		$this->arr_view_data['module_url_path']     = $this->module_url_path;
		$this->arr_view_data['admin_url_path']      = $this->admin_url_path;
		$this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;
		$this->arr_view_data['arr_data'] 			= $arr_data;
		return view($this->module_view_folder.'.sub_option_index',$this->arr_view_data);
	}

	//Load data on ajax call      : AUTHOR (Akshay Ugale)
	public function load_sub_option_data(Request $request)
	{	
		$build_status_btn       = '';
		$arr_data               = [];
		$arr_search_column     	= $request->input('column_filter');
		$option_id 				= $arr_search_column['option_id'];
		$obj_request_data = $this->SubOptionModel->where('option_id','=',$option_id)->with('get_option_detail')/*->orderBy('created_at','DESC')*/;

		if(isset($arr_search_column['english_name']) && $arr_search_column['english_name']!="")
		{
			$obj_request_data = $obj_request_data->where('english_name', 'LIKE',"%".$arr_search_column['english_name']."%");
		}

		if(isset($arr_search_column['arabic_name']) && $arr_search_column['arabic_name']!="")
		{
			$obj_request_data = $obj_request_data->where('arabic_name', 'LIKE',"%".$arr_search_column['arabic_name']."%");
		}

		if(isset($arr_search_column['status']) && $arr_search_column['status']!="")
		{
			$obj_request_data = $obj_request_data->where('status',$arr_search_column['status']);
		}

		$obj_request_data = $obj_request_data->get();

		$json_result 	= DataTables::of($obj_request_data)->make(true);
		$build_result 	= $json_result->getData();

		if(isset($build_result->data) && sizeof($build_result->data)>0)
		{
			foreach ($build_result->data as $key => $data) 
			{
				$view_link_url    		= "javascript:void(0)";
				$built_delete_href 		= $this->module_url_path.'/delete_sub_option/'.base64_encode($data->id);
				if($data->status != null && $data->status == "0")
				{
					$build_status_btn = '<a  href="'.$this->module_url_path.'/unblock_sub_option/'.base64_encode($data->id).'" 
					onclick="return confirm_action(this,event,\'Do you really want to activate this Sub-Option ?\')" ><i class="fa fa-eye-slash" title="Blocked"></i></a>&nbsp&nbsp&nbsp ';
				}
				elseif($data->status != null && $data->status == "1")
				{
					$build_status_btn = '<a  href="'.$this->module_url_path.'/block_sub_option/'.base64_encode($data->id).'" onclick="return confirm_action(this,event,\'Do you really want to inactivate this Sub-Option ?\')" ><i class="fa fa-eye" title="Active"></i></a> &nbsp&nbsp&nbsp';
				}
				$build_edit_button 			= '<a  title="" href="javascript:void(0)"  data-id="'.$data->id.'"  id="open_edit_sub_option_modal"><i class="fa fa-cog" title="Edit"></i></a>&nbsp&nbsp&nbsp';
				$action_button_html 	 	= $build_edit_button;
				// $action_button_html 	   .= $build_status_btn;
				$action_button_html 	   .= '<a href='.$built_delete_href.' title="Delete"  onclick="return confirm_action(this,event,\'Do you really want to delete this Sub-Option ?\')" ><i class="fa fa-trash"></i></a>';
				
				$english_name 				= isset($data->english_name)? $data->english_name :'';
				$arabic_name 				= isset($data->arabic_name)? $data->arabic_name :'';
				$id 	    				= isset($data->id)? base64_encode($data->id):'';
				$status 					= isset($data->status)? $data->status :'-';
				$Option_ID 					= str_pad(isset($data->get_option_detail->id)? $data->get_option_detail->id :'000', 3, '0', STR_PAD_LEFT);
				$Subopt_ID 					= str_pad(isset($data->id)? $data->id:'000', 3, '0', STR_PAD_LEFT);
				
				if($status==1){
					$status = 'Live';
				}else{
					$status = 'Hidden';
				} 
				$i = $key+1;
				$build_result->data[$key]->id         		    = $id;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->opt_subopt_ID        = $Option_ID.$Subopt_ID;
				$build_result->data[$key]->english_name         = $english_name;
				$build_result->data[$key]->arabic_name         	= $arabic_name;
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
	
	//store new sub-option      : AUTHOR (Akshay Ugale)
	public function store_sub_option(Request $request)
    {
    	$arr_rules      = $arr_data = $arr_cat = array();
		$status         = false;
		$cat_ID 		= '101';
		$Subcat_Id 		= '001'; 

		$arr_rules['en_name']      	   	= "required";
		$arr_rules['ar_name']      	   	= "required";

		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}
		$option_id 						=   $request->input('option_id', null);
		$arr_data['option_id']    				=   $option_id;	
		$arr_data['english_name']    		=   $request->input('en_name', null);	
		$arr_data['arabic_name']    		=   $request->input('ar_name', null);
		$arr_data['status']					=	'1';
		
		
		$create  	= $this->SubOptionModel->create($arr_data);
		if($create)
		{
			Session::flash('success', 'Sub-Option created successfully.');
			return redirect($this->module_url_path.'/suboption/'.base64_encode($option_id));
		}
		else
		{
			Session::flash('error', 'Error while creating Sub-Option ..');
			return redirect($this->module_url_path.'/suboption/'.base64_encode($option_id));
		}
	}
	
	//edit sub-option      : AUTHOR (Akshay Ugale)
	public function edit_sub_option($id)
    {
    	$enc_id = base64_decode($id);

    	$arr_data = [];
    	$obj_data = $this->SubOptionModel->where('id',$enc_id)->first();

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
	//update sub-option      : AUTHOR (Akshay Ugale)
	public function update_sub_option(Request $request)
	{
		$enc_id = base64_decode($request->input('enc_id'));

		$arr_rules      = $arr_data = array();
		$status         = false;

		$arr_rules['edit_english_name']      	   	= "required";
		$arr_rules['edit_arabic_name']      	   	= "required";

		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}
		$arr_data['english_name']    		=   $request->input('edit_english_name', null);	
		$arr_data['arabic_name']    		=   $request->input('edit_arabic_name', null);
		$status = $this->SubOptionModel->where('id',$enc_id)->update($arr_data);
		if($status)
		{
			Session::flash('success', 'Sub-Option Updated successfully.');
			if(session('session_option_id')!=null)
			{
				return redirect($this->module_url_path.'/suboption/'.base64_encode(session('session_option_id')));
			}
			return redirect($this->module_url_path);
		}
		Session::flash('error', 'Error while Updating Sub-Option.');
		if(session('session_option_id')!=null)
		{
			return redirect($this->module_url_path.'/suboption/'.base64_encode(session('session_option_id')));
		}
		return redirect($this->module_url_path);
	}

	//block sub-option      : AUTHOR (Akshay Ugale)
	public function block_sub_option($id)
    {
		$enc_id = base64_decode($id);
		$arr_data = array();
		
    	$arr_data['status']    		=   '0';

		$status = $this->SubOptionModel->where('id',$enc_id)->update($arr_data);

		if($status)
		{
			Session::flash('success', 'Sub-Option Inactivated successfully.');
			if(session('session_option_id')!=null)
			{
				return redirect($this->module_url_path.'/suboption/'.base64_encode(session('session_option_id')));
			}
			else
			{
				return redirect($this->module_url_path);
			}
			
		}
		Session::flash('success', 'Error while Inactivating Sub-Option.');
		if(session('session_option_id')!=null)
		{
			return redirect($this->module_url_path.'/suboption/'.base64_encode(session('session_option_id')));
		}
		else
		{
			return redirect($this->module_url_path);
		}
		
	}
	
	//unblock sub-option      : AUTHOR (Akshay Ugale)
	public function unblock_sub_option($id)
    {
		$enc_id = base64_decode($id);
		$arr_data = array();
		
    	$arr_data['status']    		=   '1';

		$status = $this->SubOptionModel->where('id',$enc_id)->update($arr_data);

		if($status)
		{
			Session::flash('success', 'Sub-Option activated successfully.');
			if(session('session_option_id')!=null)
			{
				return redirect($this->module_url_path.'/suboption/'.base64_encode(session('session_option_id')));
			}
			else
			{
				return redirect($this->module_url_path);
			}
			
		}
		Session::flash('success', 'Error while activating Sub-Option.');
		if(session('session_option_id')!=null)
		{
			return redirect($this->module_url_path.'/suboption/'.base64_encode(session('session_option_id')));
		}
		else
		{
			return redirect($this->module_url_path);
		}
	}
	
	//delete sub-option      : AUTHOR (Akshay Ugale)
	public function delete_sub_option($id)
    {
		$enc_id = base64_decode($id);

		$status = $this->SubOptionModel->where('id',$enc_id)->delete();
		
		if($status)
		{
			Session::flash('success', 'Sub-Option deleted successfully.');
			if(session('session_option_id')!=null)
			{
				return redirect($this->module_url_path.'/suboption/'.base64_encode(session('session_option_id')));
			}
			else
			{
				return redirect($this->module_url_path);
			}
			
		}
		Session::flash('success', 'Error while deleting Sub-Option.');
		if(session('session_option_id')!=null)
		{
			return redirect($this->module_url_path.'/suboption/'.base64_encode(session('session_option_id')));
		}
		else
		{
			return redirect($this->module_url_path);
		}
    }


	//check english sub-option exist or not      : AUTHOR (Akshay Ugale)
	public function en_sub_option_check(Request $request)
    {
    	$en_option = $request->input('en_option');

		$obj_cat = $this->SubOptionModel->where('english_name',$en_option)->first();

		if($obj_cat)
		{
			$arr_resp['status']  	= 'error';
		}
		else
		{
			$arr_resp['status'] 	= 'success';
		}
		return $arr_resp;
	}

	//check arabic sub-option exist or not       : AUTHOR (Akshay Ugale)
	public function ar_sub_option_check(Request $request)
    {
    	$ar_option = $request->input('ar_option');

		$obj_cat = $this->SubOptionModel->where('arabic_name',$ar_option)->first();

		if($obj_cat)
		{
			$arr_resp['status']  	= 'error';
		}
		else
		{
			$arr_resp['status'] 	= 'success';
		}
		return $arr_resp;
	}
}
