<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Common\Services\Authservice;
use App\Common\Services\MailService;
use App\Models\SiteSettingModel;
use App\Models\SystemCountryModel;
use App\Models\SystemCityModel;
use App\Models\EvaluationModel;
use App\Models\AgentModel;
use App\Models\CustomerModel;
use App\Models\CustomerAddressModel;
use App\Models\ProductWeightTimeCostModel;
use App\Models\PromoCodesModel;
use App\Models\OrdersModel;
use App\Models\CartModel;
use App\Models\PrintingOrderDetailsModel;
use App\Models\PrintingOrderExtraNotesModel;
use App\Models\OrderFinanceDetailsModel;
use App\Models\PrintingOrderStatusHistoryModel;
use App\Models\PrintingOrderCompensationModel;
use App\Models\PrintingOrderDetailsOptionModel;
use App\Models\PrintingOrderDetailsSubOptionModel;
use App\Models\VatModel;
use App\Models\CartOptionsModel;
use App\Models\CartNotesModel;
use App\Models\CartSubOptionsModel;
use JWTAuth;
use Hash;
use Validator;
use Carbon;

class OrderManagementController extends Controller
{
    public function __construct()
    {
        $this->MailService                            = new MailService();
        $this->SiteSettingModel                       = new SiteSettingModel();
        $this->SystemCountryModel                     = new SystemCountryModel();
        $this->SystemCityModel                        = new SystemCityModel();
        $this->AgentModel                             = new AgentModel();
        $this->CustomerAddressModel                   = new CustomerAddressModel();
        $this->ProductWeightTimeCostModel             = new ProductWeightTimeCostModel();
        $this->PromoCodesModel                        = new PromoCodesModel();
        $this->OrdersModel                            = new OrdersModel();
        $this->CartModel                              = new CartModel();
        $this->CustomerModel                          = new CustomerModel();
        $this->PrintingOrderDetailsModel              = new PrintingOrderDetailsModel();
        $this->PrintingOrderExtraNotesModel           = new PrintingOrderExtraNotesModel();
        $this->OrderFinanceDetailsModel               = new OrderFinanceDetailsModel();
        $this->PrintingOrderStatusHistoryModel        = new PrintingOrderStatusHistoryModel();
        $this->PrintingOrderCompensationModel         = new PrintingOrderCompensationModel();
        $this->PrintingOrderDetailsOptionModel        = new PrintingOrderDetailsOptionModel();
        $this->PrintingOrderDetailsSubOptionModel     = new PrintingOrderDetailsSubOptionModel();
        $this->VatModel                               = new VatModel();
        $this->CartOptionsModel                       = new CartOptionsModel();
        $this->CartSubOptionsModel                    = new CartSubOptionsModel();
        $this->CartNotesModel                         = new CartNotesModel();
        $this->auth                                   = auth()->guard('api_user');
        $this->user                                   = $this->auth->user();

    }

    //Get Promo codes listing : AUTHOR (Harsh chauhan) 

    public function promocode_listing(Request $request)
    {
        
        $arr_data = $arr_resp = []; $total_weight = $total_quantity = 1;

        
        $today_date                 = Carbon\Carbon::now('Asia/Kolkata')->format('Y-m-d');
        $today_time                 = Carbon\Carbon::now('Asia/Kolkata')->format('H:i:s');
        
        $obj_data     = $this->PromoCodesModel->where('start_date','<=',$today_date)
                                              ->where('end_date','>=',$today_date)
                                              ->get();

        if($obj_data && sizeof($obj_data->toArray())>0)
        {
            $arr_data = $obj_data->toArray();

            foreach ($arr_data as $key => $value) 
            {
                $arr_resp[$key]['sr_no']                = $key+1;
                $arr_resp[$key]['id']                   = isset($value['id']) ?  $value['id']: 0;
                $arr_resp[$key]['promo_code']       = isset($value['code']) ?  $value['code']: 0;
                $arr_resp[$key]['percentage']             = isset($value['percentage']) ?  $value['percentage']: 0;
                $arr_resp[$key]['total_spend_in_code']           = isset($value['total_spend_in_code']) ?  $value['total_spend_in_code']: 0;
                $arr_resp[$key]['flag_total_spend_in_code']           = isset($value['flag_total_spend_in_code']) ?  $value['flag_total_spend_in_code']: '';
                $arr_resp[$key]['min_cart_value'] = isset($value['min_cart_value']) ?  $value['min_cart_value']: '';
                $arr_resp[$key]['flag_min_cart_value'] = isset($value['flag_min_cart_value']) ?  $value['flag_min_cart_value']: '';
                $arr_resp[$key]['max_cart_value'] = isset($value['max_cart_value']) ?  $value['max_cart_value']: '';
                $arr_resp[$key]['flag_max_cart_value'] = isset($value['flag_max_cart_value']) ?  $value['flag_max_cart_value']: '';
                $arr_resp[$key]['max_used_times'] = isset($value['max_used_times']) ?  $value['max_used_times']: '';
                $arr_resp[$key]['flag_max_used_times'] = isset($value['flag_max_used_times']) ?  $value['flag_max_used_times']: '';
                $arr_resp[$key]['cashback_percentage'] = isset($value['cashback_percentage']) ?  $value['cashback_percentage']: '';
                $arr_resp[$key]['flag_cashback_percentage'] = isset($value['flag_cashback_percentage']) ?  $value['flag_cashback_percentage']: '';
                $arr_resp[$key]['cashback_validity'] = isset($value['cashback_validity']) ?  $value['cashback_validity']: '';
                $arr_resp[$key]['flag_cashback_validity'] = isset($value['flag_cashback_validity']) ?  $value['flag_cashback_validity']: '';
                $arr_resp[$key]['system_country_id'] = isset($value['system_country_id']) ?  $value['system_country_id']: '';
                $arr_resp[$key]['flag_system_country_id'] = isset($value['flag_system_country_id']) ?  $value['flag_system_country_id']: '';
                $arr_resp[$key]['limit_code_new_customer'] = isset($value['limit_code_new_customer']) ?  $value['limit_code_new_customer']: '';
                $arr_resp[$key]['limit_code_for_one_time_use'] = isset($value['limit_code_for_one_time_use']) ?  $value['limit_code_for_one_time_use']: '';
                $arr_resp[$key]['free_delivery'] = isset($value['free_delivery']) ?  $value['free_delivery']: '';
                $arr_resp[$key]['exclude_discounted_products'] = isset($value['exclude_discounted_products']) ?  $value['exclude_discounted_products']: '';
            }
            

            $arr_response['status'] =  'SUCCESS';
            $arr_response['msg']    =  'Promo Codes displayed successfully.';
            $arr_response['data']   =  $arr_resp;
            return $arr_response;
        }else{
            $arr_response['status'] =  'ERROR';
            $arr_response['msg']    =  'No Promo codes found.';
            $arr_response['data']   =  [];
             return $arr_response;

        }   
    }


