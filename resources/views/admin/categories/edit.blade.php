@extends("admin.layouts.app")

@section("breadcrumbs")
	
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<i class="fa fa-home"></i>
			<a href="{{ action("Admin\HomeController@index") }}">Beheer</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ action("Admin\CategoryController@index") }}">Categorieën</a>
		</li>
		<li class="breadcrumb-item active">
			<a href="">{{ $category->name }}</a>
		</li>
	</ol>

@endsection


@section("content")
	
	<div class="col-md-12">
		<div class="card">
			<div class="card-header primary-color text-center white-text">
				{{ $category->name }}
			</div>
			<div class="admin-panel">
				<div class="col-md-12">
					<div class="card-block pt-0">
						<form class="mt-3" action="{{ action("Admin\CategoryController@update",["category"=>$category->id]) }}" method="post">
							{!! csrf_field() !!}
							{!! method_field("put") !!}
							<div class="md-form">
								<input type="text" id="name" name="name" value="{{ $category->name }}" class="form-control">
								<label for="name" class="control-label">Categorie naam</label>
							</div>
							<div class="md-form">
								<span class="mb-3 small text-area-label">Beschrijving</span>
								<textarea placeholder="Beschrijving" type="text" id="description" name="description" class="">
									{{ $category->description }}
								</textarea>
							</div>
							<div class="md-form">
								<select class="mdb-select" name="parent_id" id="parent">
									<option value="0">Geen hoofd categorie</option>
									@foreach($categories as $id => $category_name)
										<option @if($id == $category->parent_id) selected @endif value="{{ $id }}">{{ $category_name }}</option>
									@endforeach
								</select>
								<label for="parent" class="control-label">Hoofd categorie</label>
							</div>
							<button class="btn btn-primary" value="Opslaan">Opslaan</button>
							<a class="btn btn-danger" href="{{ action("Admin\CategoryController@index") }}">Annuleren</a>
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