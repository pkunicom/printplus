<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\ProductsModel;

use App\Models\SubCategoryModel;

use App\Models\CategoryModel;

use App\Models\ProductOptionModel;

use App\Models\ProductSubOptionModel;

use App\Models\OptionModel;

use App\Models\SubOptionModel;

use App\Models\AccessoryModel;

use App\Models\ProductAccessoryModel;

use App\Models\ProductFixedQuantityModel;

use App\Models\ProductVariableQuantityModel;

use App\Models\ProductWeightTimeCostModel;

use App\Models\CityInstallationModel;

use App\Models\SystemCountryModel;

use App\Models\SystemCityModel;

use App\Models\ProductWeightTimeCostDetailsModel;

use App\Models\ProductImagesModel;

use App\Common\Services\MailService;

use App\Common\Traits\MultiActionTrait;



use DataTables;

use Validator;

use Session;



class ProductManagementController extends Controller

{

    use MultiActionTrait;



    function __construct(MailService $mail_service)

    {

		$this->arr_view_data                = [];

		$this->admin_panel_slug             = config('app.project.admin_panel_slug');

		$this->admin_url_path               = url(config('app.project.admin_panel_slug'));

		$this->module_url_path              = $this->admin_url_path."/product";

		$this->module_title                 = "Product";

		$this->module_view_folder           = "admin.product";

		$this->module_icon                  = "fa fa-user";

		$this->auth                         = auth()->guard('admin');

		$this->BaseModel					= new ProductsModel();

        $this->SubCategoryModel 			= new SubCategoryModel();

		$this->CategoryModel 			    = new CategoryModel();

		$this->ProductOptionModel 			= new ProductOptionModel();

		$this->ProductSubOptionModel 		= new ProductSubOptionModel();

		$this->OptionModel	 				= new OptionModel();

		$this->SubOptionModel				= new SubOptionModel();

		$this->ProductFixedQuantityModel 	= new ProductFixedQuantityModel();

		$this->ProductVariableQuantityModel = new ProductVariableQuantityModel();

		$this->ProductWeightTimeCostModel 	= new ProductWeightTimeCostModel();

		$this->AccessoryModel 				= new AccessoryModel();

		$this->ProductAccessoryModel 		= new ProductAccessoryModel();

		$this->CityInstallationModel 		= new CityInstallationModel();

		$this->SystemCountryModel 			= new SystemCountryModel();

		$this->SystemCityModel 				= new SystemCityModel();

		$this->ProductImagesModel 				= new ProductImagesModel();

		$this->ProductWeightTimeCostDetailsModel 				= new ProductWeightTimeCostDetailsModel();



        $this->product_image_base_img_path   = base_path().config('app.project.img_path.product_images');

		$this->product_image_public_img_path = url('/').config('app.project.img_path.product_images');

    }



    //Listing of product : AUTHOR (Akshay Ugale)

    public function index()

    {   

        $arr_category = [];

        $obj_category = $this->CategoryModel->where('status','=','1')->get();

        if($obj_category)

        {

            $arr_category = $obj_category->toArray();

		}



		$this->arr_view_data['page_title']          		= "Manage ".$this->module_title;

        $this->arr_view_data['parent_module_icon']  		= "fa fa-home";

        $this->arr_view_data['parent_module_title'] 		= "Dashboard";

        $this->arr_view_data['parent_module_url']  	 		= url('/').'/admin/dashboard';

        $this->arr_view_data['module_icon']         		= $this->module_icon;

        $this->arr_view_data['module_title']        		= "Manage ".$this->module_title;

		$this->arr_view_data['module_url_path']     		= $this->module_url_path;

		$this->arr_view_data['admin_url_path']      		= $this->admin_url_path;

        $this->arr_view_data['admin_panel_slug']    		= $this->admin_panel_slug;

		$this->arr_view_data['arr_category']    		    = $arr_category;

		return view($this->module_view_folder.'.index',$this->arr_view_data);

    }



    //get common cities: AUTHOR (Akshay Ugale)

    public function get_countries()

    {

    	$arr_data = $arr_resp = [];

    	$obj_data = $this->SystemCityModel->where('status','=','1')->get();



    	if($obj_data){

    		$arr_data = $obj_data->toArray();

    	}



		// $html = "<div class='mobile-drop-section-select'>

		// 			<select name='add_country_id' data-rule-required='true' id='add_country_id' class='form-control'>";



		$html = "<option value='' >Select country</option>";

		foreach ($arr_data as $key => $value) {

			$html .= "<option value=".$value['id']." >".$value['country_english_name']."</option>";

		}



		// $html .= "</select>

		// 		</div>";

		// $html .= "<div class='mobile-drop-section-input'>

		// 			<input type='text' placeholder='Enter mobile number' id='add_mobile_number' name='add_mobile_number' data-rule-required='true' data-rule-number='true' class='form-control' autocomplete='off'>

		// 			</div>";



		if($arr_data){

			$arr_resp['status']  	= 'success';

			$arr_resp['data'] 		= $html;

		}else{

			$arr_resp['status'] 	= 'error';

			$arr_resp['data'] 		= $html;

		}



		return $arr_resp;

    }



  //   public function get_cities($enc_id)

  //   {

  //   	$country_id = base64_decode($enc_id);

  //   	$arr_data = $arr_resp = [];

  //   	$obj_data = $this->SystemCityModel->where('system_country_id',$country_id)->get();



  //   	if($obj_data){

  //   		$arr_data = $obj_data->toArray();

  //   	}



		// $html = "<option value='' >Select city</option>";

		// foreach ($arr_data as $key => $value) {

		// 	$html .= "<option value=".$value['id']." >".$value['city_english_name']."</option>";

		// }



		// if($arr_data){

		// 	$arr_resp['status']  	= 'success';

		// 	$arr_resp['data'] 		= $html;

		// }else{

		// 	$arr_resp['status'] 	= 'error';

		// 	$arr_resp['data'] 		= $html;

		// }



		// return $arr_resp;

  //   }





     //Ajax call of product listin : AUTHOR (Akshay Ugale)

    public function load_data(Request $request)

	{	

		$build_status_btn       = '';

		$arr_data               = [];

		$arr_search_column     	= $request->input('column_filter');

		// dd($arr_search_column);

		$obj_request_data = $this->BaseModel->with('get_subcategory_details')/*->orderBy('created_at','DESC')*/;



		$obj_request_data = $obj_request_data->get();



		$json_result 	= DataTables::of($obj_request_data)->make(true);

		$build_result 	= $json_result->getData();



		if(isset($build_result->data) && sizeof($build_result->data)>0)

		{

			foreach ($build_result->data as $key => $data) 

			{

		$action_button_html = '<ul class="icons-list">

												<li class="dropdown">

													<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">

														<i class="icon-menu9"></i>

													</a>



													<ul class="dropdown-menu dropdown-menu-right">

										';				

                $built_delete_href 		= $this->module_url_path.'/delete/'.base64_encode($data->id);

                $built_edit_href 		= $this->module_url_path.'/edit/'.base64_encode($data->id);

				if($data->status != null && $data->status == "0")

				{

					$build_status_btn = '<a  href="'.$this->module_url_path.'/unblock/'.base64_encode($data->id).'" onclick="return confirm_action(this,event,\'Do you really want to Live this Product ?\')"><i class="icon-eye" title="Live"></i>Live</a>&nbsp&nbsp&nbsp ';
					$build_edit_button 	    ='';

                	$build_delete_button 	='';
				}

				elseif($data->status != null && $data->status == "1")

				{

					$build_status_btn = '<a  href="'.$this->module_url_path.'/block/'.base64_encode($data->id).'" onclick="return confirm_action(this,event,\'Do you really want to Hidden this Product ?\')"><i class="icon-eye-blocked" title="Hidden"></i>Hidden</a> &nbsp&nbsp&nbsp';
					$build_edit_button 	    =' <a href='.$built_edit_href.'  title="Edit"><i class="icon-cog"></i>Edit</a> &nbsp&nbsp&nbsp';

                	$build_delete_button 	=' <a href='.$built_delete_href.'  title="delete" onclick="return confirm_action(this,event,\'Do you really want to delete this Product ?\')"><i class="icon-trash"></i>Delete</a>';

                }

               
				//$action_button_html 	.= $build_edit_button.$build_status_btn.$build_delete_button;

				$action_button_html .= '<li> '.$build_edit_button.'</li>';	

				$action_button_html .= '<li> '.$build_status_btn.'</li>';	

				$action_button_html .= '<li> '.$build_delete_button.'</li>';	

				// dd($data);

				$category_id  	        = str_pad(isset($data->id)? $data->id:'000', 3, '0', STR_PAD_LEFT);

				$product_english_name 	= isset($data->product_english_name)? $data->product_english_name :'';

				$product_arabic_name 	= isset($data->product_arabic_name)? $data->product_arabic_name :'';

				$category_name          = isset($data->get_subcategory_details->english_name)? $data->get_subcategory_details->english_name :'';

				$product_id 		        = isset($data->product_id)? $data->product_id :'';

				$id 	    	        = isset($data->id)? base64_encode($data->id):'';

				$status 		        = isset($data->status)? $data->status :'-';

				if($status==1)

				{

					$status = '<span class="label label-success">Live</span>';

				}

				else

				{

					$status = '<span class="label label-danger">Hidden</span>';

				}

								$action_button_html .= '

												</ul>

											</li>

										</ul>';	

				$i = $key+1;

				$build_result->data[$key]->id         		    = $id;

                $build_result->data[$key]->sr_no         		= $i;

                $build_result->data[$key]->product_id         		    = $product_id;

				$build_result->data[$key]->category_id          = $category_id;

				$build_result->data[$key]->product_english_name = $product_english_name;

				$build_result->data[$key]->product_arabic_name  = $product_arabic_name;

				$build_result->data[$key]->category_name        = $category_name;

				$build_result->data[$key]->status        		= $status;

				$build_result->data[$key]->built_action_btns    = $action_button_html;

				

			}

			return response()->json($build_result);

		}

		else

		{

			return response()->json($build_result);

		}

	}





	/*Add product  :AUTHOR (Akshay Ugale*/

	public function store(Request $request)

    {



    	$arr_rules      = $arr_data = $arr_cat = array();

		$status         = false;



		$arr_rules['product_arabic_name']      	   	        = "required";

		$arr_rules['product_arabic_description']      	   	= "required";

		$arr_rules['product_english_name']                  = "required";

		$arr_rules['product_english_description']      	   	= "required";



		$validator = Validator::make($request->all(),$arr_rules);



		if($validator->fails()) 

		{

			return redirect()->back()->withErrors($validator)->withInput();

        }

        $category_id  	    = str_pad($request->input('category_id', 0), 3, '0', STR_PAD_LEFT);

        $sub_category_id  	= str_pad($request->input('sub_category_id', 0), 3, '0', STR_PAD_LEFT);

        // dd();

		$arr_data['product_arabic_name']    		                =   $request->input('product_arabic_name', null);	

		$arr_data['product_arabic_description']    					=   $request->input('product_arabic_description', null);	

		$arr_data['product_english_name']    	                    =   $request->input('product_english_name', null);	

        $arr_data['product_english_description']    				=   $request->input('product_english_description', null);

        $arr_data['category_id']    				                =   $request->input('category_id', null);

        $arr_data['subcategory_id']    				                =   $request->input('sub_category_id', null);

        $arr_data['product_id']					                    =	$category_id.$sub_category_id;

		$arr_data['status']											=	'1';



        $create  	= $this->BaseModel->create($arr_data);

		

		if($create)

		{

			Session::flash('success', 'Product added successfully.');

			return redirect($this->module_url_path);

		}

		else

		{

			Session::flash('error', 'Error while adding Product.');

			return redirect($this->module_url_path);

		}

	}



	/*Load data on edit form :AUTHOR (Akshay Ugale*/

	public function edit($id)

    {

    	$enc_id = base64_decode($id);



		$arr_data = $arr_category=  $arr_sub_category = $arr_option =  $arr_fixed_quantity = $arr_variable_quantity = $arr_accessory = $arr_country = $arr_product_option= $arr_selected_options= [];



		$obj_data = $this->BaseModel->with('get_subcategory_details','get_category_details')->where('id',$enc_id)->first();



        if($obj_data)

        {

    		$arr_data = $obj_data->toArray();

        }



		$obj_category = $this->CategoryModel->where('status','=','1')->get();



        if($obj_category)

        {

            $arr_category = $obj_category->toArray();

		}



		$obj_sub_category = $this->SubCategoryModel->where('status','=','1')->where('category_id','=',$arr_data['category_id'])->get();



        if($obj_sub_category)

        {

            $arr_sub_category = $obj_sub_category->toArray();

		}



		$obj_sys_country = $this->SystemCountryModel->select('id','country_english_name')->get();



    	if($obj_sys_country){

    		$arr_sys_country = $obj_sys_country->toArray();

    	}



		$obj_accessory = $this->AccessoryModel->select('id','english_name')->where('status','=','1')->get();



        if($obj_accessory)

        {

            $arr_accessory = $obj_accessory->toArray();

		}



		$obj_option = $this->OptionModel->where('status','=','1')->get();

        if($obj_option)

        {

            $arr_option = $obj_option->toArray();

            // dd($arr_option);

		}



		$obj_product_option 						= $this->ProductOptionModel->where('product_id',$enc_id)->get();

		if($obj_product_option)

		{

			$arr_product_option 	= 	$obj_product_option->toArray();

// 			dd($arr_product_option);

			foreach($arr_product_option as $key_op => $value_op){

			    $arr_selected_options[] = $value_op['option_id'];

			}

		}



		$obj_fixed_quantity = $this->ProductFixedQuantityModel->where('product_id','=',$enc_id)->get();

        if($obj_fixed_quantity)

        {

            $arr_fixed_quantity = $obj_fixed_quantity->toArray();

		}

		$obj_variable_quantity = $this->ProductVariableQuantityModel->where('product_id','=',$enc_id)->get();

        if($obj_variable_quantity)

        {

            $arr_variable_quantity = $obj_variable_quantity->toArray();

		}

		



    	$this->arr_view_data['page_title']          		= "Edit ".$this->module_title;

		$this->arr_view_data['module_url_path']     		= $this->module_url_path;

		$this->arr_view_data['arr_data']    		    	= $arr_data;

		$this->arr_view_data['arr_category']    		    = $arr_category;

		$this->arr_view_data['arr_sub_category']    		= $arr_sub_category;

		$this->arr_view_data['arr_sys_country']    			= $arr_sys_country;

		$this->arr_view_data['arr_accessory']    			= $arr_accessory;

		$this->arr_view_data['arr_option']    		    	= $arr_option;

		$this->arr_view_data['arr_product_option'] 			= $arr_product_option;

		$this->arr_view_data['arr_selected_options'] 			= $arr_selected_options;

		$this->arr_view_data['arr_variable_quantity'] 		= $arr_variable_quantity;

		$this->arr_view_data['arr_fixed_quantity'] 			= $arr_fixed_quantity;

		$this->arr_view_data['id']    						= $id;



		return view($this->module_view_folder.'.edit',$this->arr_view_data);

    }



	// Update product :AUTHOR (Akshay Ugale

	public function update_product_info(Request $request)

	{

		// dd($request->all());

		$enc_id = $request->input('enc_id');

		// dd($enc_id);

		$arr_rules      = $arr_data = $arr_old_product=array();

		$status         = false;



		$arr_rules['product_english_name']      	   	= "required";

		$arr_rules['product_arabic_name']      	   		= "required";

		$arr_rules['product_english_description']    	= "required";

		$arr_rules['product_arabic_description']      	= "required";

		$arr_rules['category_id']      	   				= "required";

		$arr_rules['sub_category_id']      	   			= "required";



		$validator = Validator::make($request->all(),$arr_rules);



		if($validator->fails()) 

		{

			return redirect()->back()->withErrors($validator)->withInput();

		}



		$obj_old_product  = $this->BaseModel->where('id','=',$enc_id)->first();



		if($obj_old_product)

		{

			$arr_old_product = $obj_old_product->toArray();

		}



		$category_id  	    = str_pad($request->input('category_id', $arr_old_product['category_id']), 3, '0', STR_PAD_LEFT);

		$sub_category_id  	= str_pad($request->input('sub_category_id', $arr_old_product['subcategory_id']), 3, '0', STR_PAD_LEFT);

		

		if($request->hasFile('product_images'))

        {

        	$status_delete_image = $this->ProductImagesModel->where('product_id',$enc_id)->delete();

        	foreach($request->file('product_images') as $key=>$value){

        	// dd($value);

	            // $image          = $request->file('product_images');

	            $image          = $value;

	            $file_extension = $image->getClientOriginalExtension();

	            $file_old_name  = $image->getClientOriginalName();



	            // if(in_array($file_extension,['jpg','jpeg','png']))

	            // {

	                $file_name = sha1(uniqid().$file_old_name.uniqid()).'.'.$file_extension;

	                $isUpload  = $image->move($this->product_image_base_img_path,$file_name);

	                

	                if($isUpload)

	                {

	                    $file_name = $file_name;

	                    $arr_temp_data['product_id']      = $enc_id; 

	                    $arr_temp_data['image']      = $file_name; 



	                    $status_image = $this->ProductImagesModel->create($arr_temp_data);

	                }

            }



        }

		

		$arr_data['product_english_name']    		=   $request->input('product_english_name', null);	

		$arr_data['product_arabic_name']    		=   $request->input('product_arabic_name', null);

		$arr_data['product_english_description']   	=   $request->input('product_english_description', null);	

		$arr_data['product_arabic_description']    	=   $request->input('product_arabic_description', null);	

		$arr_data['category_id']    				=   $request->input('category_id', $arr_old_product['category_id']);	

		$arr_data['subcategory_id']    				=   $request->input('sub_category_id', $arr_old_product['subcategory_id']);	

		$arr_data['product_id']    					=   $category_id.$sub_category_id;	



		$status = $this->BaseModel->where('id',$enc_id)->update($arr_data);



		if($status)

		{

			Session::flash('success', 'Product Information Updated successfully.');

			return redirect($this->module_url_path.'/edit/'.base64_encode($enc_id));

		}



		Session::flash('error', 'Error while Updating Product Information.');

		return redirect($this->module_url_path.'/edit/'.base64_encode($enc_id));

	}

	 //Ajax call of optiondata : AUTHOR (Akshay Ugale)

	public function load_option_data(Request $request)

	{	

		$build_status_btn       = '';

		$arr_data               =  	$arr_suboption_arabic_name = [];

		$product_id     		= 	$request->input('product_id');

		// dd($product_id);

		$obj_request_data = $this->ProductOptionModel->where('product_id','=',$product_id)->with('get_option_detail')/*->orderBy('created_at','DESC')*/;



		$obj_request_data = $obj_request_data->get();

		// dd($obj_request_data);

		$json_result 	= DataTables::of($obj_request_data)->make(true);

		$build_result 	= $json_result->getData();



		if(isset($build_result->data) && sizeof($build_result->data)>0)

		{

			foreach ($build_result->data as $key => $data) 

			{

				$arr_suboption_english_name= $arr_product_sub_option = $arr_suboption_arabic_name = [];



				$delete_data['id'] 				= base64_encode($data->id);

				$delete_data['product_id'] 		= base64_encode($product_id);

				// dd($delete_data);



				$built_delete_href 		= $this->module_url_path.'/delete_product_option/'.implode(",",$delete_data);

                $built_edit_href 		= $this->module_url_path.'/edit_product_option/'.base64_encode($data->id);

				

				// $build_edit_button 	    =' <a href='.$built_edit_href.'  title="Edit"><i class="fa fa-cog"></i></a> &nbsp&nbsp&nbsp';

				$build_edit_button 		= '<a  title="" href="javascript:void(0)"  data-id="'.$data->id.'"  id="open_edit_product_option_modal"><i class="fa fa-cog" title="Edit Product Option"></i></a>&nbsp&nbsp&nbsp';

                $build_delete_button 	=' <a href='.$built_delete_href.'  title="delete" onclick="return confirm_action(this,event,\'Do you really want to delete this Product Option ?\')"><i class="fa fa-trash"></i></a>';

				$action_button_html 	= $build_edit_button.$build_delete_button;

				

				$obj_product_sub_option 	= $this->ProductSubOptionModel	->where('product_id','=',$product_id)

																			->where('option_id','=',$data->option_id)

																			->with('get_sub_option_detail')

																			->get();

				if($obj_product_sub_option)

				{

					$arr_product_sub_option = $obj_product_sub_option->toArray();

				}



				foreach($arr_product_sub_option as $product_suboption)

				{

					$arr_suboption_english_name[] 		= isset($product_suboption['get_sub_option_detail']['english_name'])? $product_suboption['get_sub_option_detail']['english_name'] :'';

					$arr_suboption_arabic_name[]	 	= isset($product_suboption['get_sub_option_detail']['arabic_name'])? $product_suboption['get_sub_option_detail']['arabic_name'] :'';

				}

				$option_english_name 		= isset($data->get_option_detail->english_name)? $data->get_option_detail->english_name :'';

				$option_arabic_name 		= isset($data->get_option_detail->arabic_name)? $data->get_option_detail->arabic_name :'';

				$sub_option_english_name 	= implode(",", $arr_suboption_english_name);

				$sub_option_arabic_name 	= implode(",", $arr_suboption_arabic_name);

				$id 	    	        	= isset($data->id)? base64_encode($data->id):'';

				



				$i = $key+1;

				$build_result->data[$key]->id         		    	= $id;

                $build_result->data[$key]->sr_no         			= $i;

                $build_result->data[$key]->option_english_name 		= $option_english_name;

				$build_result->data[$key]->option_arabic_name 		= $option_arabic_name;

				$build_result->data[$key]->sub_option_english_name  = $sub_option_english_name;

				$build_result->data[$key]->sub_option_arabic_name  	= $sub_option_arabic_name;

				$build_result->data[$key]->built_action_btns    	= $action_button_html;

				

			}

			return response()->json($build_result);

		}

		else

		{

			return response()->json($build_result);

		}

	}



	 //store product option: AUTHOR (Akshay Ugale)

	public function store_product_option(Request $request)

    {

		// dd($request->all());

		

    	$arr_rules      = $arr_data = $arr_cat = $arr_product_option = $arr_product_sub_option = $arr_product_fixed_quantity= $arr_product_variable_quantity= $arr_product_old_sub_option= $arr_product_current_sub_option =$arr_product_weight_time_cost=array();

		$status         = false;



		$arr_rules['product_id']      	   	        = "required";

		$arr_rules['add_option']      	   			= "required";

		$arr_rules['sub_option_id']                 = "required";



		$validator = Validator::make($request->all(),$arr_rules);



		if($validator->fails()) 

		{

			return redirect()->back()->withErrors($validator)->withInput();

		}



		$product_id 									= 	$request->input('product_id', null);

		$option_id 										= 	$request->input('add_option', null);

		$arr_sub_option									= 	$request->input('sub_option_id', null);



		$arr_data['product_id']    		                =   $product_id;

		$arr_data['option_id']    						=   $option_id;

		

		// $obj_product_weight_time_cost 		= $this->ProductWeightTimeCostModel->where('product_id','=',$product_id)->get();

		// if($obj_product_weight_time_cost)

		// {

		// 	$arr_product_weight_time_cost 	= $obj_product_weight_time_cost->toArray();

		// }

		// dd($arr_product_weight_time_cost);

		// $generate_product_weight_time_cost 	=	 $this->product_weight_time_cost($product_id);



		$create  	= $this->ProductOptionModel->create($arr_data);

		if($create)

		{		

			foreach($arr_sub_option as $sub_options)

			{

				$arr_data = array();



				$arr_data['product_id']    		                =   $product_id;

				$arr_data['option_id']    						=   $option_id;

				$arr_data['sub_option_id']    					=   $sub_options;



				$create_sub_option  	= $this->ProductSubOptionModel->create($arr_data);



				if(!$create_sub_option)

				{

					Session::flash('error', 'Error while adding Product Sub-Option.');

					return redirect($this->module_url_path.'/edit/'.base64_encode($product_id));

				}

			}

		}



		if($create_sub_option && $create)

		{	

			$generate_product_weight_time_cost 	=	 $this->product_weight_time_cost($product_id);


			//print_r($generate_product_weight_time_cost);
			//die();


			Session::flash('success', 'Product Option added successfully.');

			return redirect($this->module_url_path.'/edit/'.base64_encode($product_id));

		}

		else

		{

			Session::flash('error', 'Error while adding Product Option.');

			return redirect($this->module_url_path.'/edit/'.base64_encode($product_id));

		}

	}



	 //product_weight_time_cost listing : AUTHOR (Harsh Chauhan)

	public function product_weight_time_cost($product_id)

    {

    	$obj_delete_one = $this->ProductWeightTimeCostModel->where('product_id',$product_id)->delete();



    	$arr_product_option = $arr_product_sub_option = $arr_product_fixed_quantity = $arr_product_variable_quantity = $arr_product_weight_time_cost = $arr_of_combinations = $arrays = [];



		$obj_product_option 				= $this->ProductOptionModel->select('id','product_id','option_id')->where('product_id',$product_id)->get();



		if($obj_product_option)

		{

			$arr_product_option 			= $obj_product_option->toArray();

			foreach ($arr_product_option as $key => $value) {



				$arr_option[] = $value['option_id'];

			}

		}



		$obj_product_sub_option				= $this->ProductSubOptionModel->select('id','product_id','sub_option_id','option_id')->where('product_id',$product_id)->get();



		if($obj_product_sub_option)

		{

			$arr_product_sub_option 		= $obj_product_sub_option->toArray();



			// code to create multiple dynamic arrays with its suboptions

			foreach ($arr_option as $key_option => $value_option) {



				foreach ($arr_product_sub_option as $key_sub_option => $value_sub_option) {



					if($value_option==$value_sub_option['option_id']){

						${'arr_sub_option_' . $key_sub_option}[] = $value_sub_option['sub_option_id'];   //created dynamic array variable as options are dynamic

					}

				}

			}

		}



		// Code to create array of all dynamic arrays

		/* for($i=0;$i<sizeof($arr_product_sub_option);$i++){

			$arrays[] = ${'arr_sub_option_' . $i};   

		}	
 		*/
		$abcd = array();

		foreach($arr_product_sub_option as $key =>$value){
				$arrays[$value['option_id']][] =  $value['sub_option_id'];
			}
			foreach($arrays as $key =>$value){
				$str_so  = '';
				foreach($value as $key1 =>$val_arr){
					$abcd[$key][$key1] = $val_arr;
				}
				
			}
			
			$abcd = array_values($abcd);


		if(sizeof($abcd)>1){

        // dump($arrays);

			$arr_of_combinations 	=	 $this->combinations($abcd);

					
			foreach ($arr_of_combinations as $key_c1 => $value_c1) {

			
			  	$str1 = "0123456789";

		        $str2 = str_shuffle($str1);

		        

		        $comb_id = substr($str2,0,6);

				$arr_insert_one['sub_options_comb_id']	= $comb_id;

				$arr_insert_one['product_id']			= $product_id;

					

				$obj_insert_one = $this->ProductWeightTimeCostModel->create($arr_insert_one);

					


				$arr_sub_option_temp = [];

				foreach ($value_c1 as $key_c2 => $value_c2) {

					$arr_insert_two['product_id']   	= $product_id;

					$arr_insert_two['sub_option_id']   	= $value_c2;

					$arr_insert_two['combination_id']   = $obj_insert_one->id;



					$obj_insert_two = $this->ProductWeightTimeCostDetailsModel->create($arr_insert_two);

					$arr_sub_option_temp[] =  $value_c2;

				}



				$obj_temp = $this->ProductWeightTimeCostModel->where('id',$obj_insert_one->id)->update(['description'=>json_encode($arr_sub_option_temp)]);

			}

		}else{

		  //  Old code commented on 14th sept 2020 for slide 11 point

			// 			foreach ($arrays as $key_c3 => $value_c3) {



			// 					$str1 = "0123456789";

			// 			        $str2 = str_shuffle($str1);

						        

			// 			        $comb_id = substr($str2,0,6);

			// 					$arr_insert_one['sub_options_comb_id']	= $comb_id;

			// 					$arr_insert_one['product_id']			= $product_id;



			// 					$obj_insert_one = $this->ProductWeightTimeCostModel->create($arr_insert_one);

			// 					$arr_sub_option_temp = [];

			// 				foreach ($value_c3 as $key_c4 => $value_c4) {



			// 					$arr_insert_two['product_id']   	= $product_id;

			// 					$arr_insert_two['sub_option_id']   	= $value_c4;

			// 					$arr_insert_two['combination_id']   = $obj_insert_one->id;



			// 					$obj_insert_two = $this->ProductWeightTimeCostDetailsModel->create($arr_insert_two);

			// 					$arr_sub_option_temp[] =  $value_c4;

			// 				}

							

			// 				$obj_temp = $this->ProductWeightTimeCostModel->where('id',$obj_insert_one->id)->update(['description'=>json_encode($arr_sub_option_temp)]);

								

			// 			}




			//echo '------------ arr SIG ---------------<br>';
            // New code added on 14th Sept 2020 for slide 11 feedback

				foreach ($abcd[0] as $key_c4 => $value_c4) {

				    

                	$str1 = "0123456789";

			        $str2 = str_shuffle($str1);

			        

			        $comb_id = substr($str2,0,6);

					$arr_insert_one['sub_options_comb_id']	= $comb_id;

					$arr_insert_one['product_id']			= $product_id;



					$obj_insert_one = $this->ProductWeightTimeCostModel->create($arr_insert_one);

					$arr_sub_option_temp = [];

                    //dd($obj_insert_one->id);

					$arr_insert_two['product_id']   	= $product_id;

					$arr_insert_two['sub_option_id']   	= $value_c4;

					$arr_insert_two['combination_id']   = $obj_insert_one->id;

					

					$obj_insert_two = $this->ProductWeightTimeCostDetailsModel->create($arr_insert_two);

					$arr_sub_option_temp[] =  $value_c4;

					

						$obj_temp = $this->ProductWeightTimeCostModel->where('id',$obj_insert_one->id)->update(['description'=>json_encode($arr_sub_option_temp)]);

				}

				

			

		}



		return true;



		// $obj_product = $this->BaseModel->select('id','quantity')->where('id',$product_id)->first();



		// if(isset($obj_product) && $obj_product->quantity=='fixed'){



		// 	$obj_product_fixed_quantity 						= $this->ProductFixedQuantityModel->where('product_id',$product_id)->get();



		// 	if($obj_product_fixed_quantity)

		// 	{

		// 		$arr_product_quantity 	= 	$obj_product_fixed_quantity->toArray();

		// 	}

		// }elseif(isset($obj_product) && $obj_product->quantity=='variable'){



		// 	$obj_product_variable_quantity 						= $this->ProductVariableQuantityModel->where('product_id',$product_id)->get();



		// 	if($obj_product_variable_quantity)

		// 	{

		// 		$arr_product_quantity 	= 	$obj_product_variable_quantity->toArray();

		// 	}

		// }



	}



	public function combinations($arrays, $i = 0) {

		// dd(3);

	    if (!isset($arrays[$i])) {

	        return array();

	    }



	    if ($i == count($arrays) -1) {

	        return $arrays[$i];

	    }



	    // get combinations from subsequent arrays

	    $tmp = $this->combinations($arrays, $i + 1);
	   //var_dump($tmp);


	    $result = array();



	    // concat each array from tmp with each element from $arrays[$i]

	    foreach ($arrays[$i] as $v) {

	        foreach ($tmp as $t) {

	            $result[] = is_array($t) ? 

	                array_merge(array($v), $t) :

	                array($v, $t);

	        }

	    }

	    return $result;

	}



	//edit product option : AUTHOR (Akshay Ugale)

	public function edit_product_option($id)

    {

    	$enc_id = base64_decode($id);

		// dd($enc_id);

    	$arr_data = $arr_option = $arr_sub_option =  $arr_product_sub_option = [];

    	$obj_data = $this->ProductOptionModel->where('id',$enc_id)->with('get_option_detail')->first();



		if($obj_data)

		{

			$arr_data = $obj_data->toArray();

			$obj_product_sub_option = $this->ProductSubOptionModel->where('product_id','=',$arr_data['product_id'])

																  ->where('option_id','=',$arr_data['option_id'])

																  ->with('get_sub_option_detail')

																  ->get();

			if($obj_product_sub_option)

			{

				$arr_product_sub_option = $obj_product_sub_option->toArray();

			}

		}

		$obj_option = $this->OptionModel->where('status','=','1')->get();

        if($obj_option)

        {

            $arr_option = $obj_option->toArray();

		}

		

		$option_html =	'

					<label>Option</label>

					<select class="form-control" id="edit_option_id" data-rule-required="true" name="edit_option_id" onchange="get_edit_relation_sub_option(this)" readonly="true">

		

				';

		

        foreach($arr_option as $option)

        {

			if($arr_data['option_id'] == $option['id'])

			{

            	$option_html .= '<option value="'.$option['id'].'" selected="selected" >'.$option['english_name'].'</option>';

			}

			else

			{

            	$option_html .= '<option value="'.$option['id'].'">'.$option['english_name'].'</option>';

			}

		}



		$option_html .= '</select>';



		// dd($arr_data);

		$obj_sub_option = $this->SubOptionModel->where('status','=','1')->where('option_id','=',$arr_data['option_id'])->get();

        if($obj_sub_option)

        {

            $arr_sub_option = $obj_sub_option->toArray();

		}

		// dd($arr_sub_option);

		$sub_option_html =	'

									<select class="form-control" id="edit_sub_option_id" data-rule-required="true" name="edit_sub_option_id[]" multiple>

									 

							';

													

		// <span class="error" id="error_category_id"> </span>

        foreach($arr_sub_option as $sub_option)

        {

			// dd($sub_option);

			$count = $this->ProductSubOptionModel	->where('product_id','=',$arr_data['product_id'])

													->where('option_id','=',$arr_data['option_id'])

													->where('sub_option_id','=',$sub_option['id'])

													->count();

			if($count==1)

			{

				$sub_option_html .= '<option value="'.$sub_option['id'].'") selected="selected">'.$sub_option['english_name'].'</option>';

			}

			else

			{

				$sub_option_html .= '<option value="'.$sub_option['id'].'">'.$sub_option['english_name'].'</option>';

			}

		}



		$sub_option_html .= '</select>';

		

		$arr_resp['option_html'] 				= $option_html;

		$arr_resp['sub_option_html'] 			= $sub_option_html;

		$arr_resp['id'] 						= '<input type="hidden" id="enc_id" name="enc_id" value='.$id.'>';



		return $arr_resp;

	}



	//check all optoins : AUTHOR (Harsh Chauhan)

	public function check_all_options($enc_id){



		$product_id = base64_decode($enc_id);



		$obj_check_one = $this->OptionModel->count();



		$obj_check_two = $this->ProductOptionModel->where('product_id',$product_id)->distinct('option_id')->count();



		if($obj_check_one==$obj_check_two){



			$arr_resp['status'] 					= "error";

		}else{

			$arr_resp['status'] 					= "success";



		}



		return $arr_resp;

	}

	

	//update product option : AUTHOR (Akshay Ugale)

	public function update_product_option(Request $request)

	{

		$enc_id = base64_decode($request->input('enc_id'));

		// dd($enc_id);

		$arr_rules      = $arr_data = $arr_old_product = $arr_delete = $arr_exist = array();

		$status         = false;





		$arr_rules['enc_id']    					= "required";

		$arr_rules['edit_option_id']      	   		= "required";

		$arr_rules['edit_sub_option_id']      	   	= "required";

		$arr_rules['product_id']      	   			= "required";



		$validator = Validator::make($request->all(),$arr_rules);



		if($validator->fails()) 

		{

			return redirect()->back()->withErrors($validator)->withInput();

		}

		$product_id 								= 	$request->input('product_id', null);

		$option_id 									= 	$request->input('edit_option_id', null);

		$sub_option_id 								= 	$request->input('edit_sub_option_id', null);





		$obj_exist = $this->ProductSubOptionModel->where('option_id',$request->input('edit_option_id', null))->delete();



		foreach($sub_option_id as $sub_option)

		{

			$arr_data['product_id']   					=   $product_id;	

			$arr_data['option_id']    					=   $option_id;

			$arr_data['sub_option_id']    				=   $sub_option;



			$status = $this->ProductSubOptionModel->create($arr_data);

		}





		if($status)

		{

			$generate_product_weight_time_cost 	=	 $this->product_weight_time_cost($product_id);



			Session::flash('success', 'Product option updated successfully.');

			return redirect($this->module_url_path.'/edit/'.base64_encode($product_id));

		}



		Session::flash('error', 'Error while updating product option.');

		return redirect($this->module_url_path.'/edit/'.base64_encode($product_id));

	}



	//check product english name exist or not : AUTHOR (Akshay Ugale)

	public function product_english_name(Request $request)

    {

    	$product_english_name = $request->input('product_english_name');



		$obj_product = $this->BaseModel->where('product_english_name',$product_english_name)->first();



		if($obj_product)

		{

			$arr_resp['status']  	= 'error';

		}

		else

		{

			$arr_resp['status'] 	= 'success';

		}

		return $arr_resp;

	}

	//check product arabic name exist or not : AUTHOR (Akshay Ugale)

	public function product_arabic_name(Request $request)

    {

    	$product_arabic_name = $request->input('product_arabic_name');



		$obj_product = $this->BaseModel->where('product_arabic_name',$product_arabic_name)->first();



		if($obj_product)

		{

			$arr_resp['status']  	= 'error';

		}

		else

		{

			$arr_resp['status'] 	= 'success';

		}

		return $arr_resp;

    }

    //get sub category : AUTHOR (Akshay Ugale)

    public function get_sub_category(Request $request)

    {

        $arr_sub_category       = [];

    	$category_id = $request->input('category_id');



		$obj_Sub_category = $this->SubCategoryModel->where('category_id',$category_id)->where('status','=','1')->get();

        

        if($obj_Sub_category)

        {

            $arr_sub_category = $obj_Sub_category->toArray();

        }

        $html ='

                    <label>Sub-Category</label>

                    <select class="form-control" id="sub_category_id" data-rule-required="true" name="sub_category_id">

                    <option value="">Select Category</option>

        

        ';

													

        foreach($arr_sub_category as $subcategory)

        {

            $html .= '<option value="'.$subcategory['id'].'">'.$subcategory['english_name'].'</option>';

        }



        $html .= '</select>';

		return $html;

	}



	//edit sub category : AUTHOR (Akshay Ugale)

	public function get_edit_sub_category(Request $request)

    {

		// dd($request->all());

        $arr_sub_category       = [];

    	$category_id 	= $request->input('category_id');

		$subcategory_id = $request->input('subcategory_id');

		$obj_Sub_category = $this->SubCategoryModel->where('category_id',$category_id)->where('status','=','1')->get();

        

        if($obj_Sub_category)

        {

            $arr_sub_category = $obj_Sub_category->toArray();

        }

        $html ='

                    <label>Sub-Category</label>

                    <select class="form-control" id="sub_category_id" data-rule-required="true" name="sub_category_id">

                    <option value="">Select Sub-Category</option>

        

        ';

													

		// <span class="error" id="error_category_id"> </span>

        foreach($arr_sub_category as $subcategory)

        {

			// dd($subcategory,$subcategory_id);

			

			if($subcategory_id == $subcategory['id'])

			{

				$html .= '<option value="'.$subcategory['id'].'" selected="selected">'.$subcategory['english_name'].'</option>';

			}

			else

			{

				$html .= '<option value="'.$subcategory['id'].'">'.$subcategory['english_name'].'</option>';

			}

        }													

        $html .= '</select><span class="error" id="error_sub_category_id"> </span>';

		return $html;

	}

	

	//edit sub option: AUTHOR (Akshay Ugale)

	public function get_edit_sub_option(Request $request)

    {

        $arr_sub_option       = [];

    	$add_option_id = $request->input('add_option');



		$obj_Sub_option = $this->SubOptionModel->where('option_id',$add_option_id)->where('status','=','1')->get();

        

        if($obj_Sub_option)

        {

            $arr_sub_option = $obj_Sub_option->toArray();

		}

		// dd($arr_sub_option);

        $html =	'

					<select class="form-control" id="sub_option_id" data-rule-required="true" name="sub_option_id[]" multiple>      

        		';

													

		// <span class="error" id="error_category_id"> </span>

        foreach($arr_sub_option as $sub_option)

        {
			$html .= '<option value="'.$sub_option['id'].'">'.$sub_option['english_name'].'</option>';
        }

        $html .= '</select><span class="error" id="error_sub_option_id"> </span>';

		return $html;

	}

	public function get_edit_relation_sub_option(Request $request)

    {

		// dd($request->all());

        $arr_sub_option       = [];

    	$edit_option_id = $request->input('edit_option');



		$obj_Sub_option = $this->SubOptionModel->where('option_id',$edit_option_id)->where('status','=','1')->get();

        

        if($obj_Sub_option)

        {

            $arr_sub_option = $obj_Sub_option->toArray();

		}

        $html =	'

					<select class="form-control" id="edit_sub_option_id" data-rule-required="true" name="edit_sub_option_id[]" multiple>    

        		';

        foreach($arr_sub_option as $sub_option)

        {

            $html .= '<option value="'.$sub_option['id'].'">'.$sub_option['english_name'].'</option>';

        }



        $html .= '</select>';

		return $html;

	}

	

	//delete product option: AUTHOR (Akshay Ugale)

	public function delete_product_option ($enc_id)

	{

		// dd($enc_id);

		$arr_delete_data 	= [];

		$arr_data 		= explode(",",$enc_id);

		$enc_id  		= base64_decode($arr_data[0]);

		$product_id  	= base64_decode($arr_data[1]);



		$obj_delete 		= $this->ProductOptionModel->where('id','=',$enc_id)->first();



		if($obj_delete)

		{			

			$arr_delete_data  	= $obj_delete->toArray();



			$delete_product_suboption 	= 	$this->ProductSubOptionModel->where('product_id',$arr_delete_data['product_id'])

																		->where('option_id',$arr_delete_data['option_id'])

																		->delete();



			$option_delete 		= $this->ProductOptionModel->where('id','=',$enc_id)->delete();

			if($option_delete)

			{

				$obj_delete 		= $this->ProductOptionModel->where('product_id',$arr_delete_data['product_id'])->count();



				if($obj_delete>0){



					$generate_product_weight_time_cost 	=	 $this->product_weight_time_cost($product_id);

				}



				Session::flash('success', 'Product Option & Suboption deleted successfully.');

				return redirect($this->module_url_path.'/edit/'.base64_encode($product_id));

			}	

		}

		else

		{

			Session::flash('error', 'Error while deleting Product Option & Suboption.');

			return redirect($this->module_url_path.'/edit/'.base64_encode($product_id));

		}

	}



	//Product Fixed Quantity

	// public function store_fixed_quantity(Request $request)

 //    {

	// 	// dd($request->all());

 //    	$arr_rules      = $arr_data = $arr_cat = $arr_product_option = $arr_product_first_suboption = array();

	// 	$status         = false;



	// 	$arr_rules['product_id']      	   	        = "required";

	// 	$arr_rules['fixed_quantity']      	   		= "required";



	// 	$validator = Validator::make($request->all(),$arr_rules);



	// 	if($validator->fails()) 

	// 	{

	// 		return redirect()->back()->withErrors($validator)->withInput();

	// 	}

	// 	$product_id  						=	$request->input('product_id', null);

		

	// 	$arr_data['product_id']    		   	=   $product_id;

	// 	$arr_data['fixed_quantity']    		=   $request->input('fixed_quantity', null);



	// 	$create  	= $this->ProductFixedQuantityModel->create($arr_data);



	// 	if($create)

	// 	{

	// 		Session::flash('success', 'Product fixed quantity added successfully.');

	// 		return redirect($this->module_url_path.'/edit/'.base64_encode($product_id));

	// 	}

	// 	else

	// 	{

	// 		Session::flash('error', 'Error while adding product fixed quantity.');

	// 		return redirect($this->module_url_path.'/edit/'.base64_encode($product_id));

	// 	}

	// }



// Product quantity : AUTHOR (Akshay Ugale)

	public function store_quantity(Request $request)

    {

		// dd($request->all());

    	$arr_rules      = $arr_data = $arr_cat = $arr_product_option = $arr_product_first_suboption = array();

		$status         = false;



		$arr_rules['quantity_encid']      	   	    = "required";

		$arr_rules['quantity_type']      	   		= "required";



		$validator = Validator::make($request->all(),$arr_rules);



		if($validator->fails()) 

		{

			return redirect()->back()->withErrors($validator)->withInput();

		}





		$product_id  						=	base64_decode($request->input('quantity_encid', null));

		$quantity_type  					=	$request->input('quantity_type', null);



		if($quantity_type=='fixed'){



			$obj_check = $this->ProductFixedQuantityModel->where('product_id',$product_id)->where('fixed_quantity',$request->input('fixed_quantity', null))->first();

			if($obj_check){

				Session::flash('error', 'Product with same fixed quantity already exists.');

				return redirect($this->module_url_path.'/edit/'.base64_encode($product_id));		

			}

			$arr_data['product_id']    		   	=   $product_id;

			$arr_data['fixed_quantity']    		=   $request->input('fixed_quantity', null);



			$create  	= $this->ProductFixedQuantityModel->create($arr_data);

		}else{

			$min = $request->input('variable_minimum', null);

			$max = $request->input('variable_maximum', null);

			// dd($product_id);

			$obj_check  = $this->ProductVariableQuantityModel->where('product_id',$product_id)

															->whereBetween('minimum_quantity',[$min,$max])

															->whereBetween('maximum_quantity',[$min,$max])

															->first();

			

			if($obj_check){

				Session::flash('error', 'Product with same variable quantity already exists.');

				return redirect($this->module_url_path.'/edit/'.base64_encode($product_id));		

			}	



			$arr_data['product_id']    		   		=   $product_id;

			$arr_data['minimum_quantity']    		=   $request->input('variable_minimum', null);

			$arr_data['maximum_quantity']    		=   $request->input('variable_maximum', null);

			$arr_data['discount']    				=   $request->input('variable_discount', null);

			// dd($arr_data);

			$create  	= $this->ProductVariableQuantityModel->create($arr_data);

		}



		$obj_update = $this->BaseModel->where('id',$product_id)->update(['quantity_type'=>$quantity_type]);





		if($create)

		{

			Session::flash('success', 'Product quantity added successfully.');

			return redirect($this->module_url_path.'/edit/'.base64_encode($product_id));

		}

		else

		{

			Session::flash('error', 'Error while adding product quantity.');

			return redirect($this->module_url_path.'/edit/'.base64_encode($product_id));

		}

	}



	//delete product fixed quantity : AUTHOR (harsh Chauhan)

	public function delete_fixed_quantity($id)

    {

		$data 			= explode(',', $id);

		$id 			= base64_decode($data['0']);

		$product_id 	= base64_decode($data['1']);

		if(is_numeric($id))

		{

			$delete 	= $this->ProductFixedQuantityModel->where('id','=',$id)->delete();

			if($delete)

			{

				Session::flash('success', 'Product fixed quantity deleted successfully.');

				return redirect($this->module_url_path.'/edit/'.base64_encode($product_id));

			}

			else

			{

				Session::flash('error', 'Error while deleting product fixed quantity.');

				return redirect($this->module_url_path.'/edit/'.base64_encode($product_id));

			}

		}

	}





	//delete variable quantity: AUTHOR (harsh Chauhan)

	public function delete_variable_quantity($id)

    {

		$data 			= explode(',', $id);

		$id 			= base64_decode($data['0']);

		$product_id 	= base64_decode($data['1']);

    	// dd($id,$product_id);

		if(is_numeric($id))

		{

			$delete 	= $this->ProductVariableQuantityModel->where('id','=',$id)->delete();

			if($delete)

			{

				Session::flash('success', 'Product variable quantity deleted successfully.');

				return redirect($this->module_url_path.'/edit/'.base64_encode($product_id));

			}

			else

			{

				Session::flash('error', 'Error while deleting product variable quantity.');

				return redirect($this->module_url_path.'/edit/'.base64_encode($product_id));

			}

		}

	}





	//check fixed quantity: AUTHOR (harsh Chauhan)

	public function check_fixed_quantity(Request $request)

    { 

		$product_id 	= 	$request->input('product_id',null);

		$quantity 		= 	$request->input('fixed_quantity',null);

		// dd($product_id,$quantity);

		$obj_qunatity  	=  $this->ProductFixedQuantityModel	->where('product_id','=',$product_id)

															->where('fixed_quantity','=',$quantity)

															->count();

		// dd($obj_qunatity);

		if($obj_qunatity>0)

        {

            $arr_response['status']   = 'exist';

            return $arr_response;

        }

        else

        {

            $arr_response['status']   = 'success';

            return $arr_response;

        }

	}

	

	//Product Variable Quantity

	public function store_variable_quantity(Request $request)

    {

    	$arr_rules      = $arr_data = $arr_cat = array();

		$status         = false;



		$arr_rules['product_id']      	   	        	= "required";

		$arr_rules['minimum_quantity']      	   		= "required|integer|not_in:0";

		$arr_rules['maximum_quantity']      	   		= "required|integer|not_in:0";

		$arr_rules['discount']      	   				= "required|numeric|between:0,100";



		$validator = Validator::make($request->all(),$arr_rules);



		if($validator->fails()) 

		{

			return redirect()->back()->withErrors($validator)->withInput();

		}

		$product_id  							=	$request->input('product_id', null);

		

		$arr_data['product_id']    		   		=   $product_id;

		$arr_data['minimum_quantity']    		=   $request->input('minimum_quantity', null);

		$arr_data['maximum_quantity']    		=   $request->input('maximum_quantity', null);

		$arr_data['discount']    				=   $request->input('discount', null);

		// dd($arr_data);

		$create  	= $this->ProductVariableQuantityModel->create($arr_data);



		if($create)

		{

			Session::flash('success', 'Product  variable quantity added successfully.');

			return redirect($this->module_url_path.'/edit/'.base64_encode($product_id));

		}

		else

		{

			Session::flash('error', 'Error while adding product vaiable quantity.');

			return redirect($this->module_url_path.'/edit/'.base64_encode($product_id));

		}

	}



	//load product weight time cost : AUTHOR (Akshay Ugale)

	public function load_product_weight_time_cost(Request $request)

	{	

		$build_status_btn       = '';

		$arr_data               = array();

		$product_id     		= 	$request->input('product_id');

		 //dd($product_id);

		$obj_request_data = $this->ProductWeightTimeCostModel->with(['get_details'=>function($q){

																$q->with('get_option_details');

															 }])

															 ->where('product_id',$product_id)

															 ->orderBy('created_at','DESC')

															 ->get();



		$json_result 	= DataTables::of($obj_request_data)->make(true);

		$build_result 	= $json_result->getData();


		if(isset($build_result->data) && sizeof($build_result->data)>0)

		{

			foreach ($build_result->data as $key => $data) 

			{

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

                $build_result->data[$key]->sub_options_comb_id 		= $sub_options_comb_id;

				$build_result->data[$key]->description 				= $description;

				$build_result->data[$key]->quantity  				= $quantity;

				$build_result->data[$key]->weight  					= $weight;

				$build_result->data[$key]->lead_time  				= $lead_time;

				$build_result->data[$key]->cost  					= $cost;

				$build_result->data[$key]->margin  					= $margin;

				$build_result->data[$key]->selling  				= $selling;

				$build_result->data[$key]->built_action_btns    	= $action_button_html;

				

			}

			return response()->json($build_result);

		}

		else

		{

			return response()->json($build_result);

		}

	}



	//edit_option product weight time cost : AUTHOR (Akshay Ugale)

	public function edit_product_weight_time_cost($id)

    {

		$id 					= base64_decode($id);

        $arr_data      		 	= [];



		$obj_product_weight_time_cost = $this->ProductWeightTimeCostModel->with(['get_details'=>function($q){

																			$q->with('get_option_details');

																		 }])

																		->where('id',$id)->first();

        

        if($obj_product_weight_time_cost)

        {

            $arr_data = $obj_product_weight_time_cost->toArray();

            $arr_resp['id'] 				 = isset($arr_data['id'])? base64_encode($arr_data['id']):'-';

            $arr_resp['sub_options_comb_id'] = isset($arr_data['sub_options_comb_id'])? $arr_data['sub_options_comb_id'] :'';



            $combinations    			 = isset($arr_data['get_details'])? $arr_data['get_details'] :'';



			foreach ($combinations as $ikey => $value) {

				$arr_product_comb[] 	= $value['get_option_details']['english_name'];

			}



			$arr_resp['description']	 = implode('-', $arr_product_comb);

			$arr_resp['quantity'] 		 = '1';

			$arr_resp['weight'] 		 = isset($arr_data['weight'])? $arr_data['weight'] :'-';

			$arr_resp['lead_time'] 		 = isset($arr_data['lead_time'])? $arr_data['lead_time'] :'-';

			$arr_resp['cost'] 			 = isset($arr_data['cost'])? $arr_data['cost'] :'-';

			$arr_resp['margin'] 		 = isset($arr_data['margin'])? $arr_data['margin'] :'-';

			$arr_resp['selling'] 		 = isset($arr_data['selling'])? $arr_data['selling'] :'-';

		}



		return $arr_resp;

	}



	//update product weight time cost : AUTHOR (Akshay Ugale)

	public function update_product_weight_time_cost(Request $request)

	{

		$enc_id = base64_decode($request->input('edit_enc_id'));

		$product_id =  $request->input('product_id');

		$arr_rules      = $arr_data = $arr_old_product=array();

		$status         = false;



		$arr_rules['weight']      	   					= "required";

		$arr_rules['lead_time']      	   				= "required";

		$arr_rules['cost']    							= "required";

		$arr_rules['margin']      						= "required";

		$arr_rules['selling']      	   					= "required";



		$validator = Validator::make($request->all(),$arr_rules);



		if($validator->fails()) 

		{

			return redirect()->back()->withErrors($validator)->withInput();

		}



		$arr_data['weight']    				=   $request->input('weight', null);

		$arr_data['lead_time']    			=   $request->input('lead_time', null);

		$arr_data['cost']    				=   $request->input('cost', null);

		$arr_data['margin']    				=   $request->input('margin', null);

		$arr_data['selling']    			=   $request->input('selling', null);

		// dd($arr_data);



		$status = $this->ProductWeightTimeCostModel->where('id',$enc_id)->update($arr_data);



		if($status)

		{

			Session::flash('success', 'Product detail Updated successfully.');

			return redirect($this->module_url_path.'/edit/'.base64_encode($product_id));

		}



		Session::flash('error', 'Error while Updating Product installation detail.');

		return redirect($this->module_url_path.'/edit/'.base64_encode($product_id));

	}





	/*AJAX call for listing of product installation: AUTHOR (Akshay Ugale)*/

	public function load_product_installation(Request $request,$enc_id)

	{	

		$build_status_btn       = '';

		$arr_data               =  	$arr_suboption_arabic_name = [];



		$product_id     		= 	base64_decode($enc_id);

		// dd($product_id);

		$obj_request_data = $this->CityInstallationModel->where('product_id',$product_id)

														->with('get_country_detail','get_city_detail')

														->orderBy('created_at','DESC')

														->get();

		

		$json_result 	= DataTables::of($obj_request_data)->make(true);

		$build_result 	= $json_result->getData();



		if(isset($build_result->data) && sizeof($build_result->data)>0)

		{

			foreach ($build_result->data as $key => $data) 

			{

				$delete_data['id'] 				= base64_encode($data->id);

				$delete_data['product_id'] 		= base64_encode($product_id);



				$built_delete_href 		= $this->module_url_path.'/delete_product_installation_city/'.implode(",",$delete_data);

				

				$build_edit_button 		= '<a  title="" href="javascript:void(0)"  data-id="'.$data->id.'"  id="open_edit_product_installation_city"><i class="fa fa-cog" title="Edit Product Installation City"></i></a>&nbsp&nbsp&nbsp';

                $build_delete_button 	=' <a href='.$built_delete_href.'  title="delete" onclick="return confirm_action(this,event,\'Do you really want to delete this product installation city detail?\')"><i class="fa fa-trash"></i></a>';

				$action_button_html 	= $build_edit_button.$build_delete_button;

				

				$city 						= isset($data->get_city_detail->city_english_name)? $data->get_city_detail->city_english_name :'';

				$visit_cost 				= isset($data->visit_cost)? $data->visit_cost :'';

				$visit_selling 				= isset($data->visit_selling)? $data->visit_selling :'';

				$unit_cost 					= isset($data->unit_cost)? $data->unit_cost :'';

				$unit_selling 				= isset($data->unit_selling)? $data->unit_selling :'';

				$id 	    	        	= isset($data->id)? base64_encode($data->id):'';

				



				$i = $key+1;

				$build_result->data[$key]->id         		    	= $id;

                $build_result->data[$key]->sr_no         			= $i;

                $build_result->data[$key]->city 					= $city;

				$build_result->data[$key]->visit_cost 				= $visit_cost;

				$build_result->data[$key]->visit_selling  			= $visit_selling;

				$build_result->data[$key]->unit_cost  				= $unit_cost;

				$build_result->data[$key]->unit_selling  			= $unit_selling;

				$build_result->data[$key]->built_action_btns    	= $action_button_html;

				

			}

			return response()->json($build_result);

		}

		else

		{

			return response()->json($build_result);

		}

	}



	//add new installation city: AUTHOR (Akshay Ugale)

	public function store_installation_city(Request $request)

    {

    	$arr_rules      = $arr_data = $arr_cat = array();

		$status         = false;



		$arr_rules['product_id']      	   	        	= "required";

		$arr_rules['country_id']      	   				= "required";

		$arr_rules['city_id']      	   					= "required";

		$arr_rules['visit_cost']      	   				= "required";

		$arr_rules['visit_selling']      	   			= "required";

		$arr_rules['unit_cost']      	   				= "required";

		$arr_rules['unit_selling']      	   			= "required";



		$validator = Validator::make($request->all(),$arr_rules);



		if($validator->fails()) 

		{

			return redirect()->back()->withErrors($validator)->withInput();

		}

		$product_id  							=	$request->input('product_id', null);

		

		$arr_data['product_id']    		   		=   $product_id;

		$arr_data['country_id']    				=   $request->input('country_id', null);

		$arr_data['city_id']    				=   $request->input('city_id', null);

		$arr_data['visit_cost']    				=   $request->input('visit_cost', null);

		$arr_data['visit_selling']    			=   $request->input('visit_selling', null);

		$arr_data['unit_cost']    				=   $request->input('unit_cost', null);

		$arr_data['unit_selling']    			=   $request->input('unit_selling', null);

		$arr_data['status']    					=   "1";

		// dd($arr_data);

		$create  	= $this->CityInstallationModel->create($arr_data);



		if($create)

		{

			Session::flash('success', 'Installation city added successfully.');

			return redirect($this->module_url_path.'/edit/'.base64_encode($product_id));

		}

		else

		{

			Session::flash('error', 'Error while adding installation city.');

			return redirect($this->module_url_path.'/edit/'.base64_encode($product_id));

		}

	}

	//edit installation city: AUTHOR (Akshay Ugale)

	public function edit_installation_city($id)

    {

    	$enc_id = base64_decode($id);



    	$arr_data = $arr_country = $arr_city =[];

    	$obj_data = $this->CityInstallationModel->where('id',$enc_id)->first();



		if($obj_data)

		{

    		$arr_data = $obj_data->toArray();

		}

		

		$obj_country = $this->SystemCountryModel->where('status','=','1')->get();

        if($obj_country)

        {

            $arr_country = $obj_country->toArray();

		}

		// dd($arr_data);

		$obj_city = $this->SystemCityModel->where('system_country_id','=',$arr_data['country_id'])->where('status','=','1')->get();

        if($obj_city)

        {

            $arr_city = $obj_city->toArray();

		}

		// dd($arr_city);

		$country_html = '<div class="col-sm-12 col-md-12 col-lg-12">

					<div class="form-group">												

					<label>Country</label>

					<select class="form-control" id="edit_country_id" data-rule-required="true" name="edit_country_id" onchange="get_edit_cities(this)">

						<option value="">Select Country</option>';

		

		if(count($arr_country)>0)

		{

			foreach($arr_country as $key_option => $country)

			{

				if($country['id']==$arr_data['country_id'])

				{

					$country_html .= '<option value="'.$country['id'].'" selected="selected">'.$country['country_english_name'].'</option>';

				}

				else

				{

					$country_html .= '<option value="'.$country['id'].'">'.$country['country_english_name'].'</option>';

				}

			}

		}



		$country_html .= '</select></div></div>';







		$city_html = '<div class="col-sm-12 col-md-12 col-lg-12">

					<div class="form-group">												

					<label>Country</label>

					<select class="form-control" id="edit_city_id" data-rule-required="true" name="edit_city_id">

						<option value="">Select Country</option>';

		

		if(count($arr_city)>0)

		{

			foreach($arr_city as $key_option => $city)

			{

				if($city['id']==$arr_data['city_id'])

				{

					$city_html .= '<option value="'.$city['id'].'" selected="selected">'.$city['city_english_name'].'</option>';

				}

				else

				{

					$city_html .= '<option value="'.$city['id'].'">'.$city['city_english_name'].'</option>';

				}

			}

		}

		// dd($arr_data);

		$city_html .= '</select></div></div>';

    	if($arr_data){

			$arr_resp['status']  			= 'success';

			$arr_resp['data'] 				= $arr_data;

			$arr_resp['country_html'] 		= $country_html;

			$arr_resp['city_html'] 			= $city_html;

		}else{

			$arr_resp['status'] 	= 'error';

			$arr_resp['data'] 		= $arr_data;

		}



		return $arr_resp;

	}

	//update installation city: AUTHOR (Akshay Ugale)

	public function update_product_installation_city(Request $request)