    public function validate_promocode(Request $request)
    {
        //dd($request->all());
        $arr_data = $arr_resp = []; $total_weight = $total_quantity = 1;

        
        $today_date                 = Carbon\Carbon::now('Asia/Kolkata')->format('Y-m-d');
        $today_time                 = Carbon\Carbon::now('Asia/Kolkata')->format('H:i:s');

        $promocode = $request->input('promocode');
        $total_cart_amount = $request->input('total_cart_amount');
        dd($promocode);
        $obj_data     = $this->PromoCodesModel->where('code',$promocode)
                                                ->where('start_date','<=',$today_date)
                                              ->where('end_date','>=',$today_date)
                                              ->first();

        if($obj_data && sizeof($obj_data->toArray())>0)
        {
            $arr_data = $obj_data->toArray();

            $arr_resp['id']                             = isset($arr_data['id']) ?  $arr_data['id']: 0;
            $arr_resp['promo_code']                     = isset($arr_data['code']) ?  $arr_data['code']: 0;
            $arr_resp['percentage']                     = isset($arr_data['percentage']) ?  $arr_data['percentage']: 0;
            $arr_resp['total_spend_in_code']            = isset($arr_data['total_spend_in_code']) ?  $arr_data['total_spend_in_code']: 0;
            $arr_resp['flag_total_spend_in_code']       = isset($arr_data['flag_total_spend_in_code']) ?  $arr_data['flag_total_spend_in_code']: '';
            $arr_resp['cashback_percentage']            = isset($arr_data['cashback_percentage']) ?  $arr_data['cashback_percentage']: '';
            $arr_resp['flag_cashback_percentage']       = isset($arr_data['flag_cashback_percentage']) ?  $arr_data['flag_cashback_percentage']: '';
            $arr_resp['cashback_validity']              = isset($arr_data['cashback_validity']) ?  $arr_data['cashback_validity']: '';
            $arr_resp['flag_cashback_validity']         = isset($arr_data['flag_cashback_validity']) ?  $arr_data['flag_cashback_validity']: '';


            // Code for minimum cart value
            $arr_resp['min_cart_value']                 = isset($arr_data['min_cart_value']) ?  $arr_data['min_cart_value']: '';
            $arr_resp['flag_min_cart_value']            = isset($arr_data['flag_min_cart_value']) ?  $arr_data['flag_min_cart_value']: '';

            if($arr_data['flag_min_cart_value']=='yes' && $total_cart_amount<$arr_data['min_cart_value']){
                $arr_response['status'] =  'ERROR';
                $arr_response['msg']    =  'Invalid Promocode.';
                $arr_response['data']   =  [];
                 return $arr_response;
            }

             // Code for maximum cart value
            $arr_resp['max_cart_value']                 = isset($arr_data['max_cart_value']) ?  $arr_data['max_cart_value']: '';
            $arr_resp['flag_max_cart_value']            = isset($arr_data['flag_max_cart_value']) ?  $arr_data['flag_max_cart_value']: '';

             if($arr_data['flag_max_cart_value']=='yes' && $total_cart_amount>$arr_data['max_cart_value']){
                $arr_response['status'] =  'ERROR';
                $arr_response['msg']    =  'Invalid Promocode.';
                $arr_response['data']   =  [];
                 return $arr_response;
            }
            
            // code for max_used_times
            $arr_resp['max_used_times']                 = isset($arr_data['max_used_times']) ?  $arr_data['max_used_times']: '';
            $arr_resp['flag_max_used_times']            = isset($arr_data['flag_max_used_times']) ?  $arr_data['flag_max_used_times']: '';
             if($arr_data['flag_max_used_times']=='yes'){
                
                $obj_check_flag_max_used_times = $this->OrdersModel->where('promocode_id',$arr_data['id'])->count();
                if($obj_check_flag_max_used_times>=$arr_data['max_used_times']){
                    $arr_response['status'] =  'ERROR';
                    $arr_response['msg']    =  'Invalid Promocode.';
                    $arr_response['data']   =  [];
                    return $arr_response; 
                }
                
            }

             // Code for system_country_id
            $arr_resp['system_country_id']              = isset($arr_data['system_country_id']) ?  $arr_data['system_country_id']: '';
            $arr_resp['flag_system_country_id']         = isset($arr_data['flag_system_country_id']) ?  $arr_data['flag_system_country_id']: '';

            if($arr_data['flag_system_country_id']=='yes' && $this->user->country_id!=$arr_data['system_country_id']){
                $arr_response['status'] =  'ERROR';
                $arr_response['msg']    =  'Invalid Promocode.';
                $arr_response['data']   =  [];
                return $arr_response;     
            }

             // Code for limit_code_new_customer
            $arr_resp['limit_code_new_customer']        = isset($arr_data['limit_code_new_customer']) ?  $arr_data['limit_code_new_customer']: '';
            if($arr_data['limit_code_new_customer']=='yes'){

                $obj_check_limit_code_new_customer = $this->OrdersModel->where('customer_id',$this->user->id)->first();

                if($obj_check_limit_code_new_customer){
                    $arr_response['status'] =  'ERROR';
                    $arr_response['msg']    =  'Invalid Promocode.';
                    $arr_response['data']   =  [];
                    return $arr_response; 
                }
                
            }
            
             // Code for limit_code_for_one_time_use
            $arr_resp['limit_code_for_one_time_use']    = isset($arr_data['limit_code_for_one_time_use']) ?  $arr_data['limit_code_for_one_time_use']: '';

             if($arr_data['limit_code_for_one_time_use']=='yes'){

                $obj_check_limit_code_for_one_time_use = $this->OrdersModel->where('customer_id',$this->user->id)->where('promocode_id',$arr_data['id'])->first();

                if($obj_check_limit_code_for_one_time_use){
                    $arr_response['status'] =  'ERROR';
                    $arr_response['msg']    =  'Invalid Promocode.';
                    $arr_response['data']   =  [];
                    return $arr_response; 
                }
                
            }

            $arr_resp['free_delivery']                  = isset($arr_data['free_delivery']) ?  $arr_data['free_delivery']: '';
            $arr_resp['exclude_discounted_products']    = isset($arr_data['exclude_discounted_products']) ?  $arr_data['exclude_discounted_products']: '';
      
            $discount_amount = $total_cart_amount * (((isset($arr_resp['percentage'])?$arr_resp['percentage']:0)/100));
            $after_discount  = $total_cart_amount  -  $discount_amount;

            $arr_response['status'] =  'SUCCESS';
            $arr_response['msg']    =  'Promocode is Valid.';
            $arr_response['data']   =  $arr_resp;
            $arr_response['before_discount']   = $total_cart_amount;
            $arr_response['discount_amount']   =  $discount_amount;
            $arr_response['final_amount']   =  $after_discount;

            return $arr_response;
        }else{
            $arr_response['status'] =  'ERROR';
            $arr_response['msg']    =  'Invalid Promocode.';
            $arr_response['data']   =  [];
             return $arr_response;

        }   
    }

// Demo 1
//   public function payment_request(Request $request)
//     {
        
//         $arr_data = $arr_resp =$arr_cart= $arr_order= $arr_order_details = $arr_order_sub_options = $arr_order_options = $arr_order_status_history = $arr_order_finance =[]; 
//         $total_weight = $total_quantity = 1;    
//         $total_vat = 0;
//         $arr_rule = $arr_cart = $arr_cart_options = $arr_cart_suboptions = $arr_cart_notes = [];

//         // $arr_rule['address_id']         = "required";

//         $validator = Validator::make($request->all(), $arr_rule);
        
//         if($validator->fails())
//         {
//             $arr_responce['status'] = 'ERROR';
//             $arr_responce['msg']    = 'Please fill all the required field.';
//             $arr_responce['data']   = [];

//             if($validator->errors())
//             {
//                 $arr_responce['msg'] =$validator->errors()->first();
//             }
            
//             return $arr_responce;
//         }

//         $customer_id = $this->user->id;
//         $card_number = $request->input('card_number');
//         $exp_month = $request->input('exp_month');
//         $exp_year = $request->input('exp_year');
//         $cvc = $request->input('cvc');
//         $name = $request->input('name');
        
//         Start::setApiKey($sadad_detail["open_key"]); //Important

//          $token = Start_Token::create(array(
//                  "number" => $card_number,
//                  "exp_month" => $exp_month,
//                  "exp_year" => $exp_year,
//                  "cvc" => $cvc,
//                  "name" => $name
//              ));
//              //echo "<pre>"; print_r($token); echo '</pre>';
        
//         // Start::setApiKey($sadad_detail["secret_key"]); //Important
//         Start::setApiKey('bjzBvKIiacThPkL4bMSB'); //Important
        
//         // $currency = getCustomConfigItem('currency_code');
//         $currency = getCustomConfigItem('SAR');
        
//          $charge = Start_Charge::create(array(
//           "amount"      => (int)200,  
//           "currency"    => $currency,
//           "card"        => $token['id'],
//           "email"       => 'test@gmail.com',
//           "ip"          => $_SERVER["REMOTE_ADDR"],
//           "description" => "Charge Description"
//         ));
//         dd($charge);
//         $address_id = $request->input('address_id',null);

//         $promocode_id = $request->input('promocode_id',null);
        
//         $response = json_decode($request->input('response'));

//         $obj_cart   = $this->CartModel->where('customer_id',$customer_id)
//                                       ->with(['get_product_detail'=>function($q){
//                                             $q->with('get_product_images');
//                                             $q->with('get_fixed_quantity','get_variable_quantity','get_product_images');
//                                       }])
//                                       ->with(['get_cartoptions'=>function($q){
//                                             $q->with('get_option_details');
//                                             $q->with(['get_suboptions'=>function($q1){
//                                                 $q1->with('get_suboption_details');
//                                             }]);
//                                      }])
//                                       ->with('get_extra_notes')
//                                      ->get();
                                     
//         if($obj_cart){

//             $arr_response['status'] = 'SUCCESS';
//             $arr_response['msg']    = "Order placed successfully.";
//             $arr_response['data']   = [];
//             return $arr_response;
//         }else{
//             $arr_response['status'] = 'ERROR';
//             $arr_response['msg']    = 'Something Went wrong.';
//             $arr_response['data']   = [];
//             return $arr_response;
//         }
//     }
  
//   Demo 2  // 
    //   public function payment_request(Request $request)
    // {
        
    //     $arr_data = $arr_resp =$arr_cart= $arr_order= $arr_order_details = $arr_order_sub_options = $arr_order_options = $arr_order_status_history = $arr_order_finance =[]; 
    //     $total_weight = $total_quantity = 1;    
    //     $total_vat = 0;
    //     $arr_rule = $arr_cart = $arr_cart_options = $arr_cart_suboptions = $arr_cart_notes = [];

    //     // $arr_rule['address_id']         = "required";

    //     $validator = Validator::make($request->all(), $arr_rule);
        
    //     if($validator->fails())
    //     {
    //         $arr_responce['status'] = 'ERROR';
    //         $arr_responce['msg']    = 'Please fill all the required field.';
    //         $arr_responce['data']   = [];

    //         if($validator->errors())
    //         {
    //             $arr_responce['msg'] =$validator->errors()->first();
    //         }
            
    //         return $arr_responce;
    //     }

    //     $customer_id = $this->user->id;
    //     $card_number = $request->input('card_number');
    //     $exp_month = $request->input('exp_month');
    //     $exp_year = $request->input('exp_year');
    //     $cvc = $request->input('cvc');
    //     $name = $request->input('name');
        
    //     $url = 'https://sbpaymentservices.payfort.com/FortAPI/paymentApi';

