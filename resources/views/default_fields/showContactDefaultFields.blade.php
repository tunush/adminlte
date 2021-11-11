@extends('layouts.AdminLTE.index')

@section('icon_page', '')

@section('title', 'Customizing Default Fields > Contact Details')

@section('menu_pagina')	
@endsection

@section('content') 
    <div class="">
        <div class="row">
            <div class="col-md-12">	
                <h3 class="text-center">Default Fields</h3>
                <div>
                    @foreach($fields as $field)
                    <form action="{{ route('contact_default_fields.updateValue', $field->id) }}" method="post">
                        {{ csrf_field() }}
                        <div id="{{$field->id}}" class="form-group" style="width: 40%;">
                            <label>{{$field->label}}</label>
                            @if($field->type == 'Textbox')
                                <input type="text" name="value" class="form-control" value="{{ $field->value }}">
                                <i class="fa fa-check-square" style="margin: 0 5px; cursor: pointer;"></i>
                                <a href="#" data-toggle="modal" data-target="#modal-edit-{{ $field->id }}" style="color: black;"><i class="fa fa-pencil" style="margin: 0 5px;"></i></a>
                                <a href="{{ route('contact_default_fields.destroy', $field->id) }}" style="color: black;"><i class="fa fa-trash" style="margin: 0 5px;"></i></a>
                            @endif
                            @if($field->type == 'Date Textbox')
                                <input type="date" name="value" class="form-control" value="{{ $field->value }}">
                                <i class="fa fa-check-square" style="margin: 0 5px; cursor: pointer;"></i>
                                <a href="#" data-toggle="modal" data-target="#modal-edit-{{ $field->id }}" style="color: black;"><i class="fa fa-pencil" style="margin: 0 5px;"></i></a>
                                <a href="{{ route('contact_default_fields.destroy', $field->id) }}" style="color: black;"><i class="fa fa-trash" style="margin: 0 5px;"></i></a>
                            @endif
                            @if($field->type == 'Large Textbox')
                                <textarea name="value" class="form-control" rows="6">{{ $field->value }}</textarea>
                                <i class="fa fa-check-square" style="margin: 0 5px; cursor: pointer;"></i>
                                <a href="#" data-toggle="modal" data-target="#modal-edit-{{ $field->id }}" style="color: black;"><i class="fa fa-pencil" style="margin: 0 5px;"></i></a>
                                <a href="{{ route('contact_default_fields.destroy', $field->id) }}" style="color: black;"><i class="fa fa-trash" style="margin: 0 5px;"></i></a>
                            @endif
                            @if($field->type == 'Currency Textbox')
                                <input type="text" name="value" class="form-control currency_input" value="{{ $field->value }}">
                                <i class="fa fa-check-square" style="margin: 0 5px; cursor: pointer;"></i>
                                <a href="#" data-toggle="modal" data-target="#modal-edit-{{ $field->id }}" style="color: black;"><i class="fa fa-pencil" style="margin: 0 5px;"></i></a>
                                <a href="{{ route('contact_default_fields.destroy', $field->id) }}" style="color: black;"><i class="fa fa-trash" style="margin: 0 5px;"></i></a>
                            @endif
                            @if($field->type == 'Yes/No Dropdown')
                                <select name="value" class="form-control">
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                                <i class="fa fa-check-square" style="margin: 0 5px; cursor: pointer;"></i>
                                <a href="#" data-toggle="modal" data-target="#modal-edit-{{ $field->id }}" style="color: black;"><i class="fa fa-pencil" style="margin: 0 5px;"></i></a>
                                <a href="{{ route('contact_default_fields.destroy', $field->id) }}" style="color: black;"><i class="fa fa-trash" style="margin: 0 5px;"></i></a>

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
                                    <a href="#" data-toggle="modal" data-target="#modal-default-options-{{ $field->id }}" style="color: black;"><i class="fa fa-gear"></i></a>
                                </div>
                                <i class="fa fa-check-square" style="margin: 0 5px; cursor: pointer;"></i>
                                <a href="#" data-toggle="modal" data-target="#modal-edit-{{ $field->id }}" style="color: black;"><i class="fa fa-pencil" style="margin: 0 5px;"></i></a>
                                <a href="{{ route('contact_default_fields.destroy', $field->id) }}" style="color: black;"><i class="fa fa-trash" style="margin: 0 5px;"></i></a>

                                <script>
                                    $('#{{ $field->id }} select[name="value"]').val('{{ $field->value }}');
                                </script>
                            @endif

                            <div class="col-lg-12 save-button" style="display: none;">
                               <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-fw fa-save"></i> Save</button>
                            </div>
                        </div>

                        <div class="modal fade" id="modal-edit-{{ $field->id }}">
                            <div class="modal-dialog" style="width: 700px;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <h4 class="modal-title" style="text-align:center;">Edit Default Field</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('contact_default_fields.update', $field->id) }}" method="post">
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
                        <div class="modal fade" id="modal-default-options-{{ $field->id }}">
                            <div class="modal-dialog" style="width: 700px;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <h4 class="modal-title" style="text-align:center;">Customize Dropdown</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('contact_default_fields.updateDefaultOptions', $field->id) }}" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="default_options">
                                            <div class="row">
                                                <div class="col-lg-12 main-block" style="max-height: 300px; overflow: auto;">
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
                    @endforeach
                </div>
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-add" style="padding: 8px 100px; width: 35%; margin-top: 20px;">
                    Add Field
                </a>
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
                    <h4 class="modal-title" style="text-align:center;">Add Default Field</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('store_contact_default_fields') }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-12 {{ $errors->has('label') ? 'has-error' : '' }}">
                                    <div class="form-group">    
                                        <label for="nome">Field Label</label>
                                        <input type="text" name="label" class="form-control" placeholder="Label" required="" value="{{ old('label') }}" autofocus>
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
                            <div class="col-lg-12">
                                <div class="col-lg-12 form-group">
                                    <label for="nome">Field Value</label>
                                    <input type="text" name="value" class="form-control" placeholder="Value">
                                    <!-- <select name="value" class="form-control">
                                        <option value="Value">Value</option>
                                    </select> -->
                                </div>
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

    <script>
        $('i.fa-check-square').click(function() {
            $(this).parent().find('.save-button button').click();
        });

        $(".modal-body .main-block").on("click", "i.fa-plus", function(){
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
    </script>
@endsection