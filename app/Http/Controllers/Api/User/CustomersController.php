<?php



namespace App\Http\Controllers\Api\User;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use App\Common\Services\Authservice;

use App\Common\Services\MailService;

use App\Models\CustomerModel;

use App\Models\CountryModel;

use App\Models\OrdersModel;

use App\Models\PrintingOrderDetailsModel;

use App\Models\CustomerAddressModel;

use App\Models\ReferEarnModel;

use App\Models\CartModel;

use App\Models\CustomerGroupsModel;

use JWTAuth;

use Hash;

use Validator;

use Carbon\Carbon;





class CustomersController extends Controller

{

    public function __construct()

    {

        $this->CustomerModel                = new CustomerModel();

        $this->CountryModel                 = new CountryModel();

        $this->OrdersModel                  = new OrdersModel();

        $this->PrintingOrderDetailsModel    = new PrintingOrderDetailsModel();

        $this->CustomerAddressModel         = new CustomerAddressModel();

        $this->ReferEarnModel               = new ReferEarnModel();

        $this->CustomerGroupsModel          = new CustomerGroupsModel();

        $this->CartModel          = new CartModel();

        $this->MailService                  = new MailService();

        $this->auth                         = auth()->guard('api_user');

        $this->user                         = $this->auth->user();



        $this->user_profile_image_base_img_path   = base_path().config('app.project.img_path.user_profile_image');

        $this->user_profile_image_public_img_path = url('/').config('app.project.img_path.user_profile_image');



        $this->orders_file_base_file_path   = base_path().config('app.project.file_path.orders_file');

        $this->orders_file_public_file_path = url('/').config('app.project.file_path.orders_file');

    }

    



    //my profile detaul view  : AUTHOR (Akshay Ugale)

    public function profile_detail(Request $request)

    {

        $arr_user_detail= [];



        $obj_data = $this->CustomerModel->where('id',$this->user->id)->first();

        

        if($obj_data){



            $arr_data = $obj_data->toArray();



            $arr_resp['id']                                 = isset($arr_data['id']) ?  $arr_data['id']: '';

            $arr_resp['full_name']                          = isset($arr_data['full_name']) ?  $arr_data['full_name']: '';

            $arr_resp['gender']                             = isset($arr_data['gender']) ?  $arr_data['gender']: '';

            $arr_resp['country_code_id']                      = isset($arr_data['country_code_id']) ?  $arr_data['country_code_id']: '';

            $arr_resp['country_code_flag']                      = isset($arr_data['country_code_flag']) ?  $arr_data['country_code_flag']: '';

            $arr_resp['mobile_number']                      = isset($arr_data['mobile_number']) ?  $arr_data['mobile_number']: '';

            $arr_resp['email']                              = isset($arr_data['email']) ?  $arr_data['email']: '';





            $arr_response_data['data']     = $arr_resp;





            $arr_response['status'] =  'SUCCESS';

            $arr_response['msg']    =  'Customer data displayed successfully.';

            $arr_response['data']   =  $arr_response_data['data'];

            return $arr_response;



        }else{

            $arr_response['status'] =  'ERROR';

            $arr_response['msg']    =  'No Customer found.';

            $arr_response['data']   =  [];



            return $arr_response;

        }



        $arr_response['status'] =  'ERROR';

        $arr_response['msg']    =  'Oops! Something went wrong.';

        $arr_response['data']   =  [];



        return $arr_response;

    }

    

    //dashboard data api  : AUTHOR (Akshay Ugale)

    public function dashboard_data(Request $request)

