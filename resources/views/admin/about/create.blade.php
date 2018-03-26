@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Article</h4>
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active">
                        <a href="#id">Indonesia</a>
                    </li>
                    <li>
                        <a href="#en">English</a>
                    </li>
                </ul>
            </div>
            <div class="card-content">
                <form class="form-horizontal" style="margin-top: 10px;" method="POST" action="{{route('admin.about.store')}}" enctype="multipart/form-data">
                    <div class="tab-content">
                        {{-- form bahasa indonesia --}}
              
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('video') ? ' has-error' : '' }}">
                            <label for="video" class="col-md-2 control-label">Video</label>
                            <div class="col-md-10">
                                <div class="form-line">
                                    <input id="video-en" type="text" class="form-control border-input" name="video" value="" autofocus>
                                    <input name="language" type="hidden" value="en">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane active" id="id">
                            @include('admin.about.id-field')
                        </div>
                        {{-- form bahasa inggris --}}
                        <div class="tab-pane" id="en">
                            @include('admin.about.en-field')
                        </div>
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                <button type="reset" class="btn btn-primary">
                                    Batal
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    Simpan
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