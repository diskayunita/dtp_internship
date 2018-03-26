@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Create Admin</h4>
            </div>
            <form method="post" action="{{route('admin.manage.store')}}" enctype="multipart/form-data" class="form-horizontal">
                <div class="card-content">
                    {{ csrf_field() }}
                    @include('admin.fields')
                </div>
                <div class="card-footer">
                    <div class="form-group text-center">
                        <a href="{!! route('admin.manage.index') !!}" class="btn btn-md btn-default btn-fill btn-wd btn-move-left">
                            <span class="btn-label">
                                <i class="ti-angle-left"></i>
                            </span>
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary btn-fill btn-wd">
                            <span class="btn-label">
                                <i class="ti-check"></i>
                            </span>
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>  <!-- end card -->
    </div>
@endsection