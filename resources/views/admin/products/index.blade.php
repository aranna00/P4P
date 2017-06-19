@extends("admin.layouts.app")

@section("breadcrumbs")
	
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<i class="fa fa-home"></i>
			<a href="{{ action("Admin\HomeController@index") }}">Beheer</a>
		</li>
		<li class="breadcrumb-item active">
			<a href="{{ action("Admin\ProductController@index") }}">Producten</a>
		</li>
	</ol>

@endsection


@section("content")
	
	<div class="col-md-12">
		<div class="card">
			<div class="card-header primary-color text-center white-text">
				Alle producten
			</div>
			<div class="admin-panel info-admin-panel">
				<div class="col-md-12">
					<div class="card-block pt-0">
						<div class="table-responsive">
							<table class="table table-striped table-hover">
								<thead>
								<tr>
									<th>Naam</th>
									<th>Beschrijving</th>
									<th>Merk</th>
									<th>Prijs</th>
									<th>Momenteel beschibaar</th>
									<th>Aangemaakt op</th>
									<th>Acties</th>
								</tr>
								</thead>
								<tbody>
								@foreach($products as $product)
									<tr>
										<td>
											{{ $product->name }}
										</td>
										<td>
											{!! $product->description !!}
										</td>
										<td>
											{{ $product->brand->name }}
										</td>
										<td>
											{{ $product->price }}
										</td>
										<td>
											{{ $product->isAvailable()?"Ja":"Nee" }}
										</td>
										<td>
											{{ $product->created_at }}
										</td>
										<td>
											<form id="delete{{ $product->id }}"
											      action="{{ action("Admin\ProductController@destroy", ["brand"=>$product->id]) }}"
											      method="post">
												{!! csrf_field() !!}
												{!! method_field("delete") !!}
												<a class="btn btn-primary"
												   href="{{ action("Admin\ProductController@edit",["product"=>$product->id]) }}">
													<i class="fa fa-pencil"></i>
												</a>
												<a class="btn btn-danger"
												   onclick="if (confirm('Weet u het zeker')){ {$('#delete{{ $product->id }}').submit();} }"><i
															class="fa fa-times"></i></a>
											</form>
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
						{!! $products->links() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Button trigger modal -->
	<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#basicExample">
		Launch demo modal
	</button>
	
	<!-- Modal -->
	<div class="modal fade" id="basicExample" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	     aria-hidden="true">
		<div class="modal-dialog" role="document">
			<!--Content-->
			<div class="modal-content">
				<!--Header-->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title w-100" id="myModalLabel">Modal title</h4>
				</div>
				<!--Body-->
				<div class="modal-body">
					...
				</div>
				<!--Footer-->
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
			<!--/.Content-->
		</div>
	</div>
	<!-- Modal -->
	
	
	
	<a class="btn-floating btn-large secondary-color" style="position: fixed; bottom: 45px; right: 24px;"
	   href="{{ action("Admin\ProductController@create") }}">
		<i class="fa"><b>+</b></i>
	</a>
@endsection