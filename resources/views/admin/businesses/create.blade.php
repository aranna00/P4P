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
			<a href="">Aanmaken</a>
		</li>
	</ol>

@endsection


@section("content")
	<form action="{{ action("Admin\BusinessController@store") }}" method="post">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header primary-color text-center white-text">
						Klant toevoegen
					</div>
					<div class="admin-panel">
						<div class="col-md-12">
							<div class="card-block">
								{!! csrf_field() !!}
								<div class="md-form">
									<input type="text" id="kvk-nummer" name="kvk" class="form-control">
									<label for="kvk-nummer" class="control-label">KVK nummer</label>
									<a class="btn btn-primary" id="checkDossierNummer"><i
												class="fa fa-refresh fa-spin hidden-xl-down" id="kvkCheckLoading"></i>
										Zoek op KVK.nl</a>
									<a class="btn btn-secondary" id="noKVK">Geen kvk nummer</a>
									<a class="btn btn-danger" href="{{ action("Admin\BusinessController@index") }}">Terug</a>
								</div>
								<div class="md-form hiddendiv" id="dossierGroup">
									<label for="selectDossierNummer" class="control-label">Selecteer dossier
										nummer</label>
									<div class="">
										<select id="selectDossierNummer" class="form-control"></select>
										<div class="help-block">
											<a class="btn btn-primary" id="dossierNummerSelect"><i
														class="fa fa-refresh fa-spin hidden-xl-down"
														id="dossierNummerLoading"></i> Selecteer KVK Nummer</a>
										</div>
									</div>
								</div>
								<div class="md-form hiddendiv" id="subDossierGroup">
									<label for="selectSubDossierNummer" class="control-label">Selecteer sub-dossier
										nummer</label>
									<div class="">
										<select id="selectSubDossierNummer" class="form-control">
										</select>
										<div class="help-block">
											<a class="btn btn-primary" id="subDossierNummerSelect"><i
														class="fa fa-refresh fa-spin hidden-xl-down"
														id="subDossierNummerLoading"></i> Selecteer KVK Sub
												Nummer</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					
					</div>
				</div>
			</div>
			<div class="hiddendiv bedrijfInfo col-12 mt-2">
				<div class="card">
					<div class="card-block">
						<div class="md-form">
							<input value=" " name="relatienummer" type="text" class="form-control"
							       id="relatienummer" required>
							<label for="relatienummer" class="active">Relatie nummer</label>
						</div>
						<div class="md-form">
							<input value=" " name="bestaandehandelsnaam" type="text" class="form-control"
							       id="bestaandehandelsnaam">
							<label for="bestaandehandelsnaam" class="active">Bestaande handelsnaam</label>
						</div>
						<div class="md-form">
							<input value="0" name="subdossiernummer" type="number" class="form-control"
							       id="subdossiernummer" min="0" max="99999999">
							<label for="subdossiernummer" class="active">Vestegings nummer</label>
						</div>
						<div class="md-form">
							<input value=" " name="handelsnaam" type="text" class="form-control" id="handelsnaam">
							<label for="handelsnaam" class="active">Handelsnaam</label>
						</div>
						<div class="md-form">
							<input value=" " name="statutairehandelsnaam" type="text" class="form-control"
							       id="statutairehandelsnaam">
							<label for="statutairehandelsnaam" class="active">Statutaire handelsnaam</label>
						</div>
					</div>
				</div>
			</div>
			<div id="" class="bedrijfInfo hiddendiv col-md-6 col-12 mt-2">
				<div class="card">
					<div class="card-header primary-color text-center white-text">
						Aflever adress
					</div>
					<div class="card-block">
						<div class="md-form">
							<input value=" " name="plaats[shipping]" type="text" class="form-control"
							       id="plaatsShipping">
							<label for="plaatsShipping" class="active">Plaats</label>
						</div>
						<div class="md-form">
							<input value=" " name="postcode[shipping]" type="text" class="form-control"
							       id="postcodeShipping">
							<label for="postcodeShipping" class="active">Postcode</label>
						</div>
						<div class="md-form">
							<input value=" " name="straat[shipping]" type="text" class="form-control"
							       id="straatShipping">
							<label for="straatShipping" class="active">straat</label>
						</div>
						<div class="md-form">
							<input value=" " name="huisnummer[shipping]" type="text" class="form-control"
							       id="huisnummerShipping">
							<label for="huisnummerShipping" class="active">huisnummer</label>
						</div>
						<div class="md-form">
							<input value=" " name="huisnummertoevoeging[shipping]" type="text" class="form-control"
							       id="huisnummertoevoegingShipping">
							<label for="huisnummertoevoegingShipping" class="active">huisnummertoevoeging</label>
						</div>
					</div>
				</div>
			</div>
			<div id="" class="bedrijfInfo hiddendiv col-md-6 col-12 mt-2">
				<div class="card">
					<div class="card-header primary-color text-center white-text">
						Factuur adress
					</div>
					<div class="card-block">
						<div class="md-form">
							<input value=" " name="plaats[billing]" type="text" class="form-control" id="plaatsBilling">
							<label for="plaatsBilling" class="active">Plaats</label>
						</div>
						<div class="md-form">
							<input value=" " name="postcode[billing]" type="text" class="form-control"
							       id="postcodeBilling">
							<label for="postcodeBilling" class="active">Postcode</label>
						</div>
						<div class="md-form">
							<input value=" " name="straat[billing]" type="text" class="form-control" id="straatBilling">
							<label for="straatBilling" class="active">straat</label>
						</div>
						<div class="md-form">
							<input value=" " name="huisnummer[billing]" type="text" class="form-control"
							       id="huisnummerBilling">
							<label for="huisnummerBilling" class="active">huisnummer</label>
						</div>
						<div class="md-form">
							<input value=" " name="huisnummertoevoeging[billing]" type="text" class="form-control"
							       id="huisnummertoevoegingBilling">
							<label for="huisnummertoevoegingBilling" class="active">huisnummertoevoeging</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 mt-1 bedrijfInfo hiddendiv mb-5">
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

@section("scripts")
	<script>
        $("#noKVK").click(function () {
            $(".bedrijfInfo").removeClass("hiddendiv");
        });
        var selectDossierNummer = $("#selectDossierNummer");
        var selectSubDossierNummer = $("#selectSubDossierNummer");
        $("#checkDossierNummer").click(function () {
            $.ajax({
                method: "POST",
                url: "{{ action("Admin\BusinessController@checkRegisterNumber") }}",
                data: {
                    dossierNummer: $("#kvk-nummer").prop("value"),
                    pageSize: 250,
                    _token: "{{ csrf_token() }}",
                },
                success: function (data) {
                    if (data["message"] !== undefined) {
                        toastr["error"](data.message);
                    }
                    else {
                        selectDossier(data);
                    }
                },
                beforeSend: function () {
                    console.log("start");
                    $("#kvkCheckLoading").removeClass("hidden-xl-down");
                },
                complete: function () {
                    $("#kvkCheckLoading").addClass("hidden-xl-down");
                    console.log("end");
                }
            })
        });
        selectDossierNummer.change(function () {
            getSubDossiers(selectDossierNummer.find(":selected").prop("value"));
        });
        selectSubDossierNummer.change(function () {
            kvkNummer = selectDossierNummer.find(":selected").prop("value");
            subDossierNummer = selectSubDossierNummer.find(":selected").prop("value");
            fillInfo(kvkNummer, subDossierNummer);
        });
        $("#dossierNummerSelect").click(function () {
            getSubDossiers(selectDossierNummer.find(":selected").prop("value"));
        });
        $("#subDossierNummerSelect").click(function () {
            kvkNummer = selectDossierNummer.find(":selected").prop("value");
            subDossierNummer = selectSubDossierNummer.find(":selected").prop("value");
            fillInfo(kvkNummer, subDossierNummer);
        });

        function selectDossier(data) {
            selectDossierNummer.find("option").remove().end();
            $.each(data, function (index, value) {
                selectDossierNummer.append($("<option />").val(index).text(index + " - " + value.handelsNaam + " (" + value.subDossiers + ")"));
            });
            if (selectDossierNummer.length === 1) {
                getSubDossiers(selectDossierNummer.find(":selected").prop("value"));
            }
            $("#dossierGroup").removeClass("hiddendiv");
        }

        function getSubDossiers(kvkNummer) {
            $.ajax({
                url: "{{ action("Admin\BusinessController@getRegisterNumber") }}",
                data: {
                    dossierNummer: kvkNummer,
                    _token: "{{ csrf_token() }}",
                },
                success: function (data) {
                    fillSelectSubDossier(data);
                },
                beforeSend: function () {
                    $("#dossierNummerLoading").removeClass("hidden-xl-down");
                },
                complete: function () {
                    $("#dossierNummerLoading").addClass("hidden-xl-down");
                }
            })
        }

        function fillSelectSubDossier(data) {
            selectSubDossierNummer.find("option").remove().end();
            $.each(data, function (index, value) {
                if (value.actief) {
                    selectSubDossierNummer.append($("<option />").val(value.subdossiernummer).text(value.subdossiernummer + " - " + value.plaats + " (" + value.straat + ")"));
                }
                else {
                    selectSubDossierNummer.append($("<option />").val(value.subdossiernummer).text(value.subdossiernummer + " - " + value.plaats + " (" + value.straat + ") - " + value.status).prop("disabled", true));
                }
            });
            $("#subDossierGroup").removeClass("hiddendiv");
            kvkNummer = selectDossierNummer.find(":selected").prop("value");
            subDossierNummer = selectSubDossierNummer.find(":selected").prop("value");
            fillInfo(kvkNummer, subDossierNummer);
        }

        function fillInfo(kvkNummer, subDossierNummer) {
            $("#kvk-nummer").prop("value", kvkNummer);
            $.ajax({
                url: "{{ action("Admin\BusinessController@getFullRegisterInfo") }}",
                data: {
                    dossierNummer: kvkNummer,
                    subDossierNummer: subDossierNummer,
                    _token: "{{ csrf_token() }}",
                },
                success: function (data) {
                    if (!selectSubDossierNummer.find(":selected").prop("disabled")) {
                        $("#bestaandehandelsnaam").prop("value", data.bestaandehandelsnaam);
                        $("#dossiernummer").prop("value", data.dossiernummer);
                        $("#subdossiernummer").prop("value", data.subdossiernummer);
                        $("#handelsnaam").prop("value", data.handelsnaam);
                        $("#statutairehandelsnaam").prop("value", data.statutairehandelsnaam);

                        $("#plaatsBilling").prop("value", data.plaats);
                        $("#plaatsShipping").prop("value", data.plaats);

                        $("#postcodeBilling").prop("value", data.postcode);
                        $("#postcodeShipping").prop("value", data.postcode);

                        $("#straatBilling").prop("value", data.straat);
                        $("#straatShipping").prop("value", data.straat);

                        $("#huisnummerBilling").prop("value", data.huisnummer);
                        $("#huisnummerShipping").prop("value", data.huisnummer);

                        $("#huisnummertoevoegingBilling").prop("value", data.huisnummertoevoeging);
                        $("#huisnummertoevoegingShipping").prop("value", data.huisnummertoevoeging);

                        $("#handelsnaam_urlBilling").prop("value", data.handelsnaam_url);
                        $("#handelsnaam_urlShipping").prop("value", data.handelsnaam_url);

                        $("#straat_urlBilling").prop("value", data.straat_url);
                        $("#straat_urlShipping").prop("value", data.straat_url);
                    }
                }
            });
            $(".bedrijfInfo").removeClass("hiddendiv");
            $("input:submit").prop("disabled", false);
        }

        $(document).ready(function () {
            $("#bestaandehandelsnaam").change(function () {
                console.log($(this).prop("value"));
            })
        })
	</script>

@endsection