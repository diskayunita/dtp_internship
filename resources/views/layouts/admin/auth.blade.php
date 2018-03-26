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

    <link href="{{ asset('paper/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('paper/css/animate.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('paper/css/paper-dashboard.css') }}" rel="stylesheet"/>
    <link href="{{ asset('paper/css/demo.css') }}" rel="stylesheet" />

    <!--  Fonts and icons     -->
    <link href="{{ asset('paper/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="{{ asset('paper/css/themify-icons.css') }}" rel="stylesheet">

    <!--   Core JS Files. Extra: TouchPunch for touch library inside jquery-ui.min.js   -->
    <script src="{{ asset('paper/js/jquery-3.1.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('paper/js/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('paper/js/perfect-scrollbar.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('paper/js/bootstrap.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('paper/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('paper/js/es6-promise-auto.min.js') }}"></script>
    <script src="{{ asset('paper/js/moment.min.js') }}"></script>
    <script src="{{ asset('paper/js/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('paper/js/bootstrap-selectpicker.js') }}"></script>
    <script src="{{ asset('paper/js/bootstrap-switch-tags.js') }}"></script>
    <script src="{{ asset('paper/js/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('paper/js/chartist.min.js') }}"></script>
    <script src="{{ asset('paper/js/bootstrap-notify.js') }}"></script>
    <script src="{{ asset('paper/js/sweetalert2.js') }}"></script>
    <script src="{{ asset('paper/js/jquery-jvectormap.js') }}"></script>
    <script src="{{ asset('paper/js/jquery.bootstrap.wizard.min.js') }}"></script>
    <script src="{{ asset('paper/js/bootstrap-table.js') }}"></script>
    <script src="{{ asset('paper/js/jquery.datatables.js') }}"></script>
    <script src="{{ asset('paper/js/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('paper/js/paper-dashboard.js') }}"></script>
    <script src="{{ asset('paper/js/jquery.sharrre.js') }}"></script>
    <script src="paper/js/demo.js"></script>

    <script type="text/javascript">
        window.Laravel = "<?php echo json_encode(['csrfToken' => csrf_token()]); ?>"
    </script>

    <script type="text/javascript">
        // script show foto
        function readURL(input, image_name) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(image_name).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</head>

<body>
    <div class="wrapper wrapper-full-page">

        <div class="full-page login-page" data-color="" data-image="{{ asset('paper/img/background.png') }}">
            <div class="content">
                <div class="container">
                    <div class="row">
                        @include('flash::message')
                        @if (count($errors) > 0)
                            <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                                <div class="alert alert-danger alert-with-icon">
                                    <span data-notify="icon" class="fa fa-warning"></span>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        @yield('content')
                    </div>
                </div>
            </div>

            <footer class="footer footer-transparent">
                <div class="container">
                    <div class="copyright">
                        © <script>document.write(new Date().getFullYear())</script>,
                        made with <i class="fa fa-heart heart"></i> by Telkom DDS
                    </div>
                </div>
            </footer>

            <div class="full-page-background" style="background-image: url('{{ asset('paper/img/background.png') }}') "></div>
        </div>

    </div>
    {{-- /.wrapper end --}}

</body>

</html>