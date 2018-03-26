@extends('layouts.admin.telkom')

@section('content')
  <div class="col-md-12">
    <div class="card">
      <div class="header">
        <h4 class="video">Edit Article</h4>
        <ul class="nav nav-tabs" id="myTab">
          <li class="active">
            <a href="#id">Indonesia</a>
          </li>
          <li>
            <a href="#en">English</a>
          </li>
        </ul>
      </div>
      <div class="content">
        <form id="form-update" class="form-horizontal" style="margin-top: 10px;" method="post" action="{{route('admin.update_about', $about->id)}}" enctype="multipart/form-data">

          {{ csrf_field() }}
          <div class="form-group{{ $errors->has('video') ? ' has-error' : '' }}">
            <label for="video" class="col-md-2 control-label">Link Video</label>
            <div class="col-md-10">
              <div class="form-line">
                <input id="video" type="text" class="title_id form-control border-input" name="video" value="{{ $about->first()->video }}">
              </div>
            </div>
          </div>
          <div class="tab-content">
            <div class="tab-pane active" id="id">
              @include('admin.about.id-field')
            </div>
            <div class="tab-pane" id="en">
              @include('admin.about.en-field')
            </div>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  Simpan
                </button>
                <button type="reset" class="btn btn-primary">
                  Batal
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
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