<?php

namespace App\Services;


class Payfort
{
  	/*--------------------------CLASS RESPONSIBLE FOR INTEGRATING PAYFORT PAYMENT GATEWAY-------------------------------------|
    |---------------------------------------------AUTHOR: ANKUSH GAZTA--------------------------------------------------------|
    |-------------------------------------------------------------------------------------------------------------------------*/
  
  	/**
     * Mandatory param required by payfort
     *
     * @var string
    */
  	protected $access_code;
  
    /**
     * Mandatory param required by payfort
     *
     * @var string
    */
  	protected $merchant_identifier;
  
    /**
     * Mandatory param required by payfort 
     *
     * @var string
    */
  	protected $sha_request;
    
  	/**
     * Endpoint to make form request to the payfort
     *
     * @var string
    */
  	protected $endpoint;
    	
  	/**
     * Mandatory param required by payfort
     *
     * @var string
    */
  	protected $service_command = 'TOKENIZATION';
  
  	/**
     * Mandatory param required by payfort 
     *
     * @var string
    */
  	protected $language = 'en';
    
  	/**
     * Mandatory param required by payfort 
     *
     * @var string
    */
  	protected $merchant_reference;
  
  	/**
     * Mandatory param required by payfort 
     *
     * @var string
    */
  	protected $amount;
   
  	/**
     * Mandatory param required by payfort
     *
     * @var string
    */
  	protected $signature;

  
  	/**
   	 * Initialise the instance of class
     *
  	*/
  	public function __construct()
    {
    	$this->access_code  = config('payfort.access_code','bUOVKlJHpxjbE0stidlS');
      	$this->merchant_identifier = config('payfort.merchant_identifier','0b62e9c1');
      	$this->sha_request = config('payfort.sha_request','$2y$10$yQAy8my9b');
      	$this->endpoint = config('payfort.request_endpoint','https://sbcheckout.payfort.com/FortAPI/paymentPage');
  	}
  
  	/**
     * Base function to initialise the payment request
     *
     * @param mix|String|Float|$amount
     * @param String|$merchant_reference unique order number is required
     * @return void
    */
  	public function init($request)
    {
     	$this->setMerchantReference($request->merchant_reference);
      	session(['amount'=>$request->amount]);
      	session(['customer_name'=>$request->customer_name]);
      	session(['customer_email'=>$request->customer_email]);
      	session(['order_description'=>$request->order_description]);
      	$this->setSignature();
      	return $this->callAPI();
    }
  
  	/**
     * Call the Payfort API to initialise transaction
     * Make Merchant Page Request to Payfort
     *
     * @use class properties
     * @return response
    */
	protected function callAPI()
    {
    	$ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,$this->endpoint);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 
                  http_build_query(array(
                  	'service_command'=>$this->service_command,
                    'access_code'=>$this->access_code,
                    'merchant_identifier'=>$this->merchant_identifier,
                    'language'=>$this->language,
                    'merchant_reference'=>$this->merchant_reference,
                    'signature'=>$this->signature
                  )));

        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      	$res = curl_exec($ch);
      	$link = "<script>window.open($res)</script>"; 
      	echo $link;
    }
  
  	/*--------------------SETTERS FOR THE CLASS VARIABLES----------------------------*/
  	
  	/**
  	 * Setter for merchant_reference property of the class
     *
     * @param String|merchant_reference
     * @return void
  	*/
  	protected function setMerchantReference($merchant_reference):void
    {
   		$this->merchant_reference = $merchant_reference;
    }
  
    /**
  	 * Setter for amount property of the class
     *
     * @param String|amount
     * @return void
  	*/
  	protected function setAmount($amount):void
    {
   		$this->amount = $amount;
    }
  
    /**
  	 * Setter for signature property of the class
     *
     * @return void
  	*/
  	protected function setSignature():void
    {
   		$params = [
        	'service_command'=>$this->service_command,
        	'access_code'=>$this->access_code,
        	'merchant_identifier'=>$this->merchant_identifier,
        	'merchant_reference'=>$this->merchant_reference,
        	'language'=>$this->language
        ];
      	
        $shaString = '';
        ksort($params);
        foreach ($params as $key => $value) {
            $shaString .= "$key=$value";
        }
        $shaString = $this->sha_request . $shaString . $this->sha_request;
        $this->signature = hash("sha256", $shaString);
    }
}