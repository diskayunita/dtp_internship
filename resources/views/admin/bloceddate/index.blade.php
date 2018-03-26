@extends('layouts.admin.telkom')

@section('content')
<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <h4 class="card-title">Blocked Date Table</h4>
      <p class="category">
        <a href="{{route('admin.blokeddate.create')}}" class="btn btn-sm btn-primary btn-fill btn-wd">
          <i class="ti-plus"></i> New Blocked Date
        </a>
      </p>
    </div>

    <div class="card-content table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($blockeds as $no=>$blocked)
            <tr>
              <td>{{ $no+1 }}</td>
              <td>{{ isset($blocked->title) ? $blocked->title : '-' }}</td>        
              <td>{{isset($blocked->date) ? date("d, M Y",strtotime($blocked->date)) : '-' }}</td>
              <td>
                <form method="POST" action="{{route('admin.blokeddate.destroy', $blocked->id)}}" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <input name="_method" type="hidden" value="DELETE">
                  <a href="{!! route('admin.blokeddate.edit', [$blocked->id]) !!}" class='btn btn-default btn-xs' title="edit">
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