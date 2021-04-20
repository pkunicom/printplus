<?php



namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\CategoryModel;

use App\Models\SubCategoryModel;

use App\Common\Services\MailService;

use App\Common\Traits\MultiActionTrait;



use DataTables;

use Validator;

use Session;



class CategoryManagementController extends Controller

{

    use MultiActionTrait;



    function __construct(MailService $mail_service)

    {

		$this->arr_view_data                = [];

		$this->admin_panel_slug             = config('app.project.admin_panel_slug');

		$this->admin_url_path               = url(config('app.project.admin_panel_slug'));

		$this->module_url_path              = $this->admin_url_path."/category";

		$this->module_title                 = "Category";

		$this->module_view_folder           = "admin.category";

		$this->module_icon                  = "fa fa-user";

		$this->auth                         = auth()->guard('admin');

		$this->BaseModel					= new CategoryModel();

		$this->SubCategoryModel 			= new SubCategoryModel();



		$this->user_profile_image_base_img_path   = base_path().config('app.project.img_path.user_profile_image');

		$this->user_profile_image_public_img_path = url('/').config('app.project.img_path.user_profile_image');

    }



	//category index     : AUTHOR (Akshay Ugale)

    public function index()

    {

    	

    	$obj_user = $this->BaseModel->get();



		$this->arr_view_data['page_title']          = "Manage ".$this->module_title;

        $this->arr_view_data['parent_module_icon']  = "fa fa-home";

        $this->arr_view_data['parent_module_title'] = "Dashboard";

        $this->arr_view_data['parent_module_url']   = url('/').'/admin/dashboard';

        $this->arr_view_data['module_icon']         = $this->module_icon;

        $this->arr_view_data['module_title']        = "Manage ".$this->module_title;

		$this->arr_view_data['module_url_path']     = $this->module_url_path;

		$this->arr_view_data['admin_url_path']      = $this->admin_url_path;

		$this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;

		$this->arr_view_data['count'] 				= count($obj_user);

		

		return view($this->module_view_folder.'.index',$this->arr_view_data);

    }



	//category load data     : AUTHOR (Akshay Ugale)

    public function load_data(Request $request)

