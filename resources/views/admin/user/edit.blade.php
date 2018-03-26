@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="ti-pencil"></i> Edit User
                </h4>
                <p class="category">Edit and Update User Details</p>
            </div>

            <form class="form-horizontal" style="margin-top: 10px;" method="post" action="{{route('admin.update_user', $user->id)}}">
                {{ csrf_field() }}
                <div class="card-content">
                    @include('admin.user.fields')

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Confirmed</label>
                            <div class="col-sm-10">
                                <input type="hidden" name="confirmed" value="0">
                                <input type="checkbox" name="confirmed" value="1" {!! ($user->confirmed) ? 'checked="checked"' : ''; !!}>
                            </div>
                        </div>
                    </fieldset>

                </div>

                <div class="card-footer text-center">
                    <a href="{!! route('admin.non-admin.index') !!}" class="btn btn-md btn-default btn-fill btn-wd btn-move-left">
                        <i class="ti-angle-left"></i> Back
                    </a>
                    <button type="submit" class="btn btn-md btn-primary btn-fill btn-wd">
                        <i class="fa fa-check-circle"></i> Submit
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection