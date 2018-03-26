@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">division Table</h4>
                <p class="division">
                    <a href="{{route('admin.division.create')}}" class="btn btn-sm btn-primary btn-fill btn-wd">
                        <i class="ti-plus"></i> New division
                    </a>
                </p>
            </div>

            <div class="card-content table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Avatar</th>
                            <th>Name ID</th>
                            <th>Name EN</th>
                            <th>Description ID</th>
                            <th>Description EN</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($divisions as $no=>$division)
                        @php
                            $avatar = $division->avatar->url('medium') ?
                                (file_exists($_SERVER['DOCUMENT_ROOT'].$division->avatar->url('medium')) ?
                                    $division->avatar->url('thumb') : asset("img/faces/default_profile.png")) :
                                        asset("img/faces/default_profile.png");
                        @endphp
                        <tr>
                            <td>{{ $no+1 }}</td>
                            <td><img src="{{ $avatar }}" alt="{{ $division->name }}-avatar" class="img-responsive"></td>
                            <td>{{ $division->translation('id')->first()->name }}</td>
                            <td>{{ $division->translation('en')->first()->name }}</td>
                            <td>{{ $division->translation('id')->first()->description }}</td>
                            <td>{{ $division->translation('en')->first()->description }}</td>
                            
                            <td>
                                <form method="POST" action="{{route('admin.division.destroy', $division->id)}}" accept-charset="UTF-8">
                                    {{ csrf_field() }}
                                    <input name="_method" type="hidden" value="DELETE">
                                    <a href="{!! route('admin.division.edit', [$division->id]) !!}" class='btn btn-default btn-xs' title="edit">
                                        <i class="ti-pencil"></i>
                                    </a>
                                     | 
                                    <button type="submit" class="btn btn-danger btn-xs" title="delete" onclick="return confirm('Yakin ingin menghapus division ini?')">
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