@extends('layouts.app')

@section('content')
	<div class="container-fluid mt-4 mx-2">
		
		<div class="row">
			
			<!-- Sidebar -->
			<div class="col-md-2 hidden-sm-down mt-2">
				@if(count($categories) > 0)
					<div class="card mb-1">
						<!-- Panel -->
						<div class="card-header">
							<h5 class="m-0"><strong>Categorie</strong></h5>
						</div>
						<div class="card-block p-3">
							<ul class="m-0">
								@foreach($categories as $category)
									<li>
										<a href="{{ action("ProductController@filtered", ["category"=>$category->id]) }}?page=1">{{ $category->name }}</a>
									</li>
								@endforeach
							</ul>
						</div>
					</div>
				@endif
				
				<div class="card mb-1">
					<!-- Panel -->
					<div class="card-header">
						<h5 class="m-0"><strong>Trefwoord</strong></h5>
					</div>
					<div class="card-block p-3">
						<div class="form-inline waves-effect waves-light">
							<input type="text" id="search" placeholder="Verfijnd zoeken" class="form-control">
						</div>
					</div>
				</div>
				
				
				<div class="card mb-1">
					<!-- Panel -->
					<div class="card-header">
						<h5 class="m-0"><strong>Merk</strong></h5>
					</div>
					<div class="card-block p-3">
						@foreach($brands as $brand)
							<div>
								<input type="checkbox" id="brand{{ $brand->id }}" class="brand-filter"
								       data-id="{{ $brand->id }}">
								<label for="brand{{ $brand->id }}">{{ $brand->name }}</label>
							</div>
						@endforeach
					</div>
				</div>
				
				<div class="card mb-1">
					<!-- Panel -->
					<div class="card-header">
						<h5 class="m-0"><strong>Prijs</strong></h5>
					</div>
					<div class="card-block p-3">
						<input id="priceRange"
						       name="Prijs"
						       title="Prijs">
					</div>
					<script>
                        document.addEventListener("DOMContentLoaded", function () {
                            loadRangeSliders("price", "#priceRange", "{{ $products->map(function ($item,$index){ return $item->price; })->min() }}", "{{ $products->map(function ($item,$index){ return $item->price; })->max() }}", {{ array_key_exists("price_from",$_REQUEST)?$_REQUEST["price_from"]:0 }}, {{ array_key_exists("price_to",$_REQUEST)?$_REQUEST["price_to"]:0 }});
                        });
					</script>
				</div>
				@if(Route::current()->getName() == 'filtered')
					@foreach($attribute_groups as $attribute_group)
						<div class="card mb-1">
							<!-- Panel -->
							<div class="card-header">
								<h5 class="m-0"><strong>{{ $attribute_group->name }}</strong></h5>
							</div>
							<div class="card-block p-3">
								<ul class="m-0">
									@if($attribute_group->type==="checkbox"||$attribute_group->type==="radio")
										@foreach($attribute_group->attributes as $attribute)
											<li>
												@if ($attribute_group->type === "checkbox")
													<input type="checkbox" id="checkbox{{ $attribute->id }}"
													       name="{{ $attribute_group->id }}[]" class="filter"
													       value="{{ $attribute->value }}">
													<label for="checkbox{{ $attribute->id }}">{{ $attribute->value }}</label>
												@elseif ($attribute_group->type === "radio")
													<input type="radio" id="radio{{ $attribute->id }}"
													       name="{{ $attribute_group->id }}" class="filter"
													       value="{{ $attribute->value }}">
													<label for="radio{{ $attribute->id }}">{{ $attribute->value }}</label>
												@endif
											</li>
										@endforeach
									@elseif($attribute_group->type==="range")
										<li>
											<input id="range{{ $attribute_group->id }}"
											       name="{{ $attribute_group->name }}"
											       title="{{ $attribute_group->name }}">
										</li>
										<script>
                                            document.addEventListener("DOMContentLoaded", function () {
                                                loadRangeSliders("{{ ($attribute_group->id) }}", "#range{{ $attribute_group->id }}", {{ $attribute_group->attributes->map(function($item,$index){ return $item->value; })->min() }}, {{ $attribute_group->attributes->map(function($item,$index){ return $item->value; })->max() }},{{ array_key_exists(($attribute_group->id)."_from",$_REQUEST)?$_REQUEST[($attribute_group->id)."_from"]:0 }},{{ array_key_exists(($attribute_group->id)."_to",$_REQUEST)?$_REQUEST[($attribute_group->id)."_to"]:0 }});
                                            });
										</script>
									@elseif($attribute_group->type==="slider")
										<li>
											<input id="slider{{ $attribute_group->id }}"
											       name="{{ $attribute_group->name }}"
											       title="{{ $attribute_group->name }}">
										</li>
										<script>
                                            document.addEventListener("DOMContentLoaded", function () {
                                                loadSliders("{{ ($attribute_group->id) }}", "#slider{{ $attribute_group->id }}", 0, 100,{{ array_key_exists(($attribute_group->id)."_to",$_REQUEST)?$_REQUEST[($attribute_group->id)."_to"]:0 }});
                                            });
										</script>
									@endif
								</ul>
							</div>
						</div>
					@endforeach
				
				@endif
			
			</div>
			<!-- /.Sidebar -->
			
			<!-- Content -->
			<div class="col-md-10 my-2">
				
				<ol class="breadcrumb mx-0">
					<li class="breadcrumb-item"><a href="{{route('product')}}">Producten</a></li>
					@if(isset($breadcrumbs))
						@foreach(array_reverse($breadcrumbs) as $breadcrumb)
							<li class="breadcrumb-item"><a
										href="{{ action("ProductController@filtered", $breadcrumb[0]) }}">{{ $breadcrumb[1] }}</a>
							</li>
						@endforeach
					@endif
				</ol>
				<div class="card row pt-1 mx-0 mb-1">
					<div class="col-md-3">
						<select id="perPage" class="mdb-select">
							<option value="10">10</option>
							<option {{ array_key_exists("perPage",$_REQUEST)?$_REQUEST["perPage"]==25?"selected":"":"" }} value="25">
								25
							</option>
							<option {{ array_key_exists("perPage",$_REQUEST)?$_REQUEST["perPage"]==50?"selected":"":"" }} value="50">
								50
							</option>
							<option {{ array_key_exists("perPage",$_REQUEST)?$_REQUEST["perPage"]==100?"selected":"":"" }} value="100">
								100
							</option>
						</select>
						<label for="perPage">
							Producten per pagina
						</label>
					</div>
					<div class="float-md-right col-md-3">
						<select id="sorting" class="mdb-select">
							<option value="name_asc">Naam (A - Z)</option>
							<option value="name_desc">Naam (Z - A)</option>
							<option value="price_asc">Prijs oplopend</option>
							<option value="price_desc">Prijs aflopend</option>
						</select>
						<label for="sorting">
							Sorteren
						</label>
					</div>
				</div>
				<div id="filtered_products">
					<i class='fa fa-5x fa-spinner fa-spin'></i>
				</div>
			</div>
			<!-- /.Filter Area -->
		</div>
		<!-- /.Content -->
	
	</div>

