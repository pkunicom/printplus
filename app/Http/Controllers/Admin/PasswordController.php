<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use App\Models\WebAdmin;
use App\Common\Services\MailService;
use DB;
use Session;
use Config;
use Hash;
use Validator;
class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    /*
        Auther : Sagar Sainkar        
        Comments: controller for change password web admin 
    */

    //use ResetsPasswords;
    private $auth;

    protected $redirectTo = '/admin';
    protected $broker = 'admin';
    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct(WebAdmin  $admin_model,MailService $mail_service)
    {
        $this->auth = auth()->guard('admin');
        $this->arr_view_data      = [];
        $this->module_title       = "Admin";
        $this->module_view_folder = "admin.auth";
        $this->admin_panel_slug   = config('app.project.admin_panel_slug');
        $this->module_url_path    = url($this->admin_panel_slug);
        $this->WebAdmin         = $admin_model;
        $this->MailService      = $mail_service;

        Config::set("auth.defaults.passwords","admin");
        Config::set("auth.password_hasher","off"); //turn off password hashing
        Config::set("auth.use_custom_template","on"); //turn on custom templates
        Config::set("auth.user_mode","admin"); //sets user mode for sending email
        
    }
    
    // public function postEmail(Request $request)
    // {
    //     $arr_email = $arr_content = [];
    //     $this->validate($request, ['email' => 'required|email']);
    //     $arr_email   = $request->only('email');
    //     $response = Password::sendResetLink($arr_email,function($m)
    //     {
    //         $m->subject(config('app.project.name').' : Your Password Reset Link');
    //     });

    //     switch ($response)
    //     {
    //         case Password::RESET_LINK_SENT:
    //             Session::flash('success', 'Reset Password link sent to your accout successfully.');
    //             return redirect()->back()->with('status', trans($response));

    //         case Password::INVALID_USER:
    //             Session::flash('invalid_email', true);
    //             Session::flash('error', trans($response));
    //             return redirect()->back();
    //     }
    // }
    public function postEmail(Request $request)
    {
        $arr_rules      = array();
        $status         = false;

        $arr_rules['email']     = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $input      = $request->input('email');

        $obj_data   = $this->WebAdmin->where('email',$input)
                                       ->first();


        if(isset($obj_data) && $obj_data != 'null')
        {
            $first_name         = isset($obj_data['full_name']) ? $obj_data['full_name'] : '';
            $password           = $obj_data['password'];
            $email              = $obj_data['email'];
            $id                 = isset($obj_data['id']) ? $obj_data['id'] : 'N/A';

            if(isset($email) && $email != 'null')
            {
                $arr_email['first_name']       = isset($first_name) ? $first_name : '';
                $arr_email['to_user_name']     = $first_name;
                $arr_email['to_email_id']      = $email;

                $verification_url = '<a target="_blank" style="border: 1px solid #ff4747; color: #ffffff; display: block; font-size: 18px; letter-spacing: 0.5px; background-color: #ff4747;
              margin: 0 auto; max-width: 200px; padding: 11px 6px; height: initial; text-align: center; text-transform: capitalize; text-decoration: none; width: 100%; border-radius: 5px;" href="'.url('/admin/set_password/'.base64_encode($id)).'">Reset Password</a><br/>';


                $arr_email['verification_url'] = $verification_url;

                $date           = date('Y-m-d', strtotime(' +1 day'));//Carbon\Carbon::tomorrow()->format('Y-m-d');

                $obj_data_user1 = $this->WebAdmin->where('email',$input)
                                                   ->update(['is_set_password'=>'0','set_password_link_expiry'=>$date]);
                
                // dd($obj_data_user1);
                $email_status   = $this->MailService->send_forget_password_email($arr_email);
               
                Session::flash('success',' Reset password link sent successfully, Please check your email.');
                return redirect()->back();
            }
        }

        $this->arr_view_data['module_title']     = $this->module_title." Login";
        $this->arr_view_data['page_title']       = $this->module_title." Login";
        Session::flash('error','The Email you entered is incorrect.');
        return redirect()->back();
    }

    public function set_password(Request $request,$enc_id)
    {
        $new_date = date('Y-m-d');
        $id       = base64_decode($enc_id);

        $obj_data = $this->WebAdmin->where('id',$id)->first();
        if(isset($obj_data) && $obj_data != 'null')
        {
            $this->arr_view_data['new_date']         = $new_date;    
            $this->arr_view_data['module_title']     = $this->module_title." Login";
            $this->arr_view_data['page_title']       = $this->module_title." Login";
            $this->arr_view_data['obj_data']         = $obj_data;
            return view($this->module_view_folder.'.reset_password',$this->arr_view_data);   
        }
    }    
     public function get_email($token)
    {
        if (is_null($token)) 
        {
            return redirect($this->module_url_path)->with('error', 'Your reset password link has been expired.');
        }

        $obj_token = DB::table('admin_password_resets')->get();
        $password_reset = DB::table('admin_password_resets')->where('token',$token)->first();

        if($password_reset != NULL)
        {
            $this->arr_view_data['token']            = $token;
            $this->arr_view_data['password_reset']   = (array)$password_reset;
            $this->arr_view_data['admin_panel_slug'] = $this->admin_panel_slug;
            $this->arr_view_data['module_url_path']  = $this->module_url_path;

            return view('admin.auth.reset_password',$this->arr_view_data);    
        }
        else
        {
            return redirect($this->module_url_path)->with('error', 'Your reset password link has been expired.');
        }
    }

    /**
     * Display the password reset view for the given token.
     *
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function getReset($enc_token = null)
    {
        if (is_null($enc_token)) 
        {
            return redirect($this->module_url_path)->with('error', 'Your password reset link was expired.');
        }
        $token          = $enc_token;
        $password_reset = DB::table('admin_password_resets')->where('token',$token)->first();
        if($password_reset != NULL)
        {
            $this->arr_view_data['token']               = $token;
            $this->arr_view_data['password_reset']      = (array)$password_reset;
            $this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;

            return view($this->module_view_folder.'.reset_password',$this->arr_view_data);    
        }
        else
        {
            return redirect($this->module_url_path)->with('error','Your password reset link was expired.');
        }
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postReset(Request $request)
    {
        // dd($request->all());

        $status = '';
        $this->validate($request, [
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
        $obj_admin = $this->WebAdmin->where('email','=',$credentials['email'])->first();
        if($obj_admin)
        {
            $password  = isset($credentials['password'])?Hash::make($credentials['password']):'';
            $status    = $obj_admin->update(['password'=>$password]);
        }
        if($status)
        {
            $is_deleted_token = DB::table('admin_password_resets')->where('token','=',$credentials['token'])->delete();
            Session::flash('success', 'Password set successfully.');
        }
        else
        {
            Session::flash('error','Error occure while set a password.');
        }
        return redirect($this->module_url_path);
    }
    public function save_password(Request $request,$enc_id)
    {
        $arr_rules = array();
        $status = FALSE;

        $arr_rules['password']  = "required";
        $arr_rules['cpassword'] = "required|same:password";        
        
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            Session::flash('error',' Error while updating.');
            return redirect()->back()->withErrors($validator);
        }

        $password         = $request->input('password');
        $confirm_password = $request->input('cpassword');

        $id          = base64_decode($enc_id);
        $arr_user = []; 
        $status = false;
    
        $credentials   = $request->only('password',  'confirm_password', 'token');

        $check_user     = $this->WebAdmin->where('id',$id)->first();
        
        if($check_user){

            $obj_user = $this->WebAdmin->where('id',$id)->first();
            if($obj_user)
            {
                $password  = isset($credentials['password'])?Hash::make($credentials['password']):'';
                $status    = $obj_user->update(['password'=>$password,'is_set_password'=>'1']);
                if($status)
                {
                    Session::flash('success',' Your password has been updated, You can log-in to your account.');
                    return redirect('/admin');
                }
                else
                {
                    Session::flash('error','Error occure while updating your '.config('app.project.name').' password.');
                    return redirect('/forgot_password');
                }
                Session::flash('error','Invalid user details.');
                return redirect('/forgot_password');
            }
        }

        Session::flash('error','Invalid User Details.');
        return redirect('/forgot_password');
    }
}
