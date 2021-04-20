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
									<h6 class="no-margin">{{$category_count}}</h6>
									<div class="dash-box-head">Number of Category</div>	
									<div class="dash-box-icon">
										<i class="icon-stack3"></i>
									</div>								
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="panel total-count-block">
								<div class="panel-body">
									<h6 class="no-margin">{{$sub_category_count}}</h6>
									<div class="dash-box-head">Number of Sub-Category</div>									
									<div class="dash-box-icon">
										<i class="icon-stack3"></i>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="panel total-count-block">
								<div class="panel-body">
									<h6 class="no-margin">{{$products_count}}</h6>
									<div class="dash-box-head">Number of Product</div>									
									<div class="dash-box-icon">
										<i class="icon-stack3"></i>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>

						<div class="col-lg-3">
							<div class="panel total-count-block">
								<div class="panel-body">
									<h6 class="no-margin">{{$accessory_count}}</h6>
									<div class="dash-box-head">Number of Accessories</div>									
									<div class="dash-box-icon">
										<i class="icon-stack3"></i>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-flat">
						<div class="add-user-btn-main">
							<span class="table-search-section">
								<i class="fa fa-search"></i>
								<input type="text" name="search" placeholder="Search">
							</span>							
							<a class="btn btn-primary"  id="open_add_product_modal" href="{{ $module_url_path}}/export"><i class="fa fa-file-excel-o"></i> Export</a>
						</div>
						<div class="clearfix"></div>
						<table class="table load-all-product-data">
							</tfoot>
							<thead>
								<tr>
									<th>#</th>
									<th>Product</th>
									<th>Subcategory</th>
									<th>Category</th>
									<th>Options</th>
									<th># of Orders</th>
									<th>Total Value</th>
									<th>Satisfaction</th>
								</tr>
							</thead>						
						</table>
					</div>					
					<div class="panel panel-flat">
						<div class="add-user-btn-main">
							<span class="table-search-section">
								<i class="fa fa-search"></i>
								<input type="text" name="search" placeholder="Search">
							</span>							
							<a class="btn btn-primary"  id="open_add_product_modal" href="{{ $module_url_path}}/export_accessory"><i class="fa fa-file-excel-o"></i> Export</a>
						</div>
						<div class="clearfix"></div>
						<table class="table load-accessory-data">
							</tfoot>
							<thead>
								<tr>
									<th>#</th>
									<th>Accessory</th>
									<th># of Orders</th>
									<th>Total Value</th>
								</tr>
							</thead>						
						</table>
					</div>		
					<div class="row">
						<div class="col-lg-4">
							<div class="panel panel-flat panel-graph">
								<div class="panel-heading">
									<h6 class="panel-title text-semibold" style="text-align:center;">Top Categories Orders</h6>
								</div>
								<div class="panel-body">
									<div class="chart-container text-center">
										<div class="display-inline-block" id="category-order-graph"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="panel panel-flat panel-graph">
								<div class="panel-heading">
									<h6 class="panel-title text-semibold" style="text-align:center;">Top Sub-Categories Orders</h6>
								</div>
								<div class="panel-body">
									<div class="chart-container text-center">
										<div class="display-inline-block" id="sub-category-order-graph"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="panel panel-flat panel-graph">
								<div class="panel-heading">
									<h6 class="panel-title text-semibold" style="text-align:center;">Top Products Orders</h6>
								</div>
								<div class="panel-body">
									<div class="chart-container text-center">
										<div class="display-inline-block" id="product-order-graph"></div>
									</div>
								</div>
							</div>
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
    var table = $('.load-all-product-data').DataTable({
        "bStateSave": true,
        "bSearchable":true,
        "processing": true,
	    "serverSide": true,
	    "searchDelay": 1,
	    "autoWidth": false,
	    "bFilter": true,
	    "bLengthChange": true,
        ajax: {
            url: "{{ $module_url_path}}/load_data",
        },
        columns: [          
            {data : 'sr_no',"orderable":false,"searchable":true,name:'sr_no'},
            {data : 'product_name',"orderable":false,"searchable":true,name:'product_name'},
            {data : 'category_name',"orderable":false,"searchable":true,name:'category_name'},
			{data : 'sub_category_name',"orderable":false,"searchable":true,name:'sub_category_name'},
			{data : 'options',"orderable":false,"searchable":true,name:'options'},
			{data : 'product_order_count',"orderable":false,"searchable":true,name:'product_order_count'},
			{data : 'product_total_value',"orderable":false,"searchable":true,name:'product_total_value'},
			{data : 'satisfaction',"orderable":false,"searchable":true,name:'satisfaction'}
        ],
    });
	var table = $('.load-accessory-data').DataTable({
        "bStateSave": true,
        "bSearchable":true,
        "processing": true,
	    "serverSide": true,
	    "searchDelay": 1,
	    "autoWidth": false,
	    "bFilter": true,
	    "bLengthChange": true,
        ajax: {
            url: "{{ $module_url_path}}/load_accessory_data",
        },
        columns: [         
            {data : 'sr_no',"orderable":false,"searchable":true,name:'sr_no'},
            {data : 'accessory_name',"orderable":false,"searchable":true,name:'accessory_name'},
            {data : 'accessory_order_count',"orderable":false,"searchable":true,name:'accessory_order_count'},
			{data : 'accessory_total_value',"orderable":false,"searchable":true,name:'accessory_total_value'}
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
    var axis_tick_rotation = c3.generate({
        bindto: '#category-order-graph',
        size: { height: 400 },
        data: {		
			// use values from that array for dynamic graph      $month_customer_data
			x : 'x',
            columns: [
                ['x', 'Office Supplies', 'Advertising', 'Format', 'Signs','Poster'],
                ['pv', 60000, 35000, 11000, 90000,40000],
            ],
            type: 'bar'
		},
        color: {
            pattern: ['#81f0e8']
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
		bindto: '#sub-category-order-graph',
		size: { height: 400 },
		data: {	
		// use values from that array for dynamic graph      $month_customer_data
			x : 'x',
			columns: [
				['x', 'Bulk Poster', 'Cups', 'Letterheads', 'Business Cards','Notebooks'],
				['pv', 90000, 140000, 30000, 200000,65000],
			],
			type: 'bar'
		},
		color: {
			pattern: ['#f571ee']
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
		bindto: '#product-order-graph',
		size: { height: 400 },
		data: {	
			// use values from that array for dynamic graph      $month_customer_data
			x : 'x',
			columns: [
				['x', 'Premium Cards', 'Linen Cards', 'Letterheads', 'Stickers','Notebooks'],
				['pv', 130000, 90000, 180000, 140000, 70000],
			],
			type: 'bar'
		},
		color: {
			pattern: ['#9538e0']
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