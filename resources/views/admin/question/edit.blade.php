@extends('layouts.admin.telkom')

@section('content')

<div class="col-md-12">

  <div class="card">
    <form method="POST" action="{{route('admin.update_question', $question)}}">
      <div class="card-header">
        <h4 class="card-title">
          <i class="ti-pencil"></i> Edit Question
        </h4>
      </div>

      <div class="card-content">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
        <div class="form-group">
            <label for="question_type" class="control-label">Question Type</label>
            <select class="form-control" name="question_type" id="question_type" required>
                <option value="" disabled {{ $question->question_type === '' ? 'selected' : '' }}>-- Question Type --</option>
                <option value="text" {{ $question->question_type === 'text' ? 'selected' : '' }}>Text</option>
                <option value="textarea" {{ $question->question_type === 'textarea' ? 'selected' : '' }}>Textarea</option>
                <!-- <option value="checkbox" {{ $question->question_type === 'checkbox' ? 'selected' : '' }}>Checkbox</option> -->
                <option value="radio" {{ $question->question_type === 'radio' ? 'selected' : '' }}>Radio Buttons</option>
            </select>
        </div>
        <div class="form-group">
          <label for="title" class="control-label">Question</label>
          <input class="form-control" type="text" name="title" id="title" value="{{ $question->title }}" required>
        </div>
        <div class="form-group">
            <div class="form-g"></div>
        </div>
      </div>

      <div class="card-footer text-center">
        <div class="input-field col s12">
          <a href="{!! route('admin.survey.index') !!}" class="btn btn-default btn-fill btn-wd btn-move-left">
            <i class="ti-angle-left"></i> Back
          </a>
          <button class="btn btn-primary btn-fill btn-wd">
            <i class="ti-check"></i> Update
          </button>
        </div>
      </div>
    </form>
  </div>


  {{--<div class="card">
  <div class="card-header">
    <h4 class="card-title">
      <i class="ti-check-box"></i> Answer List
    </h4>
    <p class="category">Question Answer Option</p>
    <p class="category">
      <button type="button" class="btn btn-sm btn-primary btn-fill btn-wd" data-toggle="modal" data-target="#answerModal">
        <i class="ti-plus"></i> Add Answer
      </button>
    </p>
  </div>
  <div class="card-content">
    @include('admin.question.partials.answer_modal')
  </div>
  <div class="card-footer">

  </div>
</div>--}}

<div class="card">
  <div class="card-header">
    <h4 class="card-title">
      <i class="ti-check-box"></i>

      @if($question->question_type =='text' || $question->question_type=='textarea')
        Answer Box
      @else
        Option List
      @endif 
    </h4>

    <li style="box-shadow:none; list-style: none">
      <div class="collapsible-body">
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
                  <input type="radio" name="option_name" id="{{ $key }}" />
                  <label for="{{ $key }}">{{ $value }}</label>
                </p>
              @endforeach
            @endif
          @elseif($question->question_type === 'checkbox')
            @if($question->option_name)
              @foreach($question->option_name as $key => $value)
              <p style="margin:0px; padding:0px;">
                <input type="checkbox" id="{{ $key }}" />
                <label for="{{$key}}">{{ $value }}</label>
              </p>
              @endforeach
            @endif
          @endif
        {!! Form::close() !!}
      </div>
    </li>
    
  </div>

</div>


</div>{{-- col-md-12 --}}
@endsection