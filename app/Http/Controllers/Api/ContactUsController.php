<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Common\Services\Authservice;
use App\Common\Services\MailService;
use App\Models\ContactUsModel;
use JWTAuth;
use Hash;
use Validator;


class ContactUsController extends Controller
{
    public function __construct()
    {
        $this->MailService        = new MailService();
        $this->ContactUsModel     = new ContactUsModel();

    }

    // Contact us POST  : AUTHOR (Harsh chauhan) 
    public function contact_us(Request $request)
    {

        $arr_data = $arr_response = $arr_rules = $arr_resp = [];

        $arr_rules['name']                    = "required";
        $arr_rules['email']                   = "required|email";
        $arr_rules['contact']                 = "required|int";
        $arr_rules['message']                 = "required";
        
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

        $name     		= $request->input('name');
        $email     		= $request->input('email');
        $contact     	= $request->input('contact');
        $message     	= $request->input('message');

        $arr_data['name']          			= isset($name) ?  $name: '';
        $arr_data['email']    				= isset($email) ?  $email: '';
        $arr_data['contact']                = isset($contact) ?  $contact: '';
        $arr_data['message']        		= isset($message) ?  $message: '';

        $obj_create       = $this->ContactUsModel->create($arr_data);

        if($obj_create){

            $arr_response['status'] =  'SUCCESS';
            $arr_response['msg']    =  'Contact us submitted successfully.';
            // $arr_response['data']   =  [];

            return $arr_response;

        }else{

            $arr_response['status'] =  'ERROR';
            $arr_response['msg']    =  'Oops! Something went wrong.';
            // $arr_response['data']   =  [];

            return $arr_response;
        }

        $arr_response['status'] =  'ERROR';
        $arr_response['msg']    =  'Oops! Something went wrong.';
        // $arr_response['data']   =  [];

        return $arr_response;
    }



}