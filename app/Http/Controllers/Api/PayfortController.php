<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\Payfort;
use App\Models\Payment;
use App\Models\OrdersModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class PayfortController extends Controller
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
  
  
  	/**
     * Initialise the instance of the class
     *
     * @return void
    */
  	public function __construct()
    {
        $this->access_code  = config('payfort.access_code','bUOVKlJHpxjbE0stidlS');
      	$this->merchant_identifier = config('payfort.merchant_identifier','0b62e9c1');
      	$this->sha_request = config('payfort.sha_request','$2y$10$yQAy8my9b');
      	$this->request_endpoint = config('payfort.request_endpoint','https://sbcheckout.payfort.com/FortAPI/paymentPage');
      	$this->operation_endpoint = config('payfort.operation_endpoint','https://sbpaymentservices.payfort.com/FortAPI/paymentApi');
    }
  
  
  	/**
     * Make request to Payfort for Merchant Page
     *
     * @param mix|integer|float|$amount
     * @param string|$merchant_reference
    */
  	public function request(Request $request)
    {
      	return (new Payfort)->init($request);
    }

  	/**
     * Callback function which will be hit by payfort after payment page request
     * Gets the TOKENIZATION request response
     *
     * @param Request|request
     * @return mix
    */
  	public function callback(Request $request)
    {   
        
        //dd($response->all());
      	if($request->status == 18) {
          
          //GET ORDER_ID HERE AND SEND IT AS SECOND PARAMETER in makePayment function
          
          //$order_id = app('App\Http\Controllers\Api\OrderManagementController')->save_order($request);
          return $this->makePayment(array(
              'command'=>'PURCHASE',
              'access_code'=>$request->access_code,
              'merchant_identifier'=>$request->merchant_identifier,
              'merchant_reference'=>$request->merchant_reference,
              'amount'=>$this->convertFortAmount($request->amount,$request->currency),
              'currency'=>$request->currency,
              'language'=>$request->language,
              'customer_email'=>'tony@test.com',
              'customer_ip'=>'13.235.3.89',
              'token_name'=>$request->token_name,
              'signature'=>$this->operationSignature($request)
            ),'DUMMY_ORDER_ID');
          
        }else if($request->status == 14){
          //return $this->savePayment($request,'ORDER_ID');
           $this->savePayment($request,'ORDER_ID');
           dd('hello');
           return  redirect(url('/print-plus/dashboard/true/'.$request->merchant_identifier));
        }else {
          //return "Payment Failed";
          return redirect(url('/print-plus/dashboard/false/'.$request->merchant_identifier));
        }      	
    }


  	/**
     * Make the transaction request to payfort
     *
     * @param array|post_data
     * @param string|order_id
     * @return string|success|failure
    */
  	private function makePayment(array $postData,$order_id)
    {
      
      // Setup cURL
      $ch = curl_init($this->operation_endpoint);
      curl_setopt_array($ch, array(
          CURLOPT_POST => TRUE,
          CURLOPT_RETURNTRANSFER => TRUE,
          CURLOPT_HTTPHEADER => array(
              'Content-Type: application/json'
          ),
          CURLOPT_POSTFIELDS => json_encode($postData)
      ));

      // Send the request
      $response = json_decode(curl_exec($ch));
      curl_close($ch);
      if($response->status == 20) {
        return redirect($response->{'3ds_url'});
      } else if($response->status == 14) {
        return $this->savePayment($response,'ORDER_ID');
      } else {
        return "Something went wrong,please try again later";
      }
    }
 
  	/**
     * Save the transaction in the database
     *
     * @param Object|$response
     * @return String
    */
  	private function savePayment($response,$order_id)
    {
     	//dd($response->all()); 
    	$payment = new Payment;
      	$payment->data = json_encode($response);
      	$payment->status = $response->status;
      	$payment->save();

        /**if($payment->save()){
          $arr_update['payment_status'] = $response->status;
          $arr_update['payment_id'] = $payment->id;
          $order_update = OrdersModel::where('id',$order_id)->update($arr_update);

        }*/
      	//dd($response);
    }


	/**
     * Create signature Merchant Request Page and returns back the signature created
     *
     * @param string|merchant_reference
     * @return string
    */
	public function requestSignature(Request $request)
    {
     
    //  
    try 
        {    
          return  $this->signature([
            	'access_code'=>$this->access_code,
      			'language'=>$this->language,
            	'merchant_identifier'=>$this->merchant_identifier,
      			'service_command'=>'TOKENIZATION',
            	'merchant_reference'=>$request->merchant_reference,
            	'amount'=>$request->amount,
            	'currency'=>$request->currency
            ]);
            
        } 
        catch(\Exception $e)
        {
        	\Log::emergency($e);
            Flash::error($e->getMessage());
            return redirect()->back();
        }        
    }
  
    /**
  	 * Create signature to make the Merchant Operations Request
     *
     * @param Object|request
     * @return string
  	*/
  	protected function operationSignature($request)
    {
   		return $this->signature([
            'command'=>'PURCHASE',
            'access_code'=>$request->access_code,
            'merchant_identifier'=>$request->merchant_identifier,
            'merchant_reference'=>$request->merchant_reference,
            'amount'=>$this->convertFortAmount($request->amount,$request->currency),
            'currency'=>$request->currency,
            'language'=>$request->language,
            'customer_email'=>'tony@test.com',
            'customer_ip'=>'13.235.3.89',
            'token_name'=>$request->token_name
        ]);
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
        return hash("sha256", $shaString);
                $arr_response['status'] =  'SUCCESS';
                $arr_response['msg']    =  'signature genrated.';
                $arr_response['data']   =  hash("sha256", $shaString);
                return $arr_response;
          
    }
  
  	/**
     * Convert Amount with dicemal points
     * @param decimal $amount
     * @param string  $currencyCode
     * @return decimal
     */
    private function convertFortAmount($amount, $currencyCode)
    {
        $new_amount = 0;
        $total = $amount;
        $decimalPoints    = $this->getCurrencyDecimalPoints($currencyCode);
        $new_amount = round($total, $decimalPoints) * (pow(10, $decimalPoints));
        return $new_amount;
    }
    
    /**
     * 
     * @param string $currency
     * @param integer 
     */
    private function getCurrencyDecimalPoints($currency)
    {
        $decimalPoint  = 2;
        $arrCurrencies = array(
            'JOD' => 3,
            'KWD' => 3,
            'OMR' => 3,
            'TND' => 3,
            'BHD' => 3,
            'LYD' => 3,
            'IQD' => 3
        );
        if (isset($arrCurrencies[$currency])) {
            $decimalPoint = $arrCurrencies[$currency];
        }
        return $decimalPoint;
    }
}