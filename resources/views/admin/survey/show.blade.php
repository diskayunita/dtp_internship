@extends('layouts.admin.telkom')
@section('style')
<style type="text/css">
    .box-calendar{
      margin-bottom: 15px !important;
    }
</style>
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
    <div class="col-md-12">
        {{--<h4 class="title">{{ $survey->title }}</h4>
        <p class="category">{{ $survey->description }}</p>--}}

        {{--<div class="card">

            <form method="POST" action="{{route('admin.store_question', $survey)}}" id="boolean" class="form-horizontal">
                {{ csrf_field() }}

                <div class="card-header">
                    <h4 class="card-title">
                        <i class="ti-plus"></i> Add New Question
                    </h4>
                </div>--}}{{-- crad-header --}}{{--

                <div class="card-content">
                    <div class="form-group">
                        <label for="question_type" class="col-md-2 control-label">Question Type</label>
                        <div class="col-md-10">
                            <select class="form-control" name="question_type" id="question_type">
                                <option value="" disabled selected>Choose your option</option>
                                <option value="text">Text</option>
                                <option value="textarea">Textarea</option>
                                <option value="checkbox">Checkbox</option>
                                <option value="radio">Radio Buttons</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-md-2 control-label">Question Title</label>
                        <div class="col-md-10">
                            <input class="form-control" name="title" id="title" type="text">
                        </div>
                    </div>

                </div>--}}{{-- END : card-content --}}{{--

                <div class="card-footer text-center">
                    <a href="{!! route('admin.survey.index') !!}" class="btn btn-md btn-default btn-fill btn-wd btn-move-left">
                        <i class="ti-angle-left"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary btn-fill btn-wd">
                        <i class="ti-check"></i> Submit
                    </button>
                </div>
            </form>

        </div>--}}{{-- END : card end --}}

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="ti-clipboard"></i> Survey Details
                    <a href="{{route('admin.survey.edit', $survey->id)}}" class='btn btn-info btn-fill btn-xs pull-right' title="edit">
                        <i class="ti-pencil"></i>
                    </a>
                </h4>
                <p class="category">View Survey Detail</p>
            </div>

            <div class="card-content">
                <h4 class="card-title">{{ $survey->title }} <small>{{isset($survey->global_type) ? ($survey->global_type ? "(Global)" : "(Spesific)") : '' }}</small></h4>
                <p class="category">{{ $survey->description }}</p>
            </div>

            <div class="card-footer">
                <a href="{!! URL::previous() !!}" class="btn btn-sm btn-default btn-fill btn-wd btn-move-left">
                    <i class="ti-angle-left"></i> Back
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="ti-list-ol"></i> Question List
                </h4>
                <p class="category">
                    <button type="button" class="btn btn-sm btn-primary btn-fill btn-wd" data-toggle="modal" data-target="#addQuestionModal">
                        <i class="ti-plus"></i> Add Question
                    </button>
                </p>
            </div>{{-- crad-header --}}

            <div class="card-content">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($survey->questions as $key => $question)
                            <tr>
                                <td>{{ $question->title }}</td>
                                <td>{{ $question->question_type }}</td>
                                <td>
                                    <form method="POST" action="{{route('admin.delete_question', $question->id)}}" accept-charset="UTF-8">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <a href="{{route('admin.edit_question', $question->id)}}" class='btn btn-default btn-xs' title="edit">
                                            <i class="ti-pencil"></i>
                                        </a>

                                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Yakin ingin menghapus {{$survey->title}} ?')">
                                            <i class="ti-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @include('admin.survey.partials.add_question_modal')
                </div>

                {{--@foreach($survey->questions as $key => $question)

                    <li style="box-shadow:none;list-style-type: decimal" class="collapsible-header">
                            {{ $question->title }} <a href="{{route('admin.edit_question', $question->id)}}" style="float:right;">Edit</a>
                        <div class="collapsible-body" style="margin-left: 15px !important;">
                            {!! Form::open() !!}
                            @if($question->question_type === 'text')
                                {{ Form::text('title') }}
                            @elseif($question->question_type === 'textarea')
                                <div class="row">
                                    <div class="input-field col s12">
                                        <textarea id="textarea1" class="materialize-textarea"></textarea>
                                        <label for="textarea1">Provide answer</label>
                                    </div>
                                </div>
                            @elseif($question->question_type === 'radio')
                                @if($question->option_name)
                                    @foreach($question->option_name as $key=>$value)
                                        <p style="margin:0px; padding:0px;">
                                            <input type="radio" name="option_name" value="{{ $value }}" id="{{ $key }}" />{{ $value }}
                                        </p>
                                    @endforeach
                                @endif
                            @elseif($question->question_type === 'checkbox')
                                @if($question->option_name)
                                    @foreach($question->option_name as $key => $value)
                                        <p style="margin:0px; padding:0px;">
                                            <input type="checkbox" value="{{ $value }}" id="{{ $key }}" /> {{ $value }}
                                        </p>
                                    @endforeach
                                @endif
                            @endif
                            {!! Form::close() !!}
                        </div>
                    </li>
                @endforeach--}}
            </div>{{-- END : card-content --}}

        </div>{{-- END : card end --}}
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="ti-list-ol"></i> Question Preview
                </h4>
                <p class="category">Question List</p>
            </div>

            <div class="card-content">
                <div class="row" >
                {!! Form::open(['id'=>'formQuestion']) !!}
                <?php
                    $question=$survey->questions;
                    $groupSize = 5;
                    $groupCounter = $groupSize;
                    $areaName=1;
                    $i = 0;
                    $total=count($survey->questions);
                    while($i < $total){
                        echo "<article id='apage_".$areaName."' style='display:block'>\n";
                        while($i < $groupCounter){ ?>
                            @if($i <$total)
                                <div class="form-group">
                                    <label class="col-md-12 col-lg-12 col-sm-12">{{ ucfirst($question[$i]->title) }}: <a href="{{route('admin.edit_question', $question[$i]->id)}}" style="float:right;">Edit</a></label>
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
            </div>

            <div class="card-footer">
            </div>
        </div>
    </div>{{-- END : col-md-12 end --}}
@endsection
@section('script')
    <script src="{{asset('iCheck/icheck.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        var checkBock=(function(){
            $('input[type="checkbox"].square, input[type="radio"].square').iCheck({
                checkboxClass: 'icheckbox_square-red',
                radioClass: 'iradio_square-red',
                increaseArea: '20%' // optional
            });
        })();
        $("article:not(:last)").append('<a class="next" href="#">Next</a>');
        $("article:first").find('.next').toggleClass('button-center');
        $("article:not(:first)").append('<a class="back" href="#">Back</a>');
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