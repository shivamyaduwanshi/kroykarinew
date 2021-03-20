	<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/css/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset('/public/frontend')}}/css/style.css">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/css/responsive.css">
	<link rel="stylesheet" href="{{asset('frontend')}}/css/jquery.mCustomScrollbar.css" />
	<!--font awesome 4-->
	<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/fonts/fontawesome/css/all.min.css">
	<link rel="shortcut icon" href="{{asset('frontend')}}/images/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="{{asset('frontend')}}/css/viewer.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/viewer_main.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/toastr.min.css">
    <script type="text/javascript">
    	 function profileImgError(image) {
			image.onerror = "";
			image.src = "{{asset('public/backend/images/user-default-image.png')}}";
			return true;
		 }

		 function imgError(image) {
			image.onerror = "";
			image.src = "{{asset('public/backend/images/image-not-found.jpg')}}";
			return true;
		 }

		 

    </script>

    