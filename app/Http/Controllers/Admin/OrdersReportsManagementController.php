<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrdersModel;
use App\Common\Services\MailService;
use App\Common\Traits\MultiActionTrait;

use DataTables;
use Validator;
use Session;
use Carbon\Carbon;

class OrdersReportsManagementController extends Controller
{
    use MultiActionTrait;

    function __construct(MailService $mail_service)
    {
		$this->arr_view_data                = [];
		$this->admin_panel_slug             = config('app.project.admin_panel_slug');
		$this->admin_url_path               = url(config('app.project.admin_panel_slug'));
		$this->module_url_path              = $this->admin_url_path."/reports/orders";
		$this->module_title                 = "Reports";
		$this->module_view_folder           = "admin.reports";
		$this->module_icon                  = "fa fa-user";
		$this->auth                         = auth()->guard('admin');
        $this->OrdersModel                  = new OrdersModel();
    }

    //orders report index      : AUTHOR (Akshay Ugale)
    public function index()
    {
		$this->arr_view_data['page_title']          	= "Orders ".$this->module_title;
        $this->arr_view_data['parent_module_icon']  	= "fa fa-home";
        $this->arr_view_data['parent_module_title'] 	= "Orders";
        $this->arr_view_data['module_title']        	= "Orders ".$this->module_title;
		$this->arr_view_data['module_url_path']     	= $this->module_url_path;
		$this->arr_view_data['admin_url_path']      	= $this->admin_url_path;
		$this->arr_view_data['admin_panel_slug']    	= $this->admin_panel_slug;

		return view($this->module_view_folder.'.orders_report',$this->arr_view_data);
    }

    //orders report data      : AUTHOR (Akshay Ugale)
    public function get_orders(Request $request)
	{	
        $arr_rules      = $arr_orders  = array();
		$status         = false;

		$arr_rules['from_date']      	   	        = "required";
		$arr_rules['to_date']      	   		= "required";

		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}
        $start_date      = $request->input('from_date', null);
        $end_date        = $request->input('to_date', null);

        $obj_orders     = $this->OrdersModel
                                            ->with('get_customer_details','get_delivery_type','get_city')
                                            ->whereRaw("((DATE('".date('c',strtotime($start_date))."') BETWEEN DATE(created_at) AND DATE(created_at)) OR (DATE('".date('c', strtotime($end_date))."') BETWEEN DATE(created_at) AND DATE(created_at)) OR (DATE(created_at) BETWEEN DATE('".date('c',strtotime($start_date))."') AND DATE('".date('c', strtotime($end_date))."')) OR (DATE(created_at) BETWEEN DATE('".date('c',strtotime($start_date))."') AND DATE('".date('c', strtotime($end_date))."'))) ")
        				                    ->orderBy('created_at','desc')
                                            ->get();
       
        if($obj_orders)
        {
            $arr_orders = $obj_orders->toArray();
        }

        $this->arr_view_data['page_title']          	= "Orders ".$this->module_title;
        $this->arr_view_data['parent_module_icon']  	= "fa fa-home";
        $this->arr_view_data['parent_module_title'] 	= "Orders";
        $this->arr_view_data['module_title']        	= "Orders ".$this->module_title;
		$this->arr_view_data['module_url_path']     	= $this->module_url_path;
		$this->arr_view_data['admin_url_path']      	= $this->admin_url_path;
        $this->arr_view_data['admin_panel_slug']    	= $this->admin_panel_slug;
        $this->arr_view_data['arr_orders']    	        = $arr_orders;
		
		return view($this->module_view_folder.'.orders_report',$this->arr_view_data);
        
	}

    //orders report export      : AUTHOR (Akshay Ugale)
	public function export_orders(Request $request)
	{	
        $arr_data               = [];

        $start_date      = $request->input('export_from_date', null);
        $end_date        = $request->input('export_to_date', null);

		$obj_orders     = $this->OrdersModel
                                            ->with('get_customer_details','get_delivery_type','get_city')
                                            ->whereRaw("((DATE('".date('c',strtotime($start_date))."') BETWEEN DATE(created_at) AND DATE(created_at)) OR (DATE('".date('c', strtotime($end_date))."') BETWEEN DATE(created_at) AND DATE(created_at)) OR (DATE(created_at) BETWEEN DATE('".date('c',strtotime($start_date))."') AND DATE('".date('c', strtotime($end_date))."')) OR (DATE(created_at) BETWEEN DATE('".date('c',strtotime($start_date))."') AND DATE('".date('c', strtotime($end_date))."'))) ")
        				                    ->orderBy('created_at','desc')
                                            ->get();
       

        if($obj_orders)
        {  
            $arr_obj_data    = $obj_orders->toArray();
            $num = 1;
            foreach ($arr_obj_data as $key => $data) 
            {
                $build_status_btn = '';

                if(isset($arr_obj_data) && sizeof($arr_obj_data)>0)
                {	
                    if(isset($data['status']) && $data['status'] != null && $data['status'] == "0")
                    {
                        $build_status_btn = 'Inactive';
                    }
                    else if(isset($data['status']) && $data['status'] != null && $data['status'] == "1")
                    {
                       $build_status_btn = 'Active';
                    }
                    $arr_data['id']             = $num;
                    $arr_data['customer_id']    = isset($data['get_customer_details']['customer_id'])? $data['get_customer_details']['customer_id'] :'-';

                    $arr_data['customer_name']  = isset($data['get_customer_details']['full_name'])? $data['get_customer_details']['full_name'] :'-';

                    $arr_data['consumer_type']	= "Consumer";
                    
					$arr_data['order_amount']   = isset($data['order_total_amount'])? $data['order_total_amount'] :'-';                    
					$arr_data['order_city']     = isset($data['get_city']['city_english_name'])? $data['get_city']['city_english_name'] :'-'; 
                    $arr_data['delivery_type']  = isset($data['get_delivery_type']['delivery_type'])? $data['get_delivery_type']['delivery_type'] :'-';
                    $arr_data['time']           = '00:00:00 PM/AM';
                    $arr_data['rating']         = 'Not Rated';
                             
                    array_push($this->arr_view_data, $arr_data);
                    $num++;
                }
            }
            if(isset($this->arr_view_data) && !empty($this->arr_view_data))
            {   

                $filename           = 'orders_report_'.date('Y-m-d_H:i:s');
                $output = fopen("php://output",'w') or die("Can't open php://output");
                header("Content-Type:application/csv"); 
                header("Content-Disposition:attachment;filename=".$filename.".csv");
                
                fputcsv($output, array('Sr.No','Customer ID', 'Customer Name', 'Type', 'Order Amount', 'City', 'Delivery Type', 'TIme', 'Rate'));
                foreach($this->arr_view_data as $order) 
                {
                    fputcsv($output, $order);
                }
				fclose($output) or die("Can't close php://output");
            }
            else
            {
                Session::flash('error','No data found.');
                return redirect()->back();
            }
        }
	}
}
