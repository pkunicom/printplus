<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CountryModel;
use App\Models\OrdersModel;
use App\Models\AgentModel;
use App\Models\SubOptionModel;
use App\Models\PrintingOrderDetailsModel;
use App\Models\PrintingOrderExtraNotesModel;
use App\Models\OrderFinanceDetailsModel;
use App\Models\PrintingOrderStatusHistoryModel;
use App\Models\PrintingOrderCompensationModel;
use App\Models\OrdersShipmentAramexModel;
use App\Common\Services\MailService;
use App\Common\Traits\MultiActionTrait;
use Illuminate\Support\Facades\DB;
use Hash;
use DataTables;
use Validator;
use Session;
use DateTime;
use Carbon;

class OrderManagementController extends Controller
{
    use MultiActionTrait;

    function __construct(MailService $mail_service)
    {
		$this->arr_view_data                = [];
		$this->admin_panel_slug             = config('app.project.admin_panel_slug');
		$this->admin_url_path               = url(config('app.project.admin_panel_slug'));
		$this->module_url_path              = $this->admin_url_path."/orders";
		$this->module_title                 = "Orders ";
		$this->module_view_folder           = "admin.orders";
		$this->module_icon                  = "fa fa-user";
		$this->auth                         = auth()->guard('admin');
		$this->CountryModel					= new CountryModel();
		$this->BaseModel					= new OrdersModel();
		$this->AgentModel					= new AgentModel();
		$this->SubOptionModel					= new SubOptionModel();
		$this->PrintingOrderDetailsModel	= new PrintingOrderDetailsModel();
		$this->PrintingOrderExtraNotesModel	= new PrintingOrderExtraNotesModel();
		$this->OrderFinanceDetailsModel		= new OrderFinanceDetailsModel();
		$this->PrintingOrderStatusHistoryModel		= new PrintingOrderStatusHistoryModel();
		$this->PrintingOrderCompensationModel		= new PrintingOrderCompensationModel();
		$this->OrdersShipmentAramexModel			= new OrdersShipmentAramexModel();

		$this->user_profile_image_base_img_path   = base_path().config('app.project.img_path.user_profile_image');
		$this->user_profile_image_public_img_path = url('/').config('app.project.img_path.user_profile_image');
		 $this->orders_file_base_file_path   = base_path().config('app.project.file_path.orders_file');
        $this->orders_file_public_file_path = url('/').config('app.project.file_path.orders_file');
    }

    //printing orders  index : AUTHOR (Harsh chauhan)
    public function printing_orders()
    {
    	$arr_agent = [];

        $obj_agent = $this->AgentModel->where('status','=','1')->get();

        if($obj_agent)

        {

            $arr_agent = $obj_agent->toArray();

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
		$this->arr_view_data['arr_agent']    = $arr_agent;
		
		return view($this->module_view_folder.'.printing_orders',$this->arr_view_data);
    }

    //load printing orders data : AUTHOR (Harsh chauhan)
    public function load_printingorders_data(Request $request)
	{	
		$build_status_btn       = '';
		$arr_data               = [];
		$arr_search_column     	= $request->input('column_filter');

		$obj_request_data = $this->BaseModel->with('get_city','get_delivery_type','get_shipment_details')
											->with(['get_customer_details'=>function($q){
												$q->with('get_group_details');
											}])
											->orderBy('created_at','DESC');

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
				 $view_link_url    = $this->module_url_path.'/view_invoice/'.base64_encode($data->id);
				//$view_link_url    = "javascript:void(0)";
				
				$arr_roles = [];

				$action_button_html .= '<li> <a  title="" href="'.$view_link_url.'" data-original-title="View" data-id="'.$data->id.'" id="open_edit_staff_modal"><i class="fa fa-download" title="Download"></i>Download</a></li>';

				if(isset($data->get_shipment_details) && !empty($data->get_shipment_details) ){

					$action_button_html .= '<li> <a  title="" href="'.$data->get_shipment_details->LabelURL.'" target="_blank"><i class="fa fa-barcode" title="Barcode"></i>View Barcode</a></li>';
				}
				
				$id 	    			= isset($data->id)? base64_encode($data->id):'';
				$order_id 				= isset($data->order_id)? $data->order_id :'';


			    $OrderEvalution=DB::table('evaluation')->where('order_id',$data->id)->get();
				if($OrderEvalution->count()>0){
				  	$evaluation=$OrderEvalution[0]->evaluation;
			    }else{
				 	$evaluation="Not Rated";
				}


				$view_orderdetail_url   = url('/').'/admin/orders/edit_printing_orders/'.$id;
				$order_id_anchor        = '<a  title="" href="'.$view_orderdetail_url.'" data-original-title="View Order details" >'.$order_id.'</a>';
				$full_name 				= isset($data->get_customer_details->full_name)? $data->get_customer_details->full_name :'';
				$customer_id 			= isset($data->get_customer_details->id)? $data->get_customer_details->id :'';
				$view_customer_url      = url('/').'/admin/customers/edit_customer/'.base64_encode($customer_id);
				$full_name_anchor       = '<a  title="" href="'.$view_customer_url.'" data-original-title="View customer" >'.$full_name.'</a>';
				$customer_group 		= isset($data->get_customer_details->get_group_details->group_name)? $data->get_customer_details->get_group_details->group_name :'';
				$order_total_amount 	= isset($data->order_total_amount)? $data->order_total_amount :'';
				$city 					= isset($data->get_city->city_english_name)? $data->get_city->city_english_name :'';
				$delivery_type 			= isset($data->get_delivery_type->delivery_type)? $data->get_delivery_type->delivery_type :'';
				$printing_status 		= isset($data->printing_status)? $data->printing_status :'';
				if($printing_status =='pending'){
					$printing_status_anchor = '<a  data-original-title="View" data-id="'.$data->id.'" ><span class="label label-danger">Pending</span></a>';
				}
				else if($printing_status =='collected'){
					$printing_status_anchor = '<a  data-original-title="View" data-id="'.$data->id.'" ><span class="label label-success">Collected</span></a>';
				}
				else if($printing_status =='in_progress'){
					$printing_status_anchor = '<a  data-original-title="View" data-id="'.$data->id.'"><span class="label label-info">In Progress</span></a>';
				}

				$divId = "open_delivery_status_modal-";
				if($printing_status=="collected" || $printing_status=="completed"){
					$divId = "open_delivery_status_modal";
				}

				if($data->delivery_status =='waiting'){
					$delivery_status = '<a  data-original-title="View" data-id="'.$data->id.'" id="'.$divId.'"><span class="label label-danger">Waiting</span></a>';
				}
				else if($data->delivery_status =='collected'){
					$delivery_status = '<a  data-original-title="View" data-id="'.$data->id.'" id="'.$divId.'"><span class="label label-success">Collected</span></a>';
				}
				else if($data->delivery_status =='on_delivery'){
					$delivery_status = '<a  data-original-title="View" data-id="'.$data->id.'" id="'.$divId.'"><span class="label label-info">On Delivery</span></a>';
				}
				else if($data->delivery_status =='delivered'){
					$delivery_status = '<a  data-original-title="View" data-id="'.$data->id.'" id="'.$divId.'"><span class="label label-primary">Delivered</span></a>';
				}
				$delivery_status 		= isset($delivery_status) ?  $delivery_status :'';
				$delivery_status_anchor = $delivery_status;
				$delivery_type 			= isset($data->get_delivery_type->delivery_type)? $data->get_delivery_type->delivery_type :'';
				$created_at 			= isset($data->created_at)?  date("Y-m-d h:i A", strtotime($data->created_at)) :'';


				$action_button_html .= '
												</ul>
											</li>
										</ul>';

				$hour = 0;
				$orderDate = $created_at;
				$currentDate = date('Y-m-d H:i:s');
				$timestamp1 = strtotime($orderDate);
				$timestamp2 = strtotime($currentDate);
				$hour = round(abs($timestamp2 - $timestamp1)/(60*60));
				$priority = "Low";
				if($hour<24){ 
					$priority = "Low";
				}else if($hour<48 && $hour>24){
					$priority = "Medium";
				}else if($hour<72 && $hour>48){
					$priority = "High";
				}else{ $priority = "Critical"; }


				$i = $key+1;
				$build_result->data[$key]->id         		    = $id;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->order_id        		= $order_id_anchor;
				$build_result->data[$key]->customer_name        = $full_name_anchor;
				$build_result->data[$key]->customer_group       = $customer_group;
				$build_result->data[$key]->value       			= $order_total_amount;
				$build_result->data[$key]->city        			= $city;
				$build_result->data[$key]->delivery_type        = $delivery_type;
				$build_result->data[$key]->printing_status      = $printing_status_anchor;
				$build_result->data[$key]->delivery_status      = $delivery_status_anchor;
				$build_result->data[$key]->created_at        	= $hour.' Hrs | '.$created_at;
				$build_result->data[$key]->priority        		= $priority;
				$build_result->data[$key]->evaluation        	= $evaluation;
				$build_result->data[$key]->built_action_btns    = $action_button_html;
				
			}
			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
	}
	//get printing orders status : AUTHOR (Harsh chauhan)
	public function get_printingorder_delivery_status(Request $request,$enc_id)
    {
    	$id = base64_decode($enc_id);
    	$arr_data = $arr_resp = [];

    	$obj_data = $this->BaseModel->with('get_customer_details')->where('id',$id)->first();

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

    //edit printing orders  : AUTHOR (Harsh chauhan)
  	public function edit_printing_orders($enc_id)
    {
    	$arr_data = [];
    	$id = base64_decode($enc_id);
    	$arr_agent = [];

        $obj_agent = $this->AgentModel->where('status','=','1')->get();

        if($obj_agent)

        {

            $arr_agent = $obj_agent->toArray();

		}

    	$obj_data = $this->BaseModel->with('get_city','get_delivery_type','get_shipment_details')
    										->with(['get_customer_details'=>function($q){
												$q->with('get_group_details');
											}])
    										->where('id',$id)->first();

    	if($obj_data){
    		$arr_data = $obj_data->toArray();
    		// dd($arr_data);
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
		$this->arr_view_data['arr_agent']    = $arr_agent;
		
		return view($this->module_view_folder.'.edit_printing_orders',$this->arr_view_data);
    }

    //load order product data : AUTHOR (Harsh chauhan)
     public function load_orderproducts_data(Request $request,$enc_id)
	{	
		$order_id = base64_decode($enc_id);

		$build_status_btn       = '';
		$arr_data               = [];
		$arr_search_column     	= $request->input('column_filter');

		$obj_request_data = $this->PrintingOrderDetailsModel->with('get_order_details','get_product_details','get_agent_details','get_combination_details')
															->with(['get_productoption_selected'=>function($q){
																$q->with('get_option_details');
															 }])	
															->where('order_id',$order_id)
															->orderBy('created_at','DESC');

		// if(isset($arr_search_column['full_name']) && $arr_search_column['full_name']!="")
		// {
		// 	$obj_request_data = $obj_request_data->where('full_name', 'LIKE',"%".$arr_search_column['full_name']."%");
		// }

	
		$obj_request_data = $obj_request_data->get();

		$json_result 	= DataTables::of($obj_request_data)->make(true);
		$build_result 	= $json_result->getData();

		if(isset($build_result->data) && sizeof($build_result->data)>0)
		{
			foreach ($build_result->data as $key => $data) 
			{
			//dump($data->file);
				//dd($data);
				if(isset($data->file) && $data->file!='')
                {
                    $file = $this->orders_file_public_file_path.'/'.$data->file;
                    // $download_link_url_product    = $this->agent_invoice_public_img_path.'/'.$data->invoice_file;
					$file_button_html = '<a  title="" href="'.$file.'" data-original-title="Download" data-id="'.$data->id.'" download><i class="fa fa-download" title="Download"></i></a>';
                }
                else
                {
				// dd(2);
                    $file = $this->orders_file_public_file_path.'default.pdf';
                    $file_button_html = '-';
                }
				// $view_link_url    = $this->module_url_path.'/view/'.base64_encode($data->id);
				$view_link_url    = "javascript:void(0)";

			
				
				$arr_roles = $arr_product_options = [];

				$id 	    			= isset($data->id)? base64_encode($data->id):'';
				$product_id 			= isset($data->get_product_details->product_id)? $data->get_product_details->product_id :'';
				$product_name 			= isset($data->get_product_details->product_english_name)? $data->get_product_details->product_english_name :'';
				$product_op 			= isset($data->get_productoption_selected)? $data->get_productoption_selected :'';
				
				foreach ($product_op as $ikey => $value) {
					$arr_product_options[] = $value->get_option_details->english_name;
				}
 				$arr_product_sub = $combination = [];	
				$combination 			= isset($data->get_combination_details->description)? $data->get_combination_details->description :'';
				//var_dump($combination);
				
				foreach ($combination as $ikey => $subid) {
					
					$sub_data = $this->SubOptionModel->where('id',$subid)->first();
					if($sub_data){
						
						
						$arr_product_sub[] = $sub_data->english_name;
					}
				}
				
 
				$option = implode(',', $arr_product_sub);
				//dd($option);
				$agent_name 	 		= isset($data->get_agent_details->full_name)? $data->get_agent_details->full_name :'';
				$status 				= isset($data->status)? $data->status :'';
				$file 					= isset($data->file)? $data->file :'-';
				$quantity 				= isset($data->quantity)? $data->quantity :'';

				$i = $key+1;
				$build_result->data[$key]->id         		    = $id;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->product_id        	= $product_id;
				$build_result->data[$key]->product_name         = $product_name;
				$build_result->data[$key]->option       		= $option;
				$build_result->data[$key]->agent_name       	= $agent_name;
				$build_result->data[$key]->status        		= $status;
				$build_result->data[$key]->file        			= $file_button_html;
				$build_result->data[$key]->quantity     		= $quantity;
				
			}
			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
	}

	//load extra notes data : AUTHOR (Harsh chauhan)
	 public function load_extranotes_data(Request $request,$enc_id)
	{	
		$order_id = base64_decode($enc_id);

		$build_status_btn       = '';
		$arr_data               = [];
		$arr_search_column     	= $request->input('column_filter');

		$obj_request_data = $this->PrintingOrderExtraNotesModel->with('get_order_details')	
																->where('order_id',$order_id)
																->orderBy('created_at','DESC');

		// if(isset($arr_search_column['full_name']) && $arr_search_column['full_name']!="")
		// {
		// 	$obj_request_data = $obj_request_data->where('full_name', 'LIKE',"%".$arr_search_column['full_name']."%");
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

				$id 	    			= isset($data->id)? base64_encode($data->id):'';
				$notes 					= isset($data->notes)? $data->notes :'-';
				$added_by 				= isset($data->added_by)? $data->added_by :'';
				$created_at 				= isset($data->created_at)? get_formated_date($data->created_at) :'';

				$i = $key+1;
				$build_result->data[$key]->id         		    = $id;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->notes        		= $notes;
				$build_result->data[$key]->added_by        		= $added_by;
				$build_result->data[$key]->created_at           = $created_at;
				
				
			}
			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
	}

	//store  printing orders note : AUTHOR (Harsh chauhan)
    public function store_printing_order_note(Request $request)
    {
    	$arr_data = $arr_rules = [];

    	$arr_rules['note']      	= "required";
		$arr_rules['order_id']      = "required";

		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$order_id = $request->input('order_id', null);

		$arr_data['notes']		=	$request->input('note', null);	
		$arr_data['order_id']	=	$request->input('order_id', null);	
		$arr_data['added_by']	=	'Admin';	
		
		$create_agent_product = $this->PrintingOrderExtraNotesModel->create($arr_data);

    	if($create_agent_product){
    		Session::flash('success', 'Note Added successfully  .');
			return redirect($this->module_url_path.'/edit_printing_orders/'.base64_encode($order_id));
    	}else{
    		Session::flash('error', 'Something went wrong.');
			return redirect($this->module_url_path.'/edit_printing_orders/'.base64_encode($order_id));
    	}
    }

    //get product finance detail : AUTHOR (Harsh chauhan)
 	public function get_product_finance_details($enc_id)
    {
    	$arr_data = $arr_resp = [];
    	$id = base64_decode($enc_id);
$html = '';
    	$obj_data = $this->PrintingOrderDetailsModel->with(['get_order_details'=>function($q){
    													$q->with('get_order_finance_details');
    												 }])
    												->with(['get_productoption_selected'=>function($q){
														$q->with('get_option_details');
													 }])	
    												 ->with('get_product_details','get_combination_details')
    												 ->where('order_id',$id)->get();

    	if($obj_data){
    		$arr_data = $obj_data->toArray();
    		 $i=1;
   		//dd($arr_data);
    		foreach ($arr_data as $key => $value) {

				$product_op 			= isset($value['get_productoption_selected'])? $value['get_productoption_selected'] :'';

				foreach ($product_op as $ikey => $ivalue) {
					$arr_product_options[] = $ivalue['get_option_details']['english_name'];
				}

				$arr_product_sub = $combination = [];
				$combination 			= isset($value['get_combination_details']['description'])? $value['get_combination_details']['description'] :'';
				///var_dump($combination);
				foreach ($combination as $ikey => $subid) {
					$sub_data = $this->SubOptionModel->where('id',$subid)->first();
					if($sub_data){
						$arr_product_sub[] = $sub_data->english_name;
					}
				}
			
 
				$option = implode(',', $arr_product_sub);
				//$option = implode(',', $arr_product_options);

				$total_price = $value['quantity']*$value['unit_price'];
	    	$html .= 	"<tr>
								<td>$i</td>
								<td>".$value['get_product_details']['product_english_name'].'-'.$option."</td>
								<td>1</td>
								<td>".$value['unit_price']."</td>
								<td>".$value['quantity']."</td>
								<td>".$total_price."</td>
							</tr>";
							
							 $i++;
    		}
    		$html .= "<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>Total before discount</td>
								<td>".$value['get_order_details']['get_order_finance_details']['total_before_discount']."</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>Discount</td>
								<td>".$value['get_order_details']['get_order_finance_details']['discount']."</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td>Vat</td>
								<td>".$value['get_order_details']['get_order_finance_details']['vat']."</td>
								<td>Total Including VAT</td>
								<td>".$value['get_order_details']['get_order_finance_details']['total_including_vat']."</td>
							</tr>";
    	}



    	$arr_resp['status'] = 'success';
    	$arr_resp['data'] 	= $html;

    	return $arr_resp;

    }

    //load orders status history data : AUTHOR (Harsh chauhan)
    public function load_orderstatushistory_data(Request $request,$enc_id)
	{	
		$order_id = base64_decode($enc_id);

		$build_status_btn       = '';
		$arr_data               = [];
		$arr_search_column     	= $request->input('column_filter');

		$obj_request_data = $this->PrintingOrderStatusHistoryModel->with('get_order_details')	
																->where('order_id',$order_id)
																->orderBy('created_at','DESC');

		// if(isset($arr_search_column['full_name']) && $arr_search_column['full_name']!="")
		// {
		// 	$obj_request_data = $obj_request_data->where('full_name', 'LIKE',"%".$arr_search_column['full_name']."%");
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

				$id 	    			= isset($data->id)? base64_encode($data->id):'';
				$old_status 			= isset($data->old_status)? ucfirst(str_replace("_"," ",($data->old_status))) :'-';
				$new_status 			= isset($data->new_status)? ucfirst(str_replace("_"," ",($data->new_status))):'-';
				$done_by 				= isset($data->change_by)? $data->change_by :'';
				$name 					= isset($data->name)? $data->name :'';
				$created_at 			= isset($data->created_at)? get_formated_date($data->created_at) :'';

				$i = $key+1;
				$build_result->data[$key]->id         		    = $id;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->old_status        	= $old_status;
				$build_result->data[$key]->new_status        	= $new_status;
				$build_result->data[$key]->done_by           	= $done_by;
				$build_result->data[$key]->name           		= $name;
				$build_result->data[$key]->created_at           = $created_at;
				
			}

			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
	}


	//load orders compensation data : AUTHOR (Harsh chauhan)
	   public function load_ordercompensation_data(Request $request,$enc_id)
	{	
		$order_id = base64_decode($enc_id);

		$build_status_btn       = '';
		$arr_data               = [];
		$arr_search_column     	= $request->input('column_filter');

		$obj_request_data = $this->PrintingOrderCompensationModel->with('get_order_details','get_product_options')	
																->with(['get_printing_orderproduct_detail'=>function($q){
																	$q->with('get_product_details');
																}])
																->where('order_id',$order_id)
																->orderBy('created_at','DESC');

		// if(isset($arr_search_column['full_name']) && $arr_search_column['full_name']!="")
		// {
		// 	$obj_request_data = $obj_request_data->where('full_name', 'LIKE',"%".$arr_search_column['full_name']."%");
		// }

	
		$obj_request_data = $obj_request_data->get();

		$json_result 	= DataTables::of($obj_request_data)->make(true);
		$build_result 	= $json_result->getData();

		if(isset($build_result->data) && sizeof($build_result->data)>0)
		{
			foreach ($build_result->data as $key => $data) 
			{

				$built_delete_href    = $this->module_url_path.'/delete_compensation/'.base64_encode($data->id);
				// $view_link_url    = "javascript:void(0)";
				
				$arr_roles = $arr_product_options = [];

				$id 	    			= isset($data->id)? base64_encode($data->id):'';
				$compensation_id 		= isset($data->compensation_id)? $data->compensation_id :'-';
				$product_name 			= isset($data->get_printing_orderproduct_detail->get_product_details->product_english_name)? $data->get_printing_orderproduct_detail->get_product_details->product_english_name :'-';
				$quantity 				= isset($data->quantity)? $data->quantity :'-';
				$cost_owner 				= isset($data->cost_owner)? $data->cost_owner :'';
				$type 					= isset($data->type)? ucfirst(str_replace("_"," ",($data->type))) :'-';
				$notes 					= isset($data->notes)? $data->notes :'-';
				$action 				=	'<a href='.$built_delete_href.'  title="delete" onclick="return confirm_action(this,event,\'Do you really want to delete this Compensation ?\')"><i class="fa fa-trash"></i></a>';

				$i = $key+1;
				$build_result->data[$key]->id         		    = $id;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->compensation_id      = $compensation_id;
				$build_result->data[$key]->product_name        	= $product_name;
				$build_result->data[$key]->quantity           	= $quantity;
				$build_result->data[$key]->cost_owner           = $cost_owner;
				$build_result->data[$key]->type           		= $type;
				$build_result->data[$key]->notes           		= $notes;
				$build_result->data[$key]->built_action_btns    = $action;
				
			}

			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
	}

	//load compensation : AUTHOR (Harsh chauhan)
	public function delete_compensation(Request $request,$enc_id)
	{	
		$compensation_id = base64_decode($enc_id);

		$obj_check = $this->PrintingOrderCompensationModel->where('id',$compensation_id)->first();

		$order_id = isset($obj_check->order_id) ? ($obj_check->order_id) :'';

		$obj_delete = $this->PrintingOrderCompensationModel->where('id',$compensation_id)->delete();

		if($obj_delete){
			Session::flash('success', 'Compensation deleted succeffsully  .');
			return redirect($this->module_url_path.'/edit_printing_orders/'.base64_encode($order_id));
    	}else{
    		Session::flash('error', 'Something went wrong.');
			return redirect($this->module_url_path.'/edit_printing_orders/'.base64_encode($order_id));
    	}
	}

	//get orders product items : AUTHOR (Harsh chauhan)
	public function get_orderproduct_items($enc_id)
    {
    	$arr_data = $arr_resp = [];
    	$id = base64_decode($enc_id);

    	$obj_data = $this->PrintingOrderDetailsModel
    												 ->with('get_product_details')
    												 ->where('id',$id)->get();

    	if($obj_data){
    		$arr_data = $obj_data->toArray();
    		
    		$html = "<option value=''>Select Item</option>";
    	
    		foreach ($arr_data as $key => $value) {
    		
    			$html .= "<option value=".$value['id'].">".$value['get_product_details']['product_english_name']."</option>";
    		}
    	}

    	$arr_resp['status'] = 'success';
    	$arr_resp['data'] 	= $html;

    	return $arr_resp;

    }

    //store printing order compensation : AUTHOR (Harsh chauhan)
     public function store_printing_order_compensation(Request $request)
    {
    	$arr_data = $arr_rules = [];

    	$arr_rules['compensate_item']      	= "required";
		$arr_rules['compensate_quantity']   = "required";
		$arr_rules['compensate_owner']      = "required";
		$arr_rules['compensate_type']      	= "required";

		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$order_id = $request->input('order_id', null);

		 $str1 = "0123456789";
        $str2 = str_shuffle($str1);
        $rand = substr($str2,0,6); 

		$arr_data['printing_order_detail_id']		=	$request->input('compensate_item', null);	
		$arr_data['order_id']						=	$request->input('order_id', null);	
		$arr_data['quantity']						=	$request->input('compensate_quantity', null);	
		$arr_data['compensation_id']				=	$rand;
		$arr_data['cost_owner']						=	$request->input('compensate_owner', null);	
		$arr_data['type']							=	$request->input('compensate_type', null);	
		$arr_data['notes']							=	$request->input('compensate_note', null);	

		
		$create_agent_product = $this->PrintingOrderCompensationModel->create($arr_data);

    	if($create_agent_product){
    		Session::flash('success', 'Compensation Added successfully  .');
			return redirect($this->module_url_path.'/edit_printing_orders/'.base64_encode($order_id));
    	}else{
    		Session::flash('error', 'Something went wrong.');
			return redirect($this->module_url_path.'/edit_printing_orders/'.base64_encode($order_id));
    	}
    }

    // PHP create shipment (Aramex) AUTHOR : Harsh chauhan
    public function create_shipment(Request $request){
    	// dd($request->all());
    	$order_id = $request->input('order_id');
    	$create_label_quantity = $request->input('create_label_quantity');
    	$create_label_type = $request->input('create_label_type');

    	// dd($order_id);
		error_reporting(E_ALL);
		ini_set('display_errors', '1');
		
		$soapClient = new \SoapClient(asset('assets/aramex/').'/shipping-services-api-wsdl.wsdl');
		// echo '<pre>';
		// print_r($soapClient->__getFunctions());

		$obj_get_order = $this->BaseModel->with('get_customer_details')
										 ->with(['get_order_details'=>function($q){
										 	$q->with('get_combination_details');
										 }])
										 ->where('id',$order_id)->first();
		// dd($obj_get_order->toArray());

		if($obj_get_order){
			$arr_data = $obj_get_order->toArray();

			$total_weight = 1;
			$weight = 0;
			if($arr_data['get_order_details']){

				foreach ($arr_data['get_order_details'] as $key => $value) {
					# code...
					$total_weight = $weight + $value['get_combination_details']['weight'];
				}
			}
		}

		$params = array(
				'Shipments' => array(	 
					'Shipment' => array(
							'Shipper'	=> array(
											'Reference1' 	=> 'Ref 111111',
											// 'Reference2' 	=> 'Ref 222222',
											'AccountNumber' => '60500178',
											'PartyAddress'	=> array(
												'Line1'					=> 'Airport Road, King Khalid International Airport, ',
												'Line2' 				=> 'Riyadh, 13463,',
												'Line3' 				=> 'SAUDI ARABIA',
												// 'City'					=> 'Amman',
												'City'					=> 'RUH',
												'StateOrProvinceCode'	=> '',
												'PostCode'				=> '',
												// 'CountryCode'			=> 'Jo'
												'CountryCode'			=> 'SA'
											),
											'Contact'		=> array(
												'Department'			=> '',
												'PersonName'			=> 'Printplus Team',
												'Title'					=> '',
												'CompanyName'			=> 'Printplus',
												'PhoneNumber1'			=> '5555555',
												'PhoneNumber1Ext'		=> '125',
												// 'PhoneNumber1'			=> '',
												// 'PhoneNumber1Ext'		=> '',
												'PhoneNumber2'			=> '',
												'PhoneNumber2Ext'		=> '',
												'FaxNumber'				=> '',
												'CellPhone'				=> '07777777',
												'EmailAddress'			=> 'Printplus@aramex.com',
												'Type'					=> ''
											),
							),
													
							'Consignee'	=> array(
											'Reference1'	=> 'Ref 333333',
											// 'Reference2'	=> 'Ref 444444',
											'AccountNumber' => '',
											'PartyAddress'	=> array(
												'Line1'					=> $arr_data['get_customer_details']['address'],
												'Line2'					=> '',
												'Line3'					=> '',
												'City'					=> 'Dubai',
												'StateOrProvinceCode'	=> '',
												'PostCode'				=> '',
												'CountryCode'			=> 'AE'
											),
											
											'Contact'		=> array(
												'Department'			=> '',
												'PersonName'			=> $arr_data['get_customer_details']['full_name'],
												'Title'					=> '',
												'CompanyName'			=> $arr_data['get_customer_details']['full_name'],
												// 'PhoneNumber1'			=> '6666666',
												// 'PhoneNumber1Ext'		=> '155',
												'PhoneNumber1'			=> $arr_data['get_customer_details']['mobile_number'],
												'PhoneNumber1Ext'		=> $arr_data['get_customer_details']['country_code_id'],
												'PhoneNumber2'			=> '',
												'PhoneNumber2Ext'		=> '',
												'FaxNumber'				=> '',
												'CellPhone'				=> $arr_data['get_customer_details']['country_code_id'].'-'.$arr_data['get_customer_details']['mobile_number'],
												'EmailAddress'			=> $arr_data['get_customer_details']['email'],
												'Type'					=> ''
											),
							),
							
							// 'ThirdParty' => array(
							// 				'Reference1' 	=> '',
							// 				'Reference2' 	=> '',
							// 				'AccountNumber' => '',
							// 				'PartyAddress'	=> array(
							// 					'Line1'					=> '',
							// 					'Line2'					=> '',
							// 					'Line3'					=> '',
							// 					'City'					=> '',
							// 					'StateOrProvinceCode'	=> '',
							// 					'PostCode'				=> '',
							// 					'CountryCode'			=> ''
							// 				),
							// 				'Contact'		=> array(
							// 					'Department'			=> '',
							// 					'PersonName'			=> '',
							// 					'Title'					=> '',
							// 					'CompanyName'			=> '',
							// 					'PhoneNumber1'			=> '',
							// 					'PhoneNumber1Ext'		=> '',
							// 					'PhoneNumber2'			=> '',
							// 					'PhoneNumber2Ext'		=> '',
							// 					'FaxNumber'				=> '',
							// 					'CellPhone'				=> '',
							// 					'EmailAddress'			=> '',
							// 					'Type'					=> ''							
							// 				),
							// ),
							
							// 'Reference1' 				=> 'Shpt 0001',
							'Reference1' 				=> '',
							'Reference2' 				=> '',
							'Reference3' 				=> '',
							// 'ForeignHAWB'				=> 'ORDERID '.$arr_data['order_id'],
							'ForeignHAWB'				=> 'AWB12321132dd2',
							'TransportType'				=> 0,
							'ShippingDateTime' 			=> time(),
							'DueDate'					=> time(),
							'PickupLocation'			=> 'Reception',
							'PickupGUID'				=> '',
							// 'Comments'					=> 'Shpt 0001',
							'Comments'					=> 'Please handle the package with care',
							'AccountingInstrcutions' 	=> '',
							'OperationsInstructions'	=> '',
							
							'Details' => array(
											// 'Dimensions' => array(
											// 	'Length'				=> 10,
											// 	'Width'					=> 10,
											// 	'Height'				=> 10,
											// 	'Unit'					=> 'cm',
												
											// ),
											
											'ActualWeight' => array(
												'Value'					=> $total_weight,
												'Unit'					=> 'Kg'
											),
											
											'ProductGroup' 			=> 'EXP',
											'ProductType'			=> 'PDX',
											'PaymentType'			=> 'P',
											'PaymentOptions' 		=> '',
											'Services'				=> '',
											// 'NumberOfPieces'		=> sizeof($arr_data['get_order_details']),
											'NumberOfPieces'		=> $create_label_quantity,
											'DescriptionOfGoods' 	=> 'Printlus Cards',
											'GoodsOriginCountry' 	=> 'SA',
											
											'CashOnDeliveryAmount' 	=> array(
												'Value'					=> 0,
												'CurrencyCode'			=> 'SAR'
												// 'CurrencyCode'			=> ''
											),
											
											'InsuranceAmount'		=> array(
												'Value'					=> 0,
												'CurrencyCode'			=> 'SAR'
												// 'CurrencyCode'			=> ''
											),
											
											'CollectAmount'			=> array(
												'Value'					=> 0,
												'CurrencyCode'			=> 'SAR'
												// 'CurrencyCode'			=> ''
											),
											
											'CashAdditionalAmount'	=> array(
												'Value'					=> 0,
												'CurrencyCode'			=> 'SAR'
												// 'CurrencyCode'			=> ''						
											),
											
											'CashAdditionalAmountDescription' => '',
											
											'CustomsValueAmount' => array(
												'Value'					=> 0,
												'CurrencyCode'			=> 'SAR'
												// 'CurrencyCode'			=> ''						
											),
											
											'Items' 				=> array(
												
											)
							),
					),
			),
			
				'ClientInfo'  			=> array(
											// 'AccountCountryCode'	=> 'JO',
											// 'AccountEntity'		 	=> 'AMM',
											// 'AccountNumber'		 	=> '20016',
											// 'AccountPin'		 	=> '221321',
											// 'UserName'			 	=> 'reem@reem.com',
											// 'Password'			 	=> '123456789',
											// 'Version'			 	=> '1.0'
											'AccountCountryCode'    => 'SA',
		                                    'AccountEntity'         => 'RUH',
		                                    'AccountNumber'         => '60500178',
		                                    'AccountPin'            => '165165',
		                                    'UserName'              => 'asma@print.sa',
		                                    'Password'              => 'Pr1nt$@11$22$',
		                                    'Version'               => 'v1'
										),

				// 'Transaction' 			=> array(
				// 							'Reference1'			=> '001',
				// 							'Reference2'			=> '', 
				// 							'Reference3'			=> '', 
				// 							'Reference4'			=> '', 
				// 							'Reference5'			=> '',									
				//						 ),
				'LabelInfo'				=> array(
											'ReportID' 				=> 9201,
											'ReportType'			=> 'URL',
				),
		);
		
		// $params['Shipments']['Shipment']['Details']['Items'][] = array(
		// 	'PackageType' 	=> 'Box',
		// 	'Quantity'		=> 12,
		// 	'Weight'		=> array(
		// 			'Value'		=> 0.75,
		// 			'Unit'		=> 'Kg',		
		// 	),
		// 	'Comments'		=> 'Please handle the package with careasas',
		// 	'Reference'		=> ''
		// );
		
		// print_r($params);
		
		try {
			$auth_call = $soapClient->CreateShipments($params);
			// echo '<pre>';
			// print_r($auth_call);
			// dd($auth_call);
			if($auth_call->HasErrors==false){
				$arr_create_shipment = [];

				$arr_create_shipment['order_id']           = $order_id;
				$arr_create_shipment['shipment_id']        = $auth_call->Shipments->ProcessedShipment->ID;
				$arr_create_shipment['ForeignHAWB']        = $auth_call->Shipments->ProcessedShipment->ForeignHAWB;
				$arr_create_shipment['LabelURL']  		   = $auth_call->Shipments->ProcessedShipment->ShipmentLabel->LabelURL;
				$arr_create_shipment['LabelFileContents']  = $auth_call->Shipments->ProcessedShipment->ShipmentLabel->LabelFileContents;

				$obj_create = $this->OrdersShipmentAramexModel->create($arr_create_shipment);

				if($obj_create){
					$obj_update = $this->BaseModel->where('id',$order_id)->update(['create_shipment'=>'1']);
				}
				Session::flash('success', 'Shipment created successfully.');
				return redirect($this->module_url_path.'/edit_printing_orders/'.base64_encode($order_id));
			}else{
				Session::flash('error', 'Something went wrong.');
				return redirect($this->module_url_path.'/edit_printing_orders/'.base64_encode($order_id));
			}
			die();
		} catch (\SoapFault $fault) {
			// die('Error : ' . $fault->faultstring);
			// dd(2);

			Session::flash('error', 'Something went wrong.');
			return redirect($this->module_url_path.'/edit_printing_orders/'.base64_encode($order_id));
		}
    }

    //get printing orders status : AUTHOR (Harsh chauhan)
	public function get_printingorder_delivery_status_update(Request $request)
    {
    	//dd($request->all());
    	$arr_data = $arr_resp = [];
		$order_id     	= $request->input('id');
		$status     	= $request->input('status');

    	if($status == 'status_collected'){
			$arr_data['delivery_status'] = 'collected';
		}elseif($status == 'status_on_delivery'){
			$arr_data['delivery_status'] = 'on_delivery';
		}
    	elseif($status == 'status_delivered'){
			$arr_data['delivery_status'] = 'delivered';
		}
    	

    	$obj_data = $this->BaseModel->where('id',$order_id)->update($arr_data);

    	if($obj_data){
			$arr_resp['status']  	= 'success';
			$arr_resp['data'] 		= 'Updated ';
		}else{
			$arr_resp['status'] 	= 'error';
			$arr_resp['data'] 		= 'Something Went wrong ';
		}

		return $arr_resp;
    }

	//edit printing orders  : AUTHOR (Harsh chauhan)
  	public function view_invoice($enc_id)
    {
    	$arr_data = $order_product = [];
    	$id = base64_decode($enc_id);
    	$arr_agent = [];

        $obj_agent = $this->AgentModel->where('status','=','1')->get();

        if($obj_agent)

        {

            $arr_agent = $obj_agent->toArray();

		}

    	$obj_data = $this->BaseModel->with('get_city','get_delivery_type','get_shipment_details')
    										->with(['get_customer_details'=>function($q){
												$q->with('get_group_details');
											}])
    										->where('id',$id)->first();

    	if($obj_data){
    		$arr_data = $obj_data->toArray();
    		// dd($arr_data);
    	}

		$obj_datas = $this->PrintingOrderDetailsModel->with(['get_order_details'=>function($q){
    													$q->with('get_order_finance_details');
    												 }])
    												->with(['get_productoption_selected'=>function($q){
														$q->with('get_option_details');
													 }])	
    												 ->with('get_product_details','get_combination_details')
    												 ->where('order_id',$id)->get();

    	if($obj_datas){
    		$arrs_data = $obj_datas->toArray();
			//dd($arrs_data);
    		 $i=1;
   		//dd($arr_data);
    		foreach ($arrs_data as $key => $value) {
				//dd($value);	
				$product_op 			= isset($value['get_productoption_selected'])? $value['get_productoption_selected'] :'';
					//dd($product_op );
				foreach ($product_op as $ikey => $ivalue) {
					$arr_product_options[] = $ivalue['get_option_details']['english_name'];
				}


				$combination = isset($value['get_combination_details']['description'])? $value['get_combination_details']['description'] :'';
				//dd($combination);
				$arr_product_sub = [];
				foreach ($combination as $ikey => $subid) {
					//dd($subid);
					$sub_data = $this->SubOptionModel->where('id',$subid)->first();
					if($sub_data){
						$arr_product_engsub[] = $sub_data->english_name;
						$arr_product_arbsub[] = $sub_data->arabic_name;
					}
				}
			
 
				$eng_option = implode(', ', $arr_product_engsub);
				$arb_option = implode(', ', $arr_product_arbsub);
				//$option = implode(',', $arr_product_options);

				$total_price = $value['quantity']*$value['unit_price'];
	    		$order_product['product_english'] = $value['get_product_details']['product_english_name'].'-'.$eng_option;
	    		$order_product['product_arabic'] = $value['get_product_details']['product_arabic_name'].'- '.$arb_option;
	    		$order_product['perquantity'] = 1;
	    		$order_product['unit_price'] = $value['unit_price'];
	    		$order_product['quantity'] = $value['quantity'];
	    		$order_product['total_price'] = $total_price;
								
				$arr_data['product_details'][] = $order_product;				
								
    		}
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
		$this->arr_view_data['arr_agent']    = $arr_agent;
		
		return view($this->module_view_folder.'.customer-invoice',$this->arr_view_data);
    }
	
}