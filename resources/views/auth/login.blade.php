@extends('layouts.main.auth')

@section('content')

    <div class="content">
        @include('auth.partials.login-form')
        @include('auth.partials.forgot-password-form')
        @include('auth.partials.register-form')
    </div>

@endsection