	{

		// dd($request->all());

		$enc_id = base64_decode($request->input('city_enc_id'));

		// dd($enc_id);

		$arr_rules      = $arr_data = $arr_old_product=array();

		$status         = false;



		$arr_rules['edit_country_id']      	   				= "required";

		$arr_rules['edit_city_id']      	   				= "required";

		$arr_rules['edit_visit_cost']    					= "required";

		$arr_rules['edit_visit_selling']      				= "required";

		$arr_rules['edit_unit_cost']      	   				= "required";

		$arr_rules['edit_unit_selling']      	   			= "required";



		$validator = Validator::make($request->all(),$arr_rules);



		if($validator->fails()) 

		{

			return redirect()->back()->withErrors($validator)->withInput();

		}

		$product_id 							= 	$request->input('product_id', null);



		$arr_data['country_id']    				=   $request->input('edit_country_id', null);

		$arr_data['city_id']    				=   $request->input('edit_city_id', null);

		$arr_data['visit_cost']    				=   $request->input('edit_visit_cost', null);

		$arr_data['visit_selling']    			=   $request->input('edit_visit_selling', null);

		$arr_data['unit_cost']    				=   $request->input('edit_unit_cost', null);

		$arr_data['unit_selling']    			=   $request->input('edit_unit_selling', null);



		$status = $this->CityInstallationModel->where('id',$enc_id)->update($arr_data);



		if($status)

		{

			Session::flash('success', 'Product installation detail Updated successfully.');

			return redirect($this->module_url_path.'/edit/'.base64_encode($product_id));

		}



		Session::flash('error', 'Error while Updating Product installation detail.');

		return redirect($this->module_url_path.'/edit/'.base64_encode($product_id));

	}

	

	//get common cities data: AUTHOR (Akshay Ugale)

	public function get_cities(Request $request)

    {

        $arr_cities       = [];

		$country_id 	= $request->input('country_id');
		$product_id 	= $request->input('product_id');

		 //dd($country_id);
		$ids = '';
		$obj_incities = $this->CityInstallationModel->where('country_id',$country_id)->where('product_id',$product_id)->get();
		if($obj_incities){
			
        	$arr_cities = $obj_incities->toArray();
			
			foreach($arr_cities as $key => $row){
				if($ids == ''){
					$ids = $row['city_id'];
				}else{
					$ids = $ids.",".$row['city_id'];
				}
			}
			
		}
		//	dd($ids);
		if($ids){
			$ids = explode(',',$ids);
			$obj_cities = $this->SystemCityModel->where('system_country_id',$country_id)->whereNotIn('id',$ids)->get();
		}else{
			$obj_cities = $this->SystemCityModel->where('system_country_id',$country_id)->get();
		}
		

        

        if($obj_cities)

        {

            $arr_cities = $obj_cities->toArray();

		}

		// dd($arr_cities);

        $html ='

                    <select class="form-control" id="city_id" data-rule-required="true" name="city_id">

                    <option value="">--- Select City ---</option>

        

        ';

													

		// <span class="error" id="error_category_id"> </span>

        foreach($arr_cities as $city)

        {			

			$html .= '<option value="'.$city['id'].'">'.$city['city_english_name'].'</option>';

        }													

        $html .= '</select><span class="error" id="error_city_id"> </span>';

		return $html;

	}



	//get edit cities: AUTHOR (Akshay Ugale)

	public function get_edit_cities(Request $request)

    {

        $arr_cities       = [];

		$edit_country_id 	= $request->input('edit_country_id');

		// dd($edit_country_id);

		$obj_cities = $this->SystemCityModel->where('system_country_id',$edit_country_id)->get();

        

        if($obj_cities)

        {

            $arr_cities = $obj_cities->toArray();

		}



		$city_html = '	<div class="col-sm-12 col-md-12 col-lg-12">

						<div class="form-group">												

						<label>Country</label>

						<select class="form-control" id="edit_city_id" data-rule-required="true" name="edit_city_id">

							<option value="">Select City</option>';

		

		if(count($arr_cities)>0)

		{

			foreach($arr_cities as $key_option => $city)

			{

				$city_html .= '<option value="'.$city['id'].'">'.$city['city_english_name'].'</option>';

			}

		}



		$city_html .= '</select></div></div>';

		return $city_html;

	}



	//delete product installation city : AUTHOR (Akshay Ugale)

	public function delete_product_installation_city ($enc_id)

	{

		$arr_data 		= explode(",",$enc_id);

		$enc_id  		= base64_decode($enc_id);

		$product_id  	= base64_decode($arr_data[1]);



		$obj_delete 		= $this->CityInstallationModel->where('id','=',$enc_id)->delete();

		if($obj_delete)

		{			

			Session::flash('success', 'Product installation detail deleted successfully.');

			return redirect($this->module_url_path.'/edit/'.base64_encode($product_id));

		}	

		else

		{

			Session::flash('error', 'Error while deleting Product installation detail.');

			return redirect($this->module_url_path.'/edit/'.base64_encode($product_id));

		}

	}





	// Accessories  : AUTHOR (Akshay Ugale)



	public function load_product_accessories(Request $request)

	{	

		$build_status_btn       = '';

		$arr_data               =  	$arr_suboption_arabic_name = [];

		$product_id     		= 	$request->input('product_id');

		// dd($product_id);

		$obj_request_data = $this->ProductAccessoryModel->where('product_id','=',$product_id)

														->with('get_accessory_detail')

														->orderBy('created_at','DESC')

														->get();

		// dd($obj_request_data);

		$json_result 	= DataTables::of($obj_request_data)->make(true);

		$build_result 	= $json_result->getData();



		if(isset($build_result->data) && sizeof($build_result->data)>0)

		{

			foreach ($build_result->data as $key => $data) 

			{



				$delete_data['id'] 				= base64_encode($data->id);

				$delete_data['product_id'] 		= base64_encode($product_id);

				// dd($delete_data);

				$built_delete_href 		= $this->module_url_path.'/delete_product_accessory/'.implode(",",$delete_data);

				

				 $build_delete_button 	=' <a href='.$built_delete_href.'  title="delete" onclick="return confirm_action(this,event,\'Do you really want to delete this Product ?\')"><i class="fa fa-trash"></i></a>';

				

				// $build_delete_button 	=' <a href='.$built_delete_href.'  title="delete" onclick="return confirm_action(this,event,\'Do you really want to delete this Product Accessory ?\')"><i class="fa fa-trash"></i></a>';

				

				$action_button_html 	= $build_delete_button;

			

				$accessory_ID 				= isset($data->get_accessory_detail->id)? $data->get_accessory_detail->id :'-';

				$accessory_arabic_name 		= isset($data->get_accessory_detail->arabic_name)? $data->get_accessory_detail->arabic_name :'-';

				$accessory_english_name 	= isset($data->get_accessory_detail->english_name)? $data->get_accessory_detail->english_name :'-';

				$id 	    	        	= isset($data->id)? base64_encode($data->id):'';

				



				$i = $key+1;

				$build_result->data[$key]->id         		    	= $id;

                $build_result->data[$key]->sr_no         			= $i;

                $build_result->data[$key]->accessory_ID 			= $accessory_ID;

				$build_result->data[$key]->accessory_english_name 	= $accessory_english_name;

				$build_result->data[$key]->accessory_arabic_name  	= $accessory_arabic_name;

				$build_result->data[$key]->built_action_btns    	= $action_button_html;

				

			}

			return response()->json($build_result);

		}

		else

		{

			return response()->json($build_result);

		}

	}



	// store Accessories  : AUTHOR (Akshay Ugale)

	public function store_product_accessory(Request $request)

    {

    	$arr_rules      = $arr_data  = array();

		$status         = false;



		$arr_rules['product_id']      	   	        = "required";

		$arr_rules['accessory_id']      	   		= "required";



		$validator = Validator::make($request->all(),$arr_rules);



		if($validator->fails()) 

		{

			return redirect()->back()->withErrors($validator)->withInput();

		}



		$product_id 									= 	$request->input('product_id', null);

		$accessory_id 									= 	$request->input('accessory_id', null);



		$arr_data['product_id']    		                =   $product_id;

		$arr_data['accessory_id']    					=   $accessory_id;

 

		$create  	= $this->ProductAccessoryModel->create($arr_data);

		

		if($create)

		{				

			Session::flash('success', 'Product Accesspry added successfully.');

			return redirect($this->module_url_path.'/edit/'.base64_encode($product_id));

		}

		else

		{

			Session::flash('error', 'Error while adding Product Accesspry.');

			return redirect($this->module_url_path.'/edit/'.base64_encode($product_id));

		}

	}



	// delete product Accessories  : AUTHOR (Akshay Ugale)

	public function delete_product_accessory($enc_id)

	{

		$arr_data 		= explode(",",$enc_id);

		$enc_id  		= base64_decode($arr_data[0]);

		$product_id  	= base64_decode($arr_data[1]);



		$delete 		= $this->ProductAccessoryModel->where('id','=',$enc_id)->delete();

		if($delete)

		{				

			Session::flash('success', 'Product Accesspry deleted successfully.');

			return redirect($this->module_url_path.'/edit/'.base64_encode($product_id));

		}

		else

		{

			Session::flash('error', 'Error while deleting Product Accesspry.');

			return redirect($this->module_url_path.'/edit/'.base64_encode($product_id));

		}

	}

}