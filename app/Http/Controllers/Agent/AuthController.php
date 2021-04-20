<?php

namespace App\Http\Controllers\Agent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\AgentModel;

use Validator;
use Session;
use Cookie;
use DB;


class AuthController extends Controller
{
    public function __construct(AgentModel $web_agent_model)
    {
        $this->auth               = auth()->guard('agent');
        $this->arr_view_data      = [];
	    $this->module_title       = "Agent";
	    $this->module_view_folder = "agent.auth";
	    $this->agent_panel_slug   = config('app.project.agent_panel_slug');
	    $this->module_url_path    = url($this->agent_panel_slug);
        $this->AgentModel           = $web_agent_model;
    }
    // agent login : AUTHOR (Harsh Chauhan)
    public function login()
    {
        $this->arr_view_data['module_title']     = $this->module_title." Login";
        $this->arr_view_data['page_title']       = $this->module_title." Login";
        $this->arr_view_data['agent_panel_slug'] = $this->agent_panel_slug;

        return view($this->module_view_folder.'.login',$this->arr_view_data);
    }

    // validate agent login: AUTHOR (Harsh Chauhan)
    public function validate_login(Request $request)
    {
        $arr_rules      = array();
        $status         = false;
        $remember_me    = "";

        $arr_rules['email']     = "required";
        $arr_rules['password']  = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails()) 
        {
            return back()->withErrors($validator)->withInput();
        }

        $remember_me = $request->input('remember_me');

        $obj_group_admin = $this->AgentModel->where('email',$request->input('email'))->first();

        if($obj_group_admin) 
        {

            if(\Auth::guard('agent')->attempt($request->only('email', 'password')))
            {
                if($remember_me!= 'on' || $remember_me == null)
                {
                    setcookie("remember_me_email","");
                    setcookie("remember_me_password","");
                }
                else
                {
                    setcookie('remember_me_email',$request->input('email'), time()+60*60*24*100);
                    setcookie('remember_me_password',$request->input('password'), time()+60*60*24*100);
                }
                
                return redirect(url('/agent/dashboard'));
            }
            else
            {
                setcookie("remember_me_email","");
                setcookie("remember_me_password","");
                
                Session::flash('error','Your login attempt was not successful. Please try again.');

                return redirect()->back();
            }
        }
        else
        { 
            setcookie("remember_me_email","");
            setcookie("remember_me_password","");

            Session::flash('error','Your login attempt was not successful. Please try again.');
            return redirect()->back();
        }

        return redirect()->back();
    }

    // logout agent login: AUTHOR (Harsh Chauhan)
    public function logout()
    {
        $this->auth->logout();
        Session::flush();
        return redirect($this->module_url_path.'/');
    }

    public function forgot_admin_password()
    {
        $this->arr_view_data['module_title']     = $this->module_title." Login";
        $this->arr_view_data['page_title']       = $this->module_title." Login";
        $this->arr_view_data['agent_panel_slug'] = $this->agent_panel_slug;

        return view($this->module_view_folder.'.forgot_admin_password',$this->arr_view_data);
    }

}