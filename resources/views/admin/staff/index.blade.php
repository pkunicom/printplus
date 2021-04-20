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
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/core/app.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/uploaders/fileinput/fileinput.min.js"></script>
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
				<!-- Page header -->
				<!-- /page header -->
				<!-- Content area -->
				<div class="clearfix"></div>
				<div class="content">
					<!-- Individual column searching (text inputs) -->
					@include('admin.layout._operation_status')
					<div class="panel panel-flat">
						<div class="page-head-section-main">
							<div class="page-head-txt">
								Manage Staff <span></span>
							</div>
							<div class="breadcrumb-section-main">
								@include('admin.layout.breadcrumb')	
							</div>
						</div>
						<div class="add-user-btn-main">
							<span class="table-search-section">
								<i class="fa fa-search"></i>
								<input type="text" name="search" placeholder="Search">
							</span>
							<a class="btn datatable-btns-section" id="open_add_staff_modal" href="javascript:void(0)"><i class="icon-plus3"></i> Add Staff</a>
						</div>
						<div class="clearfix"></div>
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
						</div>
						<div id="edit_modal_form_vertical" class="modal fade addUserModalMain">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header bg-primary">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h5 class="modal-title">Edit Staff</h5>
									</div>
									<form action="{{ url('/') }}/admin/staff/update" id="edit_staff" method="post" enctype="multipart/form-data" >
										{{csrf_field()}}
										<input type="hidden" name="enc_id" id="enc_id" value="">
										<div class="modal-body">
											<div class="form-group">	
												<div class="selected-img">
													<img src=""  id="append_img">
												</div>
												<input type="file" class="file-input" name="edit_image" id="edit_image"  data-show-caption="false" data-show-upload="false">												
											</div>
											<div class="row">
												<div class="col-sm-6 col-md-6 col-lg-6">
													<div class="form-group">
														<label>Full Name</label>
														<input type="text" data-rule-required="true" name="edit_full_name" id="edit_full_name" placeholder="Enter Full Name" class="form-control">
													</div>
												</div>
												<div class="col-sm-6 col-md-6 col-lg-6">
													<div class="form-group">
														<label>Email</label>
														<input type="text" data-rule-required="true" data-rule-email="true" name="edit_email" id="edit_email"  placeholder="Enter email" class="form-control">
													</div>	
												</div>
												<div class="col-sm-6 col-md-6 col-lg-6">	
													<div class="form-group">
														<label>Mobile</label>
														<div class="mobile-drop-section-main" id="edit_select_code">
															<div class="mobile-drop-section-select">
																<select name="edit_country_id" data-rule-required="true" id="edit_country_id" class="form-control">	
																	<option  value="">Select code</option>
																</select>
															</div>
															<div class="mobile-drop-section-input">
																<input type="text" placeholder="Enter mobile number" id="edit_mobile_number" name="edit_mobile_number" data-rule-required="true" data-rule-number="true" class="form-control" autocomplete="off">
															</div>
														</div>
													</div>
												</div>	
												<div class="col-sm-6 col-md-6 col-lg-6">				
													<div class="form-group">							
														<label>Role</label>
														<select data-rule-required="true" id="edit_role" name="edit_role" class="form-control">	
															<option value="admin">Admin</option>
															<option value="operator">Operator</option>
															<option value="support">Support</option>
														</select>									
													</div>	
												</div>
												<div class="col-sm-6 col-md-6 col-lg-6">
													<div class="form-group">							
														<label>User Status</label> : 
														<span id="user_status"> Active</span>
													</div>
												</div>
												<div class="col-sm-6 col-md-6 col-lg-6">
													<div class="form-group">							
														<label>Password</label> :
														<span > <a href="javascript:void(0)" id="show_reset_password">Reset</a></span>								
													</div>
												</div>
												<div class="col-sm-6 col-md-6 col-lg-6 reset_password" >
													<div class="form-group">							
														<label>Password</label>
														<input type="password" data-rule-required="true" id="edit_password" name="edit_password" placeholder="Enter password" class="form-control">
													</div>
												</div>
												<div class="col-sm-6 col-md-6 col-lg-6 reset_password" >
													<div class="form-group">							
														<label>Confirm Password</label>
														<input type="password" data-rule-required="true" data-rule-equalto="#edit_password" id="edit_confirm_password" placeholder="Confirm Password" class="form-control">
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-primary close_modal" data-dismiss="modal">Close</button>
											<button type="button" class="btn btn-primary"><span id='block-unblock'></span></button>
											<button type="submit" class="btn btn-primary">Update</button>
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
					                <th>Name
					                	<!-- <input type="text" name="full_name" placeholder="Search" class="search-block-new-table form-control column_filter"> -->
					                </th>
					                <th>Email
					                	<!-- <input type="text" name="email" placeholder="Search" class="search-block-new-table form-control column_filter"> -->
					                </th>
					                <th>Status
					               		<!-- <select class="search-block-new-table column_filter form-control" id="status" name="status">
                                            <option value="">All</option>
                                            <option value="1">Active</option>
                                            <option value="0">Blocked</option>
                                        </select> -->
                                    </th>
					                <th>Role
					                	<!-- <select class="search-block-new-table column_filter form-control" id="role" name="role">
                                            <option value="">All</option>
                                            <option value="admin">Admin</option>
                                            <option value="operator">Operator</option>
                                            <option value="support">Support</option>
                                        </select> -->
                                    </th>
					                <th>Last sign in</th>
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
          "language": {
        processing: "Hang on. Waiting for response..." //add a loading image,simply putting <img src="loader.gif" /> tag.
    },
	    "serverSide": true,
	    "searchDelay": 350,
	    "autoWidth": false,
	    "bFilter": true,
	    "bLengthChange": true,
        ajax: {
            url: "{{ $module_url_path}}/load_data",
            data: function(d) {
                d['column_filter[full_name]']   = $("input[name='full_name']").val()
                d['column_filter[email]']       = $("input[name='email']").val()
                d['column_filter[status]']      = $("select[name='status']").val()
                d['column_filter[role]']        = $("select[name='role']").val()
            }
        },
        columns: [          

            {data : 'sr_no',"orderable":false,"searchable":false,name:'sr_no'},

            {data : 'full_name',"orderable":true,"searchable":true,name:'full_name'},

            {data : 'email',"orderable":true,"searchable":true,name:'email'},

            {data : 'status',"orderable":false,"searchable":true,name:'status'},

            {data : 'role',"orderable":false,"searchable":true,name:'role'},

            {data : 'last_logged_at',"orderable":false,"searchable":false,name:'last_logged_at'},

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
	
	$('.table-search-section input').on( 'keyup change', function() {	

		if(this.value == ''){
				//alert('hi');
				$('.table-search-section input').val(' ').trigger('change');
				$('.table-search-section input').val('');
				table.ajax.reload();
		}else{
			table.search( this.value ).draw();
		} 
 	
	});
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
	$("#add_staff").validate();
	$("#edit_staff").validate();
	$('body').on('click','#open_add_staff_modal',function(){
		 $.ajax({
            url : '{{ url('/') }}/admin/staff/get_countries',
            type : "GET",
            dataType: 'JSON',
            success:function(resp){
                if(resp.status=='success'){
					$("#modal_form_vertical").modal('show');
                    $('#add_select_code').html(resp.data);
                }else if(resp.status=='error'){
                    $("#modal_form_vertical").modal('hide');
                    $('#add_select_code').html(resp.data);
                }
            }
        })	
	});
	$('body').on('click','#open_edit_staff_modal',function(){
        var id = btoa($(this).data("id"));
        $('.reset_password').hide();
        $.ajax({
            url : '{{ url('/') }}/admin/staff/edit_get_countries/'+id,
            type : "GET",
            dataType: 'JSON',
            success:function(resp){
                if(resp.status=='success'){
                    $('#edit_select_code').html(resp.data);
                }
            }
        });
		$.ajax({
            url : '{{ url('/') }}/admin/staff/edit_staff/'+id,
            type : "GET",
            dataType: 'JSON',
            data : id,
            success:function(resp){
                if(resp.status=='success'){
					$("#edit_modal_form_vertical").modal('show');
                    $('#enc_id').val(btoa(resp.data.id));
                    $('#edit_role').val(resp.data.role);
                    $('#edit_email').val(resp.data.email);
                    $('#edit_full_name').val(resp.data.full_name);
                    $('#edit_mobile_number').val(resp.data.mobile_number);
					$("#block-unblock").attr("data-status", resp.data.status);
                    if(resp.data.profile_image!=null){
	                	var url = "{{ url('/') }}"
	                	var img = url+"/uploads/users/profile_image/"+resp.data.profile_image
                    	$("#append_img").attr("src", img);
                    }
                    if(resp.data.status == '1'){
                    	$('#user_status').html('Active');
                    	$('#block-unblock').html('Block');
                    }else{
                    	$('#user_status').html("Blocked");
                    	$('#block-unblock').html('Unblock');
                    }
                }else if(resp.status=='error'){
                    $("#edit_modal_form_vertical").modal('hide');
                }
            }
        })	
	});
	$('body').on('click','#show_reset_password',function(){
		$('.reset_password').toggle();
	});
	$('body').on('click','.close_modal',function(){
		$('#add_staff')[0].reset();
		$('#edit_staff')[0].reset();
	});

	/*Block unblock call*/
	$('body').on('click','#block-unblock',function(){
		var id = $("#enc_id").val();
		var status = $(this).data("status");
		if(status=='1'){
			var status_url = '{{ url('/') }}/admin/staff/block/'+id
		}else{
			var status_url = '{{ url('/') }}/admin/staff/unblock/'+id
		}
		$.ajax({
            url : status_url ,
            type : "GET",
            dataType: 'JSON',
            success:function(resp){
            	if(resp.status=="success"){
            		swal("Success","Staff Status Updated","success");
            	}else{
            		swal("Warning","Something went wrong","warning");
            	}
            	setTimeout(function(){ location.reload(); }, 2000);
            }
        });
	});
});
</script>
<!-- Mirrored from demo.interface.club/limitless/layout_1/LTR/default/datatable_api.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 05:50:56 GMT -->
</html>
