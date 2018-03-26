<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    @yield('title')
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}" />

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/font-awesome.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/simple-line-icons.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/socicon.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/bootstrap-switch.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/DateTimePicker.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/daterangepicker.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css" />

    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="{{asset('assets/js/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/bootstrap.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/js.cookie.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/jquery.slimscroll.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/jquery.blockui.min.js')}}" type="text/javascript"></script>

    <script src="{{asset('assets/js/bootstrap-switch.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/moment.min.js')}}" type="text/javascript"></script>

    <script src="{{asset('assets/js/daterangepicker.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/DateTimePicker.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.0.1/vue-resource.min.js"></script>
</head>

<body class="page-container-bg-solid page-header-menu-fixed login">

<div class="page-wrapper">
    <div class="page-wrapper-row">
        @include('layouts.main.partials.header')
    </div>

    <div class="page-wrapper-row full-height">
        <div class="page-wrapper-middle">
            <div class="page-container">
                <div class="page-content-wrapper">

                    <div class="page-head">
                        <div class="container">
                            <div class="page-title">

                            </div>
                        </div>
                    </div>

                    @include('flash::message')
                    {{--<div class="logo"></div>--}}
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <div class="page-wrapper-row">
        @include('layouts.main.partials.bottom')
    </div>
</div>

<script src="{{asset('assets/js/jquery.validate.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/additional-methods.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/app.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/components-date-time-pickers.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/bootstrap-formhelper-phone.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/login.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/js/layout.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/demo.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/quick-sidebar.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/quick-nav.js')}}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function()
{
    var cdate=new Date();
          var maxDate=(cdate.getFullYear()-15) + '-' + cdate.getMonth() + '-' +cdate.getDate();
          var minDate=(cdate.getFullYear()-75) + '-' + cdate.getMonth() + '-' +cdate.getDate();
  $("#dtBox").DateTimePicker({
    dateFormat: "yyyy-MM-dd",
    maxDate: maxDate,
    minDate:  minDate,
  });
});
</script>
</body>
</html>