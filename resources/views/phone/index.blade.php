@extends('layouts.AdminLTE.index') 

@section('icon_page', '') 

@section('title', 'Twilio Phone') 

@section('description', 'Add Edit and Remove your phone system')

@section('content') 

<div class="row phones-block">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#settings" data-toggle="tab">Twilio Settings</a></li>
				<li><a href="#numbers" data-toggle="tab">Twilio Numbers</a></li>
			</ul>
			<div class="tab-content">
				<div class="active tab-pane" id="settings">
                    <form action="{{ route('phone.update.settings', $settings->id) }}" method="post" style="margin-top: 20px;">
                        {{ csrf_field() }}
                        <div class="form-group" style="display: block;">
                            <label for="nome">Twilio Account SID</label>
                            <input type="text" name="account_sid" class="form-control" required="" value="{{$settings->account_sid}}">
                            <p style="padding-top: 5px;">Click Here To Find It : <a href="https://www.twilio.com/console">https://www.twilio.com/console</a></p>
                        </div>
                        <div class="form-group" style="display: block;">
                            <label for="nome">Twilio Auth Token</label>
                            <input type="text" name="auth_token" class="form-control" required="" value="{{$settings->auth_token}}">
                            <p style="padding-top: 5px;">Click Here To Find It : <a href="https://www.twilio.com/console">https://www.twilio.com/console</a></p>
                        </div>
                        <div class="form-group" style="display: block;">
                            <label for="nome">Twilio Application SID</label>
                            <input type="text" name="application_sid" class="form-control" required="" value="{{$settings->application_sid}}">
                            <p style="padding-top: 5px;">Click Here To Find It : <a href="https://www.twilio.com/console/voice/twiml/apps">https://www.twilio.com/console/voice/twiml/apps</a></p>
                        </div>
                        <div class="form-group text-right" style="justify-content: end;">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
				</div>
				<div class="tab-pane" id="numbers">
                    <div style="display: flex; justify-content: flex-end;">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-add" style="margin-bottom: 20px;">
                            + Add Number
                        </a>
                    </div>
					<div class="table-responsive">
						<table id="tabelapadrao" class="table table-condensed table-bordered table-hover">
							<thead>
								<tr>			 
									<th>Name</th>			 
									<th>Phone Number</th>
									<th>Forwarding Number</th>
									<th>Timeout</th>
									<th>Assigned</th>
									<th class="text-center"></th> 
								</tr>
							</thead>
							<tbody>
								@foreach($phones as $phone)
                                    <tr>
                                        <td>{{ $phone->name }}</td>
                                        <td>{{ $phone->phone_number }}</td>
                                        <td>{{ $phone->forwarding_number }}</td>
                                        <td><i class="fa fa-arrow-up"></i> {{ $phone->incoming_call_timeout }} / <i class="fa fa-arrow-down"></i> {{ $phone->outbound_call_timeout }}</td>
                                        <td>
                                            @php
                                                $user = App\Models\User::find($phone->assigned_user);
                                            @endphp
                                            {{ $user->name }} {{ $user->lastname }}
                                        </td>
                                        <td class="text-center">
                                            <a href="#" title="Edit" data-toggle="modal" data-target="#modal-edit-{{ $phone->id }}"><i class="fa fa-pencil"></i></a> 
                                            <a href="#" title="Delete" data-toggle="modal" data-target="#modal-delete-{{ $phone->id }}"><i class="fa fa-trash"></i></a> 
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="modal-delete-{{ $phone->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                    <h4 class="modal-title"><i class="fa fa-warning"></i> Caution!!</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Do you really want to delete phone number?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                                                    <a href="{{ route('phone.destroy', $phone->id) }}"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="modal-edit-{{ $phone->id }}">
                                        <div class="modal-dialog" style="width: 700px;">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                    <h4 class="modal-title" style="text-align: center;">Edit Number {{ $phone->phone_number }}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('phone.update', $phone->id) }}" method="post" style="margin: 0 20px;">
                                                        {{ csrf_field() }}
                                                        <div class="form-group" style="display: block;">
                                                            <label for="nome">Number Name</label>
                                                            <input type="text" name="name" class="form-control" value="{{$phone->name}}">
                                                        </div>
                                                        <div class="form-group" style="display: block;">
                                                            <label for="nome">Forward Calls To</label>
                                                            <input type="text" name="forwarding_number" class="form-control" value="{{$phone->forwarding_number}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="hidden" name="pass_called_number" value="{{$phone->pass_called_number}}">
                                                            <input type="checkbox" name="pass_">
                                                            <label for="nome" style="padding-left: 5px;">Pass called number as caller id</label>
                                                            <script>
                                                                if("{{$phone->pass_called_number}}" == "0") {
                                                                    $('#modal-edit-{{ $phone->id }} input[name="pass_"]').prop('checked', false);
                                                                    $('#modal-edit-{{ $phone->id }} input[name="pass_called_number"]').val('0');
                                                                } else {
                                                                    $('#modal-edit-{{ $phone->id }} input[name="pass_"]').prop('checked', true);
                                                                    $('#modal-edit-{{ $phone->id }} input[name="pass_called_number"]').val('1');
                                                                }
                                                            </script>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="hidden" name="enable_call_connect" value="{{$phone->enable_call_connect}}">
                                                            <input type="checkbox" name="enable_">
                                                            <label for="nome" style="padding-left: 5px;">Enable call connect feature</label>
                                                            <script>
                                                                if("{{$phone->enable_call_connect}}" == "0") {
                                                                    $('#modal-edit-{{ $phone->id }} input[name="enable_"]').prop('checked', false);
                                                                    $('#modal-edit-{{ $phone->id }} input[name="enable_call_connect"]').val('0');
                                                                } else {
                                                                    $('#modal-edit-{{ $phone->id }} input[name="enable_"]').prop('checked', true);
                                                                    $('#modal-edit-{{ $phone->id }} input[name="enable_call_connect"]').val('1');
                                                                }
                                                            </script>
                                                        </div>
                                                        <div class="form-group" style="display: block;">
                                                            <label for="nome">Whisper Message</label>
                                                            <input type="text" name="whisper_message" class="form-control" value="{{$phone->whisper_message}}">
                                                        </div>
                                                        <div class="form-group" style="display: block;">
                                                            <label for="nome">Call Recording</label>
                                                            <textarea name="call_recording" class="form-control" rows="4">{{$phone->call_recording}}</textarea>
                                                        </div>
                                                        <div class="form-group" style="display: block;">
                                                            <label for="nome">Assign User</label>
                                                            @php
                                                                $users = App\Models\User::where('company_id', $_COOKIE["company_id"])->get();
                                                            @endphp
                                                            <select name="assigned_user" class="form-control">
                                                                @foreach($users as $user)
                                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <script>
                                                                $('#modal-edit-{{ $phone->id }} select[name="assigned_user"]').val('{{ $phone->assigned_user }}');
                                                            </script>
                                                        </div>
                                                        <div class="form-group" style="display: block;">
                                                            <label for="nome">Incoming Call Timeout</label>
                                                            <input type="text" name="incoming_call_timeout" class="form-control" value="{{$phone->incoming_call_timeout}}">
                                                        </div>
                                                        <div class="form-group" style="display: block;">
                                                            <label for="nome">Outbound Call Timeout</label>
                                                            <input type="text" name="outbound_call_timeout" class="form-control" value="{{$phone->outbound_call_timeout}}">
                                                        </div>
                                                        <div class="form-group text-right" style="justify-content: end;">
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="modal-add">
                                        <div class="modal-dialog" style="width: 700px;">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                    <h4 class="modal-title" style="text-align: center;">Add Phone Number</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div style="margin: 0 20px;">
                                                        <div class="form-group" style="display: block;">
                                                            <label for="nome">Country</label>
                                                            <select class="form-control">
                                                                <option>United States</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group" style="display: block;">
                                                            <label for="nome">Area Code</label>
                                                            <div style="display: flex; justify-content: space-between;">
                                                                <input type="text" name="search_num" class="form-control">
                                                                <button class="btn btn-primary" type="button">Search</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>

<script>
    $('input[name="pass_"]').change(function () {
        if($(this).prop('checked')) {
            $('input[name="pass_called_number"]').val('1');
        } else {
            $('input[name="pass_called_number"]').val('0');
        }
    });
    $('input[name="enable_"]').change(function () {
        if($(this).prop('checked')) {
            $('input[name="enable_call_connect"]').val('1');
        } else {
            $('input[name="enable_call_connect"]').val('0');
        }
    });
</script>

@endsection