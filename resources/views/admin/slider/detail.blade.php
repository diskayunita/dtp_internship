@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <form class="form-horizontal" style="margin-top: 10px;" method="post" action="javascript:void(0);" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="card-header">
                    <h4 class="card-title">
                        <i class="ti-image"></i>
                        Slider Detail
                    </h4>
                    <p class="category">View Slider Image Detail</p>
                </div>{{-- card-header --}}

                <div class="card-content">

                    {{-- tab-navigation --}}
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

                    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                        <label for="image" class="col-md-2 control-label">Image</label>
                        <div class="col-md-10">
                            <img  id="showgambar-en" src="{{ $slider->exists ? $slider->image->url() : asset('image/article/default.png') }}" width="510" height="510" class="img img-thumbnail">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="display_page" class="col-md-2 control-label">Display Page</label>
                        <div class="col-md-10">
                            <div class="form-line">
                                <span class="label label-primary text-capitalize">
                                    {{ $slider->exists ? ($slider->display_page ? $slider->display_page.' Page' : '') : null }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- tab-content --}}
                    <div class="tab-content">
                        @include('admin.slider.detail_field')
                    </div>

                </div>{{-- card-content --}}

                <div class="card-footer text-center">
                    <a href="{!! route('admin.slider.index') !!}" class="btn btn-default btn-fill btn-wd btn-move-left">
                        <i class="ti-angle-left"></i> Back
                    </a>
                    <a href="{!! route('admin.slider.edit', [$slider->id]) !!}" class='btn btn-primary btn-fill btn-wd'>
                        <i class="ti-pencil"></i> Edit
                    </a>
                </div>{{-- card-footer --}}
            </form>
        </div>
    </div>
@endsection