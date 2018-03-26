@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    About
                </h4>
                <p class="category">
                    <a href="{{route('admin.about.create')}}" class="btn btn-sm btn-primary btn-fill btn-wd">
                        <i class="ti-plus"></i>
                        New About
                    </a>
                </p>
            </div>
            <div class="card-content table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Content(id)</th>
                            <th>Content(en)</th>
                            <th>Link Video</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($abouts as $no=>$about)
                        <tr>
                            <td>{!!$about->translation('id')->first() ? $about->translation('id')->first()->content : '-'!!}</td>
                            <td>{!!$about->translation('en')->first() ? $about->translation('en')->first()->content : '-'!!}</td>
                            <td>{!!$about->video!!}</td>
                            <td>
                                <form method="POST" action="{{route('admin.about.destroy', $about->id)}}" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
                                    <div class='btn-group'>
                                        <a href="{!! route('admin.about.edit', [$about->id]) !!}" class='btn btn-default btn-xs' title="edit"><i class="glyphicon glyphicon-edit"></i></a>
                                        <a href="{!! route('admin.about.show', [$about->id]) !!}" class='btn btn-success btn-xs' title="detail"><i class="glyphicon glyphicon-eye-open"></i></a>
                                        <button type="submit" class="btn btn-danger btn-xs" title="delete" onclick="return confirm('Yakin ingin menghapus about ini?')"><i class="glyphicon glyphicon-trash"></i></button>
                                    </div>
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