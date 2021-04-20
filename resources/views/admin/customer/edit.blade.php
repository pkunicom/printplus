<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from demo.interface.club/limitless/layout_1/LTR/default/components_tabs.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 05:45:43 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{config('app.project.name')}}</title>
	<!-- Global stylesheets -->
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/admin') }}/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/admin') }}/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/admin') }}/assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/admin') }}/assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/admin') }}/assets/css/colors.css" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/admin') }}/assets/css/extras/animate.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="{{ asset('assets/admin') }}/assets/css/telinput/intlTelInput.css">
	<!-- /global stylesheets -->
	<!-- Core JS files -->
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/core/libraries/jquery.validate.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/visualization/d3/d3.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/visualization/c3/c3.min.js"></script>
	<!-- <script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/forms/styling/switch.min.js"></script> -->
	<!-- Theme JS files -->	
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/uploaders/fileinput/fileinput.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/core/app.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/charts/c3/c3_bars_pies.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/charts/c3/c3_axis.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/pages/uploader_bootstrap.js"></script>
	<!-- Telinput -->
	<!-- Use as a Vanilla JS plugin -->
	<script src="{{ asset('assets/admin') }}/assets/css/telinput/js/intlTelInput.min.js"></script>
	<!-- Use as a jQuery plugin -->
	<script src="{{ asset('assets/admin') }}/assets/css/telinput/js/intlTelInput-jquery.min.js"></script>
	<!-- <script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/pages/form_checkboxes_radios.js"></script> -->
	<!-- Radio button   --><!-- 
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/pages/form_checkboxes_radios.js"></script> -->
	<!-- /theme JS files -->
	<style type="text/css">
		.red{color:red;}
	</style>
</head>
<body>
	<!-- Main navbar -->
	@include('admin.layout.header')
	<!-- /main navbar -->
	<!-- Page container -->
	<div class="page-container">
		<!-- Page content -->
		<div class="page-content">
			<!-- Main sidebar -->
			@include('admin.layout.sidebar')
			<!-- /main sidebar -->
			<!-- Main content -->
			<div class="content-wrapper">
				<!-- Content area -->
				<div class="content">
					@include('admin.layout._operation_status')
					<!-- Basic tabs title -->
					<!-- <h6 class="content-group text-semibold">
						Basic tabs layout
						<small class="display-block">Default tabs layout options</small>
					</h6> -->
					



						<!-- <div class="col-md-6"> -->

							


								
									<div class="tabbable agent-managment-tabs-main" id="tabload">
										<ul class="nav nav-tabs nav-tabs-solid nav-justified">
											<li class="active"><a href="#overview" data-toggle="tab">Overview</a></li>
											<li><a class="justified-tab2" href="#personal_information" data-toggle="tab">Personal Information</a></li>
											<li><a href="#product_discount" data-toggle="tab"  id="view_product_discount">Products Discount</a></li>
											<li><a href="#customer_orders" data-toggle="tab" id="view_customer_orders">Orders</a></li>
											<li><a href="#transactions" data-toggle="tab" id="view_customer_transactions">Transactions</a></li>											
										</ul>
										<div class="tab-content">
											<div class="tab-pane active" id="overview">
												<div class="tab-margin-remve">
													<div class="row">
														<div class="col-lg-4">
															<div class="panel total-count-block">																
																<div class="panel-body">
																	<h6 class="no-margin">5,021.12</h6>
																	<div class="dash-box-head">Total Value</div>
																	<div class="dash-box-icon dash-box-pending">
																		<i class="icon-markup"></i>
																	</div>
																	<div class="clearfix"></div>
																</div>
																<div id="server-load"></div>
															</div>
														</div>
														<div class="col-lg-4">
															<div class="panel total-count-block dash-box-lecture">
																<div class="panel-body">
																	<h6 class="no-margin">123123</h6>
																	<div class="dash-box-head">Total Orders</div>
																	<div class="dash-box-icon dash-box-pending">
																		<i class="icon-stack3"></i>
																	</div>
																	<div class="clearfix"></div>
																</div>
																<div id="server-load"></div>
															</div>
														</div>
														<div class="col-lg-4">
															<div class="panel total-count-block dash-box-lectures">
																<div class="panel-body">
																	<h6 class="no-margin">15/105,198</h6>
																	<div class="dash-box-head">Rank</div>
																	<div class="dash-box-icon dash-box-pending">
																		<i class="icon-list-ordered"></i>
																	</div>
																	<div class="clearfix"></div>
																</div>
																<div id="server-load"></div>
															</div>
														</div>
														<div class="col-lg-4">
															<div class="panel total-count-block dash-box-questions">
																<div class="panel-body">
																	<h6 class="no-margin">1 Year 9 Months</h6>
																	<div class="dash-box-head">Customer Age</div>
																	<div class="dash-box-icon dash-box-pending">
																		<i class="icon-three-bars"></i>
																	</div>
																	<div class="clearfix"></div>
																</div>
																<div id="server-load"></div>
															</div>
														</div>
														<div class="col-lg-4">
															<div class="panel total-count-block dash-box-news-feeds">
																<div class="panel-body">
																	<h6 class="no-margin">1,019</h6>
																	<div class="dash-box-head">Balance (SAR)</div>																	
																	<div class="dash-box-icon dash-box-pending">
																		<i class="icon-clipboard2"></i>
																	</div>
																	<div class="clearfix"></div>
																</div>
																<div id="server-load"></div>
															</div>
														</div>
														<div class="col-lg-4">
															<div class="panel total-count-block dash-box-notification">
																<div class="panel-body">
																	<h6 class="no-margin">4.5/5</h6>
																	<div class="dash-box-head">Satisfaction Rate</div>																	
																	<div class="dash-box-icon dash-box-pending">
																		<i class="icon-file-upload"></i>
																	</div>
																	<div class="clearfix"></div>
																</div>
																<div id="server-load"></div>
															</div>
														</div>
													</div>
												<div class="row">
													<div class="col-lg-6">
														<div class="panel agent-edit-main customer-info-img-main">
															<div class="agent-pic-section">
																 @if(isset($arr_data['profile_image']) && !empty($arr_data['profile_image']) && File::exists($user_profile_image_base_img_path.$arr_data['profile_image']))
																	<img src="{{$user_profile_image_public_img_path.$arr_data['profile_image']}}" alt="" />
					                                            @else
																	<img src="{{url('/')}}/assets/admin/assets/images/demo/images/blog1.jpg" alt="" />
					                                            @endif
															</div>
															<div class="agent-information-section">																
																<div class="agent-information-main">
																	<div class="agent-information-head">
																		Name
																	</div>
																	<div class="agent-information-content">
																		<span>:</span> {{ $arr_data['full_name'] ?? '-' }}
																	</div>
																</div>
																<div class="agent-information-main">
																	<div class="agent-information-head">
																		Group
																	</div>
																	<div class="agent-information-content">
																		<span>:</span> {{ ucwords($arr_data['get_group_details']['group_name']) ?? '' }}
																	</div>																	
																</div>
																<div class="clearfix"></div>
															</div>	
															<div class="clearfix"></div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="panel agent-edit-main customer-only-info-main">
															<div class="agent-information-section">
																<div class="agent-information-main">
																	<div class="agent-information-head">
																		Customer ID
																	</div>
																	<div class="agent-information-content">
																		<span>:</span> {{ $arr_data['customer_id'] ?? '-' }}
																	</div>
																</div>
																<div class="agent-information-main">
																	<div class="agent-information-head">
																		Joined
																	</div>
																	<div class="agent-information-content">
																		<span>:</span><?php echo  get_formated_date($arr_data['created_at'])?>
																	</div>																	
																</div>															
																<!-- <div class="agent-information-main">
																	<div class="agent-information-head">
																		Email
																	</div>
																	<div class="agent-information-content">
																		<span>:</span> {{ $arr_data['email'] ?? '-' }}
																	</div>																
																</div>	
																<div class="agent-information-main">
																	<div class="agent-information-head">
																		Mobile
																	</div>
																	<div class="agent-information-content">
																		<span>:</span> {{ $arr_data['mobile_number'] ?? '-' }}
																	</div>
																</div>														 -->
																<div class="agent-information-main">
																	<div class="agent-information-head">
																		Last sign in
																	</div>
																	<div class="agent-information-content">
																		<span>:</span> Mon 18, May 2020 
																	</div>
																</div>
																<div class="clearfix"></div>
															</div>	
															<div class="clearfix"></div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="panel panel-flat panel-graph">
															<div class="panel-heading">
																<h6 class="panel-title text-semibold">Top 5 product category</h6>
															</div>
															<div class="panel-body">
																<div class="chart-container text-center">
																	<div class="display-inline-block" id="c3-axis-tick-rotation"></div>
																</div>
															</div>
														</div>
													</div>
													<!-- <div class="col-lg-8">
														<div class="panel agent-edit-main customer-edit-main">
															<div class="agent-pic-section">
																 @if(isset($arr_data['profile_image']) && !empty($arr_data['profile_image']) && File::exists($user_profile_image_base_img_path.$arr_data['profile_image']))
																	<img src="{{$user_profile_image_public_img_path.$arr_data['profile_image']}}" alt="" />
					                                            @else
																	<img src="{{url('/')}}/assets/admin/assets/images/demo/images/blog1.jpg" alt="" />
					                                            @endif
															</div>
															<div class="agent-information-section">
																<div class="agent-information-main">
																	<div class="agent-information-head">
																		Customer ID
																	</div>
																	<div class="agent-information-content">
																		<span>:</span> {{ $arr_data['customer_id'] ?? '-' }}
																	</div>
																</div>
																<div class="agent-information-main">
																	<div class="agent-information-head">
																		Name
																	</div>
																	<div class="agent-information-content">
																		<span>:</span> {{ $arr_data['full_name'] ?? '-' }}
																	</div>
																</div>
																<div class="agent-information-main">
																	<div class="agent-information-head">
																		Joined
																	</div>
																	<div class="agent-information-content">
																		<span>:</span><?php echo  get_formated_date($arr_data['created_at'])?>
																	</div>																	
																</div>															
																<div class="agent-information-main">
																	<div class="agent-information-head">
																		Email
																	</div>
																	<div class="agent-information-content">
																		<span>:</span> {{ $arr_data['email'] ?? '-' }}
																	</div>																
																</div>	
																<div class="agent-information-main">
																	<div class="agent-information-head">
																		Mobile
																	</div>
																	<div class="agent-information-content">
																		<span>:</span> {{ $arr_data['mobile_number'] ?? '-' }}
																	</div>
																</div>													
																<div class="clearfix"></div>
															</div>	
															<div class="clearfix"></div>
														</div>
													</div> -->
												</div>
												<div class="row">													
													<!-- <div class="col-lg-6">
														<div class="panel panel-flat panel-graph">
															<div class="panel-heading">
																<h6 class="panel-title text-semibold">Top 5 product category</h6>
															</div>
															<div class="panel-body">
																<div class="chart-container text-center">
																	<div class="display-inline-block" id="c3-axis-tick-rotation"></div>
																</div>
															</div>
														</div>
													</div> -->
													<!-- <div class="col-lg-6">
														<div class="panel panel-flat panel-graph">
															<div class="panel-heading">
																<h6 class="panel-title text-semibold">Last 5 Month Sales</h6>
															</div>
															<div class="panel-body">
																<div class="chart-container text-center">
																	<div class="display-inline-block" id="c3-axis-tick-culling"></div>
																</div>
															</div>
														</div>
													</div> -->
												</div>
												</div>
											</div>
											<div class="tab-pane" id="personal_information">
												<div class="panel panel-flat">
													<form action="{{ url('/') }}/admin/customers/update_customer/{{ base64_encode($arr_data['id']) }}" id="edit_customer" method="post" enctype="multipart/form-data" >
													{{csrf_field()}}
														<div class="row">
															<div class="col-sm-6 col-md-6 col-lg-6">
																<div class="form-group">											
																	<label>Full Name <i class="red" >*</i></label>
																	<input type="text" data-rule-required="true" name="full_name" id="full_name" placeholder="Enter Full Name" class="form-control" value="{{ $arr_data['full_name'] ?? '' }}">
																</div>
															</div>
															<div class="col-sm-6 col-md-6 col-lg-6">				
																<div class="form-group">							
																	<label>Country <i class="red" >*</i></label>
																	<select data-rule-required="true" id="country" name="country" class="form-control">	
																		@foreach($arr_sys_country as $key_sys_country => $value_sys_country )
																			<option  {{($value_sys_country['id'] == $arr_data['country_id']) ? 'selected' : '' }} value="{{$value_sys_country['id']}}" >{{ $value_sys_country['country_english_name'] ?? '' }}</option>
																		@endforeach
																	</select>									
																</div>	
															</div>
															<div class="col-sm-6 col-md-6 col-lg-6">
																<div class="form-group">												
																	<label>Email <i class="red" >*</i></label>
																	<input type="text" data-rule-required="true" data-rule-email="true" name="email" id="email"  placeholder="Enter email" class="form-control" value="{{ $arr_data['email'] ?? ''}}" >
																</div>
															</div>
															<div class="col-sm-6 col-md-6 col-lg-6">				
																<div class="form-group">								
																	<label>City <i class="red" >*</i></label>
																	<select data-rule-required="true" id="city" name="city" class="form-control">	
																		@foreach($arr_sys_city as $key_sys_city => $value_sys_city )
																			<option  {{($value_sys_city['id'] == $arr_data['city_id']) ? 'selected' : '' }} value="{{$value_sys_city['id']}}" >{{ $value_sys_city['city_english_name'] ?? '' }}</option>
																		@endforeach
																	</select>									
																</div>	
															</div>
															<div class="col-sm-6 col-md-6 col-lg-6">	
																<div class="form-group">												
																	<label>Mobile <i class="red" >*</i></label>
																	<div class="mobile-drop-section-main" id="edit_select_code">
																		<div class="mobile-drop-section-select">
																			<input type="hidden" name="country_code_id" id="country_code_id" class="form-control mobile_number">
																			<input type="hidden" name="country_code_flag" id="country_code_flag" class="form-control mobile_number">
																			{{--<select name="country_code_id" data-rule-required="true" id="country_code_id" class="form-control">	
																				@foreach($arr_country as $key_country_one => $value_country_one)
																					<option  {{(($value_country_one['id'] ?? '') == ($arr_data['country_code_id']??'')) ? 'selected' : '' }} value="{{$value_country_one['id'] ?? ''}}" >{{ $value_country_one['country_code'] ?? '' }}</option>
																				@endforeach
																			</select> --}}
																		</div>
																		<div class="mobile-drop-section-input">
																			<input type="text" placeholder="Enter mobile number" id="mobile_number" name="mobile_number" data-rule-required="true" data-rule-number="true" class="form-control mobile_number" autocomplete="off" maxlength="13"  value="{{ $arr_data['mobile_number'] ?? '' }}" >
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-sm-6 col-md-6 col-lg-6">
																<div class="form-group">											
																	<label>Main Address <i class="red" >*</i></label>
																	<textarea class="form-control" data-rule-required="true" name="address" id="address">{{ $arr_data['address'] ?? '' }}</textarea>
																</div>
															</div>
															<div class="col-sm-6 col-md-6 col-lg-6">
																<div class="form-group">
																	<label >Gender  <i class="red" >*</i> </label>
																	<br>
																	<label class="radio-inline">
																		<div class="choice">
																			<span class="{{ (( $arr_data['gender'] ?? '') == 'male') ? 'checked' : '' }} ">
																				<input type="radio"  id="male" name="gender" class="styled" checked="{{ (( $arr_data['gender'] ?? '') == 'male') ? 'true' : 'false' }}" value="male">
																			</span>
																		</div>
																		Male
																	</label>
																	<label class="radio-inline">
																		<div class="choice">
																			<span class="{{ (( $arr_data['gender'] ?? '') == 'female') ? 'checked' : '' }} ">
																				<input type="radio"  id="female" name="gender" class="styled" checked="{{ (( $arr_data['gender'] ?? '') == 'female') ? 'true' : 'false' }}" value="female">
																			</span>
																		</div>
																		Female
																	</label>
																</div>
															</div>
															<div class="col-sm-6 col-md-6 col-lg-6">				
																<div class="form-group">								
																	<label>Group <i class="red" >*</i></label>
																	<!-- <select data-rule-required="true" id="customer_group" name="customer_group" class="form-control">	
																		<option  {{( $arr_data['customer_group'] == 'business') ? 'selected' : '' }} value="business" >Business</option>
																		<option  {{( $arr_data['customer_group'] == 'customer') ? 'selected' : '' }} value="customer" >Customer</option>
																	</select> -->	
																	<select name="customer_group" data-rule-required="true" id="customer_group" class="form-control">	
																		<option value="">Select Group</option>
																		@foreach($arr_groups as $key_groups => $value_groups)
																			<option  {{(($value_groups['id'] ?? '') == ($arr_data['customer_group']??'')) ? 'selected' : '' }} value="{{$value_groups['id'] ?? ''}}" >{{ $value_groups['group_name'] ?? '' }}</option>
																		@endforeach
																	</select>								
																</div>	
															</div>
															<div class="col-sm-6 col-md-6 col-lg-6">
																<div class="form-group">
																	<label >Email Language  <i class="red" >*</i> </label>
																	<br>
																	<label class="radio-inline">
																		<div class="choice">
																			<span class="{{ (( $arr_data['email_language'] ?? '') == 'english') ? 'checked' : '' }} ">
																				<input type="radio" name="email_language" id="english" class="styled" value="english"  checked="{{ (( $arr_data['email_language'] ?? '') == 'english') ? 'true' : 'false' }}">
																			</span>
																		</div>
																		English
																	</label>
																	<label class="radio-inline">
																		<div class="choice">
																			<span class="{{ (( $arr_data['email_language'] ?? '') == 'arabic') ? 'checked' : '' }} ">
																				<input type="radio" name="email_language" id="arabic" class="styled" value="arabic" checked="{{ (( $arr_data['email_language'] ?? '') == 'arabic') ? 'true' : 'false' }}">
																			</span>
																		</div>
																		Arabic
																	</label>
																</div>
															</div>
															<div class="col-sm-6 col-md-6 col-lg-6">
																<div class="form-group">								
																	<label>User Status</label> : 
																	@if($arr_data['status']==1)
																		<span id="user_status">Active</span>
																	@else
																		<span id="user_status">Blocked</span>
																	@endif																												
																</div>
															</div>
														</div>
														<div class="update-btns-section">
															@if($arr_data['status']==1)													
																<a href="{{ $module_url_path }}/block/{{ base64_encode($arr_data['id']) }}" class="btn btn-primary" onclick="return confirm_action(this,event,\'Do you really want to inactivate this Customer ?')"><span id="block-unblock" data-status="0"  >Block</span></a>
															@else
																<a href="{{ $module_url_path }}/unblock/{{ base64_encode($arr_data['id']) }}" class="btn btn-primary" onclick="return confirm_action(this,event,'Do you really want to activate this Customer ?')"><span id="block-unblock" data-status="0"  >Unblock</span></a>
															@endif
															<button type="submit" class="btn btn-primary">Update</button>
														</div>
													</form>
												</div>
											</div>
											<div class="tab-pane" id="product_discount">
												<div class="panel panel-flat">
													<div class="page-head-section-main">
														<div class="page-head-txt">
															Products Discount
														</div>														
													</div>
													<div class="add-user-btn-main">
														<span class="table-search-section" style="margin-right: 0">
															<i class="fa fa-search"></i>
															<input type="text" name="search" placeholder="Search">
														</span>														
													</div>
													<div class="clearfix"></div>
													<div id="show_edit_discount_modal" class="modal fade addUserModalMain">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header bg-primary">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<h5 class="modal-title">Edit Discount</h5>
																</div>
																<form action="{{ url('/') }}/admin/customers/update_customer_discount" id="add_customer_discount" method="post" enctype="multipart/form-data" >
																{{csrf_field()}}
																	<div class="modal-body">
																		<div class="row">
																			<div class="col-sm-6 col-md-6 col-lg-12">				
																				<div class="form-group">								
																					<label>Product Category <i class="red" >*</i></label>
																					<input type="text" data-rule-required="true" name="pcategory_name" id="pcategory_name" readonly="true" class="form-control">					
																				</div>	
																			</div>
																			<div class="col-sm-6 col-md-6 col-lg-12">				
																				<div class="form-group">								
																					<label>Discount <i class="red" >*</i></label>
																					<input type="text" data-rule-required="true" name="pdiscount" id="pdiscount" class="form-control">					
																				</div>	
																			</div>
																			<input type="hidden" name="pcategory_id" id="pcategory_id" >
																			<input type="hidden" name="pcustomer_id" id="pcustomer_id" >
																			<input type="hidden" name="pcategorydiscount_id" id="pcategorydiscount_id" >
																		</div>
																	</div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
																		<button type="submit" class="btn btn-primary">Update</button>
																	</div>
																</form>
															</div>
														</div>
													</div>
													<table class="table datatable-column-search-inputs" id="datatable_customer_discount">
														<thead>
															<tr>
																<th>#</th>
																<th>Product Category</th>
																<th>Discount</th>
												                <th class="text-center">Actions</th>
												            </tr>
														</thead>
													</table>
												</div>
											</div>
											<div class="tab-pane" id="customer_orders">
												<div class="panel panel-flat">
													<div class="page-head-section-main">
														<div class="page-head-txt">
															Orders
														</div>														
													</div>
													<div class="add-user-btn-main">
														<span class="table-search-section" style="margin-right: 0">
															<i class="fa fa-search"></i>
															<input type="text" name="search" placeholder="Search">
														</span>														
													</div>
													<div class="clearfix"></div>
													<table class="table datatable-column-search-inputs" id="datatable_customer_orders">
														<thead>
															<tr>
																<th>#</th>
																<th>Order ID
																	<!-- <input type="text" name="order_id" placeholder="Search" class="search-block-new-table form-control column_filter"> -->
																</th>
																<th>Total
																	<!-- <input type="text" name="order_total_amount" placeholder="Search" class="search-block-new-table form-control column_filter"> -->
																</th>
																<th>Delivery City
																	<!-- <input type="text" name="city" placeholder="Search" class="search-block-new-table form-control column_filter"> -->
																</th>
																<th>Delivery Type
																<!-- 	<select class="search-block-new-table column_filter form-control" id="delivery_type" name="delivery_type">
																		<option value="">All</option>
																		@foreach($arr_delivery_type as $key_delivery=>$value_delivery)
																			<option value="{{ $value_delivery['id'] ?? '' }}">{{ $value_delivery['delivery_type'] ?? '' }}</option>
																		@endforeach
																	</select> -->
																</th>
																<th class="text-center">Actions</th>
															</tr>
														</thead>
														<tbody>
														</tbody>
													</table>
												</div>
											</div>
											<div class="tab-pane" id="transactions">
												<div class="panel panel-flat">
													<div class="page-head-section-main">
														<div class="page-head-txt">
															Manage Staff <span></span>
														</div>
														<div class="breadcrumb-section-main">
															@include('admin.layout.breadcrumb')	
														</div>
													</div>
													<div class="add-user-btn-main">
														<span class="table-search-section">
															<i class="fa fa-search"></i>
															<input type="text" name="search" placeholder="Search">
														</span>
														<a class="btn btn-primary"  id="open_add_deduct" href="javascript:void(0)">Deduct</a>
														<a class="btn btn-primary"  id="open_add_compensate" href="javascript:void(0)">Compensate</a>
														<a class="btn btn-primary"  id="open_add_bank_transfer" href="javascript:void(0)">Bank Transfer</a>
													</div>
													<div class="clearfix"></div>													
													<div id="show_add_bank_transfer_modal" class="modal fade addUserModalMain">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header bg-primary">
																	<button type="button" class="close close_transaction_model" data-dismiss="modal">&times;</button>
																	<h5 class="modal-title">Add Bank Transfer</h5>
																</div>
																<form action="{{ url('/') }}/admin/customers/add_customer_bank_transfer" id="add_bank_transfer" method="post" enctype="multipart/form-data" >
																{{csrf_field()}}
																	<div class="modal-body">														
																		<div class="row">
																			<div class="col-sm-6 col-md-6 col-lg-12">				
																				<div class="form-group">								
																					<label>Amount<i class="red" >*</i></label>
																					<input type="text" data-rule-required="true" name="bank_transfer_amount" id="bank_transfer_amount" class="form-control">					
																				</div>	
																			</div>
																			<div class="col-sm-6 col-md-6 col-lg-12">				
																				<div class="form-group">								
																					<label>Transaction ID <i class="red" >*</i></label>
																					<input type="text" data-rule-required="true" name="bank_transfer_transaction_id" id="bank_transfer_transaction_id" class="form-control">					
																				</div>	
																			</div>
																			<div class="col-sm-6 col-md-6 col-lg-12">				
																				<div class="form-group">								
																					<label>Notes <i class="red" >*</i></label>
																					<textarea  data-rule-required="true" name="bank_transfer_notes" id="bank_transfer_notes" class="form-control"></textarea>					
																				</div>	
																			</div>
																			<input type="hidden" id="bank_transfer_customer_id" name="bank_transfer_customer_id" value="{{ $arr_data['id'] ?? '' }}">
																			<input type="hidden" id="bank_transfer_order_id" name="bank_transfer_order_id" value="{{ $arr_data['id'] ?? '' }}">
																		</div>																	
																	</div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-primary close_transaction_model" data-dismiss="modal">Close</button>
																		<button type="submit" class="btn btn-primary">Add</button>
																	</div>
																</form>
															</div>
														</div>
													</div>
													<div id="show_add_compensation_modal" class="modal fade addUserModalMain">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header bg-primary">
																	<button type="button" class="close close_transaction_model" data-dismiss="modal">&times;</button>
																	<h5 class="modal-title">Add Compensation</h5>
																</div>
																<form action="{{ url('/') }}/admin/customers/add_compensation" id="add_compensation" method="post" enctype="multipart/form-data" >
																{{csrf_field()}}
																	<div class="modal-body">															
																		<div class="row">
																			<div class="col-sm-6 col-md-6 col-lg-12">				
																				<div class="form-group">								
																					<label>Amount<i class="red" >*</i></label>
																					<input type="text" data-rule-required="true" name="compensate_amount" id="compensate_amount"  class="form-control">					
																				</div>	
																			</div>
																			<div class="col-sm-6 col-md-6 col-lg-12">				
																				<div class="form-group">								
																					<label>Order #<i class="red" >*</i></label>
																					<select data-rule-required="true" name="compensate_order_id" id="compensate_order_id" class="form-control">
																					</select>				
																				</div>	
																			</div>
																			<div class="col-sm-6 col-md-6 col-lg-12">				
																				<div class="form-group">								
																					<label>Validity (Days) <i class="red" >*</i></label>
																					<input type="text" data-rule-required="true" name="compensate_validity" id="compensate_validity" class="form-control">					
																				</div>	
																			</div>
																			<div class="col-sm-6 col-md-6 col-lg-12">				
																				<div class="form-group">								
																					<label>Notes <i class="red" >*</i></label>
																					<textarea  data-rule-required="true" name="compensate_notes" id="compensate_notes" class="form-control"></textarea>					
																				</div>	
																			</div>
																			<input type="hidden" id="compensate_customer_id" name="compensate_customer_id" value="{{ $arr_data['id'] ?? '' }}">
																		</div>
																	</div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-primary close_transaction_model" data-dismiss="modal">Close</button>
																		<button type="submit" class="btn btn-primary">Add</button>
																	</div>
																</form>
															</div>
														</div>
													</div>	
													<div id="show_deduct_amount_modal" class="modal fade addUserModalMain">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header bg-primary">
																	<button type="button" class="close close_transaction_model" data-dismiss="modal">&times;</button>
																	<h5 class="modal-title">Deduct Amount</h5>
																</div>
																<form action="{{ url('/') }}/admin/customers/deduct_amount" id="add_deduct_amount" method="post" enctype="multipart/form-data" >
																{{csrf_field()}}
																	<div class="modal-body">
																		<div class="row">
																			<div class="col-sm-6 col-md-6 col-lg-12">				
																				<div class="form-group">								
																					<label>Amount<i class="red" >*</i></label>
																					<input type="text" data-rule-required="true" name="deduct_amount_amount" id="deduct_amount_amount"  class="form-control">					
																				</div>	
																			</div>
																			<div class="col-sm-6 col-md-6 col-lg-12">				
																				<div class="form-group">								
																					<label>Order #<i class="red" >*</i></label>
																					<select data-rule-required="true" name="deduct_amount_order_id" id="deduct_amount_order_id" class="form-control">
																					</select>				
																				</div>	
																			</div>
																			<div class="col-sm-6 col-md-6 col-lg-12">				
																				<div class="form-group">								
																					<label>Notes <i class="red" >*</i></label>
																					<textarea  data-rule-required="true" name="deduct_amount_notes" id="deduct_amount_notes" class="form-control"></textarea>					
																				</div>	
																			</div>
																			<input type="hidden" id="deduct_amount_customer_id" name="deduct_amount_customer_id" value="{{ $arr_data['id'] ?? '' }}">
																		</div>
																	</div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-primary close_transaction_model" data-dismiss="modal">Close</button>
																		<button type="submit" class="btn btn-primary">Add</button>
																	</div>
																</form>
															</div>
														</div>
													</div>
													<table class="table datatable-column-search-inputs" id="datatable_customer_transactions">
														<thead>
															<tr>
																<th>#</th>
																<th>Transaction ID</th>
																<th>Value</th>
																<th>Method</th>
																<th>Order #</th>
																<th>Date</th>
																<th>Notes </th>
																<th>Done By</th>
															</tr>
														</thead>
														<tbody>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
						<!-- </div> -->
					<!-- </div> -->
					

					<!-- /footer -->
				</div>
				<!-- /content area -->
			</div>
			<!-- /main content -->
		</div>
		<!-- /page content -->
	</div>
	<!-- /page container -->
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.all.js"></script>
<script src="{{url('/')}}/assets/admin/assets/js/pages/sweetalert_msg.js"></script>
<script src="{{url('/')}}/assets/admin/assets/js/pages/sweetalert.min.js"></script>
<script>
	$(document).ready(function(){
		var input = document.querySelector("#mobile_number");
		window.intlTelInput(input,({
		}));
		$("#mobile_number").intlTelInput({
			allowDropdown:true,
			initialCountry:"{{ $arr_data['country_code_flag'] ?? 'sa' }}",
			separateDialCode :true,
			hiddenInput :"code",
			// setCountry: ["sa"],
			preferredCountries: ["sa","us" ],
		});
		$(".mobile_number").on('change',function(){
			var intlNumber = $("#mobile_number").intlTelInput("getSelectedCountryData");
			console.log(intlNumber.iso2);
			$("#country_code_id").val("+"+intlNumber.dialCode);
			$("#country_code_flag").val(intlNumber.iso2);
		})
		$(".iti__selected-flag").on('click',function(){
			var intlNumber = $("#mobile_number").intlTelInput("getSelectedCountryData");
			$("#country_code_id").val("+"+intlNumber.dialCode);
			$("#country_code_flag").val(intlNumber.iso2);
			$("#mobile_number").val("");
		})	

		/*Added by Designer*/
		// alert($('.file-input').hasClass('.file-input-new'));
		// if ($('.file-input').hasClass('.file-input-new')) {
		// 	alert("hi");
		// 	$(this).parent().addClass("active");
		// }
		$('.justified-tab2').on('click', function(){
			if($('.file-input').hasClass('file-input-new')){
				$('.file-input').parent().addClass('view_icon_show');
			}else{
				$('.file-input').parent().removeClass('view_icon_show');
			}
		}); 
		$(".input-group-btn").on("click", function(){
			$(this).parent().parent().parent().removeClass('view_icon_show');
		});
		$(".view-btn-upload").on("click", function(){
			$(this).siblings(".file-input").find(".file-preview").css("display","block");
		});	
		$(".fileinput-remove").on("click", function(){
			$(this).parent().parent().parent().addClass('view_icon_show');
			$(this).parent(".file-preview").css("display","none");
		});
		/*Added by Designer*/
		$("#edit_customer").validate();
		$("#edit_agent_bank").validate();
		$("#add_bank_transfer").validate();
		$('#add_customer_discount').validate();
		$('#add_compensation').validate();
		$('#add_deduct_amount').validate();
		$('body').on('change','#country',function(){
			var id = btoa($(this).val());
			 $.ajax({
	            url : '{{ url('/') }}/admin/customers/get_cities/'+id,
	            type : "GET",
	            dataType: 'JSON',
	            success:function(resp){
	                if(resp.status=='success'){
	                    $('#city').html(resp.data);
	                }else if(resp.status=='error'){
	                    $('#city').html(resp.data);
	                }
	            }
	        })	
		});		
		/*Datatable for product TAB 3*/
		// $(".agent-managment-tabs-main").tabs({
		//     select: function(event, ui) {
		//         alert("PRESSED TAB!");
		//     }
		// });
		$('body').on('click','#view_product_discount',function(){
			var customer_id  = "{{ $arr_data['id'] ??''}}";
			$(function() {
			    // Table setup
			    // ------------------------------
			    // Setting datatable defaults
			    $.extend( $.fn.dataTable.defaults, {
			        autoWidth: false,
			        columnDefs: [{ 
			            orderable: false,
			            width: '100px',
			            targets: [ 5 ]
			        }],
			        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
			        language: {
			            search: '<span>Filter:</span> _INPUT_',
			            searchPlaceholder: 'Type to filter...',
			            lengthMenu: '<span>Show:</span> _MENU_',
			            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
			        },
			        drawCallback: function () {
			            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
			        },
			        preDrawCallback: function() {
			            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
			        }
			    });
			    var table = $('#datatable_customer_discount').DataTable({
			        "bStateSave": true,
			        "bSearchable":true,
			        "processing": true,
				    "serverSide": false,
				    "searchDelay": 350,
				    "autoWidth": false,
				    "bFilter": true,
				    "bLengthChange": true,
			        ajax: {
			            url: "{{ $module_url_path}}/load_customerdiscount_data/"+btoa(customer_id),
			            data: function(d) {
			                d['column_filter[discount]'] 				= $("input[name='discount']").val()
			            }
			        },
			        columns: [		           
			            {data : 'sr_no',"orderable":false,"searchable":false,name:'sr_no'},
			            {data : 'category_name',"orderable":false,"searchable":true,name:'category_name'},
			            {data : 'discount',"orderable":false,"searchable":true,name:'discount'},
			            {
			                render : function(data, type, row, meta) 
			                {
			                    return row.built_action_btns;
			                },
			                "orderable": false, "searchable":false
			            }
			        ],
			        "aoColumnDefs": [
			            { "bSortable": false, "aTargets": [ 1 ] }
			        ],
			        "aaSorting": [[2, 'asc']],
			    });
			    $('input.column_filter, select.column_filter').on( 'keyup change', function (){
			        filterData();
			    });
			     function filterData(){
			        table.draw();
			    }
			});
		});
		$('body').on('click','#open_edit_discount_modal',function(){
			var id = btoa($(this).data("id"));
			 $.ajax({
	            url : '{{ url('/') }}/admin/customers/get_category_discount/'+id,
	            type : "GET",
	            dataType: 'JSON',
	            success:function(resp){
	            	console.log(resp);
	                if(resp.status=='success'){
						$("#show_edit_discount_modal").modal('show');
	                    $('#pcategorydiscount_id').val(resp.data.id);
	                    $('#pcategory_id').val(resp.data.category_id);
	                    $('#pdiscount').val(resp.data.discount);
	                    $('#pcustomer_id').val(resp.data.customer_id);
	                    $('#pcategory_name').val(resp.data.get_category_details.english_name);
	                }else if(resp.status=='error'){
	                    $("#show_edit_discount_modal").modal('hide');
	                    Swal.fire(
							  resp.status,
							  resp.msg,
							  resp.status
							)
	                }
	            }
	        })	
		});
		/*Datatable for product TAB 3*/
		/*TAB 4*/
		$('body').on('click','#view_customer_orders',function(){
			var customer_id  = "{{ $arr_data['id'] ??''}}";
			$(function() {
			    // Table setup
			    // ------------------------------
			    // Setting datatable defaults
			    $.extend( $.fn.dataTable.defaults, {
			        autoWidth: false,
			        columnDefs: [{ 
			            orderable: false,
			            width: '100px',
			            targets: [ 5 ]
			        }],
			        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
			        language: {
			            search: '<span>Filter:</span> _INPUT_',
			            searchPlaceholder: 'Type to filter...',
			            lengthMenu: '<span>Show:</span> _MENU_',
			            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
			        },
			        drawCallback: function () {
			            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
			        },
			        preDrawCallback: function() {
			            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
			        }
			    });
			    var table = $('#datatable_customer_orders').DataTable({
			        "bStateSave": true,
			        "bSearchable":true,
			        "processing": true,
				    "serverSide": true,
				    "searchDelay": 350,
				    "autoWidth": false,
				    "bFilter": true,
				    "bLengthChange": true,
			        ajax: {
			            url: "{{ $module_url_path}}/load_customerorders_data/"+btoa(customer_id),
			            data: function(d) {
			                d['column_filter[order_id]'] 				= $("input[name='order_id']").val()
			                d['column_filter[order_total_amount]']   	= $("input[name='order_total_amount']").val()
			                d['column_filter[city]']   					= $("input[name='city']").val()
			                d['column_filter[delivery_type]']   		= $("select[name='delivery_type']").val()
			            }
			        },
			        columns: [
			            {data : 'sr_no',"orderable":false,"searchable":false,name:'sr_no'},
			            {data : 'order_id',"orderable":false,"searchable":true,name:'order_id'},
			            {data : 'order_total_amount',"orderable":false,"searchable":true,name:'order_total_amount'},
			            {data : 'city',"orderable":false,"searchable":true,name:'city'},
			            {data : 'delivery_type',"orderable":false,"searchable":false,name:'delivery_type'},
			            {
			                render : function(data, type, row, meta) 
			                {
			                    return row.built_action_btns;
			                },
			                "orderable": false, "searchable":false
			            }
			        ],
			        "aoColumnDefs": [
			            { "bSortable": false, "aTargets": [ 1 ] }
			        ],
			        "aaSorting": [[2, 'asc']],
			    });
			    $('input.column_filter, select.column_filter').on( 'keyup change', function (){
			        filterData();
			    });
			     function filterData(){
			        table.draw();
			    }
			});
		});
		/*TAB 4*/
		/*TAB 5*/
		$('body').on('click','#view_customer_transactions',function(){
			var customer_id  = "{{ $arr_data['id'] ??''}}";
			$(function() {
			    // Table setup
			    // ------------------------------
			    // Setting datatable defaults
			    $.extend( $.fn.dataTable.defaults, {
			        autoWidth: false,
			        columnDefs: [{ 
			            orderable: false,
			            width: '100px',
			            targets: [ 5 ]
			        }],
			        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
			        language: {
			            search: '<span>Filter:</span> _INPUT_',
			            searchPlaceholder: 'Type to filter...',
			            lengthMenu: '<span>Show:</span> _MENU_',
			            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
			        },
			        drawCallback: function () {
			            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
			        },
			        preDrawCallback: function() {
			            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
			        }
			    });
			    var table = $('#datatable_customer_transactions').DataTable({
			        "bStateSave": true,
			        "bSearchable":true,
			        "processing": true,
				    "serverSide": true,
				    "searchDelay": 350,
				    "autoWidth": false,
				    "bFilter": true,
				    "bLengthChange": true,
			        ajax: {
			            url: "{{ $module_url_path}}/load_customertransaction_data/"+btoa(customer_id),
			            data: function(d) {
			                d['column_filter[order_id]'] 				= $("input[name='order_id']").val()
			                d['column_filter[order_total_amount]']   	= $("input[name='order_total_amount']").val()
			                d['column_filter[city]']   					= $("input[name='city']").val()
			                d['column_filter[delivery_type]']   		= $("select[name='delivery_type']").val()
			            }
			        },
			        columns: [
			            {data : 'sr_no',"orderable":false,"searchable":false,name:'sr_no'},
			            {data : 'transaction_id',"orderable":false,"searchable":true,name:'transaction_id'},
			            {data : 'value',"orderable":false,"searchable":true,name:'value'},
			            {data : 'method_name',"orderable":false,"searchable":true,name:'method_name'},
			            {data : 'order_id',"orderable":false,"searchable":false,name:'order_id'},
			            {data : 'created_at',"orderable":false,"searchable":false,name:'created_at'},
			            {data : 'notes',"orderable":false,"searchable":false,name:'notes'},
			            {data : 'done_by',"orderable":false,"searchable":false,name:'done_by'}		           
			        ],
			        "aoColumnDefs": [
			            { "bSortable": false, "aTargets": [ 1 ] }
			        ],
			        "aaSorting": [[2, 'asc']],
			    });
			    $('input.column_filter, select.column_filter').on( 'keyup change', function (){
			        filterData();
			    });
			     function filterData(){
			        table.draw();
			    }
			});
		});
		$('body').on('click','#open_add_bank_transfer',function(){
			$("#show_add_bank_transfer_modal").modal('show');
		});
		$('body').on('click','#open_add_compensate',function(){
			var customer_id = "{{ $arr_data['id'] ?? '' }}";
			$.ajax({
	            url : '{{ url('/') }}/admin/customers/get_customerorder_id/'+btoa(customer_id),
	            type : "GET",
	            dataType: 'JSON',
	            success:function(resp){
	                if(resp.status=='success'){
						$("#show_add_compensation_modal").modal('show');
	                    $('#compensate_order_id').html(resp.data);
	                }else if(resp.status=='error'){
	                    $("#show_add_compensation_modal").modal('hide');
	                }
	            }
	        })
		});
		$('body').on('click','#open_add_deduct',function(){
			var customer_id = "{{ $arr_data['id'] ?? '' }}";
			$.ajax({
	            url : '{{ url('/') }}/admin/customers/get_customerorder_id/'+btoa(customer_id),
	            type : "GET",
	            dataType: 'JSON',
	            success:function(resp){
	                if(resp.status=='success'){
						$("#show_deduct_amount_modal").modal('show');
	                    $('#deduct_amount_order_id').html(resp.data);
	                }else if(resp.status=='error'){
	                    $("#show_deduct_amount_modal").modal('hide');
	                }
	            }
	        })
		});
		$('body').on('click','.close_transaction_model',function(){
			$('#add_deduct_amount')[0].reset();   
			$('#add_compensation')[0].reset();   
			$('#add_bank_transfer')[0].reset();   
		});
		/*TAB 5*/
	})	
</script>
<!-- Mirrored from demo.interface.club/limitless/layout_1/LTR/default/components_tabs.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 05:45:43 GMT -->
</html>