    {

        $arr_rule  = $arr_user_detail = $arr_latest_7_order = $arr_pending_orders = $arr_orders =[];

        $all_orders_count   = 0;

        $on_progress_orders_count = 165;

        $my_balance = 850;



        $obj_all_orders = $this->OrdersModel->where('customer_id','=',$this->user->id)

                                            ->orderBy('created_at','desc')

                                            ->take(7)

                                            ->get();

        if($obj_all_orders)

        {

            $arr_latest_7_order    = $obj_all_orders->toArray();

        }

        

        $all_orders_count = $this->OrdersModel->where('customer_id','=',$this->user->id)->count();

        

        $cart_count = $this->CartModel->where('customer_id','=',$this->user->id)->count();

        

        $user_obj = $this->CustomerModel->where('id',$this->user->id)->first();

        if($user_obj)

        {

            $key=1;

            $arr_data = $user_obj->toArray();

            if(isset($arr_data['profile_image']) && $arr_data['profile_image']!=null)

            {

                $profile_img = $this->user_profile_image_public_img_path.$arr_data['profile_image'];

            }

            else

            {

                $profile_img = $this->user_profile_image_public_img_path.'default.jpg';

            }

            $arr_resp['id']                                 = isset($arr_data['id']) ?  $arr_data['id']: '';

            $arr_resp['full_name']                          = isset($arr_data['full_name']) ?  $arr_data['full_name']: '';

            $arr_resp['email']                              = isset($arr_data['email']) ?  $arr_data['email']: '';

            $arr_resp['country_code_id']                    = isset($arr_data['country_code_id']) ?  $arr_data['country_code_id']: '';

            $arr_resp['mobile_number']                      = isset($arr_data['mobile_number']) ?  $arr_data['mobile_number']: '';

            $arr_resp['user_profile_image_public_img_path'] = $profile_img;





            $arr_resp['all_orders_count'] = $all_orders_count;

            $arr_resp['cart_count'] = $cart_count;

            $arr_resp['on_progress_orders_count'] = $on_progress_orders_count;

            $arr_resp['my_balance'] = $my_balance;



            foreach ($arr_latest_7_order as $key => $latest_7_orders) 

            {

                $arr_latest_7_order[$key]['sr_no']                = $key+1;

                $arr_latest_7_order[$key]['order_id']             = isset($latest_7_orders['order_id']) ?  $latest_7_orders['order_id']: '';

                $arr_latest_7_order[$key]['order_total_amount']   = isset($latest_7_orders['order_total_amount']) ?  $latest_7_orders['order_total_amount']: '';

                $arr_latest_7_order[$key]['date']                 = isset($latest_7_orders['created_at']) ?  date('d-M-Y',strtotime($latest_7_orders['created_at'])): '';

                $arr_latest_7_order[$key]['printing_status']      = isset($latest_7_orders['printing_status']) ?  $latest_7_orders['printing_status']: '';

                $arr_latest_7_order[$key]['delivery_status']      = isset($latest_7_orders['delivery_status']) ?  $latest_7_orders['delivery_status']: '';

                $key = $key+1;

              

            }



            $arr_resp['arr_latest_7_orders']= $arr_latest_7_order;

            // dd($arr_resp);

            $arr_response_data['data']     = $arr_resp;





            $arr_response['status'] =  'SUCCESS';

            $arr_response['msg']    =  'Dashboard data displayed successfully.';

            $arr_response['data']   =  $arr_response_data['data'];

            return $arr_response;



        }else{



            $arr_response['status'] =  'ERROR';

            $arr_response['msg']    =  'No Categories found.';

            $arr_response['data']   =  [];



            return $arr_response;

        }



        $arr_response['status'] =  'ERROR';

        $arr_response['msg']    =  'Oops! Something went wrong.';

        $arr_response['data']   =  [];



        return $arr_response;

    }

    //my orders listing api  : AUTHOR (Akshay Ugale)

    public function my_orders(Request $request)