	{	

		$build_status_btn       = '';

		$arr_data               = [];

		$arr_search_column     	= $request->input('column_filter');

		$obj_request_data = $this->BaseModel/*->orderBy('created_at','DESC')*/;



		if(isset($arr_search_column['id']) && $arr_search_column['id']!="")

		{

			$obj_request_data = $obj_request_data->where('id', 'LIKE',"%".$arr_search_column['id']."%");

		}



		if(isset($arr_search_column['english_name']) && $arr_search_column['english_name']!="")

		{

			$obj_request_data = $obj_request_data->where('english_name', 'LIKE',"%".$arr_search_column['english_name']."%");

		}



		if(isset($arr_search_column['arabic_name']) && $arr_search_column['arabic_name']!="")

		{

			$obj_request_data = $obj_request_data->where('arabic_name', 'LIKE',"%".$arr_search_column['arabic_name']."%");

		}



		if(isset($arr_search_column['status']) && $arr_search_column['status']!="")

		{

			$obj_request_data = $obj_request_data->where('status',$arr_search_column['status']);

		}

		if(isset($arr_search_column['role']) && $arr_search_column['role']!="")

		{

			$obj_request_data = $obj_request_data->where('role',$arr_search_column['role']);

		}



		$obj_request_data = $obj_request_data->get();



		$json_result 	= DataTables::of($obj_request_data)->make(true);

		$build_result 	= $json_result->getData();



		if(isset($build_result->data) && sizeof($build_result->data)>0)

		{

			foreach ($build_result->data as $key => $data) 

			{

				$action_button_html = '<ul class="icons-list">

												<li class="dropdown">

													<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">

														<i class="icon-menu9"></i>

													</a>



													<ul class="dropdown-menu dropdown-menu-right">

										';					

				$view_link_url    		= "javascript:void(0)";

				$built_delete_href 		= $this->module_url_path.'/delete/'.base64_encode($data->id);

				if($data->status != null && $data->status == "0"){

					$build_status_btn = '<a  href="'.$this->module_url_path.'/unblock/'.base64_encode($data->id).'" onclick="return confirm_action(this,event,\'Do you really want to Live this Category ?\')"><i class="icon-eye" title="Live"></i>Live</a> ';

					$build_edit_button = $build_sub_cat_button = '';

				}elseif($data->status != null && $data->status == "1"){

					$build_status_btn = '<a  href="'.$this->module_url_path.'/block/'.base64_encode($data->id).'" onclick="return confirm_action(this,event,\'Do you really want to Hidden this Category ?\')"><i class="icon-eye-blocked" title="Hidden"></i>Hidden</a> ';

					$build_edit_button 		= '<a  title="" href="javascript:void(0)"  data-id="'.$data->id.'"  id="open_edit_category_modal"><i class="icon-pencil7" title="Edit"></i> Edit Category</a>';

				

					$build_sub_cat_button 	= '<a  href="'.$this->module_url_path.'/subcategory/'.base64_encode($data->id).'" ><i class="icon-cog" title="Manage Sub-Category"> </i>Manage Sub-Category</a> ';

				}

				

                // $action_setting_button_html  = '<li class="dropdown">';

                // $action_setting_button_html .= '<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-cog"></i><span></span></a>';

                // $action_setting_button_html .= '<ul class="action-drop-section dropdown-menu dropdown-menu-right">';

                $action_button_html .= '<li>'.$build_edit_button.'</li>';

                $action_button_html .= '<li>'.$build_sub_cat_button.'</li>';

				//$action_setting_button_html .= '</ul>&nbsp&nbsp&nbsp';

				$action_button_html .= '<li>'.$build_status_btn.'</li>';

				$action_button_html .= '<li><a href='.$built_delete_href.'  title="delete" onclick="return confirm_action(this,event,\'Do you really want to delete this Category ?\')"><i class="icon-trash"></i>Delete</a></li>';

                //$action_setting_button_html .= '</li>';

				$action_button_html .= '

												</ul>

											</li>

										</ul>';		



				// $action_button_html .= '<a  title="" href="javascript:void(0)"  data-id="'.$data->id.'"  id="open_view_category_modal"><i class="fa fa-eye" title="View"></i></a>  ';



				$action_button_html 	 = $action_button_html;

				

				$category_id  	= str_pad(isset($data->id)? $data->id:'000', 3, '0', STR_PAD_LEFT);

				$english_name 	= isset($data->english_name)? $data->english_name :'';

				$arabic_name 	= isset($data->arabic_name)? $data->arabic_name :'';

				$id 	    	= isset($data->id)? base64_encode($data->id):'';

				$status 		= isset($data->status)? $data->status :'-';

				if($status==1){

					$status ='<span class="label label-success">Live</span>';

				}else{

					$status ='<span class="label label-danger">Hidden</span>';

				}

				$i = $key+1;

				$build_result->data[$key]->id         		    = $category_id;

				$build_result->data[$key]->sr_no         		= $i;

				$build_result->data[$key]->category_id          = $category_id;

				$build_result->data[$key]->english_name         = $english_name;

				$build_result->data[$key]->arabic_name         	= $arabic_name;

				$build_result->data[$key]->status        		= $status;

				$build_result->data[$key]->built_action_btns    = $action_button_html;

				

			}

			return response()->json($build_result);

		}

		else

		{

			return response()->json($build_result);

		}

	}



	//store new category     : AUTHOR (Akshay Ugale)

	public function store_category(Request $request)

