<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrdersModel;
use App\Models\CustomerModel;
use App\Common\Services\MailService;
use App\Common\Traits\MultiActionTrait;

use DataTables;
use Validator;
use Session;
use Carbon\Carbon;

class SalesReportsManagementController extends Controller
{
    use MultiActionTrait;

    function __construct(MailService $mail_service)
    {
		$this->arr_view_data                = [];
		$this->admin_panel_slug             = config('app.project.admin_panel_slug');
		$this->admin_url_path               = url(config('app.project.admin_panel_slug'));
		$this->module_url_path              = $this->admin_url_path."/reports/sales";
		$this->module_title                 = "Reports";
		$this->module_view_folder           = "admin.reports";
		$this->module_icon                  = "fa fa-user";
		$this->auth                         = auth()->guard('admin');
        $this->OrdersModel                  = new OrdersModel();
        $this->CustomerModel                = new CustomerModel();
    }

    //Listing of sales report     : AUTHOR (Akshay Ugale)
    public function index()
    {
        $todays_order_count         = $this->OrdersModel->whereDay('created_at', now()->day)->count();
        
        $yesterdays_order_count     = $this->OrdersModel->whereDay('created_at', now()->day-1)->count();

        $monthly_order_count        = $this->OrdersModel->whereMonth('created_at', now()->month)->count();

        $total_order_count          = $this->OrdersModel->count();

        $todays_sale                = '00';
        $yesterdays_sale            = '00';
        $monthly_sale               = '00';
        $total_sale                 = '00';

		$this->arr_view_data['page_title']          	= "Sales ".$this->module_title;
        $this->arr_view_data['parent_module_icon']  	= "fa fa-home";
        $this->arr_view_data['parent_module_title'] 	= "Sales";
        $this->arr_view_data['module_title']        	= "Sales ".$this->module_title;
		$this->arr_view_data['module_url_path']     	= $this->module_url_path;
		$this->arr_view_data['admin_url_path']      	= $this->admin_url_path;
		$this->arr_view_data['admin_panel_slug']    	= $this->admin_panel_slug;
		$this->arr_view_data['todays_order_count'] 	    = $todays_order_count;
		$this->arr_view_data['yesterdays_order_count'] 	= $yesterdays_order_count;
		$this->arr_view_data['monthly_order_count'] 	= $monthly_order_count;
        $this->arr_view_data['total_order_count'] 		= $total_order_count;
        $this->arr_view_data['todays_sale'] 		    = $todays_sale;
        $this->arr_view_data['yesterdays_sale'] 		= $yesterdays_sale;
        $this->arr_view_data['monthly_sale'] 		    = $monthly_sale;
        $this->arr_view_data['total_sale'] 		        = $total_sale;
		// dd($dates);
		return view($this->module_view_folder.'.sales_report',$this->arr_view_data);
    }

    //Ajax call of sales  listing  report    : AUTHOR (Akshay Ugale)
    public function load_data(Request $request)
	{	
		$build_status_btn       = '';
		$arr_data               = [];
		$obj_request_data = $this->OrdersModel;

		$obj_request_data = $obj_request_data->orderBy('created_at', 'DESC')->get();

		$json_result 	= DataTables::of($obj_request_data)->make(true);
		$build_result 	= $json_result->getData();

		if(isset($build_result->data) && sizeof($build_result->data)>0)
		{
			foreach ($build_result->data as $key => $data) 
			{
                $user_count         = $this->CustomerModel->whereDate('created_at', '=', date('Y-m-d', strtotime($data->created_at)))->count();
                
                $date  			    = isset($data->created_at)? date('d-m-Y', strtotime($data->created_at)) :'-';
                $day_name  			= isset($data->created_at)? Carbon::parse($data->created_at)->format('l') :'-';
				$user_count 		= $user_count;                
				$id 	    		= isset($data->id)? base64_encode($data->id):'';
				
				$total_orders 		= 0;
				$total_sales 		= 0;
				$total_cost 		= 0;
				$total_margin 		= 0;

				$i = $key+1;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->id         		    = $id;
				$build_result->data[$key]->date			        = $date;
                $build_result->data[$key]->day_name         	= $day_name;
                $build_result->data[$key]->user_count         	= $user_count;
				$build_result->data[$key]->total_orders        	= $total_orders;
				$build_result->data[$key]->total_sales    		= $total_sales;
				$build_result->data[$key]->total_cost    		= $total_cost;
				$build_result->data[$key]->total_margin    		= $total_margin;
				
			}
			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
	}

    // sales  export report    : AUTHOR (Akshay Ugale)
	public function export(Request $request)
	{	
        $arr_data               = [];

		$obj_customer_data = $this	->OrdersModel->orderBy('created_at', 'DESC')->get();
		
        if($obj_customer_data)
        {   $arr_obj_data    = $obj_customer_data->toArray();
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
                    $arr_data['date']           = isset($data['created_at'])? date('d-m-Y', strtotime($data['created_at'])) :'-';

                    $arr_data['day_name']       = isset($data['created_at'])? Carbon::parse($data['created_at'])->format('l') :'-';

                    $arr_data['user_count']		= $this->CustomerModel->whereDate('created_at', '=', date('Y-m-d', strtotime($data['created_at'])))->count();
                    
					$arr_data['total_orders']   = '-';                    
					$arr_data['total_sales']    = '-'; 
                    $arr_data['total_cost']     = '-';
                    $arr_data['total_margin']   = '-';

                    dd($arr_data);
                             
                    array_push($this->arr_view_data, $arr_data);
                    $num++;
                }
            }
            if(isset($this->arr_view_data) && !empty($this->arr_view_data))
            {   

                $filename           = 'customer_report_'.date('Y-m-d_H:i:s');
                $output = fopen("php://output",'w') or die("Can't open php://output");
                header("Content-Type:application/csv"); 
                header("Content-Disposition:attachment;filename=".$filename.".csv");
                
                fputcsv($output, array('Sr.No','ID', 'Name', 'Type', 'Rank', 'Orders #', 'Orders $', 'Balance', 'Age'));
                foreach($this->arr_view_data as $customer) 
                {
                    fputcsv($output, $customer);
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
