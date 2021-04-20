<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.interface.club/limitless/layout_1/LTR/default/datatable_api.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 05:50:56 GMT -->
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
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/core/libraries/jquery.validate.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/tables/datatables/datatables.min.js"></script>

	<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>	
	<!-- <script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/forms/selects/select2.min.js"></script>	 -->
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/uploaders/fileinput/fileinput.min.js"></script>

	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/core/app.js"></script>
	<!-- <script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/pages/datatables_api.js"></script> -->
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/pages/uploader_bootstrap.js"></script>
	<!-- <script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/forms/styling/uniform.min.js"></script> -->
	<!-- <script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/pages/form_inputs.js"></script> -->

	<!-- /theme JS files -->

</head>

<body>
	<style type="text/css">
		.red{
			color:red;
		}
	</style>
	<!-- Main navbar -->
	@include('agent.layout.header')
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			@include('agent.layout.sidebar')
			<!-- /main sidebar -->


			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header page-header-default">
					@include('agent.layout.breadcrumb')	
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">


					<!-- Individual column searching (text inputs) -->
					@include('agent.layout._operation_status')
					<div class="panel panel-flat">
						<div class="table-responsive">
						<table class=" table datatable-column-search-inputs  ">
							<!-- <tfoot>
								<tr>
									<td></td>
					                <td class='text_search' >Name</td>
					                <td class='text_search'>Email</td>
					                <td ></td>
					                <td ></td>
					                <td></td>
					                <td></td>
					            </tr>
							</tfoot> -->
							<thead>
								<tr>
									<th>#</th>
									<th>Order ID</th>
					                <th>Item ID</th>
					                <th>Product</th>
					                <th>Value</th>
					                <th>Printing</th>
					                <th>Priority</th>
					                <th>Evaluation</th>
					                <th>Time</th>
					                <th class="text-center">Actions</th>
					            </tr>
							</thead>
							<tbody>
							</tbody>
						
						</table>
						</div>
					</div>

					<div id="modal_form_vertical" class="modal fade addUserModalMain">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header bg-primary">
									<button type="button" class="close close_modal" data-dismiss="modal" id="close_modal">&times;</button>
									<h5 class="modal-title">Delivery Status</h5>
								</div>
								<form action="{{ url('/') }}/agent/staff/store_staff" id="add_staff" method="post" enctype="multipart/form-data" >
									{{csrf_field()}}
									<div class="modal-body">
										
										<div class="row">
											<div class="col-sm-6 col-md-6 col-lg-12">
												<div class="form-group">												
													<label>Order ID</label>
													<input type="hidden"  name="id" id="id" class="form-control" readonly="true">
													<input type="text"  name="order_id" id="order_id" class="form-control" readonly="true">
												</div>
											</div>
											<div class="col-sm-6 col-md-6 col-lg-12">
												<div class="form-group">												
													<label>Item ID</label>
													<input type="text" name="product_id" id="product_id"   readonly="true" class="form-control">
												</div>	
											</div>		
											<div class="col-sm-6 col-md-6 col-lg-12">
												<div class="form-group">												
													<label>Current Status</label>
													<input type="text"  name="current_status" id="current_status" readonly="true" class="form-control">
												</div>	
											</div>	
										</div>	
										<div class="row">
											<div class="col-sm-3 col-md-3 col-lg-3">
												<h4 id='status_pending' class="current-status-block">Pending</h4>			 					
											</div>
											<div class="col-sm-3 col-md-3 col-lg-3">
												<h4 id="status_in_progress" class="current-status-block">In-Progress</h4>			 					
											</div>
											<div class="col-sm-3 col-md-3 col-lg-3">
												<h4 id="status_collected" class="current-status-block">Collected</h4>			 					
											</div>
											
										</div>
									</div>

								<!-- 	<div class="modal-footer">
										<button type="button" class="btn btn-primary close_modal" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Add</button>
									</div>
								</form>-->
							</div>
						</div>
					</div>
					<!-- Delivery status model -->

					<!-- /individual column searching (text inputs) -->

					{{--Below section is Commented by webwing--}}
					{{--
					<!-- Individual column searching (selects) -->
					<!-- <div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Individual column searching</h5>
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse"></a></li>
			                		<li><a data-action="reload"></a></li>
			                		<li><a data-action="close"></a></li>
			                	</ul>
		                	</div>
						</div>

						<div class="panel-body">
							Individual columns searching with <code>selects</code>. This example is almost identical to text based individual column example and provides the same functionality, but in this case using <code>select</code> input controls. After the table is initialised, the API is used to build the select inputs through the use of the <code>column().data()</code> method to get the data for each column in turn.
						</div>

						<table class="table datatable-column-search-selects">
							<thead>
								<tr>
					                <th>Name</th>
					                <th>Position</th>
					                <th>Age</th>
					                <th>Start date</th>
					                <th>Salary</th>
					                <th class="text-center">Actions</th>
					            </tr>
							</thead>
							<tbody>
								<tr>
					                <td>Tiger Nixon</td>
					                <td>System Architect</td>
					                <td>61</td>
					                <td><a href="#">2011/04/25</a></td>
					                <td><span class="label label-info">$320,800</span></td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
													<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
													<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
												</ul>
											</li>
										</ul>
									</td>
					            </tr>
					            

							</tbody>
							<tfoot>
								<tr>
					                <td>Name</td>
					                <td>Position</td>
					                <td>Age</td>
					                <td>Start date</td>
					                <td>Salary</td>
					                <td></td>
					            </tr>
							</tfoot>
						</table>
					</div> -->
					<!-- /individual column searching (selects) -->
					--}}

					<!-- Footer -->
                    <!-- Commented by webiwng -->
                        {{--@include('agent.layout.footer')--}}
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
<script type="text/javascript">

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

    // Individual column searching with text inputs
    // $('.text_search').each(function () {
    //     var title = $('.datatable-column-search-inputs thead th').eq($(this).index()).text();
    //     $(this).html('<input type="text" class="form-control input-sm" placeholder="Search '+title+'" />');
    // });

    var table = $('.datatable-column-search-inputs').DataTable({
	     // "responsive": {
	     // details:true
	     // },

        "bStateSave": true,
        "bDestroy": true,
        "bSearchable":true,
        "processing": true,
	    "serverSide": false,
	    "searchDelay": 350,
	    "autoWidth": false,
	    "bFilter": true,
	    "bLengthChange": true,
	     // "data": data.aaData,
        ajax: {
            url: "{{ $module_url_path}}/load_printingorders_data",
            data: function(d) {
                // d['column_filter[customer_id]'] 		= $("input[name='customer_id']").val()
                // d['column_filter[customer_group]']      = $("select[name='customer_group']").val()
            }
        },
        columns: [
           
            {data : 'sr_no',"orderable":false,"searchable":false,name:'sr_no'},
            {data : 'order_id',"orderable":false,"searchable":true,name:'order_id'},
            {data : 'item_id',"orderable":true,"searchable":true,name:'item_id'},
            {data : 'product_name',"orderable":true,"searchable":true,name:'product_name'},
            {data : 'value',"orderable":false,"searchable":true,name:'value'},
            {data : 'printing_status',"orderable":false,"searchable":true,name:'printing_status'},
            {data : 'priority',"orderable":false,"searchable":true,name:'priority'},
            {data : 'evalutation',"orderable":false,"searchable":true,name:'evalutation'},
            {data : 'created_at',"orderable":false,"searchable":true,name:'created_at'},
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


    // Commented by webwing
    // table.columns().every( function () {
    //     var that = this;
    //     $('input', this.footer()).on('keyup change', function () {
    //         that.search(this.value).draw();
    //     });
    // });


    // External table additions
    // ------------------------------

    // Enable Select2 select for the length option
    // $('.dataTables_length select').select2({
    //     minimumResultsForSearch: Infinity,
    //     width: 'auto'
    // });


    // // Enable Select2 select for individual column searching
    // $('.filter-select').select2();
    
});

$(document).ready(function(){
	$("#add_agent").validate();

	$('.current-status-block').on("click",function(){
		var status = this.id;
		//alert(status);
		var id =  $('#id').val();
		//alert(id);
		var data = {id:id,status:status}
		 $.ajax({
            url : '{{ url('/') }}/agent/orders/get_printingorder_printing_status_update/',
            type : "GET",
            data:data,
            dataType: 'JSON',
            success:function(resp){
            	//$("#modal_form_vertical").hide('hide');
            	//$('.datatable-column-search-inputs').DataTable().ajax.reload();
               location.reload();
            }
        })
	});

	// Open delivery status Model Author : (HArsh Chauhan)
	$('body').on('click','#open_delivery_status_modal',function(){
		var id = btoa($(this).data("id"));
		 $.ajax({
            url : '{{ url('/') }}/agent/orders/get_printingorder_printing_status/'+id,
            type : "GET",
            dataType: 'JSON',
            success:function(resp){
            	console.log(resp);
                if(resp.status=='success'){
                	$("#modal_form_vertical").modal('show');
                    $('#id').val(resp.data.get_order_details.id);
                    $('#order_id').val(resp.data.get_order_details.order_id);
                    $('#product_id').val(resp.data.get_product_details.product_id);
                    if(resp.data.get_order_details.printing_status=='pending'){
                    	$('#current_status').val('Pending');
                    	$("#status_pending").addClass("active");
                    }else if(resp.data.get_order_details.printing_status=='in_progress'){
                    	$('#current_status').val('In Progress');
                    	$("#status_in_progress").addClass("active");
                    }
                    else if(resp.data.get_order_details.printing_status=='completed'){
                    	$('#current_status').val('Completed');
                    	$("#status_collected").addClass("active");
                    }
                }else if(resp.status=='error'){
                    $("#modal_form_vertical").hide('hide');
                }
            }
        })	
	});
});
</script>

<!-- Mirrored from demo.interface.club/limitless/layout_1/LTR/default/datatable_api.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 05:50:56 GMT -->
</html>
