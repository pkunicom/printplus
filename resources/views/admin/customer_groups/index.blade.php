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
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/notifications/jgrowl.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/ui/moment/moment.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/pickers/daterangepicker.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/pickers/anytime.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/pickers/pickadate/picker.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/pickers/pickadate/picker.date.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/pickers/pickadate/picker.time.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/pickers/pickadate/legacy.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/core/app.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/pages/picker_date.js"></script>
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
								Customer Groups <span></span>
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
							<a class="btn btn-primary"  id="open_add_group_modal" href="javascript:void(0)">Add Group</a>
						</div>
						<div class="clearfix"></div>
						<div id="add_modal_form_vertical" class="modal fade addUserModalMain">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header bg-primary">
										<button type="button" class="close close_modal" data-dismiss="modal">&times;</button>
										<h5 class="modal-title">Add Group</h5>
									</div>
									<form action="{{ $module_url_path }}/add_group" id="add_group" method="post" enctype="multipart/form-data" >
										{{csrf_field()}}										
										<div class="modal-body">										
											<div class="row">
												<div class="col-sm-6 col-md-6 col-lg-12">
													<div class="form-group">												
														<label>Group Name</label>
														<input type="text" data-rule-required="true" name="group_name" id="group_name" class="form-control" >
													</div>
												</div>
												<div class="col-sm-6 col-md-6 col-lg-12">
													<div class="form-group">												
														<label>Standard Discount</label>
														<input type="text" data-rule-required="true" min="0" max="100"  data-rule-number="true" name="standard_discount" id="standard_discount" class="form-control" >
													</div>
												</div>										
											</div>
										</div>
										<div class="modal-footer">
											<button type="submit" class="btn btn-primary">Add</button>
											<button type="button" class="btn btn-primary close_modal" data-dismiss="modal">Close</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div id="edit_modal_form_vertical" class="modal fade addUserModalMain">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header bg-primary">
										<button type="button" class="close close_modal" data-dismiss="modal">&times;</button>
										<h5 class="modal-title">Edit Group</h5>
									</div>
									<form action="{{ $module_url_path }}/edit_group" id="edit_group" method="post" enctype="multipart/form-data" >
										{{csrf_field()}}
										<input type="hidden" id="enc_id" name="enc_id">	
										<div class="modal-body">
											<div class="row">
												<div class="col-sm-6 col-md-6 col-lg-12">
													<div class="form-group">												
														<label>Group Name</label>
														<input type="text" data-rule-required="true" name="edit_group_name" id="edit_group_name" class="form-control" >
													</div>
												</div>
												<div class="col-sm-6 col-md-6 col-lg-12">
													<div class="form-group">												
														<label>Standard Discount</label>
														<input type="text" data-rule-required="true" min="0" max="100"  data-rule-number="true" name="edit_standard_discount" id="edit_standard_discount" class="form-control" >
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="submit" class="btn btn-primary">Update</button>
											<button type="button" class="btn btn-primary close_modal" data-dismiss="modal">Close</button>
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
					                <th>Group ID</th>
					                <th>Group Name</th>
					                <th>Standard Discount</th>
					                <th class="text-left">Actions</th>
					            </tr>
							</thead>
							<tbody>
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
<script src="{{url('/')}}/assets/admin/assets/js/pages/sweetalert_msg.js"></script>
<script src="{{url('/')}}/assets/admin/assets/js/pages/sweetalert.min.js"></script>
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
	    "serverSide": false,
	    "searchDelay": 350,
	    "autoWidth": false,
	    "bFilter": true,
	    "bLengthChange": true,
        ajax: {
            url: "{{ $module_url_path}}/load_data",
            data: function(d) {
                // d['column_filter[full_name]']   = $("input[name='full_name']").val()
                // d['column_filter[email]']       = $("input[name='email']").val()
                // d['column_filter[status]']      = $("select[name='status']").val()
                // d['column_filter[role]']        = $("select[name='role']").val()
            }
        },
        columns: [          
            {data : 'sr_no',"orderable":false,"searchable":false,name:'sr_no'},
            {data : 'group_id',"orderable":true,"searchable":true,name:'group_id'},
            {data : 'group_name',"orderable":true,"searchable":true,name:'group_name'},
            {data : 'standard_discount',"orderable":false,"searchable":true,name:'standard_discount'},
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
	$("#add_group").validate();
	$("#edit_group").validate();
	$('body').on('click','#open_add_group_modal',function(){
        $("#add_modal_form_vertical").modal('show');  		
    });
	$('body').on('click','#open_edit_modal',function(){
        var id = btoa($(this).data("id"));
		$.ajax({
            url : '{{ $module_url_path }}/get_group_data/'+id,
            type : "GET",
            dataType: 'JSON',
            success:function(resp){
                if(resp.status=='success'){
                    $('#enc_id').val(btoa(resp.data.id));
                    $('#edit_standard_discount').val(resp.data.standard_discount);
                    $('#edit_group_name').val(resp.data.group_name);                  
					$("#edit_modal_form_vertical").modal('show');             
                }else if(resp.status=='error'){
                    $("#edit_modal_form_vertical").modal('hide');
                }
            }
        })	
	});
	$('body').on('click','.close_modal',function(){
		$('#add_discount')[0].reset();
		$('#edit_discount')[0].reset();
	});
	// $( '#add_start_date' ).pickadate({
	// 	  format: 'yy-mm-dd',
	// 	  formatSubmit: 'yy-mm-dd'	
	// });
    $('#add_start_date').pickadate({
        format: 'yyyy-mm-dd',
        hiddenName: true
    });
    $('#add_end_date').pickadate({
        format: 'yyyy-mm-dd',
        hiddenName: true
    });
    $('#edit_start_date').pickadate({
   		format: 'yyyy-mm-dd',
        hiddenName: true
    });
    $('#edit_end_date').pickadate({
        format: 'yyyy-mm-dd',
        hiddenName: true
    });
    $('#add_start_time').pickatime({
         default: 'now',
        twelvehour: false, // change to 12 hour AM/PM clock from 24 hour
        donetext: 'OK',
        format: "HH:i",
        autoclose: false,
        vibrate: true
    });
    $('#add_end_time').pickatime({
        default: 'now',
        twelvehour: false, // change to 12 hour AM/PM clock from 24 hour
        donetext: 'OK',
        format: "HH:i",
        autoclose: false,
        vibrate: true
    });
    $('#edit_start_time').pickatime({
   		default: 'now',
        twelvehour: false, // change to 12 hour AM/PM clock from 24 hour
        donetext: 'OK',
        format: "HH:i",
        autoclose: false,
        vibrate: true
    });
    $('#edit_end_time').pickatime({
        default: 'now',
        twelvehour: false, // change to 12 hour AM/PM clock from 24 hour
        donetext: 'OK',
        format: "HH:i",
        autoclose: false,
        vibrate: true
    });
	$("#add_discount").submit(function(e)
    {
        var start_date    = $("#add_start_date").val(); 
        var end_date      = $("#add_end_date").val();
        var start_time    = $("#add_start_time").val();
        var end_time    = $("#add_end_time").val();      
        $('#add_discount').validate();
        if(start_date!='' && end_date!=''){
	        if(new Date(start_date) > new Date(end_date))
	        {
	            swal('Error!','Start date should be less than End date','error');
	            e.preventDefault(e);
	        }
	        if(start_date == end_date){
	            if( start_time > end_time ){
	            swal('Error!','Start time should be less than End time','error');
	            e.preventDefault(e);
	            }
	            else if(start_time == end_time){
	            swal('Error!','Start time and End time cannot be same for the same day','error');
	            e.preventDefault(e);
	            }
	        }
        }
        /*else if(start_time > return_time){
            swal('Error!','Start time should be greater than End time','error');
            e.preventDefault(e);
        }*/
     });      
     $("#edit_discount").submit(function(e)
    {
        var start_date    = $("#edit_start_date").val(); 
        var end_date      = $("#edit_end_date").val();
        var start_time    = $("#edit_start_time").val();
        var end_time    = $("#edit_end_time").val();     
        $('#edit_discount').validate();
        if(new Date(start_date) > new Date(end_date))
        {
            swal('Error!','Start date should be less than End date','error');
            e.preventDefault(e);
        }
        if(start_date == end_date){
            if( start_time > end_time ){
            swal('Error!','Start time should be less than End time','error');
            e.preventDefault(e);
            }
            else if(start_time == end_time){
            swal('Error!','Start time and End time cannot be same for the same day','error');
            e.preventDefault(e);
            }
        }
        /*else if(start_time > return_time){
            swal('Error!','Start time should be greater than End time','error');
            e.preventDefault(e);
        }*/
     });       
});
</script>
<!-- Mirrored from demo.interface.club/limitless/layout_1/LTR/default/datatable_api.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 05:50:56 GMT -->
</html>