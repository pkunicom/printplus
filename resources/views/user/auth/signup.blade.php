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
        <div class="login-main-section signup-main-section">
           
            <div class="login-section-main">
                 @include('user.layout._operation_status')

                
                <div class="login-head-section-main">
                    <span class="login-head-section">Welcome to <span>FoodsPal</span></span>          
                    <div class="login-to-manage-txt">Fill out the form to get started.</div>
                </div>
                <div class="login-form-secton">
                    <form action="{{url('/')}}/user_signup_store" method="POST" name="user_signup" id="user_signup">
                        {{ csrf_field()  }}
                        <div class="form-group password-show-section">
                            <label class="form-label-seciton">Email<i class="red">*</i></label>                            
                            <input type="email" name="email_address" data-rule-required="true" data-rule-email="true" data-rule-pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"  data-rule-pattern-message="test" class="form-control password-input" value="{{old('email_address')}}" placeholder="Email"  />
                        </div>                                                                                   
                        <div class="form-group">
                            <label class="form-label-seciton">Mobile Number</label>
                            <input id="phone" class="form-control" data-rule-number="true" name="mobile_number" placeholder="Mobile Number" value="{{old('mobile_number')}}" type="tel" maxlength="16">
                        </div>

                        <div class="form-group password-show-section">
                            <label class="form-label-seciton">Full Name<i class="red">*</i></label>
                            <input type="text" class="form-control password-input" name="full_name" data-rule-required="true" placeholder="Full Name" value="{{old('full_name')}}" maxlength="60"/>
                        </div>

                        <div class="form-group password-show-section">
                            <label class="form-label-seciton">Password<i class="red">*</i></label>
                            <input type="password" data-rule-required="true" class="form-control password-input" name="password" placeholder="Password" minlength="8" maxlength="40" id="password"/>
                        </div>

                        <div class="form-group password-show-section">
                            <label class="form-label-seciton">Confirm Password<i class="red">*</i></label>
                            <input type="password" data-rule-required="true" class="form-control password-input" minlength="8" maxlength="40" equalto="#password" placeholder="Confirm Password"  name="cpassword" id="cpassword" placeholder="Confirm Password" />
                        </div>
                        <div class="check-box">
                            <input id="filled-in-box" class="filled-in" type="checkbox">
                            <label for="filled-in-box">I agree to the <a href="{{url('/')}}/terms_conditions">Terms and Conditions</a></label>
                                <span id="error_terms" class="error"></span>                           
                        </div> 
                        <div class="dont-have-account-main already-have-account-section">
                            <div class="dont-have-account-txt">
                                Already have an account? <a href="{{url('/')}}/user/login">Login</a>
                            </div>
                            <button type="submit" id="proceed" class="login-submit-btn fcbtn but-eft">Get Started</button>
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
<!--                             <div class="form-group">
                                <a class="login-with-linkedin-btn google-button-section" href="javascript:void(0)"><i class="fa fa-google"></i> Login with Google</a>
                            </div>  -->                                                                             
                        </div>                    
                    </form>
                </div>
            </div>
        </div>        
    <!-- </div>         -->
    


<script type="text/javascript">
   $(document).ready(function(){
       $('#user_signup').validate();
   });
</script>


<script type="text/javascript">
  $("form").submit(function(){

    var checkbox = $('.filled-in').is(':checked')
    
    if(checkbox==false)
    {
        $('#error_terms').html('Please select terms conditions');
        return false;
    } 

    if($("#user_signup").valid()==true)
    {
        $("#proceed").html("<b><i class='fa fa-spinner fa-spin'></i></b> Processing...");
        $("#proceed").attr('disabled', true);
    }
    else
    {
        event.preventDefault();
    }
      
}); 
</script>

@endsection