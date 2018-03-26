@extends('layouts.main.telkom')

@section('style')
    <link href="{{asset('iCheck/all.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Muli:400,300" rel="stylesheet" type="text/css">
    <style>
		.radio-box,.check-box {
			margin-bottom: 15px;
			padding-top: 10px;
			padding-bottom: 15px;
		}

		h3.desc-survey {
			margin-top: 10px;
		}
		
		.steps .col-sm-4 {
			display: flex;
			align-items: center;
			justify-content: center;
		}
		
		.steps .col-sm-4 .btn {
			width: 150px;
		}
		
		@media screen and (max-width: 768px) {
			.steps .col-sm-4 {
				margin-top: 5px;
				margin-bottom: 5px;
			}
		}
		
		.survey-container {
			width: 100%;
			height: 400px;
			margin-top: 30px;
			overflow-y: hidden;
			overflow-x: hidden;
		}
		.survey-container form label{
			font-weight: bold;
		}
		.survey-container form .form-full {
			height:400px;
			padding: 10px;
			font-family: 'Muli', Arial, sans-serif;
		}
		.survey-container form .form-full input {
			margin-top: 20px;
		}
		.bottom-border {
			outline: none;
			border: none !important;
			border-bottom: 2px solid #eee !important;
			margin-top: 15px !important;
			width: 100% !important;
		}
		.bottom-border:hover,
		.bottom-border:active,
		.bottom-border:focus{
			border: none !important;
			border-bottom: 2px solid #df2800 !important;
			margin-top: 15px !important;
			width: 100% !important;
		}
		.surveys {
			margin: 15px auto 15px auto;
			border: solid 1px #dde3ec;
		}
		.portlet {
			margin-bottom: 0px !important;
		}
		
	</style>
@endsection

