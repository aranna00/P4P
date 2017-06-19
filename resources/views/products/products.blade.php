{!! $products->withPath("/filter/".$parentId) !!}
@foreach($products as $product)
	
	<div class="list-group">
		<div class="list-group-item list-group-item-action row px-0 mx-0">
			<div class="col-1">
				<img src="http://www.supermarktaanbiedingen.com/public/images/product/2014/34/90411-4-57.jpg"
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
				<a class="btn btn-large primary-color" href="#"><i
							class="fa fa-fix fa-shopping-cart"></i></a>
				<a class="btn btn-large red"><i class="fa fa-fix fa-star"></i></a>
			</div>
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