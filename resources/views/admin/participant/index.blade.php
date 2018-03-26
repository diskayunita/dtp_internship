@extends('layouts.admin.telkom')

@section('content')
<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <h4 class="card-title">Limit of Participant Table</h4>
      <p class="category">
        <a href="{{route('admin.participant.create')}}" class="btn btn-sm btn-primary btn-fill btn-wd">
          <i class="ti-plus"></i> New Limit
        </a>
      </p>
    </div>

    <div class="card-content table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Minimal</th>
            <th>Maximal</th>
            <th>Description</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($participant_limit as $no=>$participant_limit)
          <tr>
            <td>{{ $no+1 }}</td>
            <td>{{ $participant_limit->minimal }}</td>
            <td>{{ $participant_limit->maximal }}</td>
            <td>{{ $participant_limit->description ? $participant_limit->description : '-' }}</td>
            <td>
              <form method="POST" action="{{route('admin.participant.destroy', $participant_limit)}}" accept-charset="UTF-8">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="DELETE">
                <a href="{!! route('admin.participant.edit', [$participant_limit->id]) !!}" class='btn btn-default btn-xs' title="edit">
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