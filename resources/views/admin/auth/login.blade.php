@extends('layouts.admin.auth')

@section('content')
    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
        <form class="" role="form" method="POST" action="{{ url('/admin/login') }}">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">Login</h3>
                </div>

                <div class="card-content">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" >E-Mail Address</label>
                        <input id="email" type="email" class="form-control input-no-border" name="email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <small>{{ $errors->first('email') }}</small>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password">Password</label>
                        <input id="password" type="password" class="form-control input-no-border" name="password" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <small>{{ $errors->first('password') }}</small>
                            </span>
                        @endif
                    </div>

                    {{--<div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> Remember Me
                                </label>
                            </div>
                        </div>
                    </div>--}}
                </div>

                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-danger btn-fill btn-wd">
                        Login
                    </button>
                    <div class="forgot">
                        <a href="{{ url('/admin/password/reset') }}">
                            Forgot your password?
                        </a>
                    </div>
                </div>

            </div>
    </div>
    </form>
@endsection
