<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.interface.club/limitless/layout_1/LTR/default/login_simple.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 05:59:05 GMT -->
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
    <script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/core/libraries/jquery.validate.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->


    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ asset('assets/admin') }}/assets/js/core/app.js"></script>
    <!-- /theme JS files -->

</head>

<body class="login-container">

    <!-- Main navbar -->
<!--
    <div class="navbar navbar-inverse">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.html"><img src="assets/images/logo_light.png" alt=""></a>

            <ul class="nav navbar-nav pull-right visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            </ul>
        </div>
-->
<!-- Commented by webwing -->
<!--         <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#">
                        <i class="icon-display4"></i> <span class="visible-xs-inline-block position-right"> Go to website</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="icon-user-tie"></i> <span class="visible-xs-inline-block position-right"> Contact admin</span>
                    </a>
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-cog3"></i>
                        <span class="visible-xs-inline-block position-right"> Options</span>
                    </a>
                </li>
            </ul>
        </div> -->
<!--    </div>-->
    <!-- /main navbar -->


    <!-- Page container -->
    <div class="page-container admin-login-bx">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Content area -->
                <div class="content">
                    <!-- Simple login form -->
                    <form action="{{url($admin_panel_slug.'/validate_login')}}"  id="loginform" method="post">
                        {{csrf_field()}}
                        <div class="panel panel-body login-form">
                            @include('admin.layout._operation_status')
                            <div class="text-center 22">
<!--                                <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>-->
                               
                              <img src="{{ asset('assets/admin') }}/assets/images/logo_light.png" alt="">
                               
                                <h5 class="content-group">Login to your account <small class="display-block">Enter your credentials below</small></h5>
                            </div>

                            <div class="form-group has-feedback has-feedback-left">
                                <input class="form-control" type="text" name="email" id="email" data-rule-required="true" data-rule-email="true" required="" value="" placeholder="Enter your Email address">
                                <!-- <label id="email-error" style="color:red" class="error" for="email"></label> -->
                                <div class="form-control-feedback">
                                    <i class="icon-user text-muted"></i>
                                </div>
                            </div>

                            <div class="form-group has-feedback has-feedback-left">
                                <input class="form-control" type="password" name="password" id="password" data-rule-required="true" required="" value="" placeholder="Enter Password">
                                <!-- <label id="password-error" style="color:red" class="error" for="password"></label> -->
                                <div class="form-control-feedback">
                                    <i class="icon-lock2 text-muted"></i>
                                </div>
                            </div>
                             <div class="text-center forgot-text">
                                <a href="{{ url('/') }}/admin/forgot_admin_password">Forgot password?</a>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 position-right"></i></button>
                            </div>

                           
                        </div>
                    </form>
                    <!-- /simple login form -->


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
    <script type="text/javascript">
        $(document).ready(function(){
            $('#loginform').validate();
        });
    </script>

</body>

<!-- Mirrored from demo.interface.club/limitless/layout_1/LTR/default/login_simple.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 05:59:05 GMT -->
</html>
