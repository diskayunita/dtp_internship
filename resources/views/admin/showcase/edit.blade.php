@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="ti-pencil"></i> Edit Showcase</h4>
                <p class="category">
                    Edit and update current showcase
                </p>
            </div>

            <form id="form-update" class="form-horizontal" style="margin-top: 10px;" method="post" action="{{route('admin.update_showcase', $showcase->id)}}" enctype="multipart/form-data">
                <div class="card-content">
                    {{ csrf_field() }}

                    <div class="nav-tabs-navigation">
                        <div class="nav-tabs-wrapper">
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="active">
                                    <a href="#id" data-toggle="tab">
                                        <img src="{{ asset('paper/img/flags/id.png') }}" alt="Indonesia">
                                        Indonesia
                                    </a>
                                </li>
                                <li>
                                    <a href="#en" data-toggle="tab">
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
                            <img  id="showgambar-en" src="{{ $showcase->exists ? $showcase->image->url() : asset('image/showcase/default.png') }}" width="510" height="510" class="img img-thumbnail">
                            <div class="form-line">
                                <input id="image-en" type="file" class="form-control border-input" name="image" value="" autofocus>
                                <input name="language" type="hidden" value="en">
                            </div>
                        </div>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane active" id="id">
                            <div class="form-group">
                                <label for="title" class="col-md-2 control-label"></label>
                                <div class="col-md-10">
                                    Indonesia
                                    <img src="{{ asset('paper/img/flags/id.png') }}" alt="Indonesia">
                                </div>
                            </div>
                            @include('admin.showcase.id-field')
                        </div>
                        <div class="tab-pane" id="en">
                            <div class="form-group">
                                <label for="title" class="col-md-2 control-label"></label>
                                <div class="col-md-10">
                                    English
                                    <img src="{{ asset('paper/img/flags/us.png') }}" alt="English">
                                </div>
                            </div>
                            @include('admin.showcase.en-field')
                        </div>

                        {{-- <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-2 control-label">Category</label>
                            <div class="col-md-10">
                                <div class="form-line">
                                    <select class="form-control border-input" name="category_id">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{$category->id == $showcase->category_id ? 'selected' : ''}}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>{{-- card-content --}}

                <div class="card-footer">
                    <div class="form-group text-center">
                        <a href="{!! route('admin.showcase.index') !!}" class="btn btn-md btn-default btn-fill btn-wd btn-move-left">
                            <span class="btn-label">
                                <i class="ti-angle-left"></i>
                            </span>
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary btn-fill btn-wd">
                            <i class="ti-check"></i>
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
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