<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Common\Services\Authservice;
use App\Common\Services\MailService;
use App\Models\CartModel;
use App\Models\CartOptionsModel;
use App\Models\CartNotesModel;
use App\Models\CartSubOptionsModel;
use App\Models\VatModel;
use JWTAuth;
use Hash;
use Validator;
use Carbon;


class CartController extends Controller
{
    public function __construct()
    {
        $this->MailService        = new MailService();
        $this->CartModel          = new CartModel();
        $this->CartOptionsModel   = new CartOptionsModel();
        $this->CartSubOptionsModel   = new CartSubOptionsModel();
        $this->CartNotesModel     = new CartNotesModel();
        $this->VatModel     = new VatModel();
        $this->auth               = auth()->guard('api_user');
        $this->user               = $this->auth->user();
        $this->product_image_base_img_path   = base_path().config('app.project.img_path.product_images');
        $this->product_image_public_img_path = url('/').config('app.project.img_path.product_images');
		$this->orders_file_base_file_path   = base_path().config('app.project.file_path.orders_file');
        $this->orders_file_public_file_path = url('/').config('app.project.file_path.orders_file');


    }

    //Product Price by selecting options : AUTHOR (Harsh chauhan) 
    public function add_to_cart(Request $request)
    {
        $arr_rule = $arr_cart = $arr_cart_options = $arr_cart_suboptions = $arr_cart_notes = [];

        $arr_rule['customer_id']         = "required";
        $arr_rule['product_id']         = "required";
        $arr_rule['product_options']    = "required";
        $arr_rule['quantity']           = "required";
        $arr_rule['unit_price']         = "required";
        // $arr_rule['agent_id']           = "required";

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

        $product_id              = $request->input('product_id');
        $quantity                = $request->input('quantity');
        $unit_price              = $request->input('unit_price');
        // $agent_id                = $request->input('agent_id');
        $product_options         = json_decode($request->input('product_options'));
        $notes                   = $request->input('notes');
        $weight_time_cost_id     = $request->input('weight_time_cost_id');
        $customer_id             = $request->input('customer_id');
        
        $arr_options_one_temp = $arr_suboptions_one_temp = [];
        foreach ($product_options as $key_temp => $value_temp) {
           
            $arr_options_one_temp[]      = $value_temp->option;
            $arr_suboptions_one_temp[]   = $value_temp->sub_option;
        }
        
        $temp_sort = asort($arr_options_one_temp,1);
        $temp_sort = asort($arr_suboptions_one_temp,1);
        
        $arr_implode_options    = implode(',',$arr_options_one_temp);
        $arr_implode_suboptions = implode(',',$arr_suboptions_one_temp);
        
        $obj_check = $this->CartModel->where('product_id',$product_id)
                                     ->where('customer_id',$customer_id)
                                     ->where('options',$arr_implode_options)
                                     ->where('suboptions',$arr_implode_suboptions)
                                     ->first();
                                     
        if($obj_check){
                    $arr_response['status'] =  'ERROR';
                $arr_response['msg']    =  'Product already added to cart, please update quantity from cart.';
                $arr_response['data']   =  [];
                return $arr_response;

                // Code commented on 17th Sept (Below code updates cart if same product and combinations are added)
            // $old_quantity = isset($obj_check->quantity) ? $obj_check->quantity:0;
            // $new_quantity = $old_quantity + $quantity;
            
            // $obj_update = $this->CartModel->where('id',$obj_check->id)->update(['quantity'=>$new_quantity]);
            
            // if($obj_update){
            //     $arr_response['status'] =  'SUCCESS';
            //     $arr_response['msg']    =  'Product Added to cart successfully.';
            //     $arr_response['data']   =  [];
            //     return $arr_response;
            // }else{
            //     $arr_response['status'] =  'ERROR';
            //     $arr_response['msg']    =  'Something went wrong.';
            //     $arr_response['data']   =  [];
    
            //     return $arr_response;
            // }
        }
    
    // Test logic
    //   if($obj_check){
    //         $arr_cart_suboptions_check_one = $arr_cart_options_check_one =  $arr_cart_suboptions_check_two = $arr_cart_options_check_two =[];
            
    //         $arr_check = $obj_check->toArray();
    //         foreach ($product_options as $key => $value) {

    //             $arr_cart_options_check_one[]  = $value->option;

    //             $arr_cart_suboptions_check_one[]   = $value->sub_option;

    //         }
    //         $total_suboptions = sizeof($arr_check['get_suboptions']);
    //         foreach($arr_check['get_suboptions'] as $key_check => $value_check){
    //             // dd($value_check);
    //             $arr_cart_options_check_two[]      = $value_check['option_id'];
    //             $arr_cart_suboptions_check_two[]   =  $value_check['sub_option_id'];
    //         }
            
    //         if(count(array_intersect($arr_cart_options_check_two, $arr_cart_options_check_one))==$total_suboptions && count(array_intersect($arr_cart_suboptions_check_one, $arr_cart_suboptions_check_two))==$total_suboptions){
    //             dd(1);
    //         }else{
    //             dd(2);
    //         }
    //   }
       
        $arr_cart['customer_id']            = isset($customer_id) ?  $customer_id : '';
        $arr_cart['product_id']             = isset($product_id) ?  $product_id : '';
        $arr_cart['quantity']               = isset($quantity) ?  $quantity : '';
        $arr_cart['unit_price']             = isset($unit_price) ?  $unit_price : '';
        // $arr_cart['agent_id']               = isset($agent_id) ?  $agent_id : '';
        $arr_cart['weight_time_cost_id']    = $request->input('weight_time_cost_id',null);
        
         if($request->hasFile('file'))
        {
            $image          = $request->file('file');
            $file_extension = $image->getClientOriginalExtension();
            $file_old_name  = $image->getClientOriginalName();

            // if(in_array($file_extension,['jpg','jpeg','png']))
            // {
                $file_name = sha1(uniqid().$file_old_name.uniqid()).'.'.$file_extension;
                $isUpload  = $image->move($this->orders_file_base_file_path,$file_name);
                
                if($isUpload)
                {
                    $file_name = $file_name;
                    $arr_cart['file']      = $file_name; 
                }

        }elseif($request->input('file')!=''){
            // dd($request->input('profile_image'));
            $filename_path = md5(time().uniqid()).".png"; 
            $data = explode( ',', $request->input('file') ); //remove base64
            $trim = isset($data[1])?$data[1]:$data[0];
            $decoded=base64_decode($trim); 
            $true = file_put_contents($this->orders_file_base_file_path.$filename_path ,$decoded);
            
          
             if($true)
            {
                $arr_cart['file'] = $filename_path;

            }

        }

        $obj_create_cart = $this->CartModel->create($arr_cart);
        $arr_options_one = $arr_suboptions_one =  [];
        if($obj_create_cart){

            foreach ($product_options as $key => $value) {
                // dd($product_options);
                $arr_cart_options['cart_id']    = $obj_create_cart->id;
                $arr_cart_options['option_id']  = $value->option;
                
                $arr_options_one[]  = $value->option;
                $obj_create_option = $this->CartOptionsModel->create($arr_cart_options);

                $arr_cart_suboptions['cart_id']                        = $obj_create_cart->id;
                $arr_cart_suboptions['cart_product_option_id']         = $obj_create_option->id;
                $arr_cart_suboptions['option_id']       = $value->option;
                $arr_cart_suboptions['sub_option_id']   = $value->sub_option;
        
                $arr_suboptions_one[] = $value->sub_option;
                $obj_create_suboption = $this->CartSubOptionsModel->create($arr_cart_suboptions);

            }
            
            $temp1 = asort($arr_options_one,1);
            $temp2 = asort($arr_suboptions_one,1);
            
            $arr_implode_options = implode(',',$arr_options_one);
            $arr_implode_suboptions = implode(',',$arr_suboptions_one);
            
            $obj_update_cart = $this->CartModel->where('id',$obj_create_cart->id)->update(['options'=>$arr_implode_options,'suboptions'=>$arr_implode_suboptions]);
            if($notes!=''){
                $arr_cart_notes['cart_id']  = $obj_create_cart->id;
                $arr_cart_notes['notes']    = $notes;
                $arr_cart_notes['added_by'] = 'Customer';

                $obj_create_cart_notes = $this->CartNotesModel->create($arr_cart_notes);
            }   

            $arr_response['status'] =  'SUCCESS';
            $arr_response['msg']    =  'Product Added to cart successfully.';
            $arr_response['data']   =  [];
            return $arr_response;

        }else{

            $arr_response['status'] =  'ERROR';
            $arr_response['msg']    =  'Something went wrong.';
            $arr_response['data']   =  [];

            return $arr_response;
        }
    }

