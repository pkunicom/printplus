<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Common\Services\Authservice;
use App\Common\Services\MailService;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;
use App\Models\CountryModel;
use App\Models\EvaluationModel;
use App\Models\SystemCountryModel;
use App\Models\SystemCityModel;
use App\Models\ProductsModel;
use App\Models\OptionModel;
use App\Models\SubOptionModel;
use App\Models\DeliveryPickupPointModel;
use JWTAuth;
use Hash;
use Validator;
use App\Services\Payfort;


class CommonDataController extends Controller
{
    
  	/**
     * Access Code for Payfort
     *
     * @var string
    */
  	protected $access_code;
  
    /**
     * Merchant Idetifier
     *
     * @var string
    */
  	protected $merchant_identifier;
  
	/**
     * SHA_REQUEST for signature
     *
     * @var string
    */
  	protected $sha_request;
  
    /**
     * Language for payfort 
     *
     * @var string
    */
  	protected $language = 'en';
  
    /**
     * Request Endpoint to make form request to the payfort
     *
     * @var string
    */
  	protected $request_endpoint;
  
    /**
     * Operations Endpoint to make real payment request to the payfort
     *
     * @var string
    */
  	protected $operation_endpoint; 
  	
    public function __construct()
    {
        $this->MailService        = new MailService();
        $this->CategoryModel      = new CategoryModel();
        $this->SubCategoryModel   = new SubCategoryModel();
        $this->EvaluationModel    = new EvaluationModel();
        $this->ProductsModel      = new ProductsModel();
        $this->CountryModel       = new CountryModel();
        $this->SystemCountryModel = new SystemCountryModel();
        $this->SystemCityModel    = new SystemCityModel();
        $this->OptionModel        = new OptionModel();
        $this->SubOptionModel     = new SubOptionModel();
        $this->DeliveryPickupPointModel     = new DeliveryPickupPointModel();
        $this->user_profile_image_base_img_path   = base_path().config('app.project.img_path.user_profile_image');
        $this->user_profile_image_public_img_path = url('/').config('app.project.img_path.user_profile_image');
                $this->access_code  = config('payfort.access_code','bUOVKlJHpxjbE0stidlS');
      	$this->merchant_identifier = config('payfort.merchant_identifier','0b62e9c1');
      	$this->sha_request = config('payfort.sha_request','$2y$10$yQAy8my9b');
      	$this->request_endpoint = config('payfort.request_endpoint','https://sbcheckout.payfort.com/FortAPI/paymentPage');
      	$this->operation_endpoint = config('payfort.operation_endpoint','https://sbpaymentservices.payfort.com/FortAPI/paymentApi');

    }

    // Common Category listing : AUTHOR (Harsh chauhan) 
    public function get_category()
    {
        $arr_data = $arr_response = $arr_rules = $arr_resp = [];

        $obj_data       = $this->CategoryModel->get();

        if($obj_data){
            $arr_data = $obj_data->toArray();

            if(sizeof($arr_data)>0){
               
                foreach ($arr_data as $key => $value) {

                    $arr_resp[$key]['id']             = isset($value['id']) ?  $value['id']: '';
                    $arr_resp[$key]['english_name']   = isset($value['english_name']) ?  $value['english_name']: '';
                    $arr_resp[$key]['arabic_name']    = isset($value['arabic_name']) ?  $value['arabic_name']: '';
                  
                }

                $arr_response_data['data']     = $arr_resp;


                $arr_response['status'] =  'SUCCESS';
                $arr_response['msg']    =  'Categories displayed successfully.';
                $arr_response['data']   =  $arr_response_data['data'];
                return $arr_response;

            }else{

                $arr_response['status'] =  'ERROR';
                $arr_response['msg']    =  'No Categories found.';
                $arr_response['data']   =  [];

                return $arr_response;
            }
        }else{

            $arr_response['status'] =  'ERROR';
            $arr_response['msg']    =  'Oops! Something went wrong.';
            $arr_response['data']   =  [];

            return $arr_response;
        }    
    }

    // Common SubCategory listing : AUTHOR (Harsh chauhan) 
    public function get_subcategory(Request $request)
    {
        $category_id = $request->input('category_id');

        $arr_data = $arr_response = $arr_rules = $arr_resp = [];

        if($category_id!=""){

            $obj_data       = $this->SubCategoryModel->with('get_category_detail')->where('category_id',$category_id)->get();
        }else{

            $obj_data       = $this->SubCategoryModel->with('get_category_detail')->get();
        }

        if($obj_data){

            $arr_data = $obj_data->toArray();

            if(sizeof($arr_data)>0){

                foreach ($arr_data as $key => $value) {

                    $arr_resp[$key]['id']             = isset($value['id']) ?  $value['id']: '';
                    $arr_resp[$key]['english_name']   = isset($value['english_name']) ?  $value['english_name']: '';
                    $arr_resp[$key]['arabic_name']    = isset($value['arabic_name']) ?  $value['arabic_name']: '';
                    $arr_resp[$key]['category_id']    = isset($value['get_category_detail']['id']) ?  $value['get_category_detail']['id']: '';
                    $arr_resp[$key]['category_english_name']   = isset($value['get_category_detail']['english_name']) ?  $value['get_category_detail']['english_name']: '';
                    $arr_resp[$key]['category_arabic_name']    = isset($value['get_category_detail']['arabic_name']) ?  $value['get_category_detail']['arabic_name']: '';
                  
                }

                $arr_response_data['data']     = $arr_resp;


                $arr_response['status'] =  'SUCCESS';
                $arr_response['msg']    =  'SubCategories displayed successfully.';
                $arr_response['data']   =  $arr_response_data['data'];
                return $arr_response;

            }else{

                $arr_response['status'] =  'ERROR';
                $arr_response['msg']    =  'No SubCategories found.';
                $arr_response['data']   =  [];

                return $arr_response;
            }
        }else{

            $arr_response['status'] =  'ERROR';
            $arr_response['msg']    =  'Oops! Something went wrong.';
            $arr_response['data']   =  [];

            return $arr_response;
        }
    }

     // Common Options listing : AUTHOR (Harsh chauhan) 
    public function get_options()
    {
        $arr_data = $arr_response = $arr_rules = $arr_resp = [];

        $obj_data       = $this->OptionModel->get();

        if($obj_data){
            $arr_data = $obj_data->toArray();

            if(sizeof($arr_data)>0){
               
                foreach ($arr_data as $key => $value) {

                    $arr_resp[$key]['id']             = isset($value['id']) ?  $value['id']: '';
                    $arr_resp[$key]['english_name']   = isset($value['english_name']) ?  $value['english_name']: '';
                    $arr_resp[$key]['arabic_name']    = isset($value['arabic_name']) ?  $value['arabic_name']: '';
                  
                }

                $arr_response_data['data']     = $arr_resp;


                $arr_response['status'] =  'SUCCESS';
                $arr_response['msg']    =  'Options displayed successfully.';
                $arr_response['data']   =  $arr_response_data['data'];
                return $arr_response;

            }else{

                $arr_response['status'] =  'ERROR';
                $arr_response['msg']    =  'No Options found.';
                $arr_response['data']   =  [];

                return $arr_response;
            }
        }else{

            $arr_response['status'] =  'ERROR';
            $arr_response['msg']    =  'Oops! Something went wrong.';
            $arr_response['data']   =  [];

            return $arr_response;
        }    
    }

    // Common SubOptions listing : AUTHOR (Harsh chauhan) 
    public function get_suboptions(Request $request)
    {
        $option_id = $request->input('option_id');

        $arr_data = $arr_response = $arr_rules = $arr_resp = [];

        if($option_id!=""){

            $obj_data       = $this->SubOptionModel->where('option_id',$option_id)->get();
        }else{

            $obj_data       = $this->SubOptionModel->get();
        }

        if($obj_data){

            $arr_data = $obj_data->toArray();

            if(sizeof($arr_data)>0){

                foreach ($arr_data as $key => $value) {

                    $arr_resp[$key]['id']             = isset($value['id']) ?  $value['id']: '';
                    $arr_resp[$key]['english_name']   = isset($value['english_name']) ?  $value['english_name']: '';
                    $arr_resp[$key]['arabic_name']    = isset($value['arabic_name']) ?  $value['arabic_name']: '';
                  
                }

                $arr_response_data['data']     = $arr_resp;


                $arr_response['status'] =  'SUCCESS';
                $arr_response['msg']    =  'SubOptions displayed successfully.';
                $arr_response['data']   =  $arr_response_data['data'];
                return $arr_response;

            }else{

                $arr_response['status'] =  'ERROR';
                $arr_response['msg']    =  'No SubOptions found.';
                $arr_response['data']   =  [];

                return $arr_response;
            }
        }else{

            $arr_response['status'] =  'ERROR';
            $arr_response['msg']    =  'Oops! Something went wrong.';
            $arr_response['data']   =  [];

            return $arr_response;
        }
    }

    // Common Header products listing : AUTHOR (Harsh chauhan) 
    public function get_headerproducts(Request $request)
    {
        $arr_data = $arr_response = $arr_rules = $arr_resp = [];

        $arr_rules['category_id']                    = "required";
        $arr_rules['subcategory_id']                 = "required";
        
        $validator = validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            $msg        = "Validation Error, Please fill up the all mandatory fields";
            if($validator->errors())
            {
                $arr_resp_data['error'] = $validator->errors()->first(); 
            }
            $arr_response['status'] = 'ERROR';
            $arr_response['msg']    = $msg;
            $arr_response['data']   = $arr_resp_data;
        }

        $category_id    = $request->input('category_id');
        $subcategory_id = $request->input('subcategory_id');



        $obj_data       = $this->ProductsModel->select('id','product_english_name','product_arabic_name','category_id','subcategory_id')
                                              ->where('category_id',$category_id)
                                              ->where('subcategory_id',$subcategory_id)
                                              ->get();

