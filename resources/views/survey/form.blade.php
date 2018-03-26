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
        /*#page{float:left; margin: 10px 0 0 0}
        #page li{float:left; margin:0 5px 0 0; padding:5px 15px;  background:#f36b06;  text-align:center;  border-radius: 4px; -moz-border-radius: 4px; -webkit-border-radius: 4px; color:white; }*/
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
    </style>
@endsection()
@section('content')
    <section class="content">
        <div class="container">
            <div class="page-content-inner col-md-offset-2 col-md-8 ">
                <div class="portlet light portlet-fit ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-note font-red"></i>
                            <span class="caption-subject font-red bold uppercase">Survey</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="mt-element-card mt-element-overlay">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="box-card">
                                        <div class="text-center">
                                            <h3 class="font-red bold uppercase" style="margin:5px 0px 25px 0px;">{{ $survey->title}}</h3>
                                        </div> 
                                        {!! Form::open(['id'=>'formQuestion','url'=>route('survey.store',[$survey->id,$referral_id])]) !!}
                                        <input type="hidden" name="event_id" value="{{ $referral_id }}">
                                        <input type="hidden" name="survey_id" value="{{ $survey->id }}">
                                        <article id="apage_1" style="display: block;">
                                            <div class="description margin-bottom-20">
                                                <div class="text">
                                                    {{ $survey->description}}
                                                </div> 
                                            </div>
                                        </article>
                                        <?php
                                            $question=$survey->questions;
                                            $groupSize = 5;
                                            $groupCounter = $groupSize;
                                            $areaName=2;
                                            $i = 0;
                                            $total=count($survey->questions);
                                            while($i < $total){
                                                echo "<article id='apage_".$areaName."' style='display:block'>\n";
                                                while($i < $groupCounter){ ?>
                                                    @if($i <$total)
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
                                    </div>
                                </div>{{-- /.col-md-8 --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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

    </script>
@endsection