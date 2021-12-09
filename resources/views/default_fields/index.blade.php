@extends('layouts.AdminLTE.index')

@section('icon_page', '')

@section('title', 'Default Fields')

@section('description', 'These are default fields the administrators can setup to be used by default.')

@section('content')
  <div class="row">
    <div class="col-lg-12 default-fields-block">
      <div class="main-content">
        <p>To get started, select which details page you like to customize</p>
        @foreach($data as $d)
          <a href="{{ route('template_default_fields', $d->id) }}" class="default-block">
            <span>{{$d->menu_name}}</span>
          </a>
        @endforeach
      </div>
    </div>
  </div>
@endsection