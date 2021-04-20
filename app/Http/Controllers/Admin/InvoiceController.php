<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AgentInvoiceModel;
use App\Models\CountryModel;
use App\Common\Services\MailService;
use App\Common\Traits\MultiActionTrait;
use Hash;
use DataTables;
use Validator;
use Session;
use Carbon;
class InvoiceController extends Controller
{
    use MultiActionTrait;

    function __construct(MailService $mail_service)
    {
		$this->arr_view_data                = [];
		$this->admin_panel_slug             = config('app.project.admin_panel_slug');
		$this->admin_url_path               = url(config('app.project.admin_panel_slug'));
		$this->module_url_path              = $this->admin_url_path."/invoices";
		$this->module_title                 = "Inovice ";
		$this->module_view_folder           = "admin.invoice";
		$this->module_icon                  = "fa fa-user";
		$this->auth                         = auth()->guard('admin');
		$this->BaseModel					= new AgentInvoiceModel();
		$this->CountryModel					= new CountryModel();

		$this->user_profile_image_base_img_path   = base_path().config('app.project.img_path.user_profile_image');
		$this->user_profile_image_public_img_path = url('/').config('app.project.img_path.user_profile_image');
		$this->agent_invoice_base_img_path   	  = base_path().config('app.project.img_path.agent_invoice');
		$this->agent_invoice_public_img_path      = url('/').config('app.project.img_path.agent_invoice');
    }

    //invoices index : AUTHOR (Harsh chauhan)
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

