@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{$title}} - Article</h4>
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
                    @foreach($category->articles as $no=>$article)
                        <tr>
                            <td>{{$no+1}}</td>
                            <td>{{$article->translation('id')->first() ? $article->translation('id')->first()->title : '-'}}</td>
                            <td>{{$article->translation('en')->first() ? $article->translation('en')->first()->title : '-'}}</td>
                            <td><img src="{{$article->translation('en')->first() ? $article->translation('en')->first()->image->url('thumb') : '-'}}"></td>
                            <td>{{$article->published ? 'published' : 'unpublished'}}</td>
                            <td>{{$article->author->name}}</td>
                            <td>
                                <form method="POST" action="{{route('admin.article.destroy', $article->id)}}" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
                                    <div class='btn-group'>
                                        <a href="{!! route('admin.article.edit', [$article->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Yakin ingin menghapus article ini?')"><i class="glyphicon glyphicon-trash"></i></button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer text-center">
                <a href="{!! route('admin.permission.index') !!}" class="btn btn-default btn-fill btn-wd btn-move-left">
                    <span class="btn-label">
                        <i class="ti-angle-left"></i>
                    </span>
                    Back
                </a>
            </div>
        </div>
    </div>
@endsection