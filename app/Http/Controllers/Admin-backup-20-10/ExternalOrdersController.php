<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CountryModel;
use App\Models\ExternalOrdersModel;
use App\Common\Services\MailService;
use App\Common\Traits\MultiActionTrait;
use Hash;
use DataTables;
use Validator;
use Session;
class ExternalOrdersController extends Controller
{
    use MultiActionTrait;

    function __construct(MailService $mail_service)
    {
		$this->arr_view_data                = [];
		$this->admin_panel_slug             = config('app.project.admin_panel_slug');
		$this->admin_url_path               = url(config('app.project.admin_panel_slug'));
		$this->module_url_path              = $this->admin_url_path."/orders/external_orders";
		$this->module_title                 = "Orders ";
		$this->module_view_folder           = "admin.orders";
		$this->module_icon                  = "fa fa-user";
		$this->auth                         = auth()->guard('admin');
		$this->BaseModel					= new ExternalOrdersModel();
		$this->CountryModel					= new CountryModel();

		$this->user_profile_image_base_img_path   = base_path().config('app.project.img_path.user_profile_image');
		$this->user_profile_image_public_img_path = url('/').config('app.project.img_path.user_profile_image');
    }

    //external orders index: AUTHOR (Harsh chauhan)
    public function external_orders()
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
		
		return view($this->module_view_folder.'.external_orders',$this->arr_view_data);
    }

    //load external orders data: AUTHOR (Harsh chauhan)
    public function load_externalorders_data(Request $request)
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
				$built_delete_href    = $this->module_url_path.'/delete_external_orders/'.base64_encode($data->id);
				$arr_roles = [];

				$action_button_html = '<a  title="" href="'.$view_link_url.'" data-original-title="View" data-id="'.$data->id.'" id="open_edit_modal"><i class="fa fa-cog" title="View"></i></a> <a href='.$built_delete_href.'  title="delete" onclick="return confirm_action(this,event,\'Do you really want to delete this Order ?\')"><i class="fa fa-trash"></i></a>';
				
				$id 	    			= isset($data->id)? base64_encode($data->id):'';
				$customer_name 			= isset($data->customer_name)? $data->customer_name :'';
				$project_description 	= isset($data->project_description)? $data->project_description :'';
				$cost    				= isset($data->cost)? $data->cost :'-';
				$selling    			= isset($data->selling)? $data->selling :'-';
				$added_by 				= isset($data->added_by)? $data->added_by :'-';
				$margin 				= isset($data->margin)? $data->margin :'-';
				$created_at 			= isset($data->created_at)? get_formated_date($data->created_at) :'-';
				
				$i = $key+1;
				$build_result->data[$key]->id         		    = $id;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->customer_name        = $customer_name;
				$build_result->data[$key]->project_description  = $project_description;
				$build_result->data[$key]->cost        			= $cost;
				$build_result->data[$key]->selling        		= $selling;
				$build_result->data[$key]->added_by       		= $added_by;
				$build_result->data[$key]->margin       		= $margin;
				$build_result->data[$key]->created_at       	= $created_at;
				$build_result->data[$key]->built_action_btns    = $action_button_html;
				
			}
			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
	}

	// public function get_countries()
 //    {
 //    	$arr_data = $arr_resp = [];
 //    	$obj_data = $this->CountryModel->select('id','country_code')->get();

 //    	if($obj_data){
 //    		$arr_data = $obj_data->toArray();
 //    	}

	// 	$html = "<div class='mobile-drop-section-select'>
	// 				<select name='add_country_id' data-rule-required='true' id='add_country_id' class='form-control'>";

	// 	$html .= "<option value='' >Select country</option>";
	// 	foreach ($arr_data as $key => $value) {
	// 		$html .= "<option value=".$value['id']." >".$value['country_code']."</option>";
	// 	}

	// 	$html .= "</select>
	// 			</div>";
	// 	$html .= "<div class='mobile-drop-section-input'>
	// 				<input type='text' placeholder='Enter mobile number' id='add_mobile_number' name='add_mobile_number' data-rule-required='true' data-rule-number='true' class='form-control' autocomplete='off'>
	// 				</div>";

	// 	if($arr_data){
	// 		$arr_resp['status']  	= 'success';
	// 		$arr_resp['data'] 		= $html;
	// 	}else{
	// 		$arr_resp['status'] 	= 'error';
	// 		$arr_resp['data'] 		= $html;
	// 	}

	// 	return $arr_resp;
 //    }

	//edit external orders : AUTHOR (Harsh chauhan)
    public function edit_external_orders($id)
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

    //add staff: AUTHOR (Harsh chauhan)
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

    //store external orders : AUTHOR (Harsh chauhan)
    public function store_external_order(Request $request)
	{
		$arr_rules      = $arr_data = array();
		$status         = false;

		$arr_rules['add_full_name']      	   	= "required";
		$arr_rules['add_project_description']   = "required";
		$arr_rules['add_cost']      	   		= "required";
		$arr_rules['add_margin']      			= "required";
		$arr_rules['add_selling']      			= "required";

		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$arr_data['customer_name']    		=   $request->input('add_full_name', null);	
		$arr_data['project_description']    =   $request->input('add_project_description', null);	
		$arr_data['cost']					=	$request->input('add_cost', null);	
		$arr_data['margin']					=	$request->input('add_margin', null);	
		$arr_data['selling']				=	$request->input('add_selling', null);	
		$arr_data['added_by']				=	'Admin';

		$status = $this->BaseModel->create($arr_data);

		if($status)
		{
			Session::flash('success', 'External order created successfully.');
			return redirect($this->module_url_path);
		}

		Session::flash('error', 'Error while creating order.');
		return redirect($this->module_url_path);
	}

	// update external orders : AUTHOR (Harsh chauhan)
	public function update_external_order(Request $request)
	{
		$enc_id = base64_decode($request->input('enc_id'));

		$arr_rules      = $arr_data = array();
		$status         = false;

		$arr_rules['edit_full_name']      	   	 = "required";
		$arr_rules['edit_project_description']   = "required";
		$arr_rules['edit_cost']      	   		 = "required";
		$arr_rules['edit_margin']      			 = "required";
		$arr_rules['edit_selling']      		 = "required";

		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$arr_data['customer_name']    		=   $request->input('edit_full_name', null);	
		$arr_data['project_description']    =   $request->input('edit_project_description', null);	
		$arr_data['cost']					=	$request->input('edit_cost', null);	
		$arr_data['margin']					=	$request->input('edit_margin', null);	
		$arr_data['selling']				=	$request->input('edit_selling', null);	
		$arr_data['added_by']				=	'Admin';


		$status = $this->BaseModel->where('id',$enc_id)->update($arr_data);

		if($status)
		{
			Session::flash('success', 'Order updated successfully.');
			return redirect($this->module_url_path);
		}

		Session::flash('error', 'Error while updating order.');
		return redirect($this->module_url_path);
	}

	//delete external orders : AUTHOR (Harsh chauhan)
	public function delete_external_orders(Request $request,$enc_id)
	{	
		$order_id = base64_decode($enc_id);

		$obj_delete = $this->BaseModel->where('id',$order_id)->delete();

		if($obj_delete){
			Session::flash('success', 'Order deleted successfully.');
			return redirect($this->module_url_path);
    	}else{
    		Session::flash('error', 'Something went wrong.');
			return redirect($this->module_url_path);
    	}
	}
}