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

														<input type="text" data-rule-required="true" name="agency_name" id="agency_name" placeholder="Enter Full Name" class="form-control">

													</div>

												</div>

												<div class="col-sm-6 col-md-6 col-lg-6">

													<div class="form-group">												

														<label>Contact Name <i class="red" >*</i></label>

														<input type="text" data-rule-required="true" name="contact_name" id="contact_name" placeholder="Enter Contact Name" class="form-control">

													</div>

												</div>



												<div class="col-sm-6 col-md-6 col-lg-6">

													<div class="form-group">												

														<label>Contact <i class="red" >*</i></label>

														<input type="text" data-rule-required="true" data-rule-number="true" name="contact_one" id="contact_one"  placeholder="Enter email" class="form-control" maxlength="13">

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

														<select data-rule-required="true" id="city" name="city" class="form-control">	

															<option value="">Select city</option>

														</select>									

													</div>	

												</div>



												<div class="col-sm-6 col-md-6 col-lg-6">	

													<div class="form-group">												

														<label>Mobile <i class="red" >*</i></label>

														<div class="mobile-drop-section-main select_code" >

															<div class="mobile-drop-section-select">

																<select name="country_id_one" data-rule-required="true" id="country_id_one" class="form-control country_id">	

																	<option  value="">Select code</option>

																</select>

															</div>

															<div class="mobile-drop-section-input">

																<input type="text" placeholder="Enter mobile number" id="mobile_number_one" name="mobile_number_one" data-rule-required="true" data-rule-number="true" class="form-control" autocomplete="off" maxlength="13">

															</div>

														</div>

													</div>

												</div>

											

												<div class="col-sm-6 col-md-6 col-lg-6">

													<div class="form-group">												

														<label>Main Address <i class="red" >*</i></label>

														<input type="text" data-rule-required="true" name="address" id="address" placeholder="Enter Your address" class="form-control">

													</div>

												</div>

												<div class="col-sm-6 col-md-6 col-lg-6">

													<div class="form-group">												

														<label>Contact 2 </label>

														<input type="text" name="contact_two" id="contact_two"  placeholder="Enter Contact" class="form-control"  maxlength="13" >

													</div>	

												</div>

												

													

											

												<div class="col-sm-6 col-md-6 col-lg-6">

													<div class="form-group">

														<label >Company CR <i class="red" >*</i></label>

														<div class="uploader">

															<input type="file" class="file-styled" name="company_cr" id="company_cr" data-rule-required="true"><span class="filename" style="user-select: none;">No file selected</span><span class="action btn btn-default" style="user-select: none;">Choose File</span>

														</div>

													</div>

												</div>

												<div class="col-sm-6 col-md-6 col-lg-6">

													<div class="form-group">												

														<label>Email 2</label>

														<input type="text"  data-rule-email="true" name="email_two" id="email_two"  placeholder="Enter email" class="form-control">

													</div>	

												</div>

													



												<div class="col-sm-6 col-md-6 col-lg-6">

													<div class="form-group">

														<label >License <i class="red" >*</i></label>

														<div class="uploader">

															<input type="file" class="file-styled"  name="license" id="license" data-rule-required="true"><span class="filename" style="user-select: none;">No file selected</span><span class="action btn btn-default" style="user-select: none;">Choose File</span>

														</div>

													</div>

												</div>

												

												<div class="col-sm-6 col-md-6 col-lg-6">	

													<div class="form-group">												

														<label>Mobile 2</label>

														<div class="mobile-drop-section-main select_code" >

															<div class="mobile-drop-section-select">

																<select name="country_id_two"  id="country_id_two" class="form-control country_id">	

																	<option  value="">Select code</option>

																</select>

															</div>

															<div class="mobile-drop-section-input">

																<input type="text" placeholder="Enter mobile number" id="mobile_number_two" name="mobile_number_two"  data-rule-number="true" class="form-control" autocomplete="off"  maxlength="13">

															</div>

														</div>

													</div>

												</div>



												<div class="col-sm-6 col-md-6 col-lg-6">

													<div class="form-group">

														<label >VAT Reg <i class="red" >*</i></label>

														<div class="uploader">

															<input type="file" class="file-styled"  name="vat_reg" id="vat_reg" data-rule-required="true"><span class="filename" style="user-select: none;">No file selected</span><span class="action btn btn-default" style="user-select: none;">Choose File</span>

														</div>

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

														<input type="text" data-rule-required="true" name="account_name" id="account_name" placeholder="Enter Account Name" class="form-control">

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

														<input type="text" data-rule-required="true" name="bank_name" id="bank_name" placeholder="Enter Bank Name" class="form-control">

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

									<th>Customer ID

					                	<!-- <input type="text" name="customer_id" placeholder="Search" class="search-block-new-table form-control column_filter"> -->

					                </th>

					                <th>Name

					                	<!-- <input type="text" name="full_name" placeholder="Search" class="search-block-new-table form-control column_filter"> -->

					                </th>

					                <th>Email

					                	<!-- <input type="text" name="email" placeholder="Search" class="search-block-new-table form-control column_filter"> -->

					                </th>

					                <th>Mobile Number

					                	<!-- <input type="text" name="mobile_number" placeholder="Search" class="search-block-new-table form-control column_filter"> -->

					                </th>

					                <th>Group

					                	<!-- <input type="text" name="customer_group" placeholder="Search" class="search-block-new-table form-control column_filter"> -->

				                		<!-- <select class="search-block-new-table column_filter form-control" id="customer_group" name="customer_group">

                                            <option value="">All</option>

                                            <option value="customer">Customer</option>

                                            <option value="business">Business</option>

                                        </select> -->

					                </th>

					                <th>Balance</th>

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

                d['column_filter[customer_id]'] 		= $("input[name='customer_id']").val()

                d['column_filter[full_name]'] 			= $("input[name='full_name']").val()

                d['column_filter[email]']       		= $("input[name='email']").val()

                d['column_filter[mobile_number]']       = $("input[name='mobile_number']").val()

                d['column_filter[customer_group]']      = $("input[name='customer_group']").val()

                // d['column_filter[customer_group]']      = $("select[name='customer_group']").val()

            }

        },

        columns: [

           

            {data : 'sr_no',"orderable":true,"searchable":false,name:'sr_no'},

            {data : 'customer_id',"orderable":false,"searchable":true,name:'customer_id'},

            {data : 'full_name',"orderable":false,"searchable":true,name:'full_name'},

            {data : 'email',"orderable":false,"searchable":true,name:'email'},

            {data : 'mobile_number',"orderable":false,"searchable":true,name:'mobile_number'},

            {data : 'customer_group',"orderable":false,"searchable":true,name:'customer_group'},

            {data : 'balance',"orderable":false,"searchable":true,name:'balance'},

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

});



</script>



<!-- Mirrored from demo.interface.club/limitless/layout_1/LTR/default/datatable_api.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 05:50:56 GMT -->

</html>

