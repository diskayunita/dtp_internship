@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="ti-clipboard"></i>
                    Survey List
                </h4>

            </div>
            <div class="card-header">
                <a href="{{route('admin.survey.create')}}" class="btn btn-primary btn-sm btn-fill" title="New Survey">
                    <i class="ti-plus"></i>
                    New Survey
                </a>
                <div class="btn-group pull-right">
                    <a href="{{ route('admin.survey_excel') }}" class='btn btn-primary btn-sm'  title="Export to Excel">
                        <i class="fa fa-file-excel-o"></i>
                        Excel
                    </a>
                    <a href="{{ route('admin.survey_pdf') }}" class='btn btn-primary btn-sm' title="Export to PDF">
                        <i class="fa fa-file-pdf-o"></i>
                        PDF
                    </a>
                </div>
            </div>{{-- card-header --}}

            <div class="card-content table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Publish</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($surveys as $survey)
                        <tr>
                            <td><a href="{{route('admin.detail_survey', $survey)}}">{{$survey->title}}</a></td>
                            <td>{{isset($survey->global_type) ? ($survey->global_type ? "Global" : "Spesific") : 'N/A' }}</td>
                            <td>{{ str_limit($survey->description, 100) }}</td>
                            <td>
                                @if($survey->published)
                                    <a href="{!! route('admin.survey.unpublish', [$survey->id]) !!}" class='btn btn-success btn-fill btn-xs' title="unpublish">
                                        <i class="ti-check"></i>
                                    </a>
                                @else
                                    <a href="{!! route('admin.survey.publish', [$survey->id]) !!}" class='btn btn-danger btn-fill btn-xs' title="publish">
                                        <i class="ti-minus"></i>
                                    </a>
                                @endif
                            </td>
                            <td>
                                <form method="POST" action="{{route('admin.survey.destroy', $survey->id)}}" accept-charset="UTF-8">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <a href="{{route('admin.detail_survey', $survey)}}" class='btn btn-success btn-xs' title="detail">
                                        <i class="ti-eye"></i>
                                    </a>
                                    <a href="{{route('admin.survey.edit', $survey->id)}}" class='btn btn-default btn-xs' title="edit">
                                        <i class="ti-pencil"></i>
                                    </a>
                                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Yakin ingin menghapus {{$survey->title}} ?')">
                                        <i class="ti-trash"></i>
                                    </button>
                                    <a href="{{route('admin.get_answer', $survey->id)}}" class='btn btn-default btn-xs' title="Answer">
                                        <i class="ti-share"></i>
                                    </a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>{{-- card-content --}}
        </div>
    </div>
@endsection