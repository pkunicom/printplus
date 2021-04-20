<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Payfort;
use App\Http\Controllers\Api\OrderManagementController;
use App\Models\Payment;
use App\Models\OrdersModel;
use App\Models\CartModel;
use App\Models\CartOptionsModel;
use App\Models\CartNotesModel;
use App\Models\CartSubOptionsModel;

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
      	///$this->$orderController = new OrderManagementController;
        $this->CartModel                              = new CartModel();
        $this->CartOptionsModel                       = new CartOptionsModel();
        $this->CartSubOptionsModel                    = new CartSubOptionsModel();
        $this->CartNotesModel                         = new CartNotesModel();
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
        //dd($request);
        //$order_id = app('App\Http\Controllers\Api\OrderManagementController')->save_order($request);
    try 
        {  
          	if($request->status == 18) {
              
              //GET ORDER_ID HERE AND SEND IT AS SECOND PARAMETER in makePayment function
              
              
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
                return  redirect('https://www.webwingdemo.com/print-plus/orders');
            }else {
              //return "Payment Failed";
              return redirect('https://www.webwingdemo.com/print-plus/cart/'.$request->status);
            }   
        } 
        catch(\Exception $e)
        {
        	\Log::emergency($e);
        	dd($e->getMessage());
            Flash::error($e->getMessage());
            return redirect()->back();
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
      // dd($postData);
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
     // dd($response);
      if($response->status == 20) {
        return redirect($response->{'3ds_url'});
      } else if($response->status == 14) {
                //return $this->savePayment($response,'ORDER_ID');
                $this->savePayment($response,'ORDER_ID');
                return  redirect(url('/dashboard/true/'.$request->merchant_identifier));
      } else {
            return redirect(url('/dashboard/false/'.$request->merchant_identifier));
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
      	$payment->data = $response;
      	$payment->status = $response->status;
      	//$payment->save();

        if($payment->save()){
            $obj_order = OrdersModel::where('payment_response',$response->merchant_reference)->get();
            if($obj_order){
                $arr_order = $obj_order->toArray();
                 
                $customer_id = $arr_order[0]['customer_id'];
                
            }
           
          $arr_update['payment_status'] = $response->status;
          $arr_update['payment_id'] = $payment->id;
          //$arr_update['payment_response'] = json_encode($response);
          $order_update = OrdersModel::where('payment_response',$response->merchant_reference)->update($arr_update);
          
            $obj_order = CartModel::where('customer_id',$customer_id)->get();
            if($obj_order){
                $arr_order = $obj_order->toArray();
                
                foreach($arr_order as $key => $value){
                    //dd($value['id']);
                   
                    $obj_delete_cart            = $this->CartModel->where('id',$value['id'])->delete();
                    $obj_delete_cartoptions     = $this->CartOptionsModel->where('cart_id',$value['id'])->delete();
                    $obj_delete_cartsuboptions  = $this->CartSubOptionsModel->where('cart_id',$value['id'])->delete();
                    $obj_delete_cartnotes       = $this->CartNotesModel->where('cart_id',$value['id'])->delete();
                }

            }
                        
          
            //dd($order_update);
        }
     
    }


	/**
     * Create signature Merchant Request Page and returns back the signature created
     *
     * @param string|merchant_reference
     * @return string
    */
	public function requestSignature(Request $request)
    {
     
      return $this->signature([
        	'access_code'=>$this->access_code,
  			'language'=>$this->language,
        	'merchant_identifier'=>$this->merchant_identifier,
  			'service_command'=>'TOKENIZATION',
        	'merchant_reference'=>$request->merchant_reference,
        	'amount'=>$request->amount,
        	'currency'=>$request->currency
        ]);   
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