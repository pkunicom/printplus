<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DiscountModel;
use App\Common\Services\MailService;
use App\Common\Traits\MultiActionTrait;

use DataTables;
use Validator;
use Session;
use Carbon\Carbon;

class DiscountReportsManagementController extends Controller
{
    use MultiActionTrait;

    function __construct(MailService $mail_service)
    {
		$this->arr_view_data                = [];
		$this->admin_panel_slug             = config('app.project.admin_panel_slug');
		$this->admin_url_path               = url(config('app.project.admin_panel_slug'));
		$this->module_url_path              = $this->admin_url_path."/reports/discount";
		$this->module_title                 = "Reports";
		$this->module_view_folder           = "admin.reports";
		$this->module_icon                  = "fa fa-user";
		$this->auth                         = auth()->guard('admin');
        $this->BaseModel                    = new DiscountModel();
    }

    //discount report index: AUTHOR (Harsh chauhan)
    public function index()
    {
        $total_discounts_count          = $this->BaseModel->count();
        
        $active_discounts_count         = $this->BaseModel->where('status','=',"active")->count();

		$this->arr_view_data['page_title']          	= "Discount ".$this->module_title;
        $this->arr_view_data['parent_module_icon']  	= "fa fa-home";
        $this->arr_view_data['parent_module_title'] 	= "Discount";
        $this->arr_view_data['module_title']        	= "Discount ".$this->module_title;
		$this->arr_view_data['module_url_path']     	= $this->module_url_path;
		$this->arr_view_data['admin_url_path']      	= $this->admin_url_path;
		$this->arr_view_data['admin_panel_slug']    	= $this->admin_panel_slug;
		$this->arr_view_data['total_discounts_count'] 	= $total_discounts_count;
        $this->arr_view_data['active_discounts_count']  = $active_discounts_count;
        
		return view($this->module_view_folder.'.discount_report',$this->arr_view_data);
    }
    //load discount report data : AUTHOR (Harsh chauhan)
    public function load_data(Request $request)
	{	
		$build_status_btn       = '';
		$arr_data               = [];
		$obj_request_data = $this->BaseModel;

		$obj_request_data = $obj_request_data->orderBy('created_at', 'DESC')->get();

		$json_result 	= DataTables::of($obj_request_data)->make(true);
		$build_result 	= $json_result->getData();

		if(isset($build_result->data) && sizeof($build_result->data)>0)
		{
			foreach ($build_result->data as $key => $data) 
			{
                $status = "";
                
                $discount_id  			    = isset($data->discount_id)? $data->discount_id:'-';
                $product  			        = '-';
                $percentage  			    = isset($data->percentage)? $data->percentage:'-';
                $start_date  			    = isset($data->start_date)? $data->start_date:'-';
                $end_date  			        = isset($data->end_date)? $data->end_date:'-';
                $count  			        = '-';
                $total_sale  			    = "0";
                $total_deduction  			= "0";
                $status  			        = isset($data->status)? $data->status:'-';
                if($status=='expired')
                {
                    $status = "Expired";
                }
                if($status=='active')
                {
                    $status = "Active";
                }
                
                $id 	    		= isset($data->id)? base64_encode($data->id):'';

				$i = $key+1;
				$build_result->data[$key]->id         		    = $id;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->discount_id			= $discount_id;
                $build_result->data[$key]->product         	    = $product;
                $build_result->data[$key]->percentage         	= $percentage.'%';
				$build_result->data[$key]->start_date        	= date('d-m-Y', strtotime($start_date));
				$build_result->data[$key]->end_date    		    = date('d-m-Y', strtotime($end_date));;
				$build_result->data[$key]->count    		    = $count;
                $build_result->data[$key]->status    		    = $status;
                $build_result->data[$key]->total_sale    		= $total_sale;
                $build_result->data[$key]->total_deduction      = $total_deduction;
				
			}
			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
	}

    //export discount report into csv : AUTHOR (Harsh chauhan)
	public function export(Request $request)
	{	
        $arr_data               = [];

		$obj_customer_data = $this	->BaseModel->orderBy('created_at', 'DESC')->get();
		
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

                    $status  			            = isset($data['status'])? $data['status']:'-';
                    if($status=='expired')
                    {
                        $status = "Expired";
                    }
                    if($status=='active')
                    {
                        $status = "Active";
                    }
                    $arr_data['id']                 = $num;
                    $arr_data['discount_id']        = isset($data['discount_id'])? $data['discount_id']:'-';

                    $arr_data['product']            = '-';

                    $arr_data['percentage']		    = isset($data['percentage'])? $data['percentage'].'%':'-';
					$arr_data['start_date']         = isset($data['start_date'])? date('d-m-Y', strtotime($data['start_date'])):'-';;                    
					$arr_data['end_date']           = isset($data['end_date'])? date('d-m-Y', strtotime($data['end_date'])):'-';
                    $arr_data['count']              = '-';
                    $arr_data['status']             = isset($status)? $status:'-';;
                    $arr_data['total_sale']         = '0';
                    $arr_data['total_deduction']    = '0';
                    // dd($arr_data);
                    array_push($this->arr_view_data, $arr_data);
                    $num++;
                }
            }
            if(isset($this->arr_view_data) && !empty($this->arr_view_data))
            {
                $filename           = 'discount_report_'.date('Y-m-d_H:i:s');
                $output             = fopen("php://output",'w') or die("Can't open php://output");
                header("Content-Type:application/csv"); 
                header("Content-Disposition:attachment;filename=".$filename.".csv");
                
                fputcsv($output, array('Sr.No','Discount ID', 'Product', 'Percentage %', 'Start Date', 'End Date', 'Count', 'Status', 'Total Sales','Todatl Deduction'));
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
