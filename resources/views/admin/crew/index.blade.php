@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="ti-user"></i>
                    Team List
                </h4>
                <p class="category">
                    <a href="{{route('admin.crew.create')}}" class="btn btn-sm btn-primary btn-fill btn-wd">
                        <i class="ti-plus"></i> New Team
                    </a>
                </p>
            </div>

            <div class="card-content table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th><i class="ti-facebook"></i> Facebook</th>
                            <th><i class="ti-twitter"></i> Twitter</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($crews as $key => $crew)
                        @php
                            $avatar = $crew->avatar->url('medium') ?
                                (file_exists($_SERVER['DOCUMENT_ROOT'].$crew->avatar->url('medium')) ?
                                    $crew->avatar->url('thumb') : asset("img/faces/default_profile.png")) :
                                        asset("img/faces/default_profile.png");
                        @endphp
                        <tr>
                            <td>
                                <img src="{{ $avatar }}" alt="{{ $crew->name }}-avatar" class="img-responsive">
                            </td>
                            <td>{{ $crew->name }}</td>
                            <td>{{ $crew->position }}</td>
                            <td>{{ $crew->facebook }}</td>
                            <td>{{ $crew->twitter }}</td>
                            <td>
                                <form method="POST" action="{{route('admin.crew.destroy', $crew->id)}}" accept-charset="UTF-8">
                                    {{ csrf_field() }}
                                    <input name="_method" type="hidden" value="DELETE">
                                    <a href="{!! route('admin.crew.show', [$crew->id]) !!}" class='btn btn-success btn-xs' title="detail">
                                        <i class="ti-eye"></i>
                                    </a>
                                    <a href="{!! route('admin.crew.edit', [$crew->id]) !!}" class='btn btn-default btn-xs' title="edit">
                                        <i class="ti-pencil"></i>
                                    </a>
                                    <button type="submit" class="btn btn-danger btn-xs" title="delete" onclick="return confirm('Yakin ingin menghapus gallery ini?')">
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