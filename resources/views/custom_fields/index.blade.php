@extends('layouts.AdminLTE.index')

@section('icon_page', '')

@section('title', 'Custom Fields')

@section('description', 'If you have information you want to save but can\'t find a place for it or want to rearrange the order of your forms, custom fields allow you to. You can add 
or remove any field and place it where it makes sense for you.')

@section('content')
  <div class="row">
    <div class="col-lg-12 custom-fields-block">
      <div class="main-content">
        <p>To get started, select which details page you like to customize</p>
        <div class="customizing-block">
          <span>Seller Leads / Properties</span>
        </div>
        <div class="customizing-block">
          <span>Buyer Leads / Buyer Details</span>
        </div>
        <div class="customizing-block">
          <span>Contact Details</span>
        </div>
      </div>
    </div>
  </div>
@endsection