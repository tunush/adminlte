@extends('layouts.AdminLTE.index')

@section('icon_page', '')

@section('title', 'Default Fields')

@section('description', 'These are default fields the administrators can setup to be used by default.')

@section('content')
  <div class="row">
    <div class="col-lg-12 default-fields-block">
      <div class="main-content">
        <p>To get started, select which details page you like to customize</p>
        <a href="{{ route('seller_leads_default_fields') }}" class="default-block">
            <span>Seller Leads / Properties</span>
        </a>
        <a href="{{ route('buyer_leads_default_fields') }}" class="default-block">
          <span>Buyer Leads / Buyer Details</span>
        </a>
        <a href="{{ route('contact_default_fields') }}" class="default-block">
          <span>Contact Details</span>
        </a>
      </div>
    </div>
  </div>
@endsection