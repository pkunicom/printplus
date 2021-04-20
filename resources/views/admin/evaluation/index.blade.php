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
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/forms/selects/select2.min.js"></script>	
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/uploaders/fileinput/fileinput.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/core/app.js"></script>
	<!-- <script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/pages/datatables_api.js"></script> -->
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/pages/uploader_bootstrap.js"></script>
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
					<!-- Individual column searching (text inputs) -->
					@include('admin.layout._operation_status')
					<div class="panel panel-flat">
						<div class="page-head-section-main">
							<div class="page-head-txt">
								Manage Evaluations <span></span>
							</div>
							<div class="breadcrumb-section-main">
								@include('admin.layout.breadcrumb')	
							</div>
						</div>
						<div class="add-user-btn-main">
							<span class="table-search-section" style="margin-right: 0">
								<i class="fa fa-search"></i>
								<input type="text" name="search" placeholder="Search">
							</span>														
						</div>
						<div class="clearfix"></div>
						<!--<div class="add-user-btn-main">
							<a class="btn btn-primary"  id="open_add_staff_modal" href="javascript:void(0)">Add Staff</a>
						</div>					
						<div id="modal_form_vertical" class="modal fade addUserModalMain">

							<div class="modal-dialog">

								<div class="modal-content">

									<div class="modal-header bg-primary">

										<button type="button" class="close close_modal" data-dismiss="modal" id="close_modal">&times;</button>

										<h5 class="modal-title">Add Staff</h5>

									</div>

									<form action="{{ url('/') }}/admin/staff/store_staff" id="add_staff" method="post" enctype="multipart/form-data" >

										{{csrf_field()}}

										<div class="modal-body">

											<div class="form-group">												

												<input type="file" class="file-input" name="add_image" data-show-caption="false" data-show-upload="false">												

											</div>

											<div class="row">

												<div class="col-sm-6 col-md-6 col-lg-6">

													<div class="form-group">												

														<label>Full Name</label>

														<input type="text" data-rule-required="true" name="add_full_name" id="add_full_name" placeholder="Enter Full Name" class="form-control">

													</div>

												</div>

												<div class="col-sm-6 col-md-6 col-lg-6">

													<div class="form-group">												

														<label>Email</label>

														<input type="text" data-rule-required="true" data-rule-email="true" name="add_email" id="add_email"  placeholder="Enter email" class="form-control">

													</div>	

												</div>				 					

												<div class="col-sm-6 col-md-6 col-lg-6">	

													<div class="form-group">												

														<label>Mobile</label>

														<div class="mobile-drop-section-main" id="add_select_code">

															<div class="mobile-drop-section-select">

																<select name="add_country_id" data-rule-required="true" id="add_country_id" class="form-control">	

																	<option  value="">Select code</option>

																</select>

															</div>

															<div class="mobile-drop-section-input">

																<input type="text" placeholder="Enter mobile number" id="add_mobile_number" name="add_mobile_number" data-rule-required="true" data-rule-number="true" class="form-control" autocomplete="off">

															</div>

														</div>

													</div>

												</div>	

												<div class="col-sm-6 col-md-6 col-lg-6">				

													<div class="form-group">								

														<label>Role</label>

														<select data-rule-required="true" id="add_role" name="add_role" class="form-control">	

															<option value="admin">Admin</option>

															<option value="operator">Operator</option>

															<option value="support">Support</option>

														</select>									

													</div>	

												</div>

												<div class="col-sm-6 col-md-6 col-lg-6">

													<div class="form-group">								

														<label>Password</label>

														<input type="password" data-rule-required="true" id="add_password" name="add_password" placeholder="Enter password" class="form-control">														

													</div>

												</div>

												<div class="col-sm-6 col-md-6 col-lg-6">

													<div class="form-group">								

														<label>Confirm Password</label>

														<input type="password" data-rule-required="true" data-rule-equalto="#add_password" id="add_confirm_password" placeholder="Confirm Password" class="form-control">														

													</div>

												</div>

											</div>

										</div>



										<div class="modal-footer">

											<button type="button" class="btn btn-primary close_modal" data-dismiss="modal">Close</button>

											<button type="submit" class="btn btn-primary">Add</button>

										</div>

									</form>

								</div>

							</div>

						</div> -->
						<div id="edit_modal_form_vertical" class="modal fade addUserModalMain">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header bg-primary">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h5 class="modal-title">Evaluation</h5>
									</div>							
										<div class="modal-body">								
											<div class="row">
												<div class="col-sm-6 col-md-6 col-lg-12">
													<div class="form-group">											
														<label>Order Id</label>
														<input type="text" data-rule-required="true" name="edit_order_id" id="edit_order_id"  class="form-control" readonly="true">
													</div>
												</div>
												<div class="col-sm-6 col-md-6 col-lg-12">
													<div class="form-group">											
														<label>Customer Name</label>
														<input type="text" data-rule-required="true" name="edit_full_name" id="edit_full_name"  class="form-control"  readonly="true">
													</div>	
												</div>	
												<div class="col-sm-6 col-md-6 col-lg-12">
													<div class="form-group">												
														<label>Customer Group</label>
														<input type="text" data-rule-required="true" name="edit_customer_group" id="edit_customer_group"  class="form-control"  readonly="true">
													</div>	
												</div>				 					
												<div class="col-sm-6 col-md-6 col-lg-12">
													<div class="form-group">												
														<label>Product</label>
														<input type="text" data-rule-required="true" name="edit_product" id="edit_product"  class="form-control"  readonly="true">
													</div>	
												</div>	
												<div class="col-sm-6 col-md-6 col-lg-12">
													<div class="form-group">												
														<label>Options</label>												
														<input type="text"  id="edit_options" >												
													</div>	
												</div>	
												<div class="col-sm-6 col-md-6 col-lg-12">
													<div class="form-group">												
														<label>Evaluation</label>
														<input type="text" data-rule-required="true" name="edit_evaluation" id="edit_evaluation"  class="form-control"  readonly="true">
													</div>	
												</div>	
												<div class="col-sm-6 col-md-6 col-lg-12">
													<div class="form-group">												
														<label>Comment</label>
														<input type="text" data-rule-required="true" name="edit_comment" id="edit_comment"  class="form-control"  readonly="true">
													</div>	
												</div>	
											</div>
										</div>
										<div class="modal-footer" >
											<button type="button" class="btn btn-primary accept-block-unblock"  ><span class="status_check" data-status='accept'>Accept</span></button>
											<button type="button" class="btn btn-primary reject-block-unblock" ><span class="status_check"  data-status='reject' >Reject</span></button>								
										</div>
									</form>
								</div>
							</div>
						</div>
						<table class="table datatable-column-search-inputs">
						<!-- 	<tfoot>
								<tr>
									<td></td>
					                <td class='text_search' >Name</td>
					                <td class='text_search'>Email</td>
					                <td ></td>
					                <td ></td>
					                <td></td>
					                <td></td>
					            </tr> -->
							</tfoot>
							<thead>
								<tr>
									<th>#</th>
					                <th>ID</th>
					                <th>Order ID</th>
					                <th>Customer Name</th>
					                <th>Product</th>
					                <th>Option</th>
					                <th>Evaluation</th>
					                <th>Comment</th>
					                <th>Status</th>
					                <th class="text-left">Actions</th>
					            </tr>
							</thead>
							<tbody>
								<!-- <tr>

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

					       -->

					          

							</tbody>

						

						</table>

					</div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.all.js"></script>
<!-- <script src="{{url('/')}}/assets/admin/assets/js/pages/sweetalert_msg.js"></script> -->
<!-- <script src="{{url('/')}}/assets/admin/assets/js/pages/sweetalert.min.js"></script> -->
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
        "bStateSave": true,
        "bSearchable":true,
        "processing": true,
	    "serverSide": true,
	    "searchDelay": 350,
	    "autoWidth": false,
	    "bFilter": true,
	    "bLengthChange": true,
        ajax: {
            url: "{{ $module_url_path}}/load_evaluation_data",
            data: function(d) {
                d['column_filter[full_name]']   = $("input[name='full_name']").val()
                d['column_filter[email]']       = $("input[name='email']").val()
                d['column_filter[status]']      = $("select[name='status']").val()
                d['column_filter[role]']        = $("select[name='role']").val()
            }
        },
        columns: [           
            {data : 'sr_no',"orderable":false,"searchable":false,name:'sr_no'},
            {data : 'evaluation_id',"orderable":true,"searchable":true,name:'evaluation_id'},
            {data : 'order_id',"orderable":true,"searchable":true,name:'order_id'},
            {data : 'customer_name',"orderable":false,"searchable":true,name:'customer_name'},
            {data : 'product',"orderable":false,"searchable":true,name:'product'},
            {data : 'option',"orderable":false,"searchable":false,name:'option'},
            {data : 'evaluation',"orderable":false,"searchable":false,name:'evaluation'},
            {data : 'comment',"orderable":false,"searchable":false,name:'comment'},
            {data : 'status',"orderable":false,"searchable":false,name:'status'},
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

	$('body').on('click','.update-status',function(){
		//alert($(this).attr('status'));
		var status = $(this).attr('status');
		var id = $(this).attr('rel');

		var status_url = '{{ url('/') }}/admin/orders/evaluations/change_evalution_status/';
		$.ajax({
            url : status_url ,
            type : "GET",
            data : {status:status,id:id},
            dataType: 'JSON',
            success:function(resp){
            	swal({
					title: resp.status,
					text:resp.msg,
					type: resp.status
					}).then(function() {
					// Redirect the user
						window.location.href = "{{$module_url_path}}";
					});
            }
        });
	});



	$(".modal-footer").hide();
	$('body').on('click','#open_edit_evaluation_modal',function(){
		var id = btoa($(this).data("id"));
		 $.ajax({
            url : '{{ url('/') }}/admin/orders/evaluations/get_evaluation_data/'+id,
            type : "GET",
            dataType: 'JSON',
            success:function(resp){
                if(resp.status=='success'){
                    $('#edit_order_id').val(resp.data.get_order_details.order_id);
                    $('#edit_full_name').val(resp.data.get_customer_details.full_name);
                    $('#edit_customer_group').val(resp.data.get_customer_details.get_group_details.group_name);
                    $('#edit_product').val(resp.data.get_orderproduct_details.get_product_details.product_english_name);
                    $('#edit_comment').val(resp.data.comment);
                    $('#edit_evaluation').val(resp.data.evaluation);
                    $('.status_check').attr('data-id',resp.data.id);
               		var arr = [];
	               	$.each(resp.data.get_orderproduct_details.get_productoption_selected,function(index,value){
	               		// console.log(value.get_option_details.english_name);
	               		arr.push(value.get_option_details.english_name);
	               	});      			
	                $('#edit_options').val(arr.toString());
	                $('#edit_options').tagsinput(arr.toString());
					$("#edit_modal_form_vertical").modal('show');
					if(resp.data.status=='pending'){
						$(".modal-footer").show();
					}
                }else if(resp.status=='error'){
                    $("#modal_form_vertical").modal('hide');
                    $('#add_select_code').html(resp.data);
                }
            }
        })	
	});
	$('body').on('click','.close_modal',function(){
		$('#add_staff')[0].reset();
		$('#edit_staff')[0].reset();
	});
	/*Block unblock call*/
	$('body').on('click','.accept-block-unblock',function(){
		var id 		= $('.status_check').data("id");
		var status_url = '{{ url('/') }}/admin/orders/evaluations/accept_status/'+btoa(id)
		$.ajax({
            url : status_url ,
            type : "GET",
            dataType: 'JSON',
            success:function(resp){
            	swal({
					title: resp.status,
					text:resp.msg,
					type: resp.status
					}).then(function() {
					// Redirect the user
						window.location.href = "{{$module_url_path}}";
					});
            }
        });
	});
	$('body').on('click','.reject-block-unblock',function(){
		var id 		= $('.status_check').data("id");
		var status_url = '{{ url('/') }}/admin/orders/evaluations/reject_status/'+btoa(id)
		$.ajax({
            url : status_url ,
            type : "GET",
            dataType: 'JSON',
            success:function(resp){
            	swal({
					title: resp.status,
					text:resp.msg,
					type: resp.status
					}).then(function() {
					// Redirect the user
						window.location.href = "{{$module_url_path}}";
					});
            }
        });
	});
});
</script>
<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/forms/tags/tagsinput.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/forms/tags/tokenfield.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/ui/prism.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/pages/form_tags_input.js"></script>
<!-- Mirrored from demo.interface.club/limitless/layout_1/LTR/default/datatable_api.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 05:50:56 GMT -->
</html>