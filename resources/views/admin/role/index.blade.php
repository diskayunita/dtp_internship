@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="ti-mouse"></i>
                    Role Table
                </h4>
                {{--<p class="category">
                    <a href="{{route('admin.role.create')}}" class="btn btn-primary">New Role</a>
                </p>--}}
            </div>{{-- card-header --}}

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
                    @foreach($roles as $no=>$role)
                        <tr>
                            <td><a href="{{route('admin.role.show', $role)}}">{{$role->name}}</a></td>
                            <td>{{$role->description ? $role->description : '-'}}</td>
                            <td>{{$role->display_name ? $role->display_name : '-'}}</td>
                            <td>
                                <form method="POST" action="{{route('admin.role.destroy', $role->id)}}" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
                                    <a href="{!! route('admin.role.show', [$role->id]) !!}" class='btn btn-success btn-xs' title="detail">
                                        <i class="ti-eye"></i>
                                    </a>
                                    <a href="{!! route('admin.role.edit', [$role->id]) !!}" class='btn btn-default btn-xs' title="edit">
                                        <i class="ti-pencil"></i>
                                    </a>
                                    <button type="submit" class="btn btn-danger btn-xs"  title="delete" onclick="return confirm('Yakin ingin menghapus role ini?')">
                                        <i class="ti-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>{{-- card-content --}}
        </div>{{-- card --}}
    </div>
@endsection