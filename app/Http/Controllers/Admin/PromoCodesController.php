<?php



namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\PromoCodesModel;

use App\Models\CategoryModel;

use App\Models\SubCategoryModel;

use App\Models\ProductsModel;

use App\Models\SystemCountryModel;

use App\Models\SystemCityModel;

use App\Common\Services\MailService;

use App\Common\Traits\MultiActionTrait;

use Hash;

use DataTables;

use Validator;

use Session;

use DateTime;

use Carbon;

class PromoCodesController extends Controller

{

    use MultiActionTrait;



    function __construct(MailService $mail_service)

    {

		$this->arr_view_data                = [];

		$this->admin_panel_slug             = config('app.project.admin_panel_slug');

		$this->admin_url_path               = url(config('app.project.admin_panel_slug'));

		$this->module_url_path              = $this->admin_url_path."/promo_codes";

		$this->module_title                 = "Promo Code ";

		$this->module_view_folder           = "admin.promo_codes";

		$this->module_icon                  = "fa fa-user";

		$this->auth                         = auth()->guard('admin');

		$this->BaseModel					= new PromoCodesModel();

		$this->CategoryModel				= new CategoryModel();

		$this->SubCategoryModel				= new SubCategoryModel();

		$this->ProductsModel				= new ProductsModel();

		$this->SystemCountryModel			= new SystemCountryModel();

		$this->SystemCityModel				= new SystemCityModel();



		$this->user_profile_image_base_img_path   = base_path().config('app.project.img_path.user_profile_image');

		$this->user_profile_image_public_img_path = url('/').config('app.project.img_path.user_profile_image');

		$this->agent_invoice_base_img_path   	  = base_path().config('app.project.img_path.agent_invoice');

		$this->agent_invoice_public_img_path      = url('/').config('app.project.img_path.agent_invoice');

    }



    // promo code listing  : AUTHOR (Harsh Chauhan)

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



    // ajax call to load data  : AUTHOR (Harsh Chauhan)

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

				

				$arr_roles = $arr_product_options = [];



				$id 					= isset($data->id)? $data->id :'';

				$code_id 				= isset($data->code_id)? $data->code_id :'';

				$code   				= isset($data->code)? ($data->code) :'';

				$percentage   			= isset($data->percentage)? ($data->percentage) :'';

				$start_date 			= isset($data->start_date)? $data->start_date :'';

				$end_date 				= isset($data->end_date)? $data->end_date :'';

				$start_time 			= isset($data->start_time)? $data->start_time :'';

				$end_time 				= isset($data->end_time)? $data->end_time :'';

				$start    				= $start_date.' '.$start_time;

				$end    				= $end_date.' '.$end_time;

				$today       		    = Carbon\Carbon::now('Asia/Kolkata')->toDateTimeString();

				// dump(new DateTime($end),new DateTime($today));

				// dd(new DateTime($end)>=new DateTime($today));

				if(($start <= $today) && ($end>=$today) ){

					$status = '<span class="label label-success">Active</span>';

				}else{

					$status = '<span class="label label-danger">Expired</span> ';

				}



				$count 					= '520';

				// $status           		= isset($data->status)? get_formated_date($data->status) :'';



				$action_button_html = '<a  title="" href="javascript:void(0)" data-original-title="Pay" data-id="'.$data->id.'" id="open_edit_modal_form_vertical" ><i class="icon-pencil7" title="Edit"></i></a>';



			

				$i = $key+1;

				$build_result->data[$key]->id         		    = $id;

				$build_result->data[$key]->sr_no         		= $i;

				$build_result->data[$key]->code_id       		= $code_id;

				$build_result->data[$key]->code       			= $code;

				$build_result->data[$key]->percentage       	= $percentage;

				$build_result->data[$key]->start_date        	= $start_date;

				$build_result->data[$key]->end_date 			= $end_date;

				$build_result->data[$key]->status       		= $status;

				$build_result->data[$key]->count     			= $count;

				$build_result->data[$key]->built_action_btns    = $action_button_html;

				

			}

			return response()->json($build_result);

		}

		else

		{

			return response()->json($build_result);

		}

	}



	// get common data  : AUTHOR (Harsh Chauhan)

	public function get_data(Request $request)

    {

    

    	$arr_data = $arr_resp = $arr_country = $arr_category = $arr_subcategory = $arr_city = $arr_product = $arr_resp_data = [];



    	$obj_category 		  = $this->CategoryModel->where('status','1')

										 ->get();



    	if($obj_category){

    		$arr_category	  = $obj_category->toArray();

    		$html_category   = "<option value=''>Not selected</option>";

    		foreach ($arr_category as $key => $value) {

    			

    			$html_category    .= "<option value='".$value['id']."'>".$value['english_name']."</option>";

    		}

    	}



    	$obj_subcategory 	  = $this->SubCategoryModel->where('status','1')

										 ->get();



    	if($obj_subcategory){

    		$arr_subcategory	  = $obj_subcategory->toArray();

    		$html_subcategory   = "<option value=''>Not selected</option>";

    		foreach ($arr_subcategory as $key => $value) {

    			

    			$html_subcategory    .= "<option value='".$value['id']."'>".$value['english_name']."</option>";

    		}

    	}



    	$obj_product 	  = $this->ProductsModel->where('status','1')

										 ->get();



		if($obj_product){

    		$arr_product	  = $obj_product->toArray();

    		$html_product   = "<option value=''>Not selected</option>";

    		foreach ($arr_product as $key => $value) {

    			

    			$html_product    .= "<option value='".$value['id']."'>".$value['product_english_name']."</option>";

    		}

    	}



		$obj_sys_country 	  = $this->SystemCountryModel->where('status','1')

										 ->get();



		if($obj_sys_country){

    		$arr_country	  = $obj_sys_country->toArray();

    		$html_country   = "<option value=''>Not selected</option>";

    		foreach ($arr_country as $key => $value) {

    			

    			$html_country    .= "<option value='".$value['id']."'>".$value['country_english_name']."</option>";

    		}

    	}



    	$obj_sys_city 	  = $this->SystemCityModel->where('status','1')

										 ->get();



		if($obj_sys_city){

    		$arr_city	  = $obj_sys_city->toArray();

    		$html_city   = "<option value=''>Not selected</option>";

    		foreach ($arr_city as $key => $value) {

    			

    			$html_city    .= "<option value='".$value['id']."'>".$value['city_english_name']."</option>";

    		}

    	}



    	$arr_resp_data['category']  	    =  $html_category;

    	$arr_resp_data['sub_category']  	=  $html_subcategory;

    	$arr_resp_data['product'] 	   		=  $html_product;

    	$arr_resp_data['sys_country']   	=  $html_country;

    	$arr_resp_data['sys_city']  	    =  $html_city;



		$arr_resp['status']  	= 'success';

		$arr_resp['data'] 		= $arr_resp_data;

		// if($arr_resp_data){

		// }else{

		// 	$arr_resp['status'] 	= 'error';

		// 	$arr_resp['data'] 		= $arr_resp_data;

		// }



		return $arr_resp;

    }



    // get selected category data: AUTHOR (Harsh Chauhan)

	public function get_category_selected_data(Request $request,$enc_id)

    {

    	$category_id    = base64_decode($enc_id);



    	$arr_data = $arr_resp = $arr_country = $arr_category = $arr_subcategory = $arr_city = $arr_product = $arr_resp_data = [];



    	$obj_subcategory 	  = $this->SubCategoryModel->where('category_id',$category_id)

    												   ->where('status','1')

										 			   ->get();



    	if($obj_subcategory){

    		$arr_subcategory	  = $obj_subcategory->toArray();

    		$html_subcategory   = "<option value=''>Not selected</option>";

    		foreach ($arr_subcategory as $key => $value) {

    			

    			$html_subcategory    .= "<option value='".$value['id']."'>".$value['english_name']."</option>";

    		}

    	}



    	$obj_product 	  = $this->ProductsModel->where('category_id',$category_id)

    											->where('status','1')

										 		->get();



		if($obj_product){

    		$arr_product	  = $obj_product->toArray();

    		$html_product   = "<option value=''>Not selected</option>";

    		foreach ($arr_product as $key => $value) {

    			

    			$html_product    .= "<option value='".$value['id']."'>".$value['product_english_name']."</option>";

    		}

    	}



		



    	

    	$arr_resp_data['sub_category']  	=  $html_subcategory;

    	$arr_resp_data['product'] 	   		=  $html_product;

    	



		$arr_resp['status']  	= 'success';

		$arr_resp['data'] 		= $arr_resp_data;

		// if($arr_resp_data){

		// }else{

		// 	$arr_resp['status'] 	= 'error';

		// 	$arr_resp['data'] 		= $arr_resp_data;

		// }



		return $arr_resp;

    }





	// get selected sub-category data: AUTHOR (Harsh Chauhan)

	public function get_subcategory_selected_data(Request $request,$enc_id)

    {

    	$subcategory_id    = base64_decode($enc_id);



    	$arr_data = $arr_resp = $arr_country = $arr_category = $arr_subcategory = $arr_city = $arr_product = $arr_resp_data = [];





    	$obj_product 	  = $this->ProductsModel->where('subcategory_id',$subcategory_id)

    											->where('status','1')

										 		->get();



		if($obj_product){

    		$arr_product	  = $obj_product->toArray();

    		$html_product   = "<option value=''>Not selected</option>";

    		foreach ($arr_product as $key => $value) {

    			

    			$html_product    .= "<option value='".$value['id']."'>".$value['product_english_name']."</option>";

    		}

    	}



		  	

    	

    	$arr_resp_data['product'] 	   		=  $html_product;

    	



		$arr_resp['status']  	= 'success';

		$arr_resp['data'] 		= $arr_resp_data;

		// if($arr_resp_data){

		// }else{

		// 	$arr_resp['status'] 	= 'error';

		// 	$arr_resp['data'] 		= $arr_resp_data;

		// }



		return $arr_resp;

    }



    // get selected country data: AUTHOR (Harsh Chauhan)

	public function get_country_selected_data(Request $request,$enc_id)

    {

    	$country_id    = base64_decode($enc_id);



    	$arr_data = $arr_resp = $arr_country = $arr_category = $arr_subcategory = $arr_city = $arr_product = $arr_resp_data = [];





    	$obj_sys_city 	  = $this->SystemCityModel->where('system_country_id',$country_id)

    												->where('status','1')

										 			->get();



		if($obj_sys_city){

    		$arr_city	  = $obj_sys_city->toArray();

    		$html_city   = "<option value=''>Not selected</option>";

    		foreach ($arr_city as $key => $value) {

    			

    			$html_city    .= "<option value='".$value['id']."'>".$value['city_english_name']."</option>";

    		}

    	}



    	

    	$arr_resp_data['city'] 	   		=  $html_city;

    	



		$arr_resp['status']  	= 'success';

		$arr_resp['data'] 		= $arr_resp_data;

		// if($arr_resp_data){

		// }else{

		// 	$arr_resp['status'] 	= 'error';

		// 	$arr_resp['data'] 		= $arr_resp_data;

		// }



		return $arr_resp;

    }



    // add new promo code: AUTHOR (Harsh Chauhan)

	 public function add_promo_code(Request $request)

	{

		

		

		$arr_rules      = $arr_data = array();

		$status         = false;



		$arr_rules['add_code']      			= "required";

		$arr_rules['add_percentage']      	   	= "required";

		$arr_rules['add_start_date']      	   	= "required";

		$arr_rules['add_start_time']      	   	= "required";

		$arr_rules['add_end_date']      	   	= "required";

		$arr_rules['add_end_time']      	   	= "required";

	

		$validator = Validator::make($request->all(),$arr_rules);



		if($validator->fails()) 

		{

			return redirect()->back()->withErrors($validator)->withInput();

		}



		$checkbox_total_spend_in_code =  $request->input('add_checkbox_total_spend_in_code', null);



		if($checkbox_total_spend_in_code && $checkbox_total_spend_in_code!=null){

			$checkbox_total_spend_in_code = 'yes';

		}else{

			$checkbox_total_spend_in_code = 'no';



		}	





		$checkbox_min_cart_value =  $request->input('add_checkbox_min_cart_value', null);

		if($checkbox_min_cart_value && $checkbox_min_cart_value!=null){

			$checkbox_min_cart_value = 'yes';

		}else{

			$checkbox_min_cart_value = 'no';

		}



		$checkbox_cash_back_percentage =  $request->input('add_checkbox_cash_back_percentage', null);

		if($checkbox_cash_back_percentage && $checkbox_cash_back_percentage!=null){

			$checkbox_cash_back_percentage = 'yes';

		}else{

			$checkbox_cash_back_percentage = 'no';

		}



		$checkbox_max_cart_value =  $request->input('add_checkbox_max_cart_value', null);

		if($checkbox_max_cart_value && $checkbox_max_cart_value!=null){

			$checkbox_max_cart_value = 'yes';

		}else{

			$checkbox_max_cart_value = 'no';

		}



		$checkbox_cash_back_validity =  $request->input('add_checkbox_cash_back_validity', null);

		if($checkbox_cash_back_validity && $checkbox_cash_back_validity!=null){

			$checkbox_cash_back_validity = 'yes';

		}else{

			$checkbox_cash_back_validity = 'no';

		}



		$checkbox_max_used_time =  $request->input('add_checkbox_max_used_time', null);

		if($checkbox_max_used_time && $checkbox_max_used_time!=null){

			$checkbox_max_used_time = 'yes';

		}else{

			$checkbox_max_used_time = 'no';

		}



		$checkbox_country =  $request->input('add_checkbox_country', null);

		if($checkbox_country && $checkbox_country!=null){

			$checkbox_country = 'yes';

		}else{

			$checkbox_country = 'no';

		}



		$limit_first_order =  $request->input('add_limit_first_order', null);

		if($limit_first_order && $limit_first_order!=null){

			$limit_first_order = 'yes';

		}else{

			$limit_first_order = 'no';

		}





		$limit_one_customer =  $request->input('add_limit_one_customer', null);

		if($limit_one_customer && $limit_one_customer!=null){

			$limit_one_customer = 'yes';

		}else{

			$limit_one_customer = 'no';

		}



		$free_delivery =  $request->input('add_free_delivery', null);

		if($free_delivery && $free_delivery!=null){

			$free_delivery = 'yes';

		}else{

			$free_delivery = 'no';

		}



		$exclude_discounted_product =  $request->input('add_exclude_discounted_product', null);

		if($exclude_discounted_product && $exclude_discounted_product!=null){

			$exclude_discounted_product = 'yes';

		}else{

			$exclude_discounted_product = 'no';

		}





		

        $str1 = "0123456789";

        $str2 = str_shuffle($str1);

        $code_id = substr($str2,0,6); 



		$arr_data['code_id']	    			=   $code_id;

		$arr_data['code']	    				=   $request->input('add_code', null);	

		$arr_data['percentage']    				=   $request->input('add_percentage', null);	

		$arr_data['start_date']	    			=   $request->input('add_start_date', null);	

		// $arr_data['start_time']	   				=   substr($request->input('add_start_time', null),0,strpos($request->input('add_start_time', null), ' '));	

		$arr_data['start_time']	   				=   $request->input('add_start_time', null);	

		$arr_data['end_date']	    			=   $request->input('add_end_date', null);	

		$arr_data['end_time']	    			=   $request->input('add_end_time', null);	

		$arr_data['total_spend_in_code']	    =   $request->input('add_total_spend_in_code', null);	

		$arr_data['flag_total_spend_in_code']   =   $checkbox_total_spend_in_code;

		$arr_data['min_cart_value']    			=   $request->input('add_min_cart_value', null);	

		$arr_data['flag_min_cart_value']	    =   $checkbox_min_cart_value;

		$arr_data['max_cart_value']	    		=   $request->input('add_max_cart_value', null);	

		$arr_data['flag_max_cart_value']	    =   $checkbox_max_cart_value;

		$arr_data['max_used_times']	    		=   $request->input('add_max_used_time', null);	

		$arr_data['flag_max_used_times']	    =   $checkbox_max_used_time;

		$arr_data['cashback_percentage']	    =   $request->input('add_cash_back_percentage', null);	

		$arr_data['flag_cashback_percentage']	=   $checkbox_cash_back_percentage;

		$arr_data['cashback_validity']	        =   $request->input('add_cash_back_validity', null);	

		$arr_data['flag_cashback_validity']	    =   $checkbox_cash_back_validity;	

		$arr_data['system_country_id']	    	=   $request->input('add_country', null);	

		$arr_data['flag_system_country_id']	    =   $checkbox_country;

		$arr_data['limit_code_new_customer']	=   $limit_first_order;

		$arr_data['limit_code_for_one_time_use']	=   $limit_one_customer;

		$arr_data['free_delivery']	    		=   $free_delivery;

		$arr_data['exclude_discounted_products']	=   $exclude_discounted_product;



		$status = $this->BaseModel->create($arr_data);



		if($status)

		{

			Session::flash('success', 'Promo Code added successfully.');

			return redirect($this->module_url_path);

		}



		Session::flash('error', 'Error while adding Promo Code .');

		return redirect($this->module_url_path);

	}





	// get promo code data: AUTHOR (Harsh Chauhan)

	public function get_promo_code_data(Request $request,$enc_id)

    {

    	$id = base64_decode($enc_id);



    	$arr_data = $arr_resp = $arr_country = $arr_category = $arr_subcategory = $arr_city = $arr_product = $arr_resp_data = [];



    	$obj_promo_code        = $this->BaseModel->where('id',$id)->first();



    	if($obj_promo_code){

    		$arr_promo_code    = $obj_promo_code->toArray();

    	}





		$obj_sys_country 	  = $this->SystemCountryModel->where('status','1')

										 ->get();



		if($obj_sys_country){

    		$arr_country	  = $obj_sys_country->toArray();

    		$html_country   = "<option value=''>Not selected</option>";

    		foreach ($arr_country as $key => $value) {

    			

    			$html_country    .= "<option value='".$value['id']."'  ";

    								if($value['id']==$arr_promo_code['system_country_id']){

    									$html_country .= 'selected';

    								}

    			$html_country    .= '>'.$value['country_english_name'].'</option>';

    		}

    	}





    	$arr_resp_data['arr_promo_code']  	    =  $arr_promo_code;

    	$arr_resp_data['sys_country']   		=  $html_country;



		$arr_resp['status']  	= 'success';

		$arr_resp['data'] 		= $arr_resp_data;

		// if($arr_resp_data){

		// }else{

		// 	$arr_resp['status'] 	= 'error';

		// 	$arr_resp['data'] 		= $arr_resp_data;

		// }



		return $arr_resp;

    }



    // edit promo code : AUTHOR (Harsh Chauhan)

    public function edit_promo_code(Request $request)

	{

		// dd($request->all());

		$id = base64_decode($request->input('enc_id'));

		

		$arr_rules      = $arr_data = array();

		$status         = false;



		$arr_rules['edit_code']      			= "required";

		$arr_rules['edit_percentage']      	   	= "required";

		$arr_rules['edit_start_date']      	   	= "required";

		$arr_rules['edit_start_time']      	   	= "required";

		$arr_rules['edit_end_date']      	   	= "required";

		$arr_rules['edit_end_time']      	   	= "required";

	

		$validator = Validator::make($request->all(),$arr_rules);



		if($validator->fails()) 

		{

			return redirect()->back()->withErrors($validator)->withInput();

		}



		$checkbox_total_spend_in_code =  $request->input('edit_checkbox_total_spend_in_code', null);



		if($checkbox_total_spend_in_code && $checkbox_total_spend_in_code!=null){

			$checkbox_total_spend_in_code = 'yes';

		}else{

			$checkbox_total_spend_in_code = 'no';



		}	





		$checkbox_min_cart_value =  $request->input('edit_checkbox_min_cart_value', null);

		if($checkbox_min_cart_value && $checkbox_min_cart_value!=null){

			$checkbox_min_cart_value = 'yes';

		}else{

			$checkbox_min_cart_value = 'no';

		}



		$checkbox_cash_back_percentage =  $request->input('edit_checkbox_cash_back_percentage', null);

		if($checkbox_cash_back_percentage && $checkbox_cash_back_percentage!=null){

			$checkbox_cash_back_percentage = 'yes';

		}else{

			$checkbox_cash_back_percentage = 'no';

		}



		$checkbox_max_cart_value =  $request->input('edit_checkbox_max_cart_value', null);

		if($checkbox_max_cart_value && $checkbox_max_cart_value!=null){

			$checkbox_max_cart_value = 'yes';

		}else{

			$checkbox_max_cart_value = 'no';

		}



		$checkbox_cash_back_validity =  $request->input('edit_checkbox_cash_back_validity', null);

		if($checkbox_cash_back_validity && $checkbox_cash_back_validity!=null){

			$checkbox_cash_back_validity = 'yes';

		}else{

			$checkbox_cash_back_validity = 'no';

		}



		$checkbox_max_used_time =  $request->input('edit_checkbox_max_used_time', null);

		if($checkbox_max_used_time && $checkbox_max_used_time!=null){

			$checkbox_max_used_time = 'yes';

		}else{

			$checkbox_max_used_time = 'no';

		}



		$checkbox_country =  $request->input('edit_checkbox_country', null);

		if($checkbox_country && $checkbox_country!=null){

			$checkbox_country = 'yes';

		}else{

			$checkbox_country = 'no';

		}



		$limit_first_order =  $request->input('edit_limit_first_order', null);

		if($limit_first_order && $limit_first_order!=null){

			$limit_first_order = 'yes';

		}else{

			$limit_first_order = 'no';

		}





		$limit_one_customer =  $request->input('edit_limit_one_customer', null);

		if($limit_one_customer && $limit_one_customer!=null){

			$limit_one_customer = 'yes';

		}else{

			$limit_one_customer = 'no';

		}



		$free_delivery =  $request->input('edit_free_delivery', null);

		if($free_delivery && $free_delivery!=null){

			$free_delivery = 'yes';

		}else{

			$free_delivery = 'no';

		}



		$exclude_discounted_product =  $request->input('edit_exclude_discounted_product', null);

		if($exclude_discounted_product && $exclude_discounted_product!=null){

			$exclude_discounted_product = 'yes';

		}else{

			$exclude_discounted_product = 'no';

		}





		

        $str1 = "0123456789";

        $str2 = str_shuffle($str1);

        $code_id = substr($str2,0,6); 



		$arr_data['code_id']	    			=   $code_id;

		$arr_data['code']	    				=   $request->input('edit_code', null);	

		$arr_data['percentage']    				=   $request->input('edit_percentage', null);	

		$arr_data['start_date']	    			=   $request->input('edit_start_date', null);	

		// $arr_data['start_time']	   				=   substr($request->input('edit_start_time', null),0,strpos($request->input('edit_start_time', null), ' '));	

		$arr_data['start_time']	   				=   $request->input('edit_start_time', null);	

		$arr_data['end_date']	    			=   $request->input('edit_end_date', null);	

		$arr_data['end_time']	    			=   $request->input('edit_end_time', null);	

		$arr_data['total_spend_in_code']	    =   $request->input('edit_total_spend_in_code', null);	

		$arr_data['flag_total_spend_in_code']   =   $checkbox_total_spend_in_code;

		$arr_data['min_cart_value']    			=   $request->input('edit_min_cart_value', null);	

		$arr_data['flag_min_cart_value']	    =   $checkbox_min_cart_value;

		$arr_data['max_cart_value']	    		=   $request->input('edit_max_cart_value', null);	

		$arr_data['flag_max_cart_value']	    =   $checkbox_max_cart_value;

		$arr_data['max_used_times']	    		=   $request->input('edit_max_used_time', null);	

		$arr_data['flag_max_used_times']	    =   $checkbox_max_used_time;

		$arr_data['cashback_percentage']	    =   $request->input('edit_cash_back_percentage', null);	

		$arr_data['flag_cashback_percentage']	=   $checkbox_cash_back_percentage;

		$arr_data['cashback_validity']	        =   $request->input('edit_cash_back_validity', null);	

		$arr_data['flag_cashback_validity']	    =   $checkbox_cash_back_validity;	

		$arr_data['system_country_id']	    	=   $request->input('edit_country', null);	

		$arr_data['flag_system_country_id']	    =   $checkbox_country;

		$arr_data['limit_code_new_customer']	=   $limit_first_order;

		$arr_data['limit_code_for_one_time_use']	=   $limit_one_customer;

		$arr_data['free_delivery']	    		=   $free_delivery;

		$arr_data['exclude_discounted_products']	=   $exclude_discounted_product;



		$status = $this->BaseModel->where('id',$id)->update($arr_data);



		if($status)

		{

			Session::flash('success', 'Promo Code added successfully.');

			return redirect($this->module_url_path);

		}



		Session::flash('error', 'Error while adding Promo Code .');

		return redirect($this->module_url_path);

	}



}