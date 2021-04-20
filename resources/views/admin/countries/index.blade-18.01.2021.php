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



				<!-- Page header -->

				<div class="page-header page-header-default">

					@include('admin.layout.breadcrumb')	

				</div>

				<!-- /page header -->



				<div class="add-user-btn-main">

					<a class="btn btn-primary"  id="open_add_group_modal" href="javascript:void(0)">Add Country</a>

				</div>

				<div class="clearfix"></div>



				<!-- Content area -->

				<div class="content">





					<!-- Individual column searching (text inputs) -->

					@include('admin.layout._operation_status')

					<div class="panel panel-flat">				

											



	



						<div id="add_modal_form_vertical" class="modal fade addUserModalMain">

							<div class="modal-dialog">

								<div class="modal-content">

									<div class="modal-header bg-primary">

										<button type="button" class="close close_modal" data-dismiss="modal">&times;</button>

										<h5 class="modal-title">Add Country</h5>

									</div>

									<form action="{{ $module_url_path }}/add_country" id="add_country" method="post" enctype="multipart/form-data" >

										{{csrf_field()}}

										

										<div class="modal-body">

											

											<div class="row">

												<div class="col-sm-6 col-md-6 col-lg-12">

													<div class="form-group">												

														<label>Arabic Name</label>

														<input type="text" data-rule-required="true" name="add_arabic_name" id="add_arabic_name" class="form-control" >

													</div>

												</div>



												<div class="col-sm-6 col-md-6 col-lg-12">

													<div class="form-group">												

														<label>English Name</label>

														<input type="text" data-rule-required="true" name="add_english_name" id="add_english_name" class="form-control" >

													</div>

												</div>



												<div class="col-sm-6 col-md-6 col-lg-12">

													<div class="form-group">												

														<label>Aramex Country</label>

														<select data-rule-required="true" class="form-control" name="aramex_country_id" id="aramex_country_id" >

															<option value="">Select Aramex Country</option>

															@foreach($arr_data_aramex as $key_aramex => $value_aramex)

																<option value="{{ $value_aramex['id'] ?? '' }}">{{ $value_aramex['name_en'] ?? ''}}</option>

															@endforeach

														</select>

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

										<h5 class="modal-title">Edit Country</h5>

									</div>

									<form action="{{ $module_url_path }}/edit_country" id="edit_country" method="post" enctype="multipart/form-data" >

										{{csrf_field()}}

										<input type="hidden" id="enc_id" name="enc_id">	

										<div class="modal-body">

											<div class="row">

												<div class="col-sm-6 col-md-6 col-lg-12">

													<div class="form-group">												

														<label>Arabic Name</label>

														<input type="text" data-rule-required="true" name="edit_arabic_name" id="edit_arabic_name" class="form-control" >

													</div>

												</div>



												<div class="col-sm-6 col-md-6 col-lg-12">

													<div class="form-group">												

														<label>English Name</label>

														<input type="text" data-rule-required="true" name="edit_english_name" id="edit_english_name" class="form-control" >

													</div>

												</div>



												<div class="col-sm-6 col-md-6 col-lg-12">

													<div class="form-group">												

														<label>Aramex Country</label>

														<select data-rule-required="true"  class="form-control" name="edit_aramex_country_id" id="edit_aramex_country_id" >

														</select>

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

					                <th>Country ID</th>

					                <th>Country English Name</th>

					                <th>Country Arabic Name</th>

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

					<!-- /individual column searching (text inputs) -->





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

					            <tr>

					                <td>Garrett Winters</td>

					                <td>Accountant</td>

					                <td>63</td>

					                <td><a href="#">2011/07/25</a></td>

					                <td><span class="label label-danger">$170,750</span></td>

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

					            <tr>

					                <td>Ashton Cox</td>

					                <td>Junior Technical Author</td>

					                <td>66</td>

					                <td><a href="#">2009/01/12</a></td>

					                <td><span class="label label-default">$86,000</span></td>

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

					            <tr>

					                <td>Cedric Kelly</td>

					                <td>Senior Javascript Developer</td>

					                <td>22</td>

					                <td><a href="#">2012/03/29</a></td>

					                <td><span class="label label-success">$433,060</span></td>

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

					            <tr>

					                <td>Airi Satou</td>

					                <td>Accountant</td>

					                <td>33</td>

					                <td><a href="#">2008/11/28</a></td>

					                <td><span class="label label-danger">$162,700</span></td>

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

					            <tr>

					                <td>Brielle Williamson</td>

					                <td>Integration Specialist</td>

					                <td>61</td>

					                <td><a href="#">2012/12/02</a></td>

					                <td><span class="label label-info">$372,000</span></td>

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

					            <tr>

					                <td>Herrod Chandler</td>

					                <td>Sales Assistant</td>

					                <td>59</td>

					                <td><a href="#">2012/08/06</a></td>

					                <td><span class="label label-danger">$137,500</span></td>

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

					            <tr>

					                <td>Rhona Davidson</td>

					                <td>Integration Specialist</td>

					                <td>55</td>

					                <td><a href="#">2010/10/14</a></td>

					                <td><span class="label label-default">$97,900</span></td>

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

					            <tr>

					                <td>Colleen Hurst</td>

					                <td>Javascript Developer</td>

					                <td>39</td>

					                <td><a href="#">2009/09/15</a></td>

					                <td><span class="label label-success">$405,500</span></td>

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

					            <tr>

					                <td>Sonya Frost</td>

					                <td>Software Engineer</td>

					                <td>23</td>

					                <td><a href="#">2008/12/13</a></td>

					                <td><span class="label label-danger">$103,600</span></td>

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

					            <tr>

					                <td>Jena Gaines</td>

					                <td>Office Manager</td>

					                <td>30</td>

					                <td><a href="#">2008/12/19</a></td>

					                <td><span class="label label-danger">$90,560</span></td>

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

					            <tr>

					                <td>Quinn Flynn</td>

					                <td>Support Lead</td>

					                <td>22</td>

					                <td><a href="#">2013/03/03</a></td>

					                <td><span class="label label-info">$342,000</span></td>

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

					            <tr>

					                <td>Charde Marshall</td>

					                <td>Regional Director</td>

					                <td>36</td>

					                <td><a href="#">2008/10/16</a></td>

					                <td><span class="label label-success">$470,600</span></td>

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

					            <tr>

					                <td>Haley Kennedy</td>

					                <td>Senior Marketing Designer</td>

					                <td>43</td>

					                <td><a href="#">2012/12/18</a></td>

					                <td><span class="label label-danger">$113,500</span></td>

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

					            <tr>

					                <td>Tatyana Fitzpatrick</td>

					                <td>Regional Director</td>

					                <td>19</td>

					                <td><a href="#">2010/03/17</a></td>

					                <td><span class="label label-info">$385,750</span></td>

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

            {data : 'country_id',"orderable":true,"searchable":true,name:'country_id'},

            {data : 'country_english_name',"orderable":true,"searchable":true,name:'country_english_name'},

            {data : 'country_arabic_name',"orderable":false,"searchable":true,name:'country_arabic_name'},

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

	$("#add_country").validate();

	$("#edit_country").validate();



	$('body').on('click','#open_add_group_modal',function(){

        $("#add_modal_form_vertical").modal('show');

    		

    });



    



	$('body').on('click','#open_edit_modal',function(){

        var id = btoa($(this).data("id"));

		$.ajax({

            url : '{{ $module_url_path }}/get_country_data/'+id,

            type : "GET",

            dataType: 'JSON',

            success:function(resp){

                if(resp.status=='success'){

                    $('#enc_id').val(btoa(resp.data.id));

                    $('#edit_english_name').val(resp.data.country_english_name);

                    $('#edit_arabic_name').val(resp.data.country_arabic_name);

                    $('#edit_aramex_country_id').html(resp.aramex_html);

                   

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

