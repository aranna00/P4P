@extends('layouts.app')

@section('content')
	<div class="mt-5 container">
		<div class="row mb-2">
			<div class="col-12">
				<div class="card px-0">
					<div class="card-header primary-color text-white text-center">
						Werknemers
					</div>
					<div class="card-block">
						<div class="table-responsive">
							<table class="table table-striped table-hover">
								<thead>
								<tr>
									<th>
										Naam
									</th>
									<th>
										Email
									</th>
									<th>
										Acties
									</th>
								</tr>
								</thead>
								<tbody>
								@foreach ($businessUsers as $businessUser)
									<tr>
										<td>
											{{ $businessUser->first_name }} {{ $businessUser->last_name }}
										</td>
										<td>
											{{ $businessUser->email }}
										</td>
										<td>
											@if($businessUser->id !== $user->id)<a class="btn btn-danger"><i
														class="fa fa-times"></i></a>@endif
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
						<div class="col-12 mx-auto text-center">
							<a class="btn btn-primary" href="">Werknemer toevoegen</a>
						</div>
					</div>
				</div>
			</div>
			<div id="" class="col-md-6 col-12 mt-2">
				<div class="card">
					<div class="card-header primary-color text-center white-text">
						Aflever adress
					</div>
					<div class="card-block">
						<div class="md-form">
							<input value="{{ $business->shipping->plaats }}" name="plaats[shipping]" type="text"
							       class="form-control" id="plaatsShipping">
							<label for="plaatsShipping" class="active">Plaats</label>
						</div>
						<div class="md-form">
							<input value="{{ $business->shipping->postcode }}" name="postcode[shipping]" type="text"
							       class="form-control" id="postcodeShipping">
							<label for="postcodeShipping" class="active">Postcode</label>
						</div>
						<div class="md-form">
							<input value="{{ $business->shipping->straat }}" name="straat[shipping]" type="text"
							       class="form-control" id="straatShipping">
							<label for="straatShipping" class="active">straat</label>
						</div>
						<div class="md-form">
							<input value="{{ $business->shipping->huisnummer }}" name="huisnummer[shipping]" type="text"
							       class="form-control" id="huisnummerShipping">
							<label for="huisnummerShipping" class="active">huisnummer</label>
						</div>
						<div class="md-form">
							<input value="{{ $business->shipping->huisnummertoevoeging }}"
							       name="huisnummertoevoeging[shipping]" type="text" class="form-control"
							       id="huisnummertoevoegingShipping">
							<label for="huisnummertoevoegingShipping" class="active">huisnummertoevoeging</label>
						</div>
						<div class="text-center mx-auto">
							<a class="btn btn-primary">Opslaan</a>
						</div>
					</div>
				</div>
			</div>
			<div id="" class="col-md-6 col-12 mt-2">
				<div class="card">
					<div class="card-header primary-color text-center white-text">
						Factuur adress
					</div>
					<div class="card-block">
						<div class="md-form">
							<input value="{{ $business->billing->plaats }}" name="plaats[billing]" type="text"
							       class="form-control" id="plaatsBilling">
							<label for="plaatsBilling" class="active">Plaats</label>
						</div>
						<div class="md-form">
							<input value="{{ $business->billing->postcode }}" name="postcode[billing]" type="text"
							       class="form-control" id="postcodeBilling">
							<label for="postcodeBilling" class="active">Postcode</label>
						</div>
						<div class="md-form">
							<input value="{{ $business->billing->straat }}" name="straat[billing]" type="text"
							       class="form-control" id="straatBilling">
							<label for="straatBilling" class="active">straat</label>
						</div>
						<div class="md-form">
							<input value="{{ $business->billing->huisnummer }}" name="huisnummer[billing]" type="text"
							       class="form-control" id="huisnummerBilling">
							<label for="huisnummerBilling" class="active">huisnummer</label>
						</div>
						<div class="md-form">
							<input value="{{ $business->billing->huisnummertoevoeging }}"
							       name="huisnummertoevoeging[billing]" type="text" class="form-control"
							       id="huisnummertoevoegingBilling">
							<label for="huisnummertoevoegingBilling" class="active">huisnummertoevoeging</label>
						</div>
						<div class="text-center mx-auto">
							<a class="btn btn-primary">Opslaan</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="card mt-1">
					<div class="card-header primary-color text-white text-center">
						Bedrijfs orders
					</div>
					<div class="card-block">
						{!! $orders->links() !!}
						<div class="table-responsive">
							<table class="table table-hover">
								<thead>
								<tr>
									<th>Order</th>
									<th>Order geplaatst</th>
									<th>Geplaatst door</th>
									<th>Afleverdatum</th>
									<th>Status</th>
									<th>Acties</th>
								</tr>
								</thead>
								<tbody>
								@if (count($orders) > 0)
									@foreach ($orders as $order)
										<tr>
											<td>{{ $order->id }}</td>
											<td>{{ $order->created_at }}</td>
											<td>{{ $order->user->first_name }}</td>
											<td>{{ $order->delivery }}</td>
											<td>{{ $order->processed?"Verwerkt":"Nog niet verwerkt" }}</td>
											<td>
												<a href="{{ action('OrderController@show', ["order"=>$order->id]) }}"
												   class="btn btn-sm btn-primary m-0">
													Bekijk order
												</a>
											</td>
										</tr>
									@endforeach
								@else
									<tr>
										<td colspan="5" class="text-center">
											Geen orders gevonden
										</td>
									</tr>
								@endif
								</tbody>
							</table>
						</div>
						{!! $orders->links() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
