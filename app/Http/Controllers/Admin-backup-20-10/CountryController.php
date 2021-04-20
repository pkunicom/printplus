<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SystemCountryModel;
use App\Models\AramexCountryModel;
use App\Common\Services\MailService;
use App\Common\Traits\MultiActionTrait;
use Hash;
use DataTables;
use Validator;
use Session;
class CountryController extends Controller
{
    use MultiActionTrait;

    function __construct(MailService $mail_service)
    {
		$this->arr_view_data                = [];
		$this->admin_panel_slug             = config('app.project.admin_panel_slug');
		$this->admin_url_path               = url(config('app.project.admin_panel_slug'));
		$this->module_url_path              = $this->admin_url_path."/settings/countries";
		$this->module_title                 = "Countries";
		$this->module_view_folder           = "admin.countries";
		$this->module_icon                  = "fa fa-user";
		$this->auth                         = auth()->guard('admin');
		$this->BaseModel					= new SystemCountryModel();
		$this->AramexCountryModel			= new AramexCountryModel();
		
		$this->user_profile_image_base_img_path   = base_path().config('app.project.img_path.user_profile_image');
		$this->user_profile_image_public_img_path = url('/').config('app.project.img_path.user_profile_image');
    }

    // system country index: AUTHOR (Harsh chauhan)
    public function index()
    {
    	$obj_user = $this->AramexCountryModel->get();

    	if($obj_user){
    		$arr_data_aramex = $obj_user->toArray();
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
		$this->arr_view_data['arr_data_aramex'] 	= $arr_data_aramex;
		
		return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    // load data system country : AUTHOR (Harsh chauhan)
    public function load_data(Request $request)
	{	
		$build_status_btn       = '';
		$arr_data               = [];
		$arr_search_column     	= $request->input('column_filter');

		$obj_request_data = $this->BaseModel->orderBy('created_at','DESC');

		// if(isset($arr_search_column['full_name']) && $arr_search_column['full_name']!="")
		// {
		// 	$obj_request_data = $obj_request_data->where('full_name', 'LIKE',"%".$arr_search_column['full_name']."%");
		// }

		// if(isset($arr_search_column['email']) && $arr_search_column['email']!="")
		// {
		// 	$obj_request_data = $obj_request_data->where('email', 'LIKE',"%".$arr_search_column['email']."%");
		// }

		// if(isset($arr_search_column['status']) && $arr_search_column['status']!="")
		// {
		// 	$obj_request_data = $obj_request_data->where('status',$arr_search_column['status']);
		// }

		// if(isset($arr_search_column['role']) && $arr_search_column['role']!="")
		// {
		// 	$obj_request_data = $obj_request_data->where('role',$arr_search_column['role']);
		// }

		$obj_request_data = $obj_request_data->get();

		$json_result 	= DataTables::of($obj_request_data)->make(true);
		$build_result 	= $json_result->getData();

		if(isset($build_result->data) && sizeof($build_result->data)>0)
		{
			foreach ($build_result->data as $key => $data) 
			{
				// $view_link_url    = $this->module_url_path.'/view/'.base64_encode($data->id);
				$view_link_url    = "javascript:void(0)";
				$built_delete_href    = $this->module_url_path.'/delete_country/'.base64_encode($data->id);
				$arr_roles = [];

				// $action_button_html = '<a  title="" href="'.$view_link_url.'" data-original-title="View" data-id="'.$data->id.'" id="open_edit_modal"><i class="fa fa-cog" title="View"></i></a> <a href='.$built_delete_href.'  title="delete" onclick="return confirm_action(this,event,\'Do you really want to delete this Country ?\')"><i class="fa fa-trash"></i></a>';
				$action_button_html = '<a  title="" href="'.$view_link_url.'" data-original-title="View" data-id="'.$data->id.'" id="open_edit_modal"><i class="fa fa-cog" title="View"></i></a> ';

				if($data->status != null && $data->status == "0")
				{
					$action_button_html .= '<a  href="'.$this->module_url_path.'/unblock/'.base64_encode($data->id).'" onclick="return confirm_action(this,event,\'Do you really want to activate this Country ?\')"><i class="fa fa-eye-slash" title="Blocked"></i></a>&nbsp&nbsp&nbsp ';
				}
				elseif($data->status != null && $data->status == "1")
				{
					$action_button_html .= '<a  href="'.$this->module_url_path.'/block/'.base64_encode($data->id).'" onclick="return confirm_action(this,event,\'Do you really want to inactivate this Country ?\')"><i class="fa fa-eye" title="Active"></i></a> &nbsp&nbsp&nbsp';
				}
				
				$id 	    			= isset($data->id)? base64_encode($data->id):'';
				$country_id 			= isset($data->country_id)? $data->country_id :'';
				$country_english_name 	= isset($data->country_english_name)? $data->country_english_name :'';
				$country_arabic_name 	= isset($data->country_arabic_name)? $data->country_arabic_name :'';
				$created_at 			= isset($data->created_at)? get_formated_date($data->created_at) :'-';
				
				$i = $key+1;

				$build_result->data[$key]->id         		    = $id;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->country_id        	= $country_id;
				$build_result->data[$key]->country_english_name = $country_english_name;
				$build_result->data[$key]->country_arabic_name   = $country_arabic_name;
				$build_result->data[$key]->built_action_btns    = $action_button_html;
				
			}
			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
	}


	// get system country data : AUTHOR (Harsh chauhan)
    public function get_country_data($id)
    {
		$enc_id = base64_decode($id);
    	$arr_data = $arr_resp = [];
    
    	$obj_user = $this->AramexCountryModel->get();

    	if($obj_user){
    		$arr_data_aramex = $obj_user->toArray();
    	}

    	$obj_data = $this->BaseModel->where('id',$enc_id)->first();

    	if($obj_data){
    		$arr_data = $obj_data->toArray();

			$html = '<option value="">Select Aramex Country</option>';
			foreach ($arr_data_aramex as $key => $value) {
															
				$html .= '<option value='.$value['id'].' ';

				if($value['id']==$arr_data['aramex_country_id']){
					$html .= 'selected';
 				}

				$html .= '>'.$value['name_en'].'</option>';

    		}
    	}

		
		if($arr_data){
			$arr_resp['status']  	 = 'success';
			$arr_resp['data'] 		 = $arr_data;
			$arr_resp['aramex_html'] = $html;
		}else{
			$arr_resp['status'] 	 = 'error';
			$arr_resp['data'] 		 = $arr_data;
		}

		return $arr_resp;
    }

    // add system country : AUTHOR (Harsh chauhan)
    public function add_country(Request $request)
	{
		$arr_rules      = $arr_data = array();
		$status         = false;

		$arr_rules['add_english_name']      	   	= "required";
		$arr_rules['add_arabic_name']   			= "required";

		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$str1 = "0123456789";
        $str2 = str_shuffle($str1);
        $country_id = substr($str2,0,6); 

		$arr_data['country_id'] 		   		=   $country_id;	
		$arr_data['country_english_name']    	=   $request->input('add_english_name', null);	
		$arr_data['country_arabic_name']   		=   $request->input('add_arabic_name', null);	
		$arr_data['aramex_country_id']   		=   $request->input('aramex_country_id', null);	

		$status = $this->BaseModel->create($arr_data);

		if($status)
		{
			Session::flash('success', 'Country added successfully.');
			return redirect($this->module_url_path);
		}

		Session::flash('error', 'Error while adding country.');
		return redirect($this->module_url_path);
	}
	// update system country : AUTHOR (Harsh chauhan)
	public function edit_country(Request $request)
	{
		$enc_id = base64_decode($request->input('enc_id'));

		$arr_rules      = $arr_data = array();
		$status         = false;

		$arr_rules['edit_english_name']      	   	= "required";
		$arr_rules['edit_arabic_name']   			= "required";

		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$arr_data['country_english_name']    			=   $request->input('edit_english_name', null);	
		$arr_data['country_arabic_name']    			=   $request->input('edit_arabic_name', null);	
		$arr_data['aramex_country_id']   		        =   $request->input('edit_aramex_country_id', null);	

		$status = $this->BaseModel->where('id',$enc_id)->update($arr_data);

		if($status)
		{
			Session::flash('success', 'Country updated successfully.');
			return redirect($this->module_url_path);
		}

		Session::flash('error', 'Error while updating Country.');
		return redirect($this->module_url_path);
	}
	// delete system country : AUTHOR (Harsh chauhan)
	public function delete_country(Request $request,$enc_id)
	{	
		$country_id = base64_decode($enc_id);

		$obj_delete = $this->BaseModel->where('id',$country_id)->delete();

		if($obj_delete){
			Session::flash('success', 'Country deleted successfully.');
			return redirect($this->module_url_path);
    	}else{
    		Session::flash('error', 'Something went wrong.');
			return redirect($this->module_url_path);
    	}
	}

	// block system country : AUTHOR (Harsh chauhan)
	public function block(Request $request,$enc_id)
	{	
		$country_id = base64_decode($enc_id);

		$obj_status = $this->BaseModel->where('id',$country_id)->update(['status'=>'0']);

		if($obj_status){
			Session::flash('success', 'Country status updated successfully.');
			return redirect($this->module_url_path);
    	}else{
    		Session::flash('error', 'Something went wrong.');
			return redirect($this->module_url_path);
    	}
	}

	// unblock system country : AUTHOR (Harsh chauhan)
	public function unblock(Request $request,$enc_id)
	{	
		$country_id = base64_decode($enc_id);

		$obj_status = $this->BaseModel->where('id',$country_id)->update(['status'=>'1']);

		if($obj_status){
			Session::flash('success', 'Country status updated successfully.');
			return redirect($this->module_url_path);
    	}else{
    		Session::flash('error', 'Something went wrong.');
			return redirect($this->module_url_path);
    	}
	}
}