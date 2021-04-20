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
					<!-- Operation Status -->
					@include('admin.layout._operation_status')	
					<!-- /Operation Status -->
					<!-- Main charts -->
					<div class="row">
						<div class="col-lg-3">
							<div class="panel total-count-block">
								<div class="panel-body">
									<h6 class="no-margin">@if($total_discounts_count!=null){{$total_discounts_count}} @else 00 @endif</h6>
									<div class="dash-box-head" >Total Discount Promotion</div>
									<!-- <h6 class="no-margin">Total Promo Code</h6> -->									
									<div class="dash-box-icon">
										<i class="icon-stack3"></i>
									</div>
									<div class="clearfix"></div>
								</div>
								<div id="server-load"></div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="panel total-count-block dash-box-lecture">
								<div class="panel-body">
									<h6 class="no-margin">@if($active_discounts_count!=null){{$active_discounts_count}} @else 00 @endif</h6>
									<div class="dash-box-head" >Total Active Discount</div>
									<!-- <h6 class="no-margin">Total Active Promo Code</h6> -->									
									<div class="dash-box-icon">
										<i class="icon-stack3"></i>
									</div>
									<div class="clearfix"></div>
								</div>
								<div id="server-load"></div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="panel total-count-block dash-box-questions">
								<div class="panel-body">
									<h6 class="no-margin">0</h6>
									<div class="dash-box-head" >Total Count of Use</div>
									<!-- <h6 class="no-margin">Total Count of Use</h6> -->									
									<div class="dash-box-icon">
										<i class="icon-stack3"></i>
									</div>
									<div class="clearfix"></div>
								</div>
								<div id="server-load"></div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="panel total-count-block dash-box-lectures">
								<div class="panel-body">
									<h6 class="no-margin">0</h6>
									<div class="dash-box-head" >Amount of Deduction</div>
									<!-- <h6 class="no-margin">Amount of Deduction</h6> -->									
									<div class="dash-box-icon">
										<i class="icon-stack3"></i>
									</div>
									<div class="clearfix"></div>
								</div>
								<div id="server-load"></div>
							</div>
						</div>
					</div>
					<!-- /main charts -->
					<div class="panel panel-flat">
						<div class="add-user-btn-main">
							<span class="table-search-section">
								<i class="fa fa-search"></i>
								<input type="text" name="search" placeholder="Search">
							</span>														
							<a class="btn btn-primary"  id="open_add_product_modal" href="{{ $module_url_path}}/export"><i class="fa fa-file-excel-o"></i> Export</a>
						</div>
						<div class="clearfix"></div>
						<table class="table load-all-user-data">
							</tfoot>
							<thead>
								<tr>
									<th>#</th>
					                <th>Discount ID</th>
					                <th>Product</th>
									<th>Per%</th>
									<th>Start</th>
									<th>End</th>
									<th>Count</th>
									<th>Status</th>
									<th>Total Sales</th>
									<th>Total Deduction</th>
					            </tr>
							</thead>
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
$(function() {
    // Table setup
    // ------------------------------
    // Setting datatable defaults
    // Individual column searching with text inputs
    // $('.text_search').each(function () {
    //     var title = $('.load-all-user-data thead th').eq($(this).index()).text();
    //     $(this).html('<input type="text" class="form-control input-sm" placeholder="Search '+title+'" />');
    // });
    var table = $('.load-all-user-data').DataTable({
        "bStateSave": true,
        "bSearchable":true,
        "processing": true,
	    "serverSide": true,
	    "searchDelay": 350,
	    "autoWidth": false,
	    "bFilter": false,
	    "bLengthChange": false,
        ajax: {
            url: "{{ $module_url_path}}/load_data",
        },
        columns: [          
            {data : 'sr_no',"orderable":false,"searchable":true,name:'sr_no'},
            {data : 'discount_id',"orderable":false,"searchable":true,name:'discount_id'},
            {data : 'product',"orderable":false,"searchable":true,name:'product'},
			{data : 'percentage',"orderable":false,"searchable":true,name:'percentage'},
			{data : 'start_date',"orderable":false,"searchable":true,name:'start_date'},
			{data : 'end_date',"orderable":false,"searchable":true,name:'end_date'},
			{data : 'count',"orderable":false,"searchable":true,name:'count'},
			{data : 'status',"orderable":false,"searchable":true,name:'status'},
			{data : 'total_sale',"orderable":false,"searchable":true,name:'total_sale'},
			{data : 'total_deduction',"orderable":false,"searchable":true,name:'total_deduction'}
        ],
    });
});
</script>
</html>