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
	<link href="{{ asset('ckeditor/contents.css') }}" rel="stylesheet">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body class="fixed-sn cyan-skin">
<div id="app">
	<header>
		<!-- Sidebar navigation -->
		<ul id="slide-out" class="side-nav fixed mobile-nofixed custom-scrollbar">
			<!-- Logo -->
			<li>
				<div>
					<a class="waves-effect waves-light logo-wrapper" href="{{ action("HomeController@index") }}">
						<img src="{{ asset("img/jansma_logo.png") }}" class="img-fluid flex-center p-4">
					</a>
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
									<a href="{{ action("Admin\CategoryController@create") }}" class="waves-effect">Categorie aanmaken</a>
								</li>
								<li>
									<a href="{{ action("Admin\CategoryController@index") }}" class="waves-effect">Alle categoriën</a>
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
									<a href="{{ action("Admin\ProductController@create") }}" class="waves-effect">Product aanmaken</a>
								</li>
								<li>
									<a href="{{ action("Admin\ProductController@index") }}" class="waves-effect">Alle producten</a>
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
							Merken
							<i class="fa fa-angle-down rotate-icon"></i>
						</a>
						<div class="collapsible-body">
							<ul>
								<li>
									<a href="{{ action("Admin\BrandController@create") }}" class="waves-effect">Merk aanmaken</a>
								</li>
								<li>
									<a href="{{ action("Admin\BrandController@index") }}" class="waves-effect">Alle merken</a>
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
							Product eigenschappen
							<i class="fa fa-angle-down rotate-icon"></i>
						</a>
						<div class="collapsible-body">
							<ul>
								<li>
									<a href="{{ action("Admin\AttributeGroupController@create") }}" class="waves-effect">Eigenschap aanmaken</a>
								</li>
								<li>
									<a href="{{ action("Admin\AttributeGroupController@index") }}" class="waves-effect">Alle eigenschappen</a>
								</li>
							</ul>
						</div>
					</li>
				</ul>
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
				@yield("breadcrumbs")
			</div>
			<ul class="nav navbar-nav nav-flex-icons ml-auto">
			
			</ul>
		</nav>
	</header>
	<main>
		<div class="container-fluid">
			@yield("content")
		</div>
	</main>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('js/tether.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/mdb.min.js') }}"></script>
<script src="{{ asset('js/toastr.js') }}"></script>
<script>
    $(document).ready(function () {
        $(".button-collapse").sideNav();
    });
</script>
{!! Toastr::render() !!}
@yield("scripts")
</body>
</html>
