 @if(Session::has('success'))
  <div class="alert bg-success alert-styled-left" id="message">
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
      {{ Session::get('success') }}
  </div>

@endif  

@if(Session::has('error'))
  <div class="alert bg-danger alert-styled-left" id="message">
      <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
         {{ Session::get('error') }}
  </div>

@endif

@if(Session::has('warning'))
  <div class="alert bg-warning alert-styled-left" id="message">
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
       {{ Session::get('warning') }}
  </div>
@endif

@if(Session::has('success_password'))
  <div class="alert bg-success" id="message">
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
    {{ Session::get('success_password') }}
  </div>
@endif  

@if(Session::has('error_password'))
 <div class="alert bg-danger" id="message">
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
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
