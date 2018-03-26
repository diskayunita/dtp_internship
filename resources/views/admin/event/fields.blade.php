<fieldset>
    <div class="form-group">
        <label class="col-sm-2 control-label">Nama PIC :</label>
        <div class="col-sm-10 control-label" style="text-align: left !important;">
            <p>{{$event->exists ? $event->username : '' }}</p>
        </div>
    </div>
</fieldset>
<!-- /Nama event -->

<!-- Nama Category -->
<fieldset>
    <div class="form-group">
        <label class="col-sm-2 control-label">Kontak PIC :</label>
        <div class="col-sm-10 control-label" style="text-align: left !important;">
            <p>{{$event->exists ? $event->contact : '' }}</p>
        </div>
    </div>
</fieldset>
<!-- /Nama event -->

<!-- Nama Category -->
<fieldset>
    <div class="form-group">
        <label class="col-sm-2 control-label">Email PIC :</label>
        <div class="col-sm-10 control-label" style="text-align: left !important;">
            <p>{{$event->exists ? $event->email : '' }}</p>
        </div>
    </div>
</fieldset>
<!-- /Nama event -->

<!-- Nama Category -->
<fieldset>
    <div class="form-group">
        <label class="col-sm-2 control-label">User University :</label>
        <div class="col-sm-10 control-label" style="text-align: left !important;">
            <p>{{$event->exists ? $event->university : '' }}</p>
        </div>
    </div>
</fieldset>
<!-- /Nama event -->


@php
$result_explode = explode('|', $event->area);
@endphp



<!-- Description event -->
<fieldset>
    <div class="form-group">
        <label class="col-sm-2 control-label">Catatan :</label>
        <div class="col-sm-10 control-label" style="text-align: left !important;">
            <p>{{ $event->exists ? $event->description : '' }}</p>
        </div>
    </div>
</fieldset>
<!-- /Description Category -->

<!-- Description event -->
<fieldset>
    <div class="form-group">
        <label class="col-sm-2 control-label">Catatan :</label>
        <div class="col-sm-10 control-label" style="text-align: left !important;">
            <p>
                {{$event->approval ? 'Approved' : 'Pending'}}
                <span>
                {{-- @if($event->approval)
                        <a href="{!! route('admin.event.unapprove', [$event->id]) !!}" class='btn btn-primary btn-xs' title="unapprove"><i class="glyphicon glyphicon-remove-circle"></i></a>
                      @else
                        <a href="{!! route('admin.event.approve', [$event->id]) !!}" class='btn btn-primary btn-xs' title="approve"><i class="glyphicon glyphicon-ok-circle"></i></a>
                      @endif --}}
                <!-- Trigger the modal with a button -->
                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#responModal">Give response</button>

                    <!-- Modal -->
                    <div id="responModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Form Response Event</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid" >
                                        <div class="form-group">
                                            <label for="response_type">Respon Type : </label>
                                            <select class="form-control border-input" id="response_type" name="response_type" required>
                                                <option value=""> -- Select Option -- </option>
                                                <option value="Approve">Approve</option>
                                                <option value="Reject">Reject</option>
                                                <option value="Interview">Interview</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="message">Message :</label>
                                            <textarea  class="form-control border-input" id="message" name="message" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-default">Submit</button>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </span>
            </p>
        </div>
    </div>
</fieldset>
<!-- /Description Category