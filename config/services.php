<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
  	
  	'payfort' => [
    	'access_code' => env('PAYFORT_ACCESS_CODE','bUOVKlJHpxjbE0stidlS'),
      	'merchant_identifier' => env('PAYFORT_MERCHANT_IDENTIFIER','0b62e9c1'),
      	'sha_request' => env('PAYFORT_SHA_REQUEST','$2y$10$yQAy8my9b'),
      	'sha_response' => env('PAYFORT_SHA_RESPONSE','$2y$10$RIAE0V92s'),
      	'request_endpoint' => env('PAYFORT_REQUEST_ENDPOINT','https://sbcheckout.payfort.com/FortAPI/paymentPage'),
      	'operation_endpoint' => env('PAYFORT_OPERATION_ENDPOINT','https://sbpaymentservices.payfort.com/FortAPI/paymentApi')
  	]

];
