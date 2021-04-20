<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SampleKitOrdersModel;
use App\Models\CountryModel;
use App\Common\Services\MailService;
use App\Common\Traits\MultiActionTrait;
use Hash;
use DataTables;
use Validator;
use Session;
class SampleKitOrdersController extends Controller
{
    use MultiActionTrait;

    function __construct(MailService $mail_service)
    {
		$this->arr_view_data                = [];
		$this->admin_panel_slug             = config('app.project.admin_panel_slug');
		$this->admin_url_path               = url(config('app.project.admin_panel_slug'));
		$this->module_url_path              = $this->admin_url_path."/orders/samplekit_orders";
		$this->module_title                 = "Sample Kit ";
		$this->module_view_folder           = "admin.orders";
		$this->module_icon                  = "fa fa-user";
		$this->auth                         = auth()->guard('admin');
		$this->BaseModel					= new SampleKitOrdersModel();
		$this->CountryModel					= new CountryModel();

		$this->user_profile_image_base_img_path   = base_path().config('app.project.img_path.user_profile_image');
		$this->user_profile_image_public_img_path = url('/').config('app.project.img_path.user_profile_image');
    }
    // sample kit listing: AUTHOR (Harsh Chauhan)
    public function samplekit_orders()
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
		
		return view($this->module_view_folder.'.samplekit_orders',$this->arr_view_data);
    }

    // ajax load sample kit data: AUTHOR (Harsh Chauhan)
    public function load_samplekitorders_data(Request $request)
	{	
		$build_status_btn       = '';
		$arr_data               = [];
		$arr_search_column     	= $request->input('column_filter');

		$obj_request_data = $this->BaseModel->with('get_customer_details')->orderBy('created_at','DESC');

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

				// $action_button_html = '<a  title="" href="'.$view_link_url.'" data-original-title="View" data-id="'.$data->id.'" id="open_edit_staff_modal"><i class="fa fa-eye" title="View"></i></a>';
				
				$order_id 		= isset($data->order_id)? $data->order_id :'';
				$full_name 				= isset($data->get_customer_details->full_name)? $data->get_customer_details->full_name :'';
				$customer_id 			= isset($data->get_customer_details->id)? $data->get_customer_details->id :'';
				$view_customer_url      = url('/').'/admin/customers/edit_customer/'.base64_encode($customer_id);
				$full_name_anchor       = '<a  title="" href="'.$view_customer_url.'" data-original-title="View customer" >'.$full_name.'</a>';
				$product    	= isset($data->product)? $data->product :'-';
				$id 	    	= isset($data->id)? base64_encode($data->id):'';
			
				$i = $key+1;
				$build_result->data[$key]->id         		    = $id;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->order_id             = $order_id;
				$build_result->data[$key]->customer_name        = $full_name_anchor;
				$build_result->data[$key]->product        		= $product;
				
			}
			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
	}


}