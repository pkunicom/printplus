<?php

namespace App\Http\Middleware\Agent;

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
        $arr_site_data = array();

        $obj_site_data = SiteSettingModel::first();

        if($obj_site_data){ $arr_site_data = $obj_site_data->toArray(); }

        view()->share('arr_global_site_setting',$arr_site_data);

        $this->auth = auth()->guard('agent');

        view()->share('agent_panel_slug',config('app.project.agent_panel_slug'));

        if($this->auth->user())
        {

            $super_admin_details = $this->auth->user()->toArray();

            $obj_user =$this->auth->user();
            $notification_count = 0;
            
            $notifications = $this->NotificationModel->with(['get_user_details'])
                                                 ->where(['receiver_id'=>'1', 'status'=>'0', 'receiver_type'=>'admin'])
                                                 ->orderBy('created_at','desc')
                                                 ->limit(5)
                                                 ->get()
                                                 ->toArray();

            $notification_count      = $this->NotificationModel->where(['receiver_id'=>'1', 'status'=>'0', 'receiver_type'=>'admin'])->count();

            view()->share('id',$super_admin_details['id']);

            view()->share('shared_admin_details',$super_admin_details);
            
            view()->share('profile_image_base_img_path',base_path().config('app.project.img_path.admin_profile_image'));
            
            view()->share('profile_image_public_img_path',url('/').config('app.project.img_path.admin_profile_image'));
            
            view()->share('user_profile_image_base_path',base_path().config('app.project.img_path.user_profile_image'));
            
            view()->share('user_profile_image_public_path',url('/').config('app.project.img_path.user_profile_image'));
            
            view()->share('default_img_path',url('/').config('app.project.img_path.user_default_img_path'));
            
            view()->share('obj_user',$obj_user);

            view()->share('notifications',$notifications);
            
            view()->share('notification_count',$notification_count);

            return $next($request);
        }
        else
        {
        	$this->auth->logout();
            return redirect(config('app.project.agent_panel_slug'));
        }
    }
}