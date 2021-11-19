@section('title', 'Reset Password')
@section('layout_css')
    <style>
        #box-login-personalize{
            width: 360px;
            margin: 3% auto;
        }
    </style>
@stop

<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layouts.AdminLTE._includes._head')
    </head>
    <body class="hold-transition login-page">
    <div id="box-login-personalize">
            @if(isset($_COOKIE["company_id"]) && $_COOKIE["company_id"] != 0)
                <div class="login-logo">
                    @if(\App\Models\Config::find($_COOKIE["company_id"])->img_login == 'T')
                        <img src="{{ asset(\App\Models\Config::find($_COOKIE['company_id'])->caminho_img_login) }}" width="{{ \App\Models\Config::find($_COOKIE['company_id'])->tamanho_img_login }}%"/>
                        <br/>
                    @endif
                
                    <strong>{!! \App\Models\Config::find($_COOKIE["company_id"])->app_name !!}</strong>
                </div>
            @endif
            <div class="login-box-body">
                <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
                <form  method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group has-feedback">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong><p class="text-red">{{ $errors->first('email') }}</p></strong>
                        </span>
                    @endif
                    <div class="row">
                        <div class="col-xs-12">
                          <button type="submit" class="btn btn-primary btn-block btn-flat">Send Password Reset Link</button>
                        </div>
                        <br/><br/><br/>
                        <div class="col-xs-12">
                            <center>
                                <a href="{{ route('login') }}">Login</a>
                            </center>
                        </div>
                    </div>                  
                </form> 
            </div>
        </div>

        <!-- <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Reset Password') }}</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Send Password Reset Link') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        @include('layouts.AdminLTE._includes._script_footer')
    </body>
</html>
