<?php



namespace App\Http\Controllers\Api;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use App\Common\Services\Authservice;

use App\Common\Services\MailService;

use App\Models\CustomerModel;

use App\Models\CountryModel;

use App\Models\OrdersModel;

use App\Models\CategoryModel;

use App\Models\CustomerGroupsModel;

use App\Models\CustomerCategoryDiscountModel;

use App\Models\WebAdmin;

use JWTAuth;

use Hash;

use Validator;



class AuthController extends Controller

{

    public function __construct()

    {

        $this->CustomerModel            = new CustomerModel();

        $this->CountryModel             = new CountryModel();

        $this->OrdersModel              = new OrdersModel();

        $this->CustomerGroupsModel      = new CustomerGroupsModel();

        $this->MailService		        = new MailService();

        $this->CategoryModel            = new CategoryModel();

        $this->CustomerCategoryDiscountModel            = new CustomerCategoryDiscountModel();

        $this->auth                     = auth()->guard('api_user');

        $this->user                     = $this->auth->user();

        $this->WebAdminModel            = new WebAdmin();

    }



    public function registration(Request $request)

    {

        $arr_rules = $arr_resp_data = $arr_data = $arr_response = [];

        



        // $arr_rules['customer_id']               = "required";

        $arr_rules['full_name']                 = "required|string";

        $arr_rules['email']                     = "required|email|unique:customers|max:75";

        $arr_rules['country_code_id']           = "required|string";

        $arr_rules['mobile_number']             = "required|unique:customers|max:13";

        $arr_rules['password']                  = "required|max:40";

        // $arr_rules['confirm_password']          = "required|same:password";

        $arr_rules['gender']                    = "required|max:40";

        // $arr_rules['customer_group']            = "required";

        $arr_rules['country_code_flag']          = "required|max:40";

        



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

            return $arr_response;

        }



        $customer_id        = $request->input('customer_id');

        $full_name          = $request->input('full_name');

        $email              = $request->input('email');

        $password           = $request->input('password');

        $country_code_id    = $request->input('country_code_id');

        $mobile_number      = $request->input('mobile_number');

        $gender             = $request->input('gender');

        // $customer_group     = $request->input('customer_group');

        $county_code_flag             = $request->input('country_code_flag');

        $refer_code         = $this->generate_referral_code();

        $token_code         = $this->generate_token_code();

        

        $str1 = "0123456789";

        $str2 = str_shuffle($str1);

        $customer_id = substr($str2,0,6);



        $arr_data['customer_id']    = isset($customer_id)?$customer_id: '';

        $arr_data['full_name']      = isset($full_name)?$full_name: '';

        $arr_data['email']          = isset($email) ? $email :"";

        $arr_data['password']       = isset($password) ? hash::make($password) :"";

        $arr_data['country_code_id']= isset($country_code_id) ? $country_code_id :"";

        $arr_data['mobile_number']  = isset($mobile_number) ? $mobile_number :"";

        $arr_data['gender']         = isset($gender) ? $gender :"";

        $arr_data['customer_group'] = '1';

        $arr_data['referral_code']  = isset($refer_code) ? $refer_code :"";

        $arr_data['token_code']     = isset($token_code) ? $token_code :"";

         $arr_data['country_code_flag']     = isset($county_code_flag) ? $county_code_flag :"";



        $create = $this->CustomerModel->create($arr_data);



        if($create)

        {



            $obj_groups = $this->CustomerGroupsModel->where('id','1')

                                                    ->first();



            $obj_category = $this->CategoryModel->get();



            if($obj_category){

                $arr_category = $obj_category->toArray();

                // $obj_delete   = $this->CustomerCategoryDiscountModel->where('customer_id',$create->id)->delete();



                foreach ($arr_category as $key => $value) {

                    $arr_category_dis['customer_id'] = $create->id;

                    $arr_category_dis['category_id'] = $value['id'];

                    $arr_category_dis['discount']    = $obj_groups->standard_discount;



                    $obj_create_discount = $this->CustomerCategoryDiscountModel->create($arr_category_dis);

                }



                $verification_url =  '<a href="'.url('/api/verify_user').'/'.base64_encode($email).'/'.base64_encode($token_code).'">Link</a>';



                $arr_email['to_email_id']       =  isset($email) ? $email :"";

                $arr_email['to_name']           =  isset($full_name) ? $full_name :"";

                $arr_email['verification_url']  =  $verification_url;





                // $send_mail = $this->MailService->send_user_registration_email($arr_email);

            }



            $arr_response['status']   = 'SUCCESS';

            $arr_response['msg']      = 'Registration successfully completed.';

            return $arr_response;

        }

