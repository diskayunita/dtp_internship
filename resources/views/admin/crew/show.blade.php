@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-6 col-md-offset-3">
        <div class="card card-user">
            <div class="image">
                <img src="{{ asset('paper/img/background.png') }}" alt="...">
            </div>
            <div class="card-content">
                <div class="author text-capitalize">
                    @php
                    $avatar = $crew->avatar->url('medium') ?
                        (file_exists($_SERVER['DOCUMENT_ROOT'].$crew->avatar->url('medium')) ?
                            $crew->avatar->url('medium') : asset("img/faces/default_profile.png")) :
                                asset("img/faces/default_profile.png");
                    @endphp
                    <img class="avatar border-white" src="{{ $avatar }}" alt="...">
                    <h4 class="card-title">
                        {{ $crew->name }} <span class="badge badge-default">{{ $crew->gender }}</span><br>
                        <small>{{ $crew->position }}</small><br>
                    </h4>
                </div>
                <p class="text-center text-capitalize">
                    <a href="{{ $crew->facebook }}" target="_blank" title="Go to {{ $crew->name }} facebook">
                        <i class="ti-facebook"></i> {{ $crew->facebook }}
                    </a>
                    <br/>
                    <a href="{{ $crew->twitter }}" target="_blank" title="Go to {{ $crew->name }} twitter">
                        <i class="ti-twitter"></i> {{ $crew->twitter }}
                    </a>
                </p>
            </div>

            <div class="card-footer text-center">
                <a href="{!! route('admin.crew.index') !!}" class="btn btn-md btn-default btn-fill btn-wd btn-move-left">
                    <i class="ti-angle-left"></i>
                    Back
                </a>
                <a href="{!! route('admin.crew.edit', [$crew->id]) !!}" class="btn btn-md btn-primary btn-fill btn-wd">
                    <i class="fa fa-pencil"></i>
                    Edit
                </a>
            </div>
        </div>
    </div>
@endsection