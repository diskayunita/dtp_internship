@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-12">

        <form class="form-horizontal" method="POST" style="margin-top: 10px;" action="{{route('admin.update_crew', $crew->id)}}" enctype="multipart/form-data">
            {{ csrf_field() }} {{ method_field('PATCH') }}
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <i class="ti-pencil"></i> Edit Crew
                    </h4>
                    <p class="description">
                        Edit and Update Crew info
                    </p>
                </div>

                <div class="card-content">
                    @include('admin.crew.form_field')
                </div>

                <div class="card-footer text-center">
                    <a href="{!! route('admin.crew.index') !!}" class="btn btn-default btn-fill btn-wd btn-move-left">
                        <i class="ti-angle-left"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary btn-fill btn-wd">
                        <i class="ti-check"></i> Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection