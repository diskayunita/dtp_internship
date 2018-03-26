{{-- Response Modal --}}
<div id="responModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        {{-- Modal Content --}}
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Message</h4>
            </div>{{-- modal-header --}}

            <div class="modal-body">
                <div class="container-fluid" >
                    {!! Form::open(['route' =>['admin.event_response',$event->id],'method'=>'POST','class'=>'form-horizontal']) !!}
                    {{ csrf_field() }}


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
                </button>
            </div>{{-- modal-footer--}}
            {!! Form::close() !!}
        </div>

    </div>{{-- modal-dialoge --}}
</div>