<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from demo.interface.club/limitless/layout_1/LTR/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 05:31:47 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{config('app.project.name')}}</title>
	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/admin') }}/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/admin') }}/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/admin') }}/assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/admin') }}/assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/admin') }}/assets/css/colors.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- /global stylesheets -->
	<!-- Core JS files -->
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->
	<!-- Theme JS files -->
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/ui/moment/moment.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/pickers/daterangepicker.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/core/libraries/jquery.validate.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/visualization/d3/d3.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/visualization/c3/c3.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/core/app.js"></script>
	<!-- <script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/pages/dashboard.js"></script> -->
	<!-- <script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/charts/c3/c3_bars_pies.js"></script> -->
	<!-- <script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/charts/c3/c3_axis.js"></script> -->
	<!-- /theme JS files -->
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
					<div class="report-header-section">
						<div class="page-head-section-main">
							<div class="page-head-txt">
								Order Reports <span></span>
							</div>
							<div class="breadcrumb-section-main">
								<!-- Common breadcrumb created -->
								@include('admin.layout.breadcrumb')	
							</div>
						</div>						
						<div class="clearfix"></div>
					</div>
					<!-- Main charts -->
					<div class="panel panel-flat">
						<div class="row">
							<div class="col-lg-6">
								<form action="{{$module_url_path}}/get_orders" id="get_orders" method="post" enctype="multipart/form-data" >
									{{csrf_field()}}
									<div class="row">
										<div class="col-lg-5">
											<label >From</label>
											<input type="date" class="form-control" name="from_date" id="from_date" data-rule-required="true" onchange="return set_from_date();">
											<i id="error_from_date" class="error"></i>
										</div>
										<div class="col-lg-5">
											<label >To</label>
											<input type="date" class="form-control" name="to_date" id="to_date" data-rule-required="true" onchange="return set_to_date();">
											<i id="error_to_date" class="error"></i>
										</div>
										<div class="col-lg-2">
											<button type="submit" id="proceed_get" class="btn btn-primary" style="top: 27px;width: 100%">Get</button>
										</div>
									</div>
								</form>
							</div>
							<div class="col-lg-6">
								<form action="{{$module_url_path}}/export_orders" id="export_orders" method="post" enctype="multipart/form-data" >
									{{csrf_field()}}									
									<input type="hidden" id='export_from_date' name="export_from_date">
									<input type="hidden" id='export_to_date' name="export_to_date">
									<button type="button" id="proceed_export_orders" onclick="return export_orders();" class="btn btn-primary" style="top: 27px;"><i class="fa fa-file-excel-o"></i> Export</button>									
								</form>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="panel panel-flat panel-graph">
								<h3>Top 5 Cities</h3>
								<table class="table">
									<thead>
										<tr>
											<th>#</th>
											<th>City</th>
											<th># of Orders</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th>1</th>
											<th>Riyadh</th>
											<th>190,231</th>
										</tr>
										<tr>
											<th>2</th>
											<th>Jeddah</th>
											<th>190,231</th>
										</tr>
										<tr>
											<th>3</th>
											<th>Demmam</th>
											<th>190,231</th>
										</tr>
										<tr>
											<th>4</th>
											<th>Madinah</th>
											<th>190,231</th>
										</tr>
										<tr>
											<th>5</th>
											<th>Makkah</th>
											<th>190,231</th>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="panel panel-flat panel-graph">
								<h3>Top Delivery Option</h3>
								<table class="table">
									<thead>
										<tr>
											<th>#</th>
											<th>Option</th>
											<th># of Orders</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th>1</th>
											<th>Pickup</th>
											<th>190,231</th>
										</tr>
										<tr>
											<th>2</th>
											<th>Delivery</th>
											<th>190,231</th>
										</tr>
										<tr>
											<th>3</th>
											<th>Express Delivery</th>
											<th>190,231</th>
										</tr>
									</tbody>						
								</table>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="panel panel-flat panel-graph">
								<h3>Top 5 Days</h3>
								<table class="table">
									<thead>
										<tr>
											<th>#</th>
											<th>City</th>
											<th># of Orders</th>
										</tr>
									</thead>	
									<tbody>
										<tr>
											<th>1</th>
											<th>Monday</th>
											<th>190,231</th>
										</tr>
										<tr>
											<th>2</th>
											<th>Sunday</th>
											<th>190,231</th>
										</tr>
										<tr>
											<th>3</th>
											<th>Friday</th>
											<th>190,231</th>
										</tr>
										<tr>
											<th>4</th>
											<th>Saturday</th>
											<th>190,231</th>
										</tr>
										<tr>
											<th>5</th>
											<th>Tuesday</th>
											<th>190,231</th>
										</tr>
									</tbody>						
								</table>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="panel panel-flat panel-graph">
								<h3>Top 5 Hours</h3>
								<table class="table">
									<thead>
										<tr>
											<th>#</th>
											<th>City</th>
											<th># of Orders</th>
										</tr>
									</thead>	
									<tbody>
										<tr>
											<th>1</th>
											<th>7:00 PM</th>
											<th>190,231</th>
										</tr>
										<tr>
											<th>2</th>
											<th>9:00 PM</th>
											<th>190,231</th>
										</tr>
										<tr>
											<th>3</th>
											<th>10:00 PM</th>
											<th>190,231</th>
										</tr>
										<tr>
											<th>4</th>
											<th>5:00 PM</th>
											<th>190,231</th>
										</tr>
										<tr>
											<th>5</th>
											<th>Makkah</th>
											<th>190,231</th>
										</tr>
									</tbody>						
								</table>
							</div>
						</div>
					</div>					
					<!-- </div> -->
					<div class="panel panel-flat">	
						<div class="add-user-btn-main">
							<span class="table-search-section" style="margin-right: 0">
								<i class="fa fa-search"></i>
								<input type="text" name="search" placeholder="Search">
							</span>														
						</div>
						<div class="clearfix"></div>						
						<table class="table">
							<thead>
								<tr>
									<th>#</th>
									<th>ID</th>
									<th>Customer</th>
									<th>Group</th>
									<th>Value</th>
									<th>City</th>
									<th>Delivery</th>
									<th>Time</th>
									<th>Rate</th>
								</tr>
							</thead>	
							<tbody>
							<!-- {{$i=1}} -->
								@if(isset($arr_orders) && count($arr_orders)>0)
									@foreach($arr_orders as $orders)
										<tr>
											<td>{{$i}}</td>
											<td>{{isset($orders['get_customer_details']['customer_id'])? $orders['get_customer_details']['customer_id'] :'-'}}</td>
											<td>{{isset($orders['get_customer_details']['full_name'])? $orders['get_customer_details']['full_name'] :'-'}}</td>
											<td>Consumer</td>
											<td>{{isset($orders['order_total_amount'])? $orders['order_total_amount'] :'-'}}</td>
											<td>{{isset($orders['get_city']['city_english_name'])? $orders['get_city']['city_english_name'] :'-'}}</td>
											<td>{{isset($orders['get_delivery_type']['delivery_type'])? $orders['get_delivery_type']['delivery_type'] :'-'}}</td>
											<td>2 H -13-06-2020 11:51 PM</td>
											<td>Not Rated</td>
										</tr>
										<!-- {{$i=$i+1}} -->
									@endforeach
								@else
								<tr>
									<td colspan="9" style="text-align:center">No Record Found</td>
								</tr>
								@endif
							</tbody>						
						</table>					
					</div>
					<!-- Footer -->
					<!-- Commented by webiwng -->
					{{--@include('admin.layout.footer')--}}
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
<!-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" /> -->
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function(){
	$("#get_orders").validate();	
});
function export_orders()
{
	document.getElementById('error_from_date').innerHTML = '';
	document.getElementById('error_to_date').innerHTML = '';
	var from_date               		= $('#from_date').val();
	var to_date              			= $('#to_date').val();
	if(from_date== '' && to_date== '')
	{
		document.getElementById('error_from_date').innerHTML 	= 'This Field Required';
		document.getElementById('error_to_date').innerHTML 		= 'This Field Required';
		return false;
	}
	if(from_date== '')
	{
		document.getElementById('error_from_date').innerHTML = 'This Field Required';
		return false;
	}
	if(to_date== '')
	{
		document.getElementById('error_to_date').innerHTML = 'This Field Required';
		return false;
	}
	$("#proceed_export_orders").html("<b><i class='fa fa-spinner fa-spin'></i></b> Exporting...");
	$("#proceed_export_orders").attr('disabled', true);
	$('#export_orders').submit();   
}
function set_from_date()
{
	var from_date               		= $('#from_date').val();
	$('#export_from_date').val(from_date);
}
function set_to_date()
{
	var to_date               		= $('#to_date').val();
	$('#export_to_date').val(to_date);  
}
</script>
</html>