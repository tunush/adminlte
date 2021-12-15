@extends('layouts.AdminLTE.index')

@section('icon_page', 'user')

@section('title', 'Users')

@section('description', 'You can invite people that you work with (eg. partners, VA\'s, or team members) to join.')

@section('menu_pagina')	
		
	<!-- <li role="presentation">
		<a href="#" class="link_menu_page" data-toggle="modal" data-target="#modal-invite">
			<i class="fa fa-plus"></i> Invite Someone
		</a>								
	</li> -->

	<!-- <li role="presentation">
		<a href="{{ route('user.create') }}" class="link_menu_page">
			<i class="fa fa-plus"></i> Invite
		</a>								
	</li> -->
	<!-- <li role="presentation">
		<a href="{{ route('role') }}" class="link_menu_page">
			<i class="fa fa-unlock-alt"></i> Permissions
		</a>								
	</li> -->

@endsection

@section('content')    
        
    <div class="users-block">
		<div class="box-body">
			<div class="row">
				<div class="col-md-12">	
					<a href="#" class="btn btn-default" data-toggle="modal" data-target="#modal-invite" style="margin-bottom: 20px;">
						Invite Someone
					</a>
					<div class="table-responsive">
						<table id="tabelapadrao" class="table table-condensed table-bordered table-hover">
							<thead>
								<tr>			 
									<th>Name</th>			 
									<th>E-mail</th>
									<th>Role</th>
									<!-- <th class="text-center">Status</th> -->
									<!-- <th class="text-center">Created</th> -->
									<th class="text-center"></th> 
								</tr>
							</thead>
							<tbody>
								@foreach($users as $user)
									@if ($user->id != 1)
										<tr>
											<td>
												@if($user->isOnline())
						                            <a herf="#" title="OnLine"><span class="text-green"><i class="fa fa-fw fa-circle"></i></span></a> 
												@else
													<a herf="#" title="OffLine"><span class="text-red"><i class="fa fa-fw fa-circle"></i></span></a> 
						                        @endif
												{{ $user->name }}
											</td>
											<td>{{ $user->email }}</td>
											<td>
												@php
													$user = App\Models\User::find($user->id);
													$roles = App\Models\Role::all();
													$roles_ids = App\Models\Role::rolesUser($user);
												@endphp
												@foreach($roles as $role)
													@if($role->id != 1)
														@if(in_array($role->id, $roles_ids))
															{{ $role->name}}
														@endif                                             
													@endif                                             
												@endforeach
											</td>
											<!-- <td class="text-center">
												@if($user->active == true)
													<span class="label label-success">Active</span>
												@else
													<span class="label label-danger">Inactive</span>
												@endif
											</td>              -->
											<!-- <td class="text-center">{{ $user->created_at->format('d/m/Y H:i') }}</td>              -->
											<td class="text-center">
												 <!-- <a class="btn btn-default  btn-xs" href="{{ route('user.show', $user->id) }}" title="See {{ $user->name }}"><i class="fa fa-eye">   </i></a> -->
												 <!-- <a class="btn btn-primary  btn-xs" href="{{ route('user.edit.password', $user->id) }}" title="Change Password {{ $user->name }}"><i class="fa fa-key"></i></a> -->
												 <!-- <a class="btn btn-warning  btn-xs" href="{{ route('user.edit', $user->id) }}" title="Edit {{ $user->name }}"><i class="fa fa-pencil"></i></a> 
												 <a class="btn btn-danger  btn-xs" href="#" title="Delete {{ $user->name}}" data-toggle="modal" data-target="#modal-delete-{{ $user->id }}"><i class="fa fa-trash"></i></a>  -->

												@if(strrpos($user->last_login, '0000-00-00') === false)
												 	<a class="btn btn-success  btn-xs" href="{{ route('user.edit', $user->id) }}" title="Edit {{ $user->name }}" style="width: 70px;">Edit</a>
												@else
												 	<a class="btn btn-default  btn-xs" href="{{ route('user.sendInvintation', $user->id) }}" title="Pending {{ $user->name }}" style="width: 70px;">Pending</a>
												@endif
												<a class="btn btn-danger  btn-xs" href="#" title="Delete {{ $user->name}}" data-toggle="modal" data-target="#modal-delete-{{ $user->id }}" style="width: 70px;">Delete</a> 
											</td>
										</tr>
										<div class="modal fade" id="modal-delete-{{ $user->id }}">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">×</span>
														</button>
														<h4 class="modal-title"><i class="fa fa-warning"></i> Caution!!</h4>
													</div>
													<div class="modal-body">
														<p>Do you really want to delete ({{ $user->name }}) ?</p>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
														<a href="{{ route('user.destroy', $user->id) }}"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button></a>
													</div>
												</div>
											</div>
										</div>
										<div class="modal fade" id="modal-invite">
											<div class="modal-dialog" style="width: 700px;">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">×</span>
														</button>
														<h4 class="modal-title" style="text-align: center;">Invite New User</h4>
													</div>
													<div class="modal-body">
														<form action="{{ route('user.store') }}" method="post">
															{{ csrf_field() }}
															<input type="hidden" name="active" value="1">
															<div class="row">
																<div class="col-lg-12">
																	<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
																		<label for="nome">Name</label>
																		<input type="text" name="name" class="form-control" maxlength="30" minlength="4" placeholder="Name" required="" value="{{ old('name') }}" autofocus>
																		@if($errors->has('name'))
																			<span class="help-block">
																				<strong>{{ $errors->first('name') }}</strong>
																			</span>
																		@endif
																	</div>
																</div>
																<div class="col-lg-12">
																	<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
																		<label for="nome">E-mail</label>
																		<input type="email" name="email" class="form-control" placeholder="E-mail" required="" value="{{ old('email') }}">
																		@if($errors->has('email'))
																			<span class="help-block">
																				<strong>{{ $errors->first('email') }}</strong>
																			</span>
																		@endif
																	</div>
																</div>
																<div class="col-lg-12" style="display: none;">
																	<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
																		<label for="nome">Password</label>
																		<input type="password" name="password" class="form-control" placeholder="Password" minlength="6" value="1234567">
																		@if($errors->has('password'))
																			<span class="help-block">
																				<strong>{{ $errors->first('password') }}</strong>
																			</span>
																		@endif
																		<input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" minlength="6" value="1234567">
																		@if($errors->has('password-confirm'))
																			<span class="help-block">
																				<strong>{{ $errors->first('password-confirm') }}</strong>
																			</span>
																		@endif
																	</div>
																</div>
																<div class="col-lg-12">
																	<div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
																		<label for="nome">Role</label>
																		<select name="roles[]" class="form-control select2" data-placeholder="Permission Group" required="">
																			@php
																				foreach($roles as $role) {
																					if($role->name == "SuperUser"){
																						$superuser = $role->id;
																					}
																				}
																				$superuser_count = count(App\Models\Role_User::where('role_id', $superuser)->get());
																			@endphp
																			@foreach($roles as $role)
																				@if($role->id != 1)
																					@if($role->id == $superuser)
																						@if($superuser_count == 0)
																							<option value="{{ $role->id}}"> {{ $role->name}} </option>
																						@endif
																					@else                                 
																						<option value="{{ $role->id}}"> {{ $role->name}} </option>
																					@endif
																				@endif      
																			@endforeach
																		</select>
																		@if($errors->has('roles'))
																			<span class="help-block">
																				<strong>{{ $errors->first('roles') }}</strong>
																			</span>
																		@endif
																	</div>
																</div>
																<div class="col-lg-12">
																	<div class="form-group" style="display: block;">
																		<label>Include a personalized message (optional)</label>
																		<textarea name="message" class="form-control" rows="6"></textarea>
																	</div>
																</div> 
																<div class="col-lg-12" style="text-align: center;">
																	<button type="submit" class="btn btn-primary">Send Invintation</button>
																</div>
															</div>
														</form>
													</div>
													<!-- <div class="modal-footer">
														<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
														<a href="{{ route('user.destroy', $user->id) }}"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button></a>
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
									<th>E-mail</th>
									<th class="text-center">Status</th>
									<th class="text-center">Created</th>			 
									<th class="text-center">Actions</th>			 
								</tr>
							</tfoot> -->
						</table>
					</div>
				</div>				
				<div class="col-md-12 text-center">
					{{ $users->links() }}
				</div>
			</div>
		</div>
	</div>    

@endsection

@include('layouts.AdminLTE._includes._data_tables')