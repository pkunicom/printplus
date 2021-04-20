<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.interface.club/limitless/layout_1/LTR/default/components_tabs.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 05:45:43 GMT -->
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
	<link href="{{ asset('assets/admin') }}/assets/css/extras/animate.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/core/libraries/jquery.validate.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/visualization/d3/d3.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/visualization/c3/c3.min.js"></script>

	<!-- Theme JS files -->	
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/uploaders/fileinput/fileinput.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/core/app.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/charts/c3/c3_bars_pies.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/charts/c3/c3_axis.js"></script>
	<script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/pages/uploader_bootstrap.js"></script>
	<!-- /theme JS files -->
	<style type="text/css">
		.red{
			color:red;
		}
	</style>
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


				<!-- Content area -->
				<div class="content">

					@include('admin.layout._operation_status')
					<!-- Basic tabs title -->
					<!-- <h6 class="content-group text-semibold">
						Basic tabs layout
						<small class="display-block">Default tabs layout options</small>
					</h6> -->
					<!-- /basic tabs title -->


					<!-- Basic tabs -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Basic tabs</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs">
											<li class="active"><a href="#basic-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#basic-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#basic-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#basic-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="basic-tab1">
												Basic tabs example using <code>.nav-tabs</code> class. Also requires base <code>.nav</code> class.
											</div>

											<div class="tab-pane" id="basic-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="basic-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="basic-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Basic justified</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-justified">
											<li class="active"><a href="#basic-justified-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#basic-justified-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#basic-justified-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#basic-justified-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="basic-justified-tab1">
												Easily make tabs equal widths of their parent with <code>.nav-justified</code> class.
											</div>

											<div class="tab-pane" id="basic-justified-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="basic-justified-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="basic-justified-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /basic tabs -->


					<!-- Rounded basic tabs -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Basic rounded</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-component">
											<li class="active"><a href="#basic-rounded-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#basic-rounded-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#basic-rounded-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#basic-rounded-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="basic-rounded-tab1">
												Use <code>.nav-tabs-component</code> class to round corners if the tabs are a separate component.
											</div>

											<div class="tab-pane" id="basic-rounded-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="basic-rounded-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="basic-rounded-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Justified rounded</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-component nav-justified">
											<li class="active"><a href="#basic-rounded-justified-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#basic-rounded-justified-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#basic-rounded-justified-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#basic-rounded-justified-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="basic-rounded-justified-tab1">
												For justified tabs use <code>.nav-justified .nav-tabs-component</code> classes.
											</div>

											<div class="tab-pane" id="basic-rounded-justified-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="basic-rounded-justified-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="basic-rounded-justified-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /rounded basic tabs -->


					<!-- Highlighted tabs -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Highlighted tabs</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-highlight">
											<li class="active"><a href="#highlight-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#highlighted-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#highlighted-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#highlighted-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="highlighted-tab1">
												Highlight top border of the active tab by adding <code>.nav-tabs-highlight</code> class.
											</div>

											<div class="tab-pane" id="highlighted-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="highlighted-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="highlighted-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Highlighted justified</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-highlight nav-justified">
											<li class="active"><a href="#highlighted-justified-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#highlighted-justified-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#highlighted-justified-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#highlighted-justified-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="highlighted-justified-tab1">
												To use in tabs with equal widths add <code>.nav-justified .nav-tabs-highlight</code> classes.
											</div>

											<div class="tab-pane" id="highlighted-justified-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="highlighted-justified-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="highlighted-justified-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /highlighted tabs -->



					<!-- Tabs with top line -->
					<!-- <h6 class="content-group text-semibold">
						Top line tabs
						<small class="display-block">Display only <code>top</code> border in active tab</small>
					</h6>

					<div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Top line tabs</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-top">
											<li class="active"><a href="#top-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#top-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#top-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#top-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="top-tab1">
												Add <code>top</code> border to the active tab with <code>.nav-tabs-top</code> class.
											</div>

											<div class="tab-pane" id="top-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="top-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="top-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Top line divided</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-top top-divided">
											<li class="active"><a href="#top-divided-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#top-divided-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#top-divided-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#top-divided-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="top-divided-tab1">
												Hide bottom border in top line layout by adding <code>.top-divided</code> class.
											</div>

											<div class="tab-pane" id="top-divided-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="top-divided-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="top-divided-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Top line justified</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-top nav-justified">
											<li class="active"><a href="#top-justified-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#top-justified-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#top-justified-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#top-justified-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="top-justified-tab1">
												To use in tabs with equal widths add <code>.nav-justified .nav-tabs-top</code> classes.
											</div>

											<div class="tab-pane" id="top-justified-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="top-justified-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="top-justified-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Top line divided/justified</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-top top-divided nav-justified">
											<li class="active"><a href="#top-justified-divided-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#top-justified-divided-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#top-justified-divided-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#top-justified-divided-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="top-justified-divided-tab1">
												To use in tabs with equal widths add <code>.nav-justified .nav-tabs-top .top-divided</code> classes.
											</div>

											<div class="tab-pane" id="top-justified-divided-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="top-justified-divided-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="top-justified-divided-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /tabs with top line -->



					<!-- Tabs with bottom line -->
					<!-- <h6 class="content-group text-semibold">
						Bottom line tabs
						<small class="display-block">Display only <code>bottom</code> border in active tab</small>
					</h6>

					<div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Bottom line tabs</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-bottom">
											<li class="active"><a href="#bottom-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#bottom-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#bottom-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#bottom-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="bottom-tab1">
												Add <code>bottom</code> border to the active tab with <code>.nav-tabs-bottom</code> class.
											</div>

											<div class="tab-pane" id="bottom-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="bottom-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="bottom-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Bottom line divided</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-bottom bottom-divided">
											<li class="active"><a href="#bottom-divided-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#bottom-divided-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#bottom-divided-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#bottom-divided-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="bottom-divided-tab1">
												Hide bottom border in bottom line layout by adding <code>.bottom-divided</code> class.
											</div>

											<div class="tab-pane" id="bottom-divided-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="bottom-divided-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="bottom-divided-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Bottom line justified</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-bottom nav-justified">
											<li class="active"><a href="#bottom-justified-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#bottom-justified-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#bottom-justified-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#bottom-justified-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="bottom-justified-tab1">
												To use in tabs with equal widths add <code>.nav-justified .nav-tabs-bottom</code> classes.
											</div>

											<div class="tab-pane" id="bottom-justified-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="bottom-justified-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="bottom-justified-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Bottom line divided/justified</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-bottom bottom-divided nav-justified">
											<li class="active"><a href="#bottom-justified-divided-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#bottom-justified-divided-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#bottom-justified-divided-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#bottom-justified-divided-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="bottom-justified-divided-tab1">
												To use in tabs with equal widths add <code>.nav-justified .nav-tabs-bottom .bottom-divided</code> classes.
											</div>

											<div class="tab-pane" id="bottom-justified-divided-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="bottom-justified-divided-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="bottom-justified-divided-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /tabs with bottom line -->



					<!-- Solid tabs title -->
					<!-- <h6 class="content-group text-semibold">
						Solid tabs
						<small class="display-block">Add visual difference to the tabs</small>
					</h6> -->
					<!-- /solid tabs title -->


					<!-- Tabs with solid background -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Solid tabs</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-solid">
											<li class="active"><a href="#solid-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#solid-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#solid-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#solid-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="solid-tab1">
												Add solid background color to the tabs with <code>.nav-tabs-solid</code> class.
											</div>

											<div class="tab-pane" id="solid-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="solid-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="solid-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Solid justified</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-solid nav-justified">
											<li class="active"><a href="#solid-justified-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#solid-justified-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#solid-justified-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#solid-justified-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="solid-justified-tab1">
												To use in tabs with equal widths add <code>.nav-justified .nav-tabs-solid</code> classes.
											</div>

											<div class="tab-pane" id="solid-justified-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="solid-justified-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="solid-justified-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /tabs with solid background -->


					<!-- Rounded solid tabs -->
					<!-- <div class="row"> -->
						<!-- <div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Solid rounded</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-solid nav-tabs-component">
											<li class="active"><a href="#solid-rounded-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#solid-rounded-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#solid-rounded-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#solid-rounded-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="solid-rounded-tab1">
												In solid tabs <code>.nav-tabs-component</code> class rounds tabs container and first tab corners.
											</div>

											<div class="tab-pane" id="solid-rounded-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="solid-rounded-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="solid-rounded-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div> -->

						<!-- <div class="col-md-6"> -->
							<div class="panel panel-flat">
								<!-- <div class="panel-heading">
									<h6 class="panel-title">Rounded justified</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div> -->

								<div class="panel-body">
									<div class="tabbable" id="tabload">
										<ul class="nav nav-tabs nav-tabs-solid nav-justified">
											<li class="active"><a href="#product_information" data-toggle="tab">Product Information</a></li>
											<li><a class="justified-tab2" href="#product_option" data-toggle="tab" id="view_product_option">Product Option</a></li>
											<li><a href="#quantity" data-toggle="tab" id="view_quantity">Quantity</a></li>
											<li><a href="#weight_time_cost" data-toggle="tab" id="view_weight_time_cost">Weight Time & Cost</a></li>
											<li><a href="#installation" data-toggle="tab" id="view_installation">Installation</a></li>											
											<li><a href="#accessories" data-toggle="tab" id="view_accessories">Accessories</a></li>											
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="product_information">
												<form action="{{$module_url_path}}/update_product_info" id="update_product_info" method="post" enctype="multipart/form-data" >
													{{csrf_field()}}
														<div class="row ">
															<input type="hidden" name="enc_id" id="enc_id" value="{{$arr_data['id']}}">
															<div class="col-sm-6 col-md-6 col-lg-6">
																<div class="form-group">												
																	<label>File</label>
																	<input type="file" name="product_images[]" id="product_images" class="form-control" multiple="">
																</div>
															</div>	
															<div class="col-sm-6 col-md-6 col-lg-6">
																<div class="form-group">												
																	<label>English Name</label>
																	<input type="text" data-rule-required="true" name="product_english_name" id="product_english_name" class="form-control" value="{{ $arr_data['product_english_name'] ?? '' }}" placeholder="Product English Name">
																</div>
															</div>	

															<div class="col-sm-6 col-md-6 col-lg-6">
																<div class="form-group">												
																	<label>Arabic Name</label>
																	<input type="text" data-rule-required="true" name="product_arabic_name" id="product_arabic_name" class="form-control" placeholder="Product Arabic Name" value="{{ $arr_data['product_arabic_name'] ?? '' }}">
																</div>
															</div>	

															<div class="col-sm-6 col-md-6 col-lg-6">
																<div class="form-group">												
																	<label>Product English Description</label>
																	<textarea type="text" name="product_english_description" id="product_english_description" class="form-control"  placeholder="Product English Description" rows="5"> {{ $arr_data['product_english_description'] ?? '' }}</textarea>
																</div>
															</div>	

															<div class="col-sm-6 col-md-6 col-lg-6">
																<div class="form-group">												
																	<label>Product Arabic Description</label>
																	<textarea type="text" name="product_arabic_description" id="product_arabic_description" class="form-control" placeholder="Product Arabic Description" rows="5">{{ $arr_data['product_arabic_description'] ?? '' }}</textarea>
																</div>
															</div>

															<div class="col-sm-6 col-md-6 col-lg-6">
																<div class="form-group">												
																	<label>Category</label>
																	<select class="form-control" id="category_id" data-rule-required="true" name="category_id" onchange="get_edit_sub_category(this)">
																		<option value="">Select Category</option>
																		@foreach($arr_category as $key_category => $value_category)
																			<option value="{{ $value_category['id'] ?? '' }}" @if($arr_data['category_id'] == $value_category['id']) selected="selected" @endif>{{ $value_category['english_name'] ?? '' }}</option>
																		@endforeach	
																	</select>
																</div>
															</div>	

															<div class="col-sm-6 col-md-6 col-lg-6">
																<div class="form-group" id="subcategory_html">												
																	<label>Sub-Category</label>
																	<select class="form-control" id="sub_category_id" data-rule-required="true" name="sub_category_id">
																			<option value="">Select Sub-Category</option>	
																			@foreach($arr_sub_category as $key_sub_category => $sub_category)
																				<option value="{{ $sub_category['id'] ?? '' }}" @if($arr_data['subcategory_id'] == $sub_category['id']) selected="selected" @endif>{{ $sub_category['english_name'] ?? '' }}</option>
																			@endforeach														
																	</select>
																	<span class="error" id="error_category_id"> </span>
																</div>
															</div>

															<div class="modal-footer">
																<button type="submit" id="proceed_add" class="btn btn-primary">Update</button>
															</div>
														</div>
												</form>												
											</div>

											<div class="tab-pane" id="product_option">
												<div class="add-user-btn-main">
													<a class="btn btn-primary"  id="open_add_option_modal" href="javascript:void(0)">Add Option</a>
												</div>

												<div id="add_modal_form_vertical_option" class="modal fade addUserModalMain">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header bg-primary">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h5 class="modal-title">Add Product Options</h5>
															</div>
															<form action="{{$module_url_path}}/store_product_option" id="add_product_option" method="post" enctype="multipart/form-data" >
																{{csrf_field()}}
																<div class="modal-body">
																	<input type="hidden" name="product_id" value="{{ $arr_data['id'] ?? '' }}" >
																	<div class="row">
																		<div class="col-sm-6 col-md-6 col-lg-6">
																			<div class="form-group">												
																				<label>Options</label>
																				<select class="form-control" id="add_option" data-rule-required="true" name="add_option" onchange="get_add_sub_option(this)">
																					<option value="">Select Option</option>
    																			{{--	@foreach($arr_option as $key_option => $option)
																						@if(count($arr_product_option)>0)
																							@foreach($arr_product_option as $product_option)
																							
																								@if($option['id']!=$product_option['option_id'])
																								<option value="{{ $option['id'] ?? '' }}">{{ $option['english_name'] ?? '' }}</option>
																								@endif
																							@endforeach
																						@else
																							<option value="{{ $option['id'] ?? '' }}">{{ $option['english_name'] ?? '' }}</option>
																						@endif
																					@endforeach--}}
																					@foreach($arr_option as $key_option => $option)
																					 @if(!in_array($option['id'],$arr_selected_options))
																					    <option value="{{ $option['id'] ?? '' }}">{{ $option['english_name'] ?? '' }}</option>
																					 @endif
																					@endforeach
																				</select>
																			</div>
																		</div>
																	
																		<div class="col-sm-6 col-md-6 col-lg-6">
																			<div class="form-group">												
																				<label>Sub-Options</label>
																				<select class="form-control" id="sub_option_id" data-rule-required="true" name="sub_option_id[]" multiple>
																					<option value="">Select Sub Option</option>
																				</select>
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

												<div id="edit_modal_form_vertical_option" class="modal fade addUserModalMain">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header bg-primary">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h5 class="modal-title">Edit Product Option</h5>
															</div>
															<form action="{{$module_url_path}}/update_product_option" id="edit_product_option" method="post" enctype="multipart/form-data" >
																{{csrf_field()}}
																<input type="hidden" id="product_id" name="product_id" value="{{$arr_data['id'] ?? ''}}">
																<div class="modal-body">
																	<div id="edit_option_enc_id"></div>
																	<div class="row">
																		<div class="col-sm-6 col-md-6 col-lg-6 ">
																			<div class="form-group">
																				<div id="edit_option_html"></div>	
																			</div>
																		</div>
																		<div class="col-sm-6 col-md-6 col-lg-6 ">
																			<div class="form-group">
																				<label>Sub-Option</label>
																				<div id="edit_sub_option_html"></div>	
																			</div>	
																		</div>
																	</div>
																</div>

																<div class="modal-footer">
																	<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
																	<button type="submit" id="proceed_edit_product_option" class="btn btn-primary">Update</button>
																</div>
															</form>
														</div>
													</div>
												</div>	
												<table class="table datatable-column-search-inputs" id="datatable_product_option">
													<thead>
														<tr>
															<th>#</th>
															<th>Option</th>
															<th>Sub-Options</th>
															<th>Actions</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
												</table>
											</div>

											<div class="tab-pane" id="quantity">
												<form action="{{$module_url_path}}/store_quantity" id="add_product_quantity" method="post" enctype="multipart/form-data" >
													{{csrf_field()}}
												<label>Quantity Type</label>										
												<div class="row">												
													<div class="col-md-6">
														<div class="fixed_quantity_section">
															<div class="radio-btns">  
																<div class="radio-btn">
																	<input type="hidden" id="quantity_encid" name="quantity_encid" value="{{ base64_encode($arr_data['id']) ?? '' }}">
																	<input type="radio" @if($arr_data['quantity_type']=='fixed') checked="true" @endif id="fixedone" name="quantity_type" value="fixed">
																	<label style="margin-right: 5px" for="fixedone">Fixed</label>
																	<input type="text" data-rule-required="true" class="form-control validate_fixed" name="fixed_quantity" placeholder="Quantity" style="width: auto;
    display: inline-block;vertical-align: middle;" />
																	<!-- <div class="check"></div> -->
																	<!-- Comment as per client changes on 07-07-2020 -->
																	<!-- <a class="btn btn-primary" id="open_add_fixed_product_quantity_modal" href="javascript:void(0)"><i class="fa fa-plus-circle" aria-hidden="true"></i></a> -->
																</div>																	
															</div>
															<!-- <div class="add-user-btn-main"> -->
															<!-- <label> Fixed </label> Quantity -->
															<!-- <a class="btn btn-primary" id="open_add_fixed_product_quantity_modal" href="javascript:void(0)"><i class="fa fa-plus-circle" aria-hidden="true"></i></a> -->
															<!-- </div> -->

															<div class="fixed-qty-label-section">
																<div class="fixed-qty-label-row">
																<!-- 	<div class="fixed-qty-label-field">
																			{{isset($fixed__quantity['fixed_quantity'])? $fixed__quantity['fixed_quantity'] :'-'}}
																	</div> -->
																	@if(sizeof($arr_fixed_quantity)>0)
																	@foreach($arr_fixed_quantity as $fixed__quantity)
																		<div class="fixed-qty-label-field">
																			{{isset($fixed__quantity['fixed_quantity'])? $fixed__quantity['fixed_quantity'] :'-'}}
																			<a href='{{$module_url_path}}/delete_fixed_quantity/{{base64_encode($fixed__quantity['id']).','.base64_encode($arr_data['id'])}}'  title="delete" onclick="return confirm_action(this,event,'Do you really want to delete this quantity ?')"><i class="fa fa-trash"></i></a>
																		</div>
																	@endforeach
																	@else
																		<div class="fixed-qty-label-field">
																			No Fixed quantity added
																		</div>
																	@endif
																	
																</div>
															</div>

															<!-- <table border = "1" class="table">
																<tbody>
																	@foreach($arr_fixed_quantity as $fixed__quantity)
																		<tr>
																			<td align="center">
																				{{isset($fixed__quantity['fixed_quantity'])? $fixed__quantity['fixed_quantity'] :'-'}}
																			</td>
																			<td align="center">
																			<a href='{{$module_url_path}}/delete_fixed_quantity/{{base64_encode($fixed__quantity['id']).','.base64_encode($arr_data['id'])}}'  title="delete" onclick="return confirm_action(this,event,\'Do you really want to delete this Product ?\')"><i class="fa fa-trash"></i></a>
																			</td> 
																		</tr>
																	@endforeach
																</tbody>
															</table> -->
														</div>
													</div>
													<div class="col-md-6">
														<div class="variable_quantity_section">
															<div class="radio-btns">  
																<div class="radio-btn">
																	<input type="radio" @if($arr_data['quantity_type']=='variable') checked="true" @endif id="variableone" name="quantity_type" value="variable">
																	<label style="margin-right: 5px" for="variableone">Variable</label>
																	<input type="text" class="form-control validate_variable" name="variable_minimum" data-rule-number="true" placeholder="Minimum" style="width: 20%;
	display: inline-block;vertical-align: middle;" />
																	<input type="text" class="form-control validate_variable" name="variable_maximum" data-rule-number="true" placeholder="Maximum" style="width: 20%;
	display: inline-block;vertical-align: middle;" />
																	<input type="text" class="form-control validate_variable" name="variable_discount" data-rule-number="true" placeholder="Discount" style="width: 20%;
    display: inline-block;vertical-align: middle;" />
																	<!-- <div class="check"></div> -->
																	<!-- Commented by webwing on 07-07-2020 -->
																	<!-- <a class="btn btn-primary" id="open_add_fixed_product_quantity_modal" href="javascript:void(0)"><i class="fa fa-plus-circle" aria-hidden="true"></i></a> -->
																</div>																	
															</div>
														</div>

															<!-- <label> Variable </label> Minimum Maximum Discount
															<div class="add-user-btn-main">
																<a class="btn btn-primary" id="open_add_product_vaiable_modal" href="javascript:void(0)"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
															</div> -->
															<table border = "1" class="table min-max-dis-table">
																<thead>
																	<tr>
																		<th>#</th>
																		<th>Minimum</th>
																		<th>Maximum</th>
																		<th>Discount</th>
																		<th>Action</th>
																	</tr>
																</thead>
																<tbody>
																	<!-- {{$i=1}} -->
																	@if(sizeof($arr_variable_quantity) > 0)
																	@foreach($arr_variable_quantity as $variable_quantity)
																		<tr>
																			<td align="center">{{$i}}</td>
																			<td align="center">{{isset($variable_quantity['minimum_quantity'])? $variable_quantity['minimum_quantity'] :'-'}}</td>
																			<td align="center">{{isset($variable_quantity['maximum_quantity'])? $variable_quantity['maximum_quantity'] :'-'}}</td>
																			<td align="center">{{isset($variable_quantity['discount'])? $variable_quantity['discount'] :'-'}}%</td> 
																			<td><a href='{{$module_url_path}}/delete_variable_quantity/{{base64_encode($variable_quantity['id']).','.base64_encode($arr_data['id'])}}'  title="delete" onclick="return confirm_action(this,event,'Do you really want to delete this quantity ?')"><i class="fa fa-trash"></i></a></td>
																		</tr>
																		<!-- {{$i=$i+1}} -->
																	@endforeach
																	@else
																		<tr>
																			<td>-</td>
																			<td>
																				No variable quantity added
																			</td>
																			<td>-</td>
																			<td>-</td>
																			<td>-</td>
																		</tr>
																	@endif
																</tbody>
															</table>
													</div>
												</div>
												<div class="update-btns-section">													
													<button type="submit" class="btn btn-primary">Update</button>
												</div>
											</form>
											</div>
											<div class="tab-pane" id="weight_time_cost">
												<div id="edit_modal_form_product_weight_time_cost" class="modal fade addUserModalMain">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header bg-primary">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h5 class="modal-title">Edit Product Options</h5>
															</div>
															<form action="{{$module_url_path}}/update_product_weight_time_cost" id="update_product_weight_time_cost" method="post" enctype="multipart/form-data" >
																{{csrf_field()}}
																<div class="modal-body">
																	<input type="hidden" name="edit_enc_id" id="edit_enc_id">
																	<input type="hidden" name="product_id" value="{{$arr_data['id']}}">
																	<div class="row">
																		<div class="col-sm-12 col-md-12 col-lg-12">
																			<div class="form-group">												
																				<label>Options-Comb ID</label>
																				<input type="text" class="form-control" id="options_comb_id" data-rule-required="true"  readonly="">
																			</div>
																		</div>
																		<div class="col-sm-12 col-md-12 col-lg-12">
																			<div class="form-group">												
																				<label>Description</label>
																				<input type="text" data-rule-required="true" name="edit_description" id="edit_description" readonly="" class="form-control">
																			</div>
																		</div>
																		<div class="col-sm-12 col-md-12 col-lg-12">
																			<div class="form-group">												
																				<label>Quantity</label>
																				<input name="edit_quantity" id="edit_quantity" readonly="" class="form-control">
																			</div>
																		</div>
																		<div class="col-sm-12 col-md-12 col-lg-12">
																			<div class="form-group">												
																				<label>Weight</label>
																				<input type="text" data-rule-number="true" data-rule-required="true" name="weight" id="weight" class="form-control">
																			</div>
																		</div>
																		<div class="col-sm-12 col-md-12 col-lg-12">
																			<div class="form-group">												
																				<label>Lead Time</label>
																				<input  type="text" data-rule-required="true" name="lead_time" id="lead_time" class="form-control">
																			</div>
																		</div>
																		<div class="col-sm-12 col-md-12 col-lg-12">
																			<div class="form-group">												
																				<label>Cost</label>
																				<input  type="text" data-rule-number="true" data-rule-required="true"  name="cost" id="cost" class="form-control">
																			</div>
																		</div>
																		<div class="col-sm-12 col-md-12 col-lg-12">
																			<div class="form-group">												
																				<label>Margin</label>
																				<input type="text" data-rule-number="true" data-rule-required="true"  name="margin" id="margin" class="form-control">
																			</div>
																		</div>
																		<div class="col-sm-12 col-md-12 col-lg-12">
																			<div class="form-group">												
																				<label>Selling</label>
																				<input  type="text" data-rule-number="true" data-rule-required="true"  name="selling" id="selling" class="form-control">
																			</div>
																		</div>
																	</div>															
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
																	<button type="submit" class="btn btn-primary">Update</button>
																</div>
															</form>
														</div>
													</div>
												</div>
												<table class="table datatable-column-search-inputs" id="datatable_weight_time_cost">
													<thead>
														<tr>
															<th>#</th>
															<th>Options-Comp ID</th>
											                <th>Description</th>
											                <th>QTY</th>
											                <th>Weight</th>
											                <th>Lead Time</th>
											                <th>Cost</th>
											                <th>Margin%</th>
											                <th>Selling</th>
											                <th>Action</th>
											            </tr>
													</thead>
													<tbody>
													</tbody>
												</table>
											</div>

											<div class="tab-pane" id="installation">
												<div class="add-user-btn-main">
													<a class="btn btn-primary"  id="open_add_city_installation_modal" href="javascript:void(0)">Add City</a>
												</div>					
												
												<div id="modal_form_vertical_installation" class="modal fade addUserModalMain">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header bg-primary">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h5 class="modal-title">Add City</h5>
															</div>
															<form action="{{$module_url_path}}/store_installation_city" id="add_installation_city" method="post" enctype="multipart/form-data" >
																{{csrf_field()}}
																<div class="modal-body">
																	<input type="hidden" name="product_id" value="{{$arr_data['id']}}" >
																	<div class="row">
																		<div class="col-sm-12 col-md-12 col-lg-12">
																			<div class="form-group">												
																				<label>Country</label>
																				<select class="form-control" id="country_id" data-rule-required="true" name="country_id" onchange="get_cities(this)">
																					<option value="">Select Country</option>
																					@if(isset($arr_sys_country))
																						@foreach($arr_sys_country as $key_option => $country)
																							<option value="{{ $country['id'] ?? '' }}">{{ $country['country_english_name'] ?? '' }}</option>
																						@endforeach
																					@endif
																				</select>
																			</div>
																		</div>
																		<div class="col-sm-12 col-md-12 col-lg-12">
																			<div class="form-group">												
																				<label>Select City</label>
																				<div id="cities_html">												
																					<select class="form-control">
																						<option>Select City</option>
																					</select>
																				</div>
																			</div>
																		</div>
																		<div class="col-sm-12 col-md-12 col-lg-12">
																			<div class="form-group">												
																				<label>Visit Cost</label>
																				<input type="number" data-rule-required="true" name="visit_cost" id="visit_cost" placeholder="Visit Cost" class="form-control">
																			</div>
																		</div>
																		<div class="col-sm-12 col-md-12 col-lg-12">
																			<div class="form-group">												
																				<label>Visit Selling</label>
																				<input type="number" data-rule-required="true" name="visit_selling" id="visit_selling" placeholder="Visit Selling" class="form-control">
																			</div>
																		</div>
																		<div class="col-sm-12 col-md-12 col-lg-12">
																			<div class="form-group">												
																				<label>Unit Cost</label>
																				<input type="number" data-rule-required="true" name="unit_cost" id="unit_cost" placeholder="Unit Cost" class="form-control">
																			</div>
																		</div>
																		<div class="col-sm-12 col-md-12 col-lg-12">
																			<div class="form-group">												
																				<label>Unit Selling</label>
																				<input type="number" data-rule-required="true" name="unit_selling" id="unit_selling" placeholder="Unit Selling" class="form-control">
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
												<div id="edit_modal_form_installation_city" class="modal fade addUserModalMain">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header bg-primary">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h5 class="modal-title">Edit Product Installation Detail & City</h5>
															</div>
															<form action="{{$module_url_path}}/update_product_installation_city" id="edit_installation_city" method="post" enctype="multipart/form-data" >
																{{csrf_field()}}
																<input type="hidden" id="product_id" name="product_id" value="{{$arr_data['id']}}">
																<input type="hidden" id="city_enc_id" name="city_enc_id">
																<div class="modal-body">
																	<div class="row">
																		<div id="edit_country_html"></div>
																		<div id="edit_city_html"></div>

																		<div class="col-sm-12 col-md-12 col-lg-12">
																			<div class="form-group">												
																				<label>Visit Cost</label>
																				<input type="number" data-rule-required="true" name="edit_visit_cost" id="edit_visit_cost" placeholder="Visit Cost" class="form-control">
																			</div>
																		</div>
																		<div class="col-sm-12 col-md-12 col-lg-12">
																			<div class="form-group">												
																				<label>Visit Selling</label>
																				<input type="number" data-rule-required="true" name="edit_visit_selling" id="edit_visit_selling" placeholder="Visit Selling" class="form-control">
																			</div>
																		</div>
																		<div class="col-sm-12 col-md-12 col-lg-12">
																			<div class="form-group">												
																				<label>Unit Cost</label>
																				<input type="number" data-rule-required="true" name="edit_unit_cost" id="edit_unit_cost" placeholder="Unit Cost" class="form-control">
																			</div>
																		</div>
																		<div class="col-sm-12 col-md-12 col-lg-12">
																			<div class="form-group">												
																				<label>Unit Selling</label>
																				<input type="number" data-rule-required="true" name="edit_unit_selling" id="edit_unit_selling" placeholder="Unit Selling" class="form-control">
																			</div>
																		</div>
																	</div>
																</div>

																<div class="modal-footer">
																	<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
																	<button type="submit" class="btn btn-primary">Update</button>
																</div>
															</form>
														</div>
													</div>
												</div>
												<table class="table datatable-column-search-inputs" id="datatable_installation">
													<thead>
														<tr>
															<th>#</th>
															<th>City</th>
															<th>Visit Cost</th>
															<th>Visit Selling</th>
															<th>Unit Installation Cost</th>
															<th>Unit Installation Selling</th>
															<th>Actions</th>																
														</tr>
													</thead>
													<tbody>
													</tbody>
												</table>
											</div>

											<div class="tab-pane" id="accessories">
												<div class="add-user-btn-main">
													<a class="btn btn-primary"  id="open_add_product_accessory_modal" href="javascript:void(0)">Add Accessory</a>
												</div>
												<div id="modal_form_add_product_accessory_modal" class="modal fade addUserModalMain">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header bg-primary">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h5 class="modal-title">Add Product Accessory</h5>
															</div>
															<form action="{{$module_url_path}}/store_product_accessory" id="add_product_accessory" method="post" enctype="multipart/form-data" >
																{{csrf_field()}}
																<div class="modal-body">
																	<input type="hidden" name="product_id" value="{{$arr_data['id']}}" >
																	<div class="row">
																		<div class="col-sm-12 col-md-12 col-lg-12">
																			<div class="form-group">												
																				<label>Accessory</label>
																				<select class="form-control" id="accessory_id" data-rule-required="true" name="accessory_id">
																					<option value="">--- Select Accessory ---</option>
																					@if(isset($arr_accessory))
																						@foreach($arr_accessory as $key_accessory => $accessory)
																							<option value="{{ $accessory['id'] ?? '' }}">{{ $accessory['english_name'] ?? '' }}</option>
																						@endforeach
																					@endif
																				</select>
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
												<table class="table datatable-column-search-inputs" id="datatable_accessories">
													<thead>
														<tr>
															<th>#</th>
															<th>Accessory ID</th>
															<th>English Name</th>
															<th>Arabic Name</th>
															<th>Actions</th>
											            </tr>
													</thead>
													<tbody>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						<!-- </div> -->
					<!-- </div> -->
					<!-- /rounded solid tabs -->



					<!-- Vertical tabs -->
					<!-- <h6 class="content-group text-semibold">
						Vertical tabs
						<small class="display-block">Display tabs nav on left or right side</small>
					</h6>

					<div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Left side placement</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable nav-tabs-vertical nav-tabs-left">
										<ul class="nav nav-tabs nav-tabs-highlight">
											<li class="active"><a href="#left-tab1" data-toggle="tab"><i class="icon-menu7 position-left"></i> Active</a></li>
											<li><a href="#left-tab2" data-toggle="tab"><i class="icon-mention position-left"></i> Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog5 position-left"></i> Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu">
													<li><a href="#left-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#left-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active has-padding" id="left-tab1">
												Basic tabs example using <code>.nav-tabs</code> class. Also requires base <code>.nav</code> class.
											</div>

											<div class="tab-pane has-padding" id="left-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane has-padding" id="left-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane has-padding" id="left-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Right side placement</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable nav-tabs-vertical nav-tabs-right">
										<div class="tab-content">
											<div class="tab-pane active has-padding" id="right-tab1">
												Basic tabs example using <code>.nav-tabs</code> class. Also requires base <code>.nav</code> class.
											</div>

											<div class="tab-pane has-padding" id="right-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane has-padding" id="right-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane has-padding" id="right-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>

										<ul class="nav nav-tabs nav-tabs-highlight">
											<li class="active"><a href="#right-tab1" data-toggle="tab"><span class="label label-danger pull-right">Bug</span> Active</a></li>
											<li><a href="#right-tab2" data-toggle="tab"><span class="label label-info pull-right">Fixed</span> Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="badge badge-success pull-right">37</span> Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu">
													<li><a href="#right-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#right-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /vertical tabs -->



					<!-- Colored tabs title -->
					<!-- <h6 class="content-group text-semibold">
						Colored tabs
						<small class="display-block">Tabs with custom background color</small>
					</h6> -->
					<!-- /colored tabs title -->


					<!-- Colored tabs -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Colored tabs</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs bg-teal-400">
											<li class="active"><a href="#colored-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#colored-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#colored-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#colored-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="colored-tab1">
												Add <code>custom</code> background color to the tabs using <code>.bg-*</code> class.
											</div>

											<div class="tab-pane" id="colored-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="colored-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="colored-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Colored justified</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs bg-teal-400 nav-justified">
											<li class="active"><a href="#colored-justified-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#colored-justified-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#colored-justified-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#colored-justified-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="colored-justified-tab1">
												To use in tabs with equal widths add <code>.nav-justified .bg-*</code> classes.
											</div>

											<div class="tab-pane" id="colored-justified-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="colored-justified-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="colored-justified-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /colored tabs -->


					<!-- Rounded colored tabs -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Colored rounded</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs bg-slate nav-tabs-component">
											<li class="active"><a href="#colored-rounded-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#colored-rounded-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#colored-rounded-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#colored-rounded-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="colored-rounded-tab1">
												In colored tabs <code>.nav-tabs-component</code> class rounds tabs container and first tab corners.
											</div>

											<div class="tab-pane" id="colored-rounded-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="colored-rounded-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="colored-rounded-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Rounded justified</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs bg-slate nav-tabs-component nav-justified">
											<li class="active"><a href="#colored-rounded-justified-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#colored-rounded-justified-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#colored-rounded-justified-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#colored-rounded-justified-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="colored-rounded-justified-tab1">
												For justified tabs use <code>.nav-justified .bg-* .nav-tabs-component</code> classes.
											</div>

											<div class="tab-pane" id="colored-rounded-justified-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="colored-rounded-justified-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="colored-rounded-justified-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /rounded colored tabs -->



					<!-- Tab options title -->
					<!-- <h6 class="content-group text-semibold">
						Other tab options
						<small class="display-block">Animations, position, borders, content</small>
					</h6> -->
					<!-- /tab options title -->


					<!-- Animations -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Fade animation</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-highlight">
											<li class="active"><a href="#fade-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#fade-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#fade-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#fade-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane fade in active" id="fade-tab1">
												To make tabs fade in, add <code>.fade</code> to each <code>.tab-pane</code> and <code>.in</code> to the active tab.
											</div>

											<div class="tab-pane fade" id="fade-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane fade" id="fade-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane fade" id="fade-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">CSS animations</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-highlight">
											<li class="active"><a href="#css-animate-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#css-animate-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#css-animate-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#css-animate-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane animated bounceIn active" id="css-animate-tab1">
												To use custom animations, add animation classes to each <code>.tab-pane</code> container.
											</div>

											<div class="tab-pane animated fadeInUp" id="css-animate-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane animated zoomIn" id="css-animate-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane animated flipInX" id="css-animate-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /animations -->


					<!-- Tabs position -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Centered position</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-highlight text-center">
											<li class="active"><a href="#centered-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#centered-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#centered-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#centered-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="centered-tab1">
												To use centered tabs, add <code>.text-center</code> to the <code>.nav-tabs</code> class.
											</div>

											<div class="tab-pane" id="centered-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="centered-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="centered-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Right position</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-highlight text-right">
											<li class="active"><a href="#right-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#right-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#right-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#right-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="right-tab1">
												To use right aligned tabs, add <code>.text-right</code> to the <code>.nav-tabs</code> class.
											</div>

											<div class="tab-pane" id="right-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="right-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="right-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /tabs position -->


					<!-- Bordered tab content -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Bordered tab content</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable tab-content-bordered">
										<ul class="nav nav-tabs nav-tabs-highlight">
											<li class="active"><a href="#bordered-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#bordered-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#bordered-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#bordered-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane has-padding active" id="bordered-tab1">
												To apply border and padding to the tab content, add <code>.tab-content-bordered</code> to the parent container.
											</div>

											<div class="tab-pane has-padding" id="bordered-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane has-padding" id="bordered-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane has-padding" id="bordered-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Bordered justified</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable tab-content-bordered">
										<ul class="nav nav-tabs nav-tabs-highlight nav-justified">
											<li class="active"><a href="#bordered-justified-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#bordered-justified-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#bordered-justified-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#bordered-justified-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane has-padding active" id="bordered-justified-tab1">
												To use in tabs with equal widths add <code>.nav-justified</code> and <code>.tab-content-bordered</code> to the parent container.
											</div>

											<div class="tab-pane has-padding" id="bordered-justified-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane has-padding" id="bordered-justified-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane has-padding" id="bordered-justified-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /bordered tab content -->



					<!-- Tab icons -->
					<!-- <h6 class="content-group text-semibold">
						Tabs with icons
						<small class="display-block">Show icons in different positions</small>
					</h6> -->
					<!-- /tab icons title -->


					<!-- Left icons -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Tabs with left icons</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-highlight">
											<li class="active"><a href="#left-icon-tab1" data-toggle="tab"><i class="icon-menu7 position-left"></i> Active</a></li>
											<li><a href="#left-icon-tab2" data-toggle="tab"><i class="icon-mention position-left"></i> Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-gear position-left"></i> Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#left-icon-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#left-icon-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="left-icon-tab1">
												Add icon markup <code>before</code> tab nav text to display icons on the left side.
											</div>

											<div class="tab-pane" id="left-icon-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="left-icon-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="left-icon-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Justified tabs. Left icons</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-highlight nav-justified">
											<li class="active"><a href="#justified-left-icon-tab1" data-toggle="tab"><i class="icon-menu7 position-left"></i> Active</a></li>
											<li><a href="#justified-left-tab2" data-toggle="tab"><i class="icon-mention position-left"></i> Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-gear position-left"></i> Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#justified-left-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#justified-left-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="justified-left-tab1">
												To use in tabs with equal widths add <code>.nav-justified</code> and icon markup to the tab nav.
											</div>

											<div class="tab-pane" id="justified-left-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="justified-left-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="justified-left-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /left icons -->


					<!-- Right icons -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Tabs with right icons</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-bottom">
											<li class="active"><a href="#right-icon-tab1" data-toggle="tab">Active <i class="icon-menu7 position-right"></i></a></li>
											<li><a href="#right-icon-tab2" data-toggle="tab">Inactive <i class="icon-mention position-right"></i></a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <i class="icon-gear position-right"></i> <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#right-icon-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#right-icon-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="right-icon-tab1">
												Add icon markup <code>after</code> tab nav text to display icons on the right side.
											</div>

											<div class="tab-pane" id="right-icon-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="right-icon-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="right-icon-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Justified tabs. Right icons</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-bottom nav-justified">
											<li class="active"><a href="#justified-right-icon-tab1" data-toggle="tab">Active <i class="icon-menu7 position-right"></i></a></li>
											<li><a href="#justified-right-icon-tab2" data-toggle="tab">Inactive <i class="icon-mention position-right"></i></a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <i class="icon-gear position-right"></i><span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#justified-right-icon-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#justified-right-icon-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="justified-right-icon-tab1">
												To use in tabs with equal widths add <code>.nav-justified</code> and icon markup to the tab nav.
											</div>

											<div class="tab-pane" id="justified-right-icon-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="justified-right-icon-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="justified-right-icon-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /right icons -->


					<!-- Top icons -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Tabs with top icons</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-bottom bottom-divided nav-tabs-icon">
											<li class="active"><a href="#top-icon-tab1" data-toggle="tab"><i class="icon-menu7"></i> Active</a></li>
											<li><a href="#top-icon-tab2" data-toggle="tab"><i class="icon-mention"></i> Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-gear"></i> Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#top-icon-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#top-icon-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="top-icon-tab1">
												To display icon on top, add icon code and <code>.nav-tabs-icon</code> class to the tabs nav container.
											</div>

											<div class="tab-pane" id="top-icon-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="top-icon-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="top-icon-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Justified tabs. Top icons</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-bottom bottom-divided nav-justified nav-tabs-icon">
											<li class="active"><a href="#justified-top-icon-tab1" data-toggle="tab"><i class="icon-menu7"></i> Active</a></li>
											<li><a href="#justified-top-icon-tab2" data-toggle="tab"><i class="icon-mention"></i> Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-gear"></i> Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#justified-top-icon-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#justified-top-icon-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="justified-top-icon-tab1">
												To use in tabs with equal widths add <code>.nav-justified</code> and icon markup to the tab nav.
											</div>

											<div class="tab-pane" id="justified-top-icon-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="justified-top-icon-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="justified-top-icon-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /top icons -->


					<!-- Icons only -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Tabs with icons only</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-top">
											<li class="active">
												<a href="#icon-only-tab1" data-toggle="tab">
													<i class="icon-menu7"></i>
													<span class="visible-xs-inline-block position-right">Active</span>
												</a>
											</li>

											<li>
												<a href="#icon-only-tab2" data-toggle="tab">
													<i class="icon-mention"></i>
													<span class="visible-xs-inline-block position-right">Inactive</span>
												</a>
											</li>

											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-gear"></i>
													<span class="visible-xs-inline-block position-right">Dropdown</span>
													<span class="caret"></span>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#icon-only-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#icon-only-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="icon-only-tab1">
												If tab nav doesn't have a text, add icon markup to display icon only.
											</div>

											<div class="tab-pane" id="icon-only-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="icon-only-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="icon-only-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Justified tabs. Icons only</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-top nav-justified">
											<li class="active">
												<a href="#justified-icon-only-tab1" data-toggle="tab">
													<i class="icon-menu7"></i>
													<span class="visible-xs-inline-block position-right">Active</span>
												</a>
											</li>

											<li>
												<a href="#justified-icon-only-tab2" data-toggle="tab">
													<i class="icon-mention"></i>
													<span class="visible-xs-inline-block position-right">Inactive</span>
												</a>
											</li>

											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-gear"></i>
													<span class="visible-xs-inline-block position-right">Dropdown</span>
													<span class="caret"></span>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#justified-icon-only-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#justified-icon-only-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="justified-icon-only-tab1">
												To use in tabs with equal widths add <code>.nav-justified</code> and icon markup to the tab nav.
											</div>

											<div class="tab-pane" id="justified-icon-only-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="justified-icon-only-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="justified-icon-only-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /icons only -->



					<!-- Tab labels title -->
					<!-- <h6 class="content-group text-semibold">
						Tabs with labels
						<small class="display-block">Display labels and badges</small>
					</h6> -->
					<!-- /tab labels title -->


					<!-- Labels -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Tabs with labels</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-highlight">
											<li class="active"><a href="#label-tab1" data-toggle="tab"><span class="label label-danger position-left">Bug</span> Active</a></li>
											<li><a href="#label-tab2" data-toggle="tab">Inactive <span class="label bg-slate position-right">Fixed</span></a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-info">Priority</span> <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#label-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#label-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="label-tab1">
												Display <code>labels</code> on the left/right sides and in empty tab nav. Empty labels are hidden.
											</div>

											<div class="tab-pane" id="label-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="label-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="label-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Justified tabs with labels</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-highlight nav-justified">
											<li class="active"><a href="#justified-label-tab1" data-toggle="tab"><span class="label label-danger position-left">Bug</span> Active</a></li>
											<li><a href="#justified-label-tab2" data-toggle="tab">Inactive <span class="label label-info position-right">Fixed</span></a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-success">Priority</span> <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#justified-label-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#justified-label-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="justified-label-tab1">
												To use in tabs with equal widths add <code>.nav-justified</code> and label markup to the tab nav.
											</div>

											<div class="tab-pane" id="justified-label-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="justified-label-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="justified-label-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /labels -->


					<!-- Badges -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Tabs with badges</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-highlight">
											<li class="active"><a href="#badges-tab1" data-toggle="tab"><span class="badge badge-success position-left">78</span> Active</a></li>
											<li><a href="#badges-tab2" data-toggle="tab">Inactive <span class="badge badge-danger position-right">23</span></a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="badge bg-slate">34</span> <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#badges-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#badges-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="badges-tab1">
												Display <code>badges</code> on the left/right sides and in empty tab nav. Empty badges are hidden.
											</div>

											<div class="tab-pane" id="badges-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="badges-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="badges-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Justified tabs with badges</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-highlight nav-justified">
											<li class="active"><a href="#justified-badges-tab1" data-toggle="tab"><span class="badge badge-danger position-left">87</span> Active</a></li>
											<li><a href="#justified-badges-tab2" data-toggle="tab">Inactive <span class="badge bg-slate position-right">23</span></a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="badge badge-info">34</span> <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#justified-badges-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#justified-badges-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="justified-badges-tab1">
												To use in tabs with equal widths add <code>.nav-justified</code> and badge markup to the tab nav.
											</div>

											<div class="tab-pane" id="justified-badges-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="justified-badges-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="justified-badges-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /badges -->



					<!-- Tabs sizing title -->
					<!-- <h6 class="content-group text-semibold">
						Tabs sizing
						<small class="display-block">Available tabs sizing with elements</small>
					</h6> -->
					<!-- /tabs sizing title -->


					<!-- Large size -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Large size</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-lg nav-tabs nav-tabs-solid nav-tabs-component">
											<li class="active"><a href="#large-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#large-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#large-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#large-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="large-tab1">
												To use large size, add <code>.nav-tabs-lg</code> class to the <code>.nav-tabs</code> base class.
											</div>

											<div class="tab-pane" id="large-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="large-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="large-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Large with elements</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-lg nav-tabs nav-tabs-solid nav-tabs-component nav-justified">
											<li class="active"><a href="#large-justified-tab1" data-toggle="tab"><i class="icon-menu7 position-left"></i> Active</a></li>
											<li><a href="#large-justified-tab2" data-toggle="tab"><span class="label label-danger position-left">Done</span> Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="badge bg-slate position-right">39</span> <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#large-justified-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#large-justified-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="large-justified-tab1">
												To use in tabs with equal widths add <code>.nav-justified .nav-tabs-lg</code> classes.
											</div>

											<div class="tab-pane" id="large-justified-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="large-justified-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="large-justified-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /large size -->


					<!-- Default size -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Default size</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-solid nav-tabs-component">
											<li class="active"><a href="#default-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#default-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#default-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#default-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="default-tab1">
												Default tabs size doesn't require any additional sizing classes.
											</div>

											<div class="tab-pane" id="default-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="default-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="default-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Default with elements</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-solid nav-tabs-component nav-justified">
											<li class="active"><a href="#default-justified-tab1" data-toggle="tab"><i class="icon-menu7 position-left"></i> Active</a></li>
											<li><a href="#default-justified-tab2" data-toggle="tab"><span class="label label-danger position-left">Done</span> Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="badge bg-slate position-right">39</span> <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#default-justified-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#default-justified-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="default-justified-tab1">
												To use in default tabs with equal widths add <code>.nav-justified</code> class.
											</div>

											<div class="tab-pane" id="default-justified-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="default-justified-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="default-justified-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /default size -->


					<!-- Small size -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Small size</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-sm nav-tabs nav-tabs-solid nav-tabs-component">
											<li class="active"><a href="#small-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#small-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#small-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#small-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="small-tab1">
												To use small size, add <code>.nav-tabs-sm</code> class to the <code>.nav-tabs</code> base class.
											</div>

											<div class="tab-pane" id="small-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="small-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="small-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>-->
						<!-- /small size -->

						<!-- <div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Small with elements</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-sm nav-tabs nav-tabs-solid nav-tabs-component nav-justified">
											<li class="active"><a href="#small-justified-tab1" data-toggle="tab"><i class="icon-menu7 position-left"></i> Active</a></li>
											<li><a href="#small-justified-tab2" data-toggle="tab"><span class="label label-danger position-left">Done</span> Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="badge bg-slate position-right">39</span> <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#small-justified-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#small-justified-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="small-justified-tab1">
												To use in tabs with equal widths add <code>.nav-justified .nav-tabs-sm</code> classes.
											</div>

											<div class="tab-pane" id="small-justified-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="small-justified-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="small-justified-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div> -->
					<!-- </div> --> 


					<!-- Mini size -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Mini size</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-xs nav-tabs nav-tabs-solid nav-tabs-component">
											<li class="active"><a href="#mini-tab1" data-toggle="tab">Active</a></li>
											<li><a href="#mini-tab2" data-toggle="tab">Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#mini-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#mini-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="mini-tab1">
												To use mini size, add <code>.nav-tabs-xs</code> class to the <code>.nav-tabs</code> base class.
											</div>

											<div class="tab-pane" id="mini-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="mini-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="mini-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Mini with elements</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="collapse"></a></li>
					                		<li><a data-action="reload"></a></li>
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-xs nav-tabs nav-tabs-solid nav-tabs-component nav-justified">
											<li class="active"><a href="#mini-justified-tab1" data-toggle="tab"><i class="icon-menu7 position-left"></i> Active</a></li>
											<li><a href="#mini-justified-tab2" data-toggle="tab"><span class="label label-danger position-left">Done</span> Inactive</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="badge bg-slate position-right">39</span> <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#mini-justified-tab3" data-toggle="tab">Dropdown tab</a></li>
													<li><a href="#mini-justified-tab4" data-toggle="tab">Another tab</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="mini-justified-tab1">
												To use in tabs with equal widths add <code>.nav-justified .nav-tabs-xs</code> classes.
											</div>

											<div class="tab-pane" id="mini-justified-tab2">
												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
											</div>

											<div class="tab-pane" id="mini-justified-tab3">
												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
											</div>

											<div class="tab-pane" id="mini-justified-tab4">
												Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- /mini size -->


					<!-- Footer -->
					<!-- <div class="footer text-muted">
						&copy; 2015. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
					</div> -->
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
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.all.js"></script> -->
<script src="{{url('/')}}/assets/admin/assets/js/pages/sweetalert_msg.js"></script>
<script src="{{url('/')}}/assets/admin/assets/js/pages/sweetalert.min.js"></script>
<script>

	//Akshays code for updating subcategory
	function get_edit_sub_category()
	{
		var category_id             					= $('#category_id').val();
		var subcategory_id             					= "{{$arr_data['subcategory_id']}}";
		// alert(subcategory_id);
		var token                   = "{{csrf_token()}}";
		var base_url                = '{{$module_url_path}}/get_edit_sub_category';
		$.ajax({
			url: base_url,
			type: "POST",
			data: {
				_token: token,
				category_id: category_id,
				subcategory_id: subcategory_id,
			},
			success:function(html){
					if(html)
					{ 
						// document.getElementById('subcategory_html').innerHTML = html;
						document.getElementById('subcategory_html').innerHTML = html;
					}
				}
		});
	}

	// Code for cities
	function get_cities()
	{
		var country_id             					= $('#country_id').val();
		// alert(country_id);
		var token                   = "{{csrf_token()}}";
		var base_url                = '{{$module_url_path}}/get_cities';
		$.ajax({
			url: base_url,
			type: "POST",
			data: {
				_token: token,
				country_id: country_id,
			},
			success:function(html){
					if(html)
					{ 
						document.getElementById('cities_html').innerHTML = html;
					}
				}
		});
	}

	// Code for edit cities in installation
	function get_edit_cities()
	{
		var edit_country_id             					= $('#edit_country_id').val();
		// alert(edit_country_id);
		var token                   = "{{csrf_token()}}";
		var base_url                = '{{$module_url_path}}/get_edit_cities';
		$.ajax({
			url: base_url,
			type: "POST",
			data: {
				_token: token,
				edit_country_id: edit_country_id,
			},
			success:function(city_html){
					if(city_html)
					{ 
						document.getElementById('edit_city_html').innerHTML = city_html;
					}
				}
		});
	}

	// 
	function get_add_sub_option()
	{
		var add_option             					= $('#add_option').val();
		// alert(add_option);
		var token                   = "{{csrf_token()}}";
		var base_url                = '{{$module_url_path}}/get_edit_sub_option';
		$.ajax({
			url: base_url,
			type: "POST",
			data: {
				_token: token,
				add_option: add_option,
			},
			success:function(html){
					if(html)
					{
						document.getElementById('sub_option_id').innerHTML = html;
					}
				}
		});
	}

	$(document).ready(function(){

		

		/*Added by Designer*/
		// alert($('.file-input').hasClass('.file-input-new'));
		// if ($('.file-input').hasClass('.file-input-new')) {
		// 	alert("hi");
		// 	$(this).parent().addClass("active");
		// }
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
		/*Added by Designer*/


		/*TAB 1*/
		var product_id  = "{{ $arr_data['id'] ??''}}";
		
		$('#update_product_info').validate();
	
		/*TAB 1*/


		/*Datatable for product TAB 2*/
	
		$('#add_product_option').validate();	

		$('body').on('click','#view_product_option',function(){
			var product_id  = "{{ $arr_data['id'] ?? '' }}";
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

			    var table = $('#datatable_product_option').DataTable({
					"bStateSave": true,
					"bSearchable":true,
					"processing": true,
					"serverSide": false,
					"searchDelay": 350,
					"autoWidth": false,
					"bFilter": true,
					"bLengthChange": true,
					ajax: {
						url: "{{ $module_url_path}}/load_option_data",
						data: function(d) {
							d['product_id'] = '{{$arr_data['id']}}'
						}
					},
					columns: [
					   
						{data : 'sr_no',"orderable":false,"searchable":true,name:'sr_no'},
						{data : 'option_english_name',"orderable":false,"searchable":true,name:'option_english_name'},
						{data : 'sub_option_english_name',"orderable":false,"searchable":true,name:'sub_option_english_name'},
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
			});
		});

		$('body').on('click','#open_add_option_modal',function(){
			var product_id  = "{{ $arr_data['id'] ??''}}";

			$.ajax({
	            url : '{{ $module_url_path}}/check_all_options/'+btoa(product_id),
	            type : "GET",
	            dataType: 'JSON',
	            success:function(resp){
	                if(resp.status=='success'){
						$('#add_modal_form_vertical_option').modal('show');
	                }else if(resp.status=='error'){
	     //                Swal.fire(
						//   resp.status,
						//   "All options are added",
						//   resp.status
						// );
						 swal(resp.status,"All options are added.",resp.status);
	                }
	            }
	        })	
		});

		$('body').on('click','#open_edit_product_option_modal',function(){
	        var id = btoa($(this).data("id"));

			$.ajax({
	            url : '{{$module_url_path}}/edit_product_option/'+id,
	            type : "GET",
	            dataType: 'JSON',
	            data : id,
	            success:function(arr_resp){
	                if(arr_resp){
						// alert(arr_resp.id);
						$("#edit_modal_form_vertical_option").modal('show');
	                    // $('#enc_id').val(btoa(arr_resp.id));
						document.getElementById('edit_option_enc_id').innerHTML = arr_resp.id;
						document.getElementById('edit_option_html').innerHTML = arr_resp.option_html;
						document.getElementById('edit_sub_option_html').innerHTML = arr_resp.sub_option_html;
	                    $('#edit_option_id').css('pointer-events','none');
	                    
	                }else if(resp.status=='error'){
	                    $("#edit_modal_form_vertical_option").modal('hide');
	                }
	            }
	        })	
		});
		
		/*Datatable for product TAB 2*/


		/*TAB 3*/
		$('#add_product_quantity').validate();
		$('input[type=radio][name=quantity_type]').on('change', function() {

			var value = $(this).val();
			if(value=='fixed'){

			 $('.validate_fixed').data('rule-required',true);    
			 $('.validate_variable').data('rule-required',false);    
			}else{
			 $('.validate_fixed').data('rule-required',false);    
			 $('.validate_variable').data('rule-required',true);    

			}
		});
		/*TAB 3*/


		/*TAB 4*/
		$("#update_product_weight_time_cost").validate();
		$('body').on('click','#view_weight_time_cost',function(){
			var product_id  = "{{ $arr_data['id'] ?? '' }}";
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

			    var table = $('#datatable_weight_time_cost').DataTable({
					"bStateSave": true,
					"bSearchable":true,
					"processing": true,
					"serverSide": false,
					"searchDelay": 350,
					"autoWidth": false,
					"bFilter": true,
					"bLengthChange": true,
					ajax: {
						url: "{{ $module_url_path}}/load_product_weight_time_cost",
						data: function(d) {
							d['product_id'] = '{{$arr_data['id'] ?? ''}}'
						}
					},
					columns: [
					   
						{data : 'sr_no',"orderable":false,"searchable":true,name:'sr_no'},
						{data : 'sub_options_comb_id',"orderable":false,"searchable":true,name:'sub_options_comb_id'},
						{data : 'description',"orderable":false,"searchable":true,name:'description'},
						{data : 'quantity',"orderable":false,"searchable":true,name:'quantity'},
						{data : 'weight',"orderable":false,"searchable":true,name:'weight'},
						{data : 'lead_time',"orderable":false,"searchable":true,name:'lead_time'},
						{data : 'cost',"orderable":false,"searchable":true,name:'cost'},
						{data : 'margin',"orderable":false,"searchable":true,name:'margin'},
						{data : 'selling',"orderable":false,"searchable":true,name:'selling'},
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
			});
		});

		$('body').on('click','#open_weight_time_cost_modal',function(){
	        var id = btoa($(this).data("id"));
			$.ajax({
	            url : '{{$module_url_path}}/edit_product_weight_time_cost/'+id,
	            type : "GET",
	            dataType: 'JSON',
	            data : id,
	            success:function(arr_resp){
	                if(arr_resp){
						$("#edit_modal_form_product_weight_time_cost").modal('show');
	                    $('#edit_enc_id').val(arr_resp.id);
						// alert(arr_resp.id);
						$('#options_comb_id').val(arr_resp.sub_options_comb_id);
						$('#edit_description').val(arr_resp.description);
						$('#edit_quantity').val(arr_resp.quantity);
						$('#weight').val(arr_resp.weight);
						$('#lead_time').val(arr_resp.lead_time);
						$('#cost').val(arr_resp.cost);
						$('#margin').val(arr_resp.margin);
						$('#selling').val(arr_resp.selling);
	                    
	                }
					else
					{
	                    $("#edit_modal_form_product_weight_time_cost").modal('hide');
	                }
	            }
	        })	
		});

		// Code for margin formula given by client
		$('body').on('change','#cost,#margin',function(){
			var cost = $('#cost').val();
			var margin = $('#margin').val();

			var selling = cost /(1-(margin/100));	

			$('#selling').val(selling.toFixed(2));
		});

		/*TAB 4*/

		/*TAB 5*/
		$('#add_installation_city').validate();
		$("#edit_installation_city").validate();

		$('body').on('click','#view_installation',function(){
			var product_id  = "{{ $arr_data['id'] ?? '' }}";
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

			    var table = $('#datatable_installation').DataTable({
			        "bStateSave": true,
			        "bSearchable":true,
			        "processing": true,
				    "serverSide": false,
				    "searchDelay": 350,
				    "autoWidth": false,
				    "bFilter": true,
				    "bLengthChange": true,
			        ajax: {
			            url: "{{ $module_url_path}}/load_product_installation/"+btoa(product_id),
			            data: function(d) {
			                // d['column_filter[invoice_id]'] 				= $("input[name='invoice_id']").val()
			                // d['column_filter[invoice_amount]']   		= $("input[name='invoice_amount']").val()
			            }
			        },
			        columns: [
			            {data : 'sr_no',"orderable":false,"searchable":true,name:'sr_no'},
						{data : 'city',"orderable":false,"searchable":true,name:'city'},
						{data : 'visit_cost',"orderable":false,"searchable":true,name:'visit_cost'},
						{data : 'visit_selling',"orderable":false,"searchable":true,name:'visit_selling'},
						{data : 'unit_cost',"orderable":false,"searchable":true,name:'unit_cost'},
						{data : 'unit_selling',"orderable":false,"searchable":true,name:'unit_selling'},
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
			});
		});

		$('body').on('click','#open_add_city_installation_modal',function(){

			$('#modal_form_vertical_installation').modal('show');
		});

		$('body').on('click','#open_edit_product_installation_city',function(){
	        var id = btoa($(this).data("id"));
			$.ajax({
	            url : '{{$module_url_path}}/edit_installation_city/'+id,
	            type : "GET",
	            dataType: 'JSON',
	            data : id,
	            success:function(arr_resp){
	                if(arr_resp){
						// alert(arr_resp.data.country_id);
						$("#edit_modal_form_installation_city").modal('show');
	                    $('#city_enc_id').val(btoa(arr_resp.data.id));
						document.getElementById('edit_country_html').innerHTML = arr_resp.country_html;
						document.getElementById('edit_city_html').innerHTML = arr_resp.city_html;
						$('#edit_visit_cost').val(arr_resp.data.visit_cost);
						$('#edit_visit_selling').val(arr_resp.data.visit_selling);
						$('#edit_unit_cost').val(arr_resp.data.unit_cost);
						$('#edit_unit_selling').val(arr_resp.data.unit_selling);
	                    
	                }else if(resp.status=='error'){
	                    $("#edit_modal_form_installation_city").modal('hide');
	                }
	            }
	        })	
		});
	
		/*TAB 5*/

		/*TAB 6*/
		$("#add_product_accessory").validate();

		$('body').on('click','#view_accessories',function(){
			var product_id  = "{{ $arr_data['id'] ?? '' }}";
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

			    var table = $('#datatable_accessories').DataTable({
						"bStateSave": true,
						"bSearchable":true,
						"processing": true,
						"serverSide": false,
						"searchDelay": 350,
						"autoWidth": false,
						"bFilter": true,
						"bLengthChange": true,
						ajax: {
							url: "{{ $module_url_path}}/load_product_accessories",
							data: function(d) {
								d['product_id'] = '{{$arr_data['id']}}'
							}
						},
						columns: [
						   
							{data : 'sr_no',"orderable":false,"searchable":true,name:'sr_no'},
							{data : 'accessory_ID',"orderable":false,"searchable":true,name:'accessory_ID'},
							{data : 'accessory_english_name',"orderable":false,"searchable":true,name:'accessory_english_name'},
							{data : 'accessory_arabic_name',"orderable":false,"searchable":true,name:'accessory_arabic_name'},
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
			});
		});

		$('body').on('click','#open_add_product_accessory_modal',function(){
			$("#modal_form_add_product_accessory_modal").modal('show');	
		});

		$('body').on('click','#open_edit_product_installation_city',function(){
	        var id = btoa($(this).data("id"));
			$.ajax({
	            url : '{{$module_url_path}}/edit_installation_city/'+id,
	            type : "GET",
	            dataType: 'JSON',
	            data : id,
	            success:function(arr_resp){
	                if(arr_resp){
						// alert(arr_resp.data.country_id);
						$("#edit_modal_form_installation_city").modal('show');
	                    $('#city_enc_id').val(btoa(arr_resp.data.id));
						document.getElementById('edit_country_html').innerHTML = arr_resp.country_html;
						document.getElementById('edit_city_html').innerHTML = arr_resp.city_html;
						$('#edit_visit_cost').val(arr_resp.data.visit_cost);
						$('#edit_visit_selling').val(arr_resp.data.visit_selling);
						$('#edit_unit_cost').val(arr_resp.data.unit_cost);
						$('#edit_unit_selling').val(arr_resp.data.unit_selling);
	                    
	                }else if(resp.status=='error'){
	                    $("#edit_modal_form_installation_city").modal('hide');
	                }
	            }
	        })	
		});
	
		/*TAB 6*/
	})	


	
</script>

<!-- Mirrored from demo.interface.club/limitless/layout_1/LTR/default/components_tabs.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 05:45:43 GMT -->
</html>
