@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h4 class="card-title">
                    <i class="ti-gallery"></i>
                    Gallery List
                </h4>
                <p class="category">
                    <a href="{{route('admin.gallery.create')}}" class="btn btn-sm btn-primary btn-fill btn-wd">
                        <i class="ti-plus"></i> New gallery
                    </a>
                </p>
            </div>

            <div class="card-content table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Caption (Id)</th>
                            <th>Caption (En)</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Publish</th>
                            <th>Author</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($galleries as $no=>$gallery)
                        <tr>
                            <td>{{$no+1}}</td>
                            <td>{{$gallery->translation('id')->first() ? $gallery->translation('id')->first()->caption : '-'}}</td>
                            <td>{{$gallery->translation('en')->first() ? $gallery->translation('en')->first()->caption : '-'}}</td>
              
                            <td><img src="{{$gallery->image->url('thumb')}}"></td>
                            <td>{{$gallery->category ? $gallery->category->name : '-'}}</td>
                            <td>
                                @if($gallery->published)
                                    <a href="{!! route('admin.gallery.unpublish', [$gallery->id]) !!}" class='btn btn-success btn-fill btn-xs' title="unpublish">
                                        <i class="ti-check"></i>
                                    </a>
                                @else
                                    <a href="{!! route('admin.gallery.publish', [$gallery->id]) !!}" class='btn btn-danger btn-fill btn-xs' title="publish">
                                        <i class="ti-minus"></i>
                                    </a>
                                @endif
                            </td>
                            <td>{{$gallery->author->name}}</td>
                            <td>
                                <form method="POST" action="{{route('admin.gallery.destroy', $gallery->id)}}" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
                                    <a href="{!! route('admin.gallery.show', [$gallery->id]) !!}" class='btn btn-success btn-xs' title="detail">
                                        <i class="ti-eye"></i>
                                    </a>
                                    <a href="{!! route('admin.gallery.edit', [$gallery->id]) !!}" class='btn btn-default btn-xs'>
                                        <i class="ti-pencil"></i>
                                    </a>
                                    <a target="_blank" href="http://telkom-dds.dev/gallery#cbp={{ route('gallery_detail',$gallery->id) }}" class="btn btn-info btn-xs" title="Preview" rel="nofollow">
                                        <i class="ti-new-window"></i>
                                    </a>
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