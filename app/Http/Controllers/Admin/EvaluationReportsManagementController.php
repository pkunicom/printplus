<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductsModel;
use App\Common\Services\MailService;
use App\Common\Traits\MultiActionTrait;

use DataTables;
use Validator;
use Session;
use Carbon\Carbon;

class EvaluationReportsManagementController extends Controller
{
    use MultiActionTrait;

    function __construct(MailService $mail_service)
    {
		$this->arr_view_data                = [];
		$this->admin_panel_slug             = config('app.project.admin_panel_slug');
		$this->admin_url_path               = url(config('app.project.admin_panel_slug'));
		$this->module_url_path              = $this->admin_url_path."/reports/evaluation";
		$this->module_title                 = "Reports";
		$this->module_view_folder           = "admin.reports";
		$this->module_icon                  = "fa fa-user";
		$this->auth                         = auth()->guard('admin');
        $this->BaseModel                    = new ProductsModel();
    }

    //Listing of evaluation report     : AUTHOR (Akshay Ugale)
    public function index()
    {
        $total_evaluation_count          = $this->BaseModel->count();

		$this->arr_view_data['page_title']          	= "Evaluation ".$this->module_title;
        $this->arr_view_data['parent_module_icon']  	= "fa fa-home";
        $this->arr_view_data['parent_module_title'] 	= "Evaluation";
        $this->arr_view_data['module_title']        	= "Evaluation ".$this->module_title;
		$this->arr_view_data['module_url_path']     	= $this->module_url_path;
		$this->arr_view_data['admin_url_path']      	= $this->admin_url_path;
		$this->arr_view_data['admin_panel_slug']    	= $this->admin_panel_slug;
		$this->arr_view_data['total_evaluation_count'] 	= $total_evaluation_count;
        
		return view($this->module_view_folder.'.evaluation_report',$this->arr_view_data);
    }

     //Ajax call of evaluation  listing  report    : AUTHOR (Akshay Ugale)
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
                $product_id  			    = isset($data->product_id)? $data->product_id:'-';
                $product  			        = isset($data->product_english_name)? $data->product_english_name:'-';
                $total_evaluation  			= '00.00';
                $outof_5  			        = "1,341";
                $outof_4  			        = "4,431";
                $outof_3  			        = "4,431";
                $outof_2  			        = "321";
                $outof_1  			        = "341";
                $overall  			        = "4.5";
                $id 	    		= isset($data->id)? base64_encode($data->id):'';

				$i = $key+1;
				$build_result->data[$key]->id         		    = $id;
				$build_result->data[$key]->sr_no         		= $i;
                $build_result->data[$key]->product_id			= $product_id;
                $build_result->data[$key]->product			    = $product;
                $build_result->data[$key]->total_evaluation     = $total_evaluation;
                $build_result->data[$key]->outof_5         	    = $outof_5;
                $build_result->data[$key]->outof_4         	    = $outof_4;
                $build_result->data[$key]->outof_3         	    = $outof_3;
                $build_result->data[$key]->outof_2         	    = $outof_2;
                $build_result->data[$key]->outof_1         	    = $outof_1;
                $build_result->data[$key]->overall         	    = $overall;
				
			}
			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
	}

    // evaluation  export report    : AUTHOR (Akshay Ugale)
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


                    $product_id  			    = isset($data->product_id)? $data->product_id:'-';
                $product  			        = isset($data->product_english_name)? $data->product_english_name:'-';
                $total_evaluation  			= '00.00';
                $outof_5  			        = "1,341";
                $outof_4  			        = "4,431";
                $outof_3  			        = "4,431";
                $outof_2  			        = "321";
                $outof_1  			        = "341";
                $overall  			        = "4.5";



                    $arr_data['id']                     = $num;
                    $arr_data['product_id']             = isset($data['product_id'])? $data['product_id']:'-';

                    $arr_data['product']                = isset($data['product_english_name'])? $data['product_english_name']:'-';

                    $arr_data['total_evaluation']		= '00.00';
					$arr_data['outof_5']                = '1,341';
					$arr_data['outof_4']                = '4,431';
                    $arr_data['outof_3']                = '4,431';
                    $arr_data['outof_2']                = '331';
                    $arr_data['outof_51']               = '341';
                    $arr_data['overall']                = '4.5';

                    array_push($this->arr_view_data, $arr_data);
                    $num++;
                }
            }
            if(isset($this->arr_view_data) && !empty($this->arr_view_data))
            {
                $filename           = 'evaluation_report_'.date('Y-m-d_H:i:s');
                $output             = fopen("php://output",'w') or die("Can't open php://output");
                header("Content-Type:application/csv"); 
                header("Content-Disposition:attachment;filename=".$filename.".csv");
                
                fputcsv($output, array('Sr.No','Product ID', 'Product Name', 'Total # Evaluation', '5/5', '4/5', '3/5', '2/5', '1/5','Overall'));
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