@section('content')
	<div class="page-head">
		<div class="container">
			<div class="page-title">

			</div>
		</div>
	</div>
	<div class="page-content-inner surveys">
		<div class="portlet light portlet-fit ">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-layers font-red"></i>
					<span class="caption-subject font-red bold uppercase">{{ $survey->title }}</span>
				</div>
			</div>
			<div class="portlet-body">
				<div class="mt-element-card mt-element-overlay">
					<div class="row">
						<div class="col-lg-10 col-lg-offset-1">
							<h3 class="desc-survey">{{ $survey->description }}</h3>
							<!-- <div class="steps">
								<div class="col-sm-4 col-sm-offset-4">
									<button class="btn btn-default">Questions</button>
								</div>
							</div> -->
						</div>
					</div>
					<div class="row">
						<div class="col-lg-10 col-lg-offset-1">
							<div class="survey-container">
								@php $index = 1; $i = 0; $question=$survey->questions; $total=count($survey->questions);@endphp
								{!! Form::open(['id'=>'formQuestion','url'=>route('survey.store',[$survey->id,$referral_id])]) !!}
								<input type="hidden" name="event_id" value="{{ $referral_id }}">
                                <input type="hidden" name="survey_id" value="{{ $survey->id }}">
								@foreach ($survey->questions as $question)
								@if($question->question_type === 'text')
									<div class="form-group form-full" indexes="{{ $index }}">
										<label class="col-md-12 col-lg-12 col-sm-12 alertabove" indexes="{{ $index }}">{{ ucfirst($question->title) }}:</label>
										{{ Form::text($question->id,null,['class'=>'bottom-border ','placeholder'=>'Your Answer']) }}
									</div>
								@elseif($question->question_type === 'textarea')
									<div class="form-group form-full" indexes="{{ $index }}">
										<label class="col-md-12 col-lg-12 col-sm-12 alertabove" indexes="{{ $index }}">{{ ucfirst($question->title) }}:</label>
										{{ Form::textarea($question->id,null,['class'=>'textarea bottom-border','placeholder'=>'Your Answer','rows'=>3]) }}
									</div>
								@elseif($question->question_type === 'radio')
									@if($question->option_name)
									<div class="form-group form-full" indexes="{{ $index }}">
										<label class="col-md-12 col-lg-12 col-sm-12 alertabove" indexes="{{ $index }}">{{ ucfirst($question->title) }}:</label>
										<div class="radio-box col-md-12">
											@foreach($question->option_name as $key=>$value)
												<div style="margin:0px; padding:5px;">
													<input id="radio_{{ $value }}_{{ $index }}" value="{{ $value }}" class="square" name="{{ $question->id }}" type="radio">
													<label for="radio_{{ $value }}_{{ $index }}">
														{{ $value }}
													</label>
												</div>
											@endforeach
										</div>
									</div>
									@endif
								@elseif($question->question_type === 'checkbox')
										@if($question->option_name)
									<div class="form-group form-full" indexes="{{ $index }}">
										<label class="col-md-12 col-lg-12 col-sm-12 alertabove" indexes="{{ $index }}">{{ ucfirst($question->title) }}:</label>
										<div class="check-box col-md-12">
											@foreach($question->option_name as $key => $value)
												<div style="margin:0px; padding:5px;">
												<input id="checkbox_{{ $value }}_{{ $index }}" value="{{ $value }}" name="{{ $question->id }}[]" class="square" type="checkbox">
												<label for="checkbox_{{ $value }}_{{ $index }}">
													{{ $value }}
												</label>
												</div>
											@endforeach
										</div>
									@endif
								@endif
								@php $index++; @endphp
								@endforeach	
									</div>
								{!! Form::close() !!}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-10 col-lg-offset-1">
							<button class="btn btn-default prevSurvey">
								Prev
							</button>
							<button class="btn btn-default pull-right nextSurvey">
								Next
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
<script src="{{asset('iCheck/icheck.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
	var countSurvey = $('.form-full').length;
	$(document).ready(function(){
		$('.survey-container:eq(1)').hide();
        $('input[type="checkbox"].square, input[type="radio"].square').iCheck({
            checkboxClass: 'icheckbox_square-red',
            radioClass: 'iradio_square-red',
            increaseArea: '20%' // optional
        });

        var i = 1;
        $('.prevSurvey').hide();

        $('.nextSurvey').click(function(e) {
			var _self1 = $('.survey-container:eq(0)').css('display');
			if(i != countSurvey){
				if (validateOptions(i) == false) {
					return false;
				}

				$('.alerts').remove();
				i += 1;
				$('.survey-container:eq(0)').scrollTo($('.form-full[indexes="'+i+'"]'), 1000);
				checkCount(i);
			} else {
				if (validateOptions(i) == false) {
					return false;
				}

				$('form#formQuestion').submit();
			}
        });
        $('.prevSurvey').click(function(e) {
        	i -= 1;
        	$('.survey-container:eq(0)').scrollTo($('.form-full[indexes="'+i+'"]'), 1000);
        	checkCount(i);
        });
    });

    function checkCount(i) {
		if (i < countSurvey && i != 1) {
        	$('.prevSurvey').show();
        	$('.nextSurvey').html('Next');
        	$('.nextSurvey').show();
        } else if (i == 1) {
			$('.prevSurvey').hide();
		} else if (i == countSurvey) {
			$('.nextSurvey').html('Finish');
		}
    }

  	function appendAlert(eq) {
  		$('.alerts').remove();
  		var alert = '<small class="font-red alerts">Anda belum mengisi field ini </small>';
		$(alert).insertAfter($(".alertabove[indexes='"+eq+"']"));
  	}

    function validateOptions(i) {
    	if ($('.form-full[indexes="'+i+'"] input').attr('type') == "text") {
			if ($('.form-full[indexes="'+i+'"] input').val() == "") {
				appendAlert(i);
				return false;
			}
		} else if ($('.form-full[indexes="'+i+'"] input').attr('type') == "radio") {
			if ($('.form-full[indexes="'+i+'"] .checked input').val() == undefined) {
				appendAlert(i);
				return false;
			}
		} else if ($('.form-full[indexes="'+i+'"]').find('textarea').html() == "") {
			if ($('.form-full[indexes="'+i+'"] textarea').val() == "") {
				appendAlert(i);
				return false;
			}
		} else if ($('.form-full[indexes="'+i+'"] input').attr('type') == "checkbox") {
			if ($('.form-full[indexes="'+i+'"] .checked input').val() == undefined) {
				appendAlert(i);
				return false;
			}
		}
    }
</script>
@endsection