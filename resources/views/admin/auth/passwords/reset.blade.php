@extends('layouts.admin.auth')

@section('content')
    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">

        <form role="form" method="POST" action="{{ url('/admin/password/reset') }}">
            {{ csrf_field() }}
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Reset Password</h4>
                </div>{{-- card-header --}}

                <div class="card-content">
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} hide">
                        <label for="email">E-Mail Address</label>
                        <input id="email" type="email" class="form-control input-no-border hide" name="email" value="{{ $email or old('email') }}" autofocus>
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

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password-confirm">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control input-no-border" name="password_confirmation" required>
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <small>{{ $errors->first('password_confirmation') }}</small>
                            </span>
                        @endif
                    </div>
                </div>{{-- card-content --}}

                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-danger btn-fill btn-wd">
                        Reset Password
                    </button>
                </div>{{-- card-footer --}}
            </div>{{-- card --}}
        </form>

    </div>
@endsection