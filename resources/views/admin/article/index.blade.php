@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="ti-file"></i>
                    Article List
                </h4>
                <p class="category">
                    <a href="{{route('admin.article.create')}}" class="btn btn-sm btn-primary btn-fill btn-wd">
                        <i class="ti-plus"></i> New Article
                    </a>
                </p>
            </div>

            <div class="card-content table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Article (Id)</th>
                            <th>Article (En)</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>highlight</th>
                            <th>Publish</th>
                            <th>Author</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($articles as $no=>$article)
                        <tr>
                            <td>{{ $no+1 }}</td>
                            <td>{{ $article->translation('id')->first() ? $article->translation('id')->first()->title : '-' }}</td>
                            <td>{{ $article->translation('en')->first() ? $article->translation('en')->first()->title : '-' }}</td>
                            <td><img src="{{$article->image->url('thumb') ? $article->image->url('thumb') : '-' }}"></td>
                            <td>{{ $article->category()->first()->name }}</td>

                            <td>
                                @if($article->highlight)
                                    <a href="{!! route('admin.article.unhightlight', [$article->id]) !!}" class='btn btn-success btn-fill btn-xs' title="unhighlight">
                                        <i class="ti-check"></i>
                                    </a>
                                @else
                                    <a href="{!! route('admin.article.hightlight', [$article->id]) !!}" class='btn btn-danger btn-fill btn-xs' title="highlight">
                                        <i class="ti-minus"></i>
                                    </a>
                                @endif
                            </td>

                            <td>
                                @if($article->published)
                                    <a href="{!! route('admin.article.unpublish', [$article->id]) !!}" class='btn btn-success btn-fill btn-xs' title="unpublish">
                                        <i class="ti-check"></i>
                                    </a>
                                @else
                                    <a href="{!! route('admin.article.publish', [$article->id]) !!}" class='btn btn-danger btn-fill btn-xs' title="publish">
                                        <i class="ti-minus"></i>
                                    </a>
                                @endif
                            </td>
                            <td>{{ $article->author->name }}</td>
                            <td>
                                <form method="POST" action="{{route('admin.article.destroy', $article->id)}}" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
                                    <a href="{!! route('admin.article.show', [$article->id]) !!}" class='btn btn-success btn-xs' title="detail">
                                        <i class="ti-eye"></i>
                                    </a>

                                    <a href="{!! route('admin.article.edit', [$article->id]) !!}" class='btn btn-default btn-xs' title="edit">
                                        <i class="ti-pencil"></i>
                                    </a>

                                    @if($article->translation('en')->first())
                                        <a target="_blank" href="{{route('single-article',$article->translation('en')->first()->slug )}}" class="btn btn-info btn-xs" title="preview">
                                            <i class="ti-new-window"></i>
                                        </a>
                                    @endif

                                    <button type="submit" class="btn btn-danger btn-xs" title="delete" onclick="return confirm('Yakin ingin menghapus article ini?')">
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