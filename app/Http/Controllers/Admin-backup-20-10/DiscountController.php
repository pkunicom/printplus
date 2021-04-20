<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DiscountModel;
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
class DiscountController extends Controller
{
    use MultiActionTrait;

    function __construct(MailService $mail_service)
    {
		$this->arr_view_data                = [];
		$this->admin_panel_slug             = config('app.project.admin_panel_slug');
		$this->admin_url_path               = url(config('app.project.admin_panel_slug'));
		$this->module_url_path              = $this->admin_url_path."/discounts";
		$this->module_title                 = "Discount ";
		$this->module_view_folder           = "admin.discount";
		$this->module_icon                  = "fa fa-user";
		$this->auth                         = auth()->guard('admin');
		$this->BaseModel					= new DiscountModel();
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
    //Discount index: AUTHOR (Harsh chauhan)
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
    //load Discount data: AUTHOR (Harsh chauhan)
    public function load_data(Request $request)
	{	
		$build_status_btn       = '';
		$arr_data               = [];
		$arr_search_column     	= $request->input('column_filter');

		$obj_request_data = $this->BaseModel->with('get_product_details')->orderBy('created_at','DESC');

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
				$discount_id 			= isset($data->discount_id)? $data->discount_id :'';
				$product_name   		= isset($data->get_product_details->product_english_name)? $data->get_product_details->product_english_name :'-';
				$percentage   			= isset($data->percentage)? get_formated_date($data->percentage) :'';
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
					$status = 'Active';
				}else{
					$status = 'Expired';
				}

				$count 					= '520';
				// $status           		= isset($data->status)? get_formated_date($data->status) :'';

				$action_button_html = '<a  title="" href="javascript:void(0)" data-original-title="Pay" data-id="'.$data->id.'" id="open_edit_modal_form_vertical" ><i class="fa fa-cog" title="Edit"></i></a>';

			
				$i = $key+1;
				$build_result->data[$key]->id         		    = $id;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->discount_id       	= $discount_id;
				$build_result->data[$key]->product_name       	= $product_name;
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

	//get all common data: AUTHOR (Harsh chauhan)
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
    		// foreach ($arr_subcategory as $key => $value) {
    			
    		// 	$html_subcategory    .= "<option value='".$value['id']."'>".$value['english_name']."</option>";
    		// }
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

    //get selected category data: AUTHOR (Harsh chauhan)
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

    //get selected sub category data: AUTHOR (Harsh chauhan)
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

    //get selected country data: AUTHOR (Harsh chauhan)
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


    //add new discount: AUTHOR (Harsh chauhan)
	 public function add_discount(Request $request)
	{
		
		
		$arr_rules      = $arr_data = array();
		$status         = false;

		$arr_rules['add_percentage']      	= "required";
		$arr_rules['add_start_date']      	   	= "required";
		$arr_rules['add_start_time']      	   	= "required";
		$arr_rules['add_end_date']      	   	= "required";
		$arr_rules['add_end_time']      	   	= "required";
	
	
		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$product_id = $request->input('add_product', null);	

		$obj_check = $this->BaseModel->where('product_id',$product_id)->first();

		if($obj_check){
			Session::flash('error', 'Discount of product already exists.');
			return redirect($this->module_url_path);
		}

		$limit_customer =  $request->input('limit_customer', null);

		if($limit_customer && $limit_customer!=null){
			$limit_customer = 'yes';
		}else{
			$limit_customer = 'no';

		}	


		$delivery_service =  $request->input('delivery_service', null);
		if($delivery_service && $delivery_service!=null){
			$delivery_service = 'yes';
		}else{
			$delivery_service = 'no';
		}

		
        $str1 = "0123456789";
        $str2 = str_shuffle($str1);
        $discount_id = substr($str2,0,6); 

		$arr_data['discount_id']    			=   $discount_id;
		$arr_data['percentage']    				=   $request->input('add_percentage', null);	
		$arr_data['start_date']	    			=   $request->input('add_start_date', null);	
		// $arr_data['start_time']	   				=   substr($request->input('add_start_time', null),0,strpos($request->input('add_start_time', null), ' '));	
		$arr_data['start_time']	   				=   $request->input('add_start_time', null);	
		$arr_data['end_date']	    			=   $request->input('add_end_date', null);	
		$arr_data['end_time']	    			=   $request->input('add_end_time', null);	
		$arr_data['category_id']				=   $request->input('add_category', null);	
		$arr_data['sub_category_id']	    	=   $request->input('add_sub_category', null);	
		$arr_data['product_id']	    			=   $request->input('add_product', null);	
		$arr_data['system_country_id']	    	=   $request->input('add_country', null);	
		$arr_data['system_city_id']	    		=   $request->input('add_city', null);	
		$arr_data['delivery_service']	    	=   $delivery_service;
		$arr_data['first_order_new_customer']	=   $limit_customer;


		$status = $this->BaseModel->create($arr_data);

		if($status)
		{
			Session::flash('success', 'Discount added successfully.');
			return redirect($this->module_url_path);
		}

		Session::flash('error', 'Error while adding Discount.');
		return redirect($this->module_url_path);
	}

	 // public function export_invoices(Request $request)
  //   {   
  //       $arr_data =   $arr_invoices = $arr    = [];

  //       $start_date   = isset($request->start_date) && !empty($request->start_date) ? $request->start_date : '';

  //       $end_date     = isset($request->end_date) && !empty($request->end_date) ? $request->end_date : '';

  //       $obj_invoices = $this->BaseModel->with('get_agent_details')
		// 								   ->get();
  //       if($obj_invoices)
  //       { 
  //       	$arr_invoices    = $obj_invoices->toArray();

  //           $num = 1;
  //           foreach ($arr_invoices as $key => $data) 
  //           {
  //               $build_status_btn = $build_volunteer_btn = '';

  //               if(isset($arr_invoices) && sizeof($arr_invoices)>0)
  //               {   
                  
  //                   $arr_data['id']         	  = $num;
  //                   $arr_data['invoice_id']  	  = isset($data['invoice_id']) && !empty($data['invoice_id']) ? $data['invoice_id']:'-';

  //                   $arr_data['agent'] 			  = isset($data['get_agent_details']['full_name']) && !empty($data['get_agent_details']['full_name'])  ? $data['get_agent_details']['full_name']:'-';  

                 
  //                   $arr_data['created_at']  	  = isset($data['created_at']) && !empty($data['created_at']) ? get_formated_date($data['created_at']):'-'; 

  //                   $arr_data['invoice_amount']	  = $invoice_amount = isset($data['invoice_amount']) && !empty($data['invoice_amount']) ? $data['invoice_amount']:'-'; 
  //                   $arr_data['paid_amount'] 	  = $paid_amount	= isset($data['paid_amount']) && !empty($data['paid_amount']) ? $data['paid_amount']:'-'; 
  //                   $remaining_amount 			  = $invoice_amount - $paid_amount;
  //                   $arr_data['remaining_amount'] =    $remaining_amount; 
  //                   $arr_data['payment_status']   = isset($data['payment_status']) && !empty($data['payment_status']) ? $data['payment_status']:'-'; 
  //                   $arr_data['payment_date']   = isset($data['payment_date']) && !empty($data['payment_date']) ? get_formated_date($data['payment_date']):'-'; 

  //                   array_push($this->arr_view_data, $arr_data);
  //                   $num++;
  //               }
  //           }
  //           if(isset($this->arr_view_data) && !empty($this->arr_view_data))
  //           {  
  //           	// For export as CSV 
  //               // $start_date_month   = date("d_M", strtotime($start_date));
  //               // $end_date_month     = date("d_M", strtotime($end_date));
  //               // $date = Carbon\Carbon::now()->format('Y-m-d'); 
  //               // $filename           = 'Invoices_report_till_'.$date;
  //               // $output = fopen("php://output",'w') or die("Can't open php://output");
  //               // header("Content-Type:application/csv"); 
  //               // header("Content-Disposition:attachment;filename=".$filename.".csv"); 
  //               // fputcsv($output, array('Sr.No','Invoice ID','Agent','Date','Invoice Value','Paid Amount','Remaining Payment','Payment Date'));
  //               // foreach($this->arr_view_data as $product) {
  //               //     fputcsv($output, $product);
  //               // }
  //               // fclose($output) or die("Can't close php://output");

  //               // For export as excel
  //               $table = '<table><tbody><tr><td>Sr.No</td><td>Invoice ID</td><td>Agent</td><td>Date</td><td>Invoice Value</td><td>Paid Amount</td><td>Remaining Payment</td><td>Payment Status</td><td>Payment Date</td></tr>';
		// 		foreach ($this->arr_view_data as $row) {
		// 		    $table.= '<tr><td>'.  implode('</td><td>', $row) . '</td></tr>';
		// 		}
		// 		$table.= '</tbody></table>';

		// 		header('Content-Encoding: UTF-8');
		// 		header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		// 		header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
		// 		header ("Cache-Control: no-cache, must-revalidate");
		// 		header ("Pragma: no-cache");
		// 		header ("Content-type: application/x-msexcel;charset=UTF-8");
		// 		header ("Content-Disposition: attachment; filename=Invoice.xls" );

		// 		echo $table;
  //           }
  //           else
  //           {
  //               Session::flash('error','No data found.');
  //               return redirect()->back();
  //           }
  //       }
  //   }

	//get discount data by id : AUTHOR (Harsh chauhan)
	public function get_discount_data(Request $request,$enc_id)
    {
    	$id = base64_decode($enc_id);

    	$arr_data = $arr_resp = $arr_country = $arr_category = $arr_subcategory = $arr_city = $arr_product = $arr_resp_data = [];

    	$obj_discount        = $this->BaseModel->where('id',$id)->first();

    	if($obj_discount){
    		$arr_discount  = $obj_discount->toArray();
    	}

    	$obj_category 		  = $this->CategoryModel->where('status','1')
										 ->get();

    	if($obj_category){
    		$arr_category	  = $obj_category->toArray();
    		$html_category   = "<option value=''>Not selected</option>";
    		foreach ($arr_category as $key => $value) {
    			
    			$html_category    .= "<option value='".$value['id']."' ";
    								if($value['id']==$arr_discount['category_id']){
    									$html_category .= 'selected';
    									}  

				$html_category .=    '>'.$value['english_name'].'</option>';
    		}
    	}

    	$obj_subcategory 	  = $this->SubCategoryModel->where('status','1')
										 ->get();

    	if($obj_subcategory){
    		$arr_subcategory	  = $obj_subcategory->toArray();
    		$html_subcategory   = "<option value=''>Not selected</option>";
    		foreach ($arr_subcategory as $key => $value) {
    			
    			$html_subcategory    .= "<option value='".$value['id']."' ";
    								if($value['id']==$arr_discount['sub_category_id']){
    									$html_subcategory .= 'selected';
    								}
    			$html_subcategory .=    '>'.$value['english_name'].'</option>';
    		}
    	}

    	$obj_product 	  = $this->ProductsModel->where('status','1')
										 ->get();

		if($obj_product){
    		$arr_product	  = $obj_product->toArray();
    		$html_product   = "<option value=''>Not selected</option>";
    		foreach ($arr_product as $key => $value) {
    			
    			$html_product    .= "<option value='".$value['id']."'  ";
    								if($value['id']==$arr_discount['product_id']){
    									$html_product    .= 'selected';
    								}
    			$html_product    .=  '>'.$value['product_english_name'].'</option>';
    		}
    	}

		$obj_sys_country 	  = $this->SystemCountryModel->where('status','1')
										 ->get();

		if($obj_sys_country){
    		$arr_country	  = $obj_sys_country->toArray();
    		$html_country   = "<option value=''>Not selected</option>";
    		foreach ($arr_country as $key => $value) {
    			
    			$html_country    .= "<option value='".$value['id']."'  ";
    								if($value['id']==$arr_discount['system_country_id']){
    									$html_country .= 'selected';
    								}
    			$html_country    .= '>'.$value['country_english_name'].'</option>';
    		}
    	}

    	$obj_sys_city 	  = $this->SystemCityModel->where('status','1')
										 ->get();

		if($obj_sys_city){
    		$arr_city	  = $obj_sys_city->toArray();
    		$html_city   = "<option value=''>Not selected</option>";
    		foreach ($arr_city as $key => $value) {
    			
    			$html_city    .= "<option value='".$value['id']."' ";
    								if($value['id']==$arr_discount['system_city_id']){
    									$html_city .='selected';	
    								}
    			$html_city    .= '>'.$value['city_english_name'].'</option>';
    		}
    	}

    	$arr_resp_data['discount']  	    =  $arr_discount;
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

    //edit discount: AUTHOR (Harsh chauhan)
     public function edit_discount(Request $request)
	{
		$id = base64_decode($request->input('enc_id'));
		
		$arr_rules      = $arr_data = array();
		$status         = false;

		$arr_rules['edit_percentage'] 	     	= "required";
		$arr_rules['edit_start_date']      	   	= "required";
		$arr_rules['edit_start_time']      	   	= "required";
		$arr_rules['edit_end_date']      	   	= "required";
		$arr_rules['edit_end_time']      	   	= "required";
	
	
		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$limit_customer =  $request->input('edit_limit_customer', null);

		if($limit_customer && $limit_customer!=null){
			$limit_customer = 'yes';
		}else{
			$limit_customer = 'no';

		}	


		$delivery_service =  $request->input('edit_delivery_service', null);
		if($delivery_service && $delivery_service!=null){
			$delivery_service = 'yes';
		}else{
			$delivery_service = 'no';
		}

		
        $str1 = "0123456789";
        $str2 = str_shuffle($str1);
        $discount_id = substr($str2,0,6); 

		$arr_data['discount_id']    			=   $discount_id;
		$arr_data['percentage']    				=   $request->input('edit_percentage', null);	
		$arr_data['start_date']	    			=   $request->input('edit_start_date', null);	
		$arr_data['start_time']	   				=   $request->input('edit_start_time', null);	
		$arr_data['end_date']	    			=   $request->input('edit_end_date', null);	
		$arr_data['end_time']	    			=   $request->input('edit_end_time', null);	
		$arr_data['category_id']				=   $request->input('edit_category', null);	
		$arr_data['sub_category_id']	    	=   $request->input('edit_sub_category', null);	
		$arr_data['product_id']	    			=   $request->input('edit_product', null);	
		$arr_data['system_country_id']	    	=   $request->input('edit_country', null);	
		$arr_data['system_city_id']	    		=   $request->input('edit_city', null);	
		$arr_data['delivery_service']	    	=   $delivery_service;
		$arr_data['first_order_new_customer']	=   $limit_customer;

		$status = $this->BaseModel->where('id',$id)->update($arr_data);

		if($status)
		{
			Session::flash('success', 'Discount added successfully.');
			return redirect($this->module_url_path);
		}

		Session::flash('error', 'Error while adding Discount.');
		return redirect($this->module_url_path);
	}

}