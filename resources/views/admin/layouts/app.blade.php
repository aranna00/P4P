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
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
{{--	<link href="{{ asset('css/mdb.css') }}" rel="stylesheet">--}}
	<link href="{{ asset('css/compiled.min.css') }}" rel="stylesheet">

</head>
<body class="fixed-sn cyan-skin">
<div id="app">
	<header>
		<!-- Sidebar navigation -->
		<ul id="slide-out" class="side-nav fixed mobile-nofixed custom-scrollbar">
			<!-- Logo -->
			<li>
				<div>
					<img src="{{ asset("img/jansma_logo.png") }}" class="img-fluid flex-center p-4">
				</div>
			</li>
			<!--/. Logo -->
			<!-- Side navigation links -->
			<li>
				<ul class="collapsible collapsible-accordion">
					<li>
						<a class="collapsible-header waves-effect arrow-r">
							Categoriën
							<i class="fa fa-angle-down rotate-icon"></i>
						</a>
						<div class="collapsible-body">
							<ul>
								<li>
									<a href="#" class="waves-effect">Categorie aanmaken</a>
								</li>
								<li>
									<a href="#" class="waves-effect">Alle categoriën</a>
								</li>
							</ul>
						</div>
					</li>
				</ul>
			</li>
			<li>
				<ul class="collapsible collapsible-accordion">
					<li>
						<a class="collapsible-header waves-effect arrow-r">
							Producten
							<i class="fa fa-angle-down rotate-icon"></i>
						</a>
						<div class="collapsible-body">
							<ul>
								<li>
									<a href="#" class="waves-effect">Product aanmaken</a>
								</li>
								<li>
									<a href="#" class="waves-effect">Alle producten</a>
								</li>
							</ul>
						</div>
					</li>
				</ul>
			</li>
			<li class="nav-item waves-effect">
				<a class="nav-link">Categoriën</a>
			</li>
		</ul>
		<!--/. Sidebar navigation -->
		<nav class="navbar fixed-top navbar-toggleable-md navbar-dark scrolling-navbar double-nav">
			<!-- SideNav slide-out button -->
			<div class="float-left">
				<a href="#" data-activates="slide-out" class="button-collapse"><i class="fa fa-bars"></i></a>
			</div>
			<!-- Breadcrumb-->
			<div class="breadcrumb-dn mr-auto">
				<p>Breadcrumb or page title</p>
			</div>
			<ul class="nav navbar-nav nav-flex-icons ml-auto">
				<li class="nav-item">
					<a class="nav-link"><i class="fa fa-envelope"></i> <span
								class="hidden-sm-down">Contact</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link"><i class="fa fa-comments-o"></i> <span class="hidden-sm-down">Support</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link"><i class="fa fa-user"></i> <span class="hidden-sm-down">Account</span></a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
					   aria-haspopup="true" aria-expanded="false">
						Dropdown
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="#">Action</a>
						<a class="dropdown-item" href="#">Another action</a>
						<a class="dropdown-item" href="#">Something else here</a>
					</div>
				</li>
			</ul>
		</nav>
	</header>
	@yield("content")
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('js/tether.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/mdb.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $(".button-collapse").sideNav();
    });
</script>
</body>