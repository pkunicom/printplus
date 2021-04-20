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
		<link rel="stylesheet" href="{{ asset('assets/admin') }}/assets/css/telinput/intlTelInput.css">
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

		<!-- Telinput -->
	<!-- Use as a Vanilla JS plugin -->
	<script src="{{ asset('assets/admin') }}/assets/css/telinput/js/intlTelInput.min.js"></script>
	<!-- Use as a jQuery plugin -->
	<script src="{{ asset('assets/admin') }}/assets/css/telinput/js/intlTelInput-jquery.min.js"></script>
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
									<div class="tabbable agent-managment-tabs-main" id="tabload">
										<ul class="nav nav-tabs nav-tabs-solid nav-tabs-component nav-justified">
											<li class="active"><a href="#overview" data-toggle="tab">Overview</a></li>
											<li><a class="justified-tab2" href="#account_information" data-toggle="tab">Account Information</a></li>
											<li><a href="#bank_details" data-toggle="tab">Bank Information</a></li>
											<li><a href="#agent_products" data-toggle="tab" id="view_agent_products">Products</a></li>
											<li><a href="#agent_invoices" data-toggle="tab" id="view_agent_invoice">Invoices</a></li>											
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="overview">
												<div class="row">
													<div class="col-lg-4">
														<div class="panel total-count-block">
															<!-- Old code commented by client -->
															<!-- <div class="panel-body">
																<div class="dash-box-head">Orders</div>
																<h6 class="no-margin">Total Orders</h6>
																<div class="text-muted text-size-small">101,123</div>
																<div class="clearfix"></div>
															</div> -->
															<div class="panel-body">
																<div class="dash-box-head">Orders</div>
																<h6 class="no-margin">101,123</h6>
																<div class="clearfix"></div>
															</div>
															<div id="server-load"></div>
														</div>
														<div class="panel total-count-block dash-box-lecture">
															<div class="panel-body">
																<div class="dash-box-head">Sales (SAR)</div>
																<h6 class="no-margin">1,123</h6>
																<div class="clearfix"></div>
															</div>
															<div id="server-load"></div>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="panel agent-edit-main">
															<div class="agent-pic-section">
																 @if(isset($arr_data['profile_image']) && !empty($arr_data['profile_image']) && File::exists($user_profile_image_base_img_path.$arr_data['profile_image']))
																	<img src="{{$user_profile_image_public_img_path.$arr_data['profile_image']}}" alt="" />
					                                            @else
																	<img src="{{url('/')}}/assets/admin/assets/images/demo/images/blog1.jpg" alt="" />
					                                            @endif
															</div>
															<div class="agent-information-section">
																<div class="agent-information-main">
																	<div class="agent-information-head">
																		Name
																	</div>
																	<div class="agent-information-content">
																		<span>:</span> {{ $arr_data['agency_name'] ?? '-' }}
																	</div>
																</div>
																<div class="agent-information-main">
																	<div class="agent-information-head">
																		Joined
																	</div>
																	<div class="agent-information-content">
																		<span>:</span><?php echo  get_formated_date($arr_data['created_at'])?>
																	</div>																	
																</div>
																<div class="agent-information-main">
																	<div class="agent-information-head">
																		Contact
																	</div>
																	<div class="agent-information-content">
																		<span>:</span> {{ $arr_data['full_name'] ?? '-' }}
																	</div>
																</div>
																<div class="agent-information-main">
																	<div class="agent-information-head">
																		Email
																	</div>
																	<div class="agent-information-content">
																		<span>:</span> {{ $arr_data['email'] ?? '-' }}
																	</div>																	
																</div>	
																<div class="agent-information-main">
																	<div class="agent-information-head">
																		Mobile
																	</div>
																	<div class="agent-information-content">
																		<span>:</span> {{ $arr_data['mobile_number'] ?? '-' }}
																	</div>																	
																</div>														
																<div class="clearfix"></div>
															</div>	
															<div class="clearfix"></div>
														</div>
													</div>
												</div>
												<div class="row">													
													<div class="col-lg-6">
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
													<div class="col-lg-6">
														<div class="panel panel-flat panel-graph">
															<div class="panel-heading">
																<h6 class="panel-title text-semibold">Last 5 Month Sales</h6>
															</div>

															<div class="panel-body">
																<div class="chart-container text-center">
																	<div class="display-inline-block" id="c3-axis-tick-culling"></div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>

											<div class="tab-pane" id="account_information">
											<form action="{{ url('/') }}/admin/agent/update_agent/{{ base64_encode($arr_data['id']) }}" id="edit_agent" method="post" enctype="multipart/form-data" >
											{{csrf_field()}}
												<div class="row">
													<div class="col-sm-6 col-md-6 col-lg-6">
														<div class="form-group">												
															<label>Agency Name <i class="red" >*</i></label>
															<input type="text" data-rule-required="true" name="agency_name" id="agency_name" placeholder="Enter Full Name" class="form-control" value="{{ $arr_data['agency_name'] ?? '' }}">
														</div>
													</div>
													<div class="col-sm-6 col-md-6 col-lg-6">
														<div class="form-group">												
															<label>Contact Name <i class="red" >*</i></label>
															<input type="text" data-rule-required="true" name="contact_name" id="contact_name" placeholder="Enter Contact Name" class="form-control" value="{{ $arr_data['full_name'] ?? '' }}">
														</div>
													</div>
													<div class="col-sm-6 col-md-6 col-lg-6">
														<div class="form-group">												
															<label>Contact <i class="red" >*</i></label>
															<input type="text" data-rule-required="true" data-rule-number="true" name="contact_one" id="contact_one"  placeholder="Enter email" class="form-control" maxlength="13" value="{{ $arr_data['get_contact_details']['contact_one']  ?? ''}}">
														</div>
													</div>
													<div class="col-sm-6 col-md-6 col-lg-6">
														<div class="form-group">												
															<label>Contact 2 </label>
															<input type="text" name="contact_two" id="contact_two"  placeholder="Enter Contact" class="form-control" data-rule-number="true"  maxlength="13" value="{{ $arr_data['get_contact_details']['contact_two'] ?? ''}}">
														</div>
													</div>
													<div class="col-sm-6 col-md-6 col-lg-6">
														<div class="form-group">												
															<label>Email <i class="red" >*</i></label>
															<input type="text" data-rule-required="true" data-rule-email="true" name="email_one" id="email_one"  placeholder="Enter email" class="form-control" value="{{ $arr_data['get_contact_details']['email_one'] ?? ''}}" >
														</div>
													</div>
													<div class="col-sm-6 col-md-6 col-lg-6">
														<div class="form-group">												
															<label>Email 2</label>
															<input type="text"  data-rule-email="true" name="email_two" id="email_two"  placeholder="Enter email" class="form-control" value="{{ $arr_data['get_contact_details']['email_two'] ?? '' }}">
														</div>
													</div>
														<div class="col-sm-6 col-md-6 col-lg-6">	
														<div class="form-group">												
															<label>Mobile <i class="red" >*</i></label>
															<div class="mobile-drop-section-main" id="edit_select_code">
																<div class="mobile-drop-section-select">
																	<input type="hidden" name="country_id_one" id="country_id_one" class="form-control mobile_number_one">
																	<input type="hidden" name="country_id_one_flag" id="country_id_one_flag" class="form-control mobile_number_one">
																	{{--<select name="country_id_one" data-rule-required="true" id="country_id_one" class="form-control">	
																		@foreach($arr_country as $key_country_one => $value_country_one)
																			<option  {{(($value_country_one['id'] ?? '') == ($arr_data['get_contact_details']['country_id_one']??'')) ? 'selected' : '' }} value="{{$value_country_one['id'] ?? ''}}" >{{ $value_country_one['country_code'] ?? '' }}</option>
																		@endforeach
																	</select>--}}
																</div>
																<div class="mobile-drop-section-input">
																	<input type="text" placeholder="Enter mobile number" id="mobile_number_one" name="mobile_number_one" data-rule-required="true" data-rule-number="true" class="form-control mobile_number_one" autocomplete="off" maxlength="13"  value="{{ $arr_data['get_contact_details']['mobile_one'] ?? '' }}" >
																</div>
															</div>
														</div>
													</div>
													<div class="col-sm-6 col-md-6 col-lg-6">	
														<div class="form-group">												
															<label>Mobile 2</label>
															<div class="mobile-drop-section-main" id="edit_select_code">
																<div class="mobile-drop-section-select">
																	<input type="hidden" name="country_id_two" id="country_id_two" class="form-control mobile_number_two">
																	<input type="hidden" name="country_id_two_flag" id="country_id_two_flag" class="form-control mobile_number_two">
																	{{--<select name="country_id_two"  id="country_id_two" class="form-control">	
																		<option value="" >Select code</option>
																		@foreach($arr_country as $key_country_two => $value_country_two)
																			<option  {{(($value_country_two['id']??'') == ($arr_data['get_contact_details']['country_id_two']??'')) ? 'selected' : '' }} value="{{$value_country_two['id'] ??''}}" >{{ $value_country_two['country_code'] ?? '' }}</option>
																		@endforeach
																	</select>--}}
																</div>
																<div class="mobile-drop-section-input">
																	<input type="text" placeholder="Enter mobile number" id="mobile_number_two" name="mobile_number_two"  data-rule-number="true" class="form-control mobile_number_two" autocomplete="off"  maxlength="13" value="{{ $arr_data['get_contact_details']['mobile_two'] ?? '' }}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-sm-6 col-md-6 col-lg-6">				
														<div class="form-group">								
															<label>Country <i class="red" >*</i></label>
															<select data-rule-required="true" id="country" name="country" class="form-control">	
																@foreach($arr_sys_country as $key_sys_country => $value_sys_country )
																	<option  {{($value_sys_country['id'] == $arr_data['country_id']) ? 'selected' : '' }} value="{{$value_sys_country['id']}}" >{{ $value_sys_country['country_english_name'] ?? '' }}</option>
																@endforeach
															</select>									
														</div>	
													</div>
													<div class="col-sm-6 col-md-6 col-lg-6">
														<div class="form-group file-uploadSection-main">												
															<label>Company CR <i class="red" >*</i></label>

															@if(isset($arr_data['get_documents_details']['company_cr']) && !empty($arr_data['get_documents_details']['company_cr']) )
																<input type="file" class="file-input" value="{{ $agent_documents_public_img_path.$arr_data['get_documents_details']['company_cr']  ?? ''}}" name="company_cr" id="company_cr" >	
															@else
																<input type="file" class="file-input" name="company_cr" id="company_cr" data-rule-required="true">	
															@endif
															<span class="view-btn-upload"><i class="fal fa-eye"></i></span>			
														<label id="company_cr-error" class="error" for="company_cr"></label>			
														</div>	
													</div>
														<div class="col-sm-6 col-md-6 col-lg-6">				
														<div class="form-group">								
															<label>City <i class="red" >*</i></label>
															<select data-rule-required="true" id="city" name="city" class="form-control">	
																@foreach($arr_sys_city as $key_sys_city => $value_sys_city )
																	<option  {{($value_sys_city['id'] == $arr_data['city_id']) ? 'selected' : '' }} value="{{$value_sys_city['id']}}" >{{ $value_sys_city['city_english_name'] ?? '' }}</option>
																@endforeach
															</select>									
														</div>	
													</div>
													<div class="col-sm-6 col-md-6 col-lg-6">
														<div class="form-group file-uploadSection-main">												

															<label>License <i class="red" >*</i></label>

															@if(isset($arr_data['get_documents_details']['license']) && !empty($arr_data['get_documents_details']['license']) )
																<input type="file" class="file-input" name="license" id="license" value="{{ $agent_documents_public_img_path.$arr_data['get_documents_details']['license']  ?? ''}}" >
															@else
																<input type="file" class="file-input" name="license" id="license" data-rule-required="true">
															@endif	
															<span class="view-btn-upload"><i class="fal fa-eye"></i></span>	
															<label id="license-error" class="error" for="license"></label>			

														</div>	
													</div>
													<div class="col-sm-6 col-md-6 col-lg-6">
														<div class="form-group">												
															<label>Main Address <i class="red" >*</i></label>
															<textarea class="form-control" data-rule-required="true" name="address" id="address">{{ $arr_data['address'] ?? '' }}</textarea>
														</div>
													</div>
													<div class="col-sm-6 col-md-6 col-lg-6">
														<div class="form-group file-uploadSection-main">												
															<label>VAT reg <i class="red" >*</i></label>
															@if(isset($arr_data['get_documents_details']['vat_reg']) && !empty($arr_data['get_documents_details']['vat_reg']) )
																<input type="file" class="file-input"  name="vat_reg" id="vat_reg"  value="{{ $agent_documents_public_img_path.$arr_data['get_documents_details']['vat_reg']  ?? ''}}">
															@else
																<input type="file" class="file-input"  name="vat_reg" id="vat_reg" data-rule-required="true">
															@endif	
															<span class="view-btn-upload"><i class="fal fa-eye"></i></span>		
															<label id="vat_reg-error" class="error" for="vat_reg"></label>	
														</div>	
													</div>
													
													<div class="col-sm-6 col-md-6 col-lg-6">
														<div class="form-group">								
															<label>User Status</label> : 
															@if($arr_data['status']==1)
																<span id="user_status">Active</span>
															@else
																<span id="user_status">Blocked</span>
															@endif																												
														</div>
													</div>
												</div>
												<div class="update-btns-section">
													@if($arr_data['status']==1)													
														<a href="{{ $module_url_path }}/block/{{ base64_encode($arr_data['id']) }}" class="btn btn-primary"><span id="block-unblock" data-status="0">Block</span></a>
													@else
														<a href="{{ $module_url_path }}/unblock/{{ base64_encode($arr_data['id']) }}" class="btn btn-primary"><span id="block-unblock" data-status="0">Unblock</span></a>
													@endif
													<button type="submit" class="btn btn-primary">Update</button>
												</div>
											</form>
											</div>

											<div class="tab-pane" id="bank_details">
												<form action="{{ url('/') }}/admin/agent/update_agent_bank/{{ base64_encode($arr_data['id']) }}" id="edit_agent_bank" method="post" enctype="multipart/form-data" >
												{{csrf_field()}}
													<div class="row">
														<div class="col-sm-6 col-md-6 col-lg-6">
															<div class="form-group">												
																<label>Account Name <i class="red" >*</i></label>
																<input type="text" data-rule-required="true" name="account_name" id="account_name" placeholder="Enter Account Name" class="form-control" value="{{ $arr_data['get_bank_details']['account_name'] ?? '' }}">
															</div>
														</div>
														<div class="col-sm-6 col-md-6 col-lg-6">
															<div class="form-group">												
																<label>Account Number <i class="red" >*</i></label>
																<input type="text" data-rule-required="true" data-rule-number="true" name="account_number" id="account_number" placeholder="Enter Account Number" class="form-control" value="{{ $arr_data['get_bank_details']['account_number'] ?? '' }}" >
															</div>
														</div>
														<div class="col-sm-6 col-md-6 col-lg-6">
															<div class="form-group">												
																<label>Bank Name <i class="red" >*</i></label>
																<input type="text" data-rule-required="true" name="bank_name" id="bank_name" placeholder="Enter Bank Name" class="form-control" value="{{ $arr_data['get_bank_details']['bank_name'] ?? '' }}">
															</div>
														</div>
														<div class="col-sm-6 col-md-6 col-lg-6">
															<div class="form-group">												
																<label>IBAN number <i class="red" >*</i></label>
																<input type="text" data-rule-required="true" name="iban_number" id="iban_number" placeholder="Enter IBAN number" class="form-control" value="{{ $arr_data['get_bank_details']['iban_number'] ?? '' }}">
															</div>
														</div>

													</div>
													<div class="update-btns-section">													
														<button type="submit" class="btn btn-primary">Update</button>
													</div>
												</form>
											</div>

											<div class="tab-pane" id="agent_products">
													<div class="add-user-btn-main">
														<a class="btn btn-primary"  id="open_add_product_modal" href="javascript:void(0)">Add Product</a>
													</div>					
													
													<div id="modal_form_vertical" class="modal fade addUserModalMain">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header bg-primary">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<h5 class="modal-title">Add Product</h5>
																</div>
																<form action="{{ url('/') }}/admin/agent/store_agent_product" id="add_product" method="post" enctype="multipart/form-data" >
																{{csrf_field()}}
																	<div class="modal-body">
																	
																		<div class="row">
																			<div class="col-sm-6 col-md-6 col-lg-12">				
																				<div class="form-group">								
																					<label>Products <i class="red" >*</i></label>
																					<select data-rule-required="true" id="product" name="product" class="form-control">	
																					
																					</select>									
																				</div>	
																			</div>
																			<input type="hidden" name="agent_id" id="agent_id" value="{{ $arr_data['id'] ?? '' }}">
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
												<table class="table datatable-column-search-inputs" id="datatable_agent_products">
													<thead>
														<tr>
															<th>#</th>
															<th>Product ID
											                	<input type="text" name="product_id" placeholder="Search" class="search-block-new-table form-control column_filter">
											                </th>
											                <th>English Name
											                	<input type="text" name="product_english_name" placeholder="Search" class="search-block-new-table form-control column_filter">
											                </th>
											                <th>Arabic Name
											               <!--  	<input type="text" name="product_arabic_name" placeholder="Search" class="search-block-new-table form-control column_filter"> -->
											                </th>
											                <th>Sub-Category
											                	<!-- <input type="text" name="sub_category" placeholder="Search" class="search-block-new-table form-control column_filter"> -->
											                </th>
											                <th class="text-center">Actions</th>
											            </tr>
													</thead>
													<tbody>
													</tbody>
												</table>
											</div>
											<div class="tab-pane" id="agent_invoices">
												<table class="table datatable-column-search-inputs" id="datatable_agent_invoice">
													<thead>
														<tr>
															<th>#</th>
															<th>Invoice ID
											                	<!-- <input type="text" name="product_id" placeholder="Search" class="search-block-new-table form-control column_filter"> -->
											                </th>
											                <th>Date
											                </th>
											                <th>Value
											               <!--  	<input type="text" name="product_arabic_name" placeholder="Search" class="search-block-new-table form-control column_filter"> -->
											                </th>
											                <th>Total Orders
											                	<!-- <input type="text" name="sub_category" placeholder="Search" class="search-block-new-table form-control column_filter"> -->
											                </th>
											                <th>Reorder </th>
											                <th>Payment </th>
											                <th>Payment Date </th>
											                <th class="text-center">Invoice</th>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.all.js"></script>

