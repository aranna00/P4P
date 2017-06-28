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
            <a href="">Bewerken</a>
        </li>
    </ol>
@endsection

@section("content")
    <div class="card mb-2">
        <div class="card-header primary-color text-center white-text">
            Product bewerken
        </div>
        <div class="admin-panel m-3">
            <form action="{{ action("Admin\ProductController@update", $product->id) }}" method="post">
                {!! csrf_field() !!}
                {!! method_field("put") !!}
                <div class="row mt-1">
                    <div class="col-md-4">
                        <div class="md-form">
                            <input type="text" id="name" name="name" class="form-control" value="{{ $product->name }}">
                            <label for="name" class="control-label">Product naam</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="md-form">
                            <input type="text" id="code" name="code" class="form-control" value="{{ $product->code }}">
                            <label for="code">Product code</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="md-form">
                            <input type="checkbox" id="featured" name="featured" class="form-control" @if($product->featured) checked @endif>
                            <label for="featured">Uitgelicht product?</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form">
                            <select class="mdb-select" name="brand" id="brand">
                                @foreach($brands as $index => $brand)
                                    <option value="{{ $index }}">{{ $brand }}</option>
                                @endforeach
                            </select>
                            <label for="brand" class="control-label">Merk</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form">
                            <span>Categoriën</span>
                            <select multiple class="form-control multi-select" name="categories[]" id="category"
                                    title="category">
                                @foreach($categories as $category)
                                    <option id="option{{ $category->id }}"
                                            @if(in_array($category->id,$categories_sel)) selected
                                            @endif value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form">
                            <span class="mb-3 small text-area-label">Beschrijving</span>
                            <textarea placeholder="Beschrijving" type="text" id="description" name="description"
                                      class="">{!! $product->description !!}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2">
                        <div class="md-form">
                            <input id="active" name="active" type="checkbox" @if($product->active) checked @endif>
                            <label for="active" class="control-label">Beschikbaar</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="md-form">
                            <input id="price" name="price" type="number" step="0.01" min="0"
                                   value="{{ $product->price }}">
                            <label for="price" class="control-label">Prijs</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="md-form">
                            <input id="statie_geld" name="statie_geld" type="number" step="0.01" min="0"
                                   value="{{ $product->statie_geld }}">
                            <label for="statie_geld" class="control-label">Statiegeld</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="md-form">
                            <input id="stock" name="stock" type="number" min="0" value="{{ $product->stock }}">
                            <label for="stock" class="control-label">Voorraad</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="md-form">
                            <select class="mdb-select" name="tax" id="tax">
                                @foreach ($tax as $t)
                                    <option value="{{ $t->id }}">{{ $t->name }}</option>
                                @endforeach
                            </select>
                            <label for="tax" class="control-label">BTW</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="md-form">
                            <input type="number" id="coli" name="coli" step="1" min="0" value="{{ $product->coli }}">
                            <label for="coli">Coli</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="md-form">
                            <input type="number" id="weight" name="weight" step="1" min="0"
                                   value="{{ $product->weight }}">
                            <label for="weight">Gewicht (gram)</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="md-form">
                            <input type="number" id="volume" name="volume" step="1" min="0"
                                   value="{{ $product->volume }}">
                            <label for="volume">Inhoud (milliliter)</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="md-form">
                            <input placeholder="Kies een datum" type="text" id="date-picker-from"
                                   class="form-control datepicker" name="available_from"
                                   value="{{ $product->available_from->format("d-m-Y") }}">
                            <label for="date-picker-form">Beschikbaar van</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="md-form">
                            <input placeholder="Kies een datum" type="text" id="date-picker-until"
                                   class="form-control datepicker" name="available_until"
                                   value="{{ $product->available_until->format("d-m-Y") }}">
                            <label for="date-picker-until">Beschikbaar tot</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary" value="Opslaan">Opslaan</button>
                        <a class="btn btn-danger"
                           href="{{ action("Admin\ProductController@index") }}">Annuleren</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.datepicker').pickadate({
            //Data Picker Customization
            monthsFull: [
                'Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober',
                'November', 'December'
            ],
            monthsShort: ['Jan', 'Feb', 'Mrt', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec'],
            weekdaysFull: ['Zondag', 'Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag'],
            weekdaysShort: ['Zo', 'Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za'],

            today: 'Vandaag',
            clear: '',
            close: 'Sluit',

            format: 'dd-mm-yyyy',
            hiddenPrefix: 'd',
        });
    </script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset("js/jquery.multi-select.js") }}"></script>
    <script src="{{ asset("js/jquery.quicksearch.js") }}"></script>
    <script>
        $(document).ready(function () {
            CKEDITOR.replace("description", {
                language: 'nl',
            });
            $('.mdb-select').material_select();
            $('#category').multiSelect({
                selectableHeader: "<input type='text' placeholder='Zoeken' class='search-input form-control' autocomplete='off'>",
                selectionHeader: "<input type='text' placeholder='Zoeken' class='search-input form-control' autocomplete='off'>",
                afterInit: function (ms) {
                    var that = this,
                        $selectableSearch = that.$selectableUl.prev(),
                        $selectionSearch = that.$selectionUl.prev(),
                        selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                        selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

                    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                        .on('keydown', function (e) {
                            if (e.which === 40) {
                                that.$selectableUl.focus();
                                return false;
                            }
                        });

                    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                        .on('keydown', function (e) {
                            if (e.which == 40) {
                                that.$selectionUl.focus();
                                return false;
                            }
                        });
                },
                afterSelect: function (values) {
                    this.qs1.cache();
                    this.qs2.cache();
                    selectParent(values);
                },
                afterDeselect: function (values) {
                    this.qs1.cache();
                    this.qs2.cache();
                    deselectChildren(values);
                },
                keepOrder: true
            });
        });
        var selectParent = function (child) {
            switch (child[0]) {
                @foreach($categories as $category)
                @if($category->parent_id!==null)
                case("{{ $category->id }}"):
                    $('#category').multiSelect('select', '{{ $category->parent_id }}');
                    break;
            @endif
                    @endforeach
            }

        };
        var deselectChildren = function (parent) {
            switch (parent[0]) {
                @foreach($categories as $category)
                case("{{ $category->id }}"):
                    @foreach($category->children as $child)
$('#category').multiSelect('deselect', '{{ $child->id }}');
                    @endforeach
                        break;
                    @endforeach
            }
        };
    </script>
@endsection