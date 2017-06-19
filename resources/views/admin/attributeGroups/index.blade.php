@extends("admin.layouts.app")

@section("breadcrumbs")
	
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<i class="fa fa-home"></i>
			<a href="{{ action("Admin\HomeController@index") }}">Beheer</a>
		</li>
		<li class="breadcrumb-item active">
			<a href="{{ action("Admin\AttributeGroupController@index") }}">Categoriën</a>
		</li>
	</ol>

@endsection


@section("content")
	
	<div class="col-md-12">
		<div class="card">
			<div class="card-header primary-color text-center white-text">
				Alle Product eigenschappen
			</div>
			<div class="admin-panel info-admin-panel">
				<div class="col-md-12">
					<div class="card-block pt-0">
						<div class="table-responsive">
							<table class="table table-striped table-hover">
								<thead>
								<tr>
									<th>Naam</th>
									<th>Beschrijving</th>
									<th>Aangemaakt op</th>
									<th>Acties</th>
								</tr>
								</thead>
								<tbody>
								@foreach($attributeGroups as $attributeGroup)
									<tr>
										<td>
											{{ $attributeGroup->name }}
										</td>
										<td>
											{!! $attributeGroup->description !!}
										</td>
										<td>
											{{ $attributeGroup->created_at }}
										</td>
										<td>
											<form id="delete{{ $attributeGroup->id }}"
											      action="{{ action("Admin\AttributeGroupController@destroy", ["attributeGroup"=>$attributeGroup->id]) }}"
											      method="post">
												{!! csrf_field() !!}
												{!! method_field("delete") !!}
												<a class="btn btn-primary"
												   href="{{ action("Admin\AttributeGroupController@edit",["attributeGroup"=>$attributeGroup->id]) }}">
													<i class="fa fa-pencil"></i>
												</a>
												<a class="btn btn-danger"
												   onclick="if (confirm('Weet u het zeker')){ {$('#delete{{ $attributeGroup->id }}').submit();} }"><i
															class="fa fa-times"></i></a>
											</form>
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
						{!! $attributeGroups->links() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<a class="btn-floating btn-large secondary-color" style="position: fixed; bottom: 45px; right: 24px;"
	   href="{{ action("Admin\AttributeGroupController@create") }}">
		<i class="fa"><b>+</b></i>
	</a>
@endsection