<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\VatModel;
use App\Common\Services\MailService;
use App\Common\Traits\MultiActionTrait;
use Hash;
use DataTables;
use Validator;
use Session;
use Carbon;
class VatController extends Controller
{
    use MultiActionTrait;

    function __construct(MailService $mail_service)
    {
		$this->arr_view_data                = [];
		$this->admin_panel_slug             = config('app.project.admin_panel_slug');
		$this->admin_url_path               = url(config('app.project.admin_panel_slug'));
		$this->module_url_path              = $this->admin_url_path."/settings";
		$this->module_title                 = "Vat ";
		$this->module_view_folder           = "admin.vat";
		$this->module_icon                  = "fa fa-user";
		$this->auth                         = auth()->guard('admin');
		$this->BaseModel					= new VatModel();

		$this->user_profile_image_base_img_path   = base_path().config('app.project.img_path.user_profile_image');
		$this->user_profile_image_public_img_path = url('/').config('app.project.img_path.user_profile_image');
		$this->agent_invoice_base_img_path   	  = base_path().config('app.project.img_path.agent_invoice');
		$this->agent_invoice_public_img_path      = url('/').config('app.project.img_path.agent_invoice');
    }
    // vat listing: AUTHOR (Harsh Chauhan)
    public function index()
    {
    	$obj_data = $this->BaseModel->where('id','1')->first();

    	if($obj_data){
    		$arr_data = $obj_data->toArray();
    	}

		$this->arr_view_data['page_title']          = "Manage ".$this->module_title;
        $this->arr_view_data['parent_module_icon']  = "fa fa-home";
        $this->arr_view_data['parent_module_title'] = "Dashboard";
        $this->arr_view_data['parent_module_url']   = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']         = $this->module_icon;
        $this->arr_view_data['module_title']        = "Manage ".$this->module_title;
		$this->arr_view_data['module_url_path']     = $this->module_url_path;
		$this->arr_view_data['admin_url_path']      = $this->admin_url_path;
		$this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;
		$this->arr_view_data['arr_data'] 			= $arr_data;
		
		return view($this->module_view_folder.'.edit',$this->arr_view_data);
    }

    // update vat: AUTHOR (Harsh Chauhan)
	public function update_vat(Request $request,$enc_id)
	{
		$arr_rules      = $arr_data = array();
		$status         = false;

		$arr_rules['vat']      	   	= "required";
	
		$id = base64_decode($request->input('enc_id'));

		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$id 		= base64_decode($enc_id);

		$arr_data['vat']    			=   $request->input('vat', null);	


		$status = $this->BaseModel->where('id',$id)->update($arr_data);

		if($status)
		{
			Session::flash('success', 'Vat changed successfully.');
			return redirect($this->module_url_path.'/vat');
		}

		Session::flash('error', 'Error while updating Vat.');
		return redirect($this->module_url_path.'/vat');
	}

}