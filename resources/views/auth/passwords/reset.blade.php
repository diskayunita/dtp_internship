@extends('layouts.main.auth')

@section('content')
    <div class="content">
        <form class="login-form" action="{{ route('password.request') }}" method="POST">
            {{ csrf_field() }}
            <h3 class="form-title font-red-thunderbird">@lang('passwords.title')</h3>
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} hide">
                <input id="email" class="form-control form-control-solid placeholder-no-fix hide" type="hidden" autocomplete="off" placeholder="@lang('login.email')" name="email" value="{{ $email or old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="passowrd" class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="@lang('passwords.password')" name="password" required autofocus>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <input id="password-confirm" class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="@lang('passwords.password_confirmation')" name="password_confirmation" required autofocus>
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-actions text-center">
                <button type="submit" class="btn red-thunderbird uppercase">@lang('passwords.title')</button>
            </div>
        </form>
    </div>
@endsection
