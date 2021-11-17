@extends('layouts.AdminLTE.index')

@section('icon_page', '')

@section('title', 'Customizing Custom Fields > Contact Details')

@section('menu_pagina')	
@endsection

@section('content')
<style>
    .list-group-item {
        display: flex;
        align-items: center;
        position: relative;
        width: 92%;
        justify-content: center;
        padding: 20px 15px 30px 15px;
    }

    .highlight {
        background: #f7e7d3;
        min-height: 30px;
        list-style-type: none;
    }

    .handle {
        cursor: move;
        margin: 0 5px;
    }

    .actions {
        position: absolute;
        right: -8%;
        background: #fff;
        padding: 10px;
        border: 1px solid #ddd;
        top: 0;
        width: 8%;
    }
</style>

    <div class="">
        <div class="row">
            <div class="col-md-12">	
                <ul class="sort_menu list-group" style="margin-bottom: 0;">
                    @foreach ($data as $row)
                        <li class="list-group-item" data-id="{{$row->id}}">
                            <div class="text-center" style="width: 100%;">
                                <h4 style="margin-bottom: 30px;"><strong>{{$row->title}}</strong></h4>
                                <div style="{{ $row->full ? '' : 'display: flex; justify-content: space-between; flex-wrap: wrap;' }}">
                                @foreach($fields as $field)
                                @if($field->section_id == $row->id)
                                    <form action="{{ route('contact_custom_fields.updateValue', $field->id) }}" method="post" style="{{ $row->full ? 'width: 100%;' : 'width: 45%;'}}">
                                        {{ csrf_field() }}
                                        <div id="{{$field->id}}" class="form-group">
                                        @if($field->default_field_id !== null)
                                            @php
                                                $def_field = App\Models\ContactDefaultFields::where('id', $field->default_field_id)->get()[0];
                                            @endphp
                                            <label>{{$def_field->label}}</label>
                                            @if($def_field->type == 'Textbox')
                                                <input type="text" name="value" class="form-control" value="{{ $def_field->value }}">
                                                <i class="fa fa-check-square" style="margin: 0 5px; cursor: pointer; pointer-events: none;"></i>
                                                <a href="#" style="color: black; pointer-events: none;"><i class="fa fa-pencil" style="margin: 0 5px;"></i></a>
                                                <a href="{{ route('contact_custom_fields.destroy', $field->id) }}" style="color: black;"><i class="fa fa-trash" style="margin: 0 5px;"></i></a>
                                            @endif
                                            @if($def_field->type == 'Date Textbox')
                                                <input type="date" name="value" class="form-control" value="{{ $def_field->value }}">
                                                <i class="fa fa-check-square" style="margin: 0 5px; cursor: pointer; pointer-events: none;"></i>
                                                <a href="#" style="color: black; pointer-events: none;"><i class="fa fa-pencil" style="margin: 0 5px;"></i></a>
                                                <a href="{{ route('contact_custom_fields.destroy', $field->id) }}" style="color: black;"><i class="fa fa-trash" style="margin: 0 5px;"></i></a>
                                            @endif
                                            @if($def_field->type == 'Large Textbox')
                                                <textarea name="value" class="form-control" rows="6">{{ $def_field->value }}</textarea>
                                                <i class="fa fa-check-square" style="margin: 0 5px; cursor: pointer; pointer-events: none;"></i>
                                                <a href="#" style="color: black; pointer-events: none;"><i class="fa fa-pencil" style="margin: 0 5px;"></i></a>
                                                <a href="{{ route('contact_custom_fields.destroy', $field->id) }}" style="color: black;"><i class="fa fa-trash" style="margin: 0 5px;"></i></a>
                                            @endif
                                            @if($def_field->type == 'Currency Textbox')
                                                <input type="text" name="value" class="form-control currency_input" value="{{ $def_field->value }}">
                                                <i class="fa fa-check-square" style="margin: 0 5px; cursor: pointer; pointer-events: none;"></i>
                                                <a href="#" style="color: black; pointer-events: none;"><i class="fa fa-pencil" style="margin: 0 5px;"></i></a>
                                                <a href="{{ route('contact_custom_fields.destroy', $field->id) }}" style="color: black;"><i class="fa fa-trash" style="margin: 0 5px;"></i></a>
                                            @endif
                                            @if($def_field->type == 'Yes/No Dropdown')
                                                <select name="value" class="form-control">
                                                    <option>Yes</option>
                                                    <option>No</option>
                                                </select>
                                                <i class="fa fa-check-square" style="margin: 0 5px; cursor: pointer; pointer-events: none;"></i>
                                                <a href="#" style="color: black; pointer-events: none;"><i class="fa fa-pencil" style="margin: 0 5px;"></i></a>
                                                <a href="{{ route('contact_custom_fields.destroy', $field->id) }}" style="color: black;"><i class="fa fa-trash" style="margin: 0 5px;"></i></a>

                                                <script>
                                                    $('#{{ $field->id }} select[name="value"]').val('{{ $def_field->value }}');
                                                </script>
                                            @endif
                                            @if($def_field->type == 'Custom Dropdown')
                                                <select name="value" class="form-control">
                                                    @if($def_field->default_options !== '' && $def_field->default_options !== null)
                                                        @foreach(json_decode($def_field->default_options, true) as $option)
                                                            <option value="{{$option}}">{{$option}}</option>
                                                        @endforeach
                                                    @else
                                                        <option value=""></option>
                                                    @endif
                                                    @if($field->custom_options !== '' && $field->custom_options !== null)
                                                        @foreach(json_decode($field->custom_options, true) as $option)
                                                            <option value="{{$option}}">{{$option}}</option>
                                                        @endforeach
                                                    @else
                                                        <option value=""></option>
                                                    @endif
                                                </select>
                                                <div style="width: 40px;" class="form-control">
                                                    <a href="#" data-toggle="modal" data-target="#modal-custom-options-{{ $field->id }}" style="color: black;"><i class="fa fa-gear"></i></a>
                                                </div>
                                                <i class="fa fa-check-square" style="margin: 0 5px; cursor: pointer; pointer-events: none;"></i>
                                                <a href="#" style="color: black; pointer-events: none;"><i class="fa fa-pencil" style="margin: 0 5px;"></i></a>
                                                <a href="{{ route('contact_custom_fields.destroy', $field->id) }}" style="color: black;"><i class="fa fa-trash" style="margin: 0 5px;"></i></a>

                                                <script>
                                                    $('#{{ $field->id }} select[name="value"]').val('{{ $def_field->value }}');
                                                </script>

                                                <div class="modal fade" id="modal-custom-options-{{ $field->id }}">
                                                    <div class="modal-dialog" style="width: 700px;">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                                <h4 class="modal-title" style="text-align:center;">Customize Dropdown</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('contact_custom_fields.updateCustomOptions', $field->id) }}" method="post">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="custom_options" value="{{$field->custom_options}}">
                                                                    <div class="row">
                                                                        <div class="col-lg-6" style="max-height: 300px; overflow: auto;">
                                                                            <div style="margin-bottom: 15px;"><strong>Default Options</strong></div>
                                                                            @if($def_field->default_options !== '' && $def_field->default_options !== null)
                                                                                @foreach (json_decode($def_field->default_options, true) as $key => $value)
                                                                                    <div class="form-group">
                                                                                        <div style="width: 100%;">{{$value}}</div>
                                                                                    </div>
                                                                                @endforeach
                                                                            @else
                                                                                <div class="form-group"></div>
                                                                            @endif
                                                                        </div>
                                                                        <div class="col-lg-6 main-block custom-options-block" style="max-height: 300px; overflow: auto;">
                                                                            <div style="margin-bottom: 15px;"><strong>Custom Options</strong></div>
                                                                            @if($field->custom_options !== '' && $field->custom_options !== null)
                                                                                @foreach (json_decode($field->custom_options, true) as $key => $value)
                                                                                    <div class="form-group">
                                                                                        <input id="c_option_{{$key}}" class="form-control custom-option" type="text" value="{{$value}}" style="width: 100%;">
                                                                                        <i class="fa fa-plus" style="margin: 0 5px; cursor: pointer;"></i>
                                                                                        <i class="fa fa-minus" style="margin: 0 5px; cursor: pointer;"></i>
                                                                                    </div>
                                                                                @endforeach
                                                                            @else
                                                                                <div class="form-group">
                                                                                    <input id="c_option_1" class="form-control custom-option" type="text" value="" style="width: 100%;">
                                                                                    <i class="fa fa-plus" style="margin: 0 5px; cursor: pointer;"></i>
                                                                                    <i class="fa fa-minus" style="margin: 0 5px; cursor: pointer;"></i>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                        <div class="col-lg-12" style="margin-top: 15px;">
                                                                            <div class="col-lg-6">
                                                                                <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Close</button>
                                                                            </div> 
                                                                            <div class="col-lg-6">
                                                                                <button type="submit" class="btn btn-primary pull-right add-custom-options">Save Changes</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-lg-12 save-button" style="display: none;">
                                                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-fw fa-save"></i> Save</button>
                                            </div>
                                        @else
                                            <label>{{$field->label}}</label>
                                            @if($field->type == 'Textbox')
                                                <input type="text" name="value" class="form-control" value="{{ $field->value }}">
                                                <i class="fa fa-check-square" style="margin: 0 5px; cursor: pointer;"></i>
                                                <a href="#" data-toggle="modal" data-target="#modal-edit-{{ $field->id }}" style="color: black;"><i class="fa fa-pencil" style="margin: 0 5px;"></i></a>
                                                <a href="{{ route('contact_custom_fields.destroy', $field->id) }}" style="color: black;"><i class="fa fa-trash" style="margin: 0 5px;"></i></a>
                                            @endif
                                            @if($field->type == 'Date Textbox')
                                                <input type="date" name="value" class="form-control" value="{{ $field->value }}">
                                                <i class="fa fa-check-square" style="margin: 0 5px; cursor: pointer;"></i>
                                                <a href="#" data-toggle="modal" data-target="#modal-edit-{{ $field->id }}" style="color: black;"><i class="fa fa-pencil" style="margin: 0 5px;"></i></a>
                                                <a href="{{ route('contact_custom_fields.destroy', $field->id) }}" style="color: black;"><i class="fa fa-trash" style="margin: 0 5px;"></i></a>
                                            @endif
                                            @if($field->type == 'Large Textbox')
                                                <textarea name="value" class="form-control" rows="6">{{ $field->value }}</textarea>
                                                <i class="fa fa-check-square" style="margin: 0 5px; cursor: pointer;"></i>
                                                <a href="#" data-toggle="modal" data-target="#modal-edit-{{ $field->id }}" style="color: black;"><i class="fa fa-pencil" style="margin: 0 5px;"></i></a>
                                                <a href="{{ route('contact_custom_fields.destroy', $field->id) }}" style="color: black;"><i class="fa fa-trash" style="margin: 0 5px;"></i></a>
                                            @endif
                                            @if($field->type == 'Currency Textbox')
                                                <input type="text" name="value" class="form-control currency_input" value="{{ $field->value }}">
                                                <i class="fa fa-check-square" style="margin: 0 5px; cursor: pointer;"></i>
                                                <a href="#" data-toggle="modal" data-target="#modal-edit-{{ $field->id }}" style="color: black;"><i class="fa fa-pencil" style="margin: 0 5px;"></i></a>
                                                <a href="{{ route('contact_custom_fields.destroy', $field->id) }}" style="color: black;"><i class="fa fa-trash" style="margin: 0 5px;"></i></a>
                                            @endif
                                            @if($field->type == 'Yes/No Dropdown')
                                                <select name="value" class="form-control">
                                                    <option>Yes</option>
                                                    <option>No</option>
                                                </select>
                                                <i class="fa fa-check-square" style="margin: 0 5px; cursor: pointer;"></i>
                                                <a href="#" data-toggle="modal" data-target="#modal-edit-{{ $field->id }}" style="color: black;"><i class="fa fa-pencil" style="margin: 0 5px;"></i></a>
                                                <a href="{{ route('contact_custom_fields.destroy', $field->id) }}" style="color: black;"><i class="fa fa-trash" style="margin: 0 5px;"></i></a>

                                                <script>
                                                    $('#{{ $field->id }} select[name="value"]').val('{{ $field->value }}');
                                                </script>
                                            @endif
                                            @if($field->type == 'Custom Dropdown')
                                                <select name="value" class="form-control">
                                                    @if($field->default_options !== '' && $field->default_options !== null)
                                                        @foreach(json_decode($field->default_options, true) as $option)
                                                            <option value="{{$option}}">{{$option}}</option>
                                                        @endforeach
                                                    @else
                                                        <option value=""></option>
                                                    @endif
                                                </select>
                                                <div style="width: 40px;" class="form-control">
                                                    <a href="#" data-toggle="modal" data-target="#modal-custom-options-{{ $field->id }}" style="color: black;"><i class="fa fa-gear"></i></a>
                                                </div>
                                                <i class="fa fa-check-square" style="margin: 0 5px; cursor: pointer;"></i>
                                                <a href="#" data-toggle="modal" data-target="#modal-edit-{{ $field->id }}" style="color: black;"><i class="fa fa-pencil" style="margin: 0 5px;"></i></a>
                                                <a href="{{ route('contact_custom_fields.destroy', $field->id) }}" style="color: black;"><i class="fa fa-trash" style="margin: 0 5px;"></i></a>

                                                <script>
                                                    $('#{{ $field->id }} select[name="value"]').val('{{ $field->value }}');
                                                </script>
                                            @endif

                                            <div class="col-lg-12 save-button" style="display: none;">
                                                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-fw fa-save"></i> Save</button>
                                            </div>
                                        @endif
                                        </div>

                                        <div class="modal fade" id="modal-edit-{{ $field->id }}">
                                            <div class="modal-dialog" style="width: 700px;">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                        <h4 class="modal-title" style="text-align:center;">Edit Custom Field</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('contact_custom_fields.update', $field->id) }}" method="post">
                                                            {{ csrf_field() }}
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="col-lg-12 {{ $errors->has('label') ? 'has-error' : '' }}">
                                                                        <div class="form-group">    
                                                                            <label for="nome">Field Label</label>
                                                                            <input type="text" name="label" class="form-control" placeholder="Label" required="" value="{{ $field->label }}" autofocus>
                                                                        </div>
                                                                        @if($errors->has('label'))
                                                                            <span class="help-block" style="margin: 15px 0;">
                                                                                <strong>{{ $errors->first('label') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="col-lg-12 form-group">
                                                                        <label for="nome">Field Type</label>
                                                                        <select name="type" class="form-control" value="{{ $field->type }}">
                                                                            <option value="Textbox">Textbox</option>
                                                                            <option value="Date Textbox">Date Textbox</option>
                                                                            <option value="Currency Textbox">Currency Textbox</option>
                                                                            <option value="Large Textbox">Large Textbox</option>
                                                                            <option value="Yes/No Dropdown">Yes/No Dropdown</option>
                                                                            <option value="Custom Dropdown">Custom Dropdown</option>
                                                                        </select>
                                                                    </div>
                                                                    <script>
                                                                        $('#modal-edit-{{ $field->id }} select[name="type"]').val('{{ $field->type }}');
                                                                    </script>
                                                                </div>
                                                                <div class="col-lg-12" style="margin-top: 15px;">
                                                                    <div class="col-lg-6">
                                                                        <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Close</button>
                                                                    </div> 
                                                                    <div class="col-lg-6">
                                                                        <button type="submit" class="btn btn-primary pull-right">Save Changes</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if($field->type == 'Custom Dropdown')
                                        <div class="modal fade" id="modal-custom-options-{{ $field->id }}">
                                            <div class="modal-dialog" style="width: 700px;">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                        <h4 class="modal-title" style="text-align:center;">Customize Dropdown</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('contact_custom_fields.updateDefaultOptions', $field->id) }}" method="post">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="default_options">
                                                            <div class="row">
                                                                <div class="col-lg-12 main-block default-options-block" style="max-height: 300px; overflow: auto;">
                                                                    <div style="margin-bottom: 15px;"><strong>Default Options</strong></div>
                                                                    @if($field->default_options !== '' && $field->default_options !== null)
                                                                        @foreach (json_decode($field->default_options, true) as $key => $value)
                                                                            <div class="form-group">
                                                                                <input id="option_{{$key}}" class="form-control default-option" type="text" value="{{$value}}" style="width: 50%;">
                                                                                <i class="fa fa-plus" style="margin: 0 5px; cursor: pointer;"></i>
                                                                                <i class="fa fa-minus" style="margin: 0 5px; cursor: pointer;"></i>
                                                                            </div>
                                                                        @endforeach
                                                                    @else
                                                                        <div class="form-group">
                                                                            <input id="option_1" class="form-control default-option" type="text" value="" style="width: 50%;">
                                                                            <i class="fa fa-plus" style="margin: 0 5px; cursor: pointer;"></i>
                                                                            <i class="fa fa-minus" style="margin: 0 5px; cursor: pointer;"></i>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <div class="col-lg-12" style="margin-top: 15px;">
                                                                    <div class="col-lg-6">
                                                                        <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Close</button>
                                                                    </div> 
                                                                    <div class="col-lg-6">
                                                                        <button type="submit" class="btn btn-primary pull-right add-default-options">Save Changes</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </form>
                                @endif
                                @endforeach
                                </div>
                                <div class="" style="margin-top: 30px;">
                                    <a href="#" class="btn btn-default" data-toggle="modal" data-target="#modal-section-add-field-{{$row->id}}" style="width: 100%;">Add Field</a>
                                </div>
                                <!-- <div class="" style="display: flex; justify-content: space-between; margin-top: 30px;">
                                    <a href="#" class="btn btn-default" data-toggle="modal" data-target="#modal-section-add-field-{{$row->id}}" style="width: 45%;">Add Field</a>
                                    <a href="#" class="btn btn-default" data-toggle="modal" data-target="#modal-section-add-field-{{$row->id}}" style="width: 45%;">Add Field</a>
                                </div> -->
                            </div>
                            <div class="actions">
                                <i class="fa fa-ellipsis-v handle"></i>
                                <a href="#" data-toggle="modal" data-target="#modal-section-edit-{{ $row->id }}" style="color: black;"><i class="fa fa-pencil" style="margin: 0 5px;"></i></a>
                                <a href="{{ route('contact_custom_section.destroy', $row->id) }}" style="color: black;"><i class="fa fa-close" style="margin: 0 5px;"></i></a>
                            </div>
                            <div class="modal fade" id="modal-section-edit-{{ $row->id }}">
                                <div class="modal-dialog" style="width: 700px;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <h4 class="modal-title" style="text-align:center;">Edit Section</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('contact_custom_section.update', $row->id) }}" method="post">
                                                {{ csrf_field() }}
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">    
                                                                <label for="nome">Title</label>
                                                                <input type="text" name="title" class="form-control" placeholder="Title" required="" value="{{ $row->title }}" autofocus>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">  
                                                                <input type="checkbox" name="full" value="0"> <label style="margin-left: 5px;">Make this section full sized?</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12" style="margin-top: 15px;">
                                                        <div class="col-lg-12 text-center">
                                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <script>
                                                if("{{$row->full}}" == "0") {
                                                    $('#modal-section-edit-{{ $row->id }} input[name="full"]').prop('checked', false);
                                                    $('#modal-section-edit-{{ $row->id }} input[name="full"]').val('0');
                                                } else {
                                                    $('#modal-section-edit-{{ $row->id }} input[name="full"]').prop('checked', true);
                                                    $('#modal-section-edit-{{ $row->id }} input[name="full"]').val('1');
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="modal-section-add-field-{{ $row->id }}">
                                <div class="modal-dialog" style="width: 700px;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="nav-tabs-custom">
                                                <ul class="nav nav-tabs">
                                                    <li class="active text-center" style="width: 48%;"><a href="#custom{{ $row->id }}" data-toggle="tab">Add Custom Field</a></li>
                                                    <li class="text-center" style="width: 48%;"><a href="#default{{ $row->id }}" data-toggle="tab">Restore Default Field</a></li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="active tab-pane" id="custom{{ $row->id }}">
                                                        <form action="{{ route('store_contact_custom_fields', $row->id) }}" method="post">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="section_id" value="{{$row->id}}">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="col-lg-12 {{ $errors->has('label') ? 'has-error' : '' }}">
                                                                        <div class="form-group">
                                                                            <label for="nome">Field Label</label>
                                                                            <input type="text" name="label" class="form-control" placeholder="Label" required="" autofocus>
                                                                        </div>
                                                                        @if($errors->has('label'))
                                                                            <span class="help-block" style="margin: 15px 0;">
                                                                                <strong>{{ $errors->first('label') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="col-lg-12 form-group">
                                                                        <label for="nome">Field Type</label>
                                                                        <select name="type" class="form-control">
                                                                            <option value="Textbox">Textbox</option>
                                                                            <option value="Date Textbox">Date Textbox</option>
                                                                            <option value="Currency Textbox">Currency Textbox</option>
                                                                            <option value="Large Textbox">Large Textbox</option>
                                                                            <option value="Yes/No Dropdown">Yes/No Dropdown</option>
                                                                            <option value="Custom Dropdown">Custom Dropdown</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12" style="margin-top: 15px;">
                                                                    <div class="col-lg-12 text-center">
                                                                        <button type="submit" class="btn btn-primary">Create Field</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="tab-pane" id="default{{ $row->id }}">
                                                        <form action="{{ route('store_contact_custom_fields', $row->id) }}" method="post">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="section_id" value="{{$row->id}}">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="col-lg-12 form-group">
                                                                        <label for="nome">Default Field</label>
                                                                        <select name="default_field_id" class="form-control">
                                                                        @foreach($default_fields as $d_field)
                                                                            <option value="{{$d_field->id}}">{{$d_field->label}}</option>
                                                                        @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12" style="margin-top: 15px;">
                                                                    <div class="col-lg-12 text-center">
                                                                        <button type="submit" class="btn btn-primary">Restore Field</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="list-group-item">
                    <a href="#" class="btn btn-default" data-toggle="modal" data-target="#modal-section-add" style="width: 100%; margin-top: 10px;">Add Additional Section</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-section-add">
        <div class="modal-dialog" style="width: 700px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" style="text-align:center;">Add Section</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('contact_custom_section.add') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="sort_id" value="{{$max_sort_id+1}}">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-12">
                                    <div class="form-group">    
                                        <label for="nome">Title</label>
                                        <input type="text" name="title" class="form-control" placeholder="Title" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="col-lg-12">
                                    <div class="form-group">  
                                        <input type="checkbox" name="full" value="0"> <label style="margin-left: 5px;">Make this section full sized?</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12" style="margin-top: 15px;">
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function(){
            function updateToDatabase(idString){
                $.ajaxSetup({ headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'}});
                    
                $.ajax({
                    url:'{{url('/contact_custom_fields/update-order')}}',
                    method:'POST',
                    data:{ids:idString},
                    success:function(){
                        alert('Successfully updated');
                    }
                });
            }

            var target = $('.sort_menu');
            target.sortable({
                handle: '.handle',
                placeholder: 'highlight',
                axis: "y",
                update: function (e, ui){
                    var sortData = target.sortable('toArray',{ attribute: 'data-id'})
                    updateToDatabase(sortData.join(','))
                }
            });

            $('input[name="full"]').change(function () {
                if($(this).prop('checked')) {
                    $(this).val('1');
                } else {
                    $(this).val('0');
                }
            });

            $('i.fa-check-square').click(function() {
                $(this).parent().find('.save-button button').click();
            });

            $(".modal-body .main-block.default-options-block").on("click", "i.fa-plus", function(){
                let all_options = $('input.default-option');
                let last_id = 1;
                for(let i = 0; i < all_options.length; i++) {
                    if(parseInt(all_options[i].getAttribute('id').replace('option_', '')) > last_id) {
                        last_id = all_options[i].getAttribute('id').replace('option_', '');
                    }
                }
                let num = parseInt(last_id)+1;
                $('<div class="form-group"><input id="option_'+num+'" class="form-control default-option" type="text" value="" style="width: 50%;"><i class="fa fa-plus" style="margin: 0 5px; cursor: pointer;"></i><i class="fa fa-minus" style="margin: 0 5px; cursor: pointer;"></i></div>').insertAfter($(this).parent());
            });

            $(".modal-body .main-block.custom-options-block").on("click", "i.fa-plus", function(){
                let all_options = $('input.custom-option');
                let last_id = 1;
                for(let i = 0; i < all_options.length; i++) {
                    if(parseInt(all_options[i].getAttribute('id').replace('c_option_', '')) > last_id) {
                        last_id = all_options[i].getAttribute('id').replace('c_option_', '');
                    }
                }
                let num = parseInt(last_id)+1;
                $('<div class="form-group"><input id="c_option_'+num+'" class="form-control custom-option" type="text" value="" style="width: 100%;"><i class="fa fa-plus" style="margin: 0 5px; cursor: pointer;"></i><i class="fa fa-minus" style="margin: 0 5px; cursor: pointer;"></i></div>').insertAfter($(this).parent());
            });

            $(".modal-body .main-block").on("click", "i.fa-minus", function(){
                $(this).parent().remove();
            });

            var buttonItems = document.querySelectorAll('.btn.add-default-options'),
                index, button;
            for (index = 0; index < buttonItems.length; index++) {
                button = buttonItems[index];
                button.addEventListener("mouseover", function( event ) {
                    let all_options = $(this).parent().parent().parent().find('input.default-option');
                    let res = "";
                    for(let i = 0; i < all_options.length; i++) {
                        if(i !== all_options.length-1) {
                            res += '"'+(i+1)+'":"'+all_options[i].value+'", ';
                        } else {
                            res += '"'+(i+1)+'":"'+all_options[i].value+'"';
                        }
                    }
                    $(this).parent().parent().parent().parent().find('input[name="default_options"]').val("{"+res+"}");
                }, false);
            }

            var c_buttonItems = document.querySelectorAll('.btn.add-custom-options'),
                c_index, c_button;
            for (c_index = 0; c_index < c_buttonItems.length; c_index++) {
                c_button = c_buttonItems[c_index];
                c_button.addEventListener("mouseover", function( event ) {
                    let all_options = $(this).parent().parent().parent().find('input.custom-option');
                    let res = "";
                    for(let i = 0; i < all_options.length; i++) {
                        if(i !== all_options.length-1) {
                            res += '"'+(i+1)+'":"'+all_options[i].value+'", ';
                        } else {
                            res += '"'+(i+1)+'":"'+all_options[i].value+'"';
                        }
                    }
                    $(this).parent().parent().parent().parent().find('input[name="custom_options"]').val("{"+res+"}");
                }, false);
            }
        });
    </script>
@endsection