<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EmailTemplateModel;
use App\Common\Services\MailService;
use App\Common\Traits\MultiActionTrait;
use Hash;
use DataTables;
use Validator;
use Session;
use DateTime;
use Carbon;

class EmailTemplateController extends Controller
{
    use MultiActionTrait;

    function __construct(MailService $mail_service)
    {
		$this->arr_view_data                = [];
		$this->admin_panel_slug             = config('app.project.admin_panel_slug');
		$this->admin_url_path               = url(config('app.project.admin_panel_slug'));
		$this->module_url_path              = $this->admin_url_path."/email_templates";
		$this->module_title                 = "Email Templates ";
		$this->module_view_folder           = "admin.email_template";
		$this->module_icon                  = "fa fa-user";
		$this->auth                         = auth()->guard('admin');
		$this->BaseModel					= new EmailTemplateModel();

		$this->user_profile_image_base_img_path   = base_path().config('app.project.img_path.user_profile_image');
		$this->user_profile_image_public_img_path = url('/').config('app.project.img_path.user_profile_image');
		$this->agent_invoice_base_img_path   	  = base_path().config('app.project.img_path.agent_invoice');
		$this->agent_invoice_public_img_path      = url('/').config('app.project.img_path.agent_invoice');
    }

    // content index : AUTHOR (Harsh chauhan) 
    public function index()
    {
    
		$this->arr_view_data['page_title']          = "Manage ".$this->module_title;
        $this->arr_view_data['parent_module_icon']  = "fa fa-home";
        $this->arr_view_data['parent_module_title'] = "Dashboard";
        $this->arr_view_data['parent_module_url']   = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']         = $this->module_icon;
        $this->arr_view_data['module_title']        = "Manage ".$this->module_title;
		$this->arr_view_data['module_url_path']     = $this->module_url_path;
		$this->arr_view_data['admin_url_path']      = $this->admin_url_path;
		$this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;
	
		
		return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    // load content data : AUTHOR (Harsh chauhan) 
    public function load_data(Request $request)
	{	
		$build_status_btn       = '';
		$arr_data               = [];
		$arr_search_column     	= $request->input('column_filter');

		$obj_request_data = $this->BaseModel->orderBy('created_at','DESC');

		// if(isset($arr_search_column['full_name']) && $arr_search_column['full_name']!="")
		// {
		// 	$obj_request_data = $obj_request_data->where('full_name', 'LIKE',"%".$arr_search_column['full_name']."%");
		// }

		// if(isset($arr_search_column['email']) && $arr_search_column['email']!="")
		// {
		// 	$obj_request_data = $obj_request_data->where('email', 'LIKE',"%".$arr_search_column['email']."%");
		// }

		// if(isset($arr_search_column['status']) && $arr_search_column['status']!="")
		// {
		// 	$obj_request_data = $obj_request_data->where('status',$arr_search_column['status']);
		// }

		// if(isset($arr_search_column['role']) && $arr_search_column['role']!="")
		// {
		// 	$obj_request_data = $obj_request_data->where('role',$arr_search_column['role']);
		// }

		$obj_request_data = $obj_request_data->get();

		$json_result 	= DataTables::of($obj_request_data)->make(true);
		$build_result 	= $json_result->getData();

		if(isset($build_result->data) && sizeof($build_result->data)>0)
		{
			foreach ($build_result->data as $key => $data) 
			{
				$edit_link_url      = $this->module_url_path.'/edit_email_template/'.base64_encode($data->id);
				$delete_link_url    = $this->module_url_path.'/delete_email_template/'.base64_encode($data->id);
				// $view_link_url    = "javascript:void(0)";
				
				$arr_roles = $arr_product_options = [];

				$id 					= isset($data->id)? $data->id :'';
				$template_name 			= isset($data->template_name)? $data->template_name :'';
				$template_subject 		= isset($data->template_subject)? $data->template_subject :'';
				$created_at 			= isset($data->created_at)? get_formated_date($data->created_at) :'';
			
				$action_button_html = '<a  title="" href="'.$edit_link_url.'" data-original-title="Edit" ><i class="fa fa-cog" title="Edit"></i></a> <a  title="" href="'.$delete_link_url.'" data-original-title="Delete" data-id="'.$data->id.'" onclick="return confirm_action(this,event,\'Do you really want to delete this Template ?\')" ><i class="fa fa-trash" title="Delete"></i></a>';

			
				$i = $key+1;
				$build_result->data[$key]->id         		    = $id;
				$build_result->data[$key]->sr_no         		= $i;
				$build_result->data[$key]->template_name       	= $template_name;
				$build_result->data[$key]->template_subject       	= $template_subject;
				$build_result->data[$key]->created_at        	= $created_at;
				$build_result->data[$key]->built_action_btns    = $action_button_html;
				
			}
			return response()->json($build_result);
		}
		else
		{
			return response()->json($build_result);
		}
	}


	// add content page: AUTHOR (Harsh chauhan) 
    public function add_email_template()
    {
    
		$this->arr_view_data['page_title']          = "Manage ".$this->module_title;
        $this->arr_view_data['parent_module_icon']  = "fa fa-home";
        $this->arr_view_data['parent_module_title'] = "Dashboard";
        $this->arr_view_data['parent_module_url']   = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']         = $this->module_icon;
        $this->arr_view_data['module_title']        = "Manage ".$this->module_title;
		$this->arr_view_data['module_url_path']     = $this->module_url_path;
		$this->arr_view_data['admin_url_path']      = $this->admin_url_path;
		$this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;
		
		return view($this->module_view_folder.'.add',$this->arr_view_data);
    }

    // store content: AUTHOR (Harsh chauhan) 
	public function store_email_template(Request $request)
	{
		
		
		$arr_rules      = $arr_data = array();
		$status         = false;

		$arr_rules['page_title']      	= "required";
		$arr_rules['meta_title']      	= "required";
		$arr_rules['meta_keyword']      = "required";
		$arr_rules['meta_description']  = "required";
		$arr_rules['content']      	   	= "required";
	
		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}


		$arr_data['page_title']    				=   $request->input('page_title', null);	
		$arr_data['meta_title']	    			=   $request->input('meta_title', null);	
		$arr_data['meta_keyword']	   			=   $request->input('meta_keyword', null);	
		$arr_data['meta_description']	    	=   $request->input('meta_description', null);	
		$arr_data['page_description']	    	=   $request->input('content', null);	

		$title_slug    							= strtolower(trim($arr_data["page_title"]));
		$slug    								= str_slug($title_slug);

		$arr_data['slug'] 						=	$slug;


		$status = $this->BaseModel->create($arr_data);

		if($status)
		{
			Session::flash('success', 'Template added successfully.');
			return redirect($this->module_url_path);
		}

		Session::flash('error', 'Error while adding Template.');
		return redirect($this->module_url_path);
	}