    {

    	$arr_rules      = $arr_data = $arr_cat = array();

		$status         = false;



		$arr_rules['en_name']      	   	= "required";

		$arr_rules['ar_name']      	   	= "required";



		$validator = Validator::make($request->all(),$arr_rules);



		if($validator->fails()){

			return redirect()->back()->withErrors($validator)->withInput();

		}



		$arr_data['english_name']    		=   $request->input('en_name', null);	

		$arr_data['arabic_name']    		=   $request->input('ar_name', null);	

		$arr_data['status']					=	'1';



		$create  	= $this->BaseModel->create($arr_data);

		if($create)

		{

			Session::flash('success', 'Category created successfully.');

			return redirect($this->module_url_path);

		}

		else

		{

			Session::flash('error', 'Error while creating Category ..');

			return redirect($this->module_url_path);

		}

	}

	

	//view category      : AUTHOR (Akshay Ugale)

	public function view($id)

    {

    	$enc_id = base64_decode($id);



    	$arr_data = [];

    	$obj_data = $this->BaseModel->where('id',$enc_id)->first();



    	if($obj_data){

    		$arr_data = $obj_data->toArray();

		}

		// dd($arr_data);

    	if($arr_data){

			$arr_resp['status']  	= 'success';

			$arr_resp['data'] 		= $arr_data;

		}else{

			$arr_resp['status'] 	= 'error';

			$arr_resp['data'] 		= $arr_data;

		}



		return $arr_resp;

	}

	

	//edit category     : AUTHOR (Akshay Ugale)

	public function edit($id)

    {

    	$enc_id = base64_decode($id);



    	$arr_data = [];

    	$obj_data = $this->BaseModel->where('id',$enc_id)->first();



    	if($obj_data){

    		$arr_data = $obj_data->toArray();

		}

    	if($arr_data){

			$arr_resp['status']  	= 'success';

			$arr_resp['data'] 		= $arr_data;

		}else{

			$arr_resp['status'] 	= 'error';

			$arr_resp['data'] 		= $arr_data;

		}



		return $arr_resp;

	}

	

	//update category     : AUTHOR (Akshay Ugale)

	public function update(Request $request)

	{

		$enc_id = base64_decode($request->input('enc_id'));



		$arr_rules      = $arr_data = array();

		$status         = false;



		$arr_rules['edit_english_name']      	   	= "required";

		$arr_rules['edit_arabic_name']      	   	= "required";



		$validator = Validator::make($request->all(),$arr_rules);



		if($validator->fails()){

			return redirect()->back()->withErrors($validator)->withInput();

		}

		$arr_data['english_name']    		=   $request->input('edit_english_name', null);	

		$arr_data['arabic_name']    		=   $request->input('edit_arabic_name', null);



		$status = $this->BaseModel->where('id',$enc_id)->update($arr_data);



		if($status){

			Session::flash('success', 'Category Updated successfully.');

			return redirect($this->module_url_path);

		}



		Session::flash('error', 'Error while Updating category.');

		return redirect($this->module_url_path);

	}



	//check english category exist or not     : AUTHOR (Akshay Ugale)

	public function en_category_check(Request $request)

    {

    	$en_category = $request->input('en_category');



		$obj_cat = $this->BaseModel->where('english_name',$en_category)->first();



		if($obj_cat){

			$arr_resp['status']  	= 'error';

		}

		else{

			$arr_resp['status'] 	= 'success';

		}

		return $arr_resp;

	}



	//check arabic  category exist or not     : AUTHOR (Akshay Ugale)

	public function ar_category_check(Request $request)

    {

    	$ar_category = $request->input('ar_category');



		$obj_cat = $this->BaseModel->where('arabic_name',$ar_category)->first();



		if($obj_cat)

		{

			$arr_resp['status']  	= 'error';

		}

		else

		{

			$arr_resp['status'] 	= 'success';

		}

		return $arr_resp;

	}

	









	//Subcategory Management : AUTHOR (Akshay Ugale)



	//sub-category index     : AUTHOR (Akshay Ugale)

	public function sub_cat_index($id)

