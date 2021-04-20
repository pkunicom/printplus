<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AgentModel;
use App\Models\CountryModel;
use App\Models\SystemCountryModel;
use App\Models\SystemCityModel;
use App\Models\AgentContactDetailsModel;
use App\Models\AgentDocumentsModel;
use App\Models\AgentBankDetailsModel;
use App\Models\AgentProductsModel;
use App\Models\ProductsModel;
use App\Models\AgentInvoiceModel;
use App\Common\Services\MailService;
use App\Common\Traits\MultiActionTrait;
use Hash;
use DataTables;
use Validator;
use Session;
use File;
class AgentManagementController extends Controller
{
    use MultiActionTrait;

    function __construct(MailService $mail_service)
    {
		$this->arr_view_data                = [];
		$this->admin_panel_slug             = config('app.project.admin_panel_slug');
		$this->admin_url_path               = url(config('app.project.admin_panel_slug'));
		$this->module_url_path              = $this->admin_url_path."/agent";
		$this->module_title                 = "Agent";
		$this->module_view_folder           = "admin.agent";
		$this->module_icon                  = "fa fa-user";
		$this->auth                         = auth()->guard('admin');
		$this->BaseModel					= new AgentModel();
		$this->CountryModel					= new CountryModel();
		$this->SystemCountryModel			= new SystemCountryModel();
		$this->SystemCityModel				= new SystemCityModel();
		$this->AgentContactDetailsModel		= new AgentContactDetailsModel();
		$this->AgentDocumentsModel			= new AgentDocumentsModel();
		$this->AgentBankDetailsModel		= new AgentBankDetailsModel();
		$this->AgentProductsModel			= new AgentProductsModel();
		$this->ProductsModel				= new ProductsModel();
		$this->AgentInvoiceModel			= new AgentInvoiceModel();

		$this->user_profile_image_base_img_path   = base_path().config('app.project.img_path.user_profile_image');
		$this->user_profile_image_public_img_path = url('/').config('app.project.img_path.user_profile_image');
		$this->agent_documents_base_img_path   	  = base_path().config('app.project.img_path.agent_documents');
		$this->agent_documents_public_img_path    = url('/').config('app.project.img_path.agent_documents');
		$this->agent_invoice_base_img_path   	  = base_path().config('app.project.img_path.agent_invoice');
		$this->agent_invoice_public_img_path      = url('/').config('app.project.img_path.agent_invoice');
    }

    // Agent index : AUTHOR (Harsh chauhan) 
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

