@php session_start(); @endphp

<header class="main-header">
  <a href="{{ route('home') }}" class="logo">
    <!-- <span class="logo-mini">{!! \App\Models\Config::find(1)->app_name_abv !!}</span>
    <span class="logo-lg">{!! \App\Models\Config::find(1)->app_name !!}</span> -->
    
    @if(isset($_COOKIE["company_id"]) && $_COOKIE["company_id"] !== 0)
      <img src="{{ asset(\App\Models\Config::find($_COOKIE['company_id'])->caminho_img_login) }}" width="50px" class="img-thumbnail">
    @endif
  </a>
  <nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li>
          <a href="#" style="padding: 13px 15px 7px 15px;"><i class="fa fa-mobile" style="color: white; font-size: 28px;"></i></a>
        </li>
        <li>
          <a href="/phone" style="padding: 15px 15px 7px 15px;"><i class="fa fa-phone" style="color: white; font-size: 24px;"></i></a>
        </li>
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            @if(file_exists(Auth::user()->avatar))
              <img src="{{ asset(Auth::user()->avatar) }}" class="user-image">
            @else
              <img src="{{ asset('public/img/config/nopic.png') }}" class="user-image">
            @endif            
            <span class="hidden-xs">
            <!-- @if(Auth::user('name'))
              {{ Auth::user()->name }}
            @endif -->
            </span>
          </a>
          <ul class="dropdown-menu">
            <li class="user-header">
              @if(file_exists(Auth::user()->avatar))
                <img src="{{ asset(Auth::user()->avatar) }}" class="img-circle">
              @else
                <img src="{{ asset('public/img/config/nopic.png') }}" class="img-circle">
              @endif
              <p>
                @if(Auth::user('name'))
                  {{ Auth::user()->name }}
                @endif
                <small>Member Since {{ Auth::user()->created_at->format('M Y') }}</small>
              </p>
            </li>
            <li class="user-footer">
              <div class="pull-left">
                <a href="{{ route('profile') }}" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>