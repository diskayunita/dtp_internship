@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h4 class="card-title">
                    <i class="ti-user"></i> Admin List
                </h4>
                <p class="category">
                    <a href="{{route('admin.manage.create')}}" class="btn btn-primary btn-fill btn-sm btn-wd">
                        <i class="ti-plus"></i> New Admin
                    </a>
                </p>
            </div>

            <div class="card-content table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($admins as $admin)
                        <tr>
                            <td><a href="{{route('admin.manage.show', $admin->id)}}">{{$admin->name}}</a></td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->roles()->first() ? $admin->roles()->first()->name : '-' }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.manage.destroy', $admin->id) }}" accept-charset="UTF-8">
                                    {{ csrf_field() }}<input name="_method" type="hidden" value="DELETE">

                                    <a href="{!! route('admin.manage.edit', [$admin->id]) !!}" class='btn btn-default btn-xs' title="edit">
                                        <i class="ti-pencil"></i>
                                    </a>
                                    @if($admin->hasRole('admin') || $admin->hasRole('idex'))
                                        <button type="submit" class="btn btn-danger btn-xs" title="delete" onclick="return confirm('Yakin ingin menghapus admin ini?')">
                                            <i class="ti-trash"></i>
                                        </button>
                                    @endif
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