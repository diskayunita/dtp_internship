@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-12">

        <form class="form-horizontal" style="margin-top: 10px;" method="POST" action="{{route('admin.crew.store')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <i class="ti-user"></i> Add New Teammate
                    </h4>
                    <p class="category">Add New Crew Member</p>
                </div>

                <div class="card-content">
                    @include('admin.crew.form_field')
                </div>

                <div class="card-footer text-center">
                    <a href="{!! route('admin.crew.index') !!}" class="btn btn-default btn-fill btn-wd btn-move-left">
                        <i class="ti-angle-left"></i>
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary btn-fill btn-wd">
                        <i class="ti-check"></i>
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection