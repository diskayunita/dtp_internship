{{-- Response Modal --}}
<div id="responModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        {{-- Modal Content --}}
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Event Response</h4>
            </div>{{-- modal-header --}}

            <div class="modal-body">
                <div class="container-fluid" >
                    {!! Form::open(['route' =>['admin.event_response',$event->id],'method'=>'POST','class'=>'form-horizontal']) !!}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="response_type">Response Type : </label>
                        <select class="form-control border-input" id="response_type" name="response_type" onchange="enableEditor(this)" required>
                            <option value=""> -- Select Response -- </option>
                            <option value="approved">Approve</option>
                            <option value="rejected">Reject</option>
                            <option value="interview">Interview</option>
                            <option value="completed">Complete</option>
                        </select>
                    </div>


                    {{-- Reference Number --}}
                    <div class="removable"></div>
                    <div class="form-group">
                        <span class="help-block">Tell the reason why?</span>
                    </div>
                    <div class="form-group"><td>
                        
                    </div>
                    
                </div>
            </div>{{-- modal-body --}}

            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-fill btn-wd pull-right">
                    <i class="fa fa-paper-plane"></i>
                    Submit
                </button>
            </div>{{-- modal-footer--}}
            {!! Form::close() !!}
        </div>

    </div>{{-- modal-dialoge --}}
</div>