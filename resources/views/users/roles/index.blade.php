@extends('layouts.AdminLTE.index')

@section('icon_page', 'unlock-alt')

@section('title', 'Roles')

@section('menu_pagina')	
		
	<li role="presentation">
		<!-- <a href="{{ route('role.create') }}" class="link_menu_page">
			<i class="fa fa-plus"></i> New Role
		</a> -->
		<a href="#" class="link_menu_page" data-toggle="modal" data-target="#modal-create">
			<i class="fa fa-plus"></i> New Role
		</a>
	</li>
	<!-- <li role="presentation">
		<a href="{{ route('user') }}" class="link_menu_page">
			<i class="fa fa-user"></i> Users
		</a>								
	</li> -->

@endsection

@section('content')    
        
    <div class="box box-primary">
		<div class="box-body">
			<div class="row">
				<div class="col-md-12">	
					<div class="table-responsive">
						<table id="tabelapadrao" class="table table-condensed table-bordered table-hover">
							<thead>
								<tr>			 
									<th>Role Name</th>
									<th>Assigned</th>
									<!-- <th>Description</th>
									<th>Created</th>-->
									<th class="text-center"></th>
								</tr>
							</thead>
							<tbody>
								@foreach($roles as $role)
									@if($role->id != 1)
										<tr>
											<td>{{ $role->name }}</td>
											<td>
											    @php
													$role_user = count(App\Models\Role_User::where('role_id', $role->id)->get());
												@endphp
												{{$role_user}}
											</td>
											<!-- <td>{{ $role->label }}</td>
											<td>{{ $role->created_at->format('d/m/Y H:i') }}</td> -->
											<td class="text-center">
												 <!-- <a class="btn btn-default  btn-xs" href="{{ route('role.show', $role->id) }}" title=See {{ $role->name }}"><i class="fa fa-eye">   </i></a>						 
												 <a class="btn btn-warning  btn-xs" href="{{ route('role.edit', $role->id) }}" title="Edit {{ $role->name }}"><i class="fa fa-pencil"></i></a>
												 <a class="btn btn-danger  btn-xs" href="#" title="Delete {{ $role->name}}" data-toggle="modal" data-target="#modal-delete-{{ $role->id }}"><i class="fa fa-trash"></i></a> -->

												 <a class="btn btn-success  btn-xs" href="{{ route('role.edit', $role->id) }}" title="Edit {{ $role->name }}">Edit</a>
												 @if ($role_user == 0)
												 	<a class="btn btn-danger  btn-xs" href="#" title="Delete {{ $role->name}}" data-toggle="modal" data-target="#modal-delete-{{ $role->id }}">Delete</a>
												 @else
												 	<a class="btn btn-danger  btn-xs" href="#" title="Delete {{ $role->name}}" data-toggle="modal" data-target="#modal-delete-{{ $role->id }}" disabled>Delete</a>
												 @endif
											</td> 
										</tr>
										<div class="modal fade" id="modal-delete-{{ $role->id }}">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">×</span>
														</button>
														<h4 class="modal-title"><i class="fa fa-warning"></i> Caution!!</h4>
													</div>
													<div class="modal-body">
														<p>Do you really want to delete ({{ $role->name }}) ?</p>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
														<a href="{{ route('role.destroy', $role->id) }}" ><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button></a>
													</div>
												</div>
											</div>
										</div>

										<div class="modal fade" id="modal-create">
											<div class="modal-dialog" style="width: 700px;">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">×</span>
														</button>
														<h4 class="modal-title" style="text-align:center;">Role Properties</h4>
													</div>
													<div class="modal-body">
														<form action="{{ route('role.store') }}" method="post">
															{{ csrf_field() }}
															<input type="hidden" name="active" value="1">
															<div class="row">
																<div class="col-lg-12">
																	<div class="col-lg-12 form-group {{ $errors->has('name') ? 'has-error' : '' }}" style="margin-bottom: 0;">
																		<label for="nome">Role Name</label>
																		<input type="text" name="name" class="form-control" maxlength="30" minlength="4" placeholder="Name" required="" value="{{ old('name') }}" autofocus>
																		@if($errors->has('name'))
																			<span class="help-block">
																				<strong>{{ $errors->first('name') }}</strong>
																			</span>
																		@endif
																	</div>
																</div>
																<div class="col-lg-12">
																	<div class="col-lg-12"><hr></div>
																	<div class="col-lg-12"><label>Permissions</label></div>
																	@foreach($permission_groups as $permission_group)
																		@if($permission_group->id == 5)
																			@foreach($permission_group->permissions as $permission)
																				<div class="col-lg-4">
																					<label style="font-weight: 400;"><input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="icheck minimal"> {{ $permission->label }}</label>
																				</div>
																			@endforeach
																		@endif
																	@endforeach         
																</div>
																<div class="col-lg-12">
																	<div class="col-lg-12"><hr></div>
																	<div class="col-lg-12">
																		<div class="col-lg-2" style="padding-left: 0;"><label>Pipeline</label></div>
																		<div class="col-lg-10" style="border: 1px solid black; padding: 10px 15px; max-height: 120px; overflow: auto;">
																			<div>
																				<label style="font-weight: 400;"><input type="checkbox" name="pipelines[]" value="" class="icheck minimal"> All Campaigns</label>
																			</div>
																			<div>
																				<label style="font-weight: 400;"><input type="checkbox" name="pipelines[]" value="" class="icheck minimal"> FSBO Sellers</label>
																			</div>
																			<div>
																				<label style="font-weight: 400;"><input type="checkbox" name="pipelines[]" value="" class="icheck minimal"> Facebook Leads - Arkansas</label>
																			</div>
																			<div>
																				<label style="font-weight: 400;"><input type="checkbox" name="pipelines[]" value="" class="icheck minimal"> Facebook Leads - Texas</label>
																			</div>
																			<div>
																				<label style="font-weight: 400;"><input type="checkbox" name="pipelines[]" value="" class="icheck minimal"> Facebook Leads - Texas</label>
																			</div>
																		</div>
																	</div>         
																</div>
																<div class="col-lg-12">
																	<div class="col-lg-12"><hr></div>
																	<div class="col-lg-12">
																		<div class="col-lg-2" style="padding-left: 0;"><label>Duties</label></div>
																		<div class="col-lg-10" style="border: 1px solid black; padding: 10px 15px; max-height: 120px; overflow: auto;">
																			<p>Descripiton of duties goes here.</p>
																			<ol>
																				<li>Review Training for VA Opener Call</li>
																				<li>Call to qualify the seller</li>
																				<li>On and On, blah blah and so on.</li>
																				<li>On and On, blah blah and so on.</li>
																				<li>On and On, blah blah and so on.</li>
																			</ol>
																		</div>
																	</div>         
																</div>
																<div class="col-lg-12" style="margin-top: 15px;">
																	<div class="col-lg-12"><hr></div>
																	<div class="col-lg-6">
																		<button type="button" class="btn btn-success pull-left" data-dismiss="modal">Close</button>
																	</div> 
																	<div class="col-lg-6">
																		<button type="submit" class="btn btn-primary pull-right">Save</button>
																	</div>
																</div>
															</div>
														</form>
													</div>
													<!-- <div class="modal-footer">
														<button type="button" class="btn btn-success pull-left" data-dismiss="modal">Close</button>
														<a href="{{ route('role.destroy', $role->id) }}" ><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button></a>
													</div> -->
												</div>
											</div>
										</div>
									@endif
								@endforeach
							</tbody>
							<!-- <tfoot>
								<tr>		 
									<th>Name</th>			 
									<th>Description</th>
									<th>Created</th>			 
									<th class="text-center">Actions</th>			 
								</tr>
							</tfoot> -->
						</table>
					</div>
				</div>								
				<div class="col-md-12 text-center">
					{{ $roles->links() }}
				</div>
			</div>
		</div>
	</div>    

@endsection

@section('layout_js')    

    <!-- <script> 
        $(function(){            
            $('.icheck').iCheck({
              checkboxClass: 'icheckbox_square-blue',
              radioClass: 'iradio_square-blue'
            });
        }); 

    </script> -->

@endsection

@include('layouts.AdminLTE._includes._data_tables')