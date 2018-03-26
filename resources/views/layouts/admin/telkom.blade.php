<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <title>Telkom Admin</title>

    <link rel="apple-touch-icon" sizes="76x76" href="{{ url('paper/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ url('paper/img/favicon.png') }}">
    <link href="{{asset('assets/css/font-awesome.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('paper/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('paper/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('paper/css/paper-dashboard.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('paper/css/demo.css') }}" rel="stylesheet" />

    <!-- <link href="{{asset('assets/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" /> -->
    <!--  Fonts and icons     -->
    <link href="{{ URL::asset('paper/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="{{ URL::asset('paper/css/themify-icons.css') }}" rel="stylesheet">
    <!-- Select2 -->
    <link href="{{ URL::asset('css/select2.min.css') }}" rel="stylesheet"> 
    <link href="{{ URL::asset('packages/jquery-ui/jquery-ui.css')}}" rel='stylesheet' type='text/css'>

    <script src="{{ URL::asset('paper/js/jquery-3.1.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/js/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('paper/js/perfect-scrollbar.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('paper/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/js/moment.min.js') }}" type="text/javascript"></script>
    <!-- <script src="{{ URL::asset('paper/js/bootstrap-checkbox-radio.js') }}"></script> -->

    <script src="{{ URL::asset('paper/js/chartist.min.js') }}"></script>
    <script src="{{ URL::asset('paper/js/bootstrap-notify.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap-switch.js') }}"></script>
    <script src="{{ URL::asset('paper/js/paper-dashboard.js') }}"></script>
    <script src="{{ URL::asset('paper/js/demo.js') }}"></script>
    <!-- <script src="{{ URL::asset('assets/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script> -->
    <script src="{{ URL::asset('paper/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('paper/js/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>
    <!-- Select2 -->
    <script src="{{ URL::asset('js/select2.full.min.js') }}"></script>
    <script src="{{ URL::asset('js/ckeditor/ckeditor.js')}}"></script>
    <script src="{{ URL::asset('paper/js/jquery.canvasjs.min.js') }}"></script>
    <script src="{{ URL::asset('paper/js/chart.min.js') }}"></script>
    <script type="text/javascript">
        window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?>
    </script>

    <script type="text/javascript">
        // script show foto
        function readURL(input, image_name) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(image_name).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        document.addEventListener("DOMContentLoaded", function() {
            var elements = document.getElementsByTagName("INPUT");
            for (var i = 0; i < elements.length; i++) {
                elements[i].oninvalid = function(e) {
                    e.target.setCustomValidity("");
                    if (!e.target.validity.valid) {
                        e.target.setCustomValidity("This field cannot be left blank");
                    }
                };
                elements[i].oninput = function(e) {
                    e.target.setCustomValidity("");
                };
            }
        })
    </script>
    @yield('style')
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-background-color="brown" data-active-color="danger">
            <div class="logo">
                <a href="{{ route('admin.dashboards') }}" class="simple-text logo-mini">DDS</a>
                <a href="{{ route('admin.dashboards') }}" class="simple-text logo-normal">Admin Telkom DDS</a>
            </div>

            <div class="sidebar-wrapper">
                <ul class="nav">
                    @include('layouts.admin.partials.menu')
                </ul>
            </div>
        </div>

        <div class="main-panel">
            @include('layouts.admin.partials.navbar')

            <div class="content">
                <div class="container-fluid">

                    <div class="row">
                        @include('flash::message') @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif @yield('content')

                    </div>

                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    @include('layouts.admin.partials.footer')
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ URL::asset('packages/jquery-ui/jquery-ui.min.js')}}"></script>
    <script type="text/javascript">
        $('#province_id').change(function()
        {
            $.get('/api/city/' + this.value + '/province.json', function(cities)
            {
                var $city = $('#city_id');

                $city.find('option').remove().end();

                $.each(cities, function(index, city) {
                    $city.append('<option value="' + city.id  + '">' + city.name + '</option>');
                });
            });
        });
        
        $('#myTab a').click(function(e) {
            e.preventDefault();
            $('.tab-content').find('input').removeAttr('required');
            $(this).tab('show').attr('required', 'required');
            $(this).tab('show').focus();
        });

        $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
            var id = $(e.target).attr("href").substr(1);
            window.location.hash = id;
        });

        var hash = window.location.hash;
        $('#myTab a[href="' + hash + '"]').tab('show');

        $("#image-en").change(function() {
            readURL(this, '#showgambar-en');
        });

        $("#image-id").change(function() {
            readURL(this, '#showgambar-id');
        });

        $("#avatar").change(function() {
            readURL(this, '#show-avatar');
        });

        $('#flash-overlay-modal').modal();

        /*$('.table').DataTable({
            order: [[ 2, 'desc' ]]
        });*/

        $(document).ready(function () {
            $('.table').DataTable({
                'ordering': false,
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.modal-trigger').modal();

            $(document).on('click', '.delete-option', function() {
                $(this).parent(".input-field").remove();
            });

            var material = '<div class="input-field col input-g s12">' +
                '<input name="option_name[]" id="option_name[]" type="text" class="form-control">' +
                '<span style="float:right; cursor:pointer;"class="delete-option">Delete</span>' +
                '<label for="option_name">Options</label>' +
                '<span class="add-option" style="cursor:pointer;">Add Another</span>' +
                '</div>';

            $(document).on('click', '.add-option', function() {
                $(".form-g").append(material);
            });

            $(document).on('change', '#question_type', function() {
                var selected_option = $('#question_type :selected').val();
                if (selected_option === "radio" || selected_option === "checkbox") {
                    $(".form-g").html(material);
                } else {
                    $(".input-g").remove();
                }
            });
            $('p').find('span.icons').hide();
        });
        $("#purpose").select2({
            maximumSelectionLength: 3
        });
        $("#product").select2({
            maximumSelectionLength: 5
        });

        function numberOnly(evt) {
            var theEvent = evt || window.event;
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
            var regex = /[0-9]/;
            if( evt.keyCode >= 37 && evt.keyCode <= 40 ) {
                return; // arrow keys
            }
            if( evt.keyCode === 8 || evt.keyCode === 46 || evt.keyCode === 13 || evt.keyCode === 32 ) {
                return; // backspace / delete
            }
            if (!regex.test(key)) {
                theEvent.returnValue = false;
                if (theEvent.preventDefault) theEvent.preventDefault();
            }
        }
        function alphabetOnly(evt) {
            var theEvent = evt || window.event;
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
            var regex = /[A-Za-z]/;
            if( evt.keyCode >= 37 && evt.keyCode <= 40 ) {
                return; // arrow keys
            }
            if( evt.keyCode === 8 || evt.keyCode === 46 || evt.keyCode === 13 || evt.keyCode === 32  ) {
                return; // backspace / delete
            }
            if (!regex.test(key)) {
                theEvent.returnValue = false;
                if (theEvent.preventDefault) theEvent.preventDefault();
            }
        }

        $('.email').on('keypress',function() {
            var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
            if (testEmail.test(this.value)){
              $('span#emailStatus').addClass('hide');
            } 
            else {
              $('span#emailStatus').removeClass('hide');
            }
        });
    </script>

    @yield('script')

</body>

</html>