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
				<div class="clearfix"></div>
				<!-- Content area -->
				<div class="content">
					<!-- Individual column searching (text inputs) -->
					@include('admin.layout._operation_status')
					<div class="panel panel-flat">							
						<div class="page-head-section-main">
							<div class="page-head-txt">
								Manage Product <span></span>
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
							<a class="btn btn-primary"  id="open_add_product_modal" href="javascript:void(0)"><i class="icon-plus3"></i> Add Product</a>
						</div>
						<div class="clearfix"></div>
						<div id="modal_form_vertical" class="modal fade addUserModalMain">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header bg-primary">
										<button type="button" class="close close_modal" data-dismiss="modal">&times;</button>
										<h5 class="modal-title">Add Product</h5>
									</div>
									<form action="{{$module_url_path}}/store" id="add_product" method="post" enctype="multipart/form-data" >
										{{csrf_field()}}
										<div class="modal-body">
											<div class="row ">
												<div class="col-sm-6 col-md-6 col-lg-6">
													<div class="form-group">											
														<label>Arabic Name</label>
														<input type="text" data-rule-required="true" name="product_arabic_name" id="product_arabic_name" class="form-control" placeholder="Product Arabic Name">
													</div>
												</div>	
												<div class="col-sm-6 col-md-6 col-lg-6">
													<div class="form-group">												
														<label>English Name</label>
														<input type="text" data-rule-required="true" name="product_english_name" id="product_english_name" class="form-control" placeholder="Product English Name">
													</div>
												</div>	
												<div class="col-sm-6 col-md-6 col-lg-6">
													<div class="form-group">												
														<label>Product Arabic Description</label>
														<textarea type="text" name="product_arabic_description" id="product_arabic_description" class="form-control" placeholder="Product Arabic Description" rows="5" data-rule-required="true"></textarea>
													</div>
												</div>
												<div class="col-sm-6 col-md-6 col-lg-6">
													<div class="form-group">												
														<label>Product English Description</label>
														<textarea type="text" name="product_english_description" id="product_english_description" class="form-control" placeholder="Product English Description" rows="5" data-rule-required="true"></textarea>
													</div>
												</div>											
												<div class="col-sm-6 col-md-6 col-lg-6">
													<div class="form-group">												
														<label>Category</label>
														<select class="form-control" id="category_id" data-rule-required="true" name="category_id" onchange="get_sub_category(this)">
															<option value="">Select Category</option>
															@foreach($arr_category as $key_category => $value_category)
																<option value="{{ $value_category['id'] ?? '' }}">{{ $value_category['english_name'] ?? '' }}</option>
															@endforeach	
														</select>
													</div>
												</div>
												<div class="col-sm-6 col-md-6 col-lg-6" >
													<div class="form-group" id="subcategory_html">												
														<label>Sub-Category</label>
														<select class="form-control" id="sub_category_id" data-rule-required="true" name="sub_category_id">
															<option value="">Select Category</option>														
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-primary close_modal" data-dismiss="modal">Close</button>
											<button  type="submit" id="proceed_add" class="btn btn-primary">Add</button>
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
					                <th>Product ID</th>
					                <th>English Name</th>
									<th>Arabic Name</th>
									<th>Sub-Category</th>
									<th>Status</th>
									<th>Actions</th>
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
			 "bDestroy" : true,
			"processing": true,
			"serverSide": true,
			"searchDelay": 350,
			"autoWidth": false,
			"bFilter": true,
			"bLengthChange": true,
			ajax: {
				url: "{{ $module_url_path}}/load_data",
				data: function(d) {
					d['column_filter[id]']   								= $("input[name='id']").val()
					d['column_filter[product_english_name]']       			= $("input[name='product_english_name']").val()
					d['column_filter[product_arabic_name]']       			= $("input[name='product_arabic_name']").val()
					d['column_filter[status]']      						= $( "select[name='status']" ).val()
				}
			},
			columns: [
			{data : 'sr_no',"orderable":false,"searchable":true,name:'sr_no'},
			{data : 'product_id',"orderable":false,"searchable":true,name:'product_id'},
			{data : 'product_english_name',"orderable":false,"searchable":true,name:'product_english_name'},
			{data : 'product_arabic_name',"orderable":false,"searchable":true,name:'product_arabic_name'},
			{data : 'category_name',"orderable":false,"searchable":true,name:'category_name'},
			{data : 'status',"orderable":false,"searchable":true,name:'status'},
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
			var validator = $("#add_product").validate();
			$('body').on('click','#open_add_product_modal',function(){
				$("#modal_form_vertical").modal('show');	
			});
			$('body').on('click','.close_modal',function(){
				validator.resetForm();
				$('#add_product')[0].reset();
			// window.reload();
			});
		});
	function get_sub_category()
	{
		var category_id             				= $('#category_id').val();
	// alert(category_id);
		var token                   = "{{csrf_token()}}";
		var base_url                = '{{$module_url_path}}/get_sub_category';
		$.ajax({
			url: base_url,
			type: "POST",
			data: {
				_token: token,
				category_id: category_id,
			},
			success:function(html){
				if(html){ 
					// document.getElementById('subcategory_html').innerHTML = html;
					document.getElementById('subcategory_html').innerHTML = html;
				}
			}
		});
	}
</script>
<!-- Mirrored from demo.interface.club/limitless/layout_1/LTR/default/datatable_api.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 05:50:56 GMT -->
</html>