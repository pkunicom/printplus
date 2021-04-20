<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Common\Services\Authservice;
use App\Common\Services\MailService;
use App\Models\FrontPagesModel;
use App\Models\EvaluationModel;
use JWTAuth;
use Hash;
use Validator;


class FrontPagesController extends Controller
{
    public function __construct()
    {
        $this->MailService        = new MailService();
        $this->FrontPagesModel    = new FrontPagesModel();

    }

    // Common Category listing : AUTHOR (Harsh chauhan) 
    public function get_front_pages(Request $request)
    {

        $arr_rules['slug']                    = "required";
        
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

        $slug     = $request->input('slug');

        $obj_data       = $this->FrontPagesModel->where('slug',$slug)->first();

        if($obj_data){

            $arr_data = $obj_data->toArray();

            $arr_resp['id']                  = isset($arr_data['id']) ?  $arr_data['id']: '';
            $arr_resp['page_title']          = isset($arr_data['page_title']) ?  $arr_data['page_title']: '';
            $arr_resp['page_description']    = isset($arr_data['page_description']) ?  $arr_data['page_description']: '';
            $arr_resp['slug']                = isset($arr_data['slug']) ?  $arr_data['slug']: '';
            $arr_resp['meta_keyword']        = isset($arr_data['meta_keyword']) ?  $arr_data['meta_keyword']: '';
            $arr_resp['meta_title']          = isset($arr_data['meta_title']) ?  $arr_data['meta_title']: '';
            $arr_resp['meta_description']    = isset($arr_data['meta_description']) ?  $arr_data['meta_description']: '';

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
                $arr_response['status'] =  'SUCCESS';
                $arr_response['msg']    =  'No Reviews.';
                $arr_response['data']   =  [];
                return $arr_response;
            }

        }else{

            $arr_response['status'] =  'SUCCESS';
            $arr_response['msg']    =  'Something went wrong.';
            $arr_response['data']   =  [];

            return $arr_response;
        }

       
    }

}