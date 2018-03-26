@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">University Table</h4>
                <p class="University">
                    <a href="{{route('admin.university.create')}}" class="btn btn-sm btn-primary btn-fill btn-wd">
                        <i class="ti-plus"></i> New University
                    </a>
                </p>
            </div>

            <div class="card-content table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name ID</th>
                            <th>Name EN</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($universities as $no=>$university)
                        <tr>
                            <td>{{ $no+1 }}</td>
                            <td>
                                {{ !is_null($university->has('translation')->first()) ? ($university->translation('id')->first() ? $university->translation('id')->first()->name : "N/A") : "N/A"}}
                            </td>
                            <td>
                                {{ !is_null($university->has('translation')->first()) ? ($university->translation('en')->first() ? $university->translation('en')->first()->name : "N/A") : "N/A"}}
                            </td>
                            <td>{{ $university->description ? $university->description : '-' }}</td>
                            <td>
                                <form method="POST" action="{{route('admin.university.destroy', $university->id)}}" accept-charset="UTF-8">
                                    {{ csrf_field() }}
                                    <input name="_method" type="hidden" value="DELETE">
                                    <a href="{!! route('admin.university.edit', [$university->id]) !!}" class='btn btn-default btn-xs' title="edit">
                                        <i class="ti-pencil"></i>
                                    </a>
                                    @if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('idex'))
                                     | 
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