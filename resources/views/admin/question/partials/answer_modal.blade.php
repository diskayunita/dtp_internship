{{-- Response Modal --}}
<div id="answerModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <form class="form-horizontal" method="POST" action="{{ route('admin.store_answer') }}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">
                        <i class="ti-plus"></i> Add New Answer
                    </h4>
                </div>{{-- modal-header --}}

                <div class="modal-body">
                    <div class="container-fluid" >
                        {{ csrf_field() }}
                        <input type="hidden" name="question_id" value="{{ $question->id }}">
                        <input type="text" name="answer[]" class="form-control">

                        @if($question->question_type === 'text')
                            <input name="answer[]" type="text" class="form-control border-input">
                        @elseif($question->question_type === 'textarea')
                            <div class="input-field col s12">
                                <textarea id="textarea1" class="materialize-textarea"></textarea>
                                <label for="textarea1">Provide answer</label>
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
                    </div>
                </div>{{-- modal-body --}}

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
                        <i class="fa fa-remove"></i> Close
                    </button>

                    <button type="submit" class="btn btn-primary btn-fill btn-wd pull-right">
                        <i class="ti-check"></i> Submit
                    </button>
                </div>{{-- modal-footer--}}
            </form>
        </div>{{-- modal-content --}}

    </div>{{-- modal-dialoge --}}
</div>