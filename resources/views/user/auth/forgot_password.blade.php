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
               
                <div class="login-section-main">
                     @include('user.layout._operation_status')

                    <div class="login-head-section-main">
                        <span class="login-head-section">Forgot <span>Password</span></span>          
                        <div class="login-to-manage-txt">Forgot Password</div>
                    </div>
                    <div class="login-form-secton">
                         <form action="{{url('/')}}/user/send_password_link" method="POST" name="forgot_password" id="forgot_password">
                        {{ csrf_field()  }}                                                     
                            <div class="form-group">
                                <label class="form-label-seciton">Email<i class="red">*</i></label>
                                <input id="email" data-rule-required="true" data-rule-email="true" class="form-control" name="email" placeholder="Email" type="tel">
                                
                            </div>                          
                            <div class="dont-have-account-txt">
                                Back to login <a href="{{url('/')}}/user/login">Login</a>
                            </div>
                            <button type="submit" class="login-submit-btn fcbtn but-eft">Submit</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>        
    <!-- </div>       -->


<script type="text/javascript">
   $(document).ready(function(){
       $('#forgot_password').validate();
   });
</script>  

@endsection