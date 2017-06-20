@extends("layouts.app")

@section("content")
    <div class="container mt-5">
        <div class="card mt-2 mb-2">
            <div class="card-header primary-color-darken white-text">
                {{ $wishlist->name }}
                <a class="float-right" onclick="$('#editName').modal('show')">wijzigen</a>
            </div>
            <div>
                <div class="col-md-12">
                    <div class="card-block pt-0">
                        <div class="md-form">
                            @if (count($wishlist->products) > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Acties</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($wishlist->products as $product)
                                            <tr>
                                                <td>{{ $product->name }}</td>
                                                <td>
                                                    <form id="delete{{ $product->id }}"
                                                          action="{{ action("WishlistController@remove", ["product_id"=>$product->id, "wishlist_id"=>$wishlist->id]) }}"
                                                          method="get">
                                                        {!! csrf_field() !!}
                                                        <input type="hidden" name="id" value="{{ $product->id }}">

                                                        <i class="fa fa-fixed fa-2x fa-times text-grey hover-red"
                                                           data-toggle="tooltip"
                                                           data-placement="top"
                                                           title="Verwijder uit winkelwagen"
                                                           onclick="if (confirm('Weet u zeker dat u dit item uit de winkelwagen wilt verwijderen?')){ {$('#delete{{ $product->id }}').submit();} }">

                                                        </i>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                Deze lijst bevat geen producten
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Modal: Subscription From-->
    <div class="modal fade" id="editName" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog cascading-modal" role="document">
            <!--Content-->
            <div class="modal-content">

                <!--Header-->
                <div class="modal-header primary-color-darken white-text">
                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="title">Lijstnaam wijzigen</h4>
                </div>
                <!--Body-->
                <div class="modal-body mb-0">
                    <form action="{{ action("WishlistController@update",["wishlist"=>$wishlist->id]) }}"
                          method="post">

                        {!! csrf_field() !!}
                        {!! method_field("put") !!}
                        <div class="md-form form-sm">
                            <input type="text" id="name" class="form-control" name="name"
                                   value="{{ $wishlist->name }}">
                            <label for="name">Lijstnaam</label>
                        </div>

                        <div class="text-center mt-1-half">
                            <button class="btn btn-primary mb-1">Opslaan <i class="fa fa-check ml-1"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!--Modal: Subscription From-->
@endsection