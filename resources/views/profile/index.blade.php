@extends('layouts.AdminLTE.index') 

@section('icon_page', 'user') 

@section('title', 'User Profile') 

@section('description', 'This is your individual profile and settings')

@section('content') 

<div class="row">
    <div class="col-md-6">
		<div class="user-info-block">
            <div class="title-block">Personal Data</div>
			<div style="display: flex; justify-content: center; padding: 10px;">
                <div style="padding: 10px;">
                    @if(file_exists(Auth::user()->avatar))
                    <img src="{{ asset(Auth::user()->avatar) }}" class="profile-user-img img-responsive">
                    @else
                    <img src="{{ asset('img/config/nopic.png') }}" class="profile-user-img img-responsive">
                    @endif
                    <!-- <h3 class="profile-username text-center">
                        @if(Auth::user('name'))
                        {{ Auth::user()->name }}
                        @endif
                    </h3>	
                    @foreach($roles as $role)
                        @if(in_array($role->id, $roles_ids))
                            <div class="text-center"><span class="label label-primary">{{ $role->name }}</span></div> 
                        @endif                                             
                    @endforeach -->
                </div>
                <form action="{{ route('profile.update.avatar',$user->id) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put">
                    <div class="form-group {{ $errors->has('avatar') ? 'has-error' : '' }}" style="display: block;">
                        <label>Personal Logo</label>
                        <input type="file"  class="form-control-file" name="avatar">
                        @if($errors->has('avatar'))
                            <span class="help-block">
                                <strong>{{ $errors->first('avatar') }}</strong>
                            </span>
                        @endif
                    </div>	
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary">Change</button>
                    </div>
                </form>
			</div>
            <form action="{{ route('profile.update.profile',$user->id) }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="put">
                <div style="display: flex; justify-content: space-between;">
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}" style="display: block; width: 47%;">
                        <label for="nome">First Name</label>
                        <input type="text" name="name" class="form-control" maxlength="30" minlength="4" required="" value="{{$user->name}}">
                        @if($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group" style="display: block; width: 47%;">
                        <label for="nome">Last Name</label>
                        <input type="text" name="lastname" class="form-control" maxlength="30" minlength="4" required="" value="{{$user->lastname}}">
                    </div>
                </div>
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}" style="display: block;">
                    <label for="nome">E-mail</label>
                    <input type="email" name="email" class="form-control" required="" value="{{$user->email}}">
                    @if($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <div class="form-group" style="display: block; width: 47%;">
                        <label for="nome">Phone</label>
                        <input type="text" name="phone" class="form-control" required="" value="{{$user->phone}}">
                    </div>
                    <div class="form-group" style="display: block; width: 47%;">
                        <label for="nome">Extension</label>
                        <input type="text" name="extension" class="form-control" value="{{$user->extension}}">
                    </div>
                </div>
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
            </form>
		</div>
        <div class="user-info-block">
            <div class="title-block">Assigned Role & Duties</div>
			@foreach($roles as $role)
                @if(in_array($role->id, $roles_ids))
                    <div style="padding: 10px;"><span><strong>ROLE: {{ $role->name }}</strong></span></div>
                    <div class="role-block">
                        <pre style="background: transparent; border: none;">{{$role->duties}}</pre>
                    </div>
                @endif
            @endforeach
		</div>
	</div>
    <div class="col-md-6">
        <div class="user-info-block">
            <div class="title-block">Change Password</div>
            <form action="{{ route('profile.update.password',$user->id) }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="put">
                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}" style="display: block;">
                    <label for="nome">Password</label>
                    <input type="password" name="password" class="form-control" minlength="6" required="">
                    @if($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('password-confirm') ? 'has-error' : '' }}" style="display: block;">
                    <label for="nome">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" minlength="6" required="">
                    @if($errors->has('password-confirm'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password-confirm') }}</strong>
                        </span>
                    @endif
                </div>	
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
            </form>
        </div>
        <div class="user-info-block">
            @php
                $phones = App\Models\TwilloNumbers::where('assigned_user', Auth::user()->id)->get();
            @endphp
            <div class="title-block">Call & Voicemail Settings</div>
            <div style="padding: 10px;">
                <div>
                    <label>Inbound Twilio</label>
                    <select class="form-control phones-list" style="width: 50%;">
                        @foreach($phones as $phone)
                            <option value="{{$phone->id}}">{{$phone->name}}</option>
                        @endforeach
                    </select>
                </div>
                <p style="margin: 10px 0;">
                    This voicemail message will be played instead of the one by phone carrier. We recommend a timeout of 20 seconds or less
                </p>
                @if(count($phones) !== 0)
                    <form class="phone-update-timeout" action="{{ route('phone.update', $phones[0]->id) }}" method="post" style="margin: 0; padding: 0;">
                        {{ csrf_field() }}
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div style="width: 50%; margin-right: 20px;">
                                <label>Incoming Call</label>
                                <select name="incoming_call_timeout" class="form-control">
                                    <option value="">No Timeout</option>
                                    <option value="10s">10 Seconds</option>
                                    <option value="20s">20 Seconds</option>
                                </select>
                            </div>
                            <p>
                                We will record a voicemail if call isn't answered before this duratio
                            </p>
                        </div>
                        <div class="form-group text-right" style="margin: 10px 0; justify-content: end;">
                            <button type="sumbit" class="btn btn-primary">Update Voicemail</button>
                        </div>
                    </form>
                @else
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div style="width: 50%; margin-right: 20px;">
                            <label>Incoming Call</label>
                            <select name="incoming_call_timeout" class="form-control">
                                <option value="">No Timeout</option>
                                <option value="10s">10 Seconds</option>
                                <option value="20s">20 Seconds</option>
                            </select>
                        </div>
                        <p>
                            We will record a voicemail if call isn't answered before this duratio
                        </p>
                    </div>
                    <div class="form-group text-right" style="margin: 10px 0; justify-content: end;">
                        <button type="button" class="btn btn-primary">Update Voicemail</button>
                    </div>
                @endif
            </div>      
		</div>
        <div class="user-info-block">
            <div class="title-block">Email Signature</div>
            <div style="padding: 10px;">
                <div><input type="checkbox"> Enable Signature on all outgoing messages</div>
                <div><input type="checkbox"> Include this signature before quoted text in replies</div>

                <div style="margin-top: 10px;">
                    <textarea class="form-control" rows="6"></textarea>
                </div>
            </div>
		</div>
    </div>
	<!-- <div class="col-md-3">
		<div class="box box-primary">
			<div class="box-body box-profile">
				@if(file_exists(Auth::user()->avatar))
	              <img src="{{ asset(Auth::user()->avatar) }}" class="profile-user-img img-responsive img-circle">
	            @else
	              <img src="{{ asset('img/config/nopic.png') }}" class="profile-user-img img-responsive img-circle">
	            @endif							
				<h3 class="profile-username text-center">
					@if(Auth::user('name'))
		              {{ Auth::user()->name }}
		            @endif
				</h3>	
				@foreach($roles as $role)
                    @if(in_array($role->id, $roles_ids))
                        <div class="text-center"><span class="label label-primary">{{ $role->name }}</span></div> 
                    @endif                                             
                @endforeach	
			</div>
		</div>		
	</div>
	<div class="col-md-9">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#profile" data-toggle="tab"><i class="fa fa-fw fa-user"></i> Profiel</a></li>
				<li><a href="#settings" data-toggle="tab"><i class="fa fa-fw fa-key"></i> Password</a></li>
				<li><a href="#avatar" data-toggle="tab"><i class="fa fa-fw fa-file-photo-o"></i> Avatar</a></li>
			</ul>
			<div class="tab-content">
				<div class="active tab-pane" id="profile">
					<form action="{{ route('profile.update.profile',$user->id) }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="put">
						<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="nome">Name</label>
                            <input type="text" name="name" class="form-control" maxlength="30" minlength="4" placeholder="Name" required="" value="{{$user->name}}">
                            @if($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
						<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="nome">E-mail</label>
                            <input type="email" name="email" class="form-control" placeholder="E-mail" required="" value="{{$user->email}}">
                            @if($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>	
                        <div class="form-group text-right">
                           <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-save"></i> Save Profile</button>
                        </div>
					</form>						
				</div>
				<div class="tab-pane" id="settings">
					<form action="{{ route('profile.update.password',$user->id) }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="put">
						<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label for="nome">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" minlength="6" required="">
                            @if($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
						<div class="form-group {{ $errors->has('password-confirm') ? 'has-error' : '' }}">
                            <label for="nome">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" minlength="6" required="">
                            @if($errors->has('password-confirm'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password-confirm') }}</strong>
                                </span>
                            @endif
                        </div>	
                        <div class="form-group text-right">
                           <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-save"></i> Save Password</button>
                        </div>
					</form>						
				</div>
				<div class="tab-pane" id="avatar">
					<form action="{{ route('profile.update.avatar',$user->id) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="put">
                        <div class="form-group {{ $errors->has('avatar') ? 'has-error' : '' }}">
							<label>Avatar</label>
                        	<input type="file"  class="form-control-file" name="avatar">
                        	@if($errors->has('avatar'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('avatar') }}</strong>
                                </span>
                            @endif
                        </div>	
                        <div class="form-group text-right">
                           <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-save"></i> Save Avatar</button>
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div> -->
</div>

<script>
    $('select.phones-list').change(function () {
        let id = $(this).val();
        var str1 = $('form.phone-update-timeout').attr("action");
        var str2 = str1.slice(0, -1) + id;
        $('form.phone-update-timeout').attr("action", str2);
    });
</script>

@endsection