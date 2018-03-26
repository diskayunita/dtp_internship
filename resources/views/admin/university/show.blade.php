@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-capitalize">
                    <i class="ti-files"></i> {{$title}} - Article
                </h4>
                <p class="category">List of available article within {{ $title }} category</p>
            </div>
            <div class="card-content table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Article (Id)</th>
                            <th>Article (En)</th>
                            <th>Image</th>
                            <th>Published</th>
                            <th>Author</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($category->articles as $no => $article)
                        <tr>
                            <td>{{ $no+1}}</td>
                            <td>{{ $article->translation('id')->first() ? $article->translation('id')->first()->title : '-' }}</td>
                            <td>{{ $article->translation('en')->first() ? $article->translation('en')->first()->title : '-' }}</td>
                            <td><img src="{{$article->translation('en')->first() ? $article->translation('en')->first()->article->image->url('thumb') : '-' }}"></td>
                            <td>{{ $article->published ? 'published' : 'unpublished' }}</td>
                            <td>{{ $article->author->name }}</td>
                            <td>
                                <form method="POST" action="{{route('admin.article.destroy', $article->id)}}" accept-charset="UTF-8">
                                    <input name="_method" type="hidden" value="DELETE">
                                    {{ csrf_field() }}
                                    <a href="{!! route('admin.article.edit', [$article->id]) !!}" class='btn btn-default btn-xs' title="edit">
                                        <i class="ti-pencil"></i>
                                    </a>
                                    <button type="submit" class="btn btn-danger btn-xs" title="delete" onclick="return confirm('Yakin ingin menghapus article ini?')">
                                        <i class="ti-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="form-group text-center">
                    <a href="{!! route('admin.category.index') !!}" class="btn btn-default btn-wd btn-fill btn-move-left">
                        <i class="ti-angle-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection