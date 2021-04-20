<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Common\Services\Authservice;
use App\Common\Services\MailService;
use App\Models\ProductsModel;
use App\Models\ProductWeightTimeCostDetailsModel;
use App\Models\ProductWeightTimeCostModel;
use App\Models\CityInstallationModel;
use App\Models\DiscountModel;
use App\Models\VatModel;
use JWTAuth;
use Hash;
use Validator;
use Carbon;
//use DB;


class ProductsController extends Controller
{
    public function __construct()
    {
        $this->MailService        = new MailService();
        $this->ProductsModel      = new ProductsModel();
        $this->ProductWeightTimeCostDetailsModel      = new ProductWeightTimeCostDetailsModel();
        $this->ProductWeightTimeCostModel             = new ProductWeightTimeCostModel();
        $this->CityInstallationModel                  = new CityInstallationModel();
        $this->DiscountModel                          = new DiscountModel();
        $this->VatModel                          = new VatModel();
          $this->product_image_base_img_path   = base_path().config('app.project.img_path.product_images');
        $this->product_image_public_img_path = url('/').config('app.project.img_path.product_images');

    }

     //Product Listing : AUTHOR (Harsh chauhan) 
    public function productlisting(Request $request)
    {
        $arr_data = $arr_response = $arr_rules = $arr_resp = [];

        // Commented because it can be reused for filters
       /* $obj_data       = $this->ProductsModel->with(['get_product_option_detail'=>function($q){
                                                    $q->with('get_option_detail');
                                                }])
                                                ->with(['get_product_suboption_detail'=>function($q){
                                                    $q->with('get_sub_option_detail');
                                                }])
                                                ->with('get_fixed_quantity','get_variable_quantity')
                                               ->orderBy('created_at','DESC')
                                               ->get();*/

        $category_id    = $request->input('category_id');
        $subcategory_id = $request->input('subcategory_id');
        $search         = $request->input('search');


        $obj_data       = $this->ProductsModel->with('get_category_details','get_subcategory_details','get_product_images');

        if(isset($search)&& $search!='' ){

            $obj_data       = $obj_data->where('product_english_name','LIKE',"%".$search."%");
        }
        
        $obj_data       = $obj_data->orderBy('created_at','DESC');

        if(isset($category_id) && $category_id!='')
        {
            $obj_data   = $obj_data->where('category_id',$category_id);
        }

        if(isset($subcategory_id) && $subcategory_id!='')
        {
            $obj_data   = $obj_data->where('subcategory_id',$category_id);
        }


        $obj_data   = $obj_data->get();
       
        if($obj_data){

            $arr_data = $obj_data->toArray();
            
            if(sizeof($arr_data)>0){

                foreach ($arr_data as $key => $value) {
                    $arr_resp[$key]['id']                             = isset($value['id']) ?  $value['id']: '';
                    $arr_resp[$key]['product_id']                     = isset($value['product_id']) ?  $value['product_id']: '';
                    $arr_resp[$key]['product_english_name']           = isset($value['product_english_name']) ?  $value['product_english_name']: '';
                    $arr_resp[$key]['product_arabic_name']            = isset($value['product_arabic_name']) ?  $value['product_arabic_name']: '';
                    $arr_resp[$key]['product_arabic_description']     = isset($value['product_arabic_description']) ?  $value['product_arabic_description']: '';
                    $arr_resp[$key]['product_english_description']    = isset($value['product_english_description']) ?  $value['product_english_description']: '';
                    $arr_resp[$key]['quantity_type']                  = isset($value['quantity_type']) ?  $value['quantity_type']: '';
                    $arr_resp[$key]['category_id']                    = isset($value['get_category_details']['id']) ?  $value['get_category_details']['id']: '';
                    $arr_resp[$key]['category_english_name']          = isset($value['get_category_details']['english_name']) ?  $value['get_category_details']['english_name']: '';
                    $arr_resp[$key]['category_arabic_name']           = isset($value['get_category_details']['arabic_name']) ?  $value['get_category_details']['arabic_name']: '';
                    $arr_resp[$key]['subcategory_id']                 = isset($value['get_subcategory_details']['id']) ?  $value['get_subcategory_details']['id']: '';
                    $arr_resp[$key]['subcategory_english_name']       = isset($value['get_subcategory_details']['english_name']) ?  $value['get_subcategory_details']['english_name']: '';
                    $arr_resp[$key]['subcategory_arabic_name']        = isset($value['get_subcategory_details']['arabic_name']) ?  $value['get_subcategory_details']['arabic_name']: '';
                    
                     if(sizeof($value['get_product_images'])>0){
                                // dd($value['get_product_images']);
                        if(isset($value['get_product_images'][0]['image']) && $value['get_product_images'][0]['image']!=null)
                        {
                            $profile_img = $this->product_image_public_img_path.$value['get_product_images'][0]['image'];
                        }
                        else
                        {
                            $profile_img = $this->product_image_public_img_path.'default.jpg';
                        }
                        $arr_resp[$key]['product_images']  = $profile_img;
                    }else{
                        $arr_resp[$key]['product_images']  = $profile_img = $this->product_image_public_img_path.'default.jpg';
                    }
                }

                $arr_response_data['data']       = $arr_resp;

                $arr_response['status'] =  'SUCCESS';
                $arr_response['msg']    =  'Product listing displayed successfully.';
                $arr_response['data']   =  $arr_response_data['data'];
               // dd($arr_response);
                return response()->json($arr_response);
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
    
       //Home page Product Listing : AUTHOR (Harsh chauhan) 
    public function homepage_productlisting(Request $request)
    {
        $arr_data = $arr_response = $arr_rules = $arr_resp = [];

        $obj_data       = $this->ProductsModel->with('get_category_details','get_subcategory_details','get_product_images')->limit(6)->get();
       
        if($obj_data){

            $arr_data = $obj_data->toArray();
            // dd($arr_data);
            if(sizeof($arr_data)>0){

                foreach ($arr_data as $key => $value) {
                    $arr_resp[$key]['id']                             = isset($value['id']) ?  $value['id']: '';
                    $arr_resp[$key]['product_id']                     = isset($value['product_id']) ?  $value['product_id']: '';
                    $arr_resp[$key]['product_english_name']           = isset($value['product_english_name']) ?  $value['product_english_name']: '';
                    $arr_resp[$key]['product_arabic_name']            = isset($value['product_arabic_name']) ?  $value['product_arabic_name']: '';
                    $arr_resp[$key]['product_arabic_description']     = isset($value['product_arabic_description']) ?  $value['product_arabic_description']: '';
                    $arr_resp[$key]['product_english_description']    = isset($value['product_english_description']) ?  $value['product_english_description']: '';
                    $arr_resp[$key]['quantity_type']                  = isset($value['quantity_type']) ?  $value['quantity_type']: '';
                    $arr_resp[$key]['category_id']          = isset($value['get_category_details']['id']) ?  $value['get_category_details']['id']: '';
                    $arr_resp[$key]['category_english_name']          = isset($value['get_category_details']['english_name']) ?  $value['get_category_details']['english_name']: '';
                    $arr_resp[$key]['category_arabic_name']           = isset($value['get_category_details']['arabic_name']) ?  $value['get_category_details']['arabic_name']: '';
                    $arr_resp[$key]['subcategory_id']       = isset($value['get_subcategory_details']['id']) ?  $value['get_subcategory_details']['id']: '';
                    $arr_resp[$key]['subcategory_english_name']       = isset($value['get_subcategory_details']['english_name']) ?  $value['get_subcategory_details']['english_name']: '';
                    $arr_resp[$key]['subcategory_arabic_name']        = isset($value['get_subcategory_details']['arabic_name']) ?  $value['get_subcategory_details']['arabic_name']: '';
                      if(sizeof($value['get_product_images'])>0){
                                // dd($value['get_product_images']);
                        if(isset($value['get_product_images'][0]['image']) && $value['get_product_images'][0]['image']!=null)
                        {
                            $profile_img = $this->product_image_public_img_path.$value['get_product_images'][0]['image'];
                        }
                        else
                        {
                            $profile_img = $this->product_image_public_img_path.'default.jpg';
                        }
                        $arr_resp[$key]['product_images']  = $profile_img;
                    }else{
                        $arr_resp[$key]['product_images']  = $profile_img = $this->product_image_public_img_path.'default.jpg';
                    }
                }

                $arr_response_data['data']       = $arr_resp;

                $arr_response['status'] =  'SUCCESS';
                $arr_response['msg']    =  'Product listing displayed successfully.';
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


    //Product details : AUTHOR (Harsh chauhan) 
    public function productdetails(Request $request)
    {

        $arr_rules['product_id']                    = "required";
        
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

        $arr_data = $arr_response = $arr_rules = $arr_resp = [];

        $product_id     = $request->input('product_id');

        $obj_data       = $this->ProductsModel->with(['get_product_option_detail'=>function($q)use($product_id){
                                                    $q->with('get_option_detail');
                                                    $q->with(['get_suboptions'=>function($q2)use($product_id){
                                                        $q2->with('get_sub_option_detail');
                                                        $q2->where('product_id',$product_id);
                                                    }]);
                                               }])
                                               ->with('get_fixed_quantity','get_variable_quantity','get_product_images')
                                               ->with(['get_product_accessories'=>function($q){
                                                   $q->with('get_accessory_detail');
                                               }])
                                               ->where('id',$product_id)
                                               ->first();

        if($obj_data){

            $arr_data = $obj_data->toArray();
            // dd($arr_data);
            $arr_resp['id']                             = isset($arr_data['id']) ?  $arr_data['id']: '';
            $arr_resp['product_id']                     = isset($arr_data['product_id']) ?  $arr_data['product_id']: '';
            $arr_resp['product_english_name']           = isset($arr_data['product_english_name']) ?  $arr_data['product_english_name']: '';
            $arr_resp['product_arabic_name']            = isset($arr_data['product_arabic_name']) ?  $arr_data['product_arabic_name']: '';
            $arr_resp['product_arabic_description']     = isset($arr_data['product_arabic_description']) ?  $arr_data['product_arabic_description']: '';
            $arr_resp['product_english_description']    = isset($arr_data['product_english_description']) ?  $arr_data['product_english_description']: '';
            $arr_resp['quantity_type']                  = isset($arr_data['quantity_type']) ?  $arr_data['quantity_type']: '';

            // Looping product options
            foreach ($arr_data['get_product_option_detail'] as $key_option => $value_option) {
                $arr_resp['product_option'][$key_option]['option_id']      = isset($value_option['get_option_detail']['id'])?$value_option['get_option_detail']['id']:'';
                $arr_resp['product_option'][$key_option]['english_name']   = isset($value_option['get_option_detail']['english_name'])?$value_option['get_option_detail']['english_name']:'';
                $arr_resp['product_option'][$key_option]['arabic_name']    = isset($value_option['get_option_detail']['arabic_name'])?$value_option['get_option_detail']['arabic_name']:'';

                // Looping product suboptions
                // dd($value_option['get_suboptions']);
                foreach ($value_option['get_suboptions'] as $key_suboption => $value_suboption) {
                    // dd($value_suboption);
                    // if($value_suboption['product_id']== $arr_data['id']){
                         if($value_suboption['option_id']==$value_option['option_id']){
                            $arr_resp['product_option'][$key_option]['sub_options'][$key_suboption]['suboption_id']   = isset($value_suboption['get_sub_option_detail']['id'])?$value_suboption['get_sub_option_detail']['id']:'';
                            $arr_resp['product_option'][$key_option]['sub_options'][$key_suboption]['english_name']   = isset($value_suboption['get_sub_option_detail']['english_name'])?$value_suboption['get_sub_option_detail']['english_name']:'';
                            $arr_resp['product_option'][$key_option]['sub_options'][$key_suboption]['arabic_name']    = isset($value_suboption['get_sub_option_detail']['arabic_name'])?$value_suboption['get_sub_option_detail']['arabic_name']:'';
                         }     
                    // }
                }
            }


            if($arr_data['quantity_type']=='fixed'){
                foreach ($arr_data['get_fixed_quantity'] as $key_fixed_quantity => $value_fixed_quantity) {
                    $arr_resp['fixed_quantity'][$key_fixed_quantity]['fixedquantity_id']  = isset($value_fixed_quantity['id'])?$value_fixed_quantity['id']:'';
                    $arr_resp['fixed_quantity'][$key_fixed_quantity]['quantity']          = isset($value_fixed_quantity['fixed_quantity'])?$value_fixed_quantity['fixed_quantity']:'';
                }
                $arr_resp['variable_quantity']  = [];

            }elseif($arr_data['quantity_type']=='variable'){  
                foreach ($arr_data['get_variable_quantity'] as $key_variable_quantity => $value_variable_quantity) {
                    $arr_resp['variable_quantity'][$key_variable_quantity]['variablequantity_id'] = isset($value_variable_quantity['id'])?$value_variable_quantity['id']:'';
                    $arr_resp['variable_quantity'][$key_variable_quantity]['minimum_quantity'] = isset($value_variable_quantity['minimum_quantity'])?$value_variable_quantity['minimum_quantity']:'';
                    $arr_resp['variable_quantity'][$key_variable_quantity]['maximum_quantity'] = isset($value_variable_quantity['maximum_quantity'])?$value_variable_quantity['maximum_quantity']:'';
                    $arr_resp['variable_quantity'][$key_variable_quantity]['discount'] = isset($value_variable_quantity['discount'])?$value_variable_quantity['discount']:'';
                }
                $arr_resp['fixed_quantity']  = [];
            }

            if(sizeof($arr_data['get_product_accessories'])>0){
                foreach ($arr_data['get_product_accessories'] as $key_accessories => $value_accessories) {
                    $arr_resp['accessories'][$key_accessories]['accessory_id']              = isset($value_accessories['id'])?$value_accessories['id']:'';
                    $arr_resp['accessories'][$key_accessories]['accessory_english_name']    = isset($value_accessories['get_accessory_detail']['english_name'])?$value_accessories['get_accessory_detail']['english_name']:'';
                    $arr_resp['accessories'][$key_accessories]['accessory_arabic_name']     = isset($value_accessories['get_accessory_detail']['arabic_name'])?$value_accessories['get_accessory_detail']['arabic_name']:'';
                }
            }else{
                 $arr_resp['accessories']  = [];
            }
            
           if(sizeof($arr_data['get_product_images'])>0){
                // dd($arr_data['get_product_images']);
                foreach ($arr_data['get_product_images'] as $key_images => $value_images) {
                    $arr_resp['product_images'][$key_images]['image_id']              = isset($value_images['id'])?$value_images['id']:'';
                      if(isset($value_images['image']) && $value_images['image']!=null)
                    {
                        $profile_img = $this->product_image_public_img_path.$value_images['image'];
                    }
                    else
                    {
                        $profile_img = $this->product_image_public_img_path.'default.jpg';
                    }
                    $arr_resp['product_images'][$key_images]['image']  = $profile_img;
                }
            }else{
                 $arr_resp['product_images']  = [];
            }

            $arr_response_data['data']       = $arr_resp;

            $arr_response['status'] =  'SUCCESS';
            $arr_response['msg']    =  'Content displayed successfully.';
            $arr_response['data']   =  $arr_response_data['data'];
            return $arr_response;

        }else{

            $arr_response['status'] =  'SUCCESS';
            $arr_response['msg']    =  'No Content found.';
            $arr_response['data']   =  [];

            return $arr_response;
        }

        $arr_response['status'] =  'SUCCESS';
        $arr_response['msg']    =  'Oops! Something went wrong.';
        $arr_response['data']   =  [];

        return $arr_response;
    }


    //Product Price by selecting options : AUTHOR (Harsh chauhan) 
    public function productprice(Request $request)
    {
        $arr_rule = [];
         //dd($request->all());
        $arr_rule['data']        = "required";
        $arr_rule['product_id']  = "required";

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

        $data           = json_decode($request->input('data'));
        $product_id     = $request->input('product_id');
            $suboptions = '';
        foreach ($data as $key => $value) {
           if($suboptions == '' ){
               $suboptions = $value->sub_option;
           }else{
               $suboptions .= ','. $value->sub_option;
           }
             //$arr_suboptions[] = $value->sub_option; 
        }
        //
        $arr_suboptions = explode(',',$suboptions);
        //dd($arr_suboptions);
        // Query to check json data
        // $obj_check = $this->ProductWeightTimeCostModel->whereJsonContains('description', json_encode($arr_suboptions))
        //                                               ->where('product_id',$product_id)
        //                                               ->first();
        
       // DB::enableQueryLog();
        $obj_check = $this->ProductWeightTimeCostDetailsModel->whereIn('sub_option_id',$arr_suboptions)
                                                             ->where('product_id',$product_id)
                                                             ->get();
                                                             
        //$query = DB::getQueryLog();
	//	$query = end($query);
	//	dd($query);

        if($obj_check){
            $arr_check = $obj_check->toArray();
            //dd($arr_check);
            // Returns count of each unique combination id
            $counts = array_count_values(
                array_column($arr_check, 'combination_id')
            );                                                                          

            // Get the combination id with maximum count
            $maxs = array_keys($counts, max($counts));
            //dd($maxs);
            $obj_data = $this->ProductWeightTimeCostModel->where('id',$maxs)
                                                         ->first();

            $arr_productdiscount = $this->get_product_discount($product_id);
           //dd($obj_data);
            if($obj_data){
                $arr_data = $obj_data->toArray();
                // dd($arr_data);
                $obj_vat = $this->VatModel->where('id','1')->first();
                    // dd($obj_vat);
                if(isset($arr_data['selling']) && $arr_data['selling']!=''){
                    
                    $total_vat = (float) (isset($arr_data['selling']) ?  $arr_data['selling']: 0)*((isset($obj_vat->vat)?$obj_vat->vat:0)/100);
                    
                    $arr_resp['id']                     = isset($arr_data['id']) ?  $arr_data['id']: '';
                    $arr_resp['sub_options_comb_id']    = isset($arr_data['sub_options_comb_id']) ?  $arr_data['sub_options_comb_id']: '';
                    $arr_resp['weight']                 = isset($arr_data['weight']) ?  $arr_data['weight']: '';
                    $arr_resp['lead_time']              = isset($arr_data['lead_time']) ?  $arr_data['lead_time']: '';
                    $arr_resp['selling_amount']         = isset($arr_data['selling']) ?  $arr_data['selling']+$total_vat: '';
                    
                    // dd($total_vat,$arr_data['selling']);
                    if(isset($arr_productdiscount)&&!empty($arr_productdiscount)){
                        $arr_resp['discount_id']        = isset($arr_productdiscount['id']) ?  $arr_productdiscount['id']: '';
                        $arr_resp['discount_percentage']        = isset($arr_productdiscount['percentage']) ?  $arr_productdiscount['percentage']: '';
                        $arr_resp['discounted_amount']  = isset($arr_data['selling']) ? (float) $arr_data['selling'] - ($arr_data['selling']*$arr_productdiscount['percentage']/100): $arr_resp['selling_amount'];
                    }else{
                        $arr_resp['discount_id']                = 0;
                        $arr_resp['discount_percentage']        = 0;
                        $arr_resp['discounted_amount']  = isset($arr_data['selling']) ?  $arr_data['selling']: 0;
                    }
                    
                    $arr_resp['discounted_amount'] = $arr_resp['discounted_amount']+$total_vat;
                    // $arr_resp['amount_with_vat'] = $arr_resp['discounted_amount']+$total_vat;
                    
                    $arr_response_data['data']          = $arr_resp;
                    
                    ini_set('serialize_precision', -1);  
                    
                    $arr_response['status'] =  'SUCCESS';
                    $arr_response['msg']    =  'Data returned successfully.';
                    $arr_response['data']   =  $arr_response_data['data'];
                    return $arr_response;
                }else{
                    $arr_response['status'] =  'ERROR';
                    $arr_response['msg']    =  'Combination price does not exists.';
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

    }


     // Product city installation : AUTHOR (Harsh chauhan) 
    public function productcity_installation(Request $request)
    {
        $arr_data = $arr_response = $arr_rules = $arr_resp = [];

        $arr_rules['product_id']                    = "required";
        
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

        $product_id     = $request->input('product_id');

        $obj_data       = $this->CityInstallationModel->with('get_country_detail','get_city_detail')
                                                      ->where('product_id',$product_id)
                                                      ->get();

        if($obj_data){
            $arr_data = $obj_data->toArray();

            if(sizeof($arr_data)>0){
               
                foreach ($arr_data as $key => $value) {

                    $arr_resp[$key]['id']                   = isset($value['id']) ?  $value['id']: '';
                    $arr_resp[$key]['country_id']           = isset($value['get_country_detail']['id']) ?  $value['get_country_detail']['id']: '';
                    $arr_resp[$key]['country_english_name'] = isset($value['get_country_detail']['country_english_name']) ?  $value['get_country_detail']['country_english_name']: '';
                    $arr_resp[$key]['country_arabic_name']  = isset($value['get_country_detail']['country_arabic_name']) ?  $value['get_country_detail']['country_arabic_name']: '';
                    $arr_resp[$key]['city_id']              = isset($value['get_city_detail']['id']) ?  $value['get_city_detail']['id']: '';
                    $arr_resp[$key]['city_english_name']    = isset($value['get_city_detail']['city_english_name']) ?  $value['get_city_detail']['city_english_name']: '';
                    $arr_resp[$key]['city_arabic_name']     = isset($value['get_city_detail']['city_arabic_name']) ?  $value['get_city_detail']['city_arabic_name']: '';
                    $arr_resp[$key]['visit_cost']           = isset($value['visit_cost']) ?  $value['visit_cost']: '';
                    $arr_resp[$key]['visit_selling']        = isset($value['visit_selling']) ?  $value['visit_selling']: '';
                    $arr_resp[$key]['unit_cost']            = isset($value['unit_cost']) ?  $value['unit_cost']: '';
                    $arr_resp[$key]['unit_selling']         = isset($value['unit_selling']) ?  $value['unit_selling']: '';                                      
                }

                $arr_response_data['data']     = $arr_resp;


                $arr_response['status'] =  'SUCCESS';
                $arr_response['msg']    =  'City installation data displayed successfully.';
                $arr_response['data']   =  $arr_response_data['data'];
                return $arr_response;

            }else{

                $arr_response['status'] =  'ERROR';
                $arr_response['msg']    =  'No City installation found.';
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

    //  Product discount
    public function get_product_discount($product_id){
        $arr_empty = [];

        $date = Carbon\Carbon::now()->format('Y-m-d');
        $time = Carbon\Carbon::now()->toTimeString();
        // dd($date,$time);
        $today                  = Carbon\Carbon::now('Asia/Kolkata')->toDateTimeString();
        $obj_product     = $this->ProductsModel->where('id',$product_id)->first();

        $category_id     = isset($obj_product->category_id)     ? $obj_product->category_id:'';
        $subcategory_id  = isset($obj_product->subcategory_id)  ? $obj_product->subcategory_id:'';

        $obj_discount    = $this->DiscountModel->where('product_id',$product_id)
                                                   // ->orwhere('category_id')
                                                   ->whereDate('start_date','<=',$date)
                                                   ->whereDate('end_date','>=',$date)
                                                   ->first();


        if($obj_discount){
            $arr_discount = $obj_discount->toArray();
            // dd($arr_discount);
            $start                  = $arr_discount['start_date'].' '.$arr_discount['start_time'];
            $end                    = $arr_discount['end_date'].' '.$arr_discount['end_time'];
            // dd($start,$end,$today);

            if(($start <= $today) && ($end>=$today) ){
                return $arr_discount;
            }else{
                return $arr_empty ;
            }

        }
        else{
            $obj_discount    = $this->DiscountModel->where('category_id',$category_id)
                                                   // ->orwhere('sub_category_id',$subcategory_id)
                                                   // ->whereNull('product_id')
                                                   ->whereDate('start_date','<=',$date)
                                                   ->whereDate('end_date','>=',$date)
                                                   ->first();

            if($obj_discount){
                $arr_discount = $obj_discount->toArray();
                // dd($arr_discount)
                $start                  = $arr_discount['start_date'].' '.$arr_discount['start_time'];
                $end                    = $arr_discount['end_date'].' '.$arr_discount['end_time'];
                // dd($start,$end,$today);

                if(($start <= $today) && ($end>=$today) ){
                    return $arr_discount;
                }else{
                    return $arr_empty ;
                }

            }else{

                return $arr_empty;
            }
        }
    }


    // Discount details : AUTHOR (Harsh chauhan) 
    public function get_discount_details(Request $request)
    {
        $arr_data = $arr_response = $arr_rules = $arr_resp = [];

        $arr_rules['discount_id']              = "required";
        
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

        $discount_id    = $request->input('discount_id');

        $obj_data       = $this->DiscountModel->with('get_category_details','get_subcategory_details','get_product_details','get_country_details','get_city_details')
                                              ->where('id',$discount_id)
                                              ->first();

        if($obj_data){
            $arr_data = $obj_data->toArray();

            if(sizeof($arr_data)>0){
               
                $arr_resp['id']                   = isset($arr_data['id']) ?  $arr_data['id']: '';
                $arr_resp['category_id']          = isset($arr_data['get_category_details']['id']) ?  $arr_data['get_category_details']['id']: '';
                $arr_resp['category_name']        = isset($arr_data['get_category_details']['category_english_name']) ?  $arr_data['get_category_details']['category_english_name']: '';
                $arr_resp['sub_category_id']      = isset($arr_data['get_subcategory_details']['id']) ?  $arr_data['get_subcategory_details']['id']: '';   
                $arr_resp['sub_category_name']    = isset($arr_data['get_subcategory_details']['english_name']) ?  $arr_data['get_subcategory_details']['english_name']: '';
                $arr_resp['product_id']           = isset($arr_data['get_product_details']['id']) ?  $arr_data['get_product_details']['id']: '';
                $arr_resp['product_name']         = isset($arr_data['get_product_details']['product_english_name']) ?  $arr_data['get_product_details']['product_english_name']: '';
                $arr_resp['country_id']           = isset($arr_data['get_country_details']['id']) ?  $arr_data['get_country_details']['id']: '';
                $arr_resp['country_name']         = isset($arr_data['get_country_details']['country_english_name']) ?  $arr_data['get_country_details']['country_english_name']: '';
                $arr_resp['city_id']              = isset($arr_data['get_city_details']['id']) ?  $arr_data['get_city_details']['id']: '';
                $arr_resp['city_name']            = isset($arr_data['get_city_details']['city_english_name']) ?  $arr_data['get_city_details']['city_english_name']: '';
                $arr_resp['delivery_service']           = isset($arr_data['delivery_service']) ?  $arr_data['delivery_service']: '';
                $arr_resp['first_order_new_customer']   = isset($arr_data['first_order_new_customer']) ?  $arr_data['first_order_new_customer']: '';

                $arr_response_data['data']     = $arr_resp;


                $arr_response['status'] =  'SUCCESS';
                $arr_response['msg']    =  'Discount data displayed successfully.';
                $arr_response['data']   =  $arr_response_data['data'];
                return $arr_response;

            }else{

                $arr_response['status'] =  'ERROR';
                $arr_response['msg']    =  'No data found.';
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

}