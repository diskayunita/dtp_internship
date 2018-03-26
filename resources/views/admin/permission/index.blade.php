@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="ti-shield"></i> Permission Table
                </h4>
                <p class="category">
                    <a href="{{route('admin.permission.create')}}" class="btn btn-sm btn-primary btn-fill btn-wd">
                        <i class="ti-plus"></i> New Permission
                    </a>
                </p>
            </div>

            <div class="card-content table-responsive">
                <table class="table table-striped table-hover">
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
                                <form method="POST" action="{{route('admin.permission.destroy', $permission->id)}}" accept-charset="UTF-8">
                                    {{ csrf_field() }}
                                    <input name="_method" type="hidden" value="DELETE">

                                    <a href="{!! route('admin.permission.edit', [$permission->id]) !!}" class='btn btn-default btn-xs' title="edit">
                                        <i class="ti-pencil"></i>
                                    </a>
                                    <button type="submit" class="btn btn-danger btn-xs" title="delete" onclick="return confirm('Yakin ingin menghapus permission ini?')">
                                        <i class="ti-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection