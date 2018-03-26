@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h4 class="card-title">Admin Details</h4>
                <p class="category"></p>
            </div>

            <div class="card-content">
                <div class="row">
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        {!! $admin->exists ? $admin->name : '' !!}
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        {!! $admin->exists ? $admin->email : '' !!}
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 control-label">Role</label>
                    <div class="col-sm-10">
                        {!! $admin->exists ? $admin->role : '' !!}
                    </div>
                </div>
            </div>

        </div>  <!-- end card -->

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Permission</h4>
            </div>
            <div class="card-content table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Display Name</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admin->roles()->first()->permissions as $no=>$permission)
                            <tr>
                                <td><a href="{{route('admin.permission.show', $permission)}}">{{$permission->name}}</a></td>
                                <td>{{$permission->description ? $permission->description : '-'}}</td>
                                <td>{{$permission->display_name ? $permission->display_name : '-'}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                <div class="form-group text-center">
                    <a href="{!! route('admin.manage.index') !!}" class="btn btn-default btn-fill btn-wd btn-move-left">
                        <span class="btn-label">
                            <i class="ti-angle-left"></i>
                        </span>
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection