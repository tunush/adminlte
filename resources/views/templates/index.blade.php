@extends('layouts.AdminLTE.index')

@section('icon_page', '')

@section('title', 'Manage Templates')

@section('content')
  <div class="row">
    <div class="col-md-12">	
      <a href="#" class="btn btn-default" data-toggle="modal" data-target="#modal-add" style="margin-bottom: 20px;">
        Add Template
      </a>
      <div class="table-responsive">
        <table id="tabelapadrao" class="table table-condensed table-bordered table-hover">
          <thead>
            <tr>			 
              <th>Name</th>			 
              <th>Description</th>
              <th>Menu Name</th>
              <th class="text-center"></th> 
            </tr>
          </thead>
          <tbody>
            @foreach($data as $d)
                <tr>
                  <td>{{ $d->name }}</td>
                  <td>{{ $d->description }}</td>
                  <td>{{ $d->menu_name }}</td>
                  <td class="text-center">
                    <a class="btn btn-success  btn-xs" href="#" title="Edit {{ $d->name }}" data-toggle="modal" data-target="#modal-edit-{{ $d->id }}" style="width: 70px;">Edit</a>
                    <a class="btn btn-danger  btn-xs" href="#" title="Delete {{ $d->name}}" data-toggle="modal" data-target="#modal-delete-{{ $d->id }}" style="width: 70px;">Delete</a> 
                  </td>
                </tr>
                <div class="modal fade" id="modal-delete-{{ $d->id }}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title"><i class="fa fa-warning"></i> Caution!!</h4>
                      </div>
                      <div class="modal-body">
                        <p>Do you really want to delete ({{ $d->name }}) ?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                        <a href="{{ route('template.destroy', $d->id) }}"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button></a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal fade" id="modal-edit-{{ $d->id }}">
                  <div class="modal-dialog" style="width: 700px;">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" style="text-align: center;">Edit Template</h4>
                      </div>
                      <div class="modal-body">
                        <form action="{{ route('template.update', $d->id) }}" method="post">
                          {{ csrf_field() }}
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" required="" value="{{ $d->name }}" autofocus>
                              </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group">
                                <label for="nome">Description</label>
                                <textarea name="description" class="form-control" placeholder="Description">{{$d->description}}</textarea>
                              </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group">
                                <label for="nome">Menu Name</label>
                                <input type="text" name="menu_name" class="form-control" placeholder="Menu Name" value="{{ $d->menu_name }}" autofocus>
                              </div>
                            </div>
                            <div class="col-lg-12" style="text-align: center;">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
            @endforeach

            <div class="modal fade" id="modal-add">
              <div class="modal-dialog" style="width: 700px;">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" style="text-align: center;">Add New Template</h4>
                  </div>
                  <div class="modal-body">
                    <form action="{{ route('template.store') }}" method="post">
                      {{ csrf_field() }}
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name" required="" value="" autofocus>
                          </div>
                          @if($errors->has('name'))
                            <span class="help-block" style="color: #dd4b39;">
                              <strong>{{ $errors->first('name') }}</strong>
                            </span>
                          @endif
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="nome">Description</label>
                            <textarea name="description" class="form-control" placeholder="Description"></textarea>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="nome">Menu Name</label>
                            <input type="text" name="menu_name" class="form-control" placeholder="Menu Name" value="" autofocus>
                          </div>
                        </div>
                        <div class="col-lg-12" style="text-align: center;">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </tbody>
        </table>
      </div>
    </div>				
    <div class="col-md-12 text-center">
      {{ $data->links() }}
    </div>
  </div>
@endsection