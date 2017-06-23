@extends("admin.layouts.app")

@section("breadcrumbs")
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="fa fa-home"></i>
            <a href="{{ action("Admin\HomeController@index") }}">Beheer</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ action("Admin\ProductController@index") }}">Producten</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="">Aanmaken</a>
        </li>
    </ol>
@endsection

@section("content")
    <div class="container-fluid">
        <div class="card">
            <div class="card-header primary-color text-center white-text">
                Product aanmaken
            </div>
            <div class="admin-panel m-3">
                <form action="{{ action("Admin\UserController@store") }}" method="post">
                    {!! csrf_field() !!}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="md-form">
                                <input type="text" id="name" name="name" class="form-control">
                                <label for="name" class="control-label">Product naam</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="md-form">
                                <select class="mdb-select" name="brand" id="brand">
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                <label for="brand" class="control-label">Merk</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="md-form">
                                <select multiple class="form-control multi-select" name="categories[]" id="category">
                                    {{--@foreach($categories as $category)--}}
                                        {{--<option id="option{{ $category->id }}"--}}
                                                {{--@if(in_array($category->id,$categories_sel)) selected--}}
                                                {{--@endif value="{{ $category->id }}">--}}
                                            {{--{{ $category->name }}--}}
                                        {{--</option>--}}
                                    {{--@endforeach--}}
                                </select>
                                <label for="category">Categoriën</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="md-form">
                                <span class="mb-3 small text-area-label">Beschrijving</span>
                                <textarea placeholder="Beschrijving" type="text" id="description" name="description"
                                          class=""></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary" value="Opslaan">Opslaan</button>
                            <a class="btn btn-secondary"
                               href="{{ action("Admin\ProductController@index") }}">Annuleren</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        $(document).ready(function () {
            CKEDITOR.replace("description", {
                language: 'nl',
            });
            $('.mdb-select').material_select();
        });
    </script>
@endsection