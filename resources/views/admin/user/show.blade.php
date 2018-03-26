@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-6 col-md-offset-3">
        <div class="card card-user">
            <div class="image">
                <img src="{{ asset('paper/img/background.png') }}" alt="...">
            </div>
            <div class="card-content">
                <div class="author">
                    <img class="avatar border-white" src="{{ asset('paper/img/faces/face-2.jpg') }}" alt="...">
                    <h4 class="card-title">
                        {{ $user->name }} <span class="badge badge-default">{{ $user->gender }}</span><br>
                        <small>{{ $user->jobs_type }} - {{ $user->jobs_name }}</small><br>
                    </h4>
                    @php
                    if ($user->confirmed) :
                        $style = 'label label-success';
                        $text = 'email verified';
                    else:
                        $style = 'label label-warning';
                        $text = 'waiting verification';
                    endif;
                    @endphp
                    <small class="{{ $style }}">{{ $text }}</small>
                </div>
                <br />
                <p class="text-center">
                    <i class="fa fa-mobile-phone"></i> {{ $user->mobile_number }}<br />
                    <i class="fa fa-phone"></i> {{ $user->phone_number }}<br />
                    <i class="fa fa-envelope-o"></i> {{ $user->email }}<br />
                </p>

            </div>

            <div class="card-footer text-center">
                <a href="{!! route('admin.non-admin.index') !!}" class="btn btn-md btn-default btn-fill btn-wd btn-move-left">
                    <span class="btn-label">
                        <i class="ti-angle-left"></i>
                    </span>
                    Back
                </a>
                <a href="{!! route('admin.non-admin.edit', [$user->id]) !!}" class="btn btn-md btn-primary btn-fill btn-wd">
                    <span class="btn-label">
                        <i class="fa fa-pencil"></i>
                    </span>
                    Edit
                </a>
            </div>
        </div>
    </div>
@endsection