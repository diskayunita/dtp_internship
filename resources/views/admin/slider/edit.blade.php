@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-12">

        <div class="card">
            <form id="form-update" class="form-horizontal" style="margin-top: 10px;" method="post" action="{{route('admin.update_slider', $slider->id)}}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="card-header">
                    <h4 class="card-title">
                        <i class="ti-pencil"></i>
                        Edit Slider
                    </h4>
                    <p class="category">Update and Edit Slider Content</p>
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
                            <div class="form-line">
                                <input id="image-en" type="file" class="form-control border-input" name="image" value="" autofocus>
                                <input name="language" type="hidden" value="en">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="display_page" class="col-md-2 control-label">Display Page</label>
                        <div class="col-md-10">
                            @php
                                $display_page  = (old('display_page') ? old('display_page') : $slider->display_page ? $slider->display_page : null);
                            @endphp
                            <select name="display_page" id="display_page" class="form-control" required="">
                                <option value="" {{ $display_page == '' ? 'selected' : '' }}>-- Choose Display Location --</option>
                                <option value="home" {{ $display_page == 'home' ? 'selected' : '' }}>Home Page</option>
                                <option value="about" {{ $display_page == 'about' ? 'selected' : '' }}>About Page</option>
                            </select>
                        </div>
                    </div>

                    {{-- tab-content --}}
                    <div class="tab-content">
                        <div class="tab-pane active" id="id">
                            @include('admin.slider.id-field')
                        </div>
                        <div class="tab-pane" id="en">
                            @include('admin.slider.en-field')
                        </div>
                    </div>{{-- tab-content --}}

                </div>{{-- card-content --}}

                <div class="card-footer text-center">
                    <a href="{!! route('admin.slider.index') !!}" class="btn btn-default btn-fill btn-wd btn-move-left">
                        <i class="ti-angle-left"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary btn-fill btn-wd">
                        <i class="ti-check"></i> Submit
                    </button>
                </div>
            </form>
        </div>{{-- card --}}
    </div>
@endsection