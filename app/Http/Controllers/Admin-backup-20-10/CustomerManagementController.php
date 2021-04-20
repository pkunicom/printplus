<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CustomerModel;
use App\Models\CustomerCategoryDiscountModel;
use App\Models\OrdersModel;
use App\Models\CountryModel;
use App\Models\SystemCountryModel;
use App\Models\SystemCityModel;
use App\Models\ProductsModel;
use App\Models\TransactionsModel;
use App\Models\DeliveryTypeModel;
use App\Models\CustomerWalletModel;
use App\Models\CustomerGroupsModel;
use App\Models\CategoryModel;
use App\Common\Services\MailService;
use App\Common\Traits\MultiActionTrait;
use Hash;
use DataTables;
use Validator;
use Session;
use File;
class CustomerManagementController extends Controller
{
    use MultiActionTrait;

    function __construct(MailService $mail_service)
    {
		$this->arr_view_data                = [];
		$this->admin_panel_slug             = config('app.project.admin_panel_slug');
		$this->admin_url_path               = url(config('app.project.admin_panel_slug'));
		$this->module_url_path              = $this->admin_url_path."/customers";
		$this->module_title                 = "Customer";
		$this->module_view_folder           = "admin.customer";
		$this->module_icon                  = "fa fa-user";
		$this->auth                         = auth()->guard('admin');
		$this->BaseModel					= new CustomerModel();
		$this->OrdersModel					= new OrdersModel();
		$this->CustomerCategoryDiscountModel		= new CustomerCategoryDiscountModel();
		$this->CountryModel					= new CountryModel();
		$this->SystemCountryModel			= new SystemCountryModel();
		$this->SystemCityModel				= new SystemCityModel();
		$this->CategoryModel				= new CategoryModel();
		$this->ProductsModel				= new ProductsModel();
		$this->DeliveryTypeModel			= new DeliveryTypeModel();
		$this->TransactionsModel			= new TransactionsModel();
		$this->CustomerWalletModel			= new CustomerWalletModel();
		$this->CustomerGroupsModel			= new CustomerGroupsModel();

		$this->user_profile_image_base_img_path   = base_path().config('app.project.img_path.user_profile_image');
		$this->user_profile_image_public_img_path = url('/').config('app.project.img_path.user_profile_image');
    }
    // Customer index : AUTHOR (Harsh chauhan)
    public function index()
    {
    	$arr_sys_country = $arr_sys_city = [];

    	$obj_sys_country = $this->SystemCountryModel->get();

    	if($obj_sys_country){
    		$arr_sys_country = $obj_sys_country->toArray();
    	}

    	// $obj_sys_city = $this->SystemCityModel->get();

    	// if($obj_sys_city){
    	// 	$arr_sys_city = $obj_sys_city->toArray();
    	// }

		$this->arr_view_data['page_title']          = "Manage ".$this->module_title;
        $this->arr_view_data['parent_module_icon']  = "fa fa-home";
        $this->arr_view_data['parent_module_title'] = "Dashboard";
        $this->arr_view_data['parent_module_url']   = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']         = $this->module_icon;
        $this->arr_view_data['module_title']        = "Manage ".$this->module_title;
		$this->arr_view_data['module_url_path']     = $this->module_url_path;
		$this->arr_view_data['admin_url_path']      = $this->admin_url_path;
		$this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;
		$this->arr_view_data['arr_sys_country'] 	= $arr_sys_country;
		$this->arr_view_data['arr_sys_city'] 		= $arr_sys_city;
		
		return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    //load  Customer data : AUTHOR (Harsh chauhan)
    public function load_data(Request $request)
	{	
		$build_status_btn       = '';
		$arr_data               = [];
		$arr_search_column     	= $request->input('column_filter');

		$obj_request_data = $this->BaseModel->with('get_group_details','get_transactions')->orderBy('created_at','DESC')->get();

		$json_result 	= DataTables::of($obj_request_data)->make(true);
		$build_result 	= $json_result->getData();

		if(isset($build_result->data) && sizeof($build_result->data)>0)
		{
			foreach ($build_result->data as $key => $data) 
			{
				// dd($data);
				$edit_link_url    = $this->module_url_path.'/edit_customer/'.base64_encode($data->id);
				// $view_link_url    = "javascript:void(0)";
				
				$arr_roles = [];

				$action_button_html = '<a  title="" href="'.$edit_link_url.'" data-original-title="View" data-id="'.$data->id.'" id="open_edit_staff_modal"><i class="fa fa-cog"></i></a>';
				
				$id 	    	= isset($data->id)? base64_encode($data->id):'';
				$customer_id 	= isset($data->customer_id)? $data->customer_id :'';
				$full_name 		= isset($data->full_name)? $data->full_name :'';
				$email 	    	= isset($data->email)? $data->email :'';
				$mobile_number  = isset($data->mobile_number)? $data->mobile_number :'-';
				$transaction  	= isset($data->get_transactions)? $data->get_transactions :'-';

				$compensate = $bank_transfer = $deduct = 0;
				foreach ($transaction as $key_t => $value_t) {
					# code...
					if($value_t->transaction_type=='compensate'){
						$compensate = $compensate + $value_t->amount;
					}
					if($value_t->transaction_type=='bank_transfer'){
						$bank_transfer = $bank_transfer + $value_t->amount;
					}
					if($value_t->transaction_type=='deduct'){
						$deduct = $deduct + $value_t->amount;
					}
				}

				$balance  		= $compensate+$bank_transfer-$deduct;
				$customer_group = isset($data->get_group_details->group_name)? $data->get_group_details->group_name :'-';
				$status 		= isset($data->status)? $data->status :'-';
				if($status==1){
					$status = 'Active';
				}else{
					$status = 'Blocked';
				}
				$i = $key+1;

				$build_result->data[$key]->id         		    = $id;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->customer_id          = $customer_id;
				$build_result->data[$key]->full_name            = $full_name;
				$build_result->data[$key]->email                = $email;
				$build_result->data[$key]->mobile_number        = $mobile_number;
				$build_result->data[$key]->customer_group       = $customer_group;
				$build_result->data[$key]->balance        		= $balance;
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
	// get countries : AUTHOR (Harsh chauhan)
	public function get_countries()
    {
    	$arr_data = $arr_resp = [];
    	$obj_data = $this->CountryModel->select('id','country_code')->get();

    	if($obj_data){
    		$arr_data = $obj_data->toArray();
    	}

		// $html = "<div class='mobile-drop-section-select'>
		// 			<select name='add_country_id' data-rule-required='true' id='add_country_id' class='form-control'>";

		$html = "<option value='' >Select country</option>";
		foreach ($arr_data as $key => $value) {
			$html .= "<option value=".$value['id']." >".$value['country_code']."</option>";
		}

		// $html .= "</select>
		// 		</div>";
		// $html .= "<div class='mobile-drop-section-input'>
		// 			<input type='text' placeholder='Enter mobile number' id='add_mobile_number' name='add_mobile_number' data-rule-required='true' data-rule-number='true' class='form-control' autocomplete='off'>
		// 			</div>";

		if($arr_data){
			$arr_resp['status']  	= 'success';
			$arr_resp['data'] 		= $html;
		}else{
			$arr_resp['status'] 	= 'error';
			$arr_resp['data'] 		= $html;
		}

		return $arr_resp;
    }
    // get cities : AUTHOR (Harsh chauhan)
    public function get_cities($enc_id)
    {
    	$country_id = base64_decode($enc_id);
    	$arr_data = $arr_resp = [];
    	$obj_data = $this->SystemCityModel->where('system_country_id',$country_id)->get();

    	if($obj_data){
    		$arr_data = $obj_data->toArray();
    	}

		$html = "<option value='' >Select city</option>";
		foreach ($arr_data as $key => $value) {
			$html .= "<option value=".$value['id']." >".$value['city_english_name']."</option>";
		}

		if($arr_data){
			$arr_resp['status']  	= 'success';
			$arr_resp['data'] 		= $html;
		}else{
			$arr_resp['status'] 	= 'error';
			$arr_resp['data'] 		= $html;
		}

		return $arr_resp;
    }

    // edit Customer : AUTHOR (Harsh chauhan)
    public function edit_customer(Request $request,$enc_id)
    {
    	$arr_data = $arr_sys_city = $arr_sys_country = $arr_country = $arr_delivery_type = $arr_groups = [];

    	$id = base64_decode($enc_id);

    	$obj_data = $this->BaseModel->with('get_group_details')->where('id',$id)->first();

    	if($obj_data){
    		$arr_data = $obj_data->toArray();
    	}

    	$obj_sys_country = $this->SystemCountryModel->get();
    	if($obj_sys_country){
    		$arr_sys_country  = $obj_sys_country->toArray();
    	}

    	$obj_sys_city = $this->SystemCityModel->where('system_country_id',$obj_data->country_id)->get();
    	if($obj_sys_city){
    		$arr_sys_city = $obj_sys_city->toArray();
    	}

    	$obj_groups = $this->CustomerGroupsModel->get();
    	if($obj_groups){
    		$arr_groups  = $obj_groups->toArray();
    	}

    	$obj_sys_city = $this->SystemCityModel->where('system_country_id',$obj_data->country_id)->get();
    	if($obj_sys_city){
    		$arr_sys_city = $obj_sys_city->toArray();
    	}


    	$obj_country = $this->CountryModel->select('id','country_code')->get();
    	if($obj_country){
    		$arr_country = $obj_country->toArray();
    	}

    	$obj_delivery_type = $this->DeliveryTypeModel->select('id','delivery_type')->get();
    	if($obj_delivery_type){
    		$arr_delivery_type = $obj_delivery_type->toArray();
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
		$this->arr_view_data['arr_data']    		= $arr_data;
		$this->arr_view_data['arr_sys_country']    	= $arr_sys_country;
		$this->arr_view_data['arr_sys_city']    	= $arr_sys_city;
		$this->arr_view_data['arr_country']    		= $arr_country;
		$this->arr_view_data['arr_delivery_type']   = $arr_delivery_type;
		$this->arr_view_data['arr_groups']   		= $arr_groups;
		$this->arr_view_data['user_profile_image_base_img_path']    	= $this->user_profile_image_base_img_path;
		$this->arr_view_data['user_profile_image_public_img_path']    	= $this->user_profile_image_public_img_path;
		
		return view($this->module_view_folder.'.edit',$this->arr_view_data);
    }

    // store agent  : AUTHOR (Harsh chauhan)
    public function store_agent(Request $request)
	{
		$arr_rules      = $arr_data = array();

		$arr_rules['agency_name']      	= "required";
		$arr_rules['contact_name']      = "required";
		$arr_rules['country']      	   	= "required";
		$arr_rules['contact_one']      	= "required";
		$arr_rules['city']      		= "required";
		$arr_rules['email_one']      	= "required";
		$arr_rules['address']      		= "required";
		$arr_rules['country_id_one']    = "required";
		$arr_rules['mobile_number_one'] = "required";
		// $arr_rules['contact_two']      	= "required";
		// $arr_rules['email_two']      	= "required";
		// $arr_rules['country_id_two']    = "required";
		// $arr_rules['mobile_number_two'] = "required";
		$arr_rules['account_name']      = "required";
		$arr_rules['account_number']    = "required";
		$arr_rules['bank_name']      	= "required";
		$arr_rules['iban_number']      	= "required";

		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$arr_data['agency_name']    	=   $request->input('agency_name', null);	
		$arr_data['full_name']    		=   $request->input('contact_name', null);	
		$arr_data['country_id']    		=   $request->input('country', null);	
		$arr_data['city_id']			=	$request->input('city', null);	
		$arr_data['address']			=	$request->input('address', null);	
		$arr_data['email']				=	$request->input('email_one', null);	
		$arr_data['mobile_number']		=	$request->input('mobile_number_one', null);	
		$arr_data['password']			=	Hash::make($request->input('password', 'Admin@123'));	
		
		$create_agent = $this->BaseModel->create($arr_data);

		$arr_agent_contact['agent_id'] 			= isset($create_agent->id) ? $create_agent->id :'';	
		$arr_agent_contact['contact_one'] 		= $request->input('contact_one', null);	
		$arr_agent_contact['email_one'] 		= $request->input('email_one', null);	
		$arr_agent_contact['country_id_one'] 	= $request->input('country_id_one', null);	
		$arr_agent_contact['mobile_one'] 		= $request->input('mobile_number_one', null);	
		$arr_agent_contact['contact_two'] 		= $request->input('contact_two', null);	
		$arr_agent_contact['email_two'] 		= $request->input('email_two', null);	
		$arr_agent_contact['country_id_two'] 	= $request->input('country_id_two', null);	
		$arr_agent_contact['mobile_two']		= $request->input('mobile_number_two', null);	

		$create_agent_contact = $this->AgentContactDetailsModel->create($arr_agent_contact);

		$arr_agent_bank['agent_id'] 			= isset($create_agent->id) ? $create_agent->id :'';	
		$arr_agent_bank['account_number'] 		= $request->input('account_number', null);	
		$arr_agent_bank['account_name'] 		= $request->input('account_name', null);	
		$arr_agent_bank['bank_name'] 			= $request->input('bank_name', null);	
		$arr_agent_bank['iban_number'] 			= $request->input('iban_number', null);	

		$create_agent_bank = $this->AgentBankDetailsModel->create($arr_agent_bank);

		if($request->hasFile('license'))
		{         
			$file_extension = strtolower($request->file('license')->getClientOriginalExtension());
			
			$file     = $request->file('license');
			$filename = sha1(uniqid().uniqid()) . '.' . $file->getClientOriginalExtension();
			$path     = $this->agent_documents_base_img_path . $filename;
			$isUpload = $file->move($this->agent_documents_base_img_path , $filename);
			if($isUpload)
			{
				$arr_agent_document['license'] = $filename;
			}
			else
			{
				$arr_agent_document['license'] = '-';
			}
		}
		if($request->hasFile('company_cr'))
		{         
			$file_extension = strtolower($request->file('company_cr')->getClientOriginalExtension());
			
			$file     = $request->file('company_cr');
			$filename = sha1(uniqid().uniqid()) . '.' . $file->getClientOriginalExtension();
			$path     = $this->agent_documents_base_img_path . $filename;
			$isUpload = $file->move($this->agent_documents_base_img_path , $filename);
			if($isUpload)
			{
				$arr_agent_document['company_cr'] = $filename;
			}
			else
			{
				$arr_agent_document['company_cr'] = '-';
			}
		}
		if($request->hasFile('vat_reg'))
		{         
			$file_extension = strtolower($request->file('vat_reg')->getClientOriginalExtension());
			
			$file     = $request->file('vat_reg');
			$filename = sha1(uniqid().uniqid()) . '.' . $file->getClientOriginalExtension();
			$path     = $this->agent_documents_base_img_path . $filename;
			$isUpload = $file->move($this->agent_documents_base_img_path , $filename);
			if($isUpload)
			{
				$arr_agent_document['vat_reg'] = $filename;
			}
			else
			{
				$arr_agent_document['vat_reg'] = '-';
			}
		}
		$arr_agent_document['agent_id'] = isset($create_agent->id) ? $create_agent->id :'';	
		$create_agent_documents = $this->AgentDocumentsModel->create($arr_agent_document);

		if($create_agent)
		{
			Session::flash('success', 'Agent created successfully.');
			return redirect($this->module_url_path);
		}

		Session::flash('error', 'Error while creating Agent.');
		return redirect($this->module_url_path);
	}

	// update Customer detail; : AUTHOR (Harsh chauhan)
	public function update_customer(Request $request,$enc_id)
	{
		// dd($request->all());
		$enc_id = base64_decode($enc_id);

		$arr_rules      = $arr_data = $arr_agent_document =array();
		$status         = false;

		$arr_rules['full_name']      	= "required";
		$arr_rules['country']      	   	= "required";
		$arr_rules['city']      		= "required";
		$arr_rules['email']      		= "required";
		$arr_rules['address']      		= "required";
		// $arr_rules['country_code_id']   = "required";
		$arr_rules['mobile_number'] 	= "required";
		$arr_rules['gender'] 			= "required";
		$arr_rules['customer_group'] 	= "required";
		$arr_rules['email_language'] 	= "required";

		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$obj_check = $this->BaseModel->select('id','customer_group','country_code_id','country_code_flag')
									 ->where('id',$enc_id)
									 ->where('customer_group',$request->input('customer_group', null))
									 ->first();


		$arr_data['full_name']    		=   $request->input('full_name', null);	
		$arr_data['country_id']    		=   $request->input('country', null);	
		$arr_data['city_id']			=	$request->input('city', null);	
		$arr_data['address']			=	$request->input('address', null);	
		$arr_data['email']				=	$request->input('email', null);	

		$arr_data['country_code_id']	=	$request->input('country_code_id', isset($obj_check->country_code_id)?$obj_check->country_code_id:'+966');	
		$arr_data['country_code_flag']	=	$request->input('country_code_flag', isset($obj_check->country_code_flag)?$obj_check->country_code_flag:'sa');	
		$arr_data['mobile_number']		=	$request->input('mobile_number', null);	
		$arr_data['gender']				=	$request->input('gender', null);	
		$arr_data['customer_group']		=	$request->input('customer_group', null);	
		$arr_data['email_language']		=	$request->input('email_language', null);	
		
		$update_customer = $this->BaseModel->where('id',$enc_id)->update($arr_data);

		
		
		if(!$obj_check){

			$obj_groups = $this->CustomerGroupsModel->where('id',$request->input('customer_group', null))
													->first();

			$obj_category = $this->CategoryModel->get();

			if($obj_category){
				$arr_category = $obj_category->toArray();
				$obj_delete   = $this->CustomerCategoryDiscountModel->where('customer_id',$enc_id)->delete();

				foreach ($arr_category as $key => $value) {
					$arr_category_dis['customer_id'] = $enc_id;
					$arr_category_dis['category_id'] = $value['id'];
					$arr_category_dis['discount']    = $obj_groups->standard_discount;

					$obj_create_discount = $this->CustomerCategoryDiscountModel->create($arr_category_dis);
				}
			}
		}

		if($update_customer)
		{
			Session::flash('success', 'Customer Updated successfully.');
			return redirect($this->module_url_path.'/edit_customer/'.base64_encode($enc_id));
		}

		Session::flash('error', 'Error while updating Agent.');
		return redirect($this->module_url_path.'/edit_customer/'.base64_encode($enc_id));
	}

	// update agent bank detail : AUTHOR (Harsh chauhan)
	public function update_agent_bank(Request $request,$enc_id)
	{
		$enc_id = base64_decode($enc_id);

		$arr_rules      = $arr_data = array();
		$status         = false;

		$arr_rules['account_number']    = "required";
		$arr_rules['account_name']      = "required";
		$arr_rules['bank_name']      	= "required";
		$arr_rules['iban_number']      	= "required";
		

		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$arr_agent_bank['account_number'] 		= $request->input('account_number', null);	
		$arr_agent_bank['account_name'] 		= $request->input('account_name', null);	
		$arr_agent_bank['bank_name'] 			= $request->input('bank_name', null);	
		$arr_agent_bank['iban_number'] 			= $request->input('iban_number', null);	
		
		$create_agent = $this->AgentBankDetailsModel->where('agent_id',$enc_id)->update($arr_agent_bank);

		if($create_agent)
		{
			Session::flash('success', 'Agent Bank details Updated successfully.');
			return redirect($this->module_url_path);
		}

		Session::flash('error', 'Error while updating Agent Bank details.');
		return redirect($this->module_url_path);
	}

	// load Customer discount data : AUTHOR (Harsh chauhan)
	 public function load_customerdiscount_data(Request $request,$enc_id)
	{	
		$customer_id = base64_decode($enc_id);
		$build_status_btn       = '';
		$arr_data               = [];
		$arr_search_column     	= $request->input('column_filter');

		$obj_request_data = $this->CustomerCategoryDiscountModel->with(['get_category_details'])
																 ->where('customer_id',$customer_id)
																 ->orderBy('created_at','DESC');

		// if(isset($arr_search_column['product_id']) && $arr_search_column['product_id']!="")
		// {
		// 	$obj_request_data = $obj_request_data->whereHas('get_product_details',function($q)use($arr_search_column)
		// 	{
		// 		$q->where('product_id', 'LIKE', "%".$arr_search_column['product_id']."%");
		// 	});
		// }

		
		$obj_request_data = $obj_request_data->get();
		$json_result 	= DataTables::of($obj_request_data)->make(true);
		$build_result 	= $json_result->getData();

		if(isset($build_result->data) && sizeof($build_result->data)>0)
		{
			foreach ($build_result->data as $key => $data) 
			{
				// $edit_link_url_product    = $this->module_url_path.'/delete_agent_product/'.base64_encode($data->id);
				$edit_link_url    = "javascript:void(0)";
				
				$arr_roles = [];

				$action_button_html = '<a  title="" href="'.$edit_link_url.'" data-original-title="Delete" data-id="'.$data->id.'" id="open_edit_discount_modal"><i class="fa fa-cog"></i></a>';
				
				$id 	    				= isset($data->id)? base64_encode($data->id):'';
				$category_name 				= isset($data->get_category_details->english_name)? $data->get_category_details->english_name :'';
				$status 					= isset($data->status)? $data->status :'-';
				
				$i = $key+1;

				$build_result->data[$key]->id         		    = $id;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->category_name      	= $category_name;
				$build_result->data[$key]->built_action_btns    = $action_button_html;
				
			}
			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
	}


	// get discount categories : AUTHOR (Harsh chauhan)
    public function get_category_discount($enc_id)
    {
    	$arr_data = $arr_resp = $arr_selected_products = $arr_agent_products = [];

    	$id = base64_decode($enc_id);

    	$obj_data = $this->CustomerCategoryDiscountModel->with('get_category_details')->where('id',$id)->first();

    	if($obj_data){
    		$arr_data = $obj_data->toArray();
    	}

		if($arr_data){
			$arr_resp['status']  	= 'success';
			$arr_resp['msg']  		= 'success';
			$arr_resp['data'] 		= $arr_data;
			return $arr_resp;
		}

		$arr_resp['status'] 	= 'error';
		$arr_resp['msg']  		= 'Something went wrong.';
		return $arr_resp;

    }

    // delete agent product : AUTHOR (Harsh chauhan)
    public function delete_agent_product($enc_id){
    	$id = base64_decode($enc_id);

    	$obj_agent = $this->AgentProductsModel->where('id',$id)->first();

    	$agent_id  = isset($obj_agent->agent_id)   ? $obj_agent->agent_id :'';

    	$obj_delete = $this->AgentProductsModel->where('id',$id)->delete();

    	if($obj_delete){
    		Session::flash('success', 'Product deleted successfully from agent.');
			return redirect($this->module_url_path."/edit_agent/".base64_encode($agent_id));
    	}else{
    		Session::flash('error', 'Something went wrong.');
			return redirect($this->module_url_path."/edit_agent/".base64_encode($agent_id));
    	}
    }

    // update Customer discount : AUTHOR (Harsh chauhan)
    public function update_customer_discount(Request $request)
    {
    	$arr_data = $arr_rules = [];

		$id = $request->input('pcategorydiscount_id');
    	$arr_rules['pdiscount']      	= "required";
		$arr_rules['pcategory_id']      = "required";

		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$customer_id = $request->input('pcustomer_id', null);

		$arr_data['discount']			=	$request->input('pdiscount', null);		
		
		$status = $this->CustomerCategoryDiscountModel->where('id',$id)->update($arr_data);

    	if($status){
    		Session::flash('success', 'Customer discount updated successfully.');
			return redirect($this->module_url_path.'/edit_customer/'.base64_encode($customer_id));
    	}else{
    		Session::flash('error', 'Something went wrong.');
			return redirect($this->module_url_path.'/edit_customer/'.base64_encode($customer_id));
    	}
    }

    // load Customer orders : AUTHOR (Harsh chauhan)
     public function load_customerorders_data(Request $request,$enc_id)
	{	
		$customer_id = base64_decode($enc_id);
		$build_status_btn       = '';
		$arr_data               = [];
		$arr_search_column     	= $request->input('column_filter');

		$obj_request_data = $this->OrdersModel->with('get_city','get_delivery_type')
											  ->where('customer_id',$customer_id)
											  ->orderBy('created_at','DESC');

		if(isset($arr_search_column['order_id']) && $arr_search_column['order_id']!="")
		{
			$obj_request_data = $obj_request_data->where('order_id', 'LIKE', "%".$arr_search_column['order_id']."%");
		}

		if(isset($arr_search_column['order_total_amount']) && $arr_search_column['order_total_amount']!="")
		{
			$obj_request_data = $obj_request_data->where('order_total_amount', 'LIKE', "%".$arr_search_column['order_total_amount']."%");
		}

		if(isset($arr_search_column['city']) && $arr_search_column['city']!="")
		{
			$obj_request_data = $obj_request_data->whereHas('get_city',function($q)use($arr_search_column)
			{
				$q->where('city_english_name', 'LIKE', "%".$arr_search_column['city']."%");
			});
		}

		if(isset($arr_search_column['delivery_type']) && $arr_search_column['delivery_type']!="")
		{
			$obj_request_data = $obj_request_data->whereHas('get_delivery_type',function($q)use($arr_search_column)
			{
				$q->where('delivery_type_id',$arr_search_column['delivery_type']);
			});
		}

		$obj_request_data = $obj_request_data->get();
		$json_result 	= DataTables::of($obj_request_data)->make(true);
		$build_result 	= $json_result->getData();

		if(isset($build_result->data) && sizeof($build_result->data)>0)
		{
			foreach ($build_result->data as $key => $data) 
			{
				$view_link_url    = url('/')."/admin/orders/edit_printing_orders/".base64_encode($data->id);
				
				$arr_roles = [];

				$action_button_html = '<a  title="" href="'.$view_link_url.'" data-original-title="View" ><i class="fa fa-eye"></i></a>';
				
				$id 	    		= isset($data->id)? base64_encode($data->id):'';
				$order_id 			= isset($data->order_id)? $data->order_id :'';
				$order_total_amount = isset($data->order_total_amount)? $data->order_total_amount :'';
				$city   			= isset($data->get_city->city_english_name)? $data->get_city->city_english_name :'';
				$delivery_type 		= isset($data->get_delivery_type->delivery_type)? $data->get_delivery_type->delivery_type :'-';
				$created_at 		= isset($data->created_at)? get_formated_date($data->created_at) :'';
				
				$i = $key+1;

				$build_result->data[$key]->id         		    = $id;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->order_id           	= $order_id;
				$build_result->data[$key]->order_total_amount   = $order_total_amount;
				$build_result->data[$key]->city         		= $city;
				$build_result->data[$key]->delivery_type        = $delivery_type;
				$build_result->data[$key]->built_action_btns    = $action_button_html;
				
			}
			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
	}


	// load Customer transaction : AUTHOR (Harsh chauhan)
     public function load_customertransaction_data(Request $request,$enc_id)
	{	
		$customer_id = base64_decode($enc_id);
		$build_status_btn       = '';
		$arr_data               = [];
		$arr_search_column     	= $request->input('column_filter');

		$obj_request_data = $this->TransactionsModel->with('get_order_details','get_from_details')
													// ->whereHas('get_order_details',function($q)use($customer_id){
													// 	$q->where('customer_id',$customer_id);
													// })
													->where('customer_id',$customer_id)
													->orderBy('created_at','DESC');

		if(isset($arr_search_column['order_id']) && $arr_search_column['order_id']!="")
		{
			$obj_request_data = $obj_request_data->where('order_id', 'LIKE', "%".$arr_search_column['order_id']."%");
		}

		if(isset($arr_search_column['order_total_amount']) && $arr_search_column['order_total_amount']!="")
		{
			$obj_request_data = $obj_request_data->where('order_total_amount', 'LIKE', "%".$arr_search_column['order_total_amount']."%");
		}

		if(isset($arr_search_column['city']) && $arr_search_column['city']!="")
		{
			$obj_request_data = $obj_request_data->whereHas('get_city',function($q)use($arr_search_column)
			{
				$q->where('city_english_name', 'LIKE', "%".$arr_search_column['city']."%");
			});
		}

		if(isset($arr_search_column['delivery_type']) && $arr_search_column['delivery_type']!="")
		{
			$obj_request_data = $obj_request_data->whereHas('get_delivery_type',function($q)use($arr_search_column)
			{
				$q->where('delivery_type_id',$arr_search_column['delivery_type']);
			});
		}

		$obj_request_data = $obj_request_data->get();
		$json_result 	= DataTables::of($obj_request_data)->make(true);
		$build_result 	= $json_result->getData();

		if(isset($build_result->data) && sizeof($build_result->data)>0)
		{
			foreach ($build_result->data as $key => $data) 
			{
				$view_link_url    = "javascript:void(0)";
				
				$arr_roles = [];

				// $action_button_html = '<a  title="" href="'.$view_link_url.'" data-original-title="View" ><i class="fa fa-eye"></i></a>';
				
				$id 	    		= isset($data->id)? base64_encode($data->id):'';
				$transaction_id 	= isset($data->transaction_id)? $data->transaction_id :'';
				$value 				= isset($data->amount)? $data->amount :'';
				$method   			= isset($data->transaction_type)? $data->transaction_type :'';
				if($method=='order'){
					$method_name = 'Order';
				}elseif ($method=='bank_transfer') {
					$method_name = 'Bank Transfer';
				}elseif($method=='compensate'){
					$method_name = 'Compensate';
				}elseif($method=='deduct'){
					$method_name = 'Deduct';
				}

				if($method){

					$bank_transfer_id =  isset($data->bank_transfer_id)? get_formated_date($data->bank_transfer_id) :'';
				}else{
					$bank_transfer_id = '-';
				}	

				$order_id 			= isset($data->get_order_details->order_id)? $data->get_order_details->order_id :'-';
				$notes 				= isset($data->notes)? $data->notes :'-';
				if($data->done_by_type != 'admin'){

					$done_by 			= isset($data->get_from_details->full_name)? $data->get_from_details->full_name :'-';
				}else{
					$done_by = 'Admin';
				}

				$created_at 		= isset($data->created_at)? get_formated_date($data->created_at) :'';
				
				$i = $key+1;

				$build_result->data[$key]->id         		    = $id;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->transaction_id       = $transaction_id;
				$build_result->data[$key]->value   				= $value;
				$build_result->data[$key]->method_name         	= $method_name;
				$build_result->data[$key]->order_id         	= $order_id;
				$build_result->data[$key]->created_at         	= $created_at;
				$build_result->data[$key]->notes         		= $notes;
				$build_result->data[$key]->done_by        		= $done_by;
				// $build_result->data[$key]->built_action_btns    = $action_button_html;
				
			}
			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
	}

	// get customer orders by id : AUTHOR (Harsh chauhan)
	public function get_customerorder_id(Request $request,$enc_id)
    {
    	$arr_data = $arr_resp = [];
    	$id = base64_decode($enc_id);
    	$obj_data = $this->OrdersModel->select('id','order_id','customer_id')->where('customer_id',$id)->get();

    	if($obj_data){
    		$arr_data = $obj_data->toArray();
    	}

		// $html = "<div class='mobile-drop-section-select'>
		// 			<select name='add_country_id' data-rule-required='true' id='add_country_id' class='form-control'>";

		$html = "<option value='' >Select Order ID</option>";
		foreach ($arr_data as $key => $value) {
			$html .= "<option value=".$value['id']." >".$value['order_id']."</option>";
		}

		// $html .= "</select>
		// 		</div>";
		// $html .= "<div class='mobile-drop-section-input'>
		// 			<input type='text' placeholder='Enter mobile number' id='add_mobile_number' name='add_mobile_number' data-rule-required='true' data-rule-number='true' class='form-control' autocomplete='off'>
		// 			</div>";

		if($arr_data){
			$arr_resp['status']  	= 'success';
			$arr_resp['data'] 		= $html;
		}else{
			$arr_resp['status'] 	= 'error';
			$arr_resp['data'] 		= $html;
		}

		return $arr_resp;
    }


    // transfer amount to Customer bank : AUTHOR (Harsh chauhan)
    public function add_customer_bank_transfer(Request $request)
    {
    	$arr_data = $arr_rules = [];

    	$arr_rules['bank_transfer_amount']      	= "required";
    	$arr_rules['bank_transfer_transaction_id']  = "required";
    	$arr_rules['bank_transfer_notes']      		= "required";
    	$arr_rules['bank_transfer_customer_id']     = "required";

		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$str1 = "0123456789";
        $str2 = str_shuffle($str1);
        $transaction_id = substr($str2,0,6); 

        $customer_id = $request->input('bank_transfer_customer_id', null);

		$arr_data['transaction_id']		=	$transaction_id;	
		$arr_data['amount']				=	$request->input('bank_transfer_amount', null);		
		$arr_data['transaction_type']	=	'bank_transfer';	
		$arr_data['bank_transfer_id']	=	$request->input('bank_transfer_transaction_id', null);		
		$arr_data['notes']				=	$request->input('bank_transfer_notes', null);		
		$arr_data['done_by_id']			=	'1';
		$arr_data['done_by_type']		=	'admin';		
		$arr_data['done_to_id']			=	$request->input('bank_transfer_customer_id', null);		
		$arr_data['done_to_type']		=	'customer';		
		$arr_data['customer_id']		=	$customer_id;		
		
		$status = $this->TransactionsModel->create($arr_data);

    	if($status){
    		Session::flash('success', 'Customer transaction created successfully.');
			return redirect($this->module_url_path.'/edit_customer/'.base64_encode($customer_id));
    	}else{
    		Session::flash('error', 'Something went wrong.');
			return redirect($this->module_url_path.'/edit_customer/'.base64_encode($customer_id));
    	}
    }

    // add  compesnsation : AUTHOR (Harsh chauhan)
    public function add_compensation(Request $request)
    {
    	$arr_data = $arr_rules = $arr_wallet = [];

    	$arr_rules['compensate_amount']      	 = "required";
    	$arr_rules['compensate_validity']  		 = "required";
    	$arr_rules['compensate_notes']      	 = "required";
    	$arr_rules['compensate_order_id']     	 = "required";
    	$arr_rules['compensate_customer_id']     = "required";

		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$str1 = "0123456789";
        $str2 = str_shuffle($str1);
        $transaction_id = substr($str2,0,6); 

        $customer_id = $request->input('compensate_customer_id', null);

		$arr_data['transaction_id']		=	$transaction_id;	
		$arr_data['amount']				=	$request->input('compensate_amount', null);		
		$arr_data['transaction_type']	=	'compensate';	
		$arr_data['notes']				=	$request->input('compensate_notes', null);		
		$arr_data['done_by_id']			=	'1';
		$arr_data['order_id']			=	$request->input('compensate_order_id', null);		
		$arr_data['done_by_type']		=	'admin';		
		$arr_data['done_to_id']			=	$request->input('compensate_customer_id', null);		
		$arr_data['done_to_type']		=	'customer';		
		$arr_data['customer_id']		=	$customer_id;		
		
		$status = $this->TransactionsModel->create($arr_data);

		$arr_wallet['transaction_id'] 	= $status->id; 
		$arr_wallet['customer_id'] 		= $customer_id;
		$arr_wallet['validity'] 		= $request->input('compensate_validity', null);	 
		$arr_wallet['amount'] 			= $request->input('compensate_amount', null);	 

		$status_wallet = $this->CustomerWalletModel->create($arr_wallet);
    	
    	if($status){
    		Session::flash('success', 'Customer transaction created successfully.');
			return redirect($this->module_url_path.'/edit_customer/'.base64_encode($customer_id));
    	}else{
    		Session::flash('error', 'Something went wrong.');
			return redirect($this->module_url_path.'/edit_customer/'.base64_encode($customer_id));
    	}
    }

    // deduct amonunt from customer account : AUTHOR (Harsh chauhan)
    public function deduct_amount(Request $request)
    {
    	$arr_data = $arr_rules = $arr_wallet = [];

    	$arr_rules['deduct_amount_amount']      	 = "required";
    	$arr_rules['deduct_amount_notes']      	 	 = "required";
    	$arr_rules['deduct_amount_order_id']     	 = "required";
    	$arr_rules['deduct_amount_customer_id']      = "required";

		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$str1 = "0123456789";
        $str2 = str_shuffle($str1);
        $transaction_id = substr($str2,0,6); 

        $customer_id = $request->input('deduct_amount_customer_id', null);

		$arr_data['transaction_id']		=	$transaction_id;	
		$arr_data['amount']				=	$request->input('deduct_amount_amount', null);		
		$arr_data['transaction_type']	=	'deduct';	
		$arr_data['notes']				=	$request->input('deduct_amount_notes', null);		
		$arr_data['done_by_id']			=	'1';
		$arr_data['order_id']			=	$request->input('deduct_amount_order_id', null);		
		$arr_data['done_by_type']		=	'admin';		
		$arr_data['done_to_id']			=	$request->input('deduct_amount_customer_id', null);		
		$arr_data['done_to_type']		=	'customer';		
		$arr_data['customer_id']		=	$customer_id;		
		
		$status = $this->TransactionsModel->create($arr_data);
    	
    	if($status){
    		Session::flash('success', 'Customer transaction created successfully.');
			return redirect($this->module_url_path.'/edit_customer/'.base64_encode($customer_id));
    	}else{
    		Session::flash('error', 'Something went wrong.');
			return redirect($this->module_url_path.'/edit_customer/'.base64_encode($customer_id));
    	}
    }
}