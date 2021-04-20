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
									<div class="dash-box-head" >Total Orders</div>
									<!-- <h6 class="no-margin">Total Orders</h6> -->
									<div class="text-muted text-size-small">@if($total_evaluation_count!=null){{$total_evaluation_count}} @else 00 @endif</div>
									<div class="clearfix"></div>
								</div>
								<div id="server-load"></div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="panel total-count-block dash-box-lecture">
								<div class="panel-body">
									<div class="dash-box-head" >Total Evaluated Orders</div>
									<!-- <h6 class="no-margin">Total Evaluated Orders</h6> -->
									<div class="text-muted text-size-small">456,78</div>
									<div class="clearfix"></div>
								</div>
								<div id="server-load"></div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="panel total-count-block dash-box-questions">
								<div class="panel-body">
									<div class="dash-box-head" >Pending  Evaluations</div>
									<!-- <h6 class="no-margin">Pending  Evaluations</h6> -->
									<div class="text-muted text-size-small">120,312</div>
									<div class="clearfix"></div>
								</div>
								<div id="server-load"></div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="panel total-count-block dash-box-lectures">
								<div class="panel-body">
									<div class="dash-box-head" >Overall Evaluation</div>
									<!-- <h6 class="no-margin">Overall Evaluation</h6> -->
									<div class="text-muted text-size-small">4.1</div>
									<div class="clearfix"></div>
								</div>
								<div id="server-load"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<div class="panel panel-flat panel-graph">
								<div class="panel-heading">
									<h6 class="panel-title text-semibold" style="text-align:center;">Evaluation</h6>
								</div>

								<div class="panel-body">
									<div class="chart-container text-center">
										<div class="display-inline-block" id="evaluation-graph"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="panel panel-flat panel-graph">
								<div class="panel-heading">
									<h6 class="panel-title text-semibold" style="text-align:center;">Top Rated Products</h6>
								</div>

								<div class="panel-body">
									<div class="chart-container text-center">
										<div class="display-inline-block" id="top_rated_products-graph"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="panel panel-flat panel-graph">
								<div class="panel-heading">
									<h6 class="panel-title text-semibold" style="text-align:center;">Worst Rated Product</h6>
								</div>

								<div class="panel-body">
									<div class="chart-container text-center">
										<div class="display-inline-block" id="worst-rated-product-graph"></div>
									</div>
								</div>
							</div>
						</div>

						
					</div>
					<!-- /main charts -->
					<div class="row">
						<div class="add-user-btn-main">
							<a class="btn btn-primary"  id="open_add_product_modal" href="{{ $module_url_path}}/export" style="bottom: 10px;"><i class="fa fa-file-excel-o"></i> Export</a>
						</div>
					</div>
					<div class="row">
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
        "bStateSave": false,
        "bSearchable":false,
        "processing": false,
	    "serverSide": false,
	    "searchDelay": 350,
	    "autoWidth": false,
	    "bFilter": false,
	    "bLengthChange": false,
        ajax: {
            url: "{{ $module_url_path}}/load_data",
        },
        columns: [
           
            {data : 'sr_no',"orderable":false,"searchable":true,name:'sr_no'},
            {data : 'product_id',"orderable":false,"searchable":true,name:'product_id'},
            {data : 'product',"orderable":false,"searchable":true,name:'product'},
			{data : 'total_evaluation',"orderable":false,"searchable":true,name:'total_evaluation'},
			{data : 'outof_5',"orderable":false,"searchable":true,name:'outof_5'},
			{data : 'outof_4',"orderable":false,"searchable":true,name:'outof_4'},
			{data : 'outof_3',"orderable":false,"searchable":true,name:'outof_3'},
			{data : 'outof_2',"orderable":false,"searchable":true,name:'outof_2'},
			{data : 'outof_1',"orderable":false,"searchable":true,name:'outof_1'},
			{data : 'overall',"orderable":false,"searchable":true,name:'overall'}
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
        bindto: '#evaluation-graph',
        size: { height: 400 },
        data: {
			
			x : 'x',
            columns: [
                ['x', '5/5', '5/4', '5/3', '5/2', '5/1'],
                ['Evaluation', 80000, 90000, 25000, 10000, 500],
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
        bindto: '#top_rated_products-graph',
        size: { height: 400 },
        data: {
			x : 'x',
            columns: [
                ['x', 'Premium Cards', 'Linen Cards', 'Letterheads', 'Stickers','Notebooks','Stamps','Posters'],
                ['top-rated', 4.7, 4.5, 4.4, 4.1, 3.9, 3.2, 2.5],
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
        bindto: '#worst-rated-product-graph',
        size: { height: 400 },
        data: {
			
			x : 'x',
            columns: [
                ['x', 'Premium Cards', 'Linen Cards', 'Letterheads', 'Stickers','Notebooks','Stamps','Posters'],
                ['top-rated', 0.7, 1.3, 1.5, 1.6, 2.0, 2.2, 2.9],
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
