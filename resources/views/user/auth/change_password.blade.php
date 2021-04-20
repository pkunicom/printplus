@extends('user.layout.master')    
@section('main_content')

<style type="text/css">
    .red {
        color: red;
    }

</style>


<body>
    <div class="header-home login-header" id="header"></div>
    <div class="middle-section">        
        <div class="login-main-section">
                <div class="login-section-main">
                 @include('restaurant.layout._operation_status')
                    <div class="login-head-section-main">
                        <span class="login-head-section">Change <span>Password</span></span>          
                        <div class="login-to-manage-txt">Change Password</div>
                    </div>
                    <div class="login-form-secton">
                      <form action="{{url('/')}}/user/update_password" method="POST" name="change_password" id="change_password">
                        {{ csrf_field()  }}                                                   
                            <div class="form-group password-show-section">
                                <label class="form-label-seciton">Current Password<i class="red">*</i></label>
                                <input type="password" id="current_password" name="current_password" class="form-control" placeholder="Enter your current password" data-rule-required="true" > 
                            </div>  

                             <div class="form-group password-show-section">
                                <label class="form-label-seciton">New Password<i class="red">*</i></label>
                                <input type="password" id="new_password"  name="new_password" class="form-control" placeholder="Enter New password" validatepassword="true" data-rule-required="true" minlength="8" maxlength="40">
                            </div>  

                            <div class="form-group password-show-section">
                                <label class="form-label-seciton">Confirm Password<i class="red">*</i></label>
                                 <input type="password" id="confirm_password" name="confirm_password"  class="form-control" placeholder="Enter Confirm Password" data-rule-equalto = "#new_password" data-rule-required="true" validatepassword="true" autocomplete="off" >                               
                            </div>                            
                            <button type="submit" class="login-submit-btn">Submit</button>
                        </form>
                    </div>
                </div>
            </div>        
    </div>   

<script type="text/javascript">
   $(document).ready(function(){
       $('#change_password').validate();
   });
</script>     
    
@endsection