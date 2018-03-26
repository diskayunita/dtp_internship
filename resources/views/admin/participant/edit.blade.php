@extends('layouts.admin.telkom')

@section('content')
<div class="col-md-8 col-md-offset-2">
  <div class="card">
    <div class="card-header">
      <h4 class="card-title">
        <i class="ti-pencil"></i> Edit Limit of Participant
      </h4>
      <p class="category">Edit and update existing Limit of Participant</p>
    </div>

    <form id="form-update" class="form-horizontal" style="margin-top: 10px;" method="post" action="{{route('admin.update_participant', $participant_limit->id)}}" enctype="multipart/form-data">
      <div class="card-content">
        {{ csrf_field() }}
        @include('admin.participant.fields')
      </div>

      <div class="card-footer">
        <div class="form-group text-center">
          <a href="{!! route('admin.dashboards') !!}" class="btn btn-md btn-default btn-fill btn-wd btn-move-left">
            <i class="ti-angle-left"></i> Cancel
          </a>
          <button type="submit" class="btn btn-primary btn-fill btn-wd">
            <i class="ti-check"></i> Submit
          </button>
        </div>
      </div>
    </form>
  </div>  <!-- end card -->
</div>
@endsection