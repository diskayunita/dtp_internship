@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Destination Table</h4>
                <p class="category">
                    <a href="{{route('admin.purpose.create')}}" class="btn btn-sm btn-primary btn-fill btn-wd">
                        <i class="ti-plus"></i> New Destination
                    </a>
                </p>
            </div>

            <div class="card-content table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name (id)</th>
                            <th>Name (en)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($purposes as $no=>$purpose)
                        <tr>
                            <td>{{ $no+1 }}</td>
                            {{--<td>--}}{{-- <a href="{{ route('admin.purpose.show', $purpose) }}"> --}}{{--{{ $purpose->name }}--}}{{-- </a> --}}{{--</td>--}}
                            <td>{{ $purpose->translation('id')->first() ? $purpose->translation('id')->first()->name : '-' }}</td>
                            <td>{{ $purpose->translation('en')->first() ? $purpose->translation('en')->first()->name : '-' }}</td>
                            <td>
                                <form method="POST" action="{{route('admin.purpose.destroy', $purpose->id)}}" accept-charset="UTF-8">
                                    {{ csrf_field() }}
                                    <input name="_method" type="hidden" value="DELETE">
                                    <a href="{!! route('admin.purpose.edit', [$purpose->id]) !!}" class='btn btn-default btn-xs' title="edit">
                                        <i class="ti-pencil"></i>
                                    </a>
                                    @if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('idex'))
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