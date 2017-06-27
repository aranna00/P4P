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
										<option id="option{{ $category->id }}" value="{{ $category->id }}">
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
	<script src="{{ asset("js/jquery.multi-select.js") }}"></script>
	<script src="{{ asset("js/jquery.quicksearch.js") }}"></script>
	<script>
        $(document).ready(function () {
            CKEDITOR.replace("description", {
                language: 'nl',
            });
            $('.mdb-select').material_select();
            $('#category').multiSelect({
                selectableHeader: "<input type='text' class='search-input form-control' autocomplete='off'>",
                selectionHeader: "<input type='text' class='search-input form-control' autocomplete='off'>",
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