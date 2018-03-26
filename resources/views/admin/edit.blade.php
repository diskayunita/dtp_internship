@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Admin</h4>
            </div>

            <form class="form-horizontal" style="margin-top: 10px;" method="post" action="{{route('admin.update_admin', $admin->id)}}">
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
                            <i class="ti-check"></i>
                            Submit
                        </button>
                    </div>
                </div>
            </form>

        </div>  <!-- end card -->

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Permission</h4>
                <p class="category"></p>
            </div>
            <div class="card-content table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Display Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permissions as $no=>$permission)
                        <tr>
                            <td><a href="{{route('admin.permission.show', $permission)}}">{{$permission->name}}</a></td>
                            <td>{{$permission->description ? $permission->description : '-'}}</td>
                            <td>{{$permission->display_name ? $permission->display_name : '-'}}</td>
                            <td>

                                @php
                                    $method = ($admin->can($permission->name) ? 'delete' : 'add');
                                @endphp

                                <form class="form-horizontal" style="margin-top: 10px;" method="POST" action="{{ route('admin.manage_permission', [$admin->id, $method, $permission->id]) }}" accept-charset="UTF-8">
                                    {{ csrf_field() }}

                                    <button class="btn btn-xs btn-fill" type="submit">{{$method}}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
@endsection