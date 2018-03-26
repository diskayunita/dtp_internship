@extends('layouts.admin.telkom')

@section('content')
<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <h4 class="card-title">Category Table</h4>
      <p class="category">
        <a href="{{route('admin.category.create')}}" class="btn btn-sm btn-primary btn-fill btn-wd">
          <i class="ti-plus"></i> New Category
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
          @foreach($categories as $no=>$category)
            <tr>
              <td>{{ $no+1 }}</td>
              <td>
                <a href="{{ route('admin.category.show', $category) }}">
                  {{ !is_null($category->has('translation')->first()) ? ($category->translation('id')->first() ? $category->translation('id')->first()->name : "N/A") : "N/A"}}
                </a>
              </td>
              <td>
                <a href="{{ route('admin.category.show', $category) }}">{{ !is_null($category->has('translation')->first()) ? ($category->translation('en')->first() ? $category->translation('en')->first()->name : "N/A") : "N/A"}}</a>
              </td>
              <td>{{ $category->description ? $category->description : '-' }}</td>
              <td>
                <form method="POST" action="{{route('admin.category.destroy', $category->id)}}" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <input name="_method" type="hidden" value="DELETE">
                  <a href="{!! route('admin.category.edit', [$category->id]) !!}" class='btn btn-default btn-xs' title="edit">
                    <i class="ti-pencil"></i>
                  </a>
                  | 
                    <button type="submit" class="btn btn-danger btn-xs" title="delete" onclick="return confirm('Yakin ingin menghapus admin ini?')">
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