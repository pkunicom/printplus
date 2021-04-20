<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Services\MailService;
use App\Common\Traits\MultiActionTrait;

use DataTables;
use Validator;
use Session;
use Carbon\Carbon;

class AnalyticsReportsManagementController extends Controller
{
    use MultiActionTrait;

    function __construct(MailService $mail_service)
    {
		$this->arr_view_data                = [];
		$this->admin_panel_slug             = config('app.project.admin_panel_slug');
		$this->admin_url_path               = url(config('app.project.admin_panel_slug'));
		$this->module_url_path              = $this->admin_url_path."/reports/analytics";
		$this->module_title                 = "Reports";
		$this->module_view_folder           = "admin.reports";
		$this->module_icon                  = "fa fa-user";
		$this->auth                         = auth()->guard('admin');
    }

    //analytics report    : AUTHOR (Akshay Ugale)
    public function index()
    {
		$this->arr_view_data['page_title']          	= "Analytics ".$this->module_title;
        $this->arr_view_data['parent_module_icon']  	= "fa fa-home";
        $this->arr_view_data['parent_module_title'] 	= "Analytics";
        $this->arr_view_data['module_title']        	= "Analytics ".$this->module_title;
        
		return view($this->module_view_folder.'.analytics_report',$this->arr_view_data);
    }
}
