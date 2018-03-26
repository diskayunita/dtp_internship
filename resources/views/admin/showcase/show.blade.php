@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h4 class="card-title">
                    <i class="ti-file"></i> View Showcase
                </h4>
                <p class="category">Showcase detail</p>
            </div>

            <div class="card-content">
                <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active">
                                <a href="#id">
                                    <img src="{{ asset('paper/img/flags/id.png') }}" alt="Indonesia">
                                    Indonesia
                                </a>
                            </li>
                            <li>
                                <a href="#en">
                                    <img src="{{ asset('paper/img/flags/us.png') }}" alt="English">
                                    English
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <form class="form-horizontal" style="margin-top: 10px;" method="POST" action="javascript:void(0)" enctype="multipart/form-data">
                    <div class="tab-content">
                        @include('admin.showcase.show-field')
                    </div>
                </form>
            </div>

            <div class="card-footer">
                <div class="form-group text-center">
                        <a href="{!! route('admin.showcase.index') !!}" class="btn btn-md btn-default btn-fill btn-wd btn-move-left">
                            <span class="btn-label">
                                <i class="ti-angle-left"></i>
                            </span>
                            Cancel
                        </a>
                        <a href="{!! route('admin.showcase.edit', [$showcase->id]) !!}" class='btn btn-primary btn-fill btn-wd' title="edit">
                            <sapn class="btn-label">
                                <i class="ti-pencil"></i>
                            </sapn>
                            Edit
                        </a>
                </div>
            </div>
        </div>
    </div>
@endsection