    {

        $arr_rule  = $arr_user_detail = $arr_all_orders = $arr_pending_orders= $arr_orders =  [];



        $obj_all_orders = $this->OrdersModel->where('customer_id','=',$this->user->id)

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

    //items view api  : AUTHOR (Akshay Ugale)

    public function items_view(Request $request)

    {

        $arr_rule  = $arr_item_view = [];

        $english_option = $arabic_option='';

        $obj_all_orders = $this->OrdersModel->where('customer_id','=',$this->user->id)

                                            ->with('get_city')

                                            ->get();



        if($obj_all_orders)

        {

            $arr_all_orders = $obj_all_orders->toArray();

            foreach ($arr_all_orders as $key => $orders) 

            {

                $english_option = $arabic_option ='';

                $obj_all_orders  = $this->PrintingOrderDetailsModel->with('get_order_details','get_product_details','get_agent_details')

                                                                    ->with(['get_productoption_selected'=>function($q){

                                                                        $q->with('get_option_details');

                                                                    }]) 

                                                                    ->where('order_id',$orders['id'])

                                                                    ->orderBy('created_at','DESC')

                                                                    ->first();



                if($obj_all_orders)

                {

                    $arr_order_detail = $obj_all_orders->toArray();

                }

                $arr_orders[$key]['sr_no']                = $key+1;

                $arr_orders[$key]['order_id']             = isset($orders['order_id']) ?  $orders['order_id']: '';

                $arr_orders[$key]['item_id']              = 7984564;

                $arr_orders[$key]['quantity']             = isset($arr_order_detail['quantity']) ?  $arr_order_detail['quantity']: '';

                $arr_orders[$key]['order_total_amount']   = isset($arr_order_detail['get_order_details']['order_total_amount']) ? $arr_order_detail['get_order_details']['order_total_amount']: '';

                $arr_orders[$key]['rate']                 = isset($orders['Rate']) ?  $orders['Rate']: 'Rate';

                $arr_orders[$key]['time']                 = isset($orders['created_at']) ?  date('d-m-Y h:i A',strtotime($orders['created_at'])): ''; 

                $arr_orders[$key]['product_english_name'] = isset($arr_order_detail['get_product_details']['product_english_name']) ?  $arr_order_detail['get_product_details']['product_english_name']: '';

                $arr_orders[$key]['product_arabic_name']  = isset($arr_order_detail['get_product_details']['product_arabic_name']) ?  $arr_order_detail['get_product_details']['product_arabic_name']: '';

                if($arr_order_detail['get_productoption_selected'])

                {

                    foreach($arr_order_detail['get_productoption_selected'] as $order_option)

                    {

                        $english_option .=  isset($order_option['get_option_details']['english_name']) ?  $order_option['get_option_details']['english_name'].',': '-,';

                        $arabic_option  .=  isset($order_option['get_option_details']['arabic_name']) ?  $order_option['get_option_details']['arabic_name'].',': '-,';

                    }

                }

                $arr_orders[$key]['english_option']        = substr($english_option, 0, -1);

                $arr_orders[$key]['arabic_option']         = substr($arabic_option, 0, -1);



                if(isset($arr_order_detail['file']) && $arr_order_detail['file']!='' && file_exists($this->orders_file_base_file_path.$arr_order_detail['file']))

                {

                    $file = $this->orders_file_public_file_path.$arr_order_detail['file'];

                }

                else

                {

                    $file = $this->orders_file_public_file_path.'default.pdf';

                }

                $arr_orders[$key]['file']                  = $file;

            }

            $arr_response_data['data']     = $arr_orders;



            $arr_response['status'] =  'SUCCESS';

            $arr_response['msg']    =  'Items data displayed successfully.';

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



    //edit account setting  : AUTHOR (Akshay Ugale)

    public function account_setting(Request $request)

    {

        $arr_rule  = $arr_user_detail = $arr_data = [];



        $obj_data = $this->CustomerModel->where('id','=',$this->user->id)->with('get_country_details','get_city_details','get_country_code_details')->first();

        if($obj_data)

        {

            $arr_data = $obj_data->toArray();

            // dd($arr_data);

            $arr_resp['full_name']              = isset($obj_data->full_name)?ucfirst($obj_data->full_name):'';

            $arr_resp['email']                  = isset($obj_data->email)?($obj_data->email):'';

            $arr_resp['country_code_id']        = isset($obj_data->country_code_id)?($obj_data->country_code_id):'';

            $arr_resp['country_name']           = isset($obj_data->get_country_code_details->name)?($obj_data->get_country_code_details->name):'';

            $arr_resp['country_short_name']     = isset($obj_data->get_country_code_details->short_name)?($obj_data->get_country_code_details->short_name):'';

            $arr_resp['country_code']           = isset($obj_data->get_country_code_details->country_code)?($obj_data->get_country_code_details->country_code):'';

            $arr_resp['country_code_flag']          = isset($obj_data->country_code_flag)?($obj_data->country_code_flag):'';

            $arr_resp['mobile_number']          = isset($obj_data->mobile_number)?($obj_data->mobile_number):'';

            $arr_resp['gender']                 = isset($obj_data->gender)?($obj_data->gender):'';

            $arr_resp['country_id']             = isset($obj_data->country_id)?($obj_data->country_id):'';

            $arr_resp['country_index_id']       = isset($obj_data->get_country_details->country_id)?($obj_data->get_country_details->country_id):'';

            $arr_resp['country_english_name']   = isset($obj_data->get_country_details->country_english_name)?($obj_data->get_country_details->country_english_name):'';

            $arr_resp['country_arabic_name']    = isset($obj_data->get_country_details->country_arabic_name)?($obj_data->get_country_details->country_arabic_name):'';

            $arr_resp['city_id']                = isset($obj_data->city_id)?($obj_data->city_id):'';

            $arr_resp['city_index_id']          = isset($obj_data->get_city_details->city_id)?($obj_data->get_city_details->city_id):'';

            $arr_resp['city_english_name']      = isset($obj_data->get_city_details->city_english_name)?($obj_data->get_city_details->city_english_name):'';

            $arr_resp['city_arabic_name']       = isset($obj_data->get_city_details->city_arabic_name)?($obj_data->get_city_details->city_arabic_name):'';

            $arr_resp['address']                = isset($obj_data->address)?($obj_data->address):'';

            $arr_resp['email_language']         = isset($obj_data->email_language)?($obj_data->email_language):'';



            $arr_response_data['data']     = $arr_resp;



            $arr_response['status'] =  'SUCCESS';

            $arr_response['msg']    =  'Account setting  data displayed successfully.';

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

    //update account setting  : AUTHOR (Akshay Ugale)

    public function update_account_setting(Request $request)

    {

        $arr_data =[];

        $arr_rule = [];

        $arr_rule['full_name']          = "required";

        // $arr_rule['email']              = "required";

        // $arr_rule['country_code_id']    = "required";

        $arr_rule['gender']             = "required";

        $arr_rule['country_id']         = "required";

        $arr_rule['city_id']            = "required";

        $arr_rule['address']            = "required";

        $arr_rule['email_language']     = "required";



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

        $full_name          = $request->input('full_name');

        // $email              = $request->input('email');

        // $country_code_id    = $request->input('country_code_id');

        $gender             = $request->input('gender');

        $country_id         = $request->input('country_id');

        $city_id            = $request->input('city_id');

        $address            = $request->input('address');

        $email_language     = $request->input('email_language');



    

        $arr_data['full_name']          = $full_name;

        // $arr_data['email']              = $email;

        // $arr_data['country_code_id']    = $country_code_id;

        $arr_data['gender']             = $gender;

        $arr_data['country_id']         = $country_id;

        $arr_data['city_id']            = $city_id;

        $arr_data['address']            = $address;

        $arr_data['email_language']     = $email_language;

        // dd($arr_data);

        $user_obj = $this->CustomerModel->where('id',$this->user->id)->update($arr_data);

    

        if($user_obj){

            $arr_responce['status'] = 'SUCCESS';

            $arr_responce['msg']    = 'Account settings updated successfully.';

            return $arr_responce;            

        }else{

            $arr_responce['status'] = 'ERROR';

            $arr_responce['msg']    = 'Oops,Something went wrong,please try again later.';

            return $arr_responce;

        }



    }



    // Update account password : AUTHOR (Harsh Chauhan)

     public function change_password(Request $request)

    {

        $arr_rule = [];



        $arr_rule['old_password']  = "required";

        $arr_rule['new_password']  = "required";



        $validator = Validator::make($request->all(), $arr_rule);



        if($validator->fails())

        {

            $arr_responce['status'] = 'error';

            $arr_responce['msg']    = 'Please fill all the required field.';

            $arr_responce['data']   = [];



            if($validator->errors())

            {

                $arr_responce['msg'] = $validator->errors()->first();

            }

            

            return $arr_responce;

        }



        $user_id        = $this->user->id;

        $old_password   = $request->input('old_password');

        $new_password   = $request->input('new_password');



        $user_obj = $this->CustomerModel->where('id',$user_id)->first();

        if($user_obj)

        {

            if(Hash::check($old_password,$this->auth->user()->password))

            {

                if($old_password != $new_password)

                {  //dd($new_password);

                    $new_password = hash::make($new_password);

                    $resupdate = $this->CustomerModel->where('id',$user_id)->update(['password' => $new_password]);

                    if($resupdate)

                    {

                        $arr_responce['status'] = 'SUCCESS';

                        $arr_responce['msg']    = 'Your password changed successfully';

                        $arr_responce['data']   = [];

                        return $arr_responce;   

                    }

                    $arr_responce['status'] = 'ERROR';

                    $arr_responce['msg']    = 'Error while updating password.';

                    $arr_responce['data']   = [];

                    return $arr_responce;



                }

                $arr_responce['status'] = 'ERROR';

                $arr_responce['msg']    = 'Sorry you can not use current password as a new password, Please enter another new password';

                $arr_responce['data']   = [];

                return $arr_responce;

            }else{

                $arr_responce['status'] = 'ERROR';

                $arr_responce['msg']    = 'Invalid old password, Please try again.';

                $arr_responce['data']   = [];

                return $arr_responce;

            }

        }

        $arr_responce['status'] = 'ERROR';

        $arr_responce['msg']    = 'Oops,Something went wrong,please try again later.';

        $arr_responce['data']   = [];

        return $arr_responce;

    }



      // Check old account password : AUTHOR (Harsh Chauhan)

     public function check_old_password(Request $request)

    {

        $arr_rule = [];



        $arr_rule['password']  = "required";



        $validator = Validator::make($request->all(), $arr_rule);



        if($validator->fails())

        {

            $arr_responce['status'] = 'error';

            $arr_responce['msg']    = 'Please fill all the required field.';

            $arr_responce['data']   = [];



            if($validator->errors())

            {

                $arr_responce['msg'] = $validator->errors()->first();

            }

            

            return $arr_responce;

        }



        $user_id        = $this->user->id;

        $old_password   = $request->input('password');



        $user_obj = $this->CustomerModel->where('id',$user_id)->first();

        if($user_obj)

        {

            if(Hash::check($old_password,$this->auth->user()->password))

            {

             

                $arr_responce['status'] = 'SUCCESS';

                $arr_responce['msg']    = 'Correct old password.';

                $arr_responce['data']   = [];

                return $arr_responce;

            }else{

                $arr_responce['status'] = 'ERROR';

                $arr_responce['msg']    = 'Invalid old password, Please enter correct password';

                $arr_responce['data']   = [];

                return $arr_responce;

            }

        }

        $arr_responce['status'] = 'error';

        $arr_responce['msg']    = 'Oops,Something went wrong,please try again later.';

        $arr_responce['data']   = [];

        return $arr_responce;

    }



    //all address api listing  : AUTHOR (Akshay Ugale)

    public function get_addresses(Request $request)

    {

        $arr_rule  = [];

        $english_option     = $arabic_option='';

        $obj_all_address    = $this->CustomerAddressModel->where('customer_id','=',$this->user->id)

                                                         ->with('get_customer_detail','get_country_details','get_city_details')

                                                         ->get();

        

        if($obj_all_address)

        {

            $arr_all_address = $obj_all_address->toArray();

            if(sizeof($arr_all_address)>0){

                foreach ($arr_all_address as $key => $address) 

                {

                    $arr_address[$key]['sr_no']                 = $key+1;

                    $arr_address[$key]['address_id']            = isset($address['id']) ?  $address['id']: '';

                    $arr_address[$key]['customer_id']           = isset($address['customer_id']) ?  $address['customer_id']: '';

                 

                    $arr_address[$key]['address']               = isset($address['address']) ?  $address['address']: '';

                    $arr_address[$key]['zipcode']               = isset($address['zipcode']) ?  $address['zipcode']: '';

                    $arr_address[$key]['customer_index_id']     = isset($address['get_customer_detail']['customer_id']) ?  $address['get_customer_detail']['customer_id']: '';

                    // $arr_address[$key]['customer_full_name']    = isset($address['get_customer_detail']['full_name']) ?  $address['get_customer_detail']['full_name']: '';

                    // $arr_address[$key]['customer_email']        = isset($address['get_customer_detail']['email']) ?  $address['get_customer_detail']['email']: '';

                    $arr_address[$key]['country_id']            = isset($address['country_id']) ?  $address['country_id']: '';

                    $arr_address[$key]['country_index_id']      = isset($address['get_country_details']['country_id']) ?  $address['get_country_details']['country_id']: '';

                    $arr_address[$key]['country_english_name']  = isset($address['get_country_details']['country_english_name']) ?  $address['get_country_details']['country_english_name']: '';

                    $arr_address[$key]['country_arabic_name']   = isset($address['get_country_details']['country_arabic_name']) ?  $address['get_country_details']['country_arabic_name']: '';

                    $arr_address[$key]['city_id']               = isset($address['city_id']) ?  $address['city_id']: '';

                    $arr_address[$key]['city_index_id']         = isset($address['get_city_details']['city_id']) ?  $address['get_city_details']['city_id']: '';

                    $arr_address[$key]['city_english_name']     = isset($address['get_city_details']['city_english_name']) ?  $address['get_city_details']['city_english_name']: '';

                    $arr_address[$key]['city_arabic_name']      = isset($address['get_city_details']['city_arabic_name']) ?  $address['get_city_details']['city_arabic_name']: '';

                    $arr_address[$key]['full_name']             = isset($address['full_name']) ?  $address['full_name']: '';

                    $arr_address[$key]['country_code']               = isset($address['country_code']) ?  $address['country_code']: '';

                    $arr_address[$key]['country_code_flag']               = isset($address['country_code_flag']) ?  $address['country_code_flag']: '';

                    $arr_address[$key]['contact']               = isset($address['contact']) ?  $address['contact']: '';

                    $arr_address[$key]['email']                 = isset($address['email']) ?  $address['email']: '';

                }

                if(isset($arr_address))

                {

                    $arr_response_data['data']     = $arr_address;

                }

                else

                {

                    $arr_response_data['data']     = [];

                }

                $arr_response['status'] =  'SUCCESS';

                $arr_response['msg']    =  'Address data displayed successfully.';

                $arr_response['data']   =  $arr_response_data['data'];

                return $arr_response;

            }

            else{

                $arr_response['status'] =  'ERROR';

                $arr_response['msg']    =  'No Data Found.';

                $arr_response['data']   =  [];

                return $arr_response;

            }

        }

        $arr_response['status'] =  'ERROR';

        $arr_response['msg']    =  'Oops! Something went wrong.';

        $arr_response['data']   =  [];



        return $arr_response;

        

    }

    

     //all address api listing  : AUTHOR (Akshay Ugale)

    public function get_address_details(Request $request)

    {

        $arr_rule  = [];

        

        $arr_rule['address_id']  = "required";



        $validator = Validator::make($request->all(), $arr_rule);



        if($validator->fails())

        {

            $arr_responce['status'] = 'error';

            $arr_responce['msg']    = 'Please fill all the required field.';

            $arr_responce['data']   = [];



            if($validator->errors())

            {

                $arr_responce['msg'] = $validator->errors()->first();

            }

            

            return $arr_responce;

        }

        $english_option     = $arabic_option='';

        

        $address_id = $request->input('address_id');

        

        $obj_all_address    = $this->CustomerAddressModel->where('id','=',$address_id)

                                                         ->with('get_customer_detail')

                                                         ->with(['get_country_details'=>function($q){

                                                             $q->with('get_aramex_details');

                                                         }])

                                                         ->with(['get_city_details'=>function($q){

                                                             $q->with('get_aramex_details');

                                                         }])

                                                         ->first();

        

        if($obj_all_address)

        {

            $address = $obj_all_address->toArray();

            // dd($address);

            if(sizeof($address)>0){

                

                    $arr_address['address_id']            = isset($address['id']) ?  $address['id']: '';

                    $arr_address['customer_id']           = isset($address['customer_id']) ?  $address['customer_id']: '';

                    $arr_address['address']               = isset($address['address']) ?  $address['address']: '';

                    $arr_address['zipcode']               = isset($address['zipcode']) ?  $address['zipcode']: '';

                    $arr_address['customer_index_id']     = isset($address['get_customer_detail']['customer_id']) ?  $address['get_customer_detail']['customer_id']: '';

                    // $arr_address['customer_full_name']    = isset($address['get_customer_detail']['full_name']) ?  $address['get_customer_detail']['full_name']: '';

                    // $arr_address['customer_email']        = isset($address['get_customer_detail']['email']) ?  $address['get_customer_detail']['email']: '';

                    $arr_address['country_id']            = isset($address['country_id']) ?  $address['country_id']: '';

                    $arr_address['country_index_id']      = isset($address['get_country_details']['country_id']) ?  $address['get_country_details']['country_id']: '';

                    $arr_address['country_english_name']  = isset($address['get_country_details']['country_english_name']) ?  $address['get_country_details']['country_english_name']: '';

                    $arr_address['country_arabic_name']   = isset($address['get_country_details']['country_arabic_name']) ?  $address['get_country_details']['country_arabic_name']: '';

                    $arr_address['aramex_country_id']   = isset($address['get_country_details']['get_aramex_details']['id']) ?  $address['get_country_details']['get_aramex_details']['id']: '';

                    $arr_address['aramex_country_code']   = isset($address['get_country_details']['get_aramex_details']['country_code']) ?  $address['get_country_details']['get_aramex_details']['country_code']: '';

                    

                    $arr_address['city_id']               = isset($address['city_id']) ?  $address['city_id']: '';

                    $arr_address['city_index_id']         = isset($address['get_city_details']['city_id']) ?  $address['get_city_details']['city_id']: '';

                    $arr_address['city_english_name']     = isset($address['get_city_details']['city_english_name']) ?  $address['get_city_details']['city_english_name']: '';

                    $arr_address['city_arabic_name']      = isset($address['get_city_details']['city_arabic_name']) ?  $address['get_city_details']['city_arabic_name']: '';

                    $arr_address['aramex_city_id']        = isset($address['get_city_details']['get_aramex_details']['id']) ?  $address['get_city_details']['get_aramex_details']['id']: '';

                    $arr_address['aramex_city_code']        = isset($address['get_city_details']['get_aramex_details']['aramexName']) ?  $address['get_city_details']['get_aramex_details']['aramexName']: '';

                    $arr_address['full_name']             = isset($address['full_name']) ?  $address['full_name']: '';

                    $arr_address['contact']               = isset($address['contact']) ?  $address['contact']: '';

                    $arr_address['country_code']          = isset($address['country_code']) ?  $address['country_code']: '';

                    $arr_address['country_code_flag']     = isset($address['country_code_flag']) ?  $address['country_code_flag']: '';

                    $arr_address['email']                 = isset($address['email']) ?  $address['email']: '';

                if(isset($arr_address))

                {

                    $arr_response_data['data']     = $arr_address;

                }

                else

                {

                    $arr_response_data['data']     = [];

                }

                $arr_response['status'] =  'SUCCESS';

                $arr_response['msg']    =  'Address data displayed successfully.';

                $arr_response['data']   =  $arr_response_data['data'];

                return $arr_response;

            }

            else{

                $arr_response['status'] =  'ERROR';

                $arr_response['msg']    =  'No Data Found.';

                $arr_response['data']   =  [];

                return $arr_response;

            }

        }

        $arr_response['status'] =  'ERROR';

        $arr_response['msg']    =  'Oops! Something went wrong.';

        $arr_response['data']   =  [];



        return $arr_response;

        

    }



    //store customer new address  : AUTHOR (Akshay Ugale)

    public function store_address(Request $request)

    {

        $arr_data =[];

        $arr_rule = [];



        $arr_rule['country_id']             = "required|numeric";

        $arr_rule['city_id']                = "required|numeric";

        $arr_rule['address']                = "required";

        // $arr_rule['zipcode']                = "required";



    // dd($request->all());

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

        $country_id             = $request->input('country_id');

        $city_id                = $request->input('city_id');

        $address                = $request->input('address');

        $zipcode                = $request->input('zipcode',null);

        $full_name              = $request->input('full_name',null);

        $contact                = $request->input('contact',null);

        $email                  = $request->input('email',null);

        $country_code           = $request->input('country_code',null);

        $country_code_flag           = $request->input('country_code_flag',null);



        $arr_data['customer_id']            = $this->user->id;

        $arr_data['country_id']             = $country_id;

        $arr_data['city_id']                = $city_id;

        $arr_data['address']                = $address;

        $arr_data['zipcode']                = $zipcode;

        $arr_data['full_name']              = $full_name;

        $arr_data['country_code']           = $country_code;

        $arr_data['contact']                = $contact;

        $arr_data['email']                  = $email;

        $arr_data['country_code_flag']      = $country_code_flag;

        // dd($arr_data);

        $create = $this->CustomerAddressModel->create($arr_data);

        if($create)

        {

            

            $arr_responce['status'] = 'SUCCESS';

            $arr_responce['msg']    = 'Customer Address created successfully.';

            $arr_responce['data']   = [];

            return $arr_responce;

        }

        $arr_responce['status'] = 'ERROR';

        $arr_responce['msg']    = 'Oops,Something went wrong,please try again later.';

        $arr_responce['data']   = [];

        return $arr_responce;

    }



    //get editable  address data  : AUTHOR (Akshay Ugale)

    public function edit_address(Request $request)

    {

        $arr_data = $arr_rule = [];

        $arr_rule['address_id']             = "required";

        $validator = Validator::make($request->all(), $arr_rule);



        if($validator->fails()){

            $arr_responce['status'] = 'ERROR';

            $arr_responce['msg']    = 'Please fill all the required field.';

            $arr_responce['data']   = [];



            if($validator->errors()){

                $arr_responce['msg'] =$validator->errors()->first();

            }

            

            return $arr_responce;

        }

        $address_id                = $request->input('address_id');

        if(is_numeric($address_id)){

            $obj_data = $this->CustomerAddressModel->where('id','=',$address_id)

                                                    ->with('get_customer_detail','get_country_details','get_city_details')

                                                    ->first();

            if($obj_data){

                $arr_data = $obj_data->toArray();

                // dd($arr_data);

                $arr_resp['id']                    = isset($arr_data['id']) ?  $arr_data['id']: '';

                $arr_resp['address']               = isset($arr_data['address']) ?  $arr_data['address']: '';

                $arr_resp['zipcode']               = isset($arr_data['zipcode']) ?  $arr_data['zipcode']: '';

                $arr_resp['country_id']            = isset($arr_data['country_id']) ?  $arr_data['country_id']: '';

                $arr_resp['country_index_id']      = isset($arr_data['get_country_details']['country_id']) ?  $arr_data['get_country_details']['country_id']: '';

                $arr_resp['country_english_name']  = isset($arr_data['get_country_details']['country_english_name']) ?  $arr_data['get_country_details']['country_english_name']: '';

                $arr_resp['country_arabic_name']   = isset($arr_data['get_country_details']['country_arabic_name']) ?  $arr_data['get_country_details']['country_arabic_name']: '';

                $arr_resp['city_id']               = isset($arr_data['city_id']) ?  $arr_data['city_id']: '';

                $arr_resp['city_index_id']         = isset($arr_data['get_city_details']['city_id']) ?  $arr_data['get_city_details']['city_id']: '';

                $arr_resp['city_english_name']     = isset($arr_data['get_city_details']['city_english_name']) ?  $arr_data['get_city_details']['city_english_name']: '';

                $arr_resp['city_arabic_name']      = isset($arr_data['get_city_details']['city_arabic_name']) ?  $arr_data['get_city_details']['city_arabic_name']: '';

                $arr_resp['full_name']             = isset($arr_data['full_name']) ?  $arr_data['full_name']: '';

                $arr_resp['country_code']             = isset($arr_data['country_code']) ?  $arr_data['country_code']: '';

                $arr_resp['country_code_flag']             = isset($arr_data['country_code_flag']) ?  $arr_data['country_code_flag']: '';

                $arr_resp['contact']               = isset($arr_data['contact']) ?  $arr_data['contact']: '';

                $arr_resp['email']                 = isset($arr_data['email']) ?  $arr_data['email']: '';

                

                $arr_responce['status'] = 'SUCCESS';

                $arr_responce['msg']    = 'Address data displayed successfully.';

                $arr_responce['data']   = $arr_resp;

                return $arr_responce;

            }

            else{

                $arr_responce['status'] = 'ERROR';

                $arr_responce['msg']    = 'Oops, No Record found.';

                $arr_responce['data']   = [];

                return $arr_responce;

            }

        }

        

        $arr_responce['status'] = 'ERROR';

        $arr_responce['msg']    = 'Oops,Something went wrong,please try again later.';

        $arr_responce['data']   = [];

        return $arr_responce;

    }

    //update specific address  : AUTHOR (Akshay Ugale)

    public function update_address(Request $request)

    {

        $arr_data = $arr_rule = [];

        $arr_rule['address_id']             = "required";

        $arr_rule['country_id']             = "required|numeric";

        $arr_rule['city_id']                = "required|numeric";

        $arr_rule['address']                = "required";

        // $arr_rule['zipcode']                = "required";

        $validator = Validator::make($request->all(), $arr_rule);



        if($validator->fails()){

            $arr_responce['status'] = 'ERROR';

            $arr_responce['msg']    = 'Please fill all the required field.';

            $arr_responce['data']   = [];



            if($validator->errors()){

                $arr_responce['msg'] =$validator->errors()->first();

            }

            

            return $arr_responce;

        }

        $address_id             = $request->input('address_id');

        $country_id             = $request->input('country_id');

        $city_id                = $request->input('city_id');

        $address                = $request->input('address');

        $zipcode                = $request->input('zipcode');

        $full_name              = $request->input('full_name',null);

        $country_code                = $request->input('country_code',null);

        $country_code_flag                = $request->input('country_code_flag',null);

        $contact                = $request->input('contact',null);

        $email                  = $request->input('email',null);



        $arr_data['country_id']             = $country_id;

        $arr_data['city_id']                = $city_id;

        $arr_data['address']                = $address;

        $arr_data['zipcode']                = $zipcode;

        $arr_data['full_name']              = $full_name;

        $arr_data['country_code']                = $country_code;

        $arr_data['country_code_flag']                = $country_code_flag;

        $arr_data['contact']                = $contact;

        $arr_data['email']                  = $email;

    

        if(is_numeric($address_id)){

            $update = $this->CustomerAddressModel->where('id','=',$address_id)->update($arr_data);

            if($update){



                $arr_responce['status'] = 'SUCCESS';

                $arr_responce['msg']    = 'Address data updated successfully.';

                $arr_responce['data']   = [];

                return $arr_responce;

            }

            else{

                $arr_responce['status'] = 'ERROR';

                $arr_responce['msg']    = 'Oops, error while updating customer address data.';

                $arr_responce['data']   = [];

                return $arr_responce;

            }

        }

        

        $arr_responce['status'] = 'ERROR';

        $arr_responce['msg']    = 'Oops,Something went wrong,please try again later.';

        $arr_responce['data']   = [];

        return $arr_responce;

    }



    //delete specific address  : AUTHOR (Akshay Ugale)

    public function delete_address(Request $request)

    {

        $arr_data = $arr_rule = [];

        $arr_rule['address_id']             = "required";

        $validator = Validator::make($request->all(), $arr_rule);



        if($validator->fails()){

            $arr_responce['status'] = 'ERROR';

            $arr_responce['msg']    = 'Please fill all the required field.';

            $arr_responce['data']   = [];



            if($validator->errors()){

                $arr_responce['msg'] =$validator->errors()->first();

            }

            

            return $arr_responce;

        }

        $address_id                = $request->input('address_id');

        if(is_numeric($address_id)){

            $delete = $this->CustomerAddressModel->where('id','=',$address_id)->delete();

            if($delete){

                $arr_responce['status'] = 'SUCCESS';

                $arr_responce['msg']    = 'Customer address deleted successfully.';

                $arr_responce['data']   = [];

                return $arr_responce;

            }

            else{

                $arr_responce['status'] = 'ERROR';

                $arr_responce['msg']    = 'Oops, Error while deleting Customer address.';

                $arr_responce['data']   = [];

                return $arr_responce;

            }

        }

        

        $arr_responce['status'] = 'ERROR';

        $arr_responce['msg']    = 'Oops,Something went wrong,please try again later.';

        $arr_responce['data']   = [];

        return $arr_responce;

    }

    //refer & earn  : AUTHOR (Akshay Ugale)

    public function refer_earn(Request $request)

    {

        $arr_data = [];

        $obj_data = $this->ReferEarnModel->where('referral_customer_id','=',$this->user->id)

                                                    ->with('get_customer_detail')

                                                    ->get();

        if($obj_data){

            $arr_data = $obj_data->toArray();

        }

        if(sizeof($arr_data)>0){

      

            foreach ($arr_data as $key => $value) 

            {

                // dd($value);

                $obj_customer_group                      = $this->CustomerGroupsModel->where('id','=',$value['get_customer_detail']['customer_group'])->first();



                $obj_first_order                         = $this->OrdersModel->where('id','=',$value['get_customer_detail']['id'])->first();

                

                $arr_resp[$key]['sr_no']                    = $key+1;

                $arr_resp[$key]['customer_id']              = isset($value['get_customer_detail']['id']) ?  $value['get_customer_detail']['id']: '';

                $arr_resp[$key]['encrypted_customer_id']    = isset($value['get_customer_detail']['id']) ?  base64_encode($value['get_customer_detail']['id']): '';

                $arr_resp[$key]['customer_name']            = isset($value['get_customer_detail']['full_name']) ?  $value['get_customer_detail']['full_name']: '';

                $arr_resp[$key]['customer_type']            = isset($obj_customer_group->group_name) ?  $obj_customer_group->group_name: '';

                $arr_resp[$key]['referral_status']          = isset($value['referral_status']) ?  $value['referral_status']: '';

                $arr_resp[$key]['first_order_date']         = isset($obj_first_order->created_at) ?  date('d-m-Y h:i A',strtotime($obj_first_order->created_at)): '';

                $arr_resp[$key]['total_earn']               = 105.00;

                $arr_resp[$key]['withdrawal']               = 285.00;

                $key = $key+1;

              

            }

            

            $arr_responce['status'] = 'SUCCESS';

            $arr_responce['msg']    = 'Refer & Earn data displayed successfully.';

            $arr_responce['data']   = $arr_resp;

            return $arr_responce;

        }

        

        else{

            $arr_responce['status'] = 'ERROR';

            $arr_responce['msg']    = 'Oops, No Record found.';

            $arr_responce['data']   = [];

            return $arr_responce;

        }

        

        $arr_responce['status'] = 'ERROR';

        $arr_responce['msg']    = 'Oops,Something went wrong,please try again later.';

        $arr_responce['data']   = [];

        return $arr_responce;

    }



     //update profile Image  : AUTHOR (Akshay Ugale)

    public function edit_profile_image(Request $request)

    {

        $arr_data = $arr_rule = [];

       

        $arr_rule['profile_image']             = "required";

       

        $validator = Validator::make($request->all(), $arr_rule);



        if($validator->fails()){

            $arr_responce['status'] = 'ERROR';

            $arr_responce['msg']    = 'Please fill all the required field.';

            $arr_responce['data']   = [];



            if($validator->errors()){

                $arr_responce['msg'] =$validator->errors()->first();

            }

            

            return $arr_responce;

        }

      

        if($request->hasFile('profile_image'))

        {

            $image          = $request->file('profile_image');

            $file_extension = $image->getClientOriginalExtension();

            $file_old_name  = $image->getClientOriginalName();



            // if(in_array($file_extension,['jpg','jpeg','png']))

            // {

                $file_name = sha1(uniqid().$file_old_name.uniqid()).'.'.$file_extension;

                $isUpload  = $image->move($this->user_profile_image_base_img_path,$file_name);

                

                if($isUpload)

                {

                    $file_name = $file_name;

                    $arr_data['profile_image']      = $file_name; 

                }

                else

                {

                    $arr_responce['status'] = 'ERROR';

                    $arr_responce['msg']    = 'Oops,Something went wrong,please try again later.';

                    $arr_responce['data']   = [];

                    return $arr_responce;



                }



        }elseif($request->input('profile_image')!=''){

            // dd($request->input('profile_image'));

            $filename_path = md5(time().uniqid()).".png"; 

            $data = explode( ',', $request->input('profile_image') ); //remove base64

            $trim = isset($data[1])?$data[1]:$data[0];

            $decoded=base64_decode($trim); 

            $true = file_put_contents($this->user_profile_image_base_img_path.$filename_path ,$decoded);

            

          

             if($true)

            {

                $arr_data['profile_image'] = $filename_path;



            }else{

                $arr_responce['status'] = 'ERROR';

                $arr_responce['msg']    = 'Oops,Something went wrong,please try again later.';

                $arr_responce['data']   = [];

                return $arr_responce;

            }



        }



        $obj_update = $this->CustomerModel->where('id',$this->user->id)->update(['profile_image'=>$arr_data['profile_image']]);

        

        if($obj_update){

            $arr_responce['status'] = 'SUCCESS';

            $arr_responce['msg']    = 'Profile image updated successfully.';

            $arr_responce['data']   = [];

            return $arr_responce;

        }else{



            $arr_responce['status'] = 'ERROR';

            $arr_responce['msg']    = 'Oops,Something went wrong,please try again later.';

            $arr_responce['data']   = [];

            return $arr_responce;

        }

    }

        

}