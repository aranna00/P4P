{!! $products->withPath("/filter/".$parentId) !!}
@foreach($products as $product)
	
	<div class="list-group m-0">
		<div class="list-group-item list-group-item-action row px-0 mx-0">
			<div class="col-1">
				<img src="{{ asset("img/producten/".$product->code.".jpg") }}"
				     onerror="this.src='{{ asset("img/noimage.png") }}'"
				     style="max-height: 10vh" class="img-fluid">
			</div>
			
			<div class="col-6">
				<h5 class="mb-1">{{ $product->brand->name }} - {{ $product->name }}</h5>
				<small>{!! $product->description !!}</small>
			</div>
			<div class="col-3 text-center">
				<h5>€{{ number_format($product->price,2,",",".") }}</h5>
			
			</div>
			<div class="col-2 text-center">
				<button class="btn btn-large primary-color" href="#" data-toggle="modal"
				        data-target="#{{ $product->id }}">&nbsp;<i
							class="fa fa-fix fa-shopping-cart"></i>&nbsp;&nbsp;
				</button>
				<div class="dropdown">
					
					<!--Trigger-->
					<button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenu2"
					        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
								class="fa fa-fix fa-star"></i></button>
					
					<!--Menu-->
					<div class="dropdown-menu dropdown-danger">
						@foreach($wishlists as $wishlist)
							<a class="dropdown-item"
							   href="{{ action("WishlistController@add", ["product_id"=>$product->id, "wishlist_id"=>$wishlist->id ])}}">{{ $wishlist->name }}</a>
						@endforeach()
						<a class="dropdown-item"
						   href="{{ action("WishlistController@create")}}">+ Maak nieuwe lijst</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Central Modal Medium -->
	<div class="modal fade" id="{{ $product->id }}" tabindex="-1" role="dialog"
	     aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-notify modal-success" role="document">
			<!--Content-->
			<div class="modal-content">
				<!--Header-->
				<div class="modal-header">
					<p class="heading lead">Hoeveelheid</p>
					
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" class="white-text">&times;</span>
					</button>
				</div>
				
				<!--Body-->
				<form class="" action="{{ action("CartController@store") }}" method="post">
					<div class="modal-body mx-4 row">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="id" value="{{ $product->id }}">
						<table class="col-12">
							<thead>
							<tr>
								<th class="w-100">
									product
								</th>
								<th>
									aantal
								</th>
							</tr>
							</thead>
							<tr>
								<td>
									{{ $product->name }}
								</td>
								<td>
									<input name="amount"
									       onchange="updatePrice({{ $product->id }},{{ $product->price }},this.value)"
									       type="number" required value="1" min="0" max="1000">
								</td>
							</tr>
						</table>
						<div id="modal_price_{{ $product->id }}" class="ml-auto mr-0 mt-2">1 &times;
							€{{ number_format($product->price,2,',','.') }}
							= {{ number_format($product->price,2,',','.') }}</div>
					
					</div>
					
					<!--Footer-->
					<div class="modal-footer justify-content-center">
						<a type="button" class="btn btn-outline-secondary waves-effect"
						   data-dismiss="modal">Annuleren</a>
						<button type="submit" class="btn btn-primary">Voeg toe</button>
					</div>
				</form>
			</div>
			<!--/.Content-->
		</div>
	</div>
@endforeach
{!! $products->withPath("/filter/".$parentId) !!}

@if(count($products)===0)
	
	<div class="list-group">
		<div class="list-group-item list-group-item-action row px-0 mx-0">
			<div class="col-12">
				Er zijn geen producten gevonden met deze zoek criteria
			</div>
		</div>
	</div>

@endif