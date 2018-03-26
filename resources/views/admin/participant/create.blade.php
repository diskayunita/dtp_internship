@extends('layouts.admin.telkom')

@section('content')
  <div class="col-md-8 col-md-offset-2">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">
          <i class="ti-plus"></i> Create Limit Of Participant
        </h4>
        <p class="category">Create new Limit Of Participant</p>
      </div>

      <form method="post" action="{{route('admin.participant.store')}}" enctype="multipart/form-data" class="form-horizontal">
        <div class="card-content">
          {{ csrf_field() }}
          @include('admin.participant.fields')
        </div>

        <div class="card-footer">
          <div class="form-group text-center">
            <a href="{!! route('admin.participant.index') !!}" class="btn btn-md btn-default btn-fill btn-wd btn-move-left">
              <span class="btn-label">
                <i class="ti-angle-left"></i>
              </span>
              Cancel
            </a>
            <button type="submit" class="btn btn-primary btn-fill btn-wd">
              <i class="ti-check"></i>
              Submit
            </button>
          </div>
        </div>
      </form>
    </div>  <!-- end card -->
  </div>
@endsection