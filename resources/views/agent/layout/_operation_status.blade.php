 @if(Session::has('success'))
 <div class="alert alert-success alert-dismissible" id="message">
  <a href="#" class="close close-btn1" data-dismiss="alert" aria-label="close">&times;</a>
  {{ Session::get('success') }}
</div>
@endif  

@if(Session::has('error'))
<div class="alert alert-danger alert-dismissible" id="message">
 <a href="#" class="close close-btn1" data-dismiss="alert" aria-label="close">&times;</a>
 {{ Session::get('error') }}
</div>
@endif

@if(Session::has('warning'))
 <div class="alert alert-warning alert-dismissible" id="message">
  <a href="#" class="close close-btn1" data-dismiss="alert" aria-label="close">&times;</a>
  {{ Session::get('warning') }}
</div>
@endif

@if(Session::has('success_password'))
<div class="alert alert-success alert-dismissible" id="message">
 <a href="#" class="close close-btn" data-dismiss="alert" aria-label="close">&times;</a>
 {{ Session::get('success_password') }}
</div>
@endif  

@if(Session::has('error_password'))
<div class="alert alert-danger alert-dismissible" id="message">
  <a href="#" class="close close-btn" data-dismiss="alert" aria-label="close">&times;</a>
  {{ Session::get('error_password') }}
</div>
@endif


<script type="text/javascript">
  setTimeout(function() {
    $('#message').fadeOut('fast');
}, 6000); 
</script>

<style type="text/css">
  .close-btn
  {
    padding: 10px!important;
  }

  .close-btn1
  {
    padding-top: 2px;
    padding-right: 10px;
  }

</style>
