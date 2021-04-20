<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CustomerModel;
use App\Common\Services\MailService;
use App\Common\Traits\MultiActionTrait;

use DataTables;
use Validator;
use Session;
use Carbon\Carbon;

class CustomersReportsManagementController extends Controller
{
    use MultiActionTrait;

    function __construct(MailService $mail_service)
    {
		$this->arr_view_data                = [];
		$this->admin_panel_slug             = config('app.project.admin_panel_slug');
		$this->admin_url_path               = url(config('app.project.admin_panel_slug'));
		$this->module_url_path              = $this->admin_url_path."/reports/customers";
		$this->module_title                 = "Reports";
		$this->module_view_folder           = "admin.reports";
		$this->module_icon                  = "fa fa-user";
		$this->auth                         = auth()->guard('admin');
		$this->BaseModel					= new CustomerModel();
    }

	//Customer report index     : AUTHOR (Akshay Ugale)
    public function index()
    {
		$obj_customers 			= $this->BaseModel->get();
		$obj_active_customers 	= $this->BaseModel->where('status','=','1')->get();

		$dates = $month = $customer = array();
        $year = date('Y');
		for ($i = 0; $i < 12; $i++) 
		{
			$arr_months[] = date('Y-m-d', strtotime("-$i month"));
		}
        foreach ($arr_months as $key => $value) 
        {
        	$first_day_this_month = date('Y-m-01',strtotime($value));
        	$last_day_this_month  = date('Y-m-t',strtotime($value));
        	$month_name = date('M',strtotime($value));
        	$month_id = date('m',strtotime($value));
        	$user_count = $this->BaseModel->where('created_at','>=',$first_day_this_month)
                                           ->where('created_at','<=',$last_day_this_month)
                                           ->count();

            $dates[] = array("month"=>$month_name,"month_id"=>$month_id,"user_count"=>$user_count);
            
		}
		foreach($dates as $data)
		{
			$month[] 	= $data['month'];
			$customer[] = $data['user_count'];
		}
		$this->arr_view_data['page_title']          	= "Customers ".$this->module_title;
        $this->arr_view_data['parent_module_icon']  	= "fa fa-home";
        $this->arr_view_data['parent_module_title'] 	= "Customers";
        $this->arr_view_data['parent_module_url']   	= url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']         	= $this->module_icon;
        $this->arr_view_data['module_title']        	= "Customers ".$this->module_title;
		$this->arr_view_data['module_url_path']     	= $this->module_url_path;
		$this->arr_view_data['admin_url_path']      	= $this->admin_url_path;
		$this->arr_view_data['admin_panel_slug']    	= $this->admin_panel_slug;
		$this->arr_view_data['total_customer_count'] 	= count($obj_customers);
		$this->arr_view_data['active_customer_count'] 	= count($obj_active_customers);
		$this->arr_view_data['month'] 					= array_reverse($month);
		$this->arr_view_data['customer'] 				= array_reverse($customer);
		$this->arr_view_data['month_customer_data'] 	= $dates;
		
		return view($this->module_view_folder.'.customers_report',$this->arr_view_data);
    }

	//Customer report load data     : AUTHOR (Akshay Ugale)
    public function load_data_all_user(Request $request)
	{	
		$build_status_btn       = '';
		$arr_data               = [];
		$obj_request_data = $this->BaseModel;

		$obj_request_data = $obj_request_data->get();

		$json_result 	= DataTables::of($obj_request_data)->make(true);
		$build_result 	= $json_result->getData();

		if(isset($build_result->data) && sizeof($build_result->data)>0)
		{
			foreach ($build_result->data as $key => $data) 
			{				
				$user_id  			= isset($data->customer_id)? $data->customer_id :'';
				$full_name 			= isset($data->full_name)? $data->full_name :'';
				$customer_group 	= isset($data->customer_group)? $data->customer_group :'';
				$id 	    		= isset($data->id)? base64_encode($data->id):'';
				
				$rank 				= 0;
				$order_hash 		= 0;
				$order_dollar 		= 0;
				$balance 			= 0;
				$age 	    		= isset($data->date_of_birth)? Carbon::parse($data->date_of_birth)->diff(Carbon::now())->format('%yY %mM'):'';

				$i = $key+1;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->id         		    = $user_id;
				$build_result->data[$key]->name			        = $full_name;
				$build_result->data[$key]->type         		= $customer_group;
				$build_result->data[$key]->rank        			= $rank;
				$build_result->data[$key]->order_hash    		= $order_hash;
				$build_result->data[$key]->order_dollar    		= $order_dollar;
				$build_result->data[$key]->balance    			= $balance;
				$build_result->data[$key]->age    				= $age;
				
			}
			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
	}

	//Customer report export     : AUTHOR (Akshay Ugale)
	public function export(Request $request)
	{	
        $arr_data               = [];

		$obj_customer_data = $this	->BaseModel->with('get_group_details')->get();
		
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
                    $arr_data['id']          = $num;
                    $arr_data['customer_id'] = isset($data['customer_id']) && !empty($data['customer_id']) ? $data['customer_id']:'-';

                    $arr_data['full_name']   = isset($data['full_name']) && !empty($data['full_name']) ? $data['full_name']:'-'; 

					$arr_data['type']		 = isset($data['get_group_details']['group_name']) && !empty($data['get_group_details']['group_name']) ? $data['get_group_details']['group_name']:'-'; 

					$arr_data['order_#']     = '-';                    
					$arr_data['orders_$']    = '-'; 
					$arr_data['balance']     = '-';

                    $arr_data['age']      	 = isset($data['date_of_birth'])? Carbon::parse($data['date_of_birth'])->diff(Carbon::now())->format('%yY %mM'):'';;
               
                             
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

				// Session::flash('success','Customer data exported into file "'.$filename.'.csv".');
                // return redirect()->back();
            }
            else
            {
                Session::flash('error','No data found.');
                return redirect()->back();
            }
        }
	}
}
