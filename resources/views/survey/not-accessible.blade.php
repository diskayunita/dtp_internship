{{--@extends('errors.master')--}}
@extends('layouts.main.telkom')

@section('title')
    <title>Telkom DDS | Survey</title>
@endsection

@section('content')
    <div class="page-content-inner surveys">
        <div class="portlet portlet-fit ">
            <div class="portlet-body">
                <div class="mt-element-card mt-element-overlay">
                    <div class="row">
                        <div class="col-lg-10 col-lg-offset-1">
                            <div class="text-center">
                                <h3>@lang('survey.error.header')</h3>
                                <p>@lang('survey.error.body')</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection