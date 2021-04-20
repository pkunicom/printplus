<?php

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\NotificationModel;
use App\Models\SiteSettingModel;

class AuthMiddleware
{
    function __construct()
    {  
        $this->NotificationModel    = new NotificationModel();
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        
        $this->auth = auth()->guard('api_user');
        view()->share('admin_panel_slug',config('app.project.admin_panel_slug'));
        
        if($this->auth->user())
        {
            return $next($request)
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        }
        else
        {
        	$arr_response['status'] =  'ERROR';
            $arr_response['msg']    =  'Token Expired.';
            $arr_response['data']   =  [];
            return response()->json($arr_response);
        }
    }
}