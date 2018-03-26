@extends('layouts.admin.auth')

@section('content')
    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
        <form role="form" method="POST" action="{{ url('/admin/password/email') }}">
            {{ csrf_field() }}
            <div class="card">

                <div class="card-header">
                    <h4 class="card-title">Reset Password</h4>
                </div>

                <div class="card-content">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email">E-Mail Address</label>
                        <input id="email" type="email" class="form-control input-no-border" name="email" value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <small>{{ $errors->first('email') }}</small>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-danger btn-fill btn-wd">
                        Send Password Reset Link
                    </button>
                    <div class="forgot">
                        <a href="{{ url('/admin/login') }}">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection