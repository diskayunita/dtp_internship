@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="ti-file"></i>
                    Showcase List
                </h4>
                <p class="category">
                    <a href="{{route('admin.showcase.create')}}" class="btn btn-sm btn-primary btn-fill btn-wd">
                        <i class="ti-plus"></i> New Showcase
                    </a>
                </p>
            </div>

            <div class="card-content table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Showcase (Id)</th>
                            <th>Showcase (En)</th>
                            <th>Image</th>
                            {{-- <th>Category</th> --}}
                            {{-- <th>highlight</th> --}}
                            <th>Publish</th>
                            <th>Author</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($showcases as $no=>$showcase)
                        <tr>
                            <td>{{ $no+1 }}</td>
                            <td>{{ $showcase->translation('id')->first() ? $showcase->translation('id')->first()->title : '-' }}</td>
                            <td>{{ $showcase->translation('en')->first() ? $showcase->translation('en')->first()->title : '-' }}</td>
                            <td><img src="{{$showcase->image->url('thumb') ? $showcase->image->url('thumb') : '-' }}"></td>
                            {{-- <td>{{ $showcase->category()->first()->name }}</td> --}}

                            <td>
                                @if($showcase->published)
                                    <a href="{!! route('admin.showcase.unpublish', [$showcase->id]) !!}" class='btn btn-success btn-fill btn-xs' title="unpublish">
                                        <i class="ti-check"></i>
                                    </a>
                                @else
                                    <a href="{!! route('admin.showcase.publish', [$showcase->id]) !!}" class='btn btn-danger btn-fill btn-xs' title="publish">
                                        <i class="ti-minus"></i>
                                    </a>
                                @endif
                            </td>
                            <td>{{ $showcase->author->name }}</td>
                            <td>
                                <form method="POST" action="{{route('admin.showcase.destroy', $showcase->id)}}" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
                                    <a href="{!! route('admin.showcase.show', [$showcase->id]) !!}" class='btn btn-success btn-xs' title="detail">
                                        <i class="ti-eye"></i>
                                    </a>

                                    <a href="{!! route('admin.showcase.edit', [$showcase->id]) !!}" class='btn btn-default btn-xs' title="edit">
                                        <i class="ti-pencil"></i>
                                    </a>
                                    <a target="_blank" href="" class="btn btn-info btn-xs" title="preview">
                                        <i class="ti-new-window"></i>
                                    </a>

                                    <button type="submit" class="btn btn-danger btn-xs" title="delete" onclick="return confirm('Yakin ingin menghapus showcase ini?')">
                                        <i class="glyphicon glyphicon-trash"></i>
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