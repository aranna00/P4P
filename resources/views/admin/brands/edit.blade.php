@extends("admin.layouts.app")

@section("breadcrumbs")
	
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<i class="fa fa-home"></i>
			<a href="{{ action("Admin\HomeController@index") }}">Beheer</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ action("Admin\CategoryController@index") }}">Merken</a>
		</li>
		<li class="breadcrumb-item active">
			<a href="">{{ $brand->name }}</a>
		</li>
	</ol>

@endsection


@section("content")
	
	<div class="">
		<div class="card">
			<div class="card-header primary-color text-center white-text">
				{{ $brand->name }}
			</div>
			<div class="admin-panel">
				<div class="col-md-12">
					<div class="card-block pt-0">
						<form class="mt-3" action="{{ action("Admin\BrandController@update",["brand"=>$brand->id]) }}" method="post">
							{!! csrf_field() !!}
							{!! method_field("put") !!}
							<div class="md-form">
								<input type="text" id="name" name="name" value="{{ $brand->name }}" class="form-control">
								<label for="name" class="control-label">Merk naam</label>
							</div>
							<div class="md-form">
								<span class="mb-3 small text-area-label">Beschrijving</span>
								<textarea placeholder="Beschrijving" type="text" id="description" name="description" class="">
									{{ $brand->description }}
								</textarea>
							</div>
							<button class="btn btn-primary" value="Opslaan">Opslaan</button>
							<a class="btn btn-danger" href="{{ action("Admin\BrandController@index") }}">Annuleren</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection

@section("scripts")
	<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
	<script>
        $(document).ready(function () {
            CKEDITOR.replace("description",{
                language: 'nl',
            });
            $('.mdb-select').material_select();
        });
	</script>

@endsection