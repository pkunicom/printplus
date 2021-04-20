@extends('user.layout.master')    
@section('main_content')


<style type="text/css">
    .red {
        color: red;
    }

</style>


<body>
    <div class="header-home login-header" id="header"></div>
    <!-- <div class="middle-section">         -->
        <div class="login-main-section">
            <div class="login-left-section">
               
                <div class="bottome-paturn-img-section"></div>
            </div>
            <div class="login-section-main">
                @include('user.layout._operation_status')

                <div class="login-head-section-main">
                    <span class="login-head-section">Welcome <span>back</span></span>          
                    <div class="login-to-manage-txt">Reset your password.</div>
                </div>
                <div class="login-form-secton">
                    <form action="{{url('/')}}/user/save_password/{{base64_encode($obj_data['id'])}}" method="POST" name="reset_password" id="reset_password">
                        {{ csrf_field()  }}
                        <div class="form-group password-show-section">
                            <label class="form-label-seciton">Password<i class="red">*</i></label>                            
                            <input type="password" name="password" id="password" minlength="8" maxlength="40" data-rule-required="true" class="form-control password-input" value="{{old('password')}}" placeholder="Password" />
                        </div>
                  
                        <div class="form-group password-show-section">
                            <label class="form-label-seciton">Confirm Password<i class="red">*</i></label>
                            <div class="forgot-password-btn">
                                {{-- <a href="{{url('/')}}/user/forgot_password">Forgot Password?</a> --}}
                            </div>
                            <input type="password" id="cpassword" name="cpassword" equalto="#password" data-rule-required="true" class="form-control password-input" placeholder="Confirm Password" />                            
                        </div>

                        <div class="dont-have-account-main">
{{--                             <div class="dont-have-account-txt">
                                Don't have an account? <a href="{{url('/')}}/user_signup">Signup</a>
                            </div> --}}
                            <button type="submit" class="login-submit-btn fcbtn but-eft">Submit</button>
                            <div class="clearfix"></div>
                        </div>

                        
                    </form>
                </div>
            </div>
        </div>        
    <!-- </div>         -->
    
<script type="text/javascript">
   $(document).ready(function(){
       $('#reset_password').validate();
   });
</script>

@endsection