@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="ti-layout-slider"></i> Slider List
                </h4>
                <p class="category">
                    <a href="{{route('admin.slider.create')}}" class="btn btn-sm btn-primary btn-fill btn-wd">
                        <i class="ti-plus"></i> New Slider
                    </a>
                </p>
            </div>
            <div class="card-content table-responsive">

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Caption (Id)</th>
                            <th>Caption (En)</th>
                            <th>Ref. link(Id)</th>
                            <th>Ref. link(En)</th>
                            <th>Status</th>
                            <th>Author</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($sliders as $no=>$slider)
                        <tr>
                            <td><img src="{{$slider->image->url('thumb') ? $slider->image->url('thumb') : '-'}}" class="img-responsive"></td>

                            <td>{{$slider->translation('id')->first() ? $slider->translation('id')->first()->caption : '-'}}</td>
                            <td>{{$slider->translation('en')->first() ? $slider->translation('en')->first()->caption : '-'}}</td>
                            <td>{{$slider->translation('id')->first() ? $slider->translation('id')->first()->referal_link : '-'}}</td>
                            <td>{{$slider->translation('en')->first() ? $slider->translation('en')->first()->referal_link : '-'}}</td>

                            <td>
                                @if($slider->published)
                                    <a href="{!! route('admin.slider.unpublish', [$slider->id]) !!}" class='btn btn-success btn-fill btn-xs' title="unpublish">
                                        <i class="ti-check"></i>
                                    </a>
                                @else
                                    <a href="{!! route('admin.slider.publish', [$slider->id]) !!}" class='btn btn-danger btn-fill btn-xs' title="publish">
                                        <i class="ti-minus"></i>
                                    </a>
                                @endif
                            </td>

                            <td>{{$slider->author->name}}</td>
                            <td>
                                <form method="POST" action="{{route('admin.slider.destroy', $slider->id)}}" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
                                    <a href="{!! route('admin.slider.show', [$slider->id]) !!}" class='btn btn-success btn-xs' title="detail">
                                        <i class="ti-eye"></i>
                                    </a>

                                    <a href="{!! route('admin.slider.edit', [$slider->id]) !!}" class='btn btn-default btn-xs'>
                                        <i class="ti-pencil"></i>
                                    </a>

                                    {{-- @if($slider->highlight)
                                        <a href="{!! route('admin.slider.unhightlight', [$slider->id]) !!}" class='btn btn-primary btn-xs' title="unhightlight"><i class="glyphicon glyphicon-download"></i></a>
                                      @else
                                        <a href="{!! route('admin.slider.hightlight', [$slider->id]) !!}" class='btn btn-primary btn-xs' title="hightlight"><i class="glyphicon glyphicon-upload"></i></a>
                                      @endif --}}

                                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Yakin ingin menghapus slider ini?')">
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