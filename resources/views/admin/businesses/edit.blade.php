@extends("admin.layouts.app")

@section("breadcrumbs")
	
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<i class="fa fa-home"></i>
			<a href="{{ action("Admin\HomeController@index") }}">Beheer</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ action("Admin\BusinessController@index") }}">Klanten</a>
		</li>
		<li class="breadcrumb-item active">
			<a href="">{{ $business->kvk }}</a>
		</li>
	</ol>

@endsection


@section("content")
	<form action="{{ action("Admin\BusinessController@update",["business"=>$business->id]) }}" method="post">
		{!! method_field("put") !!}
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header primary-color text-center white-text">
						{{ $business->kvk }} - {{ $business->bestaandehandelsnaam }}
					</div>
					<div class="admin-panel">
						<div class="col-md-12">
							<div class="card-block">
								{!! csrf_field() !!}
								<div class="md-form">
									<input type="text" id="kvk-nummer" name="kvk" value="{{ $business->kvk }}"
									       class="form-control">
									<label for="kvk-nummer" class="control-label">KVK nummer</label>
									<a class="btn btn-danger" href="{{ action("Admin\BusinessController@index") }}">Terug</a>
								</div>
							</div>
							<div class="md-form">
								<input value="{{ $business->relatie_nummer }}" name="relatienummer" type="text"
								       class="form-control"
								       id="relatienummer" required>
								<label for="relatienummer" class="active">Relatie nummer</label>
							</div>
							<div class="md-form">
								<input value="{{ $business->bestaandehandelsnaam }}" name="bestaandehandelsnaam"
								       type="text" class="form-control"
								       id="bestaandehandelsnaam">
								<label for="bestaandehandelsnaam" class="active">Bestaande handelsnaam</label>
							</div>
							<div class="md-form">
								<input value="{{ $business->subdossiernummer }}" name="subdossiernummer" type="number"
								       class="form-control"
								       id="subdossiernummer" min="0" max="99999999">
								<label for="subdossiernummer" class="active">Vestegings nummer</label>
							</div>
							<div class="md-form">
								<input value="{{ $business->handelsnaam }}" name="handelsnaam" type="text"
								       class="form-control" id="handelsnaam">
								<label for="handelsnaam" class="active">Handelsnaam</label>
							</div>
							<div class="md-form">
								<input value="{{ $business->statutairehandelsnaam }}" name="statutairehandelsnaam"
								       type="text" class="form-control"
								       id="statutairehandelsnaam">
								<label for="statutairehandelsnaam" class="active">Statutaire handelsnaam</label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="" class="bedrijfInfo  col-md-6 col-12 mt-2">
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
					</div>
				</div>
			</div>
			<div id="" class="bedrijfInfo  col-md-6 col-12 mt-2">
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
					</div>
				</div>
			</div>
			<div class="col-12 mt-1 bedrijfInfo  mb-5">
				<div class="card">
					<div class="align-content-center mx-auto">
						<button class="btn btn-primary" value="Opslaan">Opslaan</button>
						<a class="btn btn-danger"
						   href="{{ action("Admin\BusinessController@index") }}">Annuleren</a>
					</div>
				</div>
			</div>
		</div>
	</form>

@endsection