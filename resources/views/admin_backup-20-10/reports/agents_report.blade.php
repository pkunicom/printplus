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
<!--
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Dashboard</h4>
						</div>

						<div class="heading-elements">
							<div class="heading-btn-group">
								<a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
								<a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
								<a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
							</div>
						</div>
					</div>
-->
					
					<!-- Page breadcrumb -->
					@include('admin.layout.breadcrumb')	
					
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">
					<!-- Operation Status -->
					@include('admin.layout._operation_status')	
					<!-- /Operation Status -->
					<div class="row">
						<div class="col-lg-4">
							<div class="panel panel-flat panel-graph">
								<div class="panel-heading">
									<h6 class="panel-title text-semibold" style="text-align:center;"># of  orders  per Agent</h6>
								</div>

								<div class="panel-body">
									<div class="chart-container text-center">
										<div class="display-inline-block" id="agent-graph"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="panel panel-flat panel-graph">
								<div class="panel-heading">
									<h6 class="panel-title text-semibold" style="text-align:center;">Value SAR per Agent</h6>
								</div>

								<div class="panel-body">
									<div class="chart-container text-center">
										<div class="display-inline-block" id="agent-sar-graph"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="panel panel-flat panel-graph">
								<div class="panel-heading">
									<h6 class="panel-title text-semibold" style="text-align:center;">Customer Satsifaction</h6>
								</div>

								<div class="panel-body">
									<div class="chart-container text-center">
										<div class="display-inline-block" id="customer-satisfaction-graph"></div>
									</div>
								</div>
							</div>
						</div>

						
					</div>
					<div class="row">
						<div class="add-user-btn-main">
							<a class="btn btn-primary"  id="open_add_product_modal" href="{{ $module_url_path}}/export"><i class="fa fa-file-excel-o"></i> Export</a>
							<!-- <a class="btn btn-primary"  id="open_add_product_modal" href="#"><i class="fa fa-file-excel-o"></i> Export</a> -->
						</div>
					</div>
					<div class="row">
						<div class="panel panel-flat panel-graph">
							<div class="panel-heading">
								<h6 class="panel-title text-semibold"></h6>
							</div>
							<table class="table load-all-user-data">
								<thead>
									<tr>
										<th>#</th>
						                <th>Agency Name</th>
						                <th>Status</th>
										<th># of Products</th>
										<th># of Orders</th>
										<th>Total Sales</th>
										<th>Customer Satisfaction</th>
						            </tr>
								</thead>						
							</table>
						</div>
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
	    "serverSide": false,
	    "searchDelay": 350,
	    "autoWidth": false,
	    "bFilter": true,
	    "bLengthChange": true,
        ajax: {
            url: "{{ $module_url_path}}/load_data",
        },
        columns: [
           
            {data : 'sr_no',"orderable":false,"searchable":true,name:'sr_no'},
            {data : 'agency_name',"orderable":false,"searchable":true,name:'agency_name'},
			{data : 'status',"orderable":false,"searchable":true,name:'status'},
			{data : 'hash_of_product',"orderable":false,"searchable":true,name:'hash_of_product'},
			{data : 'hash_of_orders',"orderable":false,"searchable":true,name:'hash_of_orders'},
			{data : 'total_sales',"orderable":false,"searchable":true,name:'total_sales'},
			{data : 'customer_dsatisfaction',"orderable":false,"searchable":true,name:'customer_dsatisfaction'}
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
        bindto: '#agent-graph',
        size: { height: 400 },
        data: {
			
			x : 'x',
            columns: [
                ['x', 'Almengash', 'First print', 'Best Print', 'HD Quality'],
                ['pv', 1000, 500, 800, 400],
            ],
            type: 'bar'
		},
        color: {
            pattern: ['#2e2252']
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
	
	var axis_tick_rotation = c3.generate({
        bindto: '#agent-sar-graph',
        size: { height: 400 },
        data: {
			x : 'x',
            columns: [
                ['x', 'Almengash', 'First print', 'Best Print', 'HD Quality'],
                ['pv', 30000, 50000, 20000, 10000],
            ],
            type: 'bar'
		},
        color: {
            pattern: ['#ed39c3']
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
	
	var axis_tick_rotation = c3.generate({
        bindto: '#customer-satisfaction-graph',
        size: { height: 400 },
        data: {
			
			x : 'x',
            columns: [
                ['x', 'Almengash', 'First print', 'Best Print', 'HD Quality'],
                ['pv', 4, 3.5, 4, 4.5],
            ],
            type: 'bar'
		},
        color: {
            pattern: ['#5debf0']
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