        else

        {

            $arr_response['status'] =  'ERROR';

            $arr_response['msg']    =  'Error while registration';

            return $arr_response;

        }



        $arr_response['status'] =  'ERROR';

        $arr_response['msg']    =  'Oops! Something went wrong.';

        return $arr_response;

    }

    

    function generate_referral_code() 

    { 

        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

        $referral_code = substr(str_shuffle($str_result),0, 6);

        $obj_customer  = $this->CustomerModel->where('referral_code','=',$referral_code)->first();

        if($obj_customer){

            $this->generate_referral_code();

        }

        else{

            return  $referral_code;

        }



    }



    // Registration verify link  create unique token AUTHOR : HArsh chauhan

    function generate_token_code() 

    { 

        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

        $token_code = substr(str_shuffle($str_result),0, 10);

        $obj_customer  = $this->CustomerModel->where('token_code','=',$token_code)->first();

        if($obj_customer){

            $this->generate_token_code();

        }

        else{

            return  $token_code;

        }

    }



    // Forget password create unique token AUTHOR : HArsh chauhan

    function generate_forgot_password_token_code() 

    { 

        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

        $token_code = substr(str_shuffle($str_result),0, 10);

        $obj_customer  = $this->CustomerModel->where('remember_token','=',$token_code)->first();

        if($obj_customer){

            $this->generate_token_code();

        }

        else{

            return  $token_code;

        }

    }



    public function login(Request $request)

    { 

        $arr_data = $arr_response = $arr_rules = $arr_resp_data = [];



        $arr_rules['email']         = "required|email|max:75";

        $arr_rules['password']      = "required|max:40";



      	$validator  = Validator::make($request->all(),$arr_rules);



        if($validator->fails()) 

        {

            $msg        = "Validation Error, Please fill up the all mandatory fields";

            if($validator->errors()) 

            {

                $arr_response_data['error'] = $validator->errors()->first();

            }

            $arr_response['status']   = 'ERROR';

            $arr_response['msg']      = $msg;

            $arr_response['data']     = $arr_response_data;

            return $arr_response;

        }



        $email          = $request->input('email');

        $password       = $request->input('password');

        

        $arr_data['email']      = $email;

        $arr_data['password']   = $password;

        // dd($this->auth->attempt($arr_data));

        if($this->auth->attempt($arr_data))

        {



            $obj_user = $this->CustomerModel->where('email',$arr_data['email'])->first();



            // if($obj_user->status=='1' && $obj_user->is_verified=='1'){



                $token = JWTAuth::fromUser($obj_user);

                

                $arr_resp_data['full_name']      = isset($obj_user->full_name)?ucfirst($obj_user->full_name):'';

                $arr_resp_data['email']          = isset($obj_user->email)?($obj_user->email):'';

                $arr_resp_data['mobile_number']  = isset($obj_user->mobile_number)?($obj_user->mobile_number):'';

                

                $arr_resp_data['token']          = $token;

                $arr_response['status']          = 'SUCCESS';

                $arr_response['msg']             = 'Login Successful.';

                $arr_response['data']            = $arr_resp_data;

                return $arr_response;

            // }else{

            //     $arr_response['status']          = 'ERROR';

            //     $arr_response['msg']             = 'Account not verified yet.';

            //     $arr_response['data']            = [];

            //     return $arr_response;

            // }

        }

        else

        {

            

            $arr_response['status'] = 'ERROR';

            $arr_response['msg']    = 'Invalid Credentials';

            $arr_response['data']   =  [];

            return $arr_response;

        }



        $arr_response['status'] = 'ERROR';

        $arr_response['msg']    = 'Oops! Something went wrong';

        $arr_response['data']   =  [];

        return $arr_response;

    }



    public function login_staff(Request $request)

    { 



        $arr_data = $arr_response = $arr_rules = $arr_resp_data = [];



        $arr_rules['email']         = "required|email|max:75";

        $arr_rules['password']      = "required|max:40";



        $validator  = Validator::make($request->all(),$arr_rules);



        if($validator->fails()) 

        {

            $msg        = "Validation Error, Please fill up the all mandatory fields";

            if($validator->errors()) 

            {

                $arr_response_data['error'] = $validator->errors()->first();

            }

            $arr_response['status']   = 'ERROR';

            $arr_response['msg']      = $msg;

            $arr_response['data']     = $arr_response_data;

            return $arr_response;

        }



        $email          = $request->input('email');

        $password       = $request->input('password');

        

        $arr_data['email']      = $email;

        $arr_data['password']   = $password;

        // dd($this->auth->attempt($arr_data));

        if(\Auth::guard('admin')->attempt($arr_data))

       // if($this->auth->attempt($arr_data))

        {



            $obj_user = $this->WebAdminModel->where('email',$arr_data['email'])->first();



            // if($obj_user->status=='1' && $obj_user->is_verified=='1'){



                $token = JWTAuth::fromUser($obj_user);

                

                $arr_resp_data['full_name']      = isset($obj_user->full_name)?ucfirst($obj_user->full_name):'';

                $arr_resp_data['email']          = isset($obj_user->email)?($obj_user->email):'';

                $arr_resp_data['mobile_number']  = isset($obj_user->mobile_number)?($obj_user->mobile_number):'';

                

                $arr_resp_data['token']          = $token;

                $arr_response['status']          = 'SUCCESS';

                $arr_response['msg']             = 'Login Successful.';

                $arr_response['data']            = $arr_resp_data;

                return $arr_response;

            // }else{

            //     $arr_response['status']          = 'ERROR';

            //     $arr_response['msg']             = 'Account not verified yet.';

            //     $arr_response['data']            = [];

            //     return $arr_response;

            // }

        }

        else

        {

            

            $arr_response['status'] = 'ERROR';

            $arr_response['msg']    = 'Invalid Credentials';

            $arr_response['data']   =  [];

            return $arr_response;

        }



        $arr_response['status'] = 'ERROR';

        $arr_response['msg']    = 'Oops! Something went wrong';

        $arr_response['data']   =  [];

        return $arr_response;

    }

    // Forget password : AUTHOR (AKSHAY ughale)

    public function forgot_password(Request $request)

    {

        $arr_data = $arr_rules =[];

        $arr_data['email'] = $request->input('email');



        // dd($request->all());

        $arr_response = [];

        

        $arr_rules['email']                     = "required|email";

        

        $validator = validator::make($request->all(),$arr_rules);



        if($validator->fails())

        {

            if($validator->errors())

            {

                $arr_resp_data['error'] = $validator->errors()->first(); 

            }

            $arr_response['status'] = 'ERROR';

            $arr_response['msg']    = $arr_resp_data;

            $arr_response['data']   = [];

            return $arr_response;

        }

        

        if($arr_data['email'] !="")

        {

            $user_obj = $this->CustomerModel->where('email',$arr_data['email'])->first();

            if($user_obj)

            {  

                $user_exist = $user_obj->toArray();

                if(isset($user_exist))

                {  

                    // $token = JWTAuth::fromUser($user_obj);

                    $token = $this->generate_forgot_password_token_code();

                    $arr_data['full_name']              = isset($user_exist['full_name'])? $user_exist['full_name'] : "";

                    $arr_data['email_template_id']      = '3';

                    $arr_data['verification_token']     = $token;

                    $arr_data['verification_url']       = '<a href="'.url('/user/password_set').'/'.$token.'">Link</a>'; //Front end set password link

                    

                    $res_email = $this->MailService->send_forget_password_email_for_api($arr_data);

                    $res_update = $this->CustomerModel->where('email',$arr_data['email'])->update(array('remember_token'=>$arr_data['verification_token']));



                    if($res_email)

                    {

                        $arr_responce['status'] = 'success';

                        $arr_responce['msg']    = 'Please check your email for link to reset password.';

                        $arr_responce['data']   = [];

                        return $arr_responce; 

                    }

                    $arr_responce['status'] = 'error';

                    $arr_responce['msg']    = 'Error while sending link.';

                    $arr_responce['data']   = [];

                    return $arr_responce;

                }            

            }



            $arr_responce['status'] = 'error';

            $arr_responce['msg']    = 'Sorry, email id not exists';

            $arr_responce['data']   = [];

            return $arr_responce;

        }

    }



    public function logout(Request $request)

    {

        $this->auth->logout();



        $arr_responce['status'] = 'SUCCESS';

        $arr_responce['msg']    = 'Logout.';

        $arr_responce['data']   = [];

        return $arr_responce;   

    }



    public function verify_user(Request $request,$email,$token)

    { 

        $arr_data = $arr_response = $arr_rules = $arr_resp_data = [];





        $check_email          = base64_decode($email);

        $check_token          = base64_decode($token);

        // dd($check_email,$check_token);

        $obj_check = $this->CustomerModel->where('email',$check_email)->where('token_code',$check_token)->first();



        if($obj_check)

        {



            $arr_data['is_verified']            = '1';

            $arr_data['is_email_verified']      = '1';

            $arr_data['status']                 = '1';

            

            $this->CustomerModel->where('id',$obj_check->id)->update($arr_data);



            $arr_response['status']          = 'SUCCESS';

            $arr_response['msg']             = 'Account verified successfully.';

            $arr_response['data']   =  [];



            return $arr_response;

        }

        else

        {

            

            $arr_response['status'] = 'ERROR';

            $arr_response['msg']    = 'Oops! Something went wrong';

            $arr_response['data']   =  [];

            return $arr_response;

        }



        $arr_response['status'] = 'ERROR';

        $arr_response['msg']    = 'Oops! Something went wrong';

        $arr_response['data']   =  [];

        return $arr_response;

    }





     // Check Token for set password (Angular) AUTHOR : HARSH CHAUHAN

    public function check_token(Request $request)

    {

        $arr_data = $arr_response = $arr_rules = $arr_resp_data = [];



        $arr_rules['token']  = "required";



        $validator  = Validator::make($request->all(),$arr_rules);



        if($validator->fails()) 

        {

            $msg        = "Validation Error, Please fill up the all mandatory fields";

            if($validator->errors()) 

            {

                $arr_response_data['error'] = $validator->errors()->first();

            }

            $arr_response['status']   = 'ERROR';

            $arr_response['msg']      = $msg;

            $arr_response['data']     = $arr_response_data;

            return $arr_response;

        }



        $password_reset_token          = $request->input('token');



        $status         = $this->CustomerModel->where('remember_token',$password_reset_token)->first();



        if($status){



                $arr_response['status']   = 'SUCCESS';

                $arr_response['msg']      = 'Token matched successfully.';

                return $arr_response;

        }else{



            $arr_response['status']   = 'ERROR';

            $arr_response['msg']      = 'Invalid Token.';

            return $arr_response;

        }



        $arr_response['status']   = 'ERROR';

        $arr_response['msg']      = 'Oops! Something went wrong.';

        return $arr_response;

    }





    // Forget password? set password through token (AUTHOR : HARSH CHAUHAN)

    public function set_forget_password(Request $request)

    {

        $arr_data = $arr_response = $arr_rules = $arr_resp_data = [];



        $arr_rules['password_reset_token']  = "required";

        $arr_rules['password']              = "required";



        $validator  = Validator::make($request->all(),$arr_rules);



        if($validator->fails()) 

        {

            $msg        = "Validation Error, Please fill up the all mandatory fields";

            if($validator->errors()) 

            {

                $arr_response_data['error'] = $validator->errors()->first();

            }



            $arr_response['status']   = 'ERROR';

            $arr_response['msg']      = $msg;

            $arr_response['data']     = $arr_response_data;

            return $arr_response;

        }



        $password_reset_token          = $request->input('password_reset_token');

        $password                      = $request->input('password');



        $status         = $this->CustomerModel->where('remember_token',$password_reset_token)->first();



        if($status){



            $hash_password   = isset($password) ? Hash::make($password): '';



            $obj_data        = $this->CustomerModel->where('remember_token', $password_reset_token)->update([

                                                                                'password'=>$hash_password,

                                                                                'remember_token'=>''

                                                                            ]);

            if($obj_data){



                $arr_response['status']   = 'SUCCESS';

                $arr_response['msg']      = 'Password changed successfully.';

                return $arr_response;

                

            }else{

                $arr_response['status']   = 'ERROR';

                $arr_response['msg']      = 'Something went wrong.';

                return $arr_response;

            }



        }else{



            $arr_response['status']   = 'ERROR';

            $arr_response['msg']      = 'Invalid password token';

            return $arr_response;

        }



        $arr_response['status']   = 'ERROR';

        $arr_response['msg']      = 'Oops! Something went wrong.';

        return $arr_response;

    }





}



