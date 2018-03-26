@extends('layouts.main.telkom')

@section('content')
    {{-- <div class="page-head">
        <div class="container">
            <div class="page-title">
                <h1>Internship <small>Response</small></h1>
            </div>
        </div>
    </div> --}}

    <div class="page-content">
        <div class="container">
            <div class="page-content-inner">
                <div class="blog-page blog-content-2">
                    <section class="publicaciones-blog-home">

                        <div class="row-page row">
                            <div class="portlet light portlet-fit">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-plus font-green"></i>
                                        <span class="caption-subject font-green sbold uppercase">
                                            Internship Response
                                        </span>
                                    </div>
                                </div>

                                @if ($event->approval == 'approved')
                                    <div class="portlet-body">
                                        <div class="row">
                                            <div class="col-md-12 form-horizontal">
                                                {{-- Name --}}
                                                <div class="form-group">
                                                    <div class="col-md-2">
                                                        <strong>Name : </strong>
                                                    </div>
                                                    <div class="col-md-10">
                                                        {{ $event->exists ? $event->username : '' }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-2">
                                                        <strong>Internship : </strong>
                                                    </div>
                                                    <div class="col-md-10">
                                                        {{ $event->exists ? $event->type : '' }}
                                                    </div>
                                                </div>
                                                {{--<div class="form-group">
                                                    <div class="col-md-2">
                                                        <strong>Reference Number : </strong>
                                                    </div>
                                                    <div class="col-md-10">
                                                        {{ $event->exists ? $event->responses[0]->reference_number : '' }}
                                                    </div>
                                                </div>--}}

                                                {{-- Status --}}
                                                <div class="form-group">
                                                    <div class="col-md-2">
                                                        <strong>Status :</strong>
                                                    </div>
                                                    <div class="col-md-10">
                                                        @php $status = (!empty($event->approval)) ? $event->approval : 'error'; @endphp
                                                        <span class="{{ statusLabelColor($status) }}">{{ $status }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <p class="text-justify">
                                                    @include('event.pdf')
                                                </p>

                                            </div>

                                            {{-- Button --}}

                                            <div class="col-md-12 text-center">
                                                <div class="btn-group">
                                                    <a href="{{ route('event.index') }}" class="btn btn-md btn-red">
                                                        <i class="fa fa-caret-left"></i>
                                                        Back to Event List
                                                    </a> &nbsp;
                                                    <a href="{{route('message')}}" class="btn btn-md btn-red">
                                                        Confirm
                                                    </a> &nbsp;
                                                    <a href="{!! route('event.response.pdf', [$event->id]) !!}" class="btn btn-md btn-red">
                                                        Export To PDF
                                                        <i class="fa fa-file-pdf-o"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="portlet-body">
                                        <div class="row">
                                            <div class="col-md-12 form-horizontal">
                                                {{-- Name --}}
                                                <div class="form-group">
                                                    <div class="col-md-2">
                                                        <strong>Name </strong>
                                                    </div>
                                                    <div class="col-md-10">
                                                        {{ $event->exists ? $event->username : '' }}
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-2">
                                                        <strong>University Name  </strong>
                                                    </div>
                                                    <div class="col-md-10">
                                                        {{ $event->exists ? $event->university : '' }}
                                                    </div>
                                                </div>

                                                {{-- Status --}}
                                                <div class="form-group">
                                                    <div class="col-md-2">
                                                        <strong>Status </strong>
                                                    </div>
                                                    <div class="col-md-10">
                                                        @php $status = (!empty($event->approval)) ? $event->approval : 'error'; @endphp
                                                        <span class="{{ statusLabelColor($status) }}">{{ $status }}</span>
                                                        @if($status == "revised")
                                                            <small style="color:grey;">wait new response</small>
                                                        @endif
                                                    </div>
                                                </div>

                                                 {{-- DAte --}}
                                                @if($status == "interview" || $status == "approved")
                                                    <div class="form-group">
                                                        <div class="col-md-2">
                                                            <strong>Date </strong>
                                                        </div>
                                                        <div class="col-md-10">
                                                            @php
                                                            $eventResponse = array_values(array_slice($event->responses->toArray(), -1))[0];
                                                            echo date("l, d F Y", strtotime($eventResponse['date']));
                                                        @endphp
                                                        </div>
                                                    </div>
                                                @endif

                                                {{-- Time --}}
                                                @if($status == "interview" || $status == "approved")
                                                    <div class="form-group">
                                                        <div class="col-md-2">
                                                            <strong>Time </strong>
                                                        </div>
                                                        <div class="col-md-10">
                                                            @php
                                                            $eventResponse = array_values(array_slice($event->responses->toArray(), -1))[0];
                                                            echo date("H:i", strtotime($eventResponse['time']));
                                                        @endphp
                                                        </div>
                                                    </div>
                                                @endif

                                                {{-- Location --}}
                                                @if($status == "interview" || $status == "approved")
                                                <div class="form-group">
                                                    <div class="col-md-2">
                                                        <strong>Location  </strong>
                                                    </div>
                                                    <div class="col-md-10">
                                                        {{--{!! html_entity_decode($event->responses[0]->message, ENT_QUOTES, "utf-8"); !!}--}}
                                                        @php
                                                            $eventResponse = array_values(array_slice($event->responses->toArray(), -1))[0];
                                                            echo html_entity_decode($eventResponse['location'], ENT_QUOTES, "utf-8");
                                                        @endphp
                                                    </div>
                                                </div>
                                                @endif

                                                {{-- Response --}}
                                                <div class="form-group">
                                                    <div class="col-md-2">
                                                        <strong>Response Message  </strong>
                                                    </div>
                                                    <div class="col-md-10">
                                                        {{--{!! html_entity_decode($event->responses[0]->message, ENT_QUOTES, "utf-8"); !!}--}}
                                                        @php
                                                            $eventResponse = array_values(array_slice($event->responses->toArray(), -1))[0];
                                                            echo html_entity_decode($eventResponse['message'], ENT_QUOTES, "utf-8");
                                                        @endphp
                                                    </div>
                                                </div>
                                                {{-- Revisi Link --}}
                                                @if($status == "revision" || $status == "revised")
                                                    <div class="form-group">
                                                        <div class="col-md-2">
                                                            <strong>Revisi Link : </strong>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <a href="{{ route('event.edit', $event->id) }}" class="btn btn-xs btn-blue">
                                                                <i class="fa fa-paper-plane-o"></i>
                                                                @if($status == "revised")
                                                                    Revisi Ulang
                                                                @else
                                                                    Revisi
                                                                @endif
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            {{-- Button --}}
                                            <div class="col-md-12 text-center">
                                                <div class="btn-group">
                                                    <a href="{{ route('event.index') }}" class="btn btn-md btn-red">
                                                        <i class="fa fa-caret-left"></i>
                                                        Back to Event List
                                                    </a>&nbsp;
                                                        @if($status == "interview" )
                                                        <a href="{{route('message')}}" class="btn btn-md btn-red">
                                                        Confirm
                                                        </a>
                                                        @endif
                                                   &nbsp;
                                                    @if($status == "interview" )
                                                        <a href="{{route('message')}}" class="btn btn-md btn-red">
                                                        Reschedule
                                                        <i class="fa fa-caret-right"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
@endsection
