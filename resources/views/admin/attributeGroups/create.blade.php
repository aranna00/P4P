@extends("admin.layouts.app")

@section("breadcrumbs")
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="fa fa-home"></i>
            <a href="{{ action("Admin\HomeController@index") }}">Beheer</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ action("Admin\AttributeGroupController@index") }}">Producteigenschappen</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="">Aanmaken</a>
        </li>
    </ol>
@endsection

@section("content")
    <div class="col-md-12">
        <div class="card">
            <div class="card-header primary-color text-center white-text">
                Producteigenschap aanmaken
            </div>
            <div class="admin-panel">
                <div class="col-md-12">
                    <div class="card-block pt-0">
                        <form class="mt-3" action="{{ action("Admin\AttributeGroupController@store") }}" method="post">
                            {!! csrf_field() !!}
                            <div class="md-form">
                                <input type="text" id="name" name="name" value="" class="form-control">
                                <label for="name" class="control-label">Producteigenschap naam</label>
                            </div>
                            <div class="md-form">
                                <span class="mb-3 small text-area-label">Beschrijving</span>
                                <textarea placeholder="Beschrijving" type="text" id="description" name="description" class="">
								</textarea>
                            </div>
                            <div class="md-form">
                                <select class="mdb-select" name="type" id="type">
                                    <option value="checkbox">Vinkjes</option>
                                    <option value="radio">Eén optie</option>
                                    <option value="slider">Schuifbalk</option>
                                    <option value="range">Bereik</option>
                                </select>
                                <label for="type" class="control-label">Type</label>
                            </div>
                            <button class="btn btn-primary" value="Opslaan">Opslaan</button>
                            <a class="btn btn-danger" href="{{ action("Admin\AttributeGroupController@index") }}">Annuleren</a>
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