<script>
	$(document).ready(function(){

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
		// $(".iti__selected-flag").on('click',function(){
			
		// })

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

		$("#edit_agent").validate();
		$("#edit_agent_bank").validate();

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

		/*Datatable for product TAB 4*/
		// $(".agent-managment-tabs-main").tabs({
		//     select: function(event, ui) {
		//         alert("PRESSED TAB!");
		//     }
		// });
		
		$('#add_product').validate();

		$('body').on('click','#view_agent_products',function(){
			var agent_id  = "{{ $arr_data['id'] ??''}}";
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

			    var table = $('#datatable_agent_products').DataTable({
			        "bStateSave": true,
			        "bSearchable":true,
			        "processing": true,
				    "serverSide": true,
				    "searchDelay": 350,
				    "autoWidth": false,
				    "bFilter": true,
				    "bLengthChange": true,
			        ajax: {
			            url: "{{ $module_url_path}}/load_agentproducts_data/"+btoa(agent_id),
			            data: function(d) {
			                d['column_filter[product_id]'] 				= $("input[name='product_id']").val()
			                d['column_filter[product_english_name]'] 	= $("input[name='product_english_name']").val()
			                d['column_filter[product_arabic_name]']   	= $("input[name='product_arabic_name']").val()
			                d['column_filter[sub_category]']       		= $("input[name='sub_category']").val()
			            }
			        },
			        columns: [
			           
			            {data : 'sr_no',"orderable":false,"searchable":false,name:'sr_no'},
			            {data : 'product_id',"orderable":false,"searchable":true,name:'product_id'},
			            {data : 'product_english_name',"orderable":false,"searchable":true,name:'product_english_name'},
			            {data : 'product_arabic_name',"orderable":false,"searchable":true,name:'product_arabic_name'},
			            {data : 'sub_category',"orderable":false,"searchable":false,name:'sub_category'},
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
			});
		});

		$('body').on('click','#open_add_product_modal',function(){

			var agent_id  = "{{ $arr_data['id'] ??''}}";
			 $.ajax({
	            url : '{{ url('/') }}/admin/agent/get_products/'+btoa(agent_id),
	            type : "GET",
	            dataType: 'JSON',
	            success:function(resp){
	                if(resp.status=='success'){
						$("#modal_form_vertical").modal('show');
	                    $('#product').html(resp.data);
	                }else if(resp.status=='error'){
	                    $("#modal_form_vertical").modal('hide');
	                    Swal.fire(
							  resp.status,
							  resp.msg,
							  resp.status
							)

	                }
	            }
	        })	
		});
		/*Datatable for product TAB 4*/

		/*TAB 5*/
		$('body').on('click','#view_agent_invoice',function(){
			var agent_id  = "{{ $arr_data['id'] ??''}}";
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

			    var table = $('#datatable_agent_invoice').DataTable({
			        "bStateSave": true,
			        "bSearchable":true,
			        "processing": true,
				    "serverSide": false,
				    "searchDelay": 350,
				    "autoWidth": false,
				    "bFilter": true,
				    "bLengthChange": true,
			        ajax: {
			            url: "{{ $module_url_path}}/load_agentinvoice_data/"+btoa(agent_id),
			            data: function(d) {
			                d['column_filter[invoice_id]'] 				= $("input[name='invoice_id']").val()
			                d['column_filter[invoice_amount]']   		= $("input[name='invoice_amount']").val()
			            }
			        },
			        columns: [
			            {data : 'sr_no',"orderable":false,"searchable":false,name:'sr_no'},
			            {data : 'invoice_id',"orderable":false,"searchable":true,name:'invoice_id'},
			            {data : 'created_at',"orderable":false,"searchable":true,name:'created_at'},
			            {data : 'invoice_amount',"orderable":false,"searchable":true,name:'invoice_amount'},
			            {data : 'total_orders',"orderable":false,"searchable":false,name:'total_orders'},
			            {data : 'reorders',"orderable":false,"searchable":false,name:'reorders'},
			            {data : 'payment_status',"orderable":false,"searchable":false,name:'payment_status'},
			            {data : 'payment_date',"orderable":false,"searchable":false,name:'payment_date'},
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
			});
		});
		/*TAB 5*/
		
	})	


	
</script>

<!-- Mirrored from demo.interface.club/limitless/layout_1/LTR/default/components_tabs.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 05:45:43 GMT -->
</html>
