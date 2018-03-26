@extends('layouts.main.telkom')
@section('style')
    <link href="{{asset('iCheck/all.css')}}" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .collapsible-body{
            margin: 15px;
        }
        .visible{
            display: block !important;
        }

        #formQuestion input,
        #formQuestion .textarea,
        #formQuestion .checkbox{
            padding-top: 15px;
            margin-bottom: 20px ;
        }
        #formQuestion input,
        #formQuestion .textarea{
            margin-left: 25px !important;
        }
        #formQuestion label{
            font-size: 16px !important;
        }
        .form-submit,
        a.next,
        a.back{
            background:#f36b06;
            display:block;
            width:100px;
            text-align:center;
            padding:7px 13px;
            margin-top: 30px !important;
            color:white;
            text-decoration: none;
            border:none !important;
        }

        a.next,
        .form-submit{
            float:right;
            clear:right;
            margin: 10px 164px 0 0;
            padding-top: 10px !important;
        }

        .form-submit{
            padding-top: 8px !important;
        }
        a.back{
            float:left;
            clear:left;
            margin: 10px 0 0 164px;
        }

        #page li{
            list-style: none;
        }
        #page li a{ color:white; text-decoration: none}
        input[type="text"], textarea, select {
            outline: none;
        }
        .bottom-border{
            border: none !important;
            border-bottom: 2px solid #eee !important;
            margin-top: 15px !important;
            width: 60% !important;
        }
        .bottom-border:hover,
        .bottom-border:active,
        .bottom-border:focus{
            border: none !important;
            border-bottom: 2px solid #d54e21 !important;
            margin-top: 15px !important;
            width: 60% !important;
        }
        .margin-bottom-20{
            margin-bottom: 20px !important;
        }
        .check-box,
        .radio-box{
            margin-bottom: 15px;
            padding-top: 10px;
            padding-bottom: 15px;
        }

        /*Step*/
        .wizard {
            margin: 0px auto;
            background: #fff;
        }

        .wizard .nav-tabs {
            position: relative;
            margin: 40px auto 0 auto;
            background: transparent !important;
            border-bottom: none;
        }

        .wizard > div.wizard-inner {
            position: relative;
        }

        .connecting-line {
            height: 2px;
            background: #e0e0e0;
            position: absolute;
            width: 80%;
            margin: 0 auto;
            left: 0;
            right: 0;
            top: 50%;
            z-index: 1;
        }

        .wizard .nav-tabs > li.active > a,
        .wizard .nav-tabs > li.active > a:hover,
        .wizard .nav-tabs > li.active > a:focus {
            color: #555555;
            cursor: default;
            border: 0;
            border-bottom-color: transparent;
        }

        span.round-tab {
            width: 70px;
            height: 70px;
            line-height: 70px;
            display: inline-block;
            border-radius: 100px !important;
            background: #fff;
            border: 2px solid #e0e0e0;
            z-index: 2;
            position: absolute;
            left: 0;
            text-align: center;
            font-size: 25px;
        }

        span.round-tab i {
            color: #e0e0e0;
        }

        .wizard li.active span.round-tab {
            background: #5bc0de;
            border: 2px solid #fff;
            box-shadow: 0 0 5px #5bc0de;
        }

        .wizard li.active span.round-tab i {
            color: #fff;
        }

        span.round-tab:hover {
            color: #333;
            /*border: 2px solid #333;*/
            /*border: 2px solid #5bc0de;*/

        }
        span.round-tab.done:hover {
            color: #333;
            border: 2px solid #5bc0de;
            box-shadow: 0 0 5px rgba(0,0,0,.4);
        }

        .wizard .nav-tabs > li {
            width: 20%;
        }

        .wizard li:after {
            content: " ";
            position: absolute;
            left: 46%;
            opacity: 0;
            margin: 0 auto;
            bottom: 0px;
            border: 5px solid transparent;
            border-bottom-color: #5bc0de;
            transition: 0.1s ease-in-out;
        }

        .wizard li.active:after {
            /*content: " ";
            position: absolute;
            left: 46%;
            opacity: 1;
            margin: 0 auto;
            bottom: 0px;
            border: 10px solid transparent;
            border-bottom-color: #5bc0de;*/
        }

        .wizard .nav-tabs > li a {
            width: 70px;
            height: 70px;
            margin: 20px auto;
            border-radius: 100% !important;
            padding: 0;
        }

        .wizard .nav-tabs > li a:hover {
            background: transparent;
        }

        .wizard .tab-pane {
            position: relative;
            padding-top: 50px;
        }

        .wizard h3 {
            margin-top: 0;
        }

        .step1 .row {
            margin-bottom: 10px;
        }

        .step_21 {
            border: 1px solid #eee;
            border-radius: 5px;
            padding: 10px;
        }

        .step33,
        .response-message {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 25px;
            margin: 25px auto 10px auto;
        }

        .complete-message {
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 25px;
            margin: 25px auto 10px auto;
        }

        .dropselectsec {
            width: 68%;
            padding: 6px 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
            color: #333;
            margin-left: 10px;
            outline: none;
            font-weight: normal;
        }

        .dropselectsec1 {
            width: 74%;
            padding: 6px 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
            color: #333;
            margin-left: 10px;
            outline: none;
            font-weight: normal;
        }

        .mar_ned {
            margin-bottom: 10px;
        }

        .wdth {
            width: 25%;
        }

        .birthdrop {
            padding: 6px 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
            color: #333;
            margin-left: 10px;
            width: 16%;
            outline: 0;
            font-weight: normal;
        }
        /* according menu */

        #accordion-container {
            font-size: 13px
        }

        .accordion-header {
            font-size: 13px;
            background: #ebebeb;
            margin: 5px 0 0;
            padding: 7px 20px;
            cursor: pointer;
            color: #fff;
            font-weight: 400;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            border-radius: 5px
        }

        .unselect_img {
            width: 18px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .active-header {
            -moz-border-radius: 5px 5px 0 0;
            -webkit-border-radius: 5px 5px 0 0;
            border-radius: 5px 5px 0 0;
            background: #F53B27;
        }

        .active-header:after {
            content: "\f068";
            font-family: 'FontAwesome';
            float: right;
            margin: 5px;
            font-weight: 400
        }

        .inactive-header {
            background: #333;
        }

        .inactive-header:after {
            content: "\f067";
            font-family: 'FontAwesome';
            float: right;
            margin: 4px 5px;
            font-weight: 400
        }

        .accordion-content {
            display: none;
            padding: 20px;
            background: #fff;
            border: 1px solid #ccc;
            border-top: 0;
            -moz-border-radius: 0 0 5px 5px;
            -webkit-border-radius: 0 0 5px 5px;
            border-radius: 0 0 5px 5px
        }

        .accordion-content a {
            text-decoration: none;
            color: #333;
        }

        .accordion-content td {
            border-bottom: 1px solid #dcdcdc;
        }

        @media( max-width: 585px) {
            .wizard {
                width: 90%;
                height: auto !important;
            }
            span.round-tab {
                font-size: 16px;
                width: 50px;
                height: 50px;
                line-height: 50px;
            }
            .wizard .nav-tabs > li a {
                width: 50px;
                height: 50px;
                line-height: 50px;
            }
            .wizard li.active:after {
                content: " ";
                position: absolute;
                left: 35%;
            }

        }
        .tab-pane{
            box-shadow: none;
        }
        .wizard > div.wizard-inner {
            position: relative;
           /* margin-left: -50px;
            margin-right: -100px;*/
        }
        .wizard .done{
            background: #fff;
            border: 2px solid #5bc0de;
        }

        .wizard li span.round-tab.done i {
            color: #5bc0de;
        }
        .wizard li.active span.round-tab.done i {
            color: #fff;
        }

        .wizard .reject{
            background: #fff;
            border: 2px solid #f52800;
        }

        .wizard li span.round-tab.reject i {
            color: #f52800;
        }

        .wizard li.active span.round-tab.reject {
            background: #f52800;
            border: 2px solid #fff;
            box-shadow: 0 0 5px #f52800;
        }

        .wizard li.active span.round-tab.reject i {
            color: #fff;
        }

        .nav-tabs > li > a{
            background: transparent;
        }
        .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover{
            background: transparent;
        }
        table tbody tr td{
            text-align: left;
        }
    </style>
@endsection
@section('content')
    {{--<div class="page-head">
        <div class="container">
            <div class="page-title">

            </div>
        </div>
    </div>--}}

    <div class="page-content">
        <div class="container">
            <div class="page-content-inner">
                <div class="blog-page blog-content-2">
                    {{--<section class="publicaciones-blog-home">--}}
                    <section>

                        <div class="row-page row">

                            <!-- Step Progress -->
                            <div class="portlet light portlet-fit">
                                <div class="container">
                                    <div class="wizard">
                                        <div class="wizard-inner">
                                            <div class="connecting-line"></div>
                                            <ul id="step-tabs" class="nav nav-tabs" role="tablist">

                                                <li role="presentation" class="{{$tab['booking']}}">
                                                    <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Booking">
                                                        <span class="round-tab {{$status['booking']}}">
                                                          <i class="fa fa-book"></i>
                                                        </span>
                                                    </a>
                                                </li>

                                                <li role="presentation" class="{{$tab['interview']}}">
                                                    <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Interview">
                                                        <span class="round-tab {{$status['interview']}}">
                                                          <i class="fa fa-retweet" aria-hidden="true"></i>
                                                        </span>
                                                    </a>
                                                </li>

                                                <li role="presentation" class="{{$tab['approval']}}">
                                                    <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab" title="Approval">
                                                        <span class="round-tab {{$status['approval']}}">
                                                          <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                                        </span>
                                                    </a>
                                                </li>


                                                <li role="presentation" class="{{$tab['survey']}}">
                                                    <a href="#step5" data-toggle="tab" aria-controls="step5" role="tab" title="On Job">
                                                        <span class="round-tab {{$status['survey']}}">
                                                          <i class="fa fa-pencil-square-o"></i>
                                                        </span>
                                                    </a>
                                                </li>

                                                <li role="presentation" class="{{ $tab['completed'] }}">
                                                    <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Completed">
                                                        <span class="round-tab {{ $status['completed'] }}">
                                                          <i class="fa fa-flag-checkered"></i>
                                                        </span>
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Step -->

                            <div class="portlet light portlet-fit tab-content">

                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-plus font-green"></i>
                                        <span class="caption-subject font-green sbold uppercase">
                                            Event Detail / Status
                                        </span>
                                        <span class="label label-info">{{ $statusInfo }}</span>
                                    </div>
                                </div>

                                {{-- booking tab --}}
                                <div class="portlet-body tab-pane {{$tab['booking']}}" role="tabpanel" id="step2">
                                    <div class="step2" style="text-align: left !important;">
                                        @include('flash::message')
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <form class="form-horizontal" role="form" method="POST" action="{{ route('event.store') }}">
                                                    @include('event.partials.show_detail')
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>{{-- booking tab --}}

                                {{-- interview tab --}}
                                <div class="portlet-body tab-pane {{$tab['interview']}}" role="tabpanel" id="step3">
                                    <div class="response-message">
                                        @if ($event)
                                            @if ($event->approval=='rejected')
                                                @include('event.response')
                                            @endif
                                        @endif
                                    </div>
                                    <div class="response-message">
                                    <h4><strong>Event Status</strong></h4>
                                    @if($event->responses)
                                        <table class="table table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th>Message</th>
                                                <th>Response Type</th>
                                                <th>date</th>
                                            </tr>
                                            </thead>
                                            <tbod>
                                                @foreach($event->responses as $key => $response)
                                                    <tr>
                                                        <td>{!! $response->message !!}</td>
                                                        <td>
                                                            <span class="{{ statusLabelColor($response->response_type) }}">
                                                                {{ $response->response_type }}
                                                            </span>
                                                        </td>
                                                        <td>{!! $response->created_at !!}</td>
                                                    </tr>
                                                @endforeach
                                            </tbod>
                                        </table>
                                    @endif
                                    </div>
                                </div>{{-- interview tab --}}

                                {{-- Approval tab --}}
                                <div class="portlet-body tab-pane {{$tab['approval']}}" role="tabpanel" id="step4">
                                    <h4><strong>Reference Letter</strong></h4>
                                    <div class="response-message">
                                        @if ($event)
                                            @if ($event->approval=='approved' || $event->approval=='completed')
                                                @include('event.pdf',['event'=>$event])
                                            @endif
                                        @endif
                                    </div>
                                </div>{{-- Approval tab --}}

                                {{-- Survey tab --}}
                                <div class="portlet-body tab-pane {{$tab['survey']}}" role="tabpanel" id="step5">
                                    @if($hasSurvey)
                                        <div class="mt-element-card mt-element-overlay">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="box-card text-left">
                                                        <div class="text-center">
                                                            <h3 class="font-red bold uppercase" style="margin:5px 0px 25px 0px;">{{ $survey->title}}</h3>
                                                            <p>
                                                                <b>Url Survey : </b>
                                                                <a target="_blank" href="{{ $referral['url'] }}">{{ $referral['url'] }}</a>
                                                            </p>
                                                        </div>

                                                        @if(!$event->is_surveyed)
                                                            {!! Form::open(['id'=>'formQuestion']) !!}
                                                            <input type="hidden" name="event_id" value="{{ $event->id }}">
                                                            <input type="hidden" name="survey_id" value="{{ $survey->id }}">
                                                            <article id="apage_1" style="display: block;">
                                                                <div class="description margin-bottom-20" style="padding: 25px;">
                                                                    <div class="text">
                                                                        {{ $survey->description}}
                                                                    </div>
                                                                </div>
                                                            </article>

                                                            <?php
                                                            $question = $survey->questions;
                                                            $groupSize = 10;
                                                            $groupCounter = $groupSize;
                                                            $areaName = 2;
                                                            $i = 0;
                                                            $total = count($survey->questions);

                                                            while($i < $total) {
                                                                echo "<article id='apage_".$areaName."' style='display:block'>\n";
                                                                while($i < $groupCounter) { ?>
                                                                @if($i < $total)
                                                                    <div class="form-group">
                                                                        <label class="col-md-12 col-lg-12 col-sm-12">{{ ucfirst($question[$i]->title) }}:</label>
                                                                        @if($question[$i]->question_type === 'text')
                                                                            <div  style="margin:0px; padding:0px;">
                                                                                {{ Form::text($question[$i]->id,null,['class'=>'bottom-border ','placeholder'=>'Your Answer']) }}
                                                                            </div>
                                                                        @elseif($question[$i]->question_type === 'textarea')
                                                                            <div class="col-md-12" style="margin:0px; padding:0px;">
                                                                                {{ Form::textarea($question[$i]->id,null,['class'=>'textarea bottom-border','placeholder'=>'Your Answer','rows'=>3]) }}
                                                                            </div>
                                                                        @elseif($question[$i]->question_type === 'radio')
                                                                            @if($question[$i]->option_name)
                                                                                <div class="radio-box col-md-12">
                                                                                    @foreach($question[$i]->option_name as $key=>$value)
                                                                                        <div style="margin:0px; padding:5px;">
                                                                                            <input id="radio_{{ $value }}" value="{{ $value }}"   class="square" name="{{ $question[$i]->id }}" type="radio">
                                                                                            <label for="radio_{{ $value }}">
                                                                                                {{ $value }}
                                                                                            </label>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            @endif
                                                                        @elseif($question[$i]->question_type === 'checkbox')
                                                                            @if($question[$i]->option_name)
                                                                                <div class="check-box col-md-12">
                                                                                    @foreach($question[$i]->option_name as $key => $value)
                                                                                        <div style="margin:0px; padding:5px;">
                                                                                            <input id="checkbox_{{ $value }}" value="{{ $value }}" name="{{ $question[$i]->id }}" class="square" type="checkbox">
                                                                                            <label for="checkbox_{{ $value }}">
                                                                                                {{ $value }}
                                                                                            </label>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            @endif
                                                                        @endif

                                                                    </div>
                                                                @endif
                                                            <?php
                                                            $i++;
                                                            }
                                                            $areaName=$areaName+1;
                                                            $groupCounter += $groupSize;

                                                            echo "</article>\n";

                                                            }
                                                            ?>
                                                            {!! Form::close() !!}
                                                        @else
                                                            <div class="complete-message">
                                                                <h3 class="font-red bold uppercase">
                                                                    @lang('event/event-show.survey_complete_message')
                                                                </h3>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>{{-- /.col-md-8 --}}
                                            </div>
                                        </div>
                                    @endif
                                </div>{{-- Survey tab --}}

                                {{-- Completed tab --}}
                                <div class="portlet-body tab-pane {{$tab['completed']}}" role="tabpanel" id="complete">
                                    <div class="complete-message">
                                        <h3 class="font-red bold uppercase">
                                            @lang('event/event-show.event_complete_message')
                                        </h3>
                                    </div>
                                </div>{{-- Completed tab --}}

                                <div class="clearfix"></div>

                            </div>

                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
    @endsection

@section('script')
    <script src="{{asset('iCheck/icheck.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">

        $(document).ready(function(){
            $('input[type="checkbox"].square, input[type="radio"].square').iCheck({
                checkboxClass: 'icheckbox_square-red',
                radioClass: 'iradio_square-red',
                increaseArea: '20%' // optional
            });
        });
        $("article:not(:last)").append('<a class="next" href="#">Next</a>');
        $("article:first").find('.next').toggleClass('button-center');
        $("article:not(:first)").append('<a class="back" href="#">Back</a>');
        $("article:last").append('<input class="form-submit" type="submit" />');
        $("article:nth-child(1n+2)").hide();
        $("article:first").addClass("visible");
        $("#formQuestion").append("<ul id='page'></ul>");
        var pageNum = 1;
        var currentPage=1;
        $("article").each(function(){
            // $(this).parent().find("ul").append('<li class ="pagetab" id="pagetab_'+pageNum+'"><a class="back" href="#">Back</a></li>');
            $(this).addClass("page" + pageNum);
            pageNum++;
        });
        $('#page > li').hide();
        $("a.next").on("click", function(e){
            e.preventDefault();
            $(this).closest("article").removeClass("visible").hide().next().addClass("visible").fadeIn();
            currentPage++;
            showCurrentTab();
        });
        $("a.back").on("click", function(e){
            e.preventDefault();
            $(this).closest("article").removeClass("visible").hide().prev().addClass("visible").fadeIn();
            currentPage--;
            showCurrentTab();
        });

        function showCurrentTab(){
            $('.pagetab').hide();
            $('#pagetab_'+currentPage).show();
        }
        showCurrentTab();  //Show the first tab


        $(document).ready(function() {
            //Initialize tooltips
            $('.nav-tabs > li a[title]').tooltip();
            //Wizard
            $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
                var $target = $(e.target);
                if ($target.parent().hasClass('disabled')) {
                    return false;
                }
            });

            $(".next-step").click(function(e) {
                var $active = $('.wizard .nav-tabs li.active');
                $active.next().removeClass('disabled').addClass('done');
                nextTab($active);
            });
            $(".prev-step").click(function(e) {
                var $active = $('.wizard .nav-tabs li.active');
                prevTab($active);
            });
        });

        var surveyStatus="{{($hasSurvey) ? 'true' : 'false'}}";
        $("#formQuestion").submit(function(e) {
            if (surveyStatus=='true'){
                $.ajax({
                    type: "POST",
                    url: "{{ route('survey.store',[1,$referral['id']]) }}",
                    data: $("#formQuestion").serialize(),
                    success: function(data){
                        var active = $('.wizard .nav-tabs li.active');
                        active.find('span.round-tab').addClass('done');
                        active.next().removeClass('disabled');
                        nextTab(active);
                        setTimeout(function(){
                            window.location="{!! route('event.index') !!}";
                        }, 10000);
                    },
                    error:function(err){
                        console.log(err);
                    }
                });
            }
            e.preventDefault();
        });
        function nextTab(elem) {
            $(elem).next().find('a[data-toggle="tab"]').click();
        }

        function prevTab(elem) {
            $(elem).prev().find('a[data-toggle="tab"]').click();
        }

        //according menu

        $(document).ready(function() {
            //Add Inactive Class To All Accordion Headers
            $('.accordion-header').toggleClass('inactive-header');

            //Set The Accordion Content Width
            var contentwidth = $('.accordion-header').width();
            $('.accordion-content').css({});

            //Open The First Accordion Section When Page Loads
            $('.accordion-header').first().toggleClass('active-header').toggleClass('inactive-header');
            $('.accordion-content').first().slideDown().toggleClass('open-content');

            // The Accordion Effect
            $('.accordion-header').click(function() {
                if ($(this).is('.inactive-header')) {
                    $('.active-header').toggleClass('active-header').toggleClass('inactive-header').next().slideToggle().toggleClass('open-content');
                    $(this).toggleClass('active-header').toggleClass('inactive-header');
                    $(this).next().slideToggle().toggleClass('open-content');
                } else {
                    $(this).toggleClass('active-header').toggleClass('inactive-header');
                    $(this).next().slideToggle().toggleClass('open-content');
                }
            });

            return false;
        });
    </script>
@endsection
