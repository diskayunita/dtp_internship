@extends('layouts.main.auth')
@section('title')
  <title>Telkom DDS | Login-Register</title>
@endsection
@section('content')

    <div class="content">
        @include('auth.partials.login-form')
        @include('auth.partials.forgot-password-form')
        @include('auth.partials.register-form')
    </div>

@endsection