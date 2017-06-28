@extends("admin.layouts.app")

@section("breadcrumbs")
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<i class="fa fa-home"></i>
			<a href="{{ action("Admin\HomeController@index") }}">Beheer</a>
		</li>
		<li class="breadcrumb-item active">
			<a href="{{ action("Admin\OrderController@index") }}">Bestellingen</a>
		</li>
		<li class="breadcrumb-item active">
			<a href="{{ action("Admin\OrderController@products") }}">Bestellingen voorbereiden</a>
		</li>
	</ol>
@endsection

@section("content")
	<div class="col-md-12">
		<div class="card">
			<div class="card-header primary-color text-center white-text">
				Bestellingen voorbereiden
			</div>
			<div class="admin-panel info-admin-panel">
				<div class="col-md-12">
					<div class="card-block pt-0">
						<div class="table-responsive">
							<table class="table table-striped table-hover">
								<thead>
								<tr>
									<th>Naam</th>
									<th>Merk</th>
									<th>Aantal</th>
									<th>Acties</th>
								</tr>
								</thead>
								<tbody>
								@foreach($products as $product)
									<tr>
										<td>
											{{ $product->code }} - {{ $product->name }}
										</td>
										<td>
											{{ $product->brand->name }}
										</td>
										<td>
											{{ $product->orders->map(function($order, $index){ return $order->pivot->amount; })->sum() }}
										</td>
										<td>
											<fieldset class="form-group">
												<input type="checkbox" class="done" id="done">
												<label for="done">Ligt klaar</label>
											</fieldset>
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
						{{--{!! $products->links() !!}--}}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section("scripts")
	
	<script>
        $(".done").change(function () {
            var row = $(this).parent().parent().parent();
            if (row.hasClass("isDone")) {
                row.removeClass("isDone");
            }
            else {
                row.addClass("isDone");
            }
        });
	</script>

@endsection