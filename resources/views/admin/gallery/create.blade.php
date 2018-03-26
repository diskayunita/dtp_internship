@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-12">
        <form class="form-horizontal" style="margin-top: 10px;" method="POST" action="{{route('admin.gallery.store')}}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <i class="ti-plus"></i> New Gallery
                    </h4>
                    <p class="category">Add New image</p>
                </div>{{-- card-header --}}

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

                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-2 control-label">Image</label>
                            <div class="col-md-10">
                                <img  id="showgambar-en" src="{{ $gallery->exists ? $gallery->image->url() : asset('image/article/default.png') }}" width="510" height="510" class="img img-thumbnail">
                                <div class="form-line">
                                    <input id="image-en" type="file" class="form-control border-input" name="image" value="" autofocus>
                                    <input name="language" type="hidden" value="en">
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane active" id="id">
                            @include('admin.gallery.id-field')
                        </div>
              
                        <div class="tab-pane" id="en">
                            @include('admin.gallery.en-field')
                        </div>

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-2 control-label">Category</label>
                            <div class="col-md-10">
                                <div class="form-line">
                                    {{-- <input id="category_id" type="text" class="form-control border-input" name="category_id" value="{{ $article->exists ? $article->first()->category_id : '' }}" autofocus> --}}
                                    <select class="form-control border-input" name="category_id">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>{{-- tab-content --}}

                </div>{{-- card-content --}}

                <div class="card-footer text-center">
                    <a href="{!! route('admin.gallery.index') !!}" class="btn btn-md btn-default btn-fill btn-wd btn-move-left">
                        <span class="btn-label">
                            <i class="ti-angle-left"></i>
                        </span>
                        Cancel
                    </a>
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
        $(document).ready(function () {
            $("input[name='image']").change(function (event) {
                var validate = validateFile($(this));
                if (validate.error) {
                    event.preventDefault();
                    $('button[type="submit"]').attr('disabled', 'disabled'); // lock the submit button
                    alert(validate.message);
                } else {
                    $('button[type="submit"]').prop('disabled', false);
                }
                $('.message').html(validate.message);
            });
        });

        function validateFile(file)
        {
            if (window.File && window.FileReader && window.FileList && window.Blob) {
                var status = {error: false, message: ''};

                var params = {
                    max_size: 5048576,
                    allowed_type: ['image/png','image/gif','image/jpeg','image/pjpeg'],
                    size: file[0].files[0].size,
                    type: file[0].files[0].type,
                };

                if (params.size > params.max_size) {
                    status.error = true;
                    status.message = 'File size too large (max=1MB)';
                } else {
                    // check if file type is allowed
                    if (!params.allowed_type.includes(params.type)) {
                        status.error = true;
                        status.message = 'Invalid file format. only (*.jpg/jpeg, *.png, *.gif) format are accepted';
                    }
                }
            }

            // if there is any error reset the file input
            if (status.error) {
                file.wrap('<form>').closest('form').get(0).reset();
                file.unwrap();
            }

            return status;
        }
        
    </script>
@endsection