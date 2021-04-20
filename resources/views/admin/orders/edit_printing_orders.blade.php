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

	<!-- Theme JS files -->	
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/uploaders/fileinput/fileinput.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/core/app.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/charts/c3/c3_bars_pies.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/charts/c3/c3_axis.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/pages/uploader_bootstrap.js"></script>
	<!-- /theme JS files -->
	<style type="text/css">
		.red{
			color:red;
		}
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
				<!-- Page header -->
				<div class="page-header page-header-default">
					@include('admin.layout.breadcrumb')	
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					@include('admin.layout._operation_status')
					<!-- Basic tabs title -->
					<!-- <h6 class="content-group text-semibold">
						Basic tabs layout
						<small class="display-block">Default tabs layout options</small>
					</h6> -->
					<!-- /basic tabs title -->
						<!-- <div class="col-md-6"> -->
							<div class="panel panel-flat">
								<!-- <div class="panel-heading">
									<h6 class="panel-title">Rounded justified</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div> -->

								<div class="panel-body">
									<div class="tabbable agent-managment-tabs-main" id="tabload">
										<ul class="nav nav-tabs nav-tabs-solid nav-tabs-component nav-justified">
											<li class="active"><a href="#overview" data-toggle="tab">Overview</a></li>
											<li><a class="justified-tab2" href="#finance_details" data-toggle="tab" id="finance_details_listing">Finance Details</a></li>
											<li><a href="#bank_details" data-toggle="tab" id="view_order_compensation">Compensation</a></li>
											<li><a href="#agent_products" data-toggle="tab" id="view_order_status_history">History</a></li>
											<li><a href="#extra_notes" data-toggle="tab" id="view_extra_notes">Extra Notes</a></li>											
										</ul>

										<div class="tab-content edit-order-main-section">
											<div class="tab-pane active" id="overview">
												<div class="row">
													<div class="col-lg-4">
														<div class="panel agent-edit-main">
														
															<div class="agent-information-section">
																<div class="agent-information-main">
																	<div class="agent-information-head">
																		Name 
																	</div>
																	<div class="agent-information-content">
																		<span>:</span> {{ $arr_data['get_customer_details']['full_name'] ?? '-' }}
																	</div>
																</div>
																<div class="agent-information-main">
																	<div class="agent-information-head">
																		Group
																	</div>
																	<div class="agent-information-content">
																		<span>:</span> {{ $arr_data['get_customer_details']['get_group_details']['group_name'] ?? '-' }}
																	</div>
																</div>
																<div class="agent-information-main">
																	<div class="agent-information-head">
																		Phone
																	</div>
																	<div class="agent-information-content">
																		<span>:</span> {{ $arr_data['get_customer_details']['mobile_number'] ?? '-' }}
																	</div>																	
																</div>	
																<div class="agent-information-main">
																	<div class="agent-information-head">
																		Email
																	</div>
																	<div class="agent-information-content">
																		<span>:</span> {{ $arr_data['get_customer_details']['email'] ?? '-' }}
																	</div>																	
																</div>
																<div class="agent-information-main">
																	<div class="agent-information-head">
																		Rank
																	</div>
																	<div class="agent-information-content">
																		<span>:</span> 102
																	</div>																	
																</div>	
																<div class="agent-information-main">
																	<div class="agent-information-head">
																		Age
																	</div>
																	<div class="agent-information-content">
																		<span>:</span> {{ get_formated_date($arr_data['get_customer_details']['created_at']) ?? '-' }}
																	</div>																	
																</div>											
																<div class="clearfix"></div>
															</div>	
															<div class="clearfix"></div>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="panel agent-edit-main edit-order-col">
														
															<div class="agent-information-section">
																<div class="agent-information-main">
																	<div class="agent-information-head">
																		Order ID
																	</div>
																	<div class="agent-information-content">
																		<span>:</span> {{ $arr_data['order_id'] ?? '-' }}
																	</div>
																</div>
																<div class="agent-information-main">
																	<div class="agent-information-head">
																		Order Value
																	</div>
																	<div class="agent-information-content">
																		<span>:</span> {{ $arr_data['order_total_amount'] ?? '-' }}
																	</div>
																</div>
																<div class="agent-information-main">
																	<div class="agent-information-head">
																		Order Status
																	</div>
																	<div class="agent-information-content">
																		<span>:</span> {{ $arr_data['printing_status'] ?? '-' }}
																	</div>																	
																</div>	
																<div class="agent-information-main">
																	<div class="agent-information-head">
																		Order Time
																	</div>
																	<div class="agent-information-content">
																		<span>:</span> <?php echo get_formated_date($arr_data['created_at'])?>
																	</div>																	
																</div>
																<div class="agent-information-main">
																	<div class="agent-information-head">
																		Printed Time
																	</div>
																	<div class="agent-information-content">
																		<span>:</span> 
																		@if($arr_data['printing_status']=='completed')
																			{{ $arr_data['updated_at'] ?? '-' }}
																		@else
																			{{ '-' }}
																		@endif
																	</div>																	
																</div>	
																<div class="agent-information-main">
																	<div class="agent-information-head">
																		Delivered Time
																	</div>
																	<div class="agent-information-content">
																		<span>:</span>
																		@if($arr_data['delivery_status']=='completed')
																			{{ $arr_data['updated_at'] ?? '-' }}
																		@else
																			{{ '-' }}
																		@endif
																	</div>																	
																</div>															
																<div class="clearfix"></div>
															</div>	
															<div class="clearfix"></div>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="panel agent-edit-main edit-order-col">
															@if(isset($arr_data['create_shipment']) && $arr_data['create_shipment']==0)
																<a class="btn btn-primary" href="javascript:void(0)" id="create_label">Create Label</a>
															@endif
															<div id="modal_form_vertical_create_label" class="modal fade addUserModalMain">
																<div class="modal-dialog">
																	<div class="modal-content">
																		
																		<div class="modal-header bg-primary">
																			<button type="button" class="close" data-dismiss="modal">&times;</button>
																			<h5 class="modal-title">Create Label</h5>
																		</div>
																		<form action="{{ $module_url_path }}/create_shipment" id="create_shipment" method="post" enctype="multipart/form-data" >
																		{{csrf_field()}}
																			<div class="modal-body">
																			
																				<input type="hidden" name="order_id" id="order_id" value="{{ $arr_data['id'] ?? '' }}">
																				<div class="row">
																					<div class="col-sm-6 col-md-6 col-lg-12">				
																						<div class="form-group">								
																							<label>Quantity <i class="red" >*</i></label>
																							<input type="text" class="form-control" data-rule-required="true" name="create_label_quantity" id="create_label_quantity" data-rule-number="true">						
																						</div>	
																					</div>
																				</div>
																			

																				<div class="row">
																					<div class="col-sm-6 col-md-6 col-lg-12">				
																						<div class="form-group">								
																							<label>Box<i class="red" >*</i></label>
																							<input type="radio"  id="box" name="create_label_type" class="styled" value="box" checked>	
																							<label>Envolope<i class="red" >*</i></label>
																							<input type="radio"  id="envolope" name="create_label_type" class="styled" value="envolope">				
																						</div>	
																					</div>
																				</div>

																			</div>

																			<div class="modal-footer">
																				<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
																				<button type="submit" class="btn btn-primary">Add</button>
																			</div>
																		</form>
																	</div>
																</div>
															</div>
															<div class="agent-information-section">
																<div class="agent-information-main">
																	<div class="agent-information-head">
																		Delivery Type
																	</div>
																	<div class="agent-information-content">
																		<span>:</span> {{ $arr_data['get_delivery_type']['delivery_type'] ?? '-' }}
																	</div>
																</div>
																<div class="agent-information-main">
																	<div class="agent-information-head">
																		Weight
																	</div>
																	<div class="agent-information-content">
																		<span>:</span> 1.54 kg
																	</div>
																</div>
																<div class="agent-information-main">
																	<div class="agent-information-head">
																		Reference
																	</div>
																	<div class="agent-information-content">
																		<span>:</span> <a href="javascript:void(0)">{{ $arr_data['get_shipment_details']['shipment_id'] ?? '-' }}</a>
																	</div>																	
																</div>	
																<div class="agent-information-main">
																	<div class="agent-information-head">
																		Address
																	</div>
																	<div class="agent-information-content">
																		<span>:</span> {{ $arr_data['get_customer_details']['address'] ?? '-' }}
																	</div>																	
																</div>
																<div class="agent-information-main">
																	<div class="agent-information-head">
																		Link
																	</div>
																	@if(isset($arr_data['create_shipment']) && $arr_data['create_shipment']==1)
																		<div class="agent-information-content">
																			<span>:</span> <a target="_blank" href="{{ $arr_data['get_shipment_details']['LabelURL'] ?? 'javascript:void(0)' }}">Link</a>
																		</div>
																	@else
																		<div class="agent-information-content">
																			<span>:</span> - 
																		</div>
																	@endif
																</div>														
																<div class="clearfix"></div>
															</div>	
															<div class="clearfix"></div>
														</div>
													</div>
													
												</div>												
												<table class="table datatable-column-search-inputs" id="datatable_customer_orders">
													<thead>
														<tr>
															<th>#</th>
															<th>ID</th>
															<th>Product Name</th>
															<th>Options</th>
															<th>Agent</th>
															<th>Status</th>
															<th>File</th>
															<th>QTY</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
												</table>												
											</div>

											<div class="tab-pane" id="finance_details">
												<div class="table-responsive">
													<table class="table table-bordered table-framed">
														<thead>
															<tr>
																<th>#</th>
																<th>Product Name</th>
																<th>Pack</th>
																<th>Unit Price</th>
																<th>QTY</th>
																<th>Total Price</th>
															</tr>
														</thead>
														<tbody id="append_finance_details">
														</tbody>
													</table>
												</div>
											</div>

											<div class="tab-pane" id="bank_details">
													<div class="add-user-btn-main">
														<a class="btn btn-primary"  id="" href="javascript:void(0)">Show Compensation</a>
													</div>					
													<div class="add-user-btn-main">
														<a class="btn btn-primary"  id="" href="javascript:void(0)">Hide Compensation</a>
													</div>
													<div class="add-user-btn-main">
														<a class="btn btn-primary"  id="" href="javascript:void(0)">Cancel the Order</a>
													</div>
													<div class="add-user-btn-main">
														<a class="btn btn-primary"  id="open_add_compensation" href="javascript:void(0)">Add Compensation</a>
													</div>
													<div id="modal_form_vertical_compensation" class="modal fade addUserModalMain">
														<div class="modal-dialog">
															<div class="modal-content">
																
																<div class="modal-header bg-primary">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<h5 class="modal-title">Add Compensation</h5>
																</div>
																<form action="{{ url('/') }}/admin/orders/store_printing_order_compensation" id="add_compensation" method="post" enctype="multipart/form-data" >
																{{csrf_field()}}
																	<div class="modal-body">
																	
																		<input type="hidden" name="order_id" id="order_id" value="{{ $arr_data['id'] ?? '' }}">
																		<div class="row">
																			<div class="col-sm-6 col-md-6 col-lg-12">				
																				<div class="form-group">								
																					<label>Item <i class="red" >*</i></label>
																					<select class="form-control" data-rule-required="true" name="compensate_item" id="compensate_item"></select>							
																				</div>	
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-sm-6 col-md-6 col-lg-12">				
																				<div class="form-group">								
																					<label>Quantity <i class="red" >*</i></label>
																					<input class="form-control" data-rule-required="true" name="compensate_quantity" id="compensate_quantity">					
																				</div>	
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-sm-6 col-md-6 col-lg-12">				
																				<div class="form-group">								
																					<label>Owner <i class="red" >*</i></label>
																					<input class="form-control" data-rule-required="true" name="compensate_owner" id="compensate_owner">
																					<select class="form-control" id="category_id" data-rule-required="true" name="category_id" >
															<option value="">Select Agent</option>
															@foreach($arr_agent as $key_agent => $value_agent)
																<option value="{{ $value_agent['id'] ?? '' }}">{{ $value_agent['full_name'] ?? '' }}</option>
															@endforeach	
														</select>					
																				</div>	
																			</div>
																		</div>

																		<div class="row">
																			<div class="col-sm-6 col-md-6 col-lg-12">				
																				<div class="form-group">								
																					<label>Type <i class="red" >*</i></label>
																					<select class="form-control" data-rule-required="true" name="compensate_type" id="compensate_type">
																						<option value="re_order">Re-Order</option>
																						<option value="re_order_and_deliver">Re-Order and Deliver</option>
																						<option value="deduct"> Deduct</option>
																					</select>					
																				</div>	
																			</div>
																		</div>

																		<div class="row">
																			<div class="col-sm-6 col-md-6 col-lg-12">				
																				<div class="form-group">								
																					<label>Note <i class="red" >*</i></label>
																					<textarea class="form-control" id="compensate_note" name="compensate_note"></textarea> 
																				</div>	
																			</div>
																		</div>
																		
																	</div>

																	<div class="modal-footer">
																		<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
																		<button type="submit" class="btn btn-primary">Add</button>
																	</div>
																</form>
															</div>
														</div>
													</div>
												<table class="table datatable-column-search-inputs" id="datatable_order_compensation_history">
													<thead>
														<tr>
															<th>#</th>
															<th>Compensation ID</th>
											                <th>Product Name</th>
											                <th>QTY</th>
											                <th>Cost Owner</th>
											                <th>Type</th>
											                <th>Notes</th>
											                <th>Action</th>
											            </tr>
													</thead>
													<tbody>
													</tbody>
												</table>
											</div>

											<div class="tab-pane" id="agent_products">
												
												<table class="table datatable-column-search-inputs" id="datatable_order_status_history">
													<thead>
														<tr>
															<th>#</th>
															<th>Old Status</th>
											                <th>New Status</th>
											                <th>By</th>
											                <th>Name</th>
											                <th>Time</th>
											            </tr>
													</thead>
													<tbody>
													</tbody>
												</table>
											</div>
											<div class="tab-pane" id="extra_notes">
													<div class="add-user-btn-main">
														<a class="btn btn-primary"  id="open_add_extra_note" href="javascript:void(0)">Add Note</a>
													</div>					
													
													<div id="modal_form_vertical" class="modal fade addUserModalMain">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header bg-primary">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<h5 class="modal-title">Add Note</h5>
																</div>
																<form action="{{ url('/') }}/admin/orders/store_printing_order_note" id="add_note" method="post" enctype="multipart/form-data" >
																{{csrf_field()}}
																	<div class="modal-body">
																	
																		<div class="row">
																			<div class="col-sm-6 col-md-6 col-lg-12">				
																				<div class="form-group">								
																					<label>Note <i class="red" >*</i></label>
																					<input data-rule-required="true" id="note" name="note" class="form-control">	
																					
																				</div>	
																			</div>
																			<input type="hidden" name="order_id" id="order_id" value="{{ $arr_data['id'] ?? '' }}">
																		</div>
																		
																	</div>

																	<div class="modal-footer">
																		<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
																		<button type="submit" class="btn btn-primary">Add</button>
																	</div>
																</form>
															</div>
														</div>
													</div>
												<table class="table datatable-column-search-inputs" id="datatable_extra_notes">
													<thead>
														<tr>
															<th>#</th>
															<th>Notes
											                	<!-- <input type="text" name="product_id" placeholder="Search" class="search-block-new-table form-control column_filter"> -->
											                </th>
											                <th>Added By </th>
											                <th>Time</th>
											              
											            </tr>
													</thead>
													<tbody>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						<!-- </div> -->
					<!-- </div> -->
					<!-- /rounded solid tabs -->



					<!-- Vertical tabs -->
					<!-- <h6 class="content-group text-semibold">
						Vertical tabs
						<small class="display-block">Display tabs nav on left or right side</small>
					</h6>

					<div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Left side placement</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable nav-tabs-vertical nav-tabs-left">
										<ul class="nav nav-tabs nav-tabs-highlight">
											<li class="active"><a href="#left-tab1" data-toggle="tab"><i class="icon-menu7 position-left"></i> Active</a></li>
											<li><a href="#left-tab2" data-toggle="tab"><i class="icon-mention position-left"></i> Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog5 position-left"></i> Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu">
													<li><a href="#left-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#left-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active has-padding" id="left-tab1">
												Basic tabs example using <code>.nav-tabs</code> class. Also requires base <code>.nav</code> class.
											</div>

											<div class="tab-pane has-padding" id="left-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane has-padding" id="left-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane has-padding" id="left-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Right side placement</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable nav-tabs-vertical nav-tabs-right">
										<div class="tab-content">
											<div class="tab-pane active has-padding" id="right-tab1">
												Basic tabs example using <code>.nav-tabs</code> class. Also requires base <code>.nav</code> class.
											</div>

											<div class="tab-pane has-padding" id="right-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane has-padding" id="right-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane has-padding" id="right-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>

										<ul class="nav nav-tabs nav-tabs-highlight">
											<li class="active"><a href="#right-tab1" data-toggle="tab"><span class="label label-danger pull-right">Bug</span> Active</a></li>
											<li><a href="#right-tab2" data-toggle="tab"><span class="label label-info pull-right">Fixed</span> Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="badge badge-success pull-right">37</span> Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu">
													<li><a href="#right-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#right-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /vertical tabs -->



					<!-- Colored tabs title -->
					<!-- <h6 class="content-group text-semibold">
						Colored tabs
						<small class="display-block">Tabs with custom background color</small>
					</h6> -->
					<!-- /colored tabs title -->


					<!-- Colored tabs -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Colored tabs</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs bg-teal-400">
											<li class="active"><a href="#colored-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#colored-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#colored-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#colored-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="colored-tab1">
												Add <code>custom</code> background color to the tabs using <code>.bg-*</code> class.
											</div>

											<div class="tab-pane" id="colored-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="colored-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="colored-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Colored justified</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs bg-teal-400 nav-justified">
											<li class="active"><a href="#colored-justified-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#colored-justified-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#colored-justified-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#colored-justified-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="colored-justified-tab1">
												To use in tabs with equal widths add <code>.nav-justified .bg-*</code> classes.
											</div>

											<div class="tab-pane" id="colored-justified-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="colored-justified-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="colored-justified-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /colored tabs -->


					<!-- Rounded colored tabs -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Colored rounded</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs bg-slate nav-tabs-component">
											<li class="active"><a href="#colored-rounded-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#colored-rounded-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#colored-rounded-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#colored-rounded-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="colored-rounded-tab1">
												In colored tabs <code>.nav-tabs-component</code> class rounds tabs container and first tab corners.
											</div>

											<div class="tab-pane" id="colored-rounded-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="colored-rounded-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="colored-rounded-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Rounded justified</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs bg-slate nav-tabs-component nav-justified">
											<li class="active"><a href="#colored-rounded-justified-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#colored-rounded-justified-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#colored-rounded-justified-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#colored-rounded-justified-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="colored-rounded-justified-tab1">
												For justified tabs use <code>.nav-justified .bg-* .nav-tabs-component</code> classes.
											</div>

											<div class="tab-pane" id="colored-rounded-justified-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="colored-rounded-justified-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="colored-rounded-justified-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /rounded colored tabs -->



					<!-- Tab options title -->
					<!-- <h6 class="content-group text-semibold">
						Other tab options
						<small class="display-block">Animations, position, borders, content</small>
					</h6> -->
					<!-- /tab options title -->


					<!-- Animations -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Fade animation</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-highlight">
											<li class="active"><a href="#fade-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#fade-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#fade-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#fade-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane fade in active" id="fade-tab1">
												To make tabs fade in, add <code>.fade</code> to each <code>.tab-pane</code> and <code>.in</code> to the active tab.
											</div>

											<div class="tab-pane fade" id="fade-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane fade" id="fade-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane fade" id="fade-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">CSS animations</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-highlight">
											<li class="active"><a href="#css-animate-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#css-animate-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#css-animate-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#css-animate-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane animated bounceIn active" id="css-animate-tab1">
												To use custom animations, add animation classes to each <code>.tab-pane</code> container.
											</div>

											<div class="tab-pane animated fadeInUp" id="css-animate-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane animated zoomIn" id="css-animate-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane animated flipInX" id="css-animate-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /animations -->


					<!-- Tabs position -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Centered position</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-highlight text-center">
											<li class="active"><a href="#centered-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#centered-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#centered-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#centered-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="centered-tab1">
												To use centered tabs, add <code>.text-center</code> to the <code>.nav-tabs</code> class.
											</div>

											<div class="tab-pane" id="centered-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="centered-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="centered-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Right position</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-highlight text-right">
											<li class="active"><a href="#right-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#right-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#right-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#right-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="right-tab1">
												To use right aligned tabs, add <code>.text-right</code> to the <code>.nav-tabs</code> class.
											</div>

											<div class="tab-pane" id="right-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="right-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="right-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /tabs position -->


					<!-- Bordered tab content -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Bordered tab content</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable tab-content-bordered">
										<ul class="nav nav-tabs nav-tabs-highlight">
											<li class="active"><a href="#bordered-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#bordered-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#bordered-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#bordered-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane has-padding active" id="bordered-tab1">
												To apply border and padding to the tab content, add <code>.tab-content-bordered</code> to the parent container.
											</div>

											<div class="tab-pane has-padding" id="bordered-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane has-padding" id="bordered-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane has-padding" id="bordered-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Bordered justified</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable tab-content-bordered">
										<ul class="nav nav-tabs nav-tabs-highlight nav-justified">
											<li class="active"><a href="#bordered-justified-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#bordered-justified-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#bordered-justified-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#bordered-justified-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane has-padding active" id="bordered-justified-tab1">
												To use in tabs with equal widths add <code>.nav-justified</code> and <code>.tab-content-bordered</code> to the parent container.
											</div>

											<div class="tab-pane has-padding" id="bordered-justified-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane has-padding" id="bordered-justified-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane has-padding" id="bordered-justified-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /bordered tab content -->



					<!-- Tab icons -->
					<!-- <h6 class="content-group text-semibold">
						Tabs with icons
						<small class="display-block">Show icons in different positions</small>
					</h6> -->
					<!-- /tab icons title -->


					<!-- Left icons -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Tabs with left icons</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-highlight">
											<li class="active"><a href="#left-icon-tab1" data-toggle="tab"><i class="icon-menu7 position-left"></i> Active</a></li>
											<li><a href="#left-icon-tab2" data-toggle="tab"><i class="icon-mention position-left"></i> Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-gear position-left"></i> Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#left-icon-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#left-icon-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="left-icon-tab1">
												Add icon markup <code>before</code> tab nav text to display icons on the left side.
											</div>

											<div class="tab-pane" id="left-icon-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="left-icon-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="left-icon-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Justified tabs. Left icons</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-highlight nav-justified">
											<li class="active"><a href="#justified-left-icon-tab1" data-toggle="tab"><i class="icon-menu7 position-left"></i> Active</a></li>
											<li><a href="#justified-left-tab2" data-toggle="tab"><i class="icon-mention position-left"></i> Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-gear position-left"></i> Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#justified-left-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#justified-left-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="justified-left-tab1">
												To use in tabs with equal widths add <code>.nav-justified</code> and icon markup to the tab nav.
											</div>

											<div class="tab-pane" id="justified-left-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="justified-left-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="justified-left-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /left icons -->


					<!-- Right icons -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Tabs with right icons</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-bottom">
											<li class="active"><a href="#right-icon-tab1" data-toggle="tab">Active <i class="icon-menu7 position-right"></i></a></li>
											<li><a href="#right-icon-tab2" data-toggle="tab">Inactive <i class="icon-mention position-right"></i></a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <i class="icon-gear position-right"></i> <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#right-icon-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#right-icon-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="right-icon-tab1">
												Add icon markup <code>after</code> tab nav text to display icons on the right side.
											</div>

											<div class="tab-pane" id="right-icon-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="right-icon-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="right-icon-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Justified tabs. Right icons</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-bottom nav-justified">
											<li class="active"><a href="#justified-right-icon-tab1" data-toggle="tab">Active <i class="icon-menu7 position-right"></i></a></li>
											<li><a href="#justified-right-icon-tab2" data-toggle="tab">Inactive <i class="icon-mention position-right"></i></a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <i class="icon-gear position-right"></i><span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#justified-right-icon-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#justified-right-icon-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="justified-right-icon-tab1">
												To use in tabs with equal widths add <code>.nav-justified</code> and icon markup to the tab nav.
											</div>

											<div class="tab-pane" id="justified-right-icon-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="justified-right-icon-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="justified-right-icon-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /right icons -->


					<!-- Top icons -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Tabs with top icons</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-bottom bottom-divided nav-tabs-icon">
											<li class="active"><a href="#top-icon-tab1" data-toggle="tab"><i class="icon-menu7"></i> Active</a></li>
											<li><a href="#top-icon-tab2" data-toggle="tab"><i class="icon-mention"></i> Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-gear"></i> Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#top-icon-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#top-icon-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="top-icon-tab1">
												To display icon on top, add icon code and <code>.nav-tabs-icon</code> class to the tabs nav container.
											</div>

											<div class="tab-pane" id="top-icon-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="top-icon-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="top-icon-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Justified tabs. Top icons</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-bottom bottom-divided nav-justified nav-tabs-icon">
											<li class="active"><a href="#justified-top-icon-tab1" data-toggle="tab"><i class="icon-menu7"></i> Active</a></li>
											<li><a href="#justified-top-icon-tab2" data-toggle="tab"><i class="icon-mention"></i> Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-gear"></i> Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#justified-top-icon-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#justified-top-icon-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="justified-top-icon-tab1">
												To use in tabs with equal widths add <code>.nav-justified</code> and icon markup to the tab nav.
											</div>

											<div class="tab-pane" id="justified-top-icon-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="justified-top-icon-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="justified-top-icon-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /top icons -->


					<!-- Icons only -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Tabs with icons only</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-top">
											<li class="active">
												<a href="#icon-only-tab1" data-toggle="tab">
													<i class="icon-menu7"></i>
													<span class="visible-xs-inline-block position-right">Active</span>
												</a>
											</li>

											<li>
												<a href="#icon-only-tab2" data-toggle="tab">
													<i class="icon-mention"></i>
													<span class="visible-xs-inline-block position-right">Inactive</span>
												</a>
											</li>

											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-gear"></i>
													<span class="visible-xs-inline-block position-right">Dropdown</span>
													<span class="caret"></span>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#icon-only-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#icon-only-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="icon-only-tab1">
												If tab nav doesn't have a text, add icon markup to display icon only.
											</div>

											<div class="tab-pane" id="icon-only-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="icon-only-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="icon-only-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Justified tabs. Icons only</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-top nav-justified">
											<li class="active">
												<a href="#justified-icon-only-tab1" data-toggle="tab">
													<i class="icon-menu7"></i>
													<span class="visible-xs-inline-block position-right">Active</span>
												</a>
											</li>

											<li>
												<a href="#justified-icon-only-tab2" data-toggle="tab">
													<i class="icon-mention"></i>
													<span class="visible-xs-inline-block position-right">Inactive</span>
												</a>
											</li>

											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-gear"></i>
													<span class="visible-xs-inline-block position-right">Dropdown</span>
													<span class="caret"></span>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#justified-icon-only-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#justified-icon-only-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="justified-icon-only-tab1">
												To use in tabs with equal widths add <code>.nav-justified</code> and icon markup to the tab nav.
											</div>

											<div class="tab-pane" id="justified-icon-only-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="justified-icon-only-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="justified-icon-only-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /icons only -->



					<!-- Tab labels title -->
					<!-- <h6 class="content-group text-semibold">
						Tabs with labels
						<small class="display-block">Display labels and badges</small>
					</h6> -->
					<!-- /tab labels title -->


					<!-- Labels -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Tabs with labels</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-highlight">
											<li class="active"><a href="#label-tab1" data-toggle="tab"><span class="label label-danger position-left">Bug</span> Active</a></li>
											<li><a href="#label-tab2" data-toggle="tab">Inactive <span class="label bg-slate position-right">Fixed</span></a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-info">Priority</span> <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#label-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#label-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="label-tab1">
												Display <code>labels</code> on the left/right sides and in empty tab nav. Empty labels are hidden.
											</div>

											<div class="tab-pane" id="label-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="label-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="label-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Justified tabs with labels</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-highlight nav-justified">
											<li class="active"><a href="#justified-label-tab1" data-toggle="tab"><span class="label label-danger position-left">Bug</span> Active</a></li>
											<li><a href="#justified-label-tab2" data-toggle="tab">Inactive <span class="label label-info position-right">Fixed</span></a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-success">Priority</span> <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#justified-label-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#justified-label-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="justified-label-tab1">
												To use in tabs with equal widths add <code>.nav-justified</code> and label markup to the tab nav.
											</div>

											<div class="tab-pane" id="justified-label-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="justified-label-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="justified-label-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /labels -->


					<!-- Badges -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Tabs with badges</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-highlight">
											<li class="active"><a href="#badges-tab1" data-toggle="tab"><span class="badge badge-success position-left">78</span> Active</a></li>
											<li><a href="#badges-tab2" data-toggle="tab">Inactive <span class="badge badge-danger position-right">23</span></a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="badge bg-slate">34</span> <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#badges-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#badges-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="badges-tab1">
												Display <code>badges</code> on the left/right sides and in empty tab nav. Empty badges are hidden.
											</div>

											<div class="tab-pane" id="badges-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="badges-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="badges-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Justified tabs with badges</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-highlight nav-justified">
											<li class="active"><a href="#justified-badges-tab1" data-toggle="tab"><span class="badge badge-danger position-left">87</span> Active</a></li>
											<li><a href="#justified-badges-tab2" data-toggle="tab">Inactive <span class="badge bg-slate position-right">23</span></a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="badge badge-info">34</span> <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#justified-badges-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#justified-badges-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="justified-badges-tab1">
												To use in tabs with equal widths add <code>.nav-justified</code> and badge markup to the tab nav.
											</div>

											<div class="tab-pane" id="justified-badges-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="justified-badges-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="justified-badges-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /badges -->



					<!-- Tabs sizing title -->
					<!-- <h6 class="content-group text-semibold">
						Tabs sizing
						<small class="display-block">Available tabs sizing with elements</small>
					</h6> -->
					<!-- /tabs sizing title -->


					<!-- Large size -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Large size</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-lg nav-tabs nav-tabs-solid nav-tabs-component">
											<li class="active"><a href="#large-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#large-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#large-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#large-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="large-tab1">
												To use large size, add <code>.nav-tabs-lg</code> class to the <code>.nav-tabs</code> base class.
											</div>

											<div class="tab-pane" id="large-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="large-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="large-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Large with elements</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-lg nav-tabs nav-tabs-solid nav-tabs-component nav-justified">
											<li class="active"><a href="#large-justified-tab1" data-toggle="tab"><i class="icon-menu7 position-left"></i> Active</a></li>
											<li><a href="#large-justified-tab2" data-toggle="tab"><span class="label label-danger position-left">Done</span> Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="badge bg-slate position-right">39</span> <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#large-justified-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#large-justified-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="large-justified-tab1">
												To use in tabs with equal widths add <code>.nav-justified .nav-tabs-lg</code> classes.
											</div>

											<div class="tab-pane" id="large-justified-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="large-justified-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="large-justified-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /large size -->


					<!-- Default size -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Default size</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-solid nav-tabs-component">
											<li class="active"><a href="#default-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#default-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#default-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#default-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="default-tab1">
												Default tabs size doesn't require any additional sizing classes.
											</div>

											<div class="tab-pane" id="default-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="default-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="default-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Default with elements</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-solid nav-tabs-component nav-justified">
											<li class="active"><a href="#default-justified-tab1" data-toggle="tab"><i class="icon-menu7 position-left"></i> Active</a></li>
											<li><a href="#default-justified-tab2" data-toggle="tab"><span class="label label-danger position-left">Done</span> Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="badge bg-slate position-right">39</span> <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#default-justified-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#default-justified-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="default-justified-tab1">
												To use in default tabs with equal widths add <code>.nav-justified</code> class.
											</div>

											<div class="tab-pane" id="default-justified-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="default-justified-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="default-justified-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /default size -->


					<!-- Small size -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Small size</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-sm nav-tabs nav-tabs-solid nav-tabs-component">
											<li class="active"><a href="#small-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#small-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#small-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#small-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="small-tab1">
												To use small size, add <code>.nav-tabs-sm</code> class to the <code>.nav-tabs</code> base class.
											</div>

											<div class="tab-pane" id="small-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="small-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="small-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>-->
						<!-- /small size -->

						<!-- <div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Small with elements</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-sm nav-tabs nav-tabs-solid nav-tabs-component nav-justified">
											<li class="active"><a href="#small-justified-tab1" data-toggle="tab"><i class="icon-menu7 position-left"></i> Active</a></li>
											<li><a href="#small-justified-tab2" data-toggle="tab"><span class="label label-danger position-left">Done</span> Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="badge bg-slate position-right">39</span> <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#small-justified-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#small-justified-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="small-justified-tab1">
												To use in tabs with equal widths add <code>.nav-justified .nav-tabs-sm</code> classes.
											</div>

											<div class="tab-pane" id="small-justified-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="small-justified-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="small-justified-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div> -->
					<!-- </div> --> 


					<!-- Mini size -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Mini size</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-xs nav-tabs nav-tabs-solid nav-tabs-component">
											<li class="active"><a href="#mini-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#mini-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#mini-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#mini-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="mini-tab1">
												To use mini size, add <code>.nav-tabs-xs</code> class to the <code>.nav-tabs</code> base class.
											</div>

											<div class="tab-pane" id="mini-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="mini-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="mini-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Mini with elements</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-xs nav-tabs nav-tabs-solid nav-tabs-component nav-justified">
											<li class="active"><a href="#mini-justified-tab1" data-toggle="tab"><i class="icon-menu7 position-left"></i> Active</a></li>
											<li><a href="#mini-justified-tab2" data-toggle="tab"><span class="label label-danger position-left">Done</span> Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="badge bg-slate position-right">39</span> <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#mini-justified-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#mini-justified-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="mini-justified-tab1">
												To use in tabs with equal widths add <code>.nav-justified .nav-tabs-xs</code> classes.
											</div>

											<div class="tab-pane" id="mini-justified-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="mini-justified-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="mini-justified-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /mini size -->


					<!-- Footer -->
					<!-- <div class="footer text-muted">
						&copy; 2015. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
					</div> -->
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
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.all.js"></script> -->
<script src="{{url('/')}}/assets/admin/assets/js/pages/sweetalert_msg.js"></script>
<script src="{{url('/')}}/assets/admin/assets/js/pages/sweetalert.min.js"></script>
<script>
	$(document).ready(function(){
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

		$("#add_note").validate();
		$("#add_compensation").validate();
		
		$('body').on('click','#open_add_extra_note',function(){
			$("#modal_form_vertical").modal('show');

		});
		$('body').on('change','#country',function(){
			var id = btoa($(this).val());
			 $.ajax({
	            url : '{{ url('/') }}/admin/agent/get_cities/'+id,
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

		/*TAB 1*/
		var order_id  = "{{ $arr_data['id'] ??''}}";
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
			    "serverSide": false,
			    "searchDelay": 350,
			    "autoWidth": false,
			    "bFilter": true,
			    "bLengthChange": true,
		        ajax: {
		            url: "{{ $module_url_path}}/load_orderproducts_data/"+btoa(order_id),
		            data: function(d) {
		                // d['column_filter[product_id]'] 				= $("input[name='product_id']").val()
		          
		            }
		        },
		        columns: [
		           
		            {data : 'sr_no',"orderable":false,"searchable":false,name:'sr_no'},
		            {data : 'product_id',"orderable":false,"searchable":true,name:'product_id'},
		            {data : 'product_name',"orderable":false,"searchable":true,name:'product_name'},
		            {data : 'option',"orderable":false,"searchable":true,name:'option'},
		            {data : 'agent_name',"orderable":false,"searchable":false,name:'agent_name'},
		            {data : 'status',"orderable":false,"searchable":false,name:'status'},
		            {data : 'file',"orderable":false,"searchable":false,name:'file'},
		            {data : 'quantity',"orderable":false,"searchable":false,name:'quantity'}
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
		/*TAB 1*/


		/*Datatable for product TAB 2*/
		// $(".agent-managment-tabs-main").tabs({
		//     select: function(event, ui) {
		//         alert("PRESSED TAB!");
		//     }
		// });
		
		$('#add_product').validate();

		$('body').on('click','#finance_details_listing',function(){
			var order_id  = "{{ $arr_data['id'] ??''}}";
			 $.ajax({
	            url : '{{ $module_url_path}}/get_product_finance_details/'+btoa(order_id),
	            type : "GET",
	            dataType: 'JSON',
	            success:function(resp){
	            	console.log(resp);
	                if(resp.status=='success'){
                    	$('#append_finance_details').html(resp.data);
	                }else if(resp.status=='error'){
	                    $('#append_finance_details').html(resp.data);
	                }
	            }
	        })	
		});

		
		/*Datatable for product TAB 2*/


		/*TAB 3*/
		$('body').on('click','#view_order_compensation',function(){
			var order_id  = "{{ $arr_data['id'] ?? '' }}";
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

			    var table = $('#datatable_order_compensation_history').DataTable({
			        "bStateSave": true,
			        "bSearchable":true,
			        "bDestroy":true,
			        "processing": true,
				    "serverSide": false,
				    "searchDelay": 350,
				    "autoWidth": false,
				    "bFilter": true,
				    "bLengthChange": true,
			        ajax: {
			            url: "{{ $module_url_path}}/load_ordercompensation_data/"+btoa(order_id),
			            data: function(d) {
			                // d['column_filter[invoice_id]'] 				= $("input[name='invoice_id']").val()
			                // d['column_filter[invoice_amount]']   		= $("input[name='invoice_amount']").val()
			            }
			        },
			        columns: [
			            {data : 'sr_no',"orderable":false,"searchable":false,name:'sr_no'},
			            {data : 'compensation_id',"orderable":false,"searchable":true,name:'compensation_id'},
			            {data : 'product_name',"orderable":false,"searchable":true,name:'product_name'},
			            {data : 'quantity',"orderable":false,"searchable":true,name:'quantity'},
			            {data : 'cost_owner',"orderable":false,"searchable":true,name:'cost_owner'},
			            {data : 'type',"orderable":false,"searchable":true,name:'type'},
			            {data : 'notes',"orderable":false,"searchable":true,name:'notes'},
			            {
			                render : function(data, type, row, meta) 
			                {
			                    return row.built_action_btns;
			                },
			                "orderable": false, "searchable":true

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

		$('body').on('click','#open_add_compensation',function(){
			var order_id  = "{{ $arr_data['id'] ??''}}";
			 $.ajax({
	            url : '{{ $module_url_path}}/get_orderproduct_items/'+btoa(order_id),
	            type : "GET",
	            dataType: 'JSON',
	            success:function(resp){
	            	console.log(resp);
	                if(resp.status=='success'){
                    	$('#compensate_item').html(resp.data);
	                }else if(resp.status=='error'){
	                    $('#compensate_item').html(resp.data);
	                }
	            }
	        })	

			$('#modal_form_vertical_compensation').modal('show');
		});
		/*TAB 3*/


		/*TAB 4*/
		$('body').on('click','#view_order_status_history',function(){
			var order_id  = "{{ $arr_data['id'] ?? '' }}";
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

			    var table = $('#datatable_order_status_history').DataTable({
			        "bStateSave": true,
			        "bSearchable":true,
			        "processing": true,
				    "serverSide": false,
				    "searchDelay": 350,
				    "autoWidth": false,
				    "bFilter": true,
				    "bLengthChange": true,
			        ajax: {
			            url: "{{ $module_url_path}}/load_orderstatushistory_data/"+btoa(order_id),
			            data: function(d) {
			                // d['column_filter[invoice_id]'] 				= $("input[name='invoice_id']").val()
			                // d['column_filter[invoice_amount]']   		= $("input[name='invoice_amount']").val()
			            }
			        },
			        columns: [
			            {data : 'sr_no',"orderable":false,"searchable":false,name:'sr_no'},
			            {data : 'old_status',"orderable":false,"searchable":true,name:'old_status'},
			            {data : 'new_status',"orderable":false,"searchable":true,name:'new_status'},
			            {data : 'done_by',"orderable":false,"searchable":true,name:'done_by'},
			            {data : 'name',"orderable":false,"searchable":true,name:'name'},
			            {data : 'created_at',"orderable":false,"searchable":true,name:'created_at'},

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
		$('body').on('click','#view_extra_notes',function(){
			var order_id  = "{{ $arr_data['id'] ?? '' }}";
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

			    var table = $('#datatable_extra_notes').DataTable({
			        "bStateSave": true,
			        "bSearchable":true,
			        "processing": true,
				    "serverSide": false,
				    "searchDelay": 350,
				    "autoWidth": false,
				    "bFilter": true,
				    "bLengthChange": true,
			        ajax: {
			            url: "{{ $module_url_path}}/load_extranotes_data/"+btoa(order_id),
			            data: function(d) {
			                d['column_filter[invoice_id]'] 				= $("input[name='invoice_id']").val()
			                d['column_filter[invoice_amount]']   		= $("input[name='invoice_amount']").val()
			            }
			        },
			        columns: [
			            {data : 'sr_no',"orderable":false,"searchable":false,name:'sr_no'},
			            {data : 'notes',"orderable":false,"searchable":true,name:'notes'},
			            {data : 'added_by',"orderable":false,"searchable":true,name:'added_by'},
			            {data : 'created_at',"orderable":false,"searchable":true,name:'created_at'}

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
		/*TAB 5*/
		

		$('body').on('click','#create_label',function(){
			$('#modal_form_vertical_create_label').modal('show');
		});
	})	


	
</script>

<!-- Mirrored from demo.interface.club/limitless/layout_1/LTR/default/components_tabs.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 05:45:43 GMT -->
</html>