@endsection

@section("scripts")
	
	<script>

        $(document).ready(function () {
            $('.mdb-select').material_select();
            $("#search").change(function () {
                updateQueryStringParam("search", $(this).prop("value"));
                loadProducts();
            });
            $("#perPage").change(function () {
                updateQueryStringParam("perPage", $(this).prop("value"));
                loadProducts();
            });
            $("#sorting").change(function () {
                var value = $(this).prop("value").split("_");
                updateQueryStringParam("sorting", value[1]);
                updateQueryStringParam("type", value[0]);
                loadProducts();
            });
            if (getUrlParameter("brands") !== undefined) {
                var selectedBrands = getUrlParameter("brands").split(",");
                $(".brand-filter").each(function () {
                    if (selectedBrands.indexOf($(this).data("id").toString()) !== -1) {
                        $(this).prop("checked", "checked");
                    }
                });
            }
            $(".brand-filter").click(function () {
                var test = [];
                $(".brand-filter:checked").each(function () {
                    test.push($(this).data("id"));
                });
                updateQueryStringParam("brands", test);
                loadProducts();
            });
            $(".filter").click(function () {
                filterChanged($(this))
            });
            loadProducts();
        });

        var brandFilterChanged = function (that) {

        };
        var filterChanged = function (that) {
            console.log(that.prop("value"));
            updateQueryStringParam(that.prop("name"), that.prop("value"));
        };
        function loadRangeSliders(name, sliderId, min, max, currentFrom, currentTo) {
            $(sliderId).ionRangeSlider({
                type: "double",
                min: min,
                max: max,
                from_max: max - 1,
                to_min: min + 1,
                force_edges: true,
                grid: true,
                onFinish: function (data) {
                    updateQueryStringParam(name + "_from", data.from);
                    updateQueryStringParam(name + "_to", data.to);
                    loadProducts();
                },
                onStart: function (data) {
                    if (currentTo === 0) {
                        data.to = max;
                        data.from = min;
                    }
                    else {
                        data.from = currentFrom;
                        data.to = currentTo;
                    }
                }
            });
        }
        function loadSliders(name, sliderId, min, max, currentTo) {
            $(sliderId).ionRangeSlider({
                min: min,
                max: max,
                to: max,
                force_edges: true,
                grid: true,
                onFinish: function (data) {
                    updateQueryStringParam(name + "_to", data.from);
                    loadProducts();
                },
                onStart: function (data) {
                    if (currentTo === 0) {
                        data.from = min;
                    }
                    else {
                        data.from = currentTo;
                    }
                }
            })
        }
        function loadProducts() {
            var baseUrl = [location.protocol, '//', location.host, location.pathname].join(''),
                urlQueryString = document.location.search @if(isset($parent_id)) + "&parent={{ $parent_id }}" @endif;
            var filtered_products = $("#filtered_products");
            var baseAjaxUrl = "@if(isset($parent_id)){{ action("ProductController@filtered_products") }}@else{{ action("ProductController@filtered_products") }}@endif";
            $.ajax({
                url: baseAjaxUrl + urlQueryString,
                data: {},
                success: function (result) {
                    filtered_products.html("");
                    filtered_products.html(result);
                },
                beforeSend: function () {
                    filtered_products.addClass("loading");
                },
                error: function (result) {
                    toastr["error"](result.statusText, result.status);
                },
                complete: function () {
                    filtered_products.removeClass("loading");
                }
            });
        }
        var updateQueryStringParam = function (key, value) {
            var baseUrl = [location.protocol, '//', location.host, location.pathname].join(''),
                urlQueryString = document.location.search,
                newParam = key + '=' + value,
                params = '?' + newParam;

            // If the "search" string exists, then build params from it
            if (urlQueryString) {
                keyRegex = new RegExp('([\?&])' + key + '[^&]*');

                // If param exists already, update it
                if (urlQueryString.match(keyRegex) !== null) {
                    params = urlQueryString.replace(keyRegex, "$1" + newParam);
                } else { // Otherwise, add it to end of query string
                    params = urlQueryString + '&' + newParam;
                }
            }
            window.history.replaceState({}, "", baseUrl + params);
        };
        var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = decodeURIComponent(window.location.search.substring(1)),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : sParameterName[1];
                }
            }
        };
	</script>

@endsection