<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WebAdmin;
use App\Models\CountryModel;
use App\Common\Services\MailService;
use App\Common\Traits\MultiActionTrait;
use Hash;
use DataTables;
use Validator;
use Session;
class StaffManagementController extends Controller
{
    use MultiActionTrait;

    function __construct(MailService $mail_service)
    {
		$this->arr_view_data                = [];
		$this->admin_panel_slug             = config('app.project.admin_panel_slug');
		$this->admin_url_path               = url(config('app.project.admin_panel_slug'));
		$this->module_url_path              = $this->admin_url_path."/staff";
		$this->module_title                 = "Staff";
		$this->module_view_folder           = "admin.staff";
		$this->module_icon                  = "fa fa-user";
		$this->auth                         = auth()->guard('admin');
		$this->BaseModel					= new WebAdmin();
		$this->CountryModel					= new CountryModel();

		$this->user_profile_image_base_img_path   = base_path().config('app.project.img_path.user_profile_image');
		$this->user_profile_image_public_img_path = url('/').config('app.project.img_path.user_profile_image');
    }

    // staff management listing: AUTHOR (Harsh Chauhan)
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

    // ajax load staff management  data : AUTHOR (Harsh Chauhan)
    public function load_data(Request $request)
	{	
		$build_status_btn       = '';
		$arr_data               = [];
		$arr_search_column     	= $request->input('column_filter');

		$obj_request_data = $this->BaseModel->where('role','!=','super_admin')->orderBy('created_at','DESC');

		if(isset($arr_search_column['full_name']) && $arr_search_column['full_name']!="")
		{
			$obj_request_data = $obj_request_data->where('full_name', 'LIKE',"%".$arr_search_column['full_name']."%");
		}

		if(isset($arr_search_column['email']) && $arr_search_column['email']!="")
		{
			$obj_request_data = $obj_request_data->where('email', 'LIKE',"%".$arr_search_column['email']."%");
		}

		if(isset($arr_search_column['status']) && $arr_search_column['status']!="")
		{
			$obj_request_data = $obj_request_data->where('status',$arr_search_column['status']);
		}

		if(isset($arr_search_column['role']) && $arr_search_column['role']!="")
		{
			$obj_request_data = $obj_request_data->where('role',$arr_search_column['role']);
		}

		$obj_request_data = $obj_request_data->get();

		$json_result 	= DataTables::of($obj_request_data)->make(true);
		$build_result 	= $json_result->getData();

		if(isset($build_result->data) && sizeof($build_result->data)>0)
		{
			foreach ($build_result->data as $key => $data) 
			{
				// $view_link_url    = $this->module_url_path.'/view/'.base64_encode($data->id);
				$view_link_url    = "javascript:void(0)";
				
				$arr_roles = [];
              $built_delete_href 		= $this->module_url_path.'/delete/'.base64_encode($data->id);	
				$action_button_html = '';
				$action_button_html .= '<a  title="" href="'.$view_link_url.'" data-original-title="View" data-id="'.$data->id.'" id="open_edit_staff_modal"><i class="icon-pencil7" title="Edit"></i></a>';
				$action_button_html .= '<a href='.$built_delete_href.'  title="delete" onclick="return confirm_action(this,event,\'Do you really want to delete this Staff ?\')"><i class="icon-trash"></i></a>';
				
				$full_name 		= isset($data->full_name)? $data->full_name :'';
				$email 	    	= isset($data->email)? $data->email :'';
				$contact    	= isset($data->mobile_number)? $data->mobile_number :'-';
				$role    		= isset($data->role)? $data->role :'-';
				$last_logged_at = isset($data->last_logged_at)? $data->last_logged_at :'-';
				$id 	    	= isset($data->id)? base64_encode($data->id):'';
				$status 		= isset($data->status)? $data->status :'-';
				if($status==1){
					$status = '<span class="label label-success">Active</span>';
				}else{
					$status = '<span class="label label-danger">Blocked</span>';
				}
				$i = $key+1;
				$build_result->data[$key]->id         		    = $id;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->full_name            = $full_name;
				$build_result->data[$key]->email                = $email;
				$build_result->data[$key]->status        		= $status;
				$build_result->data[$key]->role        			= $role;
				$build_result->data[$key]->last_logged_at       = $last_logged_at;
				$build_result->data[$key]->built_action_btns    = $action_button_html;
				
			}
			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
	}

	// get countries data: AUTHOR (Harsh Chauhan)
	public function get_countries()
    {
    	$arr_data = $arr_resp = [];
    	$obj_data = $this->CountryModel->select('id','country_code')->get();

    	if($obj_data){
    		$arr_data = $obj_data->toArray();
    	}

		$html = "<div class='mobile-drop-section-select'>
					<select name='add_country_id' data-rule-required='true' id='add_country_id' class='form-control'>";

		$html .= "<option  value='180'>+966</option>";
		foreach ($arr_data as $key => $value) {
			$html .= "<option value=".$value['id']." >".$value['country_code']."</option>";
		}

		$html .= "</select>
				</div>";
		$html .= "<div class='mobile-drop-section-input'>
					<input type='text' placeholder='Enter mobile number' id='add_mobile_number' name='add_mobile_number' data-rule-required='true' data-rule-number='true' class='form-control' autocomplete='off'>
					</div>";

		if($arr_data){
			$arr_resp['status']  	= 'success';
			$arr_resp['data'] 		= $html;
		}else{
			$arr_resp['status'] 	= 'error';
			$arr_resp['data'] 		= $html;
		}

		return $arr_resp;
    }

    // get countries for edit: AUTHOR (Harsh Chauhan)
    public function edit_get_countries($id)
    {
		$enc_id = base64_decode($id);
    	$arr_data = $arr_resp = [];
    	$obj_data = $this->CountryModel->select('id','country_code')->get();


    	$obj_staff = $this->BaseModel->where('id',$enc_id)->first();

    	if($obj_data){
    		$arr_data = $obj_data->toArray();
    	}

		$html = "<div class='mobile-drop-section-select'>
					<select name='edit_country_id' data-rule-required='true' id='country_id' class='form-control'>";

		$html .= "<option value='' >Select country</option>";
		foreach ($arr_data as $key => $value) {
			$html .= "<option value='".$value['id']."' ";
			if( $value['id'] == $obj_staff->country_id) {

				$html .=	"selected";
			}
			$html .= ">".$value['country_code']."</option>";
		}

		$html .= "</select>
				</div>";
		$html .= "<div class='mobile-drop-section-input'>
					<input type='text' placeholder='Enter mobile number' id='edit_mobile_number' name='edit_mobile_number' data-rule-required='true' data-rule-number='true' value='".$obj_staff->mobile_number."' class='form-control' autocomplete='off'>
					</div>";

		if($arr_data){
			$arr_resp['status']  	= 'success';
			$arr_resp['data'] 		= $html;
		}else{
			$arr_resp['status'] 	= 'error';
			$arr_resp['data'] 		= $html;
		}

		return $arr_resp;
    }

    // ajax call  to edit staff : AUTHOR (Harsh Chauhan)
    public function edit_staff($id)
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

    // store new staff listing: AUTHOR (Harsh Chauhan)
    public function store_staff(Request $request)
	{
		$arr_rules      = $arr_data = array();
		$status         = false;

		$arr_rules['add_full_name']      	   	= "required";
		$arr_rules['add_country_id']      	   	= "required";
		$arr_rules['add_email']      	   		= "required";
		$arr_rules['add_mobile_number']      	= "required";
		$arr_rules['add_role']      			= "required";

		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}



		$arr_data['full_name']    		=   $request->input('add_full_name', null);	
		$arr_data['country_id']    		=   $request->input('add_country_id', null);	
		$arr_data['email']				=	$request->input('add_email', null);	
		$arr_data['mobile_number']		=	$request->input('add_mobile_number', null);	
		$arr_data['role']				=	$request->input('add_role', null);	
		$arr_data['password']			=	Hash::make($request->input('add_password', 'Admin@123'));	
		$arr_data['is_email_verified']	=	'1';	
		$arr_data['is_verified']		=	'1';	
		$arr_data['is_otp_verified']	=	'1';	


		if($request->hasFile('add_image'))
		{         
			$file_extension = strtolower($request->file('add_image')->getClientOriginalExtension());

			if(in_array($file_extension,['png','jpg','jpeg']))
			{
				$file     = $request->file('add_image');
				$filename = sha1(uniqid().uniqid()) . '.' . $file->getClientOriginalExtension();
				$path     = $this->user_profile_image_base_img_path . $filename;
				$isUpload = $file->move($this->user_profile_image_base_img_path , $filename);
				if($isUpload)
				{
					$arr_data['profile_image'] = $filename;
				}
			}
			else
			{
				Session::flash('error','Invalid File type, While creating Staff.');
				return redirect()->back();
			}
		}
		//dd($arr_data);
		$status = $this->BaseModel->create($arr_data);

		if($status)
		{
			Session::flash('success', 'Staff created successfully.');
			return redirect($this->module_url_path);
		}

		Session::flash('error', 'Error while creating staff.');
		return redirect($this->module_url_path);
	}

