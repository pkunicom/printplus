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
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/charts/c3/c3_bars_pies.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/charts/c3/c3_axis.js"></script>
	<!-- /theme JS files -->

</head>

<body>

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
<!--
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Dashboard</h4>
						</div>

						<div class="heading-elements">
							<div class="heading-btn-group">
								<a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
								<a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
								<a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
							</div>
						</div>
					</div>
-->
					
					<!-- Page breadcrumb -->
					@include('agent.layout.breadcrumb')	
					
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					<!-- Main charts -->
					<div class="row">
						
						<div class="col-lg-2">
							<div class="panel total-count-block dash-box-lectures">
								<!-- <div class="panel-body">
									<div class="dash-box-head">Total <br>Orders</div>
									<h6 class="no-margin">Total Orders</h6>
									<div class="text-muted text-size-small">101,123</div>
									<div class="clearfix"></div>
								</div> -->
								<div class="panel-body">
									<div class="dash-box-head">Total <br>Orders</div>
									<h6 class="no-margin">101,123</h6>
									<div class="clearfix"></div>
								</div>
								<div id="server-load"></div>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="panel total-count-block dash-box-questions">
								<div class="panel-body">
									<div class="dash-box-head">Today <br> Orders</div>
									<h6 class="no-margin">1,123</h6>
									<div class="clearfix"></div>
								</div>
								<div id="server-load"></div>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="panel total-count-block dash-box-news-feeds">
								<div class="panel-body">
									<div class="dash-box-head">Pending <br> Orders</div>
									<h6 class="no-margin">1233</h6>
									<div class="clearfix"></div>
								</div>
								<div id="server-load"></div>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="panel total-count-block dash-box-notification">
								<div class="panel-body">
									<div class="dash-box-head">In-Progress <br>Orders</div>
									<h6 class="no-margin">101,123</h6>
									<div class="clearfix"></div>
								</div>
								<div id="server-load"></div>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="panel total-count-block">
								<div class="panel-body">
									<div class="dash-box-head">Completed <br>Orders</div>
									<h6 class="no-margin">83</h6>
									<div class="clearfix"></div>
								</div>
								<div id="server-load"></div>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="panel total-count-block dash-box-lecture">
								<div class="panel-body">
									<div class="dash-box-head">Re-Order  <br>Orders</div>
									<h6 class="no-margin">101,123</h6>
									<div class="clearfix"></div>
								</div>
								<div id="server-load"></div>
							</div>
						</div>

						<!-- Traffic sources -->
						<!--Below section is Commented by webwing -->
						{{--<!-- <div class="col-lg-7">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Traffic sources</h6>
									<div class="heading-elements">
										<form class="heading-form" action="#">
											<div class="form-group">
												<label class="checkbox-inline checkbox-switchery checkbox-right switchery-xs">
													<input type="checkbox" class="switch" checked="checked">
													Live update:
												</label>
											</div>
										</form>
									</div>
								</div>

								<div class="container-fluid">
									<div class="row">
										<div class="col-lg-4">
											<ul class="list-inline text-center">
												<li>
													<a href="#" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-plus3"></i></a>
												</li>
												<li class="text-left">
													<div class="text-semibold">New visitors</div>
													<div class="text-muted">2,349 avg</div>
												</li>
											</ul>

											<div class="col-lg-10 col-lg-offset-1">
												<div class="content-group" id="new-visitors"></div>
											</div>
										</div>

										<div class="col-lg-4">
											<ul class="list-inline text-center">
												<li>
													<a href="#" class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-watch2"></i></a>
												</li>
												<li class="text-left">
													<div class="text-semibold">New sessions</div>
													<div class="text-muted">08:20 avg</div>
												</li>
											</ul>

											<div class="col-lg-10 col-lg-offset-1">
												<div class="content-group" id="new-sessions"></div>
											</div>
										</div>

										<div class="col-lg-4">
											<ul class="list-inline text-center">
												<li>
													<a href="#" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-people"></i></a>
												</li>
												<li class="text-left">
													<div class="text-semibold">Total online</div>
													<div class="text-muted"><span class="status-mark border-success position-left"></span> 5,378 avg</div>
												</li>
											</ul>

											<div class="col-lg-10 col-lg-offset-1">
												<div class="content-group" id="total-online"></div>
											</div>
										</div>
									</div>
								</div>

								<div class="position-relative" id="traffic-sources"></div>
							</div>
						</div> -->
						<!-- /traffic sources -->

						<!-- Sales stats -->
						<!-- Commented by webwing -->
						<!-- <div class="col-lg-5">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Sales statistics</h6>
									<div class="heading-elements">
										<form class="heading-form" action="#">
											<div class="form-group">
												<select class="change-date select-sm" id="select_date">
													<optgroup label="<i class='icon-watch pull-right'></i> Time period">
														<option value="val1">June, 29 - July, 5</option>
														<option value="val2">June, 22 - June 28</option>
														<option value="val3" selected="selected">June, 15 - June, 21</option>
														<option value="val4">June, 8 - June, 14</option>
													</optgroup>
												</select>
											</div>
										</form>
				                	</div>
								</div>

								<div class="container-fluid">
									<div class="row text-center">
										<div class="col-md-4">
											<div class="content-group">
												<h5 class="text-semibold no-margin"><i class="icon-calendar5 position-left text-slate"></i> 5,689</h5>
												<span class="text-muted text-size-small">orders weekly</span>
											</div>
										</div>

										<div class="col-md-4">
											<div class="content-group">
												<h5 class="text-semibold no-margin"><i class="icon-calendar52 position-left text-slate"></i> 32,568</h5>
												<span class="text-muted text-size-small">orders monthly</span>
											</div>
										</div>

										<div class="col-md-4">
											<div class="content-group">
												<h5 class="text-semibold no-margin"><i class="icon-cash3 position-left text-slate"></i> $23,464</h5>
												<span class="text-muted text-size-small">average revenue</span>
											</div>
										</div>
									</div>
								</div>

								<div class="content-group-sm" id="app_sales"></div>
								<div id="monthly-sales-stats"></div>
							</div>
						</div> -->
						<!-- /sales stats --> --}}
					</div>
					<!-- /main charts -->

					<div class="row">
						<div class="col-lg-4">
							<div class="panel panel-flat panel-graph">
								<div class="panel-heading">
									<h6 class="panel-title text-semibold">Top 5 product category</h6>
								</div>

								<div class="panel-body">
									<div class="chart-container text-center">
										<div class="display-inline-block" id="c3-axis-tick-rotation"></div>
									</div>
								</div>
							</div>
						</div>
<!-- 
						<div class="col-lg-4">
							<div class="panel panel-flat panel-graph">
								<div class="panel-heading">
									<h6 class="panel-title text-semibold">Customer Types</h6>
									
								</div>

								<div class="panel-body">
									<div class="chart-container customer-types-pie-chart">
										<div class="chart" id="c3-pie-chart"></div>
									</div>
								</div>
							</div>
						</div> -->

						<div class="col-lg-4">
								<!-- Axis tick culling -->
							<div class="panel panel-flat panel-graph">
								<div class="panel-heading">
									<h6 class="panel-title text-semibold">Evaluation</h6>
								</div>

								<div class="panel-body">
									<div class="chart-container">
										<div class="chart" id="c3-axis-tick-rotation2"></div>
									</div>
								</div>
							</div>
							<!-- /axis tick culling -->
						</div>					
						<div class="col-lg-4">
							<div class="panel panel-flat panel-graph">
								<div class="panel-heading">
									<h6 class="panel-title text-semibold">This Month Orders</h6>
								</div>

								<div class="panel-body">
									<div class="chart-container text-center">
										<div class="display-inline-block" id="c3-axis-tick-culling"></div>
									</div>
								</div>
							</div>
						</div>
						{{--
<!-- 
						<div class="col-lg-4">
							<div class="panel panel-flat panel-graph">
								<div class="panel-heading">
								    <div class="right-now-bx">
									<h6>Right Now</h6>
                                        <h2>5</h2>
									<p>active users on site</p>
									<div class="mobile-right-bx">
									    <h3>Mobile</h3>
									    <div class="mobile-line"></div>
									</div>									    
									</div>									
								</div>
								<div class="panel-body">
									<div class="chart-container">
										<div class="chart" id=""></div>
									</div>
								</div>
							</div>
						</div> -->
							<!-- Axis tick culling -->
			<!-- 			<div class="col-lg-4">
							<div class="panel panel-flat panel-graph">
								<div class="panel-heading">
									<h6 class="panel-title text-semibold">Top channels</h6>
								</div>

								<div class="panel-body">
									<div class="chart-container customer-types-pie-chart">
										<div class="chart" id="c3-pie-chart2"></div>
									</div>
								</div>
							</div>
						</div> -->
							<!-- /axis tick culling -->
					</div>
					<!-- Dashboard content -->
					<!-- <div class="row">
						<div class="col-lg-8"> -->

							<!-- Marketing campaigns -->
							<!-- Commented by webwing -->
							<!-- <div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Marketing campaigns</h6>
									<div class="heading-elements">
										<span class="label bg-success heading-text">28 active</span>
										<ul class="icons-list">
					                		<li class="dropdown">
					                			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i> <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#"><i class="icon-sync"></i> Update data</a></li>
													<li><a href="#"><i class="icon-list-unordered"></i> Detailed log</a></li>
													<li><a href="#"><i class="icon-pie5"></i> Statistics</a></li>
													<li class="divider"></li>
													<li><a href="#"><i class="icon-cross3"></i> Clear list</a></li>
												</ul>
					                		</li>
					                	</ul>
				                	</div>
								</div>

								<div class="table-responsive">
									<table class="table table-lg text-nowrap">
										<tbody>
											<tr>
												<td class="col-md-5">
													<div class="media-left">
														<div id="campaigns-donut"></div>
													</div>

													<div class="media-left">
														<h5 class="text-semibold no-margin">38,289 <small class="text-success text-size-base"><i class="icon-arrow-up12"></i> (+16.2%)</small></h5>
														<ul class="list-inline list-inline-condensed no-margin">
															<li>
																<span class="status-mark border-success"></span>
															</li>
															<li>
																<span class="text-muted">May 12, 12:30 am</span>
															</li>
														</ul>
													</div>
												</td>

												<td class="col-md-5">
													<div class="media-left">
														<div id="campaign-status-pie"></div>
													</div>

													<div class="media-left">
														<h5 class="text-semibold no-margin">2,458 <small class="text-danger text-size-base"><i class="icon-arrow-down12"></i> (- 4.9%)</small></h5>
														<ul class="list-inline list-inline-condensed no-margin">
															<li>
																<span class="status-mark border-danger"></span>
															</li>
															<li>
																<span class="text-muted">Jun 4, 4:00 am</span>
															</li>
														</ul>
													</div>
												</td>

												<td class="text-right col-md-2">
													<a href="#" class="btn bg-indigo-300"><i class="icon-statistics position-left"></i> View report</a>
												</td>
											</tr>
										</tbody>
									</table>	
								</div>

								<div class="table-responsive">
									<table class="table text-nowrap">
										<thead>
											<tr>
												<th>Campaign</th>
												<th class="col-md-2">Client</th>
												<th class="col-md-2">Changes</th>
												<th class="col-md-2">Budget</th>
												<th class="col-md-2">Status</th>
												<th class="text-center" style="width: 20px;"><i class="icon-arrow-down12"></i></th>
											</tr>
										</thead>
										<tbody>
											<tr class="active border-double">
												<td colspan="5">Today</td>
												<td class="text-right">
													<span class="progress-meter" id="today-progress" data-progress="30"></span>
												</td>
											</tr>
											<tr>
												<td>
													<div class="media-left media-middle">
														<a href="#"><img src="{{ asset('assets/admin') }}/assets/images/brands/facebook.png" class="img-circle img-xs" alt=""></a>
													</div>
													<div class="media-left">
														<div class=""><a href="#" class="text-default text-semibold">Facebook</a></div>
														<div class="text-muted text-size-small">
															<span class="status-mark border-blue position-left"></span>
															02:00 - 03:00
														</div>
													</div>
												</td>
												<td><span class="text-muted">Mintlime</span></td>
												<td><span class="text-success-600"><i class="icon-stats-growth2 position-left"></i> 2.43%</span></td>
												<td><h6 class="text-semibold">$5,489</h6></td>
												<td><span class="label bg-blue">Active</span></td>
												<td class="text-center">
													<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="#"><i class="icon-file-stats"></i> View statement</a></li>
																<li><a href="#"><i class="icon-file-text2"></i> Edit campaign</a></li>
																<li><a href="#"><i class="icon-file-locked"></i> Disable campaign</a></li>
																<li class="divider"></li>
																<li><a href="#"><i class="icon-gear"></i> Settings</a></li>
															</ul>
														</li>
													</ul>
												</td>
											</tr>
											<tr>
												<td>
													<div class="media-left media-middle">
														<a href="#"><img src="{{ asset('assets/admin') }}/assets/images/brands/youtube.png" class="img-circle img-xs" alt=""></a>
													</div>
													<div class="media-left">
														<div class=""><a href="#" class="text-default text-semibold">Youtube videos</a></div>
														<div class="text-muted text-size-small">
															<span class="status-mark border-danger position-left"></span>
															13:00 - 14:00
														</div>
													</div>
												</td>
												<td><span class="text-muted">CDsoft</span></td>
												<td><span class="text-success-600"><i class="icon-stats-growth2 position-left"></i> 3.12%</span></td>
												<td><h6 class="text-semibold">$2,592</h6></td>
												<td><span class="label bg-danger">Closed</span></td>
												<td class="text-center">
													<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="#"><i class="icon-file-stats"></i> View statement</a></li>
																<li><a href="#"><i class="icon-file-text2"></i> Edit campaign</a></li>
																<li><a href="#"><i class="icon-file-locked"></i> Disable campaign</a></li>
																<li class="divider"></li>
																<li><a href="#"><i class="icon-gear"></i> Settings</a></li>
															</ul>
														</li>
													</ul>
												</td>
											</tr>
											<tr>
												<td>
													<div class="media-left media-middle">
														<a href="#"><img src="{{ asset('assets/admin') }}/assets/images/brands/spotify.png" class="img-circle img-xs" alt=""></a>
													</div>
													<div class="media-left">
														<div class=""><a href="#" class="text-default text-semibold">Spotify ads</a></div>
														<div class="text-muted text-size-small">
															<span class="status-mark border-grey-400 position-left"></span>
															10:00 - 11:00
														</div>
													</div>
												</td>
												<td><span class="text-muted">Diligence</span></td>
												<td><span class="text-danger"><i class="icon-stats-decline2 position-left"></i> - 8.02%</span></td>
												<td><h6 class="text-semibold">$1,268</h6></td>
												<td><span class="label bg-grey-400">Hold</span></td>
												<td class="text-center">
													<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="#"><i class="icon-file-stats"></i> View statement</a></li>
																<li><a href="#"><i class="icon-file-text2"></i> Edit campaign</a></li>
																<li><a href="#"><i class="icon-file-locked"></i> Disable campaign</a></li>
																<li class="divider"></li>
																<li><a href="#"><i class="icon-gear"></i> Settings</a></li>
															</ul>
														</li>
													</ul>
												</td>
											</tr>
											<tr>
												<td>
													<div class="media-left media-middle">
														<a href="#"><img src="{{ asset('assets/admin') }}/assets/images/brands/twitter.png" class="img-circle img-xs" alt=""></a>
													</div>
													<div class="media-left">
														<div class=""><a href="#" class="text-default text-semibold">Twitter ads</a></div>
														<div class="text-muted text-size-small">
															<span class="status-mark border-grey-400 position-left"></span>
															04:00 - 05:00
														</div>
													</div>
												</td>
												<td><span class="text-muted">Deluxe</span></td>
												<td><span class="text-success-600"><i class="icon-stats-growth2 position-left"></i> 2.78%</span></td>
												<td><h6 class="text-semibold">$7,467</h6></td>
												<td><span class="label bg-grey-400">Hold</span></td>
												<td class="text-center">
													<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="#"><i class="icon-file-stats"></i> View statement</a></li>
																<li><a href="#"><i class="icon-file-text2"></i> Edit campaign</a></li>
																<li><a href="#"><i class="icon-file-locked"></i> Disable campaign</a></li>
																<li class="divider"></li>
																<li><a href="#"><i class="icon-gear"></i> Settings</a></li>
															</ul>
														</li>
													</ul>
												</td>
											</tr>

											<tr class="active border-double">
												<td colspan="5">Yesterday</td>
												<td class="text-right">
													<span class="progress-meter" id="yesterday-progress" data-progress="65"></span>
												</td>
											</tr>
											<tr>
												<td>
													<div class="media-left media-middle">
														<a href="#"><img src="{{ asset('assets/admin') }}/assets/images/brands/bing.png" class="img-circle img-xs" alt=""></a>
													</div>
													<div class="media-left">
														<div class=""><a href="#" class="text-default text-semibold">Bing campaign</a></div>
														<div class="text-muted text-size-small">
															<span class="status-mark border-success position-left"></span>
															15:00 - 16:00
														</div>
													</div>
												</td>
												<td><span class="text-muted">Metrics</span></td>
												<td><span class="text-danger"><i class="icon-stats-decline2 position-left"></i> - 5.78%</span></td>
												<td><h6 class="text-semibold">$970</h6></td>
												<td><span class="label bg-success-400">Pending</span></td>
												<td class="text-center">
													<ul class="icons-list">
														<li class="dropup">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="#"><i class="icon-file-stats"></i> View statement</a></li>
																<li><a href="#"><i class="icon-file-text2"></i> Edit campaign</a></li>
																<li><a href="#"><i class="icon-file-locked"></i> Disable campaign</a></li>
																<li class="divider"></li>
																<li><a href="#"><i class="icon-gear"></i> Settings</a></li>
															</ul>
														</li>
													</ul>
												</td>
											</tr>
											<tr>
												<td>
													<div class="media-left media-middle">
														<a href="#"><img src="{{ asset('assets/admin') }}/assets/images/brands/amazon.png" class="img-circle img-xs" alt=""></a>
													</div>
													<div class="media-left">
														<div class=""><a href="#" class="text-default text-semibold">Amazon ads</a></div>
														<div class="text-muted text-size-small">
															<span class="status-mark border-danger position-left"></span>
															18:00 - 19:00
														</div>
													</div>
												</td>
												<td><span class="text-muted">Blueish</span></td>
												<td><span class="text-success-600"><i class="icon-stats-growth2 position-left"></i> 6.79%</span></td>
												<td><h6 class="text-semibold">$1,540</h6></td>
												<td><span class="label bg-blue">Active</span></td>
												<td class="text-center">
													<ul class="icons-list">
														<li class="dropup">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="#"><i class="icon-file-stats"></i> View statement</a></li>
																<li><a href="#"><i class="icon-file-text2"></i> Edit campaign</a></li>
																<li><a href="#"><i class="icon-file-locked"></i> Disable campaign</a></li>
																<li class="divider"></li>
																<li><a href="#"><i class="icon-gear"></i> Settings</a></li>
															</ul>
														</li>
													</ul>
												</td>
											</tr>
											<tr>
												<td>
													<div class="media-left media-middle">
														<a href="#"><img src="{{ asset('assets/admin') }}/assets/images/brands/dribbble.png" class="img-circle img-xs" alt=""></a>
													</div>
													<div class="media-left">
														<div class=""><a href="#" class="text-default text-semibold">Dribbble ads</a></div>
														<div class="text-muted text-size-small">
															<span class="status-mark border-blue position-left"></span>
															20:00 - 21:00
														</div>
													</div>
												</td>
												<td><span class="text-muted">Teamable</span></td>
												<td><span class="text-danger"><i class="icon-stats-decline2 position-left"></i> 9.83%</span></td>
												<td><h6 class="text-semibold">$8,350</h6></td>
												<td><span class="label bg-danger">Closed</span></td>
												<td class="text-center">
													<ul class="icons-list">
														<li class="dropup">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="#"><i class="icon-file-stats"></i> View statement</a></li>
																<li><a href="#"><i class="icon-file-text2"></i> Edit campaign</a></li>
																<li><a href="#"><i class="icon-file-locked"></i> Disable campaign</a></li>
																<li class="divider"></li>
																<li><a href="#"><i class="icon-gear"></i> Settings</a></li>
															</ul>
														</li>
													</ul>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div> -->
							<!-- /marketing campaigns -->


							<!-- Quick stats boxes -->
						<!-- 	<div class="row">
								<div class="col-lg-4">

									<div class="panel bg-teal-400">
										<div class="panel-body">
											<div class="heading-elements">
												<span class="heading-text badge bg-teal-800">+53,6%</span>
											</div>

											<h3 class="no-margin">3,450</h3>
											Members online
											<div class="text-muted text-size-small">489 avg</div>
										</div>

										<div class="container-fluid">
											<div id="members-online"></div>
										</div>
									</div>

								</div>

								<div class="col-lg-4">

									<div class="panel bg-pink-400">
										<div class="panel-body">
											<div class="heading-elements">
												<ul class="icons-list">
							                		<li class="dropdown">
							                			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog3"></i> <span class="caret"></span></a>
														<ul class="dropdown-menu dropdown-menu-right">
															<li><a href="#"><i class="icon-sync"></i> Update data</a></li>
															<li><a href="#"><i class="icon-list-unordered"></i> Detailed log</a></li>
															<li><a href="#"><i class="icon-pie5"></i> Statistics</a></li>
															<li><a href="#"><i class="icon-cross3"></i> Clear list</a></li>
														</ul>
							                		</li>
							                	</ul>
											</div>

											<h3 class="no-margin">49.4%</h3>
											Current server load
											<div class="text-muted text-size-small">34.6% avg</div>
										</div>

										<div id="server-load"></div>
									</div>

								</div>

								<div class="col-lg-4">

									<div class="panel bg-blue-400">
										<div class="panel-body">
											<div class="heading-elements">
												<ul class="icons-list">
							                		<li><a data-action="reload"></a></li>
							                	</ul>
						                	</div>

											<h3 class="no-margin">$18,390</h3>
											Today's revenue
											<div class="text-muted text-size-small">$37,578 avg</div>
										</div>

										<div id="today-revenue"></div>
									</div>


								</div>
							</div> -->
							<!-- /quick stats boxes -->


							<!-- Support tickets -->
							<!-- Commented by webwing -->
					<!-- 		<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Support tickets</h6>
									<div class="heading-elements">
										<button type="button" class="btn btn-link daterange-ranges heading-btn text-semibold">
											<i class="icon-calendar3 position-left"></i> <span></span> <b class="caret"></b>
										</button>
				                	</div>
								</div>

								<div class="table-responsive">
									<table class="table table-xlg text-nowrap">
										<tbody>
											<tr>
												<td class="col-md-4">
													<div class="media-left media-middle">
														<div id="tickets-status"></div>
													</div>

													<div class="media-left">
														<h5 class="text-semibold no-margin">14,327 <small class="text-success text-size-base"><i class="icon-arrow-up12"></i> (+2.9%)</small></h5>
														<span class="text-muted"><span class="status-mark border-success position-left"></span> Jun 16, 10:00 am</span>
													</div>
												</td>

												<td class="col-md-3">
													<div class="media-left media-middle">
														<a href="#" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-xs btn-icon"><i class="icon-alarm-add"></i></a>
													</div>

													<div class="media-left">
														<h5 class="text-semibold no-margin">
															1,132 <small class="display-block no-margin">total tickets</small>
														</h5>
													</div>
												</td>

												<td class="col-md-3">
													<div class="media-left media-middle">
														<a href="#" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-xs btn-icon"><i class="icon-spinner11"></i></a>
													</div>

													<div class="media-left">
														<h5 class="text-semibold no-margin">
															06:25:00 <small class="display-block no-margin">response time</small>
														</h5>
													</div>
												</td>

												<td class="text-right col-md-2">
													<a href="#" class="btn bg-teal-400"><i class="icon-statistics position-left"></i> Report</a>
												</td>
											</tr>
										</tbody>
									</table>	
								</div>

								<div class="table-responsive">
									<table class="table text-nowrap">
										<thead>
											<tr>
												<th style="width: 50px">Due</th>
												<th style="width: 300px;">User</th>
												<th>Description</th>
												<th class="text-center" style="width: 20px;"><i class="icon-arrow-down12"></i></th>
											</tr>
										</thead>
										<tbody>
											<tr class="active border-double">
												<td colspan="3">Active tickets</td>
												<td class="text-right">
													<span class="badge bg-blue">24</span>
												</td>
											</tr>

											<tr>
												<td class="text-center">
													<h6 class="no-margin">12 <small class="display-block text-size-small no-margin">hours</small></h6>
												</td>
												<td>
													<div class="media-left media-middle">
														<a href="#" class="btn bg-teal-400 btn-rounded btn-icon btn-xs">
															<span class="letter-icon"></span>
														</a>
													</div>

													<div class="media-body">
														<a href="#" class="display-inline-block text-default text-semibold letter-icon-title">Annabelle Doney</a>
														<div class="text-muted text-size-small"><span class="status-mark border-blue position-left"></span> Active</div>
													</div>
												</td>
												<td>
													<a href="#" class="text-default display-inline-block">
														<span class="text-semibold">[#1183] Workaround for OS X selects printing bug</span>
														<span class="display-block text-muted">Chrome fixed the bug several versions ago, thus rendering this...</span>
													</a>
												</td>
												<td class="text-center">
													<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="#"><i class="icon-undo"></i> Quick reply</a></li>
																<li><a href="#"><i class="icon-history"></i> Full history</a></li>
																<li class="divider"></li>
																<li><a href="#"><i class="icon-checkmark3 text-success"></i> Resolve issue</a></li>
																<li><a href="#"><i class="icon-cross2 text-danger"></i> Close issue</a></li>
															</ul>
														</li>
													</ul>
												</td>
											</tr>

											<tr>
												<td class="text-center">
													<h6 class="no-margin">16 <small class="display-block text-size-small no-margin">hours</small></h6>
												</td>
												<td>
													<div class="media-left media-middle">
														<a href="#"><img src="{{ asset('assets/admin') }}/assets/images/demo/users/face15.jpg" class="img-circle img-xs" alt=""></a>
													</div>

													<div class="media-body">
														<a href="#" class="display-inline-block text-default text-semibold letter-icon-title">Chris Macintyre</a>
														<div class="text-muted text-size-small"><span class="status-mark border-blue position-left"></span> Active</div>
													</div>
												</td>
												<td>
													<a href="#" class="text-default display-inline-block">
														<span class="text-semibold">[#1249] Vertically center carousel controls</span>
														<span class="display-block text-muted">Try any carousel control and reduce the screen width below...</span>
													</a>
												</td>
												<td class="text-center">
													<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="#"><i class="icon-undo"></i> Quick reply</a></li>
																<li><a href="#"><i class="icon-history"></i> Full history</a></li>
																<li class="divider"></li>
																<li><a href="#"><i class="icon-checkmark3 text-success"></i> Resolve issue</a></li>
																<li><a href="#"><i class="icon-cross2 text-danger"></i> Close issue</a></li>
															</ul>
														</li>
													</ul>
												</td>
											</tr>

											<tr>
												<td class="text-center">
													<h6 class="no-margin">20 <small class="display-block text-size-small no-margin">hours</small></h6>
												</td>
												<td>
													<div class="media-left media-middle">
														<a href="#" class="btn bg-blue btn-rounded btn-icon btn-xs">
															<span class="letter-icon"></span>
														</a>
													</div>

													<div class="media-body">
														<a href="#" class="display-inline-block text-default text-semibold letter-icon-title">Robert Hauber</a>
														<div class="text-muted text-size-small"><span class="status-mark border-blue position-left"></span> Active</div>
													</div>
												</td>
												<td>
													<a href="#" class="text-default display-inline-block">
														<span class="text-semibold">[#1254] Inaccurate small pagination height</span>
														<span class="display-block text-muted">The height of pagination elements is not consistent with...</span>
													</a>
												</td>
												<td class="text-center">
													<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="#"><i class="icon-undo"></i> Quick reply</a></li>
																<li><a href="#"><i class="icon-history"></i> Full history</a></li>
																<li class="divider"></li>
																<li><a href="#"><i class="icon-checkmark3 text-success"></i> Resolve issue</a></li>
																<li><a href="#"><i class="icon-cross2 text-danger"></i> Close issue</a></li>
															</ul>
														</li>
													</ul>
												</td>
											</tr>

											<tr>
												<td class="text-center">
													<h6 class="no-margin">40 <small class="display-block text-size-small no-margin">hours</small></h6>
												</td>
												<td>
													<div class="media-left media-middle">
														<a href="#" class="btn bg-warning-400 btn-rounded btn-icon btn-xs">
															<span class="letter-icon"></span>
														</a>
													</div>

													<div class="media-body">
														<a href="#" class="display-inline-block text-default text-semibold letter-icon-title">Dex Sponheim</a>
														<div class="text-muted text-size-small"><span class="status-mark border-blue position-left"></span> Active</div>
													</div>
												</td>
												<td>
													<a href="#" class="text-default display-inline-block">
														<span class="text-semibold">[#1184] Round grid column gutter operations</span>
														<span class="display-block text-muted">Left rounds up, right rounds down. should keep everything...</span>
													</a>
												</td>
												<td class="text-center">
													<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="#"><i class="icon-undo"></i> Quick reply</a></li>
																<li><a href="#"><i class="icon-history"></i> Full history</a></li>
																<li class="divider"></li>
																<li><a href="#"><i class="icon-checkmark3 text-success"></i> Resolve issue</a></li>
																<li><a href="#"><i class="icon-cross2 text-danger"></i> Close issue</a></li>
															</ul>
														</li>
													</ul>
												</td>
											</tr>

											<tr class="active border-double">
												<td colspan="3">Resolved tickets</td>
												<td class="text-right">
													<span class="badge bg-success">42</span>
												</td>
											</tr>

											<tr>
												<td class="text-center">
													<i class="icon-checkmark3 text-success"></i>
												</td>
												<td>
													<div class="media-left media-middle">
														<a href="#" class="btn bg-success-400 btn-rounded btn-icon btn-xs">
															<span class="letter-icon"></span>
														</a>
													</div>

													<div class="media-body">
														<a href="#" class="display-inline-block text-default letter-icon-title">Alan Macedo</a>
														<div class="text-muted text-size-small"><span class="status-mark border-success position-left"></span> Resolved</div>
													</div>
												</td>
												<td>
													<a href="#" class="text-default display-inline-block">
														[#1046] Avoid some unnecessary HTML string
														<span class="display-block text-muted">Rather than building a string of HTML and then parsing it...</span>
													</a>
												</td>
												<td class="text-center">
													<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="#"><i class="icon-undo"></i> Quick reply</a></li>
																<li><a href="#"><i class="icon-history"></i> Full history</a></li>
																<li class="divider"></li>
																<li><a href="#"><i class="icon-plus3 text-blue"></i> Unresolve issue</a></li>
																<li><a href="#"><i class="icon-cross2 text-danger"></i> Close issue</a></li>
															</ul>
														</li>
													</ul>
												</td>
											</tr>

											<tr>
												<td class="text-center">
													<i class="icon-checkmark3 text-success"></i>
												</td>
												<td>
													<div class="media-left media-middle">
														<a href="#" class="btn bg-pink-400 btn-rounded btn-icon btn-xs">
															<span class="letter-icon"></span>
														</a>
													</div>

													<div class="media-body">
														<a href="#" class="display-inline-block text-default letter-icon-title">Brett Castellano</a>
														<div class="text-muted text-size-small"><span class="status-mark border-success position-left"></span> Resolved</div>
													</div>
												</td>
												<td>
													<a href="#" class="text-default display-inline-block">
														[#1038] Update json configuration
														<span class="display-block text-muted">The <code>files</code> property is necessary to override the files property...</span>
													</a>
												</td>
												<td class="text-center">
													<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="#"><i class="icon-undo"></i> Quick reply</a></li>
																<li><a href="#"><i class="icon-history"></i> Full history</a></li>
																<li class="divider"></li>
																<li><a href="#"><i class="icon-plus3 text-blue"></i> Unresolve issue</a></li>
																<li><a href="#"><i class="icon-cross2 text-danger"></i> Close issue</a></li>
															</ul>
														</li>
													</ul>
												</td>
											</tr>

											<tr>
												<td class="text-center">
													<i class="icon-checkmark3 text-success"></i>
												</td>
												<td>
													<div class="media-left media-middle">
														<a href="#"><img src="{{ asset('assets/admin') }}/assets/images/demo/users/face3.jpg" class="img-circle img-xs" alt=""></a>
													</div>

													<div class="media-body">
														<a href="#" class="display-inline-block text-default">Roxanne Forbes</a>
														<div class="text-muted text-size-small"><span class="status-mark border-success position-left"></span> Resolved</div>
													</div>
												</td>
												<td>
													<a href="#" class="text-default display-inline-block">
														[#1034] Tooltip multiple event
														<span class="display-block text-muted">Fix behavior when using tooltips and popovers that are...</span>
													</a>
												</td>
												<td class="text-center">
													<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="#"><i class="icon-undo"></i> Quick reply</a></li>
																<li><a href="#"><i class="icon-history"></i> Full history</a></li>
																<li class="divider"></li>
																<li><a href="#"><i class="icon-plus3 text-blue"></i> Unresolve issue</a></li>
																<li><a href="#"><i class="icon-cross2 text-danger"></i> Close issue</a></li>
															</ul>
														</li>
													</ul>
												</td>
											</tr>

											<tr class="active border-double">
												<td colspan="3">Closed tickets</td>
												<td class="text-right">
													<span class="badge bg-danger">37</span>
												</td>
											</tr>

											<tr>
												<td class="text-center">
													<i class="icon-cross2 text-danger-400"></i>
												</td>
												<td>
													<div class="media-left media-middle">
														<a href="#"><img src="{{ asset('assets/admin') }}/assets/images/demo/users/face8.jpg" class="img-circle img-xs" alt=""></a>
													</div>

													<div class="media-body">
														<a href="#" class="display-inline-block text-default">Mitchell Sitkin</a>
														<div class="text-muted text-size-small"><span class="status-mark border-danger position-left"></span> Closed</div>
													</div>
												</td>
												<td>
													<a href="#" class="text-default display-inline-block">
														[#1040] Account for static form controls in form group
														<span class="display-block text-muted">Resizes control label's font-size and account for the standard...</span>
													</a>
												</td>
												<td class="text-center">
													<ul class="icons-list">
														<li class="dropup">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="#"><i class="icon-undo"></i> Quick reply</a></li>
																<li><a href="#"><i class="icon-history"></i> Full history</a></li>
																<li class="divider"></li>
																<li><a href="#"><i class="icon-reload-alt text-blue"></i> Reopen issue</a></li>
																<li><a href="#"><i class="icon-cross2 text-danger"></i> Close issue</a></li>
															</ul>
														</li>
													</ul>
												</td>
											</tr>

											<tr>
												<td class="text-center">
													<i class="icon-cross2 text-danger"></i>
												</td>
												<td>
													<div class="media-left media-middle">
														<a href="#" class="btn bg-brown-400 btn-rounded btn-icon btn-xs">
															<span class="letter-icon"></span>
														</a>
													</div>

													<div class="media-body">
														<a href="#" class="display-inline-block text-default letter-icon-title">Katleen Jensen</a>
														<div class="text-muted text-size-small"><span class="status-mark border-danger position-left"></span> Closed</div>
													</div>
												</td>
												<td>
													<a href="#" class="text-default display-inline-block">
														[#1038] Proper sizing of form control feedback
														<span class="display-block text-muted">Feedback icon sizing inside a larger/smaller form-group...</span>
													</a>
												</td>
												<td class="text-center">
													<ul class="icons-list">
														<li class="dropup">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="#"><i class="icon-undo"></i> Quick reply</a></li>
																<li><a href="#"><i class="icon-history"></i> Full history</a></li>
																<li class="divider"></li>
																<li><a href="#"><i class="icon-plus3 text-blue"></i> Unresolve issue</a></li>
																<li><a href="#"><i class="icon-cross2 text-danger"></i> Close issue</a></li>
															</ul>
														</li>
													</ul>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div> -->
							<!-- /support tickets -->


							<!-- Latest posts -->
							<!-- Commented by webwing -->
							<!-- <div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Latest posts</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
			                	</div>

								<div class="panel-body">
									<div class="row">
										<div class="col-lg-6">
											<ul class="media-list content-group">
												<li class="media stack-media-on-mobile">
				                					<div class="media-left">
														<div class="thumb">
															<a href="#">
																<img src="{{ asset('assets/admin') }}/assets/images/demo/flat/1.png" class="img-responsive img-rounded media-preview" alt="">
																<span class="zoom-image"><i class="icon-play3"></i></span>
															</a>
														</div>
													</div>

				                					<div class="media-body">
														<h6 class="media-heading"><a href="#">Up unpacked friendly</a></h6>
							                    		<ul class="list-inline list-inline-separate text-muted mb-5">
							                    			<li><i class="icon-book-play position-left"></i> Video tutorials</li>
							                    			<li>14 minutes ago</li>
							                    		</ul>
														The him father parish looked has sooner. Attachment frequently gay terminated son...
													</div>
												</li>

												<li class="media stack-media-on-mobile">
				                					<div class="media-left">
														<div class="thumb">
															<a href="#">
																<img src="{{ asset('assets/admin') }}/assets/images/demo/flat/21.png" class="img-responsive img-rounded media-preview" alt="">
																<span class="zoom-image"><i class="icon-play3"></i></span>
															</a>
														</div>
													</div>

				                					<div class="media-body">
														<h6 class="media-heading"><a href="#">It allowance prevailed</a></h6>
							                    		<ul class="list-inline list-inline-separate text-muted mb-5">
							                    			<li><i class="icon-book-play position-left"></i> Video tutorials</li>
							                    			<li>12 days ago</li>
							                    		</ul>
														Alteration literature to or an sympathize mr imprudence. Of is ferrars subject as enjoyed...
													</div>
												</li>
											</ul>
										</div>

										<div class="col-lg-6">
											<ul class="media-list content-group">
												<li class="media stack-media-on-mobile">
				                					<div class="media-left">
														<div class="thumb">
															<a href="#">
																<img src="{{ asset('assets/admin') }}/assets/images/demo/flat/12.png" class="img-responsive img-rounded media-preview" alt="">
																<span class="zoom-image"><i class="icon-play3"></i></span>
															</a>
														</div>
													</div>

				                					<div class="media-body">
														<h6 class="media-heading"><a href="#">Case read they must</a></h6>
							                    		<ul class="list-inline list-inline-separate text-muted mb-5">
							                    			<li><i class="icon-book-play position-left"></i> Video tutorials</li>
							                    			<li>20 hours ago</li>
							                    		</ul>
														On it differed repeated wandered required in. Then girl neat why yet knew rose spot...
													</div>
												</li>

												<li class="media stack-media-on-mobile">
				                					<div class="media-left">
														<div class="thumb">
															<a href="#">
																<img src="{{ asset('assets/admin') }}/assets/images/demo/flat/15.png" class="img-responsive img-rounded media-preview" alt="">
																<span class="zoom-image"><i class="icon-play3"></i></span>
															</a>
														</div>
													</div>

				                					<div class="media-body">
														<h6 class="media-heading"><a href="#">Too carriage attended</a></h6>
							                    		<ul class="list-inline list-inline-separate text-muted mb-5">
							                    			<li><i class="icon-book-play position-left"></i> FAQ section</li>
							                    			<li>2 days ago</li>
							                    		</ul>
														Marianne or husbands if at stronger ye. Considered is as middletons uncommonly...
													</div>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div> -->
							<!-- /latest posts --> --}}

						</div>
					<!-- </div> -->
					<!-- /dashboard content -->


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

<!-- Mirrored from demo.interface.club/limitless/layout_1/LTR/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 05:43:02 GMT -->
</html>
