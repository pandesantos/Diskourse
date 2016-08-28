@if(Session::has('info'))
	<div class="alert alert-info" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   
   {{ Session::get('info') }}

    </div>
    <!--Automatic alert box-->
     <script type="text/javascript">
             window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                 $(this).remove(); 

            });
            }, 5000);
    </script>
@endif