     //my orders listing api  : AUTHOR (Harsh Chauhan)
    public function get_cart_listing(Request $request)
    {
        $arr_rule   = $arr_cart = $arr_resp = $arr_cart_details = [];

        $customer_id = $request->input('customer_id');

        $obj_cart    = $this->CartModel->where('customer_id',$customer_id)
                                        ->with(['get_product_detail'=>function($q){
                                       	    $q->with('get_product_images');
                                       	    $q->with('get_fixed_quantity','get_variable_quantity','get_product_images');
                                        }])
                                        ->with(['get_cartoptions'=>function($q){
                                            $q->with('get_option_details');
                                            $q->with(['get_suboptions'=>function($q1){
                                                $q1->with('get_suboption_details');
                                            }]);
                                        }])
                                        ->get();
        if($obj_cart && sizeof($obj_cart->toArray())>0)
        {
            $arr_cart = $obj_cart->toArray();
            // dd($arr_cart);
            $obj_vat = $this->VatModel->where('id','1')->first();
             $sum = $key =$total_vat=0;
            foreach ($arr_cart as $key => $value) 
            {
                $arr_cart_details[$key]['sr_no']                = $key+1;
                $arr_cart_details[$key]['cart_id']              = isset($value['id']) ?  $value['id']: 0;
                $arr_cart_details[$key]['combination_id']       = isset($value['weight_time_cost_id']) ?  $value['weight_time_cost_id']: 0;
                $arr_cart_details[$key]['quantity']             = isset($value['quantity']) ?  $value['quantity']: 0;
                $arr_cart_details[$key]['unit_price']           = isset($value['unit_price']) ?  $value['unit_price']: 0;
                $total_product_price = (isset($value['unit_price']) ?  $value['unit_price']: 0)*(isset($value['quantity']) ?  $value['quantity']: 0);
                $arr_cart_details[$key]['total_product_price']           = $total_product_price;
                $arr_cart_details[$key]['product_id']           = isset($value['get_product_detail']['id']) ?  $value['get_product_detail']['id']: '';
                $arr_cart_details[$key]['product_english_name'] = isset($value['get_product_detail']['product_english_name']) ?  $value['get_product_detail']['product_english_name']: '';
               
                
                // dd($total_vat);
                foreach ($value['get_cartoptions'] as $key_option => $value_option) {
                    // dd($value_option);
                    $arr_cart_details[$key]['options'][$key_option]['product_options_id']          = isset($value_option['id']) ?  $value_option['id']: '';
                    $arr_cart_details[$key]['options'][$key_option]['product_option_english_name'] = isset($value_option['get_option_details']['english_name']) ?  $value_option['get_option_details']['english_name']: '';
                    $arr_cart_details[$key]['options'][$key_option]['product_suboptions_id']       = isset($value_option['get_suboptions']['id']) ?  $value_option['get_suboptions']['id']: '';
                    $arr_cart_details[$key]['options'][$key_option]['product_suboption_english_name'] = isset($value_option['get_suboptions']['get_suboption_details']['english_name']) ?  $value_option['get_suboptions']['get_suboption_details']['english_name']: '';
                    
                }
                
                foreach ($value['get_product_detail']['get_product_images'] as $key_product_images => $value_product_iamges) {
                	if(isset($value['get_product_detail']['get_product_images'][0]['image']) && $value['get_product_detail']['get_product_images'][0]['image']!=null)
                    {
                        $profile_img = $this->product_image_public_img_path.$value['get_product_detail']['get_product_images'][0]['image'];
                    }
                    else
                    {
                        $profile_img = $this->product_image_public_img_path.'default.jpg';
                    }

                    $arr_cart_details[$key]['image']          = isset($profile_img) ?  $profile_img: '';
                }
	                
	            $arr_cart_details[$key]['quantity_type'] = isset($value['get_product_detail']['quantity_type']) ?  $value['get_product_detail']['quantity_type']: ''; 
                if($value['get_product_detail']['quantity_type']=='fixed'){
                    foreach ($value['get_product_detail']['get_fixed_quantity'] as $key_fixed_quantity => $value_fixed_quantity) {
                        $arr_cart_details[$key]['fixed_quantity'][$key_fixed_quantity]['fixedquantity_id']  = isset($value_fixed_quantity['id'])?$value_fixed_quantity['id']:'';
                        $arr_cart_details[$key]['fixed_quantity'][$key_fixed_quantity]['quantity']          = isset($value_fixed_quantity['fixed_quantity'])?$value_fixed_quantity['fixed_quantity']:'';
                    }
                    $arr_cart_details[$key]['variable_quantity']  = [];
    
                }elseif($value['get_product_detail']['quantity_type']=='variable'){  
                    foreach ($value['get_product_detail']['get_variable_quantity'] as $key_variable_quantity => $value_variable_quantity) {
                        $arr_cart_details[$key]['variable_quantity'][$key_variable_quantity]['variablequantity_id'] = isset($value_variable_quantity['id'])?$value_variable_quantity['id']:'';
                        $arr_cart_details[$key]['variable_quantity'][$key_variable_quantity]['minimum_quantity'] = isset($value_variable_quantity['minimum_quantity'])?$value_variable_quantity['minimum_quantity']:'';
                        $arr_cart_details[$key]['variable_quantity'][$key_variable_quantity]['maximum_quantity'] = isset($value_variable_quantity['maximum_quantity'])?$value_variable_quantity['maximum_quantity']:'';
                        $arr_cart_details[$key]['variable_quantity'][$key_variable_quantity]['discount'] = isset($value_variable_quantity['discount'])?$value_variable_quantity['discount']:'';
                    }
                    $arr_cart_details[$key]['fixed_quantity']  = [];
                }
                $key = $key+1;

                $sum = $sum+ (float) (isset($value['unit_price']) ?  $value['unit_price']: 0)*(isset($value['quantity']) ?  $value['quantity']: 0);
               
                $total_vat = $total_vat +  ($total_product_price *((isset($obj_vat->vat)?$obj_vat->vat:0)/100));
            }
            	ini_set('serialize_precision', -1);      

            // $arr_resp['arr_cart_details']= $arr_cart_details;
            $arr_response_data['data']     = $arr_cart_details;


            $arr_response['status']          =  'SUCCESS';
            $arr_response['msg']             =  'Cart listing displayed successfully.';
            $arr_response['data']            =  $arr_response_data['data'];
            $arr_response['total_price']     = $sum;
            $arr_response['total_vat']     = $total_vat;
            $arr_response['total_products']  = $key;
            $arr_response['total_product_price']     = $sum -$total_vat;

            return $arr_response;
        }
        else
        {
            $arr_response['status'] =  'ERROR';
            $arr_response['msg']    =  'No Products Found.';
            $arr_response['data']   =  [];
            return $arr_response;
        }
        $arr_response['status'] =  'ERROR';
        $arr_response['msg']    =  'Oops! Something went wrong.';
        $arr_response['data']   =  [];

        return $arr_response;
        
    }

