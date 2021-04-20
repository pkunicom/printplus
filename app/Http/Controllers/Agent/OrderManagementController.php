<?php

namespace App\Http\Controllers\Agent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CountryModel;
use App\Models\OrdersModel;
use App\Models\PrintingOrderDetailsModel;
use App\Models\PrintingOrderExtraNotesModel;
use App\Models\OrderFinanceDetailsModel;
use App\Models\PrintingOrderStatusHistoryModel;
use App\Models\PrintingOrderCompensationModel;
use App\Models\EvaluationModel;
use App\Common\Services\MailService;
use App\Common\Traits\MultiActionTrait;
use Hash;
use DataTables;
use Validator;
use Session;
  use Aramex;
  use DB;

class OrderManagementController extends Controller
{
    use MultiActionTrait;

    function __construct(MailService $mail_service)
    {
		$this->arr_view_data                = [];
		$this->admin_panel_slug             = config('app.project.agent_panel_slug');
		$this->admin_url_path               = url(config('app.project.agent_panel_slug'));
		$this->module_url_path              = $this->admin_url_path."/orders";
		$this->module_title                 = "Orders ";
		$this->module_view_folder           = "agent.orders";
		$this->module_icon                  = "fa fa-user";
		$this->auth                         = auth()->guard('agent');
		$this->CountryModel					= new CountryModel();
		$this->BaseModel					= new OrdersModel();
		$this->PrintingOrderDetailsModel	= new PrintingOrderDetailsModel();
		$this->PrintingOrderExtraNotesModel	= new PrintingOrderExtraNotesModel();
		$this->OrderFinanceDetailsModel		= new OrderFinanceDetailsModel();
		$this->PrintingOrderStatusHistoryModel		= new PrintingOrderStatusHistoryModel();
		$this->PrintingOrderCompensationModel		= new PrintingOrderCompensationModel();
		$this->EvaluationModel		= new EvaluationModel();
	    $this->user                         = $this->auth->user();

        if($this->user){

            $this->user_id                  = $this->user->id;
        }

		$this->user_profile_image_base_img_path   = base_path().config('app.project.img_path.user_profile_image');
		$this->user_profile_image_public_img_path = url('/').config('app.project.img_path.user_profile_image');
    }
    // orders listing: AUTHOR (Harsh Chauhan)
    public function index()
    {
		$this->arr_view_data['page_title']          = "Manage ".$this->module_title;
        $this->arr_view_data['parent_module_icon']  = "fa fa-home";
        $this->arr_view_data['parent_module_title'] = "Dashboard";
        $this->arr_view_data['parent_module_url']   = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']         = $this->module_icon;
        $this->arr_view_data['module_title']        = "Manage ".$this->module_title;
		$this->arr_view_data['module_url_path']     = $this->module_url_path;
		$this->arr_view_data['admin_url_path']      = $this->admin_url_path;
		$this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;
		
		return view($this->module_view_folder.'.printing_orders',$this->arr_view_data);
    }

    // ajax call to load printing orders data: AUTHOR (Harsh Chauhan)
    public function load_printingorders_data(Request $request)
	{	
		$user_id = $this->auth->user()->id;

		$build_status_btn       = '';
		$arr_data               = [];
		$arr_search_column     	= $request->input('column_filter');

		$obj_request_data = $this->PrintingOrderDetailsModel
											->with('get_order_details','get_product_details')
											->where('agent_id',$user_id)
											->orderBy('created_at','DESC')
											->get();

		$json_result 	= DataTables::of($obj_request_data)->make(true);
		$build_result 	= $json_result->getData();

		if(isset($build_result->data) && sizeof($build_result->data)>0)
		{
			foreach ($build_result->data as $key => $data) 
			{
				$order_id 				= isset($data->get_order_details->order_id)? $data->get_order_details->order_id :'';

				// $view_link_url    = $this->module_url_path.'/calculate_rate';
				$view_link_url    = $this->module_url_path.'/qrcode/'.base64_encode($order_id);
				
				$arr_roles = [];

				$action_button_html = '<a  title="" href="'.$view_link_url.'" data-original-title="View" data-id="'.$data->id.'" target="_blank"><i class="fa fa-barcode" title="Barcode"></i></a>';
				
				$id 	    			= isset($data->id)? base64_encode($data->id):'';
				$orderId				= isset($data->order_id)? base64_encode($data->order_id):'';
				$item_id 				= isset($data->get_product_details->product_id)? $data->get_product_details->product_id :'';
				$product_name 			= isset($data->get_product_details->product_english_name)? $data->get_product_details->product_english_name :'';
				$view_orderdetail_url   = url('/').'/agent/orders/edit_printing_orders/'.$orderId;
				
				$order_id_anchor        = '<a  title="" href="'.$view_orderdetail_url.'" data-original-title="View Order details" >'.$order_id.'</a>';


				$order_total_amount 	= isset($data->get_order_details->order_total_amount)? $data->get_order_details->order_total_amount :'';


				$printing_status 		= isset($data->get_order_details->printing_status)? $data->get_order_details->printing_status :'';
				// $delivery_status 		= isset($data->delivery_status)? str_replace('_', ' ', $data->delivery_status) :'';

				if($printing_status =='pending'){
					$printing_status_anchor = '<a  data-original-title="View" data-id="'.$data->id.'" id="open_delivery_status_modal"><span class="label label-danger">Pending</span></a>';
				}
				else if($printing_status =='collected'){
					$printing_status_anchor = '<a  data-original-title="View" data-id="'.$data->id.'" id="open_delivery_status_modal"><span class="label label-success">Collected</span></a>';
				}
				else if($printing_status =='in_progress'){
					$printing_status_anchor = '<a  data-original-title="View" data-id="'.$data->id.'" id="open_delivery_status_modal"><span class="label label-info">In Progress</span></a>';
				}

				
				$created_at 			= isset($data->get_order_details->created_at)? get_formated_date($data->get_order_details->created_at) :'';

				$i = $key+1;
				$build_result->data[$key]->id         		    = $id;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->order_id        		= $order_id_anchor;
				$build_result->data[$key]->item_id        		= $item_id;
				$build_result->data[$key]->product_name       	= $product_name;
				$build_result->data[$key]->value       			= $order_total_amount;
				$build_result->data[$key]->printing_status      = $printing_status_anchor;
				$build_result->data[$key]->created_at        	= $created_at;
				$build_result->data[$key]->priority        		= "high";
				$build_result->data[$key]->evalutation        	= "Not Rated";
				$build_result->data[$key]->built_action_btns    = $action_button_html;
				
			}
			//dd($build_result);
			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
	}

	// ajax call to get printing orders status : AUTHOR (Harsh Chauhan)
	public function get_printingorder_printing_status(Request $request,$enc_id)
    {
    	$id = base64_decode($enc_id);
    	$arr_data = $arr_resp = [];

    	$obj_data = $this->PrintingOrderDetailsModel->with('get_order_details','get_product_details')->where('id',$id)->first();

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

    // edit printing orders : AUTHOR (Harsh Chauhan)
  	public function edit_printing_orders($enc_id)
    {
    	$arr_data = [];
    	$id = base64_decode($enc_id);
		//var_dump($id);
		//DB::enableQueryLog();
    	$obj_data = $this->BaseModel->with('get_city','get_delivery_type')
    										->with(['get_customer_details'=>function($q){
												$q->with('get_group_details');
											}])
    										->where('id',$id)->first();
		
		//$query = DB::getQueryLog();
		//$query = end($query);
		//dd($query);
    	if($obj_data){
    		$arr_data = $obj_data->toArray();
			
    	}
		//dd($arr_data);

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
		
		return view($this->module_view_folder.'.edit_printing_orders',$this->arr_view_data);
    }

    // ajax call to load orderproducts: AUTHOR (Harsh Chauhan)
     public function load_orderproducts_data(Request $request,$enc_id)
	{	
		$order_id = base64_decode($enc_id);

		$build_status_btn       = '';
		$arr_data               = [];
		$arr_search_column     	= $request->input('column_filter');

		$obj_request_data = $this->PrintingOrderDetailsModel->with('get_order_details','get_product_details','get_agent_details')
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
				//dd($data);
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

				$option = implode(',', $arr_product_options);
				// $agent_name 	 		= isset($data->get_agent_details->full_name)? $data->get_agent_details->full_name :'';
				$status 				= isset($data->status)? $data->status :'';
				$file 					= isset($data->file)? $data->file :'-';
				$quantity 				= isset($data->quantity)? $data->quantity :'';
				$unit_price				= isset($data->unit_price)? $data->unit_price :'';

				$total_price 			= $quantity*$unit_price;

				$i = $key+1;
				$build_result->data[$key]->id         		    = $id;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->product_id        	= $product_id;
				$build_result->data[$key]->product_name         = $product_name;
				$build_result->data[$key]->option       		= $option;
				$build_result->data[$key]->total_price        	= $total_price;
				$build_result->data[$key]->file        			= $file;
				$build_result->data[$key]->pack        			= '1';
				$build_result->data[$key]->quantity     		= $quantity;
				
			}

			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
	}

	// ajax call to load extra notes: AUTHOR (Harsh Chauhan)
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

	// ajax call to load evalauatiob data: AUTHOR (Harsh Chauhan)
	public function load_evaluation_data(Request $request,$enc_id)
	{	
		$order_id = base64_decode($enc_id);

		$build_status_btn       = '';
		$arr_data               = [];
		$arr_search_column     	= $request->input('column_filter');

		$obj_request_data = $this->EvaluationModel->with(['get_orderproduct_details'=>function($q){
														$q->with('get_product_details');
														$q->with(['get_productoption_selected'=>function($q2){
															$q2->with('get_option_details');
														}]);
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
				
				// $view_link_url    = $this->module_url_path.'/view/'.base64_encode($data->id);
				$view_link_url    = "javascript:void(0)";
				
				$arr_roles = $arr_product_options = [];

				$id 	    			= isset($data->id)? base64_encode($data->id):'';
				$product_name 			= isset($data->get_orderproduct_details->get_product_details->product_english_name)? $data->get_orderproduct_details->get_product_details->product_english_name :'-';
				$product_op 			= isset($data->get_orderproduct_details->get_productoption_selected)? $data->get_orderproduct_details->get_productoption_selected :'';

				foreach ($product_op as $ikey => $value) {
					$arr_product_options[] = $value->get_option_details->english_name;
				}

				$option = implode(',', $arr_product_options);
				$evalutation 			= isset($data->evalutation)? $data->evalutation :'';
				$comment 				= isset($data->comment)? ($data->comment) :'';

				$i = $key+1;
				$build_result->data[$key]->id         		    = $id;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->product_name        	= $product_name;
				$build_result->data[$key]->option        		= $option;
				$build_result->data[$key]->evalutation          = $evalutation;
				$build_result->data[$key]->comment           	= $comment;
				
				
			}
			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
	}

	// store printing order note: AUTHOR (Harsh Chauhan)
    public function store_printing_order_note(Request $request)
    {
    	$user_name = $this->auth->user()->full_name;
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
		$arr_data['added_by']	=	isset($user_name)?$user_name:'Agent';	
		
		$create_agent_product = $this->PrintingOrderExtraNotesModel->create($arr_data);

    	if($create_agent_product){
    		Session::flash('success', 'Note Added successfully  .');
			return redirect($this->module_url_path.'/edit_printing_orders/'.base64_encode($order_id));
    	}else{
    		Session::flash('error', 'Something went wrong.');
			return redirect($this->module_url_path.'/edit_printing_orders/'.base64_encode($order_id));
    	}
    }

    // get product finance detail : AUTHOR (Harsh Chauhan)
 	public function get_product_finance_details($enc_id)
    {
    	$arr_data = $arr_resp = [];
    	$id = base64_decode($enc_id);

    	$obj_data = $this->PrintingOrderDetailsModel->with(['get_order_details'=>function($q){
    													$q->with('get_order_finance_details');
    												 }])
    												 ->with('get_product_details')
    												 ->where('id',$id)->first();

    	if($obj_data){
    		$arr_data = $obj_data->toArray();
    		$i=1;
    		foreach ($arr_data as $key => $value) {
	    	$html = 	"<tr>
								<td>1</td>
								<td>".$arr_data['get_product_details']['product_english_name']."</td>
								<td>100</td>
								<td>20</td>
								<td>".$arr_data['quantity']."</td>
								<td>100</td>
							</tr>";
							$i++;
    		}
    	}

    	$arr_resp['status'] = 'success';
    	$arr_resp['data'] 	= $html;

    	return $arr_resp;

    }

    // ajax call to load order status history data: AUTHOR (Harsh Chauhan)
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

	// ajax call to load order compensation data: AUTHOR (Harsh Chauhan)
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
				// $build_result->data[$key]->built_action_btns    = $action;
				
			}

			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
	}
	// delete_compensation: AUTHOR (Harsh Chauhan)
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

	// get order product items: AUTHOR (Harsh Chauhan)
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

    // store printing order compensation: AUTHOR (Harsh Chauhan)
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

    //Laravel create pickup
    public function create_pickup(Request $request){
    	// dd( time() +  45000);
    	  $data = Aramex::createPickup([
    		'name' => 'MyName',
    		'cell_phone' => '+123123123',
    		'phone' => '+123123123',
    		'email' => 'myEmail@gmail.com',
    		'city' => 'New York',
    		'country_code' => 'US',
            'zip_code'=> 10001,
    		'line1' => 'The line1 Details',
            'line2' => 'The line2 Details',
    		'line3' => 'The line2 Details',
    		'pickup_date' => time() + 45000,
    		'ready_time' => time()  + 43000,
    		'last_pickup_time' => time() +  45000,
    		'closing_time' => time()  + 45000,
    		'status' => 'Ready', 
    		'pickup_location' => 'some location',
    		'weight' => 123,
    		'volume' => 1
    	]);
    	  dd($data);

        // extracting GUID
       if (!$data->error){
          $guid = $data->pickupGUID;
       }else{
       		dd('error');
       }
    }

    // Laravel create shipment
    //  public function create_shipment(Request $request){
    // 	$anotherData = Aramex::createShipment([
    //         'shipper' => [
    //             'name' => 'Steve',
    //             'email' => 'email@users.companies',
    //             'phone'      => '+123456789982',
    //             'cell_phone' => '+321654987789',
    //             'country_code' => 'US',
    //             'city' => 'New York',
    //             'zip_code' => 32160,
    //             'line1' => 'Line1 Details',
    //             'line2' => 'Line2 Details',
    //             'line3' => 'Line3 Details',
    //         ],
    //         'consignee' => [
    //             'name' => 'Steve',
    //             'email' => 'email@users.companies',
    //             'phone'      => '+123456789982',
    //             'cell_phone' => '+321654987789',
    //             'country_code' => 'US',
    //             'city' => 'New York',
    //             'zip_code' => 32160,
    //             'line1' => 'Line1 Details',
    //             'line2' => 'Line2 Details',
    //             'line3' => 'Line3 Details',
    //         ],
    //         'shipping_date_time' => time() + 50000,
    //         'due_date' => time() + 60000,
    //         'comments' => 'No Comment',
    //         'pickup_location' => 'at reception',
    //         'pickup_guid' => $guid,
    //         'weight' => 1,
    //         'number_of_pieces' => 1,
    //         'description' => 'Goods Description, like Boxes of flowers',
    //     ]);
    // }

    // PHP create shipment
    public function create_shipment(){
    		error_reporting(E_ALL);
		ini_set('display_errors', '1');
		
		$soapClient = new \SoapClient(asset('assets/aramex/').'/shipping-services-api-wsdl.wsdl');
		echo '<pre>';
		print_r($soapClient->__getFunctions());

		$params = array(
				'Shipments' => array(	 
					'Shipment' => array(
							'Shipper'	=> array(
											'Reference1' 	=> 'Ref 111111',
											'Reference2' 	=> 'Ref 222222',
											'AccountNumber' => '60500178',
											'PartyAddress'	=> array(
												'Line1'					=> 'Mecca St',
												'Line2' 				=> '',
												'Line3' 				=> '',
												// 'City'					=> 'Amman',
												'City'					=> 'RUH',
												'StateOrProvinceCode'	=> '',
												'PostCode'				=> '',
												// 'CountryCode'			=> 'Jo'
												'CountryCode'			=> 'SA'
											),
											'Contact'		=> array(
												'Department'			=> '',
												'PersonName'			=> 'Printplus',
												'Title'					=> '',
												'CompanyName'			=> 'Printplus',
												'PhoneNumber1'			=> '5555555',
												'PhoneNumber1Ext'		=> '125',
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
											'Reference2'	=> 'Ref 444444',
											'AccountNumber' => '',
											'PartyAddress'	=> array(
												'Line1'					=> '15 ABC St',
												'Line2'					=> '',
												'Line3'					=> '',
												'City'					=> 'Dubai',
												'StateOrProvinceCode'	=> '',
												'PostCode'				=> '',
												'CountryCode'			=> 'AE'
											),
											
											'Contact'		=> array(
												'Department'			=> '',
												'PersonName'			=> 'Mazen',
												'Title'					=> '',
												'CompanyName'			=> 'Aramex',
												'PhoneNumber1'			=> '6666666',
												'PhoneNumber1Ext'		=> '155',
												'PhoneNumber2'			=> '',
												'PhoneNumber2Ext'		=> '',
												'FaxNumber'				=> '',
												'CellPhone'				=> '888888',
												'EmailAddress'			=> 'mazen@aramex.com',
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
							
							'Reference1' 				=> 'Shpt 0001',
							'Reference2' 				=> '',
							'Reference3' 				=> '',
							'ForeignHAWB'				=> 'ABC 000111123',
							'TransportType'				=> 0,
							'ShippingDateTime' 			=> time(),
							'DueDate'					=> time(),
							'PickupLocation'			=> 'Reception',
							'PickupGUID'				=> '',
							'Comments'					=> 'Shpt 0001',
							'AccountingInstrcutions' 	=> '',
							'OperationsInstructions'	=> '',
							
							'Details' => array(
											'Dimensions' => array(
												'Length'				=> 10,
												'Width'					=> 10,
												'Height'				=> 10,
												'Unit'					=> 'cm',
												
											),
											
											'ActualWeight' => array(
												'Value'					=> 0.5,
												'Unit'					=> 'Kg'
											),
											
											'ProductGroup' 			=> 'EXP',
											'ProductType'			=> 'PDX',
											'PaymentType'			=> 'P',
											'PaymentOptions' 		=> '',
											'Services'				=> '',
											'NumberOfPieces'		=> 1,
											'DescriptionOfGoods' 	=> 'Docs',
											'GoodsOriginCountry' 	=> 'Jo',
											
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

				'Transaction' 			=> array(
											'Reference1'			=> '001',
											'Reference2'			=> '', 
											'Reference3'			=> '', 
											'Reference4'			=> '', 
											'Reference5'			=> '',									
										),
				'LabelInfo'				=> array(
											'ReportID' 				=> 9201,
											'ReportType'			=> 'URL',
				),
		);
		
		$params['Shipments']['Shipment']['Details']['Items'][] = array(
			'PackageType' 	=> 'Box',
			'Quantity'		=> 1,
			'Weight'		=> array(
					'Value'		=> 0.5,
					'Unit'		=> 'Kg',		
			),
			'Comments'		=> 'Docs',
			'Reference'		=> ''
		);
		
		print_r($params);
		
		try {
			$auth_call = $soapClient->CreateShipments($params);
			echo '<pre>';
			print_r($auth_call);
			dd(1);
			die();
		} catch (\SoapFault $fault) {
			die('Error : ' . $fault->faultstring);
			dd(2);
		}
    }
	// Laravel code
 //    public function calculate_rate(Request $request)
	// {
	//     $originAddress = [
 //            'line_1' => 'Test string',
 //            'city' => 'Amman',
 //            'country_code' => 'JO'
 //        ];

 //        $destinationAddress = [
 //            'line_1' => 'Test String',
 //            'city' => 'Dubai',
 //            'country_code' => 'AE'
            
 //        ];
 //        $shipmentDetails = [
 //            'weight' => 5, // KG
 //            'number_of_pieces' => 2,
 //            'payment_type' => 'P', // if u don't pass it, it will take the config default value 
 //            'product_group' => 'EXP', // if u don't pass it, it will take the config default value
 //            'product_type' => 'PPX', // if u don't pass it, it will take the config default value
 //        ];

 //        $shipmentDetails = [
 //            'weight' => 5, // KG
 //            'number_of_pieces' => 2,
 //        ];

 //        $currency = 'USD';
 //        $data = Aramex::calculateRate($originAddress, $destinationAddress , $shipmentDetails , 'USD');
        
 //        // dd($data);
 //        if(!$data->HasErrors){
 //          dd($data);
 //        }
 //        else{
 //        	Session::flash('error', 'Something went wrong while calculating rate.');
	// 		return redirect($this->module_url_path);
 //          // handle $data->errors
 //        }	
	// }

	// PHP Code
	public function calculate_rate(Request $request)
	{
		$params = array(
		'ClientInfo'  			=> array(
									// 'AccountCountryCode'	=> 'JO',
									'AccountCountryCode'	=> 'SA',
									// 'AccountEntity'		 	=> 'AMM',
									'AccountEntity'		 	=> 'RUH',
									// 'AccountNumber'		 	=> '00000',
									'AccountNumber'		 	=> '60500178',
									// 'AccountPin'		 	=> '000000',
									'AccountPin'		 	=> '165165',
									// 'UserName'			 	=> 'user@company.com',
									'UserName'			 	=> 'asma@print.sa',
									// 'Password'			 	=> '000000000',
									'Password'			 	=> 'Pr1nt$@11$22$',
									// 'Version'			 	=> 'v1.0'
									'Version'			 	=> 'v1'
								),
								
		'Transaction' 			=> array(
									'Reference1'			=> '001' 
								),
								
		'OriginAddress' 	 	=> array(
									'City'					=> 'Amman',
									'CountryCode'				=> 'JO'
								),
								
		'DestinationAddress' 	=> array(
									'City'					=> 'Dubai',
									'CountryCode'			=> 'AE'
								),
		'ShipmentDetails'		=> array(
									'PaymentType'			 => 'P',
									'ProductGroup'			 => 'EXP',
									'ProductType'			 => 'PPX',
									'ActualWeight' 			 => array('Value' => 5, 'Unit' => 'KG'),
									'ChargeableWeight' 	     => array('Value' => 5, 'Unit' => 'KG'),
									'NumberOfPieces'		 => 5
								)
		);
		
		$soapClient = new \SoapClient(asset('assets/aramex/').'/aramex-rates-calculator-wsdl.wsdl' , array('trace' => 1));
		$results = $soapClient->CalculateRate($params);	

		dd($results);
	}

	public function track_shipment(Request $request){
	    $shipments = [ 
            $createShipmentResults->Shipments->ProcessedShipment->ID,
            $anotherCreateShipmentResults->Shipments->ProcessedShipment->ID,
        ];

        $data = Aramex::trackShipments($shipments);
        
        if (!$data->error){
          // Code Here
        }
        else {
        // handle error
        }
	}

	public function qrcode(Request $request,$enc_id){

		$order_id = base64_decode($enc_id);
		
		$image = \QrCode::format('svg')
						->margin(100)
                 		// ->merge(url('/').'/uploads/default/sample_code.png', 0.1, true)
                 		->size(200)->errorCorrection('H')
                 		->generate($order_id);
                 // dd($image);
		// $output_file = url('/').'/uploads/default/'. time() . '.png';
        
        $output_file = '/img/qr-code/img-' . time() . '.svg';
		 // file_put_contents(url('/').'/uploads/default/',$image);
		// $save =		\Storage::disk('local')->put($output_file, $image); //storage/app/public/img/qr-code/img-1557309130.png

		if($output_file){
			$this->arr_view_data['order_id']    = $order_id;
			return view($this->module_view_folder.'.qr_code',$this->arr_view_data);
    	}else{
    		Session::flash('error', 'Something went wrong.');
			return redirect($this->module_url_path.'/edit_printing_orders/'.base64_encode($order_id));
    	}
	}

	
	 //get printing orders status : AUTHOR (Harsh chauhan)
	public function get_printingorder_printing_status_update(Request $request)
    {
    	//dd($request->all());
    	$arr_data = $arr_resp = [];
		$order_id     	= $request->input('id');
		$status     	= $request->input('status');

    	if($status == 'status_collected'){
			$arr_data['printing_status'] = 'collected';
		}elseif($status == 'status_in_progress'){
			$arr_data['printing_status'] = 'in_progress';
		}
    	elseif($status == 'status_delivered'){
			$arr_data['printing_status'] = 'delivered';
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


}