	// update staff : AUTHOR (Harsh Chauhan)
	public function update(Request $request)
	{
		$enc_id = base64_decode($request->input('enc_id'));

		$arr_rules      = $arr_data = array();
		$status         = false;

		$arr_rules['edit_full_name']      	   	= "required";
		$arr_rules['edit_country_id']      	   	= "required";
		$arr_rules['edit_email']      	   		= "required";
		$arr_rules['edit_mobile_number']      	= "required";
		$arr_rules['edit_role']      			= "required";

		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}



		$arr_data['full_name']    		=   $request->input('edit_full_name', null);	
		$arr_data['country_id']    		=   $request->input('edit_country_id', null);	
		$arr_data['email']				=	$request->input('edit_email', null);	
		$arr_data['mobile_number']		=	$request->input('edit_mobile_number', null);	
		$arr_data['role']				=	$request->input('edit_role', null);	

		if($request->input('edit_password')!=''){

			$arr_data['password']			=	Hash::make($request->input('edit_password', 'Admin@123'));	
		}

		if($request->hasFile('edit_image'))
		{         
			$file_extension = strtolower($request->file('edit_image')->getClientOriginalExtension());

			if(in_array($file_extension,['png','jpg','jpeg']))
			{
				$file     = $request->file('edit_image');
				$filename = sha1(uniqid().uniqid()) . '.' . $file->getClientOriginalExtension();
				$path     = $this->user_profile_image_base_img_path . $filename;
				$isUpload = $file->move($this->user_profile_image_base_img_path , $filename);
				if($isUpload)
				{
					$arr_data['profile_image'] = $filename;
				}
			}
			else
			{
				Session::flash('error','Invalid File type, While creating Staff.');
				return redirect()->back();
			}
		}

		$status = $this->BaseModel->where('id',$enc_id)->update($arr_data);

		if($status)
		{
			Session::flash('success', 'Staff edited successfully.');
			return redirect($this->module_url_path);
		}

		Session::flash('error', 'Error while creating staff.');
		return redirect($this->module_url_path);
	}


	
	

}