    //load invoices data : AUTHOR (Harsh chauhan)
    public function load_data(Request $request)
	{	
		$build_status_btn       = '';
		$arr_data               = [];
		$arr_search_column     	= $request->input('column_filter');

		$obj_request_data = $this->BaseModel->with('get_agent_details')->orderBy('created_at','DESC');

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

				if(isset($data->invoice_file) ){
					$download_link_url_product    = $this->agent_invoice_public_img_path.'/'.$data->invoice_file;
				}else{
					$download_link_url_product	  = 'javascript:void(0)';
				}


				$action_button_html = '<a  title="" href="'.$download_link_url_product.'" data-original-title="Download" data-id="'.$data->id.'" download><i class="fa fa-download" title="Download"></i></a>';

				$id 					= isset($data->id)? $data->id :'';
				$invoice_id 			= isset($data->invoice_id)? $data->invoice_id :'';
				$agent   				= isset($data->get_agent_details->full_name)? $data->get_agent_details->full_name :'';
				$created_at   			= isset($data->created_at)? get_formated_date($data->created_at) :'';
				$invoice_value 			= isset($data->invoice_amount)? $data->invoice_amount :'';
				$paid_amount 			= isset($data->paid_amount)? $data->paid_amount :'';
				$remaining_amount 		= $invoice_value - $paid_amount;
				if(isset($data->payment_status) && $data->payment_status=='paid' && $remaining_amount<1){

					$payment_status 		= 'Paid';
				}else{
					$payment_status = '<a  title="" href="javascript:void(0)" data-original-title="Pay" data-id="'.$data->id.'" id="open_edit_modal_form_vertical" ><i class="fa fa-wallet" title="Download"></i></a>';
				}

				$payment_date           = isset($data->payment_date)? get_formated_date($data->payment_date) :'';

			
				$i = $key+1;
				$build_result->data[$key]->id         		    = $id;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->invoice_id       	= $invoice_id;
				$build_result->data[$key]->agent         		= $agent;
				$build_result->data[$key]->created_at        	= $created_at;
				$build_result->data[$key]->invoice_value 		= $invoice_value;
				$build_result->data[$key]->paid_amount       	= $paid_amount;
				$build_result->data[$key]->remaining_amount     = $remaining_amount;
				$build_result->data[$key]->payment_status       = $payment_status;
				$build_result->data[$key]->payment_date        	= $payment_date;
				$build_result->data[$key]->built_action_btns    = $action_button_html;
				
			}
			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
	}

	//get invoices data : AUTHOR (Harsh chauhan)
	public function get_invoice_data(Request $request,$enc_id)
    {
    	$id = base64_decode($enc_id);
    	$arr_data = $arr_resp = [];

    	$obj_data = $this->BaseModel->with('get_agent_details')
									 ->where('id',$id)
									 ->first();

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


    //change status : AUTHOR (Harsh chauhan)
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

	//paid amount: AUTHOR (Harsh chauhan)
	 public function pay_invoice(Request $request)
	{
		$arr_rules      = $arr_data = array();
		$status         = false;

		$arr_rules['paid_amount']      	   	= "required";
	
		$id = base64_decode($request->input('enc_id'));

		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$arr_data['paid_amount']    	=   $request->input('paid_amount', null);	
		$arr_data['payment_status']	    =	'paid';	


		$status = $this->BaseModel->where('id',$id)->update($arr_data);

		if($status)
		{
			Session::flash('success', 'Invoice status changed successfully.');
			return redirect($this->module_url_path);
		}

		Session::flash('error', 'Error while updating Invoice.');
		return redirect($this->module_url_path);
	}

	//export invoices : AUTHOR (Harsh chauhan)
	 public function export_invoices(Request $request)
    {   
        $arr_data =   $arr_invoices = $arr    = [];

        $start_date   = isset($request->start_date) && !empty($request->start_date) ? $request->start_date : '';

        $end_date     = isset($request->end_date) && !empty($request->end_date) ? $request->end_date : '';

        $obj_invoices = $this->BaseModel->with('get_agent_details')
										   ->get();
        if($obj_invoices)
        { 
        	$arr_invoices    = $obj_invoices->toArray();

            $num = 1;
            foreach ($arr_invoices as $key => $data) 
            {
                $build_status_btn = $build_volunteer_btn = '';

                if(isset($arr_invoices) && sizeof($arr_invoices)>0)
                {   
                  
                    $arr_data['id']         	  = $num;
                    $arr_data['invoice_id']  	  = isset($data['invoice_id']) && !empty($data['invoice_id']) ? $data['invoice_id']:'-';

                    $arr_data['agent'] 			  = isset($data['get_agent_details']['full_name']) && !empty($data['get_agent_details']['full_name'])  ? $data['get_agent_details']['full_name']:'-';  

                 
                    $arr_data['created_at']  	  = isset($data['created_at']) && !empty($data['created_at']) ? get_formated_date($data['created_at']):'-'; 

                    $arr_data['invoice_amount']	  = $invoice_amount = isset($data['invoice_amount']) && !empty($data['invoice_amount']) ? $data['invoice_amount']:'-'; 
                    $arr_data['paid_amount'] 	  = $paid_amount	= isset($data['paid_amount']) && !empty($data['paid_amount']) ? $data['paid_amount']:'-'; 
                    $remaining_amount 			  = $invoice_amount - $paid_amount;
                    $arr_data['remaining_amount'] =    $remaining_amount; 
                    $arr_data['payment_status']   = isset($data['payment_status']) && !empty($data['payment_status']) ? $data['payment_status']:'-'; 
                    $arr_data['payment_date']   = isset($data['payment_date']) && !empty($data['payment_date']) ? get_formated_date($data['payment_date']):'-'; 

                    array_push($this->arr_view_data, $arr_data);
                    $num++;
                }
            }
            if(isset($this->arr_view_data) && !empty($this->arr_view_data))
            {  
            	// For export as CSV 
                // $start_date_month   = date("d_M", strtotime($start_date));
                // $end_date_month     = date("d_M", strtotime($end_date));
                // $date = Carbon\Carbon::now()->format('Y-m-d'); 
                // $filename           = 'Invoices_report_till_'.$date;
                // $output = fopen("php://output",'w') or die("Can't open php://output");
                // header("Content-Type:application/csv"); 
                // header("Content-Disposition:attachment;filename=".$filename.".csv"); 
                // fputcsv($output, array('Sr.No','Invoice ID','Agent','Date','Invoice Value','Paid Amount','Remaining Payment','Payment Date'));
                // foreach($this->arr_view_data as $product) {
                //     fputcsv($output, $product);
                // }
                // fclose($output) or die("Can't close php://output");

                // For export as excel
                $table = '<table><tbody><tr><td>Sr.No</td><td>Invoice ID</td><td>Agent</td><td>Date</td><td>Invoice Value</td><td>Paid Amount</td><td>Remaining Payment</td><td>Payment Status</td><td>Payment Date</td></tr>';
				foreach ($this->arr_view_data as $row) {
				    $table.= '<tr><td>'.  implode('</td><td>', $row) . '</td></tr>';
				}
				$table.= '</tbody></table>';

				header('Content-Encoding: UTF-8');
				header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
				header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
				header ("Cache-Control: no-cache, must-revalidate");
				header ("Pragma: no-cache");
				header ("Content-type: application/x-msexcel;charset=UTF-8");
				header ("Content-Disposition: attachment; filename=Invoice.xls" );

				echo $table;
            }
            else
            {
                Session::flash('error','No data found.');
                return redirect()->back();
            }
        }
    }



}