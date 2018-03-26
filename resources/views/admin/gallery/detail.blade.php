@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-12">
        <div class="card">

            <form class="form-horizontal" style="margin-top: 10px;">
                {{ csrf_field() }}

                <div class="card-header">
                    <h4 class="card-title">
                        <i class="ti-image"></i>
                        Image Detail
                    </h4>
                    <p class="category">Image Detail</p>
                </div>

                <div class="card-content">
                    <div class="nav-tabs-navigation">
                        <div class="nav-tabs-wrapper">
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="active">
                                    <a href="#id">
                                        <img src="{{ asset('paper/img/flags/id.png') }}" alt="Indonesia">
                                        Indonesia
                                    </a>
                                </li>
                                <li>
                                    <a href="#en">
                                        <img src="{{ asset('paper/img/flags/us.png') }}" alt="English">
                                        English
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="tab-content">

                        {{-- Image Field --}}
                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-2 control-label">Image</label>
                            <div class="col-md-10">
                                <img  id="showgambar-en" src="{{ $gallery->exists ? $gallery->image->url() : asset('image/article/default.png') }}" width="510" height="510" class="img img-thumbnail">
                            </div>
                        </div>

                        {{-- Tab Pane --}}
                        @include('admin.gallery.detail_field')

                        {{-- Category Field --}}
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-2 control-label">Category</label>
                            <div class="col-md-10">
                                <div class="form-line">
                                    {{ $category }}
                                </div>
                            </div>
                        </div>
                    </div>{{-- tab-content --}}

                </div>{{-- card-content --}}

                <div class="card-footer text-center">
                    <a href="{!! route('admin.gallery.index') !!}" class="btn btn-default btn-fill btn-wd btn-move-left">
                        <span class="btn-label">
                            <i class="ti-angle-left"></i>
                        </span>
                        Back
                    </a>

                    <a href="{!! route('admin.gallery.edit', [$gallery->id]) !!}" class='btn btn-default btn-primary btn-fill btn-wd'>
                        <span class="btn-label">
                            <i class="ti-pencil"></i>
                        </span>
                        Edit
                    </a>
                </div>
            </form>
        </div>{{-- card --}}
    </div>
@endsection