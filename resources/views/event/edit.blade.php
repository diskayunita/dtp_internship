@extends('layouts.main.telkom')

@section('content')
    <div class="page-head">
        <div class="container">
            <div class="page-title">

            </div>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="page-content-inner">
                <div class="blog-page blog-content-2">
                    <section class="publicaciones-blog-home">

                        <div class="row-page row">
                            <div class="portlet light portlet-fit">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-plus font-green"></i>
                                        <span class="caption-subject font-green sbold uppercase">
                                            @lang('event/event-create.update-title')
                                        </span>
                                    </div>
                                </div>

                                <div class="portlet-body">
                                    <div class="row">
                                        @include('event.partials.forms.edit')
                                    </div>
                                </div>
                            </div>
                        </div>

                    </section>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        function showfield(name){
            if(name=='Other')document.getElementById('div1').innerHTML='<input type="text" class="form-control" placeholder="@lang('event/event-create.type_other')" name="type" />';
            else document.getElementById('div1').innerHTML='';
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("input[name='attachment']").change(function (event) {
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
                    max_size: 1024000,
                    allowed_type: ['application/pdf'],
                    size: file[0].files[0].size,
                    type: file[0].files[0].type
                };

                if (params.size > params.max_size) {
                    status.error = true;
                    status.message = 'File size too large (max=1MB)';
                } else {
                    // check if file type is allowed
                    if (!params.allowed_type.includes(params.type)) {
                        status.error = true;
                        status.message = 'Invalid file format. only (*.PDF) format are accepted';
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