    //         $arrData = array(
    //         'command' => 'CAPTURE',
    //         'access_code' => 'zx0IPmPy5jp1vAz8Kpg7',
    //         'merchant_identifier' => 'CycHZxVj',
    //         'merchant_reference' => 'XYZ9239-yu898',
    //         'amount' => '10000',
    //         'currency' => 'AED',
    //         'language' => 'en',
    //         'fort_id' => '149295435400084008',
    //         'signature' => '7cad05f0212ed933c9a5d5dffa31661acf2c827a',
    //         'order_description' => 'iPhone 6-S',
    //         );
            
            
    //         $ch = curl_init( $url );
    //         # Setup request to send json via POST.
    //         $data = json_encode($arrData);
    //         curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
    //         curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    //         # Return response instead of printing.
    //         curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    //         # Send request.
    //         $result = curl_exec($ch);
    //         dd($result);
    //         curl_close($ch);
    //         # Print response.
    //         echo "<pre>$result</pre>";
                                     
    //     if($obj_cart){

    //         $arr_response['status'] = 'SUCCESS';
    //         $arr_response['msg']    = "Order placed successfully.";
    //         $arr_response['data']   = [];
    //         return $arr_response;
    //     }else{
    //         $arr_response['status'] = 'ERROR';
    //         $arr_response['msg']    = 'Something Went wrong.';
    //         $arr_response['data']   = [];
    //         return $arr_response;
    //     }
    // }
    public function payment_request(Request $request){
        $url = "https://sbpaymentservices.payfort.com/FortAPI/paymentApi";
 
        $shaString  = '';
        // array request
        $arrData    = array(
        'command'            =>'AUTHORIZATION',
        'access_code'        =>'bjzBvKIiacThPkL4bMSB',
        'merchant_identifier'=>'0b62e9c1',
        'merchant_reference' =>'XYZ9239-123',
        'amount'             =>'10000',
        'currency'           =>'SAR',
        'language'           =>'en',
        'customer_email'     =>'test@payfort.com',
        'order_description'  =>'iPhone 6-S',
        'cardNumber'  =>'4005550000000001',
        'expiry_date'  =>'0521',
        );
        // sort an array by key
        ksort($arrData);
        foreach ($arrData as $key => $value) {
            $shaString .= "$key=$value";
        }
        $SHARequestPhrase   = '$2y$10$yQAy8my9b';
        // make sure to fill your sha request pass phrase
        $shaString = $SHARequestPhrase . $shaString . $SHARequestPhrase;
        $signature = hash("sha256", $shaString);
        // your request signature
        $arrData['signature'] = $signature;
        // your request signature
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $arrData);
            $response = curl_exec($ch);
            curl_close($ch);
            dd($response);
    }
    
    public function payment_request1(Request $request)
    {
        $arr_data = $arr_resp =$arr_cart= $arr_order= $arr_order_details = $arr_order_sub_options = $arr_order_options = $arr_order_status_history = $arr_order_finance =[]; 
        $total_weight = $total_quantity = 1;    
        $total_vat = 0;
        $arr_rule = $arr_cart = $arr_cart_options = $arr_cart_suboptions = $arr_cart_notes = [];

        // $arr_rule['address_id']         = "required";

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

        // $customer_id = $this->user->id;
        $card_number = $request->input('card_number');
        $exp_month = $request->input('exp_month');
        $exp_year = $request->input('exp_year');
        $cvc = $request->input('cvc');
        $name = $request->input('name');


            // error_reporting(E_ALL);
            // ini_set('display_errors', '1');

            // $url = 'https://sbpaymentservices.payfort.com/FortAPI/paymentApi';
            // $arrData = array(
            // 'command' => 'AUTHORIZATION',
            // 'access_code' => 'bjzBvKIiacThPkL4bMSB',
            // 'merchant_identifier' => '0b62e9c1',
            // 'merchant_reference' => 'XYZ9239-123',
            // 'language' => 'en',
            // 'amount' => '10000',
            // 'currency' => 'USD',
            // 'customer_email'=> 'test@mailinator.com',
            // //'customer_ip' =>'192.178.1.10',
            // //'signature' => $signature2,
            // // 'expiry_date' => '2105',
            // // 'card_number' => '4005550000000001',
            // // 'card_security_code' => '123',
            //  'token_name'=> 'Op9Vmp',
            // //'payment_option' =>'VISA',
            // 'card_holder_name' => 'test',
            // //'signature' => '7cad05f0212ed933c9a5d5dffa31661acf2c827a',
            // );
            //     $shaString = '';
            //     $signType = 'request';
            //     ksort($arrData);
            //     $SHARequestPhrase   = '$2y$10$yQAy8my9b';
            //     $SHAResponsePhrase   = '$2y$10$RIAE0V92s';
            //     $SHAType       = 'sha256';
            //     foreach ($arrData as $k => $v) {
            //         $shaString .= "$k=$v";
            //     }

            //     if ($signType == 'request') 
            //         $shaString = $SHARequestPhrase . $shaString . $SHARequestPhrase;
            //     else 
            //         $shaString = $SHAResponsePhrase . $shaString . $SHAResponsePhrase;

            //     $signature = hash($SHAType, $shaString);

            //     $arrData['signature'] = hash($SHAType, $shaString);
            // $ch = curl_init( $url );
            // # Setup request to send json via POST.
            // $data = json_encode($arrData);
            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            // curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
            // curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            // # Return response instead of printing.
            // curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            // # Send request.
            // $result = curl_exec($ch);
            // dd($result);
            // curl_close($ch);
            // # Print response.
            // echo "<pre>$result</pre>";exit;

    
    $url = 'https://sbcheckout.PayFort.com/FortAPI/paymentPage';
    $temp = '$2y$10$yQAy8my9bsaccess_code=bjzBvKIiacThPkL4bMSBlanguage=enmerchant_identifier=0b62e9c1merchant_reference=XYZ9239-123service_command=TOKENIZATION$2y$10$yQAy8my9b';
       
        $signature =  hash("sha256", $temp);
         error_reporting(E_ALL);
         ini_set('display_errors', '1');     
        $arrData = array(
           // 'service_command' => 'CREATE_TOKEN',
            'service_command' => 'TOKENIZATION',
            'language' => 'en',
            'merchant_identifier' => '0b62e9c1',
            'access_code' => 'bjzBvKIiacThPkL4bMSB',
            'merchant_reference' => 'XYZ9239-123',
            'card_security_code' => '123',
            'card_number' => '4005550000000001',
            'expiry_date' => '2105',
            'remember_me' => 'YES',
            'card_holder_name' => 'john smith',
            'signature' => $signature,
            
            //'token_name' =>'COp9Vmp',
          // 'return_url' => 'http://localhost/print_plus/api/order/test',
        );


                // $shaString = '';
                // $signType = 'request';
                // ksort($arrData);
                // $SHARequestPhrase   = '$2y$10$yQAy8my9b';
                // $SHAResponsePhrase   = '$2y$10$RIAE0V92s';
                // $SHAType       = 'sha256';
                // foreach ($arrData as $k => $v) {
                //     $shaString .= "$k=$v";
                // }

                // if ($signType == 'request') 
                //     $shaString = $SHARequestPhrase . $shaString . $SHARequestPhrase;
                // else 
                //     $shaString = $SHAResponsePhrase . $shaString . $SHAResponsePhrase;

                // $signature = hash($SHAType, $shaString);

                // $arrData['signature'] = hash($SHAType, $shaString);
            $ch = curl_init( $url );
            
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            # Setup request to send json via POST.
            $data = $arrData;

           // $data = json_encode($arrData);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
            //curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/x-www-form-urlencoded'));
            # Return response instead of printing.
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
           
            # Send request.
            $result = curl_exec($ch);
            dd($result);
            if(curl_errno($ch)){  //Catch error
               dd(curl_error($ch));echo 'Request Error:' . curl_error($ch);
                dd('error');
            }
             dd($result);
           
            curl_close($ch);

        # Print response.
           
        $url2 = 'https://sbpaymentservices.payfort.com/FortAPI/paymentApi';
        //  $temp2 = '$2y$10$yQAy8my9bsaccess_code=bjzBvKIiacThPkL4bMSBamount=10000command=PURCHASEcurrency=SARcustomer_email=test@mailinator.comlanguage=enmerchant_identifier=0b62e9c1merchant_reference=XYZ9239-123$2y$10$yQAy8my9b';         
        //  $signature2 =  hash("sha256", $temp2);    
         
        $arrData2 = array(
            'command' => 'PURCHASE',
            'access_code' => 'bjzBvKIiacThPkL4bMSB',
            'language' => 'en',
            'merchant_identifier' => '0b62e9c1',
            'merchant_reference' => 'XYZ9239-123',
            'amount' => '10000',
            'currency' => 'SAR',
            'customer_email'=> 'test@mailinator.com',
            'customer_ip' =>'192.178.1.10',
            //'signature' => $signature2,
            'expiry_date' => '2105',
            'card_number' => '4005550000000001',
            'card_security_code' => '123',
            'token_name'=> $result,
            //'payment_option' =>'VISA',
            'card_holder_name' => 'test',
        );

                $shaString2 = '';
                $signType2 = 'request';
                ksort($arrData2);
                $SHARequestPhrase2   = '$2y$10$yQAy8my9b';
                $SHAResponsePhrase2   = '$2y$10$RIAE0V92s';
                $SHAType2       = 'sha256';
                foreach ($arrData2 as $k => $v) {
                    $shaString2 .= "$k=$v";
                }

                if ($signType2 == 'request') 
                    $shaString2 = $SHARequestPhrase2 . $shaString2 . $SHARequestPhrase2;
                else 
                    $shaString2 = $SHAResponsePhrase2 . $shaString2 . $SHAResponsePhrase2;

                $signature2 = hash($SHAType2, $shaString2);

                $arrData2['signature'] = hash($SHAType2, $shaString2);

        $ch2 = curl_init( $url2 );
        # Setup request to send json via POST.
        $data2 = json_encode($arrData2);
        
        // $data2 = $arrData2;
        curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, 0);        
        curl_setopt( $ch2, CURLOPT_POSTFIELDS, $data2 );
        curl_setopt( $ch2, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        // curl_setopt( $ch2, CURLOPT_HTTPHEADER, array('Content-Type:application/x-www-form-urlencoded'));
        # Return response instead of printing.
        curl_setopt( $ch2, CURLOPT_RETURNTRANSFER, true );
        # Send request.
        $result2 = curl_exec($ch2);
       
        curl_close($ch2);
        # Print response.
        echo "<pre>$result2</pre>";
      
      dd($result2);
        
      
        // if($obj_cart){

        //     $arr_response['status'] = 'SUCCESS';
        //     $arr_response['msg']    = "Order placed successfully.";
        //     $arr_response['data']   = [];
        //     return $arr_response;
        // }else{
        //     $arr_response['status'] = 'ERROR';
        //     $arr_response['msg']    = 'Something Went wrong.';
        //     $arr_response['data']   = [];
        //     return $arr_response;
        // }
    }

    public function payment_response(Request $request)
    {
        
        $arr_data = $arr_resp =$arr_cart= $arr_order= $arr_order_details = $arr_order_sub_options = $arr_order_options = $arr_order_status_history = $arr_order_finance =[]; 
        $total_weight = $total_quantity = 1;    
        $total_vat = 0;
        $arr_rule = $arr_cart = $arr_cart_options = $arr_cart_suboptions = $arr_cart_notes = [];

        $arr_rule['address_id']         = "required";

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

        $customer_id = $this->user->id;

        $address_id = $request->input('address_id',null);

        $promocode_id = $request->input('promocode_id',null);
        
        $response = json_decode($request->input('response'));

        $obj_cart   = $this->CartModel->where('customer_id',$customer_id)
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
                                      ->with('get_extra_notes')
                                     ->get();
                                     
        if($obj_cart){
            $arr_cart = $obj_cart->toArray();
            // dd($arr_cart);

            $str1       = "0123456789";
            $str2       = str_shuffle($str1);
            $order_id   = substr($str2,0,7);
            $obj_address = $this->CustomerAddressModel->where('id',$address_id)->first();
            $arr_order['order_id']              = $order_id;
            $arr_order['customer_id']           = $customer_id;
            $arr_order['order_total_amount']    = $response->amount;
            $arr_order['promocode_id']          = $promocode_id;
            $arr_order['address_id']            = $address_id;
            $arr_order['country_id']            = isset($obj_address->country_id)?$obj_address->country_id:null;
            $arr_order['city_id']               = isset($obj_address->city_id)?$obj_address->city_id:null;
            $arr_order['delivery_type_id']            = '3';
            $arr_order['transaction_id']            = $response->fort_id;
            $arr_order['order_total_items']            = sizeof($arr_cart);
            $arr_order['printing_status']            = 'pending';
            $arr_order['delivery_status']            = 'waiting';
            $arr_order['create_shipment']            = '0';
            $arr_order['payment_response']            = $request->input('response');

            $create_order = $this->OrdersModel->create($arr_order);

            if(isset($arr_data['get_extra_notes']) && $arr_data['get_extra_notes']!=null){
                $arr_order_notes['order_id']    = $create_order->id;
                $arr_order_notes['notes']       = $arr_data['get_extra_notes']['notes'];
                $arr_order_notes['added_by']    = $this->user->full_name;

                $create_order_notes = $this->PrintingOrderExtraNotesModel->create($arr_order_notes);
            }

            $arr_order_status_history['order_id']            = $create_order->id;
            $arr_order_status_history['old_status']          = 'pending';
            $arr_order_status_history['new_status']          = 'pending';
            $arr_order_status_history['change_by']           = 'customer';
            $arr_order_status_history['name']                = $this->user->full_name;

            $create_status_history = $this->PrintingOrderStatusHistoryModel->create($arr_order_status_history);

            //  Code for Finance
            $obj_vat = $this->VatModel->where('id','1')->first();
            $total_vat =  ($response->amount *((isset($obj_vat->vat)?$obj_vat->vat:0)/100));

            $get_promocode = $this->PromoCodesModel->where('id',$promocode_id)->first();

            $discount_amount = $response->amount * (((isset($get_promocode->percentage)?$get_promocode->percentage:0)/100));
            $before_discount = $response->amount +  $discount_amount;

            $arr_order_finance['order_id']                      = $create_order->id;
            $arr_order_finance['vat']                           = $total_vat;
            $arr_order_finance['total_before_discount']         = $before_discount-$total_vat;
            $arr_order_finance['discount']                      = $discount_amount;
            $arr_order_finance['total_including_vat']           = $response->amount;

            $create_order_finance = $this->OrderFinanceDetailsModel->create($arr_order_finance);

            foreach($arr_cart as $key => $value){
                $arr_order_details['order_id']              = $create_order->id;
                $arr_order_details['product_id']            = $value['product_id'];
                $arr_order_details['agent_id']              = $value['agent_id'];
                $arr_order_details['weight_time_cost_id']   = $value['weight_time_cost_id'];
                $arr_order_details['unit_price']            = $value['unit_price'];
                $arr_order_details['quantity']              = $value['quantity'];
                $arr_order_details['file']                  = $value['file'];
                
                $create_order_detials = $this->PrintingOrderDetailsModel->create($arr_order_details);

                foreach ($value['get_cartoptions'] as $key_option => $value_option) {
                    $arr_order_options['order_id']          = $create_order->id;
                    $arr_order_options['order_detail_id']   = $create_order_detials->id;
                    $arr_order_options['option_id']         = $value_option['option_id'];

                    $create_order_options = $this->PrintingOrderDetailsOptionModel->create($arr_order_options);
                    // foreach ($value_option['get_suboptions'] as $key_sub_options => $value_sub_options) {
                    
                        $arr_order_sub_options['printing_order_details_option_id']  = $create_order_options->id;
                        $arr_order_sub_options['option_id']                         = $value_option['get_suboptions']['option_id'];
                        $arr_order_sub_options['sub_option_id']                     = $value_option['get_suboptions']['sub_option_id'];

                        $create_order_sub_options = $this->PrintingOrderDetailsSubOptionModel->create($arr_order_sub_options);

                    // }
                }
                
                $obj_delete_cart            = $this->CartModel->where('id',$arr_data['id'])->delete();
                $obj_delete_cartoptions     = $this->CartOptionsModel->where('cart_id',$arr_data['id'])->delete();
                $obj_delete_cartsuboptions  = $this->CartSubOptionsModel->where('cart_id',$arr_data['id'])->delete();
                $obj_delete_cartnotes       = $this->CartNotesModel->where('cart_id',$arr_data['id'])->delete();
            }

            $arr_response['status'] = 'SUCCESS';
            $arr_response['msg']    = "Order placed successfully.";
            $arr_response['data']   = [];
            return $arr_response;
        }else{
            $arr_response['status'] = 'ERROR';
            $arr_response['msg']    = 'Something Went wrong.';
            $arr_response['data']   = [];
            return $arr_response;
        }
    }
    
    public function orders_list(Request $request)
    {
        $arr_rule  = $arr_user_detail = $arr_all_orders = $arr_pending_orders= [];

        $obj_all_orders = $this->OrdersModel->where('printing_status','=','pending')
                                            ->with('get_city')
                                            ->get();
                                           
        if($obj_all_orders)
        {
            $arr_all_orders = $obj_all_orders->toArray();
            // dd($this->user->id);
            foreach ($arr_all_orders as $key => $orders) 
            {
                $arr_orders[$key]['sr_no']                = $key+1;
                $arr_orders[$key]['order_id']             = isset($orders['order_id']) ?  $orders['order_id']: '';
                $arr_orders[$key]['value']                = isset($orders['order_total_amount']) ?  $orders['order_total_amount']: '';
                $arr_orders[$key]['city_english']         = isset($orders['get_city']['city_english_name']) ?  $orders['get_city']['city_english_name']: '';
                $arr_orders[$key]['city_arabic']          = isset($orders['get_city']['city_arabic_name']) ? $orders['get_city']['city_arabic_name']: '';
                $arr_orders[$key]['printing_status']      = isset($orders['printing_status']) ?  $orders['printing_status']: '';
                $arr_orders[$key]['delivery_status']      = isset($orders['delivery_status']) ?  $orders['delivery_status']: '';
                $arr_orders[$key]['rate']                 = isset($orders['Rate']) ?  $orders['Rate']: 'Rate';
                $arr_orders[$key]['rate']                 = isset($orders['Rate']) ?  $orders['Rate']: 'Rate';
                $arr_orders[$key]['date']                 = isset($orders['created_at']) ?  date('d-m-Y h:i A',strtotime($orders['created_at'])): '';
                $key = $key+1;              
            }

            // $arr_resp['arr_orders']= $arr_orders;
            $arr_response_data['data']     = $arr_orders;


            $arr_response['status'] =  'SUCCESS';
            $arr_response['msg']    =  'My Orders data displayed successfully.';
            $arr_response['data']   =  $arr_response_data['data'];
            return $arr_response;
        }
        else
        {
            $arr_response['status'] =  'ERROR';
            $arr_response['msg']    =  'No Data Found.';
            $arr_response['data']   =  [];
            return $arr_response;
        }
        $arr_response['status'] =  'ERROR';
        $arr_response['msg']    =  'Oops! Something went wrong.';
        $arr_response['data']   =  [];

        return $arr_response;
        
    }  
 
    public function update_item_status(Request $request)
    {
        
        $arr_rule  = $arr_item_view = [];
        $english_option = $arabic_option='';
        $arr_rule['item_id']         = "required";
        $arr_rule['status']         = "required";
        
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
        $item_id = $request->input('item_id');
        $status = $request->input('status');
        $obj_all_orders = $this->PrintingOrderDetailsModel
                                            //->where('customer_id','=',$this->user->id)
                                            ->where('id',$item_id)
                                            //->with('get_city')
                                            ->first();
                                            
        
        if($obj_all_orders)
        {
            $obj_all_orders->status = $status;
            $obj_all_orders->save();
        


            $arr_response['status'] =  'SUCCESS';
            $arr_response['msg']    =  'Status Update Successfully';
            //$arr_response['data']   =  $arr_response_data['data'];
            return $arr_response;
        }
        else
        {
            $arr_response['status'] =  'ERROR';
            $arr_response['msg']    =  'No Data Found.';
            $arr_response['data']   =  [];
            return $arr_response;
        }
        $arr_response['status'] =  'ERROR';
        $arr_response['msg']    =  'Oops! Something went wrong.';
        $arr_response['data']   =  [];

        return $arr_response;
        
    }
    public function get_order_item(Request $request)
    {
        
        $arr_rule  = $arr_item_view = [];
        $english_option = $arabic_option='';
        $arr_rule['order_id']         = "required";
        
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
        $order_id = $request->input('order_id');
        $obj_all_orders = $this->OrdersModel->where('customer_id','=',$this->user->id)
                                            ->where('order_id',$order_id)
                                            ->with('get_city')
                                            ->first();
        
        if($obj_all_orders)
        {

            $arr_all_orders = $obj_all_orders->toArray();

                $english_option = $arabic_option ='';
                $obj_all_orders  = $this->PrintingOrderDetailsModel->with('get_order_details','get_product_details','get_agent_details')
                                                                    ->with(['get_productoption_selected'=>function($q){
                                                                        $q->with('get_option_details');
                                                                    }]) 

                                                                    ->where('order_id',$arr_all_orders['id'])
                                                                    ->orderBy('created_at','DESC')
                                                                    ->get();
                                                                   

                if($obj_all_orders)
                {
                    $arr_order_detail = $obj_all_orders->toArray();
                }
                foreach ($arr_order_detail as $key => $value) 
                {
                    
                //$arr_orders[$key]['sr_no']                = $key+1;
                $arr_orders[$key]['id']                = isset($arr_all_orders['id']) ?  $arr_all_orders['id']: '';
               // $arr_orders[$key]['order_id']             = isset($arr_all_orders['order_id']) ?  $arr_all_orders['order_id']: '';
                $arr_orders[$key]['product_id']           = isset($value['get_product_details']['product_id']) ?  $value['get_product_details']['product_id']: ''; 

                $arr_orders[$key]['product_english_name'] = isset($value['get_product_details']['product_english_name']) ?  $value['get_product_details']['product_english_name']: ''; 
                $arr_orders[$key]['printing_status']             = isset($arr_all_orders['printing_status']) ?  $arr_all_orders['printing_status']: '';
                $arr_orders[$key]['quantity']             = isset($value['quantity']) ?  $value['quantity']: '';


               
                //$arr_orders[$key]['product_id']        = substr($product_id, 0, -1);
               // $arr_orders[$key]['arabic_option']         = substr($arabic_option, 0, -1);

            
                    $arr_response_data['data']     = $arr_orders;
            }


            $arr_response['status'] =  'SUCCESS';
            //$arr_response['msg']    =  'Items data displayed successfully.';
            $arr_response['data']   =  $arr_response_data['data'];
            return $arr_response;
        }
        else
        {
            $arr_response['status'] =  'ERROR';
            $arr_response['msg']    =  'No Data Found.';
            $arr_response['data']   =  [];
            return $arr_response;
        }
        $arr_response['status'] =  'ERROR';
        $arr_response['msg']    =  'Oops! Something went wrong.';
        $arr_response['data']   =  [];

        return $arr_response;
        
    }
    public function save_order(Request $request)
    {
         //
         //dd($request->all());
        $arr_data = $arr_resp =$arr_cart= $arr_order= $arr_order_details = $arr_order_sub_options = $arr_order_options = $arr_order_status_history = $arr_order_finance =[]; 
        $total_weight = $total_quantity = 1;    
        $total_vat = 0;
        $arr_rule = $arr_cart = $arr_cart_options = $arr_cart_suboptions = $arr_cart_notes = [];

       // $arr_rule['address_id']         = "required";
        $arr_rule['amount']         	= "required";

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
        $customer_id =  $request->input('customer_id');
        
        $amount = $request->input('amount');
        $address_id = $request->input('address_id',null);

        $promocode_id = $request->input('promocode_id',null);
        //dd($address_id);
        ///$response = json_decode($request->input('response'));

        $obj_cart   = $this->CartModel->where('customer_id',$customer_id)
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
                                      ->with('get_extra_notes')
                                     ->get();
                                     
        if($obj_cart){
            $arr_cart = $obj_cart->toArray();
             

            $str1       = "0123456789";
            $str2       = str_shuffle($str1);
            $order_id   = substr($str2,0,7);
           
            $obj_cust = $this->CustomerModel->where('id',$customer_id)->first();
            //dd($obj_cust);
             if($obj_cust){
                 $arr_cust = $obj_cust->toArray();
                 //dd($arr_cust);
             }
            $obj_address = $this->CustomerAddressModel->where('customer_id',$customer_id)->first();

            $arr_order['order_id']              = $order_id;
            $arr_order['customer_id']           = $customer_id;
            $arr_order['order_total_amount']    = $amount;
            $arr_order['promocode_id']          = $promocode_id;
            $arr_order['address_id']            = isset($obj_address->id)?$obj_address->id:null;
            $arr_order['country_id']            = isset($obj_address->country_id)?$obj_address->country_id:null;
            $arr_order['city_id']               = isset($obj_address->city_id)?$obj_address->city_id:null;
            $arr_order['delivery_type_id']            = '3';
            //$arr_order['transaction_id']            = $response->fort_id;
            $arr_order['order_total_items']            = sizeof($arr_cart);
            $arr_order['printing_status']            = 'pending';
            $arr_order['delivery_status']            = 'waiting';
            $arr_order['create_shipment']            = '0';
            $arr_order['payment_response']            = $request->input('merchant_reference',null);
            $arr_order['payment_status']            ='pending';

            $create_order = $this->OrdersModel->create($arr_order);

            $arr_resp['order_id'] = $create_order->id;
            $arr_resp['amount'] = $amount;
            if(isset($arr_cart['get_extra_notes']) && $arr_cart['get_extra_notes']!=null){
                $arr_order_notes['order_id']    = $create_order->id;
                $arr_order_notes['notes']       = $arr_cart['get_extra_notes']['notes'];
                $arr_order_notes['added_by']    = isset($arr_cust['full_name'])? $arr_cust['full_name']: '-'; 

                $create_order_notes = $this->PrintingOrderExtraNotesModel->create($arr_order_notes);
            }

            $arr_order_status_history['order_id']            = $create_order->id;
            $arr_order_status_history['old_status']          = 'pending';
            $arr_order_status_history['new_status']          = 'pending';
            $arr_order_status_history['change_by']           = 'customer';
            $arr_order_status_history['name']                = isset($arr_cust['full_name'])? $arr_cust['full_name']: '-'; 

            $create_status_history = $this->PrintingOrderStatusHistoryModel->create($arr_order_status_history);

            //  Code for Finance
            $obj_vat = $this->VatModel->where('id','1')->first();
            $total_vat =  ($amount *((isset($obj_vat->vat)?$obj_vat->vat:0)/100));
            if($promocode_id != ''){
                 $get_promocode = $this->PromoCodesModel->where('id',$promocode_id)->first();

                $discount_amount = $amount * (((isset($get_promocode->percentage)?$get_promocode->percentage:0)/100));
            }else{
                $discount_amount = 0.00;
            }
           
            $before_discount = $amount +  $discount_amount;

            $arr_order_finance['order_id']                      = $create_order->id;
            $arr_order_finance['vat']                           = $total_vat;
            $arr_order_finance['total_before_discount']         = $before_discount-$total_vat;
            $arr_order_finance['discount']                      = $discount_amount;
            $arr_order_finance['total_including_vat']           = $amount;

            $create_order_finance = $this->OrderFinanceDetailsModel->create($arr_order_finance);
            
            foreach($arr_cart as $key => $value){
                $arr_order_details['order_id']              = $create_order->id;
                $arr_order_details['product_id']            = $value['product_id'];
                $arr_order_details['agent_id']              = $value['agent_id'];
                $arr_order_details['weight_time_cost_id']   = $value['weight_time_cost_id'];
                $arr_order_details['unit_price']            = $value['unit_price'];
                $arr_order_details['quantity']              = $value['quantity'];
                $arr_order_details['file']                  = $value['file'];
                
                $create_order_detials = $this->PrintingOrderDetailsModel->create($arr_order_details);
                //dd($create_order_detials);
                foreach ($value['get_cartoptions'] as $key_option => $value_option) {
                    $arr_order_options['order_id']          = $create_order->id;
                    $arr_order_options['order_detail_id']   = $create_order_detials->id;
                    $arr_order_options['option_id']         =  $value_option['option_id'];

                    $create_order_options = $this->PrintingOrderDetailsOptionModel->create($arr_order_options);
                    
                     foreach ($value_option['get_suboptions'] as $key_sub_options => $value_sub_options) {
                    
                        $arr_order_sub_options['printing_order_details_option_id']  = $create_order_options->id;
                        $arr_order_sub_options['option_id']                         = $value_option['get_suboptions']['option_id'];
                        $arr_order_sub_options['sub_option_id']                     = $value_option['get_suboptions']['sub_option_id'];

                        $create_order_sub_options = $this->PrintingOrderDetailsSubOptionModel->create($arr_order_sub_options);
                            
                     }
                }
                    /*if(!empty($arr_cart['id'])){
                    	$obj_delete_cart            = $this->CartModel->where('id',$arr_cart['id'])->delete();
                        $obj_delete_cartoptions     = $this->CartOptionsModel->where('cart_id',$arr_cart['id'])->delete();
                        $obj_delete_cartsuboptions  = $this->CartSubOptionsModel->where('cart_id',$arr_cart['id'])->delete();
                        $obj_delete_cartnotes       = $this->CartNotesModel->where('cart_id',$arr_cart['id'])->delete();
                    }*/
            }    


            // $arr_response['status'] = 'SUCCESS';
            // $arr_response['msg']    = "Order placed successfully.";
            $arr_response['data']   = $arr_resp['order_id'];
            return $arr_resp['order_id'];
        }else{
            $arr_response['status'] = 'ERROR';
            $arr_response['msg']    = 'Something Went wrong.';
            $arr_response['data']   = [];
            return $arr_response;
        }
    }
    public function test(){
        return "success";
    }    
}

