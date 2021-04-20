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
	<style>.section {float: left;width: 50%;}</style>
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
					@include('admin.layout.breadcrumb')	
				</div>
				<!-- /page header -->

				<div class="add-user-btn-main">
					<a class="btn btn-primary"  id="open_add_accessory_modal" href="javascript:void(0)">Add Accessory</a>
				</div>
				<div class="clearfix"></div>

				<!-- Content area -->
				<div class="content">
					<!-- Individual column searching (text inputs) -->
					@include('admin.layout._operation_status')
					<div class="panel panel-flat">						
						<div id="modal_form_vertical" class="modal fade addUserModalMain">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header bg-primary">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h5 class="modal-title">Add Accessory</h5>
									</div>
									<form action="{{$module_url_path}}/store" id="add_accessory" method="post" enctype="multipart/form-data" >
										{{csrf_field()}}
										<div class="modal-body">
											<div class="row section">
												<div class="col-sm-12 col-md-12 col-lg-12">
													<div class="form-group">												
														<label>Arabic Name</label>
														<input type="text" data-rule-required="true"  name="ar_name" id="ar_name"  placeholder="Enter Arabic Name" class="form-control" maxlength="100" oninput="check_ar_accessory(this)">
													</div>	
													<span id="error_ar_name" style="color:red;"></span>
												</div>
												<div class="col-sm-12 col-md-12 col-lg-12">
													<div class="form-group">												
														<label>English Name</label>
														<input type="text" data-rule-required="true" name="en_name" id="en_name" placeholder="Enter English Name" class="form-control" maxlength="100" oninput="check_en_accessory(this)">
													</div>
													<span id="error_en_name" style="color:red;"></span>
												</div>
												<div class="col-sm-12 col-md-12 col-lg-12">
													<div class="form-group">												
														<label>Accessory Owner</label>
														<select class="form-control" id="accessory_owner" data-rule-required="true" name="accessory_owner">
															<option value="">Select Accessory Owner</option>
															@foreach($arr_agent as $key_agent => $value_agent)
																<option value="{{ $value_agent['id'] ?? '' }}">{{ $value_agent['full_name'] ?? '' }}</option>
															@endforeach	
														</select>
													</div>
												</div>
												<div class="col-sm-12 col-md-12 col-lg-12">
													<div class="form-group">												
														<label>Weight</label>
														<input type="number" data-rule-required="true" name="weight" id="weight" placeholder="Enter Weight" class="form-control">
													</div>
												</div>
												<div class="col-sm-12 col-md-12 col-lg-12">
													<div class="form-group">												
														<label>Cost</label>
														<input type="number" data-rule-required="true" name="cost" id="cost" placeholder="Enter Cost" class="form-control">
													</div>
												</div>
												<div class="col-sm-12 col-md-12 col-lg-12">
													<div class="form-group">												
														<label>Margin</label>
														<input type="number" data-rule-required="true" name="margin" id="margin" placeholder="Enter Margin" class="form-control">
													</div>
												</div>
												<div class="col-sm-12 col-md-12 col-lg-12">
													<div class="form-group">												
														<label>Selling</label>
														<input type="number" data-rule-required="true" name="selling" id="selling" placeholder="Enter Selling" class="form-control">
													</div>
												</div>
												
											</div>
											<div class="section" style="padding-left: 23px;">
												<div class="form-group">												
													<input type="file" class="file-input" name="add_accessory_image" data-show-caption="false"  data-show-upload="false">												
												</div>
											</div>
										</div>
										<div class="modal-footer" style="padding-top: 565px;">
											<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
											<button type="submit" id="proceed_add" class="btn btn-primary">Add</button>
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
										<h5 class="modal-title">Edit accessory</h5>
									</div>
									<form action="{{ url('/') }}/admin/accessory/update" id="edit_accessory" method="post" enctype="multipart/form-data" >
										{{csrf_field()}}
										<div class="modal-body">
											<div class="row section">
												<input type="hidden" name="enc_id" id="enc_id">
												<div class="col-sm-12 col-md-12 col-lg-12">
													<div class="form-group">												
														<label>Arabic Name</label>
														<input type="text" data-rule-required="true"  name="edit_ar_name" id="edit_ar_name"  placeholder="Enter Arabic Name" class="form-control" maxlength="100" oninput="check_edit_ar_accessory(this)">
													</div>	
													<span id="error_edit_ar_name" style="color:red;"></span>
												</div>
												<div class="col-sm-12 col-md-12 col-lg-12">
													<div class="form-group">												
														<label>English Name</label>
														<input type="text" data-rule-required="true" name="edit_en_name" id="edit_en_name" placeholder="Enter English Name" class="form-control" maxlength="100" oninput="check_edit_en_accessory(this)">
													</div>
													<span id="error_edit_en_name" style="color:red;"></span>
												</div>
												<div class="col-sm-12 col-md-12 col-lg-12">
													<div class="form-group">												
														<label>Accessory Owner</label>
														<select class="form-control" id="edit_accessory_owner" data-rule-required="true" name="edit_accessory_owner">
															<option value="">Select Accessory Owner</option>
															@foreach($arr_agent as $key_agent => $value_agent)
																<option value="{{ $value_agent['id'] ?? '' }}">{{ $value_agent['full_name'] ?? '' }}</option>
															@endforeach	
														</select>
													</div>
												</div>
												<div class="col-sm-12 col-md-12 col-lg-12">
													<div class="form-group">												
														<label>Weight</label>
														<input type="number" data-rule-required="true" name="edit_weight" id="edit_weight" placeholder="Enter Weight" class="form-control">
													</div>
												</div>
												<div class="col-sm-12 col-md-12 col-lg-12">
													<div class="form-group">												
														<label>Cost</label>
														<input type="number" data-rule-required="true" name="edit_cost" id="edit_cost" placeholder="Enter Cost" class="form-control">
													</div>
												</div>
												<div class="col-sm-12 col-md-12 col-lg-12">
													<div class="form-group">												
														<label>Margin</label>
														<input type="number" data-rule-required="true" name="edit_margin" id="edit_margin" placeholder="Enter Margin" class="form-control">
													</div>
												</div>
												<div class="col-sm-12 col-md-12 col-lg-12">
													<div class="form-group">												
														<label>Selling</label>
														<input type="number" data-rule-required="true" name="edit_selling" id="edit_selling" placeholder="Enter Selling" class="form-control">
													</div>
												</div>
												
											</div>
											<div class="section" style="padding-left: 23px;">
												<div class="form-group">
													<div class="selected-img">
														<img src=""  id="edit_accessory_image">
													</div>												
													<input type="file" class="file-input" name="edit_accessory_image" data-show-caption="false"  data-show-upload="false">												
												</div>
											</div>
										</div>
										<div class="modal-footer" style="padding-top: 565px;">
											<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
											<button type="submit" id="proceed_edit" class="btn btn-primary">Upload</button>
										</div>
									</form>
								</div>
							</div>
						</div>		
						<table class="table datatable-column-search-inputs">
							</tfoot>
							<thead>
								<tr>
									<th>#</th>
					                <th>Accessory ID
					                	<!-- <input type="text" name="id" placeholder="Search" class="search-block-new-table form-control column_filter"> -->
					                </th>
					                <th>English Name
					                	<!-- <input type="text" name="english_name" placeholder="Search" class="search-block-new-table form-control column_filter"> -->
					                </th>
									<th>Arabic Name
					                	<!-- <input type="text" name="arabic_name" placeholder="Search" class="search-block-new-table form-control column_filter"> -->
					                </th>
									<th>Accessory Owner</th>
									<th>Weight</th>
									<th>Cost</th>
									<th>Margin</th>
									<th>Selling</th>
					                <th >Actions</th>
					            </tr>
							</thead>						
						</table>
					</div>
					<!-- /individual column searching (text inputs) -->
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
$(document).ready(function(){
	$("#add_accessory").validate();
	$("#edit_accessory").validate();

	$('body').on('click','#open_add_accessory_modal',function(){
		$("#modal_form_vertical").modal('show');	
	});

	$('body').on('click','#open_edit_accessory_modal',function(){
        var id = btoa($(this).data("id"));
		$.ajax({
            url : '{{$module_url_path}}/edit/'+id,
            type : "GET",
            dataType: 'JSON',
            data : id,
            success:function(resp){
                if(resp.status=='success'){
					$("#edit_modal_form_vertical").modal('show');
                    $('#enc_id').val(btoa(resp.data.id));
                    $('#edit_en_name').val(resp.data.english_name);
                    $('#edit_ar_name').val(resp.data.arabic_name);
					$('#edit_accessory_owner').val(resp.data.accessory_owner);
					$('#edit_weight').val(resp.data.weight);
					$('#edit_cost').val(resp.data.cost);
					$('#edit_margin').val(resp.data.margin);
					$('#edit_selling').val(resp.data.selling);
					if(resp.data.accessory_image!=null){
	                	var url = "{{ url('/') }}"
	                	var img = "{{$accessory_image_public_path}}/"+resp.data.accessory_image
                    	$("#edit_accessory_image").attr("src", img);
                    }
					// $('#edit_accessory_owner').val(resp.data.arabic_name);
					// $("#proceed_edit").attr('disabled', true);
                    
                }else if(resp.status=='error'){
                    $("#edit_modal_form_vertical").modal('hide');
                }
            }
        })	
	});	
});
function check_en_accessory()
{
	var en_accessory             = $('#en_name').val();
	var token                   = "{{csrf_token()}}";
	var base_url                = '{{$module_url_path}}/check_en_accessory';
	$.ajax({
		url: base_url,
		type: "POST",
		data: {
			_token: token,
			en_accessory: en_accessory,
		},
		success:function(resp){
				if(resp.status=='error')
				{ 
					document.getElementById('error_en_name').innerHTML = 'Accessories allready Exist';
					$("#proceed_add").attr('disabled', true);
					return false;
				}
				else
				{
					document.getElementById('error_en_name').innerHTML = '';
					$("#proceed_add").attr('disabled', false);
					return true;
				}
			}
	});
}

function check_ar_accessory()
{
	var ar_accessory             = $('#ar_name').val();
	// alert(ar_accessory);
	var token                   = "{{csrf_token()}}";
	var base_url                = '{{$module_url_path}}/check_ar_accessory';
	$.ajax({
		url: base_url,
		type: "POST",
		data: {
			_token: token,
			ar_accessory: ar_accessory,
		},
		success:function(resp){
				if(resp.status=='error')
				{ 
					document.getElementById('error_ar_name').innerHTML = 'Accessories allready Exist';
					$("#proceed_add").attr('disabled', true);
					return false;
				}
				else
				{
					document.getElementById('error_ar_name').innerHTML = '';
					$("#proceed_add").attr('disabled', false);
					return true;
				}
			}
	});
}

function check_edit_en_accessory()
{
	var en_accessory             = $('#edit_en_name').val();
	// alert(en_accessory);
	var token                   = "{{csrf_token()}}";
	var base_url                = '{{$module_url_path}}/check_en_accessory';
	$.ajax({
		url: base_url,
		type: "POST",
		data: {
			_token: token,
			en_accessory: en_accessory,
		},
		success:function(resp){
				if(resp.status=='error')
				{ 
					document.getElementById('error_edit_en_name').innerHTML = 'Accessories allready Exist';
					$("#proceed_edit").attr('disabled', true);
					return false;
				}
				else
				{
					document.getElementById('error_edit_en_name').innerHTML = '';
					$("#proceed_edit").attr('disabled', false);
					return true;
				}
			}
	});
}
function check_edit_ar_accessory()
{
	var ar_accessory             = $('#edit_ar_name').val();
	// alert(ar_accessory);
	var token                   = "{{csrf_token()}}";
	var base_url                = '{{$module_url_path}}/check_ar_accessory';
	$.ajax({
		url: base_url,
		type: "POST",
		data: {
			_token: token,
			ar_accessory: ar_accessory,
		},
		success:function(resp){
				if(resp.status=='error')
				{ 
					document.getElementById('error_edit_ar_name').innerHTML = 'Accessories allready Exist';
					$("#proceed_edit").attr('disabled', true);
					return false;
				}
				else
				{
					document.getElementById('error_edit_ar_name').innerHTML = '';
					$("#proceed_edit").attr('disabled', false);
					return true;
				}
			}
	});
}
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
            url: "{{ $module_url_path}}/load_data",
            data: function(d) {
                d['column_filter[id]']   				= $("input[name='id']").val()
                d['column_filter[english_name]']       	= $("input[name='english_name']").val()
				d['column_filter[arabic_name]']       	= $("input[name='arabic_name']").val()
                d['column_filter[status]']      		= $( "select[name='status']" ).val()
            }
        },
        columns: [
           
            {data : 'sr_no',"orderable":false,"searchable":true,name:'sr_no'},
            {data : 'id',"orderable":false,"searchable":true,name:'id'},
            {data : 'english_name',"orderable":false,"searchable":true,name:'english_name'},
			{data : 'arabic_name',"orderable":false,"searchable":true,name:'arabic_name'},
			{data : 'accessory_owner',"orderable":false,"searchable":true,name:'accessory_owner'},
			{data : 'weight',"orderable":false,"searchable":true,name:'weight'},
			{data : 'cost',"orderable":false,"searchable":true,name:'cost'},
			{data : 'margin',"orderable":false,"searchable":true,name:'margin'},
			{data : 'selling',"orderable":false,"searchable":true,name:'selling'},
            // {data : 'status',"orderable":false,"searchable":true,name:'status'},
            {
                render : function(data, type, row, meta) 
                {
                    return row.built_action_btns;
                },
                "orderable": false, "searchable":true

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



</script>

<!-- Mirrored from demo.interface.club/limitless/layout_1/LTR/default/datatable_api.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 05:50:56 GMT -->
</html>
