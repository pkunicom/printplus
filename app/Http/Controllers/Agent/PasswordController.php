<?php

namespace App\Http\Controllers\Agent;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use App\Models\AgentModel;
use DB;
use Session;
use Config;
use Hash;
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

    use ResetsPasswords;
    private $auth;

    protected $redirectTo = '/agent';
    protected $broker = 'agent';
    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct(AgentModel  $agent_model)
    {
        $this->auth = auth()->guard('agent');
        $this->arr_view_data      = [];
        $this->module_title       = "Agent";
        $this->module_view_folder = "agent.auth";
        $this->admin_panel_slug   = config('app.project.agent_panel_slug');
        $this->module_url_path    = url($this->admin_panel_slug);
        $this->AgentModel         = $agent_model;

        Config::set("auth.defaults.passwords","agent");
        Config::set("auth.password_hasher","off"); //turn off password hashing
        Config::set("auth.use_custom_template","on"); //turn on custom templates
        Config::set("auth.user_mode","agent"); //sets user mode for sending email
        
    }
    
    public function postEmail(Request $request)
    {
        $arr_email = $arr_content = [];
        $this->validate($request, ['email' => 'required|email']);
        $arr_email   = $request->only('email');
        $response = Password::sendResetLink($arr_email,function($m)
        {
            $m->subject(config('app.project.name').' : Your Password Reset Link');
        });

        switch ($response)
        {
            case Password::RESET_LINK_SENT:
                Session::flash('success', 'Reset Password link sent to your accout successfully.');
                return redirect()->back()->with('status', trans($response));

            case Password::INVALID_USER:
                Session::flash('invalid_email', true);
                Session::flash('error', trans($response));
                return redirect()->back();
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

            return view('agent.auth.reset_password',$this->arr_view_data);    
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
        $obj_admin = $this->AgentModel->where('email','=',$credentials['email'])->first();
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

}