	// edit content : AUTHOR (Harsh chauhan) 
	 public function edit_email_template(Request $request,$enc_id)
    {
    	$id = base64_decode($enc_id);

    	$obj_data = $this->BaseModel->where('id',$id)->first();

    	if($obj_data){
    		$arr_data = $obj_data->toArray();
    	}

    	$arr_variables = isset($arr_data['template_variables']) && !empty($arr_data['template_variables']) ? explode("~",$arr_data['template_variables']):array();

    	$this->arr_view_data['arr_variables']       = $arr_variables;
		$this->arr_view_data['page_title']          = "Manage ".$this->module_title;
        $this->arr_view_data['parent_module_icon']  = "fa fa-home";
        $this->arr_view_data['parent_module_title'] = "Dashboard";
        $this->arr_view_data['parent_module_url']   = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']         = $this->module_icon;
        $this->arr_view_data['module_title']        = "Manage ".$this->module_title;
		$this->arr_view_data['module_url_path']     = $this->module_url_path;
		$this->arr_view_data['admin_url_path']      = $this->admin_url_path;
		$this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;
		$this->arr_view_data['arr_data'] 		    = $arr_data;
		
		return view($this->module_view_folder.'.edit',$this->arr_view_data);
    }

    // update content data: AUTHOR (Harsh chauhan) 
     public function update_email_template(Request $request,$enc_id)
	{
		$id = base64_decode($enc_id);
		
		$arr_rules      = $arr_data = array();
		$status         = false;

		$arr_rules['template_name']       = "required";
		$arr_rules['template_from']       = "required";
		$arr_rules['template_from_mail']  = "required";
		$arr_rules['template_subject']    = "required";
		$arr_rules['template_html']       = "required";
	
	
		$validator = Validator::make($request->all(),$arr_rules);

		if($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

				$template_name = $request->input('template_name', null);
		$id            = base64_decode($enc_id);
		$arr_template['template_name']      = $template_name;
		$arr_template['template_from']      = $request->input('template_from', null);
		$arr_template['template_from_mail'] = $request->input('template_from_mail', null);
		$arr_template['template_subject']   = $request->input('template_subject', null);
		$arr_template['template_html']      = $request->input('template_html', null);


		// $arr_data['slug'] 						=	$slug;

		$status = $this->BaseModel->where('id',$id)->update($arr_template);

		if($status)
		{
			Session::flash('success', 'Template updated successfully.');
			return redirect($this->module_url_path);
		}

		Session::flash('error', 'Error while updating Template.');
		return redirect($this->module_url_path);
	}

	// delete content: AUTHOR (Harsh chauhan)
	public function delete_email_template(Request $request,$enc_id)
	{	
		$content_id = base64_decode($enc_id);

		$obj_delete = $this->BaseModel->where('id',$content_id)->delete();

		if($obj_delete){
			Session::flash('success', 'Template deleted successfully.');
			return redirect($this->module_url_path);
    	}else{
    		Session::flash('error', 'Something went wrong.');
			return redirect($this->module_url_path);
    	}
	}

}