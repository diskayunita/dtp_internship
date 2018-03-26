{{-- Response Modal --}}
<div id="addQuestionModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <form method="POST" action="{{route('admin.store_question', $survey)}}" id="boolean">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">
                        <i class="ti-plus"></i> Add New Question
                    </h4>
                </div>{{-- modal-header --}}

                <div class="modal-body">
                    <div class="container-fluid" >
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="question_type" class="control-label">Question Type</label>
                            <select class="form-control" name="question_type" id="question_type" required>
                                <option value="" disabled {{ old('question_type') === '' ? 'selected' : '' }}>-- Question Type --</option>
                                <option value="text" {{ old('question_type') === 'text' ? 'selected' : '' }}>Text</option>
                                <option value="textarea" {{ old('question_type') === 'textarea' ? 'selected' : '' }}>Textarea</option>
                                <!-- <option value="checkbox" {{ old('question_type') === 'checkbox' ? 'selected' : '' }}>Checkbox</option> -->
                                <option value="radio" {{ old('question_type') === 'radio' ? 'selected' : '' }}>Radio Buttons</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title" class="control-label">Question Title</label>
                            <input class="form-control" name="title" id="title" type="text" value="{{ old('title') }}" required>
                        </div>

                        <div class="form-group">
                            <div class="form-g"></div>
                        </div>
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