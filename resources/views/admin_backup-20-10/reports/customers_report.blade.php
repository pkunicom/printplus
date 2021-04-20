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

				<!-- Page header -->
				<div class="page-header page-header-default">				
					<!-- Page breadcrumb -->
					@include('admin.layout.breadcrumb')	
					<!-- /Page breadcrumb -->					
				</div>
				<!-- /page header -->

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
									<div class="dash-box-head">Total Users</div>
									<div class="text-muted text-size-small">@if($total_customer_count!=null){{$total_customer_count}} @else 00 @endif</div>
									<div class="clearfix"></div>
								</div>
								<div id="server-load"></div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="panel total-count-block dash-box-lecture">
								<div class="panel-body">
									<div class="dash-box-head">Active Users</div>
									<div class="text-muted text-size-small">@if($active_customer_count!=null){{$active_customer_count}} @else 00 @endif</div>
									<div class="clearfix"></div>
								</div>
								<div id="server-load"></div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="panel total-count-block dash-box-questions">
								<div class="panel-body">
									<div class="dash-box-head">Never Order</div>
									<div class="text-muted text-size-small">45</div>
									<div class="clearfix"></div>
								</div>
								<div id="server-load"></div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="panel total-count-block dash-box-lectures">
								<div class="panel-body">
									<div class="dash-box-head">1+ Order</div>
									<div class="text-muted text-size-small">78</div>
									<div class="clearfix"></div>
								</div>
								<div id="server-load"></div>
							</div>
						</div>
						

						<div class="col-lg-3">
							<div class="panel total-count-block">
								<div class="panel-body">
									<div class="dash-box-head">2+ Order</div>
									<div class="text-muted text-size-small">456</div>
									<div class="clearfix"></div>
								</div>
								<div id="server-load"></div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="panel total-count-block dash-box-lecture">
								<div class="panel-body">
									<div class="dash-box-head">3+ Order</div>
									<div class="text-muted text-size-small">65</div>
									<div class="clearfix"></div>
								</div>
								<div id="server-load"></div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="panel total-count-block dash-box-questions">
								<div class="panel-body">
									<div class="dash-box-head">4+ Order</div>
									<div class="text-muted text-size-small">45</div>
									<div class="clearfix"></div>
								</div>
								<div id="server-load"></div>
							</div>
						</div>
					</div>
					<!-- /main charts -->
					<div class="panel">
						<table class="table">
							<thead>
								<tr>
									<th>Consumer</th>
									<th>SME</th>
									<th>Enterprise</th>
									<th>Governement</th>
									<th>Reseller</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th>{{$total_customer_count}}</th>
									<th>5</th>
									<th>8</th>
									<th>20</th>
									<th>9</th>
								</tr>
							</tbody>						
						</table>
					</div>

					<div class="row">
						<div class="col-lg-6">
							<div class="panel panel-flat panel-graph">
								<div class="panel-heading">
									<h6 class="panel-title text-semibold">New Users last 12 Months</h6>
								</div>

								<div class="panel-body">
									<div class="chart-container text-center">
										<div class="display-inline-block" id="customer-graph"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="panel panel-flat panel-graph">
								<div class="panel-heading">
									<h6 class="panel-title text-semibold">Business Customers</h6>
								</div>

								<table class="table datatable-column-search-inputs">
									</tfoot>
									<thead>
										<tr>
											<th>#</th>
											<th>Name</th>
											<th>Value(SAR)</th>
											<th>#Orders</th>
										</tr>
									</thead>	
									<tbody>
										<tr>
											<th>1</th>
											<th>Ministry of Interior</th>
											<th>700,000</th>
											<th>9</th>
										</tr>
										<tr>
											<th>2</th>
											<th>Ministry of Education</th>
											<th>650,000</th>
											<th>9</th>
										</tr>
										<tr>
											<th>3</th>
											<th>NCB</th>
											<th>500,000</th>
											<th>9</th>
										</tr>
										<tr>
											<th>4</th>
											<th>Saudi Airlines</th>
											<th>400,000</th>
											<th>9</th>
										</tr>
										<tr>
											<th>5</th>
											<th>Abuzaid</th>
											<th>20</th>
											<th>9</th>
										</tr>
									</tbody>					
								</table>
							</div>
						</div>

						<div class="col-lg-12">
							<div class="panel panel-flat panel-graph">
								<div class="panel-heading">
									<h6 class="panel-title text-semibold">Consumer</h6>
								</div>

								<table class="table datatable-column-search-inputs">
									</tfoot>
									<thead>
										<tr>
											<th>#</th>
											<th>Name</th>
											<th>Value(SAR)</th>
											<th>#Orders</th>
										</tr>
									</thead>	
									<tbody>
										<tr>
											<th>1</th>
											<th>Ministry of Interior</th>
											<th>700,000</th>
											<th>9</th>
										</tr>
										<tr>
											<th>2</th>
											<th>Ministry of Education</th>
											<th>650,000</th>
											<th>9</th>
										</tr>
										<tr>
											<th>3</th>
											<th>NCB</th>
											<th>500,000</th>
											<th>9</th>
										</tr>
										<tr>
											<th>4</th>
											<th>Saudi Airlines</th>
											<th>400,000</th>
											<th>9</th>
										</tr>
										<tr>
											<th>5</th>
											<th>Abuzaid</th>
											<th>20</th>
											<th>9</th>
										</tr>
									</tbody>					
								</table>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="add-user-btn-main">
							<a class="btn btn-primary"  id="open_add_product_modal" href="{{ $module_url_path}}/export"><i class="fa fa-file-excel-o"></i> Export</a>
							<!-- <a class="btn btn-primary"  id="open_add_product_modal" href="#"><i class="fa fa-file-excel-o"></i> Export</a> -->
						</div>
					</div>
					<div class="panel export-table-panel">						
						<table class="table load-all-user-data">
							</tfoot>
							<thead>
								<tr>
									<th>#</th>
									<th>ID</th>
									<th>Name</th>
									<th>Type</th>
									<th>Rank</th>
									<th>Orders #</th>
									<th>Orders $</th>
									<th>Balance</th>
									<th>Age</th>
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
	    "bFilter": true,
	    "bLengthChange": true,
        ajax: {
            url: "{{ $module_url_path}}/load_data_all_user",
        },
        columns: [
           
            {data : 'sr_no',"orderable":false,"searchable":true,name:'sr_no'},
            {data : 'id',"orderable":false,"searchable":true,name:'id'},
            {data : 'name',"orderable":false,"searchable":true,name:'name'},
			{data : 'type',"orderable":false,"searchable":true,name:'type'},
			{data : 'rank',"orderable":false,"searchable":true,name:'rank'},
			{data : 'order_hash',"orderable":false,"searchable":true,name:'order_hash'},
			{data : 'order_dollar',"orderable":false,"searchable":true,name:'order_dollar'},
			{data : 'balance',"orderable":false,"searchable":true,name:'balance'},
			{data : 'age',"orderable":false,"searchable":true,name:'age'}
        ],
    });
});
</script>

<script>
/* ------------------------------------------------------------------------------
 *
 *  # C3.js - chart axis
 *
 *  Demo setup of chart axis with options
 *
 *  Version: 1.0
 *  Latest update: August 1, 2015
 *
 * ---------------------------------------------------------------------------- */

$(function () {
		
    // Text label rotation
    // ------------------------------

    // Generate chart
    var axis_tick_rotation = c3.generate({
        bindto: '#customer-graph',
        size: { height: 400 },
        data: {
			
			// use values from that array for dynamic graph      $month_customer_data
			x : 'x',
            columns: [
                ['x', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                ['pv', 90, 100, 140, 200, 100, 300, 90, 100, 140, 200, 100, 300],
            ],
            type: 'bar'
		},
		


        color: {
            pattern: ['#00BCD4']
        },
        axis: {
            x: {
                type: 'category',
                tick: {
                    rotate: -90
                },
                height: 80
            }
        },
        grid: {
            x: {
                show: true
            }
        }
    });
});

</script>
</html>