    // agent load data: AUTHOR (Harsh chauhan) 
    public function load_data(Request $request)
	{	
		$build_status_btn       = '';
		$arr_data               = [];
		$arr_search_column     	= $request->input('column_filter');

		$obj_request_data = $this->BaseModel->orderBy('created_at','DESC');

		if(isset($arr_search_column['full_name']) && $arr_search_column['full_name']!="")
		{
			$obj_request_data = $obj_request_data->where('full_name', 'LIKE',"%".$arr_search_column['full_name']."%");
		}

		if(isset($arr_search_column['email']) && $arr_search_column['email']!="")
		{
			$obj_request_data = $obj_request_data->where('email', 'LIKE',"%".$arr_search_column['email']."%");
		}

		if(isset($arr_search_column['agency_name']) && $arr_search_column['agency_name']!="")
		{
			$obj_request_data = $obj_request_data->where('agency_name', 'LIKE',"%".$arr_search_column['agency_name']."%");
		}

		if(isset($arr_search_column['mobile_number']) && $arr_search_column['mobile_number']!="")
		{
			$obj_request_data = $obj_request_data->where('mobile_number','LIKE',"%".$arr_search_column['mobile_number']."%");
		}

		if(isset($arr_search_column['agency_id']) && $arr_search_column['agency_id']!="")
		{
			$obj_request_data = $obj_request_data->where('id',$arr_search_column['agency_id']);
		}

		$obj_request_data = $obj_request_data->get();

		$json_result 	= DataTables::of($obj_request_data)->make(true);
		$build_result 	= $json_result->getData();

		if(isset($build_result->data) && sizeof($build_result->data)>0)
		{
			foreach ($build_result->data as $key => $data) 
			{
				$edit_link_url    = $this->module_url_path.'/edit_agent/'.base64_encode($data->id);
				// $view_link_url    = "javascript:void(0)";
				
				$arr_roles = [];

				$action_button_html = '<a  title="" href="'.$edit_link_url.'" data-original-title="View" data-id="'.$data->id.'" id="open_edit_staff_modal"><i class="fa fa-cog"></i></a>';
				
				$id 	    	= isset($data->id)? base64_encode($data->id):'';
				$agency_id 		= isset($data->id)? $data->id :'';
				$full_name 		= isset($data->full_name)? $data->full_name :'';
				$email 	    	= isset($data->email)? $data->email :'';
				$mobile_number  = isset($data->mobile_number)? $data->mobile_number :'-';
				$agency_name    = isset($data->agency_name)? $data->agency_name :'-';
				$status 		= isset($data->status)? $data->status :'-';
				if($status==1){
					$status = 'Active';
				}else{
					$status = 'Blocked';
				}
				$i = $key+1;

				$build_result->data[$key]->id         		    = $id;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->agent_id             = $agency_id;
				$build_result->data[$key]->full_name            = $full_name;
				$build_result->data[$key]->email                = $email;
				$build_result->data[$key]->mobile_number        = $mobile_number;
				$build_result->data[$key]->agency_name        	= $agency_name;
				$build_result->data[$key]->built_action_btns    = $action_button_html;
				
			}
			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
	}

	// get all countries: AUTHOR (Harsh chauhan)
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

    // get all cities data: AUTHOR (Harsh chauhan)
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

    // edit agent : AUTHOR (Harsh chauhan)
    public function edit_agent(Request $request,$enc_id)
    {
    	$arr_data = $arr_sys_city = $arr_sys_country = $arr_country = [];

    	$id = base64_decode($enc_id);

    	$obj_data = $this->BaseModel->with('get_bank_details','get_contact_details','get_documents_details')->where('id',$id)->first();

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

    	$obj_country = $this->CountryModel->select('id','country_code')->get();
    	if($obj_country){
    		$arr_country = $obj_country->toArray();
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
		$this->arr_view_data['agent_documents_base_img_path']    		= $this->agent_documents_base_img_path;
		$this->arr_view_data['agent_documents_public_img_path']    		= $this->agent_documents_public_img_path;
		$this->arr_view_data['user_profile_image_base_img_path']    	= $this->user_profile_image_base_img_path;
		$this->arr_view_data['user_profile_image_public_img_path']    	= $this->user_profile_image_public_img_path;
		
		return view($this->module_view_folder.'.edit',$this->arr_view_data);
    }

    // store new agent : AUTHOR (Harsh chauhan)
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
		$arr_agent_contact['country_id_one_flag'] 	= $request->input('country_id_one_flag', null);	
		$arr_agent_contact['mobile_one'] 		= $request->input('mobile_number_one', null);	
		$arr_agent_contact['contact_two'] 		= $request->input('contact_two', null);	
		$arr_agent_contact['email_two'] 		= $request->input('email_two', null);	
		$arr_agent_contact['country_id_two'] 	= $request->input('country_id_two', null);	
		$arr_agent_contact['country_id_two_flag'] 	= $request->input('country_id_two_flag', null);	
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

	// update  agent detail : AUTHOR (Harsh chauhan)
	public function update_agent(Request $request,$enc_id)
	{
		// dd($request->all());
		$enc_id = base64_decode($enc_id);

		$arr_rules      = $arr_data = $arr_agent_document =array();
		$status         = false;

		$arr_rules['agency_name']      	= "required";
		$arr_rules['contact_name']      = "required";
		$arr_rules['country']      	   	= "required";
		$arr_rules['contact_one']      	= "required";
		$arr_rules['city']      		= "required";
		$arr_rules['email_one']      	= "required";
		$arr_rules['address']      		= "required";
		$arr_rules['country_id_one']    = "required";
		$arr_rules['mobile_number_one'] = "required";

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
		
		$create_agent = $this->BaseModel->where('id',$enc_id)->update($arr_data);

		$arr_agent_contact['agent_id'] 			= isset($enc_id) ? $enc_id :'';	
		$arr_agent_contact['contact_one'] 		= $request->input('contact_one', null);	
		$arr_agent_contact['email_one'] 		= $request->input('email_one', null);	
		$arr_agent_contact['country_id_one'] 	= $request->input('country_id_one', null);	
		$arr_agent_contact['country_id_one_flag'] 	= $request->input('country_id_one_flag', null);	
		$arr_agent_contact['mobile_one'] 		= $request->input('mobile_number_one', null);	
		$arr_agent_contact['contact_two'] 		= $request->input('contact_two', null);	
		$arr_agent_contact['email_two'] 		= $request->input('email_two', null);	
		$arr_agent_contact['country_id_two'] 	= $request->input('country_id_two', null);	
		$arr_agent_contact['country_id_two_flag'] 	= $request->input('country_id_two_flag', null);	
		$arr_agent_contact['mobile_two']		= $request->input('mobile_number_two', null);	

		$create_agent_contact = $this->AgentContactDetailsModel->where('agent_id',$enc_id)->update($arr_agent_contact);

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


		$create_agent_documents = $this->AgentDocumentsModel->where('agent_id',$enc_id)->update($arr_agent_document);

		if($create_agent)
		{
			Session::flash('success', 'Agent Updated successfully.');
			return redirect($this->module_url_path);
		}

		Session::flash('error', 'Error while updating Agent.');
		return redirect($this->module_url_path);
	}

	// update agent bank detail: AUTHOR (Harsh chauhan)
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

	// load agent product data: AUTHOR (Harsh chauhan)
	 public function load_agentproducts_data(Request $request,$enc_id)
	{	
		$agent_id = base64_decode($enc_id);
		$build_status_btn       = '';
		$arr_data               = [];
		$arr_search_column     	= $request->input('column_filter');

		$obj_request_data = $this->AgentProductsModel->with(['get_product_details'=>function($q){
														// $q->with('get_subcategory');
													 }])
													 ->where('agent_id',$agent_id)
													 ->orderBy('created_at','DESC');

		if(isset($arr_search_column['product_id']) && $arr_search_column['product_id']!="")
		{
			$obj_request_data = $obj_request_data->whereHas('get_product_details',function($q)use($arr_search_column)
			{
				$q->where('product_id', 'LIKE', "%".$arr_search_column['product_id']."%");
			});
		}

		if(isset($arr_search_column['product_english_name']) && $arr_search_column['product_english_name']!="")
		{
			$obj_request_data = $obj_request_data->whereHas('get_product_details',function($q)use($arr_search_column)
			{
				$q->where('product_english_name', 'LIKE', "%".$arr_search_column['product_english_name']."%");
			});
		}

		if(isset($arr_search_column['product_arabic_name']) && $arr_search_column['product_arabic_name']!="")
		{
			$obj_request_data = $obj_request_data->whereHas('get_product_details',function($q)use($arr_search_column)
			{
				$q->where('product_arabic_name', 'LIKE', "%".$arr_search_column['product_arabic_name']."%");
			});
		}

		$obj_request_data = $obj_request_data->get();
		$json_result 	= DataTables::of($obj_request_data)->make(true);
		$build_result 	= $json_result->getData();

		if(isset($build_result->data) && sizeof($build_result->data)>0)
		{
			foreach ($build_result->data as $key => $data) 
			{
				$delete_link_url_product    = $this->module_url_path.'/delete_agent_product/'.base64_encode($data->id);
				// $view_link_url    = "javascript:void(0)";
				
				$arr_roles = [];

				$action_button_html = '<a  title="" href="'.$delete_link_url_product.'" data-original-title="Delete" data-id="'.$data->id.'" id="open_edit_staff_modal"><i class="fa fa-trash"></i></a>';
				
				$id 	    	= isset($data->id)? base64_encode($data->id):'';
				$product_id 	= isset($data->get_product_details->product_id)? $data->get_product_details->product_id :'';
				$product_english_name 		= isset($data->get_product_details->product_english_name)? $data->get_product_details->product_english_name :'';
				$product_arabic_name 		= isset($data->get_product_details->product_arabic_name)? $data->get_product_details->product_arabic_name :'';
				// $sub_category    = isset($data->get_product_details->get_subcategory->sub_category_name)? $data$data->get_product_details->get_subcategory->sub_category_name :'-';
				$sub_category   = 'test';
				$status 		= isset($data->status)? $data->status :'-';
				
				$i = $key+1;

				$build_result->data[$key]->id         		    = $id;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->product_id           = $product_id;
				$build_result->data[$key]->product_english_name = $product_english_name;
				$build_result->data[$key]->product_arabic_name  = $product_arabic_name;
				$build_result->data[$key]->sub_category         = $sub_category;
				$build_result->data[$key]->built_action_btns    = $action_button_html;
				
			}
			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
	}


	// get agent products: AUTHOR (Harsh chauhan)
    public function get_products($enc_id)
    {
    	$arr_data = $arr_resp = $arr_selected_products = $arr_agent_products = [];

    	$id = base64_decode($enc_id);

    	$obj_agent_products = $this->AgentProductsModel->get();

    	if($obj_agent_products){
    		$arr_agent_products = $obj_agent_products->toArray();

    		foreach ($arr_agent_products as $key => $value) {
    			$arr_selected_products[] =  $value['product_id'];
    		}
    	}	

    	$obj_data = $this->ProductsModel->select('id','product_english_name','status')->where('status','1')
    									->whereNotIn('id', $arr_selected_products)
    									->get();


    	if($obj_data){
    		$arr_data = $obj_data->toArray();
    	}

		$html = "<option value='' >Select Product</option>";
		foreach ($arr_data as $key => $value) {
			$html .= "<option value=".$value['id']." >".$value['product_english_name']."</option>";
		}

		if($arr_data){
			$arr_resp['status']  	= 'success';
			$arr_resp['msg']  		= 'success';
			$arr_resp['data'] 		= $html;
			return $arr_resp;
		}else{
			$arr_resp['status'] 	= 'error';
			$arr_resp['msg']  		= 'All products are already added.';
			$arr_resp['data'] 		= $html;
			return $arr_resp;
		}
		$arr_resp['status'] 	= 'error';
		$arr_resp['msg']  		= 'Something went wrong.';
		return $arr_resp;

    }

    // delete agent product  : AUTHOR (Harsh chauhan)
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

    // store agent product: AUTHOR (Harsh chauhan)
    public function store_agent_product(Request $request)
    {
    	$arr_data = $arr_rules = [];

    	$arr_rules['product']      	= "required";
		$arr_rules['agent_id']      = "required";

		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$agent_id = $request->input('agent_id', null);

		$arr_data['product_id']		=	$request->input('product', null);	
		$arr_data['agent_id']		=	$agent_id;	
		
		$create_agent_product = $this->AgentProductsModel->create($arr_data);

    	if($create_agent_product){
    		Session::flash('success', 'Product Added successfully to Agent .');
			return redirect($this->module_url_path.'/edit_agent/'.base64_encode($agent_id));
    	}else{
    		Session::flash('error', 'Something went wrong.');
			return redirect($this->module_url_path.'/edit_agent/'.base64_encode($agent_id));
    	}
    }

    // load agent invoices data: AUTHOR (Harsh chauhan)
     public function load_agentinvoice_data(Request $request,$enc_id)
	{	
		$agent_id = base64_decode($enc_id);
		$build_status_btn       = '';
		$arr_data               = [];
		$arr_search_column     	= $request->input('column_filter');

		$obj_request_data = $this->AgentInvoiceModel->where('agent_id',$agent_id)
													 ->orderBy('created_at','DESC');

		// if(isset($arr_search_column['product_id']) && $arr_search_column['product_id']!="")
		// {
		// 	$obj_request_data = $obj_request_data->whereHas('get_product_details',function($q)use($arr_search_column)
		// 	{
		// 		$q->where('product_id', 'LIKE', "%".$arr_search_column['product_id']."%");
		// 	});
		// }

		// if(isset($arr_search_column['product_english_name']) && $arr_search_column['product_english_name']!="")
		// {
		// 	$obj_request_data = $obj_request_data->whereHas('get_product_details',function($q)use($arr_search_column)
		// 	{
		// 		$q->where('product_english_name', 'LIKE', "%".$arr_search_column['product_english_name']."%");
		// 	});
		// }

		// if(isset($arr_search_column['product_arabic_name']) && $arr_search_column['product_arabic_name']!="")
		// {
		// 	$obj_request_data = $obj_request_data->whereHas('get_product_details',function($q)use($arr_search_column)
		// 	{
		// 		$q->where('product_arabic_name', 'LIKE', "%".$arr_search_column['product_arabic_name']."%");
		// 	});
		// }

		$obj_request_data = $obj_request_data->get();
		$json_result 	= DataTables::of($obj_request_data)->make(true);
		$build_result 	= $json_result->getData();

		if(isset($build_result->data) && sizeof($build_result->data)>0)
		{
			foreach ($build_result->data as $key => $data) 
			{
				// $view_link_url    = "javascript:void(0)";

				if(isset($data->invoice_file) ){
					$download_link_url_product    = $this->agent_invoice_public_img_path.'/'.$data->invoice_file;
				}else{
					$download_link_url_product = 'javascript:void(0)';
				}
				
				$arr_roles = [];

				$action_button_html = '<a  title="" href="'.$download_link_url_product.'" data-original-title="Download" download><i class="fa fa-download"></i></a>';
				
				$id 	    	= isset($data->id)? base64_encode($data->id):'';
				$invoice_id 	= isset($data->invoice_id)? $data->invoice_id :'';
				$created_at 	= isset($data->created_at)? get_formated_date($data->created_at) :'';
				$invoice_amount = isset($data->invoice_amount)? $data->invoice_amount :'';
				$total_orders   = isset($data->total_orders)? $data->total_orders :'';
				$reorders 		= isset($data->reorders)? $data->reorders :'-';
				$payment_status = isset($data->payment_status)? $data->payment_status :'-';
				$payment_date 	= isset($data->payment_date)? $data->payment_date :'-';
				
				$i = $key+1;

				$build_result->data[$key]->id         		    = $id;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->invoice_id           = $invoice_id;
				$build_result->data[$key]->created_at 			= $created_at;
				$build_result->data[$key]->invoice_amount  		= $invoice_amount;
				$build_result->data[$key]->total_orders         = $total_orders;
				$build_result->data[$key]->reorders        		= $reorders;
				$build_result->data[$key]->payment_status       = $payment_status;
				$build_result->data[$key]->payment_date         = $payment_date;
				$build_result->data[$key]->built_action_btns    = $action_button_html;
				
			}
			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
	}
}