    {

		$arr_data = array();

		$enc_id 	= base64_decode($id);

		session(['session_cat_id'      => $enc_id]);

		$obj_cat = $this->BaseModel->where('id','=',session('session_cat_id'))->first();

		if($obj_cat)

		{

			$arr_data =  $obj_cat->toArray();

		}

		if($arr_data==null)

		{

			Session::flash('warning', 'Something went wrong.');

			return redirect($this->module_url_path);

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

		return view($this->module_view_folder.'.sub_cat_index',$this->arr_view_data);

	}



	//sub-category load data     : AUTHOR (Akshay Ugale)

	public function load_sub_category_data(Request $request)

	{	

		$build_status_btn       = '';

		$arr_data               = [];

		$arr_search_column     	= $request->input('column_filter');

		$cat_id 				= $arr_search_column['cat_id'];

		$obj_request_data = $this->SubCategoryModel->where('category_id','=',$cat_id)->with('get_category_detail')/*->orderBy('created_at','DESC')*/;



		if(isset($arr_search_column['english_name']) && $arr_search_column['english_name']!="")

		{

			$obj_request_data = $obj_request_data->where('english_name', 'LIKE',"%".$arr_search_column['english_name']."%");

		}



		if(isset($arr_search_column['arabic_name']) && $arr_search_column['arabic_name']!="")

		{

			$obj_request_data = $obj_request_data->where('arabic_name', 'LIKE',"%".$arr_search_column['arabic_name']."%");

		}



		if(isset($arr_search_column['status']) && $arr_search_column['status']!="")

		{

			$obj_request_data = $obj_request_data->where('status',$arr_search_column['status']);

		}



		$obj_request_data = $obj_request_data->get();



		$json_result 	= DataTables::of($obj_request_data)->make(true);

		$build_result 	= $json_result->getData();



		if(isset($build_result->data) && sizeof($build_result->data)>0)

		{

			foreach ($build_result->data as $key => $data) 

			{



		$action_button_html = '<ul class="icons-list">

												<li class="dropdown">

													<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">

														<i class="icon-menu9"></i>

													</a>



													<ul class="dropdown-menu dropdown-menu-right">

										';				

				$view_link_url    		= "javascript:void(0)";

				$built_delete_href 		= $this->module_url_path.'/delete_sub_cat/'.base64_encode($data->id);

				if($data->status != null && $data->status == "0")

				{

					$build_status_btn = '<a  href="'.$this->module_url_path.'/unblock_sub_cat/'.base64_encode($data->id).'" 

					onclick="return confirm_action(this,event,\'Do you really want to activate this Sub-Category ?\')" ><i class="fa fa-eye" title="Live"></i>Live</a>';
					$build_edit_button  = '';
				}

				elseif($data->status != null && $data->status == "1")

				{
					$build_edit_button 		= '<a  title="" href="javascript:void(0)"  data-id="'.$data->id.'"  id="open_edit_sub_category_modal"><i class="fa fa-cog" title="Edit"></i>Edit</a>';
					$build_status_btn = '<a  href="'.$this->module_url_path.'/block_sub_cat/'.base64_encode($data->id).'" onclick="return confirm_action(this,event,\'Do you really want to inactivate this Sub-Category ?\')" ><i class="fa fa-eye-slash" title="Hidden"></i>Hidden</a>';

				}

				//$build_edit_button 		= '<a  title="" href="javascript:void(0)"  data-id="'.$data->id.'"  id="open_edit_sub_category_modal"><i class="fa fa-cog" title="Edit"></i>Edit</a>';

				// $action_button_html .= '<a  title="" href="javascript:void(0)"  data-id="'.$data->id.'"  id="open_view_category_modal"><i class="fa fa-eye" title="View"></i></a>  ';

				$action_button_html .= '<li> '.$build_edit_button.'</li>';	

				$action_button_html .= '<li> '.$build_status_btn.'</li>';	

				$action_button_html 	 .= '<li><a href='.$built_delete_href.' title="Delete"  onclick="return confirm_action(this,event,\'Do you really want to delete this Sub-Category ?\')" ><i class="fa fa-trash"></i>Delete</a></li>';

				$english_name 			= isset($data->english_name)? $data->english_name :'';

				$arabic_name 			= isset($data->arabic_name)? $data->arabic_name :'';

				$id 	    			= isset($data->id)? base64_encode($data->id):'';

				$status 				= isset($data->status)? $data->status :'-';

				$cat_ID 				= isset($data->get_category_detail->id)? $data->get_category_detail->id :'000';

				$subcat_ID 				= str_pad(isset($data->id)? $data->id:'000', 3, '0', STR_PAD_LEFT);

				

				if($status==1){

					$status = '<span class="label label-success">Live</span>';

				}else{

					$status = '<span class="label label-danger">Hidden</span>';

				}

				$action_button_html .= '

												</ul>

											</li>

										</ul>';	



				$i = $key+1;

				$build_result->data[$key]->id         		    = $id;

				$build_result->data[$key]->sr_no         		= $i;

				$build_result->data[$key]->cat_subcat_ID        = $cat_ID.$subcat_ID;

				$build_result->data[$key]->english_name         = $english_name;

				$build_result->data[$key]->arabic_name         	= $arabic_name;

				$build_result->data[$key]->status        		= $status;

				$build_result->data[$key]->built_action_btns    = $action_button_html;

				

			}

			return response()->json($build_result);

		}

		else

		{

			return response()->json($build_result);

		}

	}



	// store new sub-category     : AUTHOR (Akshay Ugale)

	public function store_sub_category(Request $request)

    {

    	$arr_rules      = $arr_data = $arr_cat = array();

		$status         = false;

		$cat_ID 		= '101';

		$Subcat_Id 		= '001'; 



		$arr_rules['en_name']      	   	= "required";

		$arr_rules['ar_name']      	   	= "required";



		$validator = Validator::make($request->all(),$arr_rules);



		if($validator->fails()) 

		{

			return redirect()->back()->withErrors($validator)->withInput();

		}

		$category_id 						=   $request->input('category_id', null);

		$arr_data['category_id']    		=   $category_id;	

		$arr_data['english_name']    		=   $request->input('en_name', null);	

		$arr_data['arabic_name']    		=   $request->input('ar_name', null);

		$arr_data['status']					=	'1';

		

		$create  	= $this->SubCategoryModel->create($arr_data);

		if($create)

		{

			Session::flash('success', 'Sub-Category created successfully.');

			return redirect($this->module_url_path.'/subcategory/'.base64_encode($category_id));

		}

		else

		{

			Session::flash('error', 'Error while creating Sub-Category ..');

			return redirect($this->module_url_path.'/subcategory/'.base64_encode($category_id));

		}

	}

	

	//edit sub-category     : AUTHOR (Akshay Ugale)

	public function edit_sub_cat($id)

    {

    	$enc_id = base64_decode($id);



    	$arr_data = [];

    	$obj_data = $this->SubCategoryModel->where('id',$enc_id)->first();



    	if($obj_data){

    		$arr_data = $obj_data->toArray();

		}

    	if($arr_data){

			$arr_resp['status']  	= 'success';

			$arr_resp['data'] 		= $arr_data;

		}else{

			$arr_resp['status'] 	= 'error';

			$arr_resp['data'] 		= $arr_data;

		}



		return $arr_resp;

	}

	

	//update sub-category     : AUTHOR (Akshay Ugale)

	public function update_sub_cat(Request $request)

	{

		$enc_id = base64_decode($request->input('enc_id'));



		$arr_rules      = $arr_data = array();

		$status         = false;



		$arr_rules['edit_english_name']      	   	= "required";

		$arr_rules['edit_arabic_name']      	   	= "required";



		$validator = Validator::make($request->all(),$arr_rules);



		if($validator->fails()) 

		{

			return redirect()->back()->withErrors($validator)->withInput();

		}

		$arr_data['english_name']    		=   $request->input('edit_english_name', null);	

		$arr_data['arabic_name']    		=   $request->input('edit_arabic_name', null);

		$status = $this->SubCategoryModel->where('id',$enc_id)->update($arr_data);

		if($status)

		{

			Session::flash('success', 'Sub-Category Updated successfully.');

			if(session('session_cat_id')!=null)

			{

				return redirect($this->module_url_path.'/subcategory/'.base64_encode(session('session_cat_id')));

			}

			return redirect($this->module_url_path);

		}

		Session::flash('error', 'Error while Updating Sub-Category.');

		if(session('session_cat_id')!=null)

		{

			return redirect($this->module_url_path.'/subcategory/'.base64_encode(session('session_cat_id')));

		}

		return redirect($this->module_url_path);

	}



	// block sub-category     : AUTHOR (Akshay Ugale)

	public function block_sub_cat($id)

    {

		$enc_id = base64_decode($id);

		$arr_data = array();

		

    	$arr_data['status']    		=   '0';



		$status = $this->SubCategoryModel->where('id',$enc_id)->update($arr_data);



		if($status)

		{

			Session::flash('success', 'Sub-Category Inactivated successfully.');

			if(session('session_cat_id')!=null)

			{

				return redirect($this->module_url_path.'/subcategory/'.base64_encode(session('session_cat_id')));

			}

			else

			{

				return redirect($this->module_url_path);

			}

			

		}

		Session::flash('success', 'Error while Inactivating Sub-Category.');

		if(session('session_cat_id')!=null)

		{

			return redirect($this->module_url_path.'/subcategory/'.base64_encode(session('session_cat_id')));

		}

		else

		{

			return redirect($this->module_url_path);

		}

		

	}

	

	//unblock sub-category     : AUTHOR (Akshay Ugale)

	public function unblock_sub_cat($id)

    {

		$enc_id = base64_decode($id);

		$arr_data = array();

		

    	$arr_data['status']    		=   '1';



		$status = $this->SubCategoryModel->where('id',$enc_id)->update($arr_data);



		if($status)

		{

			Session::flash('success', 'Sub-Category activated successfully.');

			if(session('session_cat_id')!=null)

			{

				return redirect($this->module_url_path.'/subcategory/'.base64_encode(session('session_cat_id')));

			}

			else

			{

				return redirect($this->module_url_path);

			}

			

		}

		Session::flash('success', 'Error while activating Sub-Category.');

		if(session('session_cat_id')!=null)

		{

			return redirect($this->module_url_path.'/subcategory/'.base64_encode(session('session_cat_id')));

		}

		else

		{

			return redirect($this->module_url_path);

		}

	}

	

	// delete sub-category     : AUTHOR (Akshay Ugale)

	public function delete_sub_cat($id)

    {

		$enc_id = base64_decode($id);



		$status = $this->SubCategoryModel->where('id',$enc_id)->delete();

		

		if($status)

		{

			Session::flash('success', 'Sub-Category deleted successfully.');

			if(session('session_cat_id')!=null)

			{

				return redirect($this->module_url_path.'/subcategory/'.base64_encode(session('session_cat_id')));

			}

			else

			{

				return redirect($this->module_url_path);

			}

			

		}

		Session::flash('success', 'Error while deleting Sub-Category.');

		if(session('session_cat_id')!=null)

		{

			return redirect($this->module_url_path.'/subcategory/'.base64_encode(session('session_cat_id')));

		}

		else

		{

			return redirect($this->module_url_path);

		}

    }





	//check english sub-category exist or not     : AUTHOR (Akshay Ugale)

	public function en_sub_category_check(Request $request)

    {

    	$en_category = $request->input('en_category');



		$obj_cat = $this->SubCategoryModel->where('english_name',$en_category)->first();



		if($obj_cat)

		{

			$arr_resp['status']  	= 'error';

		}

		else

		{

			$arr_resp['status'] 	= 'success';

		}

		return $arr_resp;

	}



	//check arabic sub-category exist or not     : AUTHOR (Akshay Ugale)

	public function ar_sub_category_check(Request $request)

    {

    	$ar_category = $request->input('ar_category');



		$obj_cat = $this->SubCategoryModel->where('arabic_name',$ar_category)->first();



		if($obj_cat)

		{

			$arr_resp['status']  	= 'error';

		}

		else

		{

			$arr_resp['status'] 	= 'success';

		}

		return $arr_resp;

	}

}

