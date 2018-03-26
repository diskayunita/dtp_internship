@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="ti-user"></i> User List
                </h4>
                <p class="category">All Registered User</p>
            </div>
            <div class="card-content">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td><a href="{{route('admin.non-admin.show', $user->id)}}">{{$user->name}}</a></td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->created_at}}</td>
                                <td>
                                    <form method="POST" action="{{route('admin.non-admin.destroy', $user->id)}}" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
                                        <a href="{!! route('admin.non-admin.show', [$user->id]) !!}" class='btn btn-success btn-xs'>
                                            <i class="ti-eye"></i>
                                        </a>
                                        <a href="{!! route('admin.non-admin.edit', [$user->id]) !!}" class='btn btn-default btn-xs'>
                                            <i class="ti-pencil"></i>
                                        </a>
                                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Yakin ingin menghapus {{$user->name}} ?')">
                                            <i class="ti-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>{{-- card-content --}}
        </div>
    </div>
@endsection