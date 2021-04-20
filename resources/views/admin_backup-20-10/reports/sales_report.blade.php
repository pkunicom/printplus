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
					<!-- Main charts -->
					<div class="row">
						<div class="col-lg-2">
							<div class="panel total-count-block">
								<div class="panel-body">
									<div class="dash-box-head">Todays Orders</div>
									<div class="text-muted text-size-small">{{$todays_order_count}}</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="panel total-count-block">
								<div class="panel-body">
									<div class="dash-box-head">Todays Sales</div>
									<div class="text-muted text-size-small">{{$todays_sale}}</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="panel total-count-block">
								<div class="panel-body">
									<div class="dash-box-head">Yesterdays Orders</div>
									<div class="text-muted text-size-small">{{$yesterdays_order_count}}</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="panel total-count-block">
								<div class="panel-body">
									<div class="dash-box-head">Yesterdays Sales</div>
									<div class="text-muted text-size-small">{{$yesterdays_sale}}</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="panel total-count-block">
								<div class="panel-body">
									<div class="dash-box-head">Month Order</div>
									<div class="text-muted text-size-small">{{$monthly_order_count}}</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="panel total-count-block">
								<div class="panel-body">
									<div class="dash-box-head">Month Sale</div>
									<div class="text-muted text-size-small">{{$monthly_sale}}</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="panel total-count-block">
								<div class="panel-body">
									<div class="dash-box-head">Total Order</div>
									<div class="text-muted text-size-small">{{$total_order_count}}</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="panel total-count-block">
								<div class="panel-body">
									<div class="dash-box-head">Total Sale</div>
									<div class="text-muted text-size-small">{{$total_sale}}</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>
					<!-- /main charts -->
					<div class="row">
						<div class="col-lg-5">
							
							<div class="panel panel-flat panel-graph">
								<div class="panel-heading">
									<h6 class="panel-title text-semibold">Sales Last 12 Months</h6>
								</div>

								<div class="panel-body">
									<div class="chart-container text-center">
										<div class="display-inline-block" id="monthly-sale-graph"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-7">
							<div class="panel panel-flat panel-graph">
								<div class="panel-heading">
									<h6 class="panel-title text-semibold">Current Month Sale</h6>
								</div>

								<div class="panel-body">
									<div class="chart-container text-center">
										<div class="display-inline-block" id="current-month-sale-graph"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="add-user-btn-main">
							<a class="btn btn-primary"  id="open_add_product_modal" href="{{ $module_url_path}}/export" style="margin-bottom: 10px;"><i class="fa fa-file-excel-o"></i> Export</a>
						</div>
					</div>
					<div class="row">
					<table class="table load-sale-data">
							</tfoot>
							<thead>
								<tr>
									<th>#</th>
					                <th>Date</th>
					                <th>Day</th>
									<th>New Users</th>
									<th>Total Orders</th>
									<th>Total Sales</th>
									<th>Total Cost</th>
									<th>Total Margin</th>
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
    //     var title = $('.load-sale-data thead th').eq($(this).index()).text();
    //     $(this).html('<input type="text" class="form-control input-sm" placeholder="Search '+title+'" />');
    // });

    var table = $('.load-sale-data').DataTable({
        "bStateSave": true,
        "bSearchable":true,
        "processing": true,
	    "serverSide": true,
	    "searchDelay": 350,
	    "autoWidth": false,
	    "bFilter": true,
	    "bLengthChange": true,
        ajax: {
            url: "{{ $module_url_path}}/load_data",
        },
        columns: [
           
            {data : 'sr_no',"orderable":false,"searchable":true,name:'sr_no'},
            {data : 'date',"orderable":false,"searchable":true,name:'date'},
            {data : 'day_name',"orderable":false,"searchable":true,name:'day_name'},
			{data : 'user_count',"orderable":false,"searchable":true,name:'user_count'},
			{data : 'total_orders',"orderable":false,"searchable":true,name:'total_orders'},
			{data : 'total_sales',"orderable":false,"searchable":true,name:'total_sales'},
			{data : 'total_cost',"orderable":false,"searchable":true,name:'total_cost'},
			{data : 'total_margin',"orderable":false,"searchable":true,name:'total_margin'}
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
        bindto: '#monthly-sale-graph',
        size: { height: 400 },
        data: {
			
			x : 'x',
            columns: [
                ['x', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                ['Monthly Sale', 90, 100, 140, 200, 100, 300, 90, 100, 140, 200, 100, 300],
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
                height: 90
            }
        },
        grid: {
            x: {
                show: true
            }
        }
	});

	var axis_tick_culling = c3.generate({
        bindto: '#current-month-sale-graph',
        size: { height: 400 },
        data: {
            columns: [
                ['Sale', 3000, 200, 100, 400, 150, 250, 30, 200, 100, 400, 150, 250, 30, 200, 100, 400, 150, 250, 200, 100, 400, 150, 250]
            ]
        },
        color: {
            pattern: ['#FF5722']
        },
        axis: {
            x: {
                type: 'category',
                tick: {
                    culling: {
                        max: 5
                    }
                }
            }
        }
    });
});

</script>
</html>
