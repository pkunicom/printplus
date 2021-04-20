<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EvaluationModel;
use App\Models\CountryModel;
use App\Common\Services\MailService;
use App\Common\Traits\MultiActionTrait;
use Hash;
use DataTables;
use Validator;
use Session;
class EvaluationController extends Controller
{
    use MultiActionTrait;

    function __construct(MailService $mail_service)
    {
		$this->arr_view_data                = [];
		$this->admin_panel_slug             = config('app.project.admin_panel_slug');
		$this->admin_url_path               = url(config('app.project.admin_panel_slug'));
		$this->module_url_path              = $this->admin_url_path."/orders/evaluations";
		$this->module_title                 = "Evaluation ";
		$this->module_view_folder           = "admin.evaluation";
		$this->module_icon                  = "fa fa-user";
		$this->auth                         = auth()->guard('admin');
		$this->BaseModel					= new EvaluationModel();
		$this->CountryModel					= new CountryModel();

		$this->user_profile_image_base_img_path   = base_path().config('app.project.img_path.user_profile_image');
		$this->user_profile_image_public_img_path = url('/').config('app.project.img_path.user_profile_image');
    }

	//evaluation index: AUTHOR (Harsh chauhan)
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

    //load evaluation data: AUTHOR (Harsh chauhan)
    public function load_evaluation_data(Request $request)
	{	
		$build_status_btn       = '';
		$arr_data               = [];
		$arr_search_column     	= $request->input('column_filter');

		$obj_request_data = $this->BaseModel->with('get_customer_details','get_order_details')
											->with(['get_orderproduct_details'=>function($q){
												$q->with('get_product_details');
												$q->with(['get_productoption_selected'=>function($q2){
													$q2->with('get_option_details');
												}]);
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
				
				$arr_roles = $arr_product_options = [];

				$action_button_html = '<a  title="" href="'.$view_link_url.'" data-original-title="View" data-id="'.$data->id.'" id="open_edit_evaluation_modal"><i class="fa fa-cog" title="View"></i></a>';

				$id 					= isset($data->id)? $data->id :'';
				$evaluation_id 			= isset($data->evaluation_id)? $data->evaluation_id :'';
				$order_id 				= isset($data->get_order_details->order_id)? $data->get_order_details->order_id :'';
				$order_id_primary 		= isset($data->get_order_details->id)? $data->get_order_details->id :'';
				$view_orderdetail_url   = url('/').'/admin/orders/edit_printing_orders/'.base64_encode($order_id_primary);
				$order_id_anchor        = '<a  title="" href="'.$view_orderdetail_url.'" data-original-title="View Order details" >'.$order_id.'</a>';
				$full_name 				= isset($data->get_customer_details->full_name)? $data->get_customer_details->full_name :'';
				$customer_id 			= isset($data->get_customer_details->id)? $data->get_customer_details->id :'';
				$view_customer_url      = url('/').'/admin/customers/edit_customer/'.base64_encode($customer_id);
				$full_name_anchor       = '<a  title="" href="'.$view_customer_url.'" data-original-title="View customer" >'.$full_name.'</a>';

				$product_name    		= isset($data->get_orderproduct_details->get_product_details->product_english_name)? $data->get_orderproduct_details->get_product_details->product_english_name :'-';

				$product_name    		= isset($data->get_orderproduct_details->get_product_details->product_english_name)? $data->get_orderproduct_details->get_product_details->product_english_name :'-';
				$evaluation 			= isset($data->evaluation)? $data->evaluation :'';
				$status 				= isset($data->status)? ucfirst(str_replace("_"," ",($data->status))):'-';

				$product_op 			= isset($data->get_orderproduct_details->get_productoption_selected)? $data->get_orderproduct_details->get_productoption_selected :'';

				foreach ($product_op as $ikey => $value) {
					$arr_product_options[] = $value->get_option_details->english_name;
				}

				$option = implode(',', $arr_product_options);

				$i = $key+1;
				$build_result->data[$key]->id         		    = $id;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->evaluation_id        = $evaluation_id;
				$build_result->data[$key]->order_id         	= $order_id_anchor;
				$build_result->data[$key]->customer_name        = $full_name_anchor;
				$build_result->data[$key]->product 		        = $product_name;
				$build_result->data[$key]->option       	    = $option;
				$build_result->data[$key]->status        		= $status;
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

	//get evaluation data by id: AUTHOR (Harsh chauhan)
	public function get_evaluation_data(Request $request,$enc_id)
    {
    	$id = base64_decode($enc_id);
    	$arr_data = $arr_resp = [];

    	$obj_data = $this->BaseModel->with('get_order_details')
									->with(['get_orderproduct_details'=>function($q){
										$q->with('get_product_details');
										$q->with(['get_productoption_selected'=>function($q2){
											$q2->with('get_option_details');
										}]);
									}])
									->with(['get_customer_details'=>function($q){
										$q->with('get_group_details');
									}])
									 ->where('id',$id)->first();

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


    //change evaluation status: AUTHOR (Harsh chauhan)
	public function change_status(Request $request,$enc_id)
	{	
		$id = base64_decode($enc_id);
		$status = $enc_id;		

		$obj_check = $this->BaseModel->where('id',$id)->update(['status'=>'accepted']);

		if($arr_data){
			$arr_resp['status']  	= 'success';
		}else{
			$arr_resp['status'] 	= 'error';
		}

		return $arr_resp;
	}

	//accept evaluation status: AUTHOR (Harsh chauhan)
	public function accept_status(Request $request,$enc_id)
	{	
		$id = base64_decode($enc_id);
		$obj_check = $this->BaseModel->where('id',$id)->update(['status'=>'approved']);

		if($obj_check){
			$arr_resp['status']  	= 'success';
			$arr_resp['msg']  		= 'Evaluation Accepted successfully';
		}else{
			$arr_resp['status'] 	= 'error';
			$arr_resp['msg'] 	= 'Something went wrong';
		}

		return $arr_resp;
	}

	//reject evaluation status: AUTHOR (Harsh chauhan)
	public function reject_status(Request $request,$enc_id)
	{	
		$id = base64_decode($enc_id);
		
		$obj_check = $this->BaseModel->where('id',$id)->update(['status'=>'rejected']);

		if($obj_check){
			$arr_resp['status']  	= 'success';
			$arr_resp['msg']  	= 'Evaluation Rejected successfully';
		}else{
			$arr_resp['status'] 	= 'error';
			$arr_resp['msg'] 	= 'Something went wrong';
		}

		return $arr_resp;
	}



}