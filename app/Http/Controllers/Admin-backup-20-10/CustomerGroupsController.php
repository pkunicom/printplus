<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CustomerGroupsModel;
use App\Common\Services\MailService;
use App\Common\Traits\MultiActionTrait;
use Hash;
use DataTables;
use Validator;
use Session;
class CustomerGroupsController extends Controller
{
    use MultiActionTrait;

    function __construct(MailService $mail_service)
    {
		$this->arr_view_data                = [];
		$this->admin_panel_slug             = config('app.project.admin_panel_slug');
		$this->admin_url_path               = url(config('app.project.admin_panel_slug'));
		$this->module_url_path              = $this->admin_url_path."/settings/customer_groups";
		$this->module_title                 = "Customer Group";
		$this->module_view_folder           = "admin.customer_groups";
		$this->module_icon                  = "fa fa-user";
		$this->auth                         = auth()->guard('admin');
		$this->BaseModel					= new CustomerGroupsModel();
		
		$this->user_profile_image_base_img_path   = base_path().config('app.project.img_path.user_profile_image');
		$this->user_profile_image_public_img_path = url('/').config('app.project.img_path.user_profile_image');
    }
    // Customer Group index : AUTHOR (Harsh chauhan)
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
    // load Customer Group data : AUTHOR (Harsh chauhan)
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
				$built_delete_href    = $this->module_url_path.'/delete_group/'.base64_encode($data->id);
				$arr_roles = [];

				$action_button_html = '<a  title="" href="'.$view_link_url.'" data-original-title="View" data-id="'.$data->id.'" id="open_edit_modal"><i class="fa fa-cog" title="View"></i></a> <a href='.$built_delete_href.'  title="delete" onclick="return confirm_action(this,event,\'Do you really want to delete this Group ?\')"><i class="fa fa-trash"></i></a>';
				
				$id 	    			= isset($data->id)? base64_encode($data->id):'';
				$group_id 				= isset($data->group_id)? $data->group_id :'';
				$group_name 			= isset($data->group_name)? $data->group_name :'';
				$standard_discount   	= isset($data->standard_discount)? $data->standard_discount :'-';
				$created_at 			= isset($data->created_at)? get_formated_date($data->created_at) :'-';
				
				$i = $key+1;
				$build_result->data[$key]->id         		    = $id;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->group_id        		= $group_id;
				$build_result->data[$key]->group_name  			= $group_name;
				$build_result->data[$key]->standard_discount    = $standard_discount;
				$build_result->data[$key]->built_action_btns    = $action_button_html;
				
			}
			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
	}


	// get Customer Group data by id  : AUTHOR (Harsh chauhan)
    public function get_group_data($id)
    {
		$enc_id = base64_decode($id);
    	$arr_data = $arr_resp = [];
    
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

    // add new Customer Group : AUTHOR (Harsh chauhan)
    public function add_group(Request $request)
	{
		$arr_rules      = $arr_data = array();
		$status         = false;

		$arr_rules['group_name']      	   	= "required";
		$arr_rules['standard_discount']   	= "required";

		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$str1 = "0123456789";
        $str2 = str_shuffle($str1);
        $group_id = substr($str2,0,6); 

		$arr_data['group_id'] 		   		=   $group_id;	
		$arr_data['group_name']    			=   $request->input('group_name', null);	
		$arr_data['standard_discount']   	=   $request->input('standard_discount', null);	

		$status = $this->BaseModel->create($arr_data);

		if($status)
		{
			Session::flash('success', 'Group created successfully.');
			return redirect($this->module_url_path);
		}

		Session::flash('error', 'Error while creating Group.');
		return redirect($this->module_url_path);
	}
	// edit Customer Group : AUTHOR (Harsh chauhan)
	public function edit_group(Request $request)
	{
		$enc_id = base64_decode($request->input('enc_id'));

		$arr_rules      = $arr_data = array();
		$status         = false;

		$arr_rules['edit_group_name']      	   	= "required";
		$arr_rules['edit_standard_discount']   	= "required";

		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$arr_data['group_name']    			=   $request->input('edit_group_name', null);	
		$arr_data['standard_discount']    	=   $request->input('edit_standard_discount', null);	

		$status = $this->BaseModel->where('id',$enc_id)->update($arr_data);

		if($status)
		{
			Session::flash('success', 'Group updated successfully.');
			return redirect($this->module_url_path);
		}

		Session::flash('error', 'Error while updating Group.');
		return redirect($this->module_url_path);
	}

	// delete Customer Group  : AUTHOR (Harsh chauhan)
	public function delete_group(Request $request,$enc_id)
	{	
		$group_id = base64_decode($enc_id);

		$obj_delete = $this->BaseModel->where('id',$group_id)->delete();

		if($obj_delete){
			Session::flash('success', 'Group deleted successfully.');
			return redirect($this->module_url_path);
    	}else{
    		Session::flash('error', 'Something went wrong.');
			return redirect($this->module_url_path);
    	}
	}
}