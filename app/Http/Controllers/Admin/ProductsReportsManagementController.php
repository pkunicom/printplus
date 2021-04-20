<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductsModel;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;
use App\Models\ProductOptionModel;
use App\Models\SubOptionModel;
use App\Models\AccessoryModel;
use App\Models\PrintingOrderDetailsModel;
use App\Common\Services\MailService;
use App\Common\Traits\MultiActionTrait;

use DataTables;
use Validator;
use Session;
use Carbon\Carbon;

class ProductsReportsManagementController extends Controller
{
    use MultiActionTrait;

    function __construct(MailService $mail_service)
    {
		$this->arr_view_data                = [];
		$this->admin_panel_slug             = config('app.project.admin_panel_slug');
		$this->admin_url_path               = url(config('app.project.admin_panel_slug'));
		$this->module_url_path              = $this->admin_url_path."/reports/products";
		$this->module_title                 = "Reports";
		$this->module_view_folder           = "admin.reports";
		$this->module_icon                  = "fa fa-user";
		$this->auth                         = auth()->guard('admin');
        $this->ProductsModel				= new ProductsModel();
        $this->CategoryModel				= new CategoryModel();
        $this->SubCategoryModel				= new SubCategoryModel();
        $this->AccessoryModel				= new AccessoryModel();
        $this->ProductOptionModel		    = new ProductOptionModel();
        $this->SubOptionModel		        = new SubOptionModel();
        $this->PrintingOrderDetailsModel    = new PrintingOrderDetailsModel();
    }

    //Listing of product report    : AUTHOR (Akshay Ugale)
    public function index()
    {
		$products_count 			= $this->ProductsModel->count();
        $category_count 	        = $this->CategoryModel->count();
        $sub_category_count 	    = $this->SubCategoryModel->count();
        $accessory_count 	        = $this->AccessoryModel->count();

		$this->arr_view_data['page_title']          	= "Products ".$this->module_title;
        $this->arr_view_data['parent_module_icon']  	= "fa fa-home";
        $this->arr_view_data['parent_module_title'] 	= "Report";
        $this->arr_view_data['module_icon']         	= $this->module_icon;
        $this->arr_view_data['module_title']        	= "Customers ".$this->module_title;
		$this->arr_view_data['module_url_path']     	= $this->module_url_path;
		$this->arr_view_data['admin_url_path']      	= $this->admin_url_path;
		$this->arr_view_data['admin_panel_slug']    	= $this->admin_panel_slug;
		$this->arr_view_data['products_count'] 	        = $products_count;
		$this->arr_view_data['category_count'] 	        = $category_count;
		$this->arr_view_data['sub_category_count'] 	    = $sub_category_count;
		$this->arr_view_data['accessory_count'] 		= $accessory_count;
		// dd($dates);
		return view($this->module_view_folder.'.products_report',$this->arr_view_data);
    }

    //Ajax call of product listing product report    : AUTHOR (Akshay Ugale)
    public function load_data(Request $request)
	{	
		$build_status_btn       = '';
		$arr_data               = $arr_product_option = [];
		$obj_request_data = $this->ProductsModel->with('get_category_details','get_subcategory_details');

		$obj_request_data = $obj_request_data->get();

		$json_result 	= DataTables::of($obj_request_data)->make(true);
		$build_result 	= $json_result->getData();

		if(isset($build_result->data) && sizeof($build_result->data)>0)
		{
			foreach ($build_result->data as $key => $data) 
			{				
                // dd($data);
                $options = ''; 
                $product_order_count = $this->PrintingOrderDetailsModel->where('product_id','=',$data->id)->count();
                $obj_product_option = $this->ProductOptionModel->where('product_id','=',$data->id)->first();
                if($obj_product_option)
                {
                    $obj_product_sub_option     = $this->SubOptionModel->where('option_id','=',$obj_product_option->option_id)->get();
                    if($obj_product_sub_option)
                    {
                        $arr_product_option  =  $obj_product_sub_option->toArray();
                    }
                }
                foreach($arr_product_option as $product_options)
                {
                    $options    .= isset($product_options['english_name'])? $product_options['english_name'].',' :'';
                }
                

				$product_name  		    = isset($data->product_english_name)? $data->product_english_name :'';
                $category_name 		    = isset($data->get_category_details->english_name)? $data->get_category_details->english_name :'';
                $sub_category_name 	    = isset($data->get_subcategory_details->english_name)? $data->get_subcategory_details->english_name :'';
                $options 	            = isset($options)? substr_replace($options, "", -1) :'';
                $product_order_count 	= isset($product_order_count)? $product_order_count :'0';
                $product_total_value 	= isset($product_total_value)? $product_total_value :'0';
                $satisfaction   	    = isset($satisfaction)? $satisfaction :'5/5';
				$id 	    		    = isset($data->id)? base64_encode($data->id):'';
				

				$i = $key+1;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->product_name		    = $product_name;
				$build_result->data[$key]->category_name        = $category_name;
				$build_result->data[$key]->sub_category_name    = $sub_category_name;
				$build_result->data[$key]->options        		= $options;
				$build_result->data[$key]->product_order_count  = $product_order_count;
				$build_result->data[$key]->product_total_value  = $product_total_value;
				$build_result->data[$key]->satisfaction    		= $satisfaction;
				
			}
			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
    }
     //Ajax call of product accessory product report    : AUTHOR (Akshay Ugale)
    public function load_accessory_data(Request $request)
	{	
		$arr_data         = [];
		$obj_request_data = $this->AccessoryModel;

		$obj_request_data = $obj_request_data->get();

		$json_result 	= DataTables::of($obj_request_data)->make(true);
		$build_result 	= $json_result->getData();

		if(isset($build_result->data) && sizeof($build_result->data)>0)
		{
			foreach ($build_result->data as $key => $data) 
			{				 
                $accessory_order_count = '**';
                $accessory_total_value = '**';

                $accessory_name  		= isset($data->english_name)? $data->english_name :'';
                $accessory_order_count  = isset($accessory_order_count)? $accessory_order_count :'';
                $accessory_total_value  = isset($accessory_total_value)? $accessory_total_value :'';
				$id 	    		    = isset($data->id)? base64_encode($data->id):'';
				

				$i = $key+1;
				$build_result->data[$key]->sr_no         		    = $i;
				$build_result->data[$key]->accessory_name		    = $accessory_name;
				$build_result->data[$key]->accessory_order_count    = $accessory_order_count;
				$build_result->data[$key]->accessory_total_value    = $accessory_total_value;
				
			}
			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
	}

    //product export report    : AUTHOR (Akshay Ugale)
	public function export(Request $request)
	{	
        $arr_data               = [];

		$obj_product_data = $this->ProductsModel->with('get_category_details','get_subcategory_details')->get();
		
        if($obj_product_data)
        {   $arr_obj_data    = $obj_product_data->toArray();
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

                    $options = ''; 
                    $product_order_count = $this->PrintingOrderDetailsModel->where('product_id','=',$data['id'])->count();
                    $obj_product_option = $this->ProductOptionModel->where('product_id','=',$data['id'])->first();
                    if($obj_product_option)
                    {
                        $obj_product_sub_option     = $this->SubOptionModel->where('option_id','=',$obj_product_option->option_id)->get();
                        if($obj_product_sub_option)
                        {
                            $arr_product_option  =  $obj_product_sub_option->toArray();
                        }
                    }
                    foreach($arr_product_option as $product_options)
                    {
                        $options    .= isset($product_options['english_name'])? $product_options['english_name'].',' :'';
                    }
                    $arr_data['id']             = $num;
                    $arr_data['product_name']   = isset($data['product_english_name']) && !empty($data['product_english_name']) ? $data['product_english_name']:'-';
                    $arr_data['subcategory']    = isset($data['get_subcategory_details']['english_name']) && !empty($data['get_subcategory_details']['english_name']) ? $data['get_subcategory_details']['english_name']:'-'; 
                    $arr_data['category']       = isset($data['get_category_details']['english_name']) && !empty($data['get_category_details']['english_name']) ? $data['get_category_details']['english_name']:'-'; 
                    $arr_data['options']	    = isset($options)? substr_replace($options, "", -1) :'-';
                    $arr_data['product_count']	= isset($product_order_count)? $product_order_count:'*';
                    $arr_data['total_value']	= isset($total_value)? $total_value:'*';

					$arr_data['satisfaction']	= isset($satisfaction)? $satisfaction :'*';
                    // dd($arr_data);
                             
                    array_push($this->arr_view_data, $arr_data);
                    $num++;
                }
            }
            if(isset($this->arr_view_data) && !empty($this->arr_view_data))
            {   
                $filename           = 'product_report_'.date('Y-m-d_H:i:s');
                $output = fopen("php://output",'w') or die("Can't open php://output");
                header("Content-Type:application/csv"); 
                header("Content-Disposition:attachment;filename=".$filename.".csv");
                
                fputcsv($output, array('Sr.No','Product', 'Sub-Category', 'Category', 'Options', '# of Orders', 'Total Value', 'Satisfaction'));
                foreach($this->arr_view_data as $product) 
                {
                    fputcsv($output, $product);
                }
				fclose($output) or die("Can't close php://output");

				Session::flash('success','Product data exported into file "'.$filename.'.csv".');
                // return redirect()->back();
            }
            else
            {
                Session::flash('error','No data found.');
                return redirect()->back();
            }
        }
    }
    
    // product accessory export report    : AUTHOR (Akshay Ugale)
    public function export_accessory(Request $request)
	{	
        $arr_data               = $arr_obj_data = [];

		$obj_accessory_data = $this->AccessoryModel->get();
		
        if($obj_accessory_data)
        {   $arr_obj_data    = $obj_accessory_data->toArray();
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

                    $accessory_order_count = '**';
                    $accessory_total_value = '**';
                    
                    $arr_data['id']                     = $num;
                    $arr_data['accessory_name']         = isset($data['english_name']) && !empty($data['english_name']) ? $data['english_name']:'-';
                    $arr_data['accessory_order_count']  = isset($accessory_order_count)? $accessory_order_count :''; 
                    $arr_data['accessory_total_value']  = isset($accessory_total_value)? $accessory_total_value :'';
                    // dd($arr_data);
                             
                    array_push($this->arr_view_data, $arr_data);
                    $num++;
                }
            }
            if(isset($this->arr_view_data) && !empty($this->arr_view_data))
            {   
                $filename           = 'accessory_report_'.date('Y-m-d_H:i:s');
                $output             = fopen("php://output",'w') or die("Can't open php://output");
                header("Content-Type:application/csv"); 
                header("Content-Disposition:attachment;filename=".$filename.".csv");
                
                fputcsv($output, array('Sr.No','Accessory', '# of Orders', 'Total Value'));
                foreach($this->arr_view_data as $accessory) 
                {
                    fputcsv($output, $accessory);
                }
				fclose($output) or die("Can't close php://output");

				// Session::flash('success','Accessory data exported into file "'.$filename.'.csv".');
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
