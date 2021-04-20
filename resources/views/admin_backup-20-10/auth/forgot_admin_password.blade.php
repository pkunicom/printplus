<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.interface.club/limitless/layout_1/LTR/default/login_password_recover.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 05:59:05 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Printplus</title>

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
    <script type="text/javascript" src="assets/js/core/app.js"></script>
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

         <div class="navbar-collapse collapse" id="navbar-mobile">
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
        </div> 
    </div>
-->
    <!-- /main navbar -->


    <!-- Page container -->
    <div class="page-container admin-login-bx">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Content area -->
                <div class="content">
                    <!-- Password recovery -->
                    <form  id="recoverform" method="post"  action="{{url('/')}}/admin/forgot_password/post_email">
                            {{csrf_field()}}
                        <div class="panel panel-body login-form">
                   @include('admin.layout._operation_status')
                            <div class="text-center">
                                <div class="icon-object border-warning text-warning"><i class="icon-spinner11"></i></div>
                                <h5 class="content-group">Password recovery <small class="display-block">We'll send you instructions in email</small></h5>
                            </div>

                            <div class="form-group has-feedback">
                                <input class="form-control" type="text" name="email" id="reset_email" data-rule-required="true" required="" data-rule-email="true" placeholder="Enter email">
                                <div class="form-control-feedback">
                                    <i class="icon-mail5 text-muted"></i>
                                </div>
                            </div>

                            <button type="submit" class="btn bg-blue btn-block">Reset password <i class="icon-arrow-right14 position-right"></i></button>
                             <div class="text-center">
                                <a href="{{ url('/') }}/admin"><- Go back to login</a>
                            </div>
                        </div>
                    </form>
                    <!-- /password recovery -->


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
        $('#recoverform').validate();
    });
</script>
</body>

<!-- Mirrored from demo.interface.club/limitless/layout_1/LTR/default/login_password_recover.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 05:59:05 GMT -->
</html>
