<!DOCTYPE html>
<html>

<head>
	<title>Kroykari App</title>
	<meta charset="UTF-8">
	<meta name="keywords" content="">
	<meta name="author" content="Codemeg Solution Pvt. Ltd., info@codemeg.com">
	<meta name="url" content="http://codemeg.com">
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no" name="viewport">
	<!--css-->
    @include('layouts.css')
	<style>
		/*****************maintenance****************/

		.maintenance-page {
			position: relative;
			padding: 15px 0;
			background: #d9e2e7;
			min-height: 100vh;
		}

		.maintenance-page .body {
			text-align: center;
			max-width: 800px;
			margin: 0 auto;
			width: 100%;
			position: absolute;
			left: 50%;
			top: 50%;
			transform: translate(-50%, -50%);
			z-index: 1;
			padding: 20px;
			background: #fff;
			box-shadow: 0px 0px 15px 1px rgb(0 0 0 / 15%);
		}

		.maintenance-page .logo {
			width: 150px;
		}

		.maintenance-page .plug {
			width: 100%;
			margin: 40px 0;
		}

		.maintenance-page .txt {
			margin: 60px 0 0;
		}

		.maintenance-page h1 {
			font-size: 32px;
			font-weight: 500;
			color: #000000;
			margin: 0 0 20px;
		}

		.maintenance-page p {
			margin: 0 auto;
			font-size: 14px;
			color: #939393;
			max-width: 600px;
		}

		.maintenance-page .socila-account {
			margin: 15px 0px 0px;
			border-top: 1px solid #e7e7e7;
			padding: 20px 0 0;
		}

		.maintenance-page .socila-account ul {
			margin: 0 -5px;
			padding: 0;
			list-style: none;
		}

		.maintenance-page .socila-account ul li {
			display: inline-block;
			padding: 0 5px;
		}

		.maintenance-page .socila-account ul li a {
			display: inline-block;
			font-size: 22px;
			border: 1px solid transparent;
			color: #ababab;
			text-align: center;
			transition: all 0.3s;
		}

		@media screen and (max-width: 768px) {
			.maintenance-page .body {
				position: initial;
				transform: initial;
			}

			.maintenance-page h1 {
				font-size: 26px;
			}

			.maintenance-page .txt {
				margin: 50px 0 0;
			}
		}
	</style>
</head>

<body>

	@php 

	$config = \DB::table('config')->select('key','value')->get();
	
	foreach ($config as $key => $con) {
		  
		   if($con->key == 'facebook')
			  $facebook = $con->value;
		  
		   if($con->key == 'instagram')
			$instagram = $con->value;
		  
		   if($con->key == 'youtube')
			$youtube = $con->value;
		  
		   if($con->key == 'twitter')
			$twitter = $con->value;
	}

  @endphp

	<!--header start-->
	<section class="maintenance-page">
		<div class="container">
			<div class="body">
				<img class="logo" src="{{asset('public/frontend')}}/images/logo.png" alt="">
				<div class="txt">
					<h1><span>Oops!</span> Something went wrong.</h1>

					<p>We are very sorry for this inconvenience, We are currently working on something new and
						we will be back soon with awesome new feature. Thanks for your patience.</p>
					<img class="plug" src="{{asset('public/frontend')}}/images/mian.png" alt="">
					<div class="socila-account">
						<ul>
							<li><a href="{{$facebook}}" target="_blank"><i class="fab fa-facebook"></i></a></li>
							<li><a href="{{$youtube}}" target="_blank"><i class="fab fa-youtube"></i></a></li>
							<li><a href="{{$instagram}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
							<li><a href="{{$twitter}}" target="_blank"><i class="fab fa-twitter"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--end header-->

	<!--script-->
	@include('layouts.js')

</body>

</html>