        if($obj_data){
            $arr_data = $obj_data->toArray();

            if(sizeof($arr_data)>0){
                foreach ($arr_data as $key => $value) {

                    $arr_resp[$key]['id']                     = isset($value['id']) ?  $value['id']: '';
                    $arr_resp[$key]['product_english_name']   = isset($value['product_english_name']) ?  $value['product_english_name']: '';
                    $arr_resp[$key]['product_arabic_name']    = isset($value['product_english_name']) ?  $value['product_english_name']: '';
                    
                }

                $arr_response_data['data']     = $arr_resp;


                $arr_response['status'] =  'SUCCESS';
                $arr_response['msg']    =  'Products displayed successfully.';
                $arr_response['data']   =  $arr_response_data['data'];
                return $arr_response;

            }else{

                $arr_response['status'] =  'ERROR';
                $arr_response['msg']    =  'No Products found.';
                $arr_response['data']   =  [];

                return $arr_response;
            }
        }else{

            $arr_response['status'] =  'ERROR';
            $arr_response['msg']    =  'Oops! Something went wrong.';
            $arr_response['data']   =  [];
            return $arr_response;
        }


    }


    // Common homeapge reviews : AUTHOR (Harsh chauhan) 
    public function get_homepage_reviews()
    {
        $arr_data = $arr_response = $arr_rules = $arr_resp = [];

        $obj_data       = $this->EvaluationModel->with('get_customer_details')
                                                ->orderBy('created_at','DESC')
                                                ->limit(4)
                                                ->get();

        if($obj_data){

            $arr_data = $obj_data->toArray();

            if(sizeof($arr_data)>0){

                foreach ($arr_data as $key => $value) {

                    $arr_resp[$key]['id']             = isset($value['id']) ?  $value['id']: '';
                    $arr_resp[$key]['evaluation']     = isset($value['evaluation']) ?  $value['evaluation']: '';
                    $arr_resp[$key]['comment']        = isset($value['comment']) ?  $value['comment']: '';

                    $arr_resp[$key]['user_id']        = isset($value['get_customer_details']['id']) ? $value['get_customer_details']['id'] : '';
                    $arr_resp[$key]['user_full_name'] = isset($value['get_customer_details']['full_name']) ? $value['get_customer_details']['full_name'] : '';
                    $arr_resp[$key]['user_email']     = isset($value['get_customer_details']['email']) ? $value['get_customer_details']['email'] : '';

                    if(isset($value_answer['get_user_details']['profile_image']) && !empty($value_answer['get_user_details']['profile_image']) && file_exists($this->user_profile_image_base_img_path.$value_answer['get_user_details']['profile_image']))
                    {
                        $arr_resp[$key]['user_profile_image']    =  $this->user_profile_image_public_img_path.$value_answer['get_user_details']['profile_image'];
                    }
                    else
                    {
                        $arr_resp[$key]['user_profile_image']    = url('/')."/uploads/default/no-img-user-profile.jpeg";
                    }
                  
                }

                $arr_response_data['data']     = $arr_resp;


                $arr_response['status'] =  'SUCCESS';
                $arr_response['msg']    =  'Reviews displayed successfully.';
                $arr_response['data']   =  $arr_response_data['data'];
                return $arr_response;

            }else{
                $arr_response['status'] =  'ERROR';
                $arr_response['msg']    =  'No Reviews.';
                $arr_response['data']   =  [];
                return $arr_response;
            }

        }else{

            $arr_response['status'] =  'ERROR';
            $arr_response['msg']    =  'Something went wrong.';
            $arr_response['data']   =  [];

            return $arr_response;
        }

       
    }

    // Common country code for mobile   : AUTHOR (Akshay Ugale)
    public function get_country_code()
    {
        $arr_data = $arr_response = $arr_rules = $arr_resp = [];

        $obj_data       = $this->CountryModel->get();

        if($obj_data){

            $arr_data = $obj_data->toArray();

            if(sizeof($arr_data)>0){

                foreach ($arr_data as $key => $value) {
                    $arr_resp[$key]['id']                   = isset($value['id']) ?  $value['id']: '';
                    $arr_resp[$key]['name']                 = isset($value['name']) ?  $value['name']: '';
                    $arr_resp[$key]['short_name']           = isset($value['short_name']) ?  $value['short_name']: '';
                    $arr_resp[$key]['country_code']         = isset($value['country_code']) ?  $value['country_code']: '';
                    $arr_resp[$key]['slug']                 = isset($value['slug']) ?  $value['slug']: '';                  
                }

                $arr_response_data['data']     = $arr_resp;


                $arr_response['status'] =  'SUCCESS';
                $arr_response['msg']    =  'Country data displayed successfully.';
                $arr_response['data']   =  $arr_response_data['data'];
                return $arr_response;

            }else{
                $arr_response['status'] =  'Error';
                $arr_response['msg']    =  'No data found.';
                $arr_response['data']   =  [];
                return $arr_response;
            }

        }else{

            $arr_response['status'] =  'Error';
            $arr_response['msg']    =  'Something went wrong.';
            $arr_response['data']   =  [];

            return $arr_response;
        }

       
    }

    // Common system country   : AUTHOR (Akshay Ugale)
    public function get_system_country(Request $request)
    {
        $obj_data       = $this->SystemCountryModel->get();

        if($obj_data){
            $arr_data = $obj_data->toArray();
            if(sizeof($arr_data)>0){
                foreach ($arr_data as $key => $value) {
                    $arr_resp[$key]['sr_no']                = $key+1;
                    $arr_resp[$key]['id']                   = isset($value['id']) ?  $value['id']: '';
                    $arr_resp[$key]['country_id']           = isset($value['country_id']) ?  $value['country_id']: '';
                    $arr_resp[$key]['country_english_name'] = isset($value['country_english_name']) ?  $value['country_english_name']: '';
                    $arr_resp[$key]['country_arabic_name']  = isset($value['country_arabic_name']) ?  $value['country_arabic_name']: '';              
                }
                $arr_response_data['data']     = $arr_resp;

                $arr_response['status'] =  'SUCCESS';
                $arr_response['msg']    =  'Country data displayed successfully.';
                $arr_response['data']   =  $arr_response_data['data'];
                return $arr_response;

            }else{
                $arr_response['status'] =  'Error';
                $arr_response['msg']    =  'No data found.';
                $arr_response['data']   =  [];
                return $arr_response;
            }

        }else{

            $arr_response['status'] =  'Error';
            $arr_response['msg']    =  'Something went wrong.';
            $arr_response['data']   =  [];

            return $arr_response;
        }       
    }

    // Common System city from country id    : AUTHOR (Akshay Ugale)
    public function get_system_city(Request $request)
    {
        $arr_data = $arr_rule = [];
        $arr_rule['country_id']             = "required|numeric";

        $validator = Validator::make($request->all(), $arr_rule);

        if($validator->fails())
        {
            $arr_responce['status'] = 'ERROR';
            $arr_responce['msg']    = 'Please fill all the required field.';
            $arr_responce['data']   = [];

            if($validator->errors())
            {
                $arr_responce['msg'] =$validator->errors()->first();
            }
            
            return $arr_responce;
        }
        $country_id             = $request->input('country_id');
        $obj_data       = $this->SystemCityModel->where('system_country_id','=',$country_id)->get();

        if($obj_data){

            $arr_data = $obj_data->toArray();

            if(sizeof($arr_data)>0){

                foreach ($arr_data as $key => $value) {
                    $arr_resp[$key]['sr_no']                = $key+1;
                    $arr_resp[$key]['id']                   = isset($value['id']) ?  $value['id']: '';
                    $arr_resp[$key]['city_id']              = isset($value['city_id']) ?  $value['city_id']: '';
                    $arr_resp[$key]['city_english_name']    = isset($value['city_english_name']) ?  $value['city_english_name']: '';
                    $arr_resp[$key]['city_arabic_name']     = isset($value['city_arabic_name']) ?  $value['city_arabic_name']: '';              
                }

                $arr_response_data['data']     = $arr_resp;


                $arr_response['status'] =  'SUCCESS';
                $arr_response['msg']    =  'City data displayed successfully.';
                $arr_response['data']   =  $arr_response_data['data'];
                return $arr_response;

            }else{
                $arr_response['status'] =  'Error';
                $arr_response['msg']    =  'No data found.';
                $arr_response['data']   =  [];
                return $arr_response;
            }
        }else{

            $arr_response['status'] =  'Error';
            $arr_response['msg']    =  'Something went wrong.';
            $arr_response['data']   =  [];

            return $arr_response;
        }

       
    }

    // Common Pickup points : AUTHOR (Harsh chauhan) 
    public function get_pickup_points(Request $request)
    {
        $arr_data = $arr_response = $arr_rules = $arr_resp = [];

        $arr_rule['country_id']             = "required|numeric";
        $arr_rule['city_id']                = "required|numeric";

        $validator = Validator::make($request->all(), $arr_rule);

        if($validator->fails())
        {
            $arr_responce['status'] = 'ERROR';
            $arr_responce['msg']    = 'Please fill all the required field.';
            $arr_responce['data']   = [];

            if($validator->errors())
            {
                $arr_responce['msg'] = $validator->errors()->first();
            }
            
            return $arr_responce;
        }

        $country_id = $request->input('country_id');
        $city_id    = $request->input('city_id');

        $obj_data       = $this->DeliveryPickupPointModel->with('get_city_details','get_country_details')
                                                         ->where('country_id',$country_id)
                                                         ->where('city_id',$city_id)
                                                         ->get();

        if($obj_data){
            $arr_data = $obj_data->toArray();
            // dd($arr_data);
            if(sizeof($arr_data)>0){
               
                foreach ($arr_data as $key => $value) {

                    $arr_resp[$key]['id']                       = isset($value['id']) ?  $value['id']: '';
                    $arr_resp[$key]['point_id']                 = isset($value['point_id']) ?  $value['point_id']: '';
                    $arr_resp[$key]['point_english_name']       = isset($value['point_english_name']) ?  $value['point_english_name']: '';
                    $arr_resp[$key]['point_arabic_name']        = isset($value['point_arabic_name']) ?  $value['point_arabic_name']: '';
                    $arr_resp[$key]['english_address']          = isset($value['english_address']) ?  $value['english_address']: '';
                    $arr_resp[$key]['arabic_address']           = isset($value['arabic_address']) ?  $value['arabic_address']: '';
                    $arr_resp[$key]['english_working_hours']    = isset($value['english_working_hours']) ?  $value['english_working_hours']: '';
                    $arr_resp[$key]['arabic_working_hours']     = isset($value['arabic_working_hours']) ?  $value['arabic_working_hours']: '';
                    $arr_resp[$key]['city_name']                = isset($value['get_city_details']['city_english_name']) ?  $value['get_city_details']['city_english_name']: '';
                    $arr_resp[$key]['country_name']             = isset($value['get_country_details']['country_english_name']) ?  $value['get_country_details']['country_english_name']: '';
                    $arr_resp[$key]['latitude']                 = isset($value['latitude']) ?  $value['latitude']: '';
                    $arr_resp[$key]['longitude']                = isset($value['longitude']) ?  $value['longitude']: '';
                  
                }

                $arr_response_data['data']     = $arr_resp;


                $arr_response['status'] =  'SUCCESS';
                $arr_response['msg']    =  'Pickup points displayed successfully.';
                $arr_response['data']   =  $arr_response_data['data'];
                return $arr_response;

            }else{

                $arr_response['status'] =  'ERROR';
                $arr_response['msg']    =  'No Pickup points found.';
                $arr_response['data']   =  [];

                return $arr_response;
            }
        }else{

            $arr_response['status'] =  'ERROR';
            $arr_response['msg']    =  'Oops! Something went wrong.';
            $arr_response['data']   =  [];

            return $arr_response;
        }    
    }
    
	public function requestSignature(Request $request)
    {
       $order_id = app('App\Http\Controllers\Api\OrderManagementController')->save_order($request);
      // dd($order_id);
      return $this->signature([
        	'access_code'=>$this->access_code,
  			'language'=>$this->language,
        	'merchant_identifier'=>$this->merchant_identifier,
  			'service_command'=>'TOKENIZATION',
        	'merchant_reference'=>$request->merchant_reference,
        	'amount'=>$request->amount,
        	'currency'=>$request->currency
        ]); 
        //return response()->json($signature);
    } 
    
  	/**
     * Create signature using SHA256 algorithm
     *
     * @param array|params
     * @return string
    */
  	private function signature(array $params)
    {
    	$shaString = '';
        ksort($params);
        foreach ($params as $key => $value) {
            $shaString .= "$key=$value";
        }
        $shaString = $this->sha_request.$shaString.$this->sha_request;
                $arr_response['status'] =  'SUCCESS';
                $arr_response['msg']    =  'signature genrated.';
                $arr_response['data']   =  hash("sha256", $shaString);
                return $arr_response;
    }    
}