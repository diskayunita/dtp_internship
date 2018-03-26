@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-12">

        <h4 class="title">Role Detail</h4>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="ti-user"></i>
                    Admin
                </h4>
            </div>

            <div class="card-content">
                @include('admin.role.fields')
            </div>{{-- card-content --}}
        </div>{{-- card end --}}

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="ti-mouse"></i>
                    Permission
                </h4>
            </div>

            <div class="card-content">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Display Name</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($role->permissions as $no=>$permission)
                        <tr>
                            <td><a href="{{route('admin.permission.show', $permission)}}">{{$permission->name}}</a></td>
                            <td>{{$permission->description ? $permission->description : '-'}}</td>
                            <td>{{$permission->display_name ? $permission->display_name : '-'}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>{{-- card-content --}}

            <div class="card-footer text-center">
                <a href="{!! route('admin.role.index') !!}" class="btn btn-default btn-fill btn-wd btn-move-left">
                    <i class="ti-angle-left"></i> Back
                </a>
            </div>
        </div>

    </div>
@endsection