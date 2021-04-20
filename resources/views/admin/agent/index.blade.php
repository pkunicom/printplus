<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
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
	<link rel="stylesheet" href="{{ asset('assets/admin') }}/assets/css/telinput/intlTelInput.css">
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
	<!-- <script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/forms/styling/uniform.min.js"></script> -->
	<!-- <script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/pages/form_inputs.js"></script> -->
	<!-- Telinput -->
	<!-- Use as a Vanilla JS plugin -->
	<script src="{{ asset('assets/admin') }}/assets/css/telinput/js/intlTelInput.min.js"></script>
	<!-- Use as a jQuery plugin -->
	<script src="{{ asset('assets/admin') }}/assets/css/telinput/js/intlTelInput-jquery.min.js"></script>
	<!-- /theme JS files -->
</head>
<body>
	<style type="text/css">
		.red{color:red;}
	</style>
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
				<div class="clearfix"></div>
				<!-- Content area -->
				<div class="content">
					<!-- Individual column searching (text inputs) -->
					@include('admin.layout._operation_status')
					<div class="panel panel-flat">
						<div class="page-head-section-main">
							<div class="page-head-txt">
								Manage Agent <span></span>
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
							<a class="btn btn-primary"  id="open_add_agent_modal" onclick="open_add_agent_modal();" href="javascript:void(0)"><i class="icon-plus3"></i> Add Agent</a>
						</div>
						<div class="clearfix"></div>
						<div id="modal_form_vertical" class="modal fade addUserModalMain addmodalpopup">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header bg-primary">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h5 class="modal-title">Add Agent</h5>
									</div>
									<form action="{{ url('/') }}/admin/agent/store_agent" id="add_agent" method="post" enctype="multipart/form-data" >
										{{csrf_field()}}
										<div class="modal-body">
											<!-- Image code commented -->
										<!-- 	<div class="form-group">											
												<input type="file" class="file-input" name="add_image" data-show-caption="false" data-show-upload="false">												
											</div> -->
											<div class="row">
												<div class="col-sm-6 col-md-6 col-lg-6">
													<div class="form-group">
														<label>Agency Name <i class="red" >*</i></label>
														<input type="text" data-rule-required="true" name="agency_name" id="agency_name" placeholder="Enter Full Name" class="form-control txtOnly">
													</div>
												</div>
												<div class="col-sm-6 col-md-6 col-lg-6">
													<div class="form-group">
														<label>Contact Name <i class="red" >*</i></label>
														<input type="text" data-rule-required="true" name="contact_name" id="contact_name" placeholder="Enter Contact Name" class="form-control txtOnly">
													</div>
												</div>
												<div class="col-sm-6 col-md-6 col-lg-6">
													<div class="form-group">
														<label>Contact <i class="red" >*</i></label>
														<input type="text" data-rule-required="true" data-rule-number="true" name="contact_one" id="contact_one"  placeholder="Enter Contact No" class="form-control" maxlength="13">
													</div>	
												</div>	
												<div class="col-sm-6 col-md-6 col-lg-6">				
													<div class="form-group">							
														<label>Country <i class="red" >*</i></label>
														<select data-rule-required="true" id="country" name="country" class="form-control">
															<option value="">Select Country</option>
														@foreach($arr_sys_country as $key_country => $value_country)
															<option value="{{ $value_country['id'] ?? '' }}">{{ $value_country['country_english_name'] ?? '' }}</option>
														@endforeach	
														</select>								
													</div>	
												</div>											
												<div class="col-sm-6 col-md-6 col-lg-6">
													<div class="form-group">											
														<label>Email <i class="red" >*</i></label>
														<input type="text" data-rule-required="true" data-rule-email="true" name="email_one" id="email_one"  placeholder="Enter email" class="form-control">
													</div>	
												</div>
												<div class="col-sm-6 col-md-6 col-lg-6">				
													<div class="form-group">							
														<label>City <i class="red" >*</i></label>
														<select data-rule-required="true" id="city" name="city" class="form-control ">	
															<option value="">Select city</option>
														</select>								
													</div>	
												</div>
												<div class="col-sm-6 col-md-6 col-lg-6">	
													<div class="form-group">											
														<label>Mobile <i class="red" >*</i></label>
														<div class="mobile-drop-section-main select_code" >
															<div class="mobile-drop-section-select">
																<input type="hidden" name="country_id_one" id="country_id_one" class="form-control mobile_number_one">
																<input type="hidden" name="country_id_one_flag" id="country_id_one_flag" class="form-control mobile_number_one">
																{{--<select name="country_id_one" data-rule-required="true" id="country_id_one" class="form-control country_id">	
																	<option  value="">Select code</option>
																</select>--}}
															</div>
															<div class="mobile-drop-section-input">
																<input type="text" placeholder="Enter mobile number" id="mobile_number_one" name="mobile_number_one" data-rule-required="true" data-rule-number="true" class="form-control mobile_number_one" autocomplete="off" maxlength="13">
																<label id="mobile_number_one_error" class="error" for="mobile_number_one"></label>
															</div>
														</div>
													</div>
												</div>
												<div class="col-sm-6 col-md-6 col-lg-6">
													<div class="form-group">											
														<label>Main Address <i class="red" >*</i></label>
														<input type="text" data-rule-required="true" name="address" id="address" placeholder="Enter Your address" class="form-control txtOnly">
													</div>
												</div>
												<div class="col-sm-6 col-md-6 col-lg-6">
													<div class="form-group">											
														<label>Contact 2 </label>
														<input type="text" name="contact_two" id="contact_two"  placeholder="Enter Contact" class="form-control"  maxlength="13" >
													</div>	
												</div>
												
												<div class="col-sm-6 col-md-6 col-lg-6">
													<div class="form-group file-uploadSection-main">					
														<label>Company CR 11 <i class="red" >*</i></label>
															<input type="file" class="file-input" name="company_cr" id="company_cr" data-rule-required="true">	
														<span class="view-btn-upload"><i class="fal fa-eye"></i></span>		<label id="company_cr-error" class="error" for="company_cr"></label>			
													</div>	
												</div>
												<div class="col-sm-6 col-md-6 col-lg-6">
													<div class="form-group">											
														<label>Email 2</label>
														<input type="text"  data-rule-email="true" name="email_two" id="email_two"  placeholder="Enter email" class="form-control">
													</div>	
												</div>
												<div class="col-sm-6 col-md-6 col-lg-6">
													
													<div class="form-group file-uploadSection-main">					
														<label>License  <i class="red" >*</i></label>
															<input type="file" class="file-input" name="license" id="license" data-rule-required="true">	
														<span class="view-btn-upload"><i class="fal fa-eye"></i></span>		<label id="license-error" class="error" for="license"></label>			
													</div>
												</div>
												<div class="col-sm-6 col-md-6 col-lg-6">	
													<div class="form-group">											
														<label>Mobile 2</label>
														<div class="mobile-drop-section-main select_code" >
															<div class="mobile-drop-section-select">
																<input type="hidden" name="country_id_two" id="country_id_two" class="form-control mobile_number_two">
																<input type="hidden" name="country_id_two_flag" id="country_id_two_flag" class="form-control mobile_number_two">
																{{--<select name="country_id_two"  id="country_id_two" class="form-control country_id">	
																	<option  value="">Select code</option>
																</select>--}}
															</div>
															<div class="mobile-drop-section-input">
																<input type="text" placeholder="Enter mobile number" id="mobile_number_two" name="mobile_number_two"  data-rule-number="true" class="form-control mobile_number_two" autocomplete="off"  maxlength="13">
															</div>
														</div>
													</div>
												</div>
												<div class="col-sm-6 col-md-6 col-lg-6">
													
													<div class="form-group file-uploadSection-main">					
														<label>VAT Reg <i class="red" >*</i></label>
															<input type="file" class="file-input" name="vat_reg" id="vat_reg" data-rule-required="true">	
														<span class="view-btn-upload"><i class="fal fa-eye"></i></span>		<label id="vat_reg-error" class="error" for="vat_reg"></label>			
													</div>
												</div>
											</div>
											<div class="bank-info-head">
												Bank Information
											</div>
											<div class="row">
												<div class="col-sm-6 col-md-6 col-lg-6">
													<div class="form-group">
														<label>Account Name <i class="red" >*</i></label>
														<input type="text" data-rule-required="true" name="account_name" id="account_name" placeholder="Enter Account Name" class="form-control txtOnly">
													</div>
												</div>
												<div class="col-sm-6 col-md-6 col-lg-6">
													<div class="form-group">											
														<label>Account Number <i class="red" >*</i></label>
														<input type="text" data-rule-required="true" data-rule-number="true" name="account_number" id="account_number" placeholder="Enter Account Number" class="form-control">
													</div>
												</div>
												<div class="col-sm-6 col-md-6 col-lg-6">
													<div class="form-group">											
														<label>Bank Name <i class="red" >*</i></label>
														<input type="text" data-rule-required="true" name="bank_name" id="bank_name" placeholder="Enter Bank Name" class="form-control txtOnly">
													</div>
												</div>
												<div class="col-sm-6 col-md-6 col-lg-6">
													<div class="form-group">											
														<label>IBAN number <i class="red" >*</i></label>
														<input type="text" data-rule-required="true" name="iban_number" id="iban_number" placeholder="Enter IBAN number" class="form-control">
													</div>
												</div>
											</div>	
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-primary">Add</button>
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
					            </tr>
							</tfoot> -->
							<thead>
								<tr>
									<th>#</th>
									<th>Agency ID
					                	<!-- <input type="text" name="agency_id" placeholder="Search" class="search-block-new-table form-control column_filter"> -->
					                </th>
					                <th>Agency Name
					                	<!-- <input type="text" name="agency_name" placeholder="Search" class="search-block-new-table form-control column_filter"> -->
					                </th>
					                <th>Contact Name
					                	<!-- <input type="text" name="full_name" placeholder="Search" class="search-block-new-table form-control column_filter"> -->
					                </th>
					                <th>Email
					                	<!-- <input type="text" name="email" placeholder="Search" class="search-block-new-table form-control column_filter"> -->
					                </th>
					                 <th>Mobile Number
					                	<!-- <input type="text" name="mobile_number" placeholder="Search" class="search-block-new-table form-control column_filter"> -->
					                </th>
					                  <th>Status
					                	<!-- <input type="text" name="mobile_number" placeholder="Search" class="search-block-new-table form-control column_filter"> -->
					                </th>
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
	
		$('.justified-tab2').on('click', function(){
			if($('.file-input').hasClass('file-input-new')){
				$('.file-input').parent().addClass('view_icon_show');
			}else{
				$('.file-input').parent().removeClass('view_icon_show');
			}
		}); 
		$(".input-group-btn").on("click", function(){
			$(this).parent().parent().parent().removeClass('view_icon_show');
		});
		$(".view-btn-upload").on("click", function(){
			$(this).siblings(".file-input").find(".file-preview").css("display","block");
		});	
		$(".fileinput-remove").on("click", function(){
			$(this).parent().parent().parent().addClass('view_icon_show');
			$(this).parent(".file-preview").css("display","none");
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
                d['column_filter[agency_id]'] 			= $("input[name='agency_id']").val()
                d['column_filter[agency_name]'] 		= $("input[name='agency_name']").val()
                d['column_filter[full_name]']   		= $("input[name='full_name']").val()
                d['column_filter[email]']       		= $("input[name='email']").val()
                d['column_filter[mobile_number]']       = $("input[name='mobile_number']").val()
            }
        },
        columns: [          

            {data : 'sr_no',"orderable":false,"searchable":false,name:'sr_no'},

            {data : 'agent_id',"orderable":false,"searchable":true,name:'agent_id'},

            {data : 'agency_name',"orderable":false,"searchable":true,name:'agency_name'},

            {data : 'full_name',"orderable":true,"searchable":true,name:'full_name'},

            {data : 'email',"orderable":true,"searchable":true,name:'email'},

            {data : 'mobile_number',"orderable":false,"searchable":true,name:'mobile_number'},
            {data : 'status',"orderable":false,"searchable":true,name:'status'},
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

		$('.txtOnly').keydown(function(e) {
			//alert(e.keyCode);
		    if ( e.ctrlKey || e.altKey) {
		      e.preventDefault();
		    } else {
		      var key = e.keyCode;

		      if (!((key == 8) || (e.keyCode == 9) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
		        e.preventDefault();
		      }
		    }
		  });
		$("#mobile_number_one").intlTelInput({
			allowDropdown:true,
			initialCountry:"{{ $arr_data['country_code_flag'] ?? 'sa' }}",
			separateDialCode :true,
			hiddenInput :"code",
			// setCountry: ["sa"],
			preferredCountries: ["sa","us" ],
		});
		$("#mobile_number_one").on('change',function(){
			var intlNumber = $("#mobile_number_one").intlTelInput("getSelectedCountryData");
			// console.log(intlNumber.iso2);
			$("#country_id_one").val("+"+intlNumber.dialCode);
			$("#country_id_one_flag").val(intlNumber.iso2);
		})
		$(".iti__selected-flag").on('click',function(){
			var intlNumber = $("#mobile_number_one").intlTelInput("getSelectedCountryData");
			// alert(intlNumber);
			$("#country_id_one").val("+"+intlNumber.dialCode);
			$("#country_id_one_flag").val(intlNumber.iso2);
			$("#mobile_number_one").val("");
			var intlNumber = $("#mobile_number_two").intlTelInput("getSelectedCountryData");
			$("#country_id_two").val("+"+intlNumber.dialCode);
			$("#country_id_two_flag").val(intlNumber.iso2);
			$("#mobile_number_two").val("");
		})
		$("#mobile_number_two").intlTelInput({
			allowDropdown:true,
			initialCountry:"{{ $arr_data['country_code_flag'] ?? 'sa' }}",
			separateDialCode :true,
			hiddenInput :"code",
			// setCountry: ["sa"],
			preferredCountries: ["sa","us" ],
		});
		$("#mobile_number_two").on('change',function(){
			var intlNumber = $("#mobile_number_two").intlTelInput("getSelectedCountryData");
			console.log(intlNumber.iso2);
			$("#country_id_two").val("+"+intlNumber.dialCode);
			$("#country_id_two_flag").val(intlNumber.iso2);
		})
	$("#add_agent").validate();
	$('body').on('click','#open_add_agent_modal',function(){
		 $.ajax({
            url : '{{ url('/') }}/admin/agent/get_countries',
            type : "GET",
            dataType: 'JSON',
            success:function(resp){
                if(resp.status=='success'){
					$("#modal_form_vertical").modal('show');
                    $('.country_id').html(resp.data);
                }else if(resp.status=='error'){
                    $("#modal_form_vertical").modal('hide');
                    $('.country_id').html(resp.data);
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
            	console.log(resp.email);
                if(resp.status=='success'){
                	//alert(window.location.origin+"/uploads/user/profile_image/"+resp.data.profile_image);
                	var url = "{{ url('/') }}"
                	var img = url+"/uploads/users/profile_image/"+resp.data.profile_image
					$("#edit_modal_form_vertical").modal('show');
                    $('#enc_id').val(btoa(resp.data.id));
                    $('#edit_role').val(resp.data.role);
                    $('#edit_email').val(resp.data.email);
                    $('#edit_full_name').val(resp.data.full_name);
                    $('#edit_mobile_number').val(resp.data.mobile_number);
                    $("#append_img").attr("src", img);
                    if(resp.data.status == '1'){
                    	$('#user_status').html('Active');
                    }else{
                    	$('#user_status').html("Blocked");
                    }
                }else if(resp.status=='error'){
                    $("#edit_modal_form_vertical").modal('hide');
                }
            }
        })	
	});
	$('body').on('click','#show_reset_password',function(){
		$('.reset_password').show();
	});
	$('body').on('change','#country',function(){
		var id = btoa($(this).val());
		 $.ajax({
            url : '{{ url('/') }}/admin/agent/get_cities/'+id,
            type : "GET",
            dataType: 'JSON',
            success:function(resp){
                if(resp.status=='success'){
                    $('#city').html(resp.data);
                }else if(resp.status=='error'){
                    $('#city').html(resp.data);
                }
            }
        })	
	});

	$('body').on('change','#mobile_number_one',function(){
		var id = $(this).val();
		 $.ajax({
            url : '{{ url('/') }}/admin/agent/check_duplicate_number/'+id,
            type : "GET",
            dataType: 'JSON',
            success:function(resp){
                if(resp.status=='success'){
                    $('#mobile_number_one').val(id);
                }else if(resp.status=='error'){
                    $('#mobile_number_one').val('');
                     $('#mobile_number_one_error').html(resp.data); 
                }
            }
        })	
	});
	
	function open_add_agent_modal(){
	
    	//$("#open_add_agent_modal").trigger('click');
    	$.ajax({
                url : '{{ url('/') }}/admin/agent/get_countries',
                type : "GET",
                dataType: 'JSON',
                success:function(resp){
                    if(resp.status=='success'){
    					$("#modal_form_vertical").modal('show');
                        $('.country_id').html(resp.data);
                    }else if(resp.status=='error'){
                        $("#modal_form_vertical").modal('hide');
                        $('.country_id').html(resp.data);
                    }
                }
            })	
    }
});
</script>
<!-- Mirrored from demo.interface.club/limitless/layout_1/LTR/default/datatable_api.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 05:50:56 GMT -->
</html>