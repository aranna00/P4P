<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
	<title>{{ config('app.name', 'Laravel') }}</title>
	
	<!-- Styles -->
	{{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/mdb.css') }}" rel="stylesheet">

</head>
<body>
	<div id="app">
		
		<!-- SideNav slide-out button -->
		<a href="#" data-activates="slide-out" class="button-collapse"><i class="fa fa-bars"></i></a>
		<!--/. SideNav slide-out button -->
		
		<!-- Sidebar navigation -->
		<ul id="slide-out" class="side-nav fixed sn-bg-1 custom-scrollbar">
			<!-- Logo -->
			<li>
				<div class="logo-wrapper waves-light">
					<a href="#"><img src="https://mdbootstrap.com/img/logo/mdb-transparent.png" class="img-fluid flex-center"></a>
				</div>
			</li>
			<!--/. Logo -->
			<!--Social-->
			<li>
				<ul class="social">
					<li><a class="icons-sm fb-ic"><i class="fa fa-facebook"> </i></a></li>
					<li><a class="icons-sm pin-ic"><i class="fa fa-pinterest"> </i></a></li>
					<li><a class="icons-sm gplus-ic"><i class="fa fa-google-plus"> </i></a></li>
					<li><a class="icons-sm tw-ic"><i class="fa fa-twitter"> </i></a></li>
				</ul>
			</li>
			<!--/Social-->
			<!--Search Form-->
			<li>
				<form class="search-form" role="search">
					<div class="form-group waves-light">
						<input type="text" class="form-control" placeholder="Search">
					</div>
				</form>
			</li>
			<!--/.Search Form-->
			<!-- Side navigation links -->
			<li>
				<ul class="collapsible collapsible-accordion">
					<li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-chevron-right"></i> Submit blog<i class="fa fa-angle-down rotate-icon"></i></a>
						<div class="collapsible-body">
							<ul>
								<li><a href="#" class="waves-effect">Submit listing</a>
								</li>
								<li><a href="#" class="waves-effect">Registration form</a>
								</li>
							</ul>
						</div>
					</li>
					<li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-hand-pointer-o"></i> Instruction<i class="fa fa-angle-down rotate-icon"></i></a>
						<div class="collapsible-body">
							<ul>
								<li><a href="#" class="waves-effect">For bloggers</a>
								</li>
								<li><a href="#" class="waves-effect">For authors</a>
								</li>
							</ul>
						</div>
					</li>
					<li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-eye"></i> About<i class="fa fa-angle-down rotate-icon"></i></a>
						<div class="collapsible-body">
							<ul>
								<li><a href="#" class="waves-effect">Introduction</a>
								</li>
								<li><a href="#" class="waves-effect">Monthly meetings</a>
								</li>
							</ul>
						</div>
					</li>
					<li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-envelope-o"></i> Contact me<i class="fa fa-angle-down rotate-icon"></i></a>
						<div class="collapsible-body">
							<ul>
								<li><a href="#" class="waves-effect">FAQ</a>
								</li>
								<li><a href="#" class="waves-effect">Write a message</a>
								</li>
							</ul>
						</div>
					</li>
				</ul>
			</li>
			<!--/. Side navigation links -->
			<div class="sidenav-bg mask-strong"></div>
		</ul>
		<!--/. Sidebar navigation -->
	@yield("content")
	</div>
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
	<script src="{{ asset('js/tether.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/mdb.min.js') }}"></script>
</body>