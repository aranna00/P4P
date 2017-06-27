@extends("admin.layouts.app")

@section("breadcrumbs")
	
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<i class="fa fa-home"></i>
			<a href="{{ action("Admin\HomeController@index") }}">Beheer</a>
		</li>
		<li class="breadcrumb-item active">
			<a href="{{ action("Admin\BusinessController@index") }}">Klanten</a>
		</li>
	</ol>

@endsection


@section("content")
	
	<div class="col-md-12">
		<div class="card">
			<div class="card-header primary-color text-center white-text">
				Alle Bedrijven
			</div>
			<div class="admin-panel info-admin-panel">
				<div class="col-md-12">
					<div class="card-block pt-0">
						<div class="table-responsive">
							<table class="table table-striped table-hover">
								<thead>
								<tr>
									<th>KVK nummer</th>
									<th>Naam</th>
									<th>Relatie nummer</th>
									<th>Vactuur adres</th>
									<th>Lever adres</th>
									<th>Aangemaakt op</th>
									<th>Acties</th>
								</tr>
								</thead>
								<tbody>
								@foreach($businesses as $business)
									<tr>
										<td>
											{{ $business->kvk }}
										</td>
										<td>
											{!! $business->bestaandehandelsnaam !!}
										</td>
										<td>
											{{ $business->relatie_nummer }}
										</td>
										<td>
											{{ $business->billing->postcode }} {{ $business->billing->plaats }}
										</td>
										<td>
											{{ $business->shipping->postcode }} {{ $business->shipping->plaats }}
										</td>
										<td>
											{{ $business->created_at }}
										</td>
										<td>
											<form id="delete{{ $business->id }}"
											      action="{{ action("Admin\BusinessController@destroy", ["brand"=>$business->id]) }}"
											      method="post">
												{!! csrf_field() !!}
												{!! method_field("delete") !!}
												<a class="btn btn-primary"
												   href="{{ action("Admin\BusinessController@edit",["product"=>$business->id]) }}">
													<i class="fa fa-pencil"></i>
												</a>
												<a class="btn btn-danger"
												   onclick="if (confirm('Weet u het zeker')){ {$('#delete{{ $business->id }}').submit();} }"><i
															class="fa fa-times"></i></a>
											</form>
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
						{!! $businesses->links() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<a class="btn-floating btn-large secondary-color" style="position: fixed; bottom: 45px; right: 24px;"
	   href="{{ action("Admin\BusinessController@create") }}">
		<i class="fa"><b>+</b></i>
	</a>
@endsection