        // Delete an item from the cart : AUTHOR (Harsh Chauhan)
    public function delete_cart_item(Request $request)
    {
         $arr_rule['cart_id']         = "required";

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

        $cart_id = $request->input('cart_id');

        $obj_delete = $this->CartModel->where('id',$cart_id)->delete();

        if($obj_delete){
            $obj_delele_options     = $this->CartOptionsModel->where('cart_id',$cart_id)->delete();
            $obj_delele_suboptions  = $this->CartSubOptionsModel->where('cart_id',$cart_id)->delete();
            $obj_delele_notes       = $this->CartNotesModel->where('cart_id',$cart_id)->delete();

            $arr_response['status'] =  'SUCCESS';
            $arr_response['msg']    =  'Cart item deleted successfully.';
            $arr_response['data']   =  [];
            return $arr_response;

        }else{
            $arr_response['status'] =  'ERROR';
            $arr_response['msg']    =  'Something went wrong.';
            $arr_response['data']   =  [];
            return $arr_response;            
        }
    }
    
     // Update an item from the cart : AUTHOR (Harsh Chauhan)
    public function update_cart_quantity(Request $request)
    {
         $arr_rule['cart_id']         = "required";
         $arr_rule['quantity']         = "required";

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

        $cart_id = $request->input('cart_id');
        $quantity = $request->input('quantity');

        $obj_update = $this->CartModel->where('id',$cart_id)->update(['quantity'=>$quantity]);

        if($obj_update){

            $arr_response['status'] =  'SUCCESS';
            $arr_response['msg']    =  'Cart item updated successfully.';
            $arr_response['data']   =  [];
            return $arr_response;

        }else{
            $arr_response['status'] =  'ERROR';
            $arr_response['msg']    =  'Something went wrong.';
            $arr_response['data']   =  [];
            return $arr_response;            
        }
    }

}