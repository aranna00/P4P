@extends("admin.layouts.app")

@section("breadcrumbs")
	
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<i class="fa fa-home"></i>
			<a href="{{ action("Admin\HomeController@index") }}">Beheer</a>
		</li>
		<li class="breadcrumb-item active">
			<a href="{{ action("Admin\BrandController@index") }}">Merken</a>
		</li>
	</ol>

@endsection


@section("content")
	
	<div class="col-md-12">
		<div class="card">
			<div class="card-header primary-color text-center white-text">
				Alle Merken
			</div>
			<div class="admin-panel info-admin-panel">
				<div class="col-md-12">
					<div class="card-block pt-0">
						<div class="table-responsive">
							<table class="table table-striped table-hover">
								<thead>
								<tr>
									<th>Naam</th>
									<th>Aanmaakdatum</th>
									<th>Acties</th>
								</tr>
								</thead>
								<tbody>
								@foreach($brands as $brand)
									<tr>
										<td>
											{{ $brand->name }}
										</td>
										<td>
											{{ $brand->created_at }}
										</td>
										<td>
											<form id="delete{{ $brand->id }}" action="{{ action("Admin\BrandController@destroy", ["brand"=>$brand->id]) }}" method="post" class="btn-group">
												{!! csrf_field() !!}
												{!! method_field("delete") !!}
												<a class="btn btn-primary"
												   href="{{ action("Admin\BrandController@edit",["$brand"=>$brand->id]) }}">
													<i class="fa fa-pencil"></i>
												</a>
												<a class="btn btn-danger" onclick="if (confirm('Weet u het zeker')){ {$('#delete{{ $brand->id }}').submit();} }"><i class="fa fa-times"></i></a>
											</form>
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
						{!! $brands->links() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<a class="btn-floating btn-large primary-color" style="position: fixed; bottom: 45px; right: 24px;"
	   href="{{ action("Admin\BrandController@create") }}">
		<i class="fa"><b>+</b></i>
	</a>
@endsection