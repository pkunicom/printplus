<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AgentModel;
use App\Common\Services\MailService;
use App\Common\Traits\MultiActionTrait;

use DataTables;
use Validator;
use Session;
use Carbon\Carbon;

class AgentsReportsManagementController extends Controller
{
    use MultiActionTrait;

    function __construct(MailService $mail_service)
    {
		$this->arr_view_data                = [];
		$this->admin_panel_slug             = config('app.project.admin_panel_slug');
		$this->admin_url_path               = url(config('app.project.admin_panel_slug'));
		$this->module_url_path              = $this->admin_url_path."/reports/agents";
		$this->module_title                 = "Reports";
		$this->module_view_folder           = "admin.reports";
		$this->module_icon                  = "fa fa-user";
		$this->auth                         = auth()->guard('admin');
		$this->BaseModel					= new AgentModel();
    }

    // index: AUTHOR (Akshay Ugale)
    public function index()
    {
		$this->arr_view_data['page_title']          	= "Customers ".$this->module_title;
        $this->arr_view_data['parent_module_icon']  	= "fa fa-home";
        $this->arr_view_data['parent_module_title'] 	= "Customers";
        $this->arr_view_data['parent_module_url']   	= url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']         	= $this->module_icon;
        $this->arr_view_data['module_title']        	= "Customers ".$this->module_title;
		$this->arr_view_data['module_url_path']     	= $this->module_url_path;
		$this->arr_view_data['admin_url_path']      	= $this->admin_url_path;
		$this->arr_view_data['admin_panel_slug']    	= $this->admin_panel_slug;
		return view($this->module_view_folder.'.agents_report',$this->arr_view_data);
    }

    // load data: AUTHOR (Akshay Ugale)
    public function load_data(Request $request)
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
				
				$agency_name 		= isset($data->agency_name)? $data->agency_name :'';
				$status 	        = isset($data->status)? $data->status :'';
				$id 	    		= isset($data->id)? base64_encode($data->id):'';
                if($status=='1')
                {
                    $status= "Active";
                }
                elseif($status=='0')
                {
                    $status= "Inactive";
                }
                $hash_of_product            = '0';
                $hash_of_orders             = '0';
                $total_sales                = '0';
                $customer_dsatisfaction     = '0';
				$i = $key+1;
				$build_result->data[$key]->sr_no               		= $i;
				$build_result->data[$key]->agency_name			    = $agency_name;
                $build_result->data[$key]->status			        = $status;
                $build_result->data[$key]->hash_of_product		    = $hash_of_product;
                $build_result->data[$key]->hash_of_orders		    = $hash_of_orders;
                $build_result->data[$key]->total_sales			    = $total_sales;
                $build_result->data[$key]->customer_dsatisfaction	= $customer_dsatisfaction;
				
			}
			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
	}

    // export into csv: AUTHOR (Akshay Ugale)
	public function export(Request $request)
	{	
        $arr_data               = [];

		$obj_customer_data = $this	->BaseModel->get();
		
        if($obj_customer_data)
        {   $arr_obj_data    = $obj_customer_data->toArray();
            $num = 1;
            foreach ($arr_obj_data as $key => $data) 
            {
				// dd($data);
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
                    $arr_data['full_name']   = isset($data['full_name']) && !empty($data['full_name']) ? $data['full_name']:'-';

                    $arr_data['email']       = isset($data['email']) && !empty($data['email']) ? $data['email']:'-'; 

					$arr_data['mobile_number']   = isset($data['mobile_number']) && !empty($data['mobile_number']) ? $data['mobile_number']:'-'; 

					// $arr_data['address']     = isset($data['address']) && !empty($data['address']) ? $data['address']:'-';                    
                    $arr_data['agency_name']     = isset($data['agency_name']) && !empty($data['agency_name']) ? $data['agency_name']:'-'; 

                    $arr_data['status']      = $build_status_btn;
                    // dd($arr_data);
                             
                    array_push($this->arr_view_data, $arr_data);
                    $num++;
                }
            }
            if(isset($this->arr_view_data) && !empty($this->arr_view_data))
            {   
                // dd($this->arr_view_data);
                $filename           = 'agents_report_'.date('Y-m-d_H:i:s');
                $output = fopen("php://output",'w') or die("Can't open php://output");
                header("Content-Type:application/csv"); 
                header("Content-Disposition:attachment;filename=".$filename.".csv");
                
                fputcsv($output, array('Sr.No','Agent Name','Email','Mobile Number','Agency Name','Status'));
                foreach($this->arr_view_data as $agent) 
                {
                    fputcsv($output, $agent);
                }
                fclose($output) or die("Can't close php://output");

                // Session::flash('success','Agent data exported into file "'.$filename.'.csv".');
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
