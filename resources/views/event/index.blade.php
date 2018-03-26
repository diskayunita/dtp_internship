@extends('layouts.main.telkom')
@section('title')
  <title>Telkom DDS | Event</title>
@endsection
@section('content')
<div class="page-content">
    <div class="container">
        <div class="page-content-inner">
            <div class="blog-page blog-content-2">
                <section class="publicaciones-blog-home">
                    <div class="">
                        <div class="row-page row">
                            <div class="portlet light portlet-fit tab-content">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-calendar font-green"></i>
                                        <span class="caption-subject font-green sbold uppercase">Event</span> &nbsp;<span class="label label-info">{{ $statusInfo }}</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <p class="text-left">
                                        <a href="{{route('event.create')}}" class="btn btn-primary">
                                            <i class=" icon-plus"></i>
                                            <span class="caption-subject sbold uppercase">@lang('event/event-create.create_new_event')</span>
                                        </a>
                                    </p>
                                    @include('flash::message')
                                    <div class="row">
                                        <div class="table-responsive table-full-width">
                                            <table class="table table-striped">
                                                <thead>
                                                    <th>#</th>
                                                    <th>@lang('event/event-table.University')</th>
                                                    <th>@lang('event/event-table.Date')</th>
                                                    <th>@lang('event/event-table.Status')</th>
                                                    <th>@lang('event/event-table.Response')</th>
                                                </thead>
                                                <tbody>
                                                    @foreach($events as $key => $event)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td><a href="{!! route('event.show', [$event->id]) !!}">{{$event->university}}</a></td>
                                                        <td>{{date("d, F Y",strtotime($event->created_at))}}</td>
                                                        <td>{{ ucfirst($event->approval) }}</td>
                                                        <td>
                                                            @if($event->approval=='approved' || $event->approval=='interview' || $event->approval=='completed')
                                                                <a href="{!! route('event.response', [$event->id]) !!}" class='btn btn-info btn-xs' title="detail"><i class="fa fa-eye"></i></a>
                                                                <a href="{!! route('event.response.pdf', [$event->id]) !!}" class='btn btn-success btn-xs' title="PDF"><i class="fa fa-file-pdf-o"></i></a>
                                                                <a href="{!! route('message') !!}" class='btn btn-danger btn-xs' title="message"><i class="fa fa-envelope-o"></i></a>
                                                            @elseif($event->approval=='rejected' || $event->approval=='revision' || $event->approval=='revised')
                                                                <a href="{!! route('event.response', [$event->id]) !!}" class='btn btn-info btn-xs' title="detail"><i class="fa fa-eye"></i></a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
