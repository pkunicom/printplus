<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CountryModel;
use App\Models\DesignOrdersModel;
use App\Models\DesignOrdersRequestModel;
use App\Models\DesignOrdersFilesModel;
use App\Models\DesignOrderExtraNotesModel;
use App\Models\DesignOrderStatusHistoryModel;
use App\Models\DesignOrdersQuotationModel;
use App\Common\Services\MailService;
use App\Common\Traits\MultiActionTrait;
use Hash;
use DataTables;
use Validator;
use Session;

class DesignOrderManagementController extends Controller
{
    use MultiActionTrait;

    function __construct(MailService $mail_service)
    {
		$this->arr_view_data                	= [];
		$this->admin_panel_slug             	= config('app.project.admin_panel_slug');
		$this->admin_url_path               	= url(config('app.project.admin_panel_slug'));
		$this->module_url_path             		= $this->admin_url_path."/orders/design_orders";
		$this->module_title                 	= "Orders ";
		$this->module_view_folder           	= "admin.orders";
		$this->module_icon                  	= "fa fa-user";
		$this->auth                         	= auth()->guard('admin');
		$this->CountryModel						= new CountryModel();
		$this->BaseModel						= new DesignOrdersModel();
		$this->DesignOrdersRequestModel			= new DesignOrdersRequestModel();
		$this->DesignOrdersFilesModel			= new DesignOrdersFilesModel();
		$this->DesignOrderExtraNotesModel		= new DesignOrderExtraNotesModel();
		$this->DesignOrderStatusHistoryModel	= new DesignOrderStatusHistoryModel();
		$this->DesignOrdersQuotationModel		= new DesignOrdersQuotationModel();

		$this->user_profile_image_base_img_path   = base_path().config('app.project.img_path.user_profile_image');
		$this->user_profile_image_public_img_path = url('/').config('app.project.img_path.user_profile_image');

		$this->design_request_image_base_img_path   = base_path().config('app.project.img_path.design_request');
		$this->design_request_image_public_img_path = url('/').config('app.project.img_path.design_request');
    }
    // design_orders index : AUTHOR (Harsh chauhan)
    public function design_orders()
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
		
		return view($this->module_view_folder.'.design_orders',$this->arr_view_data);
    }
    // load design_orders data : AUTHOR (Harsh chauhan)
    public function load_designorders_data(Request $request)
	{	
		$build_status_btn       = '';
		$arr_data               = [];
		$arr_search_column     	= $request->input('column_filter');

		$obj_request_data = $this->BaseModel->with(['get_customer_details'=>function($q){
												$q->with('get_group_details');
											}])
											->orderBy('created_at','DESC');

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
				
				$arr_roles = [];

				$action_button_html = ' <a  title="" href="'.$view_link_url.'" data-original-title="View" data-id="'.$data->id.'" id="open_edit_staff_modal"><i class="fa fa-download" title="Download"></i></a>';
				
				$id 	    			= isset($data->id)? base64_encode($data->id):'';
				$order_id 				= isset($data->order_id)? $data->order_id :'';
				$view_orderdetail_url   = url('/').'/admin/orders/design_orders/edit_design_orders/'.$id;
				$order_id_anchor        = '<a  title="" href="'.$view_orderdetail_url.'" data-original-title="View Order details" >'.$order_id.'</a>';
				$full_name 				= isset($data->get_customer_details->full_name)? $data->get_customer_details->full_name :'';
				$customer_id 			= isset($data->get_customer_details->id)? $data->get_customer_details->id :'';
				$view_customer_url      = url('/').'/admin/customers/edit_customer/'.base64_encode($customer_id);
				$full_name_anchor       = '<a  title="" href="'.$view_customer_url.'" data-original-title="View customer" >'.$full_name.'</a>';
				$customer_group 		= isset($data->get_customer_details->get_group_details->group_name)? $data->get_customer_details->get_group_details->group_name :'';
				$value 					= isset($data->value)? $data->value :'';
				$quote_status 			= isset($data->quote_status)? $data->quote_status :'';
				$design_status 			= isset($data->design_status)? $data->design_status :'';
				$assigned_to 			= isset($data->assigned_to)? $data->assigned_to :'';
				$created_at 			= isset($data->created_at)? get_formated_date($data->created_at) :'';


				$i = $key+1;
				$build_result->data[$key]->id         		    = $id;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->order_id        		= $order_id_anchor;
				$build_result->data[$key]->customer_name        = $full_name_anchor;
				$build_result->data[$key]->customer_group       = $customer_group;
				$build_result->data[$key]->value       			= $value;
				$build_result->data[$key]->quote_status        	= $quote_status;
				$build_result->data[$key]->design_status      	= $design_status;
				$build_result->data[$key]->assigned_to      	= $assigned_to;
				$build_result->data[$key]->created_at        	= $created_at;
				$build_result->data[$key]->built_action_btns    = $action_button_html;
				
			}
			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
	}

	//edit  design order  : AUTHOR (Harsh chauhan)
  	public function edit_design_orders($enc_id)
    {
    	$arr_data = [];
    	$id = base64_decode($enc_id);

    	$obj_data = $this->BaseModel->with(['get_customer_details'=>function($q){
												$q->with('get_group_details');
											}])
    								->where('id',$id)->first();

    	if($obj_data){
    		$arr_data = $obj_data->toArray();
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
		
		return view($this->module_view_folder.'.edit_design_orders',$this->arr_view_data);
    }

    //load order detail data  : AUTHOR (Harsh chauhan)
     public function load_orderdetails_data(Request $request,$enc_id)
	{	
		$order_id = base64_decode($enc_id);

		$build_status_btn       = '';
		$arr_data               = [];
		$arr_search_column     	= $request->input('column_filter');

		$obj_request_data = $this->DesignOrdersRequestModel->with('get_order_details')	
															->where('design_order_id',$order_id)
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
				if(isset($data->file)){

					$view_link_url    = $this->design_request_image_public_img_path.$data->file;
				}else{

					$view_link_url    = "javascript:void(0)";

				}
				
				$action_button_html = ' <a  title="download" href="'.$view_link_url.'" data-original-title="download" download><i class="fa fa-download" title="Download"></i></a>';
				
				
				$arr_roles = $arr_product_options = [];

				$id 	    			= isset($data->id)? base64_encode($data->id):'';
				$request_id 			= isset($data->request_id)? $data->request_id :'';
				$design_request 		= isset($data->design_request)? $data->design_request :'';
				$file 					= isset($data->file)? $data->file :'';

				
				$i = $key+1;
				$build_result->data[$key]->id         		    = $id;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->request_id        	= $request_id;
				$build_result->data[$key]->design_request       = $design_request;
				$build_result->data[$key]->file       			= $file;
				$build_result->data[$key]->built_action_btns	= $action_button_html;
				
			}
			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
	}

	//load order files data: AUTHOR (Harsh chauhan)
	 public function load_orderfiles_data(Request $request,$enc_id)
	{	
		$order_id = base64_decode($enc_id);

		$build_status_btn       = '';
		$arr_data               = [];
		$arr_search_column     	= $request->input('column_filter');

		$obj_request_data = $this->DesignOrdersFilesModel->where('design_order_id',$order_id)
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
				$built_delete_href    = $this->module_url_path.'/delete_design_files/'.base64_encode($data->id);

				if(isset($data->file)){

					$view_link_url    = $this->design_request_image_public_img_path.$data->file;
					$file = ' <a  title="download" href="'.$view_link_url.'" data-original-title="download" download>'.$data->file.'</a>';
				}else{
					$file = '-';
				}
				// $view_link_url    = "javascript:void(0)";
				
				$arr_roles = $arr_product_options = [];

				$id 	    			= isset($data->id)? base64_encode($data->id):'';
				$uploaded_by 			= isset($data->uploaded_by)? $data->uploaded_by :'';
				$created_at 			= isset($data->created_at)? get_formated_date($data->created_at) :'';
				$action 				=	'<a href='.$built_delete_href.'  title="delete" onclick="return confirm_action(this,event,\'Do you really want to delete this File ?\')"><i class="fa fa-trash"></i></a>';
				
				$i = $key+1;
				$build_result->data[$key]->id         		    = $id;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->file       			= $file;
				$build_result->data[$key]->uploaded_by       	= $uploaded_by;
				$build_result->data[$key]->created_at       	= $created_at;
				$build_result->data[$key]->built_action_btns	= $action;
				
			}
			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
	}

	//delete design order files: AUTHOR (Harsh chauhan)
	public function delete_design_files(Request $request,$enc_id)
	{	
		$design_file_id = base64_decode($enc_id);

		$obj_check = $this->DesignOrdersFilesModel->where('id',$design_file_id)->first();

		$order_id = isset($obj_check->design_order_id) ? ($obj_check->design_order_id) :'';

		$obj_delete = $this->DesignOrdersFilesModel->where('id',$design_file_id)->delete();

		if($obj_delete){
			Session::flash('success', 'File deleted successfully.');
			return redirect($this->module_url_path.'/edit_design_orders/'.base64_encode($order_id));
    	}else{
    		Session::flash('error', 'Something went wrong.');
			return redirect($this->module_url_path.'/edit_design_orders/'.base64_encode($order_id));
    	}
	}

	//store  design order file  : AUTHOR (Harsh chauhan)
	public function store_design_order_file(Request $request)
	{	
		$arr_data = $arr_rules = [];

    	$arr_rules['design_order_file']      	= "required";
		$arr_rules['order_id']      			= "required";

		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$order_id = $request->input('order_id', null);

		$arr_data['design_order_id']		=	$request->input('order_id', null);	
		$arr_data['uploaded_by']			=	'Admin';	

		if($request->hasFile('design_order_file'))
		{         
			$file_extension = strtolower($request->file('design_order_file')->getClientOriginalExtension());
			
			$file     = $request->file('design_order_file');
			$filename = sha1(uniqid().uniqid()) . '.' . $file->getClientOriginalExtension();
			$path     = $this->design_request_image_base_img_path . $filename;
			$isUpload = $file->move($this->design_request_image_base_img_path , $filename);
			if($isUpload)
			{
				$arr_data['file'] = $filename;
			}
			else
			{
				$arr_data['file'] = '-';
			}
		}

		$obj_add = $this->DesignOrdersFilesModel->create($arr_data);

		if($obj_add){
			Session::flash('success', 'File Added succeffsully  .');
			return redirect($this->module_url_path.'/edit_design_orders/'.base64_encode($request->input('order_id', null)));
    	}else{
    		Session::flash('error', 'Something went wrong.');
			return redirect($this->module_url_path.'/edit_design_orders/'.base64_encode($request->input('order_id', null)));
    	}
	}

	//load extra notes data  : AUTHOR (Harsh chauhan)
	 public function load_extranotes_data(Request $request,$enc_id)
	{	
		$design_order_id = base64_decode($enc_id);

		$build_status_btn       = '';
		$arr_data               = [];
		$arr_search_column     	= $request->input('column_filter');

		$obj_request_data = $this->DesignOrderExtraNotesModel->with('get_order_details')	
															->where('design_order_id',$design_order_id)
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

	//store design order note  : AUTHOR (Harsh chauhan)
    public function store_design_order_note(Request $request)
    {
    	$arr_data = $arr_rules = [];

    	$arr_rules['note']      	= "required";
		$arr_rules['note_order_id']      = "required";

		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$order_id = $request->input('note_order_id', null);

		$arr_data['notes']		=	$request->input('note', null);	
		$arr_data['design_order_id']	=	$request->input('note_order_id', null);	
		$arr_data['added_by']	=	'Admin';	
		
		$create_agent_product = $this->DesignOrderExtraNotesModel->create($arr_data);

    	if($create_agent_product){
    		Session::flash('success', 'Note Added successfully  .');
			return redirect($this->module_url_path.'/edit_design_orders/'.base64_encode($order_id));
    	}else{
    		Session::flash('error', 'Something went wrong.');
			return redirect($this->module_url_path.'/edit_design_orders/'.base64_encode($order_id));
    	}
    }

    //product finance detail by id : AUTHOR (Harsh chauhan)
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

    //load order status history  : AUTHOR (Harsh chauhan)
    public function load_orderstatushistory_data(Request $request,$enc_id)
	{	
		$design_order_id = base64_decode($enc_id);

		$build_status_btn       = '';
		$arr_data               = [];
		$arr_search_column     	= $request->input('column_filter');

		$obj_request_data = $this->DesignOrderStatusHistoryModel->with('get_order_details')	
																->where('design_order_id',$design_order_id)
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

	//load orderquotation data  : AUTHOR (Harsh chauhan)
    public function load_orderquotation_data(Request $request,$enc_id)
	{	
		$design_order_id = base64_decode($enc_id);

		$build_status_btn       = '';
		$arr_data               = [];
		$arr_search_column     	= $request->input('column_filter');

		$obj_request_data = $this->DesignOrdersQuotationModel->with('get_order_details')	
															 ->where('design_order_id',$design_order_id)
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
				$service_description    = isset($data->service_description)? $data->service_description :'-';
				$lead_time 				= isset($data->lead_time)? $data->lead_time :'-';
				$price 					= isset($data->price)? $data->price :'';
				

				$i = $key+1;
				$build_result->data[$key]->id         		    = $id;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->service_description  = $service_description;
				$build_result->data[$key]->lead_time        	= $lead_time;
				$build_result->data[$key]->price           		= $price;
				
			}

			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
	}

	// public function delete_compensation(Request $request,$enc_id)
	// {	
	// 	$compensation_id = base64_decode($enc_id);

	// 	$obj_check = $this->PrintingOrderCompensationModel->where('id',$compensation_id)->first();

	// 	$order_id = isset($obj_check->order_id) ? ($obj_check->order_id) :'';

	// 	$obj_delete = $this->PrintingOrderCompensationModel->where('id',$compensation_id)->delete();

	// 	if($obj_delete){
	// 		Session::flash('success', 'Compensation deleted succeffsully  .');
	// 		return redirect($this->module_url_path.'/edit_printing_orders/'.base64_encode($order_id));
 //    	}else{
 //    		Session::flash('error', 'Something went wrong.');
	// 		return redirect($this->module_url_path.'/edit_printing_orders/'.base64_encode($order_id));
 //    	}
	// }

	// public function get_orderproduct_items($enc_id)
 //    {
 //    	$arr_data = $arr_resp = [];
 //    	$id = base64_decode($enc_id);

 //    	$obj_data = $this->PrintingOrderDetailsModel
 //    												 ->with('get_product_details')
 //    												 ->where('id',$id)->get();

 //    	if($obj_data){
 //    		$arr_data = $obj_data->toArray();
    		
 //    		$html = "<option value=''>Select Item</option>";
    	
 //    		foreach ($arr_data as $key => $value) {
    		
 //    			$html .= "<option value=".$value['id'].">".$value['get_product_details']['product_english_name']."</option>";
 //    		}
 //    	}

 //    	$arr_resp['status'] = 'success';
 //    	$arr_resp['data'] 	= $html;

 //    	return $arr_resp;

 //    }

  //    public function store_printing_order_compensation(Request $request)
  //   {
  //   	$arr_data = $arr_rules = [];

  //   	$arr_rules['compensate_item']      	= "required";
		// $arr_rules['compensate_quantity']   = "required";
		// $arr_rules['compensate_owner']      = "required";
		// $arr_rules['compensate_type']      	= "required";

		// $validator = Validator::make($request->all(),$arr_rules);

		// if($validator->fails()) 
		// {
		// 	return redirect()->back()->withErrors($validator)->withInput();
		// }

		// $order_id = $request->input('order_id', null);

		//  $str1 = "0123456789";
  //       $str2 = str_shuffle($str1);
  //       $rand = substr($str2,0,6); 

		// $arr_data['printing_order_detail_id']		=	$request->input('compensate_item', null);	
		// $arr_data['order_id']						=	$request->input('order_id', null);	
		// $arr_data['quantity']						=	$request->input('compensate_quantity', null);	
		// $arr_data['compensation_id']				=	$rand;
		// $arr_data['cost_owner']						=	$request->input('compensate_owner', null);	
		// $arr_data['type']							=	$request->input('compensate_type', null);	
		// $arr_data['notes']							=	$request->input('compensate_note', null);	

		
		// $create_agent_product = $this->PrintingOrderCompensationModel->create($arr_data);

  //   	if($create_agent_product){
  //   		Session::flash('success', 'Compensation Added successfully  .');
		// 	return redirect($this->module_url_path.'/edit_printing_orders/'.base64_encode($order_id));
  //   	}else{
  //   		Session::flash('error', 'Something went wrong.');
		// 	return redirect($this->module_url_path.'/edit_printing_orders/'.base64_encode($order_id));
  //   	}
  //   }


}