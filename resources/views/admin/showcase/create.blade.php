@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-12">
        <form class="form-horizontal" style="margin-top: 10px;" method="POST" action="{{route('admin.showcase.store')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <i class="ti-plus"></i> New Showcase
                    </h4>
                    <p class="category">Compose new showcase</p>
                </div>

                <div class="card-content">

                    <div class="nav-tabs-navigation">
                        <div class="nav-tabs-wrapper">
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="active">
                                    <a href="#id" id="btn_id">
                                        <img src="{{ asset('paper/img/flags/id.png') }}" alt="Indonesia">
                                        Indonesia
                                    </a>
                                </li>
                                <li>
                                    <a href="#en" id="btn_en">
                                        <img src="{{ asset('paper/img/flags/us.png') }}" alt="English">
                                        English
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="tab-content">
                        {{-- form bahasa indonesia --}}
                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-2 control-label">Image</label>
                            <div class="col-md-10">
                                <img  id="showgambar-en" src="{{ $showcase->exists ? $showcase->image->url() : asset('image/article/default.png') }}" width="510" height="510" class="img img-thumbnail">
                                <div class="form-line">
                                    <input id="image-en" type="file" class="form-control border-input" name="image" value="" autofocus required>
                                    <input name="language" type="hidden" value="en">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane active" id="id">
                            @include('admin.showcase.id-field')
                        </div>

                        {{-- form bahasa inggris --}}
                        <div class="tab-pane" id="en">
                            @include('admin.showcase.en-field')
                        </div>

                        {{-- <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-2 control-label">Category</label>
                            <div class="col-md-10">
                                <div class="form-line">
                                    <select class="form-control border-input" name="category_id">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div> --}}

                    </div>
                </div>

                <div class="card-footer text-center">
                        <a href="{!! route('admin.showcase.index') !!}" class="btn btn-md btn-default btn-fill btn-wd btn-move-left">
                            <span class="btn-label">
                                <i class="ti-angle-left"></i>
                            </span>
                            Cancel
                        </a>
                        <button type="reset" class="btn btn-warning btn-wd">
                            <i class="ti-eraser"></i>
                            Reset
                        </button>
                        <button type="submit" class="btn btn-primary btn-fill btn-wd">
                            <i class="ti-check"></i>
                            Submit
                        </button>
                </div>{{-- card-footer --}}

            </div>{{-- card --}}
        </form>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        var cke1=(function(){
           CKEDITOR.replace( 'content[0]', {
                filebrowserBrowseUrl : '/elfinder/ckeditor',
                filebrowserImageBrowseUrl : '/elfinder/ckeditor',
                filebrowserUploadUrl : "{{route('upload_elfinder',['_token' => csrf_token() ])}}",
                uiColor : '#9AB8F3',
                height : 300
            }); 
        })();

        var cke2=(function(){
           CKEDITOR.replace( 'content[1]', {
                filebrowserBrowseUrl : '/elfinder/ckeditor',
                filebrowserImageBrowseUrl : '/elfinder/ckeditor',
                filebrowserUploadUrl : "{{route('upload_elfinder',['_token' => csrf_token() ])}}",
                uiColor : '#9AB8F3',
                height : 300
            }); 
        })();
        
    </script>
@endsection