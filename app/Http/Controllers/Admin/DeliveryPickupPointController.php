<?php



namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\DeliveryPickupPointModel;

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

class DeliveryPickupPointController extends Controller

{

    use MultiActionTrait;



    function __construct(MailService $mail_service)

    {

		$this->arr_view_data                = [];

		$this->admin_panel_slug             = config('app.project.admin_panel_slug');

		$this->admin_url_path               = url(config('app.project.admin_panel_slug'));

		$this->module_url_path              = $this->admin_url_path."/settings/pickup_points";

		$this->module_title                 = "Pickup Point ";

		$this->module_view_folder           = "admin.pickup_points";

		$this->module_icon                  = "fa fa-user";

		$this->auth                         = auth()->guard('admin');

		$this->BaseModel					= new DeliveryPickupPointModel();

		$this->CategoryModel				= new CategoryModel();

		$this->SubCategoryModel				= new SubCategoryModel();

		$this->ProductsModel				= new ProductsModel();

		$this->SystemCountryModel			= new SystemCountryModel();

		$this->SystemCityModel				= new SystemCityModel();



		$this->user_profile_image_base_img_path   = base_path().config('app.project.img_path.user_profile_image');

		$this->user_profile_image_public_img_path = url('/').config('app.project.img_path.user_profile_image');

		$this->pickup_point_base_img_path   	  = base_path().config('app.project.img_path.pickup_point');

		$this->pickup_point_public_img_path       = url('/').config('app.project.img_path.pickup_point');

    }

    // Delivery pickup index : AUTHOR (Harsh chauhan)

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

    // load Delivery pickup data: AUTHOR (Harsh chauhan)

    public function load_data(Request $request)

	{	

		$build_status_btn       = '';

		$arr_data               = [];

		$arr_search_column     	= $request->input('column_filter');



		$obj_request_data = $this->BaseModel->with('get_city_details')->orderBy('created_at','DESC');



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



				$action_button_html = '<ul class="icons-list">

												<li class="dropdown">

													<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">

														<i class="icon-menu9"></i>

													</a>



													<ul class="dropdown-menu dropdown-menu-right">

										';				

				$built_delete_href    = $this->module_url_path.'/delete_point/'.base64_encode($data->id);

				$view_link_url    	 = "javascript:void(0)";

				

				$arr_roles = $arr_product_options = [];



				$id 					= isset($data->id)? $data->id :'';

				$city_id 				= isset($data->get_city_details->city_id)? $data->get_city_details->city_id :'';

				$city 					= isset($data->get_city_details->city_english_name)? $data->get_city_details->city_english_name :'';

				$point_english_name 	= isset($data->point_english_name)? $data->point_english_name :'';

				$english_address 		= isset($data->english_address)? $data->english_address :'';

				$english_working_hours 	= isset($data->english_working_hours)? $data->english_working_hours :'';



				$action_button_html .= '<li><a  title="" href="javascript:void(0)" data-original-title="Pay" data-id="'.$data->id.'" id="open_edit_modal_form_vertical" ><i class="icon-pencil7" title="Edit"></i>Edit</a></li><li> <a href='.$built_delete_href.'  title="delete" onclick="return confirm_action(this,event,\'Do you really want to delete this Pickup Point ?\')"><i class="icon-trash"></i>Delete</a></li>';



				$action_button_html .= '

												</ul>

											</li>

										</ul>';				

				$i = $key+1;

				$build_result->data[$key]->id         		    	= $id;

				$build_result->data[$key]->sr_no         			= $i;

				$build_result->data[$key]->city_id       			= $city_id;

				$build_result->data[$key]->city       				= $city;

				$build_result->data[$key]->point_english_name       = $point_english_name;

				$build_result->data[$key]->english_address       	= $english_address;

				$build_result->data[$key]->english_working_hours    = $english_working_hours;

				$build_result->data[$key]->built_action_btns    	= $action_button_html;

				

			}

			return response()->json($build_result);

		}

		else

		{

			return response()->json($build_result);

		}

	}



	// get Delivery pickup data: AUTHOR (Harsh chauhan)

	public function get_data(Request $request)

    {

    

    	$arr_data = $arr_resp = $arr_country = $arr_category = $arr_subcategory = $arr_city = $arr_product = $arr_resp_data = [];



    



    	$obj_sys_city 	  = $this->SystemCityModel->where('status','1')

										 ->get();



		if($obj_sys_city){

    		$arr_city	  = $obj_sys_city->toArray();

    		$html_city   = "<option value=''>Not selected</option>";

    		foreach ($arr_city as $key => $value) {

    			

    			$html_city    .= "<option value='".$value['id']."'>".$value['city_english_name']."</option>";

    		}

    	}





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









    // add new Delivery pickup point  : AUTHOR (Harsh chauhan)

	 public function add_pickup_point(Request $request)

	{

		

		

		$arr_rules      = $arr_data = array();

		$status         = false;



		$arr_rules['add_point_arabic_name']      		= "required";

		$arr_rules['add_point_english_name']      	   	= "required";

		$arr_rules['add_city']      	   				= "required";

		$arr_rules['add_point_arabic_address']      	= "required";

		$arr_rules['add_point_english_address']      	= "required";

		$arr_rules['add_point_arabic_hours']      	   	= "required";

		$arr_rules['add_point_english_hours']      	   	= "required";

	

		$validator = Validator::make($request->all(),$arr_rules);



		if($validator->fails()) 

		{

			return redirect()->back()->withErrors($validator)->withInput();

		}

		

        $str1 = "0123456789";

        $str2 = str_shuffle($str1);

        $pickup_id = substr($str2,0,6); 



        $obj_sys_city = $this->SystemCityModel->where('id',$request->input('add_city', 1))->first();



		$arr_data['point_id']    						=   $pickup_id;

		$arr_data['city_id']    						=   $request->input('add_city', null);	

		$arr_data['country_id']    						=   isset($obj_sys_city->system_country_id)? $obj_sys_city->system_country_id :1;	

		$arr_data['point_english_name']	    			=   $request->input('add_point_english_name', null);	

		$arr_data['point_arabic_name']	   				=   $request->input('add_point_arabic_name', null);	

		$arr_data['english_address']	    			=   $request->input('add_point_english_address', null);	

		$arr_data['arabic_address']	    				=   $request->input('add_point_arabic_address', null);	

		$arr_data['english_working_hours']				=   $request->input('add_point_english_hours', null);	

		$arr_data['arabic_working_hours']				=   $request->input('add_point_arabic_hours', null);	

		$arr_data['latitude']							=   $request->input('add_latitude', null);	

		$arr_data['longitude']							=   $request->input('add_longitude', null);	

		



		if($request->hasFile('add_image'))

		{         

			$file_extension = strtolower($request->file('add_image')->getClientOriginalExtension());



			if(in_array($file_extension,['png','jpg','jpeg']))

			{

				$file     = $request->file('add_image');

				$filename = sha1(uniqid().uniqid()) . '.' . $file->getClientOriginalExtension();

				$path     = $this->pickup_point_base_img_path . $filename;

				$isUpload = $file->move($this->pickup_point_base_img_path , $filename);

				if($isUpload)

				{

					$arr_data['image'] = $filename;

				}

			}

			else

			{

				Session::flash('error','Invalid File type, While creating Pickup Point.');

				return redirect()->back();

			}

		}



		$status = $this->BaseModel->create($arr_data);



		if($status)

		{

			Session::flash('success', 'Pickup Point added successfully.');

			return redirect($this->module_url_path);

		}



		Session::flash('error', 'Error while adding Pickup Point.');

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



	// get Delivery pickup point data : AUTHOR (Harsh chauhan)

	public function get_point_data(Request $request,$enc_id)

    {

    	$id = base64_decode($enc_id);



    	$arr_data = $arr_resp = $arr_country = $arr_category = $arr_subcategory = $arr_city = $arr_product = $arr_resp_data = [];



    	$obj_data      = $this->BaseModel->where('id',$id)->first();



    	if($obj_data){

    		$arr_data  = $obj_data->toArray();

    	}



		$obj_sys_city    = $this->SystemCityModel->get();    



		if($obj_sys_city){

    		$arr_city	 = $obj_sys_city->toArray();

    		$html_city   = "<option value=''>Not selected</option>";

    		foreach ($arr_city as $key => $value) {

    			

    			$html_city    .= "<option value='".$value['id']."' ";

    								if($value['id']==$arr_data['city_id']){

    									$html_city .='selected';	

    								}

    			$html_city    .= '>'.$value['city_english_name'].'</option>';

    		}

    	}



    	$arr_resp_data['pickup_point']  	=  $arr_data;

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



    // edit Delivery pickup : AUTHOR (Harsh chauhan)

     public function edit_pickup_point(Request $request)

	{

		$id = base64_decode($request->input('enc_id'));

		

		$arr_rules      = $arr_data = array();

		$status         = false;



		$arr_rules['edit_point_arabic_name']      		= "required";

		$arr_rules['edit_point_english_name']      	   	= "required";

		$arr_rules['edit_city']      	   				= "required";

		$arr_rules['edit_point_arabic_address']      	= "required";

		$arr_rules['edit_point_english_address']      	= "required";

		$arr_rules['edit_point_arabic_hours']      	   	= "required";

		$arr_rules['edit_point_english_hours']      	= "required";

	

	

		$validator = Validator::make($request->all(),$arr_rules);



		if($validator->fails()) 

		{

			return redirect()->back()->withErrors($validator)->withInput();

		}



		$obj_sys_city = $this->SystemCityModel->where('id',$request->input('edit_city', 1))->first();



		$arr_data['city_id']    						=   $request->input('edit_city', null);	

		$arr_data['country_id']    						=   isset($obj_sys_city->system_country_id)? $obj_sys_city->system_country_id :1;

		$arr_data['point_english_name']	    			=   $request->input('edit_point_english_name', null);	

		$arr_data['point_arabic_name']	   				=   $request->input('edit_point_arabic_name', null);	

		$arr_data['english_address']	    			=   $request->input('edit_point_english_address', null);	

		$arr_data['arabic_address']	    				=   $request->input('edit_point_arabic_address', null);	

		$arr_data['english_working_hours']				=   $request->input('edit_point_english_hours', null);	

		$arr_data['arabic_working_hours']				=   $request->input('edit_point_arabic_hours', null);	

		$arr_data['latitude']							=   $request->input('edit_latitude', null);	

		$arr_data['longitude']							=   $request->input('edit_longitude', null);	



		if($request->hasFile('edit_image'))

		{         

			$file_extension = strtolower($request->file('edit_image')->getClientOriginalExtension());



			if(in_array($file_extension,['png','jpg','jpeg']))

			{

				$file     = $request->file('edit_image');

				$filename = sha1(uniqid().uniqid()) . '.' . $file->getClientOriginalExtension();

				$path     = $this->pickup_point_base_img_path . $filename;

				$isUpload = $file->move($this->pickup_point_base_img_path , $filename);

				if($isUpload)

				{

					$arr_data['image'] = $filename;

				}

			}

			else

			{

				Session::flash('error','Invalid File type, While creating Pickup Point.');

				return redirect()->back();

			}

		}





		$status = $this->BaseModel->where('id',$id)->update($arr_data);



		if($status)

		{

			Session::flash('success', 'Pickup point updated successfully.');

			return redirect($this->module_url_path);

		}



		Session::flash('error', 'Error while updating Pickup Point.');

		return redirect($this->module_url_path);

	}



	// delete Delivery pickup : AUTHOR (Harsh chauhan)

	public function delete_point(Request $request,$enc_id)

	{	

		$point_id = base64_decode($enc_id);



		$obj_delete = $this->BaseModel->where('id',$point_id)->delete();



		if($obj_delete){

			Session::flash('success', 'Pickup Point deleted successfully.');

			return redirect($this->module_url_path);

    	}else{

    		Session::flash('error', 'Something went wrong.');

			return redirect($this->module_url_path);

    	}

	}



}