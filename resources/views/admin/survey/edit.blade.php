@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="ti-pencil"></i>
                    Edit Survey
                </h4>
            </div>
            <div class="card-content">
                <form method="POST" action="{{route('admin.update_survey', $survey)}}" id="boolean">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @include('admin.survey.partials.form_fields')
                </form>
            </div>
        </div>  <!-- end card -->
    </div>
@endsection