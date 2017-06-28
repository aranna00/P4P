@extends("admin.layouts.app")

@section("breadcrumbs")
	
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<i class="fa fa-home"></i>
			<a href="{{ action("Admin\HomeController@index") }}">Beheer</a>
		</li>
		<li class="breadcrumb-item active">
			<a href="{{ action("Admin\CategoryController@index") }}">Categorieën</a>
		</li>
	</ol>

@endsection


@section("content")
	
	<div class="">
		<div class="card">
			<div class="card-header primary-color text-center white-text">
				Alle Categoriën
			</div>
			<div class="admin-panel info-admin-panel">
				<div class="col-md-12">
					<div class="card-block pt-0">
						<div class="table-responsive">
							<table class="table table-striped table-hover">
								<thead>
								<tr>
									<th>Naam</th>
									<th>hoofdcategorie</th>
									<th>Aantal subcategoriën</th>
									<th>Aangemaakt op</th>
									<th>Acties</th>
								</tr>
								</thead>
								<tbody>
								@foreach($categories as $category)
									<tr>
										<td>
											{{ $category->name }}
										</td>
										<td>
											{{ $category->parent==null?"Geen hoofdcategory":$category->parent->name }}
										</td>
										<td>
											{{ $category->children()->count() }}
										</td>
										<td>
											{{ $category->created_at }}
										</td>
										<td>
											<form id="delete{{ $category->id }}" action="{{ action("Admin\CategoryController@destroy", ["category"=>$category->id]) }}" method="post" class="btn-group">
												{!! csrf_field() !!}
												{!! method_field("delete") !!}
												<a class="btn btn-primary"
												   href="{{ action("Admin\CategoryController@edit",["category"=>$category->id]) }}">
													<i class="fa fa-pencil"></i>
												</a>
												<a class="btn btn-danger" onclick="if (confirm('Weet u het zeker')){ {$('#delete{{ $category->id }}').submit();} }"><i class="fa fa-times"></i></a>
											</form>
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
						{!! $categories->links() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<a class="btn-floating btn-large primary-color" style="position: fixed; bottom: 45px; right: 24px;"
	   href="{{ action("Admin\CategoryController@create") }}">
		<i class="fa"><b>+</b></i>
	</a>
@endsection