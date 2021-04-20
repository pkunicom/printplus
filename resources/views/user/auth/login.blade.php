@extends('user.layout.master')    
@section('main_content')
<style type="text/css">
    .red {color: red;}
</style>
<body>
    <div class="header-home login-header" id="header"></div>
    <!--<div class="middle-section">-->
        <div class="login-main-section">
            <div class="login-left-section">               
                <div class="bottome-paturn-img-section"></div>
            </div>
            <div class="login-section-main">
                @include('user.layout._operation_status')

                <div class="login-head-section-main">
                    <span class="login-head-section">Welcome <span>back</span></span>          
                    <div class="login-to-manage-txt">Login to manage your account.</div>
                </div>
                <div class="login-form-secton">
                    <form action="{{url('/')}}/user_validate_login" method="POST" name="user_login" id="user_login">
                        {{ csrf_field()  }}
                        <div class="form-group password-show-section">
                            <label class="form-label-seciton">Email<i class="red">*</i></label>                            
                            <input type="text" name="email_address" data-rule-email="true" id="email_address" data-rule-required="true" class="form-control password-input" value="{{old('email_address')}}" placeholder="Email" />
                        </div>
                  
                        <div class="form-group password-show-section">
                            <label class="form-label-seciton">Password<i class="red">*</i></label>
                            <div class="forgot-password-btn">
                                <a href="{{url('/')}}/user/forgot_password">Forgot Password?</a>
                            </div>
                            <input type="password" id="password" name="password" data-rule-required="true" class="form-control password-input" placeholder="Password" />                            
                        </div>

                        <div class="dont-have-account-main">
                            <div class="dont-have-account-txt">
                                Don't have an account? <a href="{{url('/')}}/user/signup">Signup</a>
                            </div>
                            <button type="submit" class="login-submit-btn fcbtn but-eft">Sign In</button>
                            <div class="clearfix"></div>
                        </div>

                        <div class="login-or-section-block">
                            <span class="or-text-section-block">OR</span>
                        </div>   
                        <div class="login-with-section">
                            <div class="form-group">
                                <a class="login-with-linkedin-btn fcbtn but-eft" href="{{url('/')}}/linkedin/redirect"><i class="fab fa-linkedin-in"></i> Login with Linkedin</a>
                            </div>                                              
                            <div class="form-group">
                                <a class="login-with-linkedin-btn facebook-button-section fcbtn but-eft" href="{{url('/')}}/facebook/redirect"><i class="fab fa-facebook-f"></i> Login with Facebook</a>
                            </div>         
                            <!-- <button class="fcbtn but-eft basic-but">Button</button>                                  -->
<!--                             <div class="form-group">
                                <a class="login-with-linkedin-btn google-button-section" href="{{url('/')}}/google/redirect"><i class="fa fa-google"></i> Login with Google</a>
                            </div>  -->                                                                             
                        </div>
                    </form>
                </div>
            </div>
        </div>        
    <!-- </div>         -->
    
<script type="text/javascript">
   $(document).ready(function(){
       $('#user_login').validate();
   });
</script>

@endsection