<?php

namespace App\Http\Controllers\Agent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AgentProductsModel;
use App\Models\CountryModel;
use App\Models\OptionModel;
use App\Models\SubOptionModel;
use App\Models\ProductsModel;
use App\Models\ProductWeightTimeCostModel;
use App\Common\Services\MailService;
use App\Common\Traits\MultiActionTrait;
use Hash;
use DataTables;
use Validator;
use Session;
use Carbon;
use DB;
class ProductController extends Controller
{
    use MultiActionTrait;

    function __construct(MailService $mail_service)
    {
		$this->arr_view_data                = [];
		$this->admin_panel_slug             = config('app.project.agent_panel_slug');
		$this->admin_url_path               = url(config('app.project.agent_panel_slug'));
		$this->module_url_path              = $this->admin_url_path."/products";
		$this->module_title                 = "Products ";
		$this->module_view_folder           = "agent.product";
		$this->module_icon                  = "fa fa-user";
		$this->auth                         = auth()->guard('agent');
		$this->BaseModel					= new AgentProductsModel();
		$this->CountryModel					= new CountryModel();
		$this->OptionModel					= new OptionModel();
		$this->SubOptionModel				= new SubOptionModel();
		$this->ProductsModel				= new ProductsModel();
								
								
		$this->ProductWeightTimeCostModel 	= new ProductWeightTimeCostModel();
		
		  $this->user                         = $this->auth->user();

        if($this->user){

            $this->user_id                         = $this->user->id;
        }

		$this->user_profile_image_base_img_path   = base_path().config('app.project.img_path.user_profile_image');
		$this->user_profile_image_public_img_path = url('/').config('app.project.img_path.user_profile_image');
		$this->agent_invoice_base_img_path   	  = base_path().config('app.project.img_path.agent_invoice');
		$this->agent_invoice_public_img_path      = url('/').config('app.project.img_path.agent_invoice');
    }

    // product listing : AUTHOR (Harsh Chauhan)
    public function index()
    {

		$this->arr_view_data['page_title']          = "Manage ".$this->module_title;
        $this->arr_view_data['parent_module_icon']  = "fa fa-home";
        $this->arr_view_data['parent_module_title'] = "Dashboard";
        $this->arr_view_data['parent_module_url']   = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']         = $this->module_icon;
        $this->arr_view_data['module_title']        = "Manage ".$this->module_title;
		$this->arr_view_data['module_url_path']     = $this->module_url_path;
		$this->arr_view_data['admin_url_path']      = $this->admin_url_path;
		$this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;
		
		return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    // ajax call to load product data: AUTHOR (Harsh Chauhan)
    
	public function load_data(Request $request)

	{	

		$build_status_btn       = '';

		$arr_data               = array();

		$user_id = $this->auth->user()->id;
		$obj = $this->BaseModel->where('agent_id',$user_id)
									->orderBy('created_at','DESC')
									->get();
		if($obj){				
			$obj = $obj->toArray();
			//dd($obj);
			$p = [];	
			foreach($obj as $k => $v){	
				$p[] =  $v["product_id"];				
			}
		}									
											
		$product_id   = $p; //print_r($product_id);die;

		 //dd($product_id);

		$obj_request_data = $this->ProductWeightTimeCostModel->with(['get_details'=>function($q){

																$q->with('get_option_details');

															 }])

															 ->whereIn('product_id',$product_id)

															 ->orderBy('created_at','DESC')

															 ->get();



		$json_result 	= DataTables::of($obj_request_data)->make(true);

		$build_result 	= $json_result->getData();


		if(isset($build_result->data) && sizeof($build_result->data)>0)

		{

			foreach ($build_result->data as $key => $data) 

			{

				$result_obj = $this->ProductsModel->where("id", $data->product_id)->first();						
				$result_obj = $result_obj->toArray();
				$product_name = $result_obj["product_english_name"];
						
				
				// dump($data);

				$arr_product_comb = [];

				$arr_suboption_english_name= $arr_product_sub_option = $arr_suboption_arabic_name = [];

                $built_edit_href 		= $this->module_url_path.'/edit_product_option/'.base64_encode($data->id);

				

				// $build_edit_button 	    =' <a href='.$built_edit_href.'  title="Edit"><i class="fa fa-cog"></i></a> &nbsp&nbsp&nbsp';

				$build_edit_button 		= '<a  title="" href="javascript:void(0)"  data-id="'.$data->id.'"  id="open_weight_time_cost_modal"><i class="fa fa-cog" title="Edit"></i></a>';

				$action_button_html 	= $build_edit_button;

				

				// dd($data);

				$sub_options_comb_id 		= isset($data->sub_options_comb_id)? $data->sub_options_comb_id :'';

				$combinations    			= isset($data->get_details)? $data->get_details :'';



				foreach ($combinations as $ikey => $value) {

					$arr_product_comb[] = $value->get_option_details->english_name;

				}



				$description = implode('-', $arr_product_comb);

				// $description 				= isset($data->description)? $data->description :'';

				$quantity 					= '1';

				$weight 					= isset($data->weight)? $data->weight :'-';

				$lead_time 					= isset($data->lead_time)? $data->lead_time :'-';

				$cost 						= isset($data->cost)? $data->cost :'-';

				$margin 					= isset($data->margin)? $data->margin :'-';

				$selling 					= isset($data->selling)? $data->selling :'-';

				$id 	    	        	= isset($data->id)? base64_encode($data->id):'-';

				

				// dd($description);



				$i = $key+1;

				$build_result->data[$key]->id         		    	= $id;

                $build_result->data[$key]->sr_no         			= $i;

                $build_result->data[$key]->product_name 		= $product_name;

				$build_result->data[$key]->description 				= $description;

				
				$build_result->data[$key]->selling  				= $selling;

				

				

			}

			return response()->json($build_result);

		}

		else

		{

			return response()->json($build_result);

		}

	}




}