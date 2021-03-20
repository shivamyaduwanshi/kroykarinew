<script type="text/javascript" src="{{asset('frontend')}}/js/jquery.min.js"></script>
<script type="text/javascript" src="{{asset('frontend')}}/js/owl.carousel.min.js"></script>
<script src="{{asset('frontend')}}/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="{{asset('frontend')}}/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{asset('frontend')}}/js/custom.js"></script>
<script type="text/javascript" src="{{asset('frontend')}}/js/viewer.js"></script>
<script type="text/javascript" src="{{asset('frontend')}}/js/viewer_main.js"></script>
<script type="text/javascript" src="{{asset('frontend')}}/js/toastr.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-messaging.js"></script>
<script type="text/javascript">
		$('input[name="price"]').keypress(function(eve) {
	  if ((eve.which != 46 || $(this).val().indexOf('.') != -1) && (eve.which < 48 || eve.which > 57) || (eve.which == 46 && $(this).caret().start == 0)) {
	    eve.preventDefault();
	     }

		  // this part is when left part of number is deleted and leaves a . in the leftmost position. For example, 33.25, then 33 is deleted
		  $('input[name="price"]').keyup(function(eve) {
		    if ($(this).val().indexOf('.') == 0) {
		      $(this).val($(this).val().substring(1));
		    }
		  });

		});
		
	  $('select[name="lang"]').on('change',function(e){
	  	 console.log(e.target.value);
	  	  window.location.href = "{{route('changeLanguage')}}" + '?lang=' + e.target.value;
	  });
</script>


