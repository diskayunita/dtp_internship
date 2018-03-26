@extends('layouts.main.telkom')
@section('title')
  <title>Telkom DDS | About</title>
@endsection
@section('style')
    <style type="text/css">
        .about-text{
            height: auto !important;
            /*padding: 12px 20px 15px 20px !important;*/
        }
        .margin-top-20{
            padding: 0px 20px 15px 20px !important;
        }
        .portlet.light.portlet-fit > .portlet-body {
            padding: 10px 20px 0px 20px;
        }
    </style>
@endsection

@section('content')
    @section('content')
  @if(count($sliders))
    <div class="page-content">
      <div class="container">
        <div class="page-content-inner">
          <div class="row">
            @include('home.partials.home-slider')
          </div>
        </div>
      </div>
    </div>
  @endif

    <div class="page-content">
        <div class="container">
            <div class="page-content-inner">
                <!-- BEGIN TEXT & VIDEO -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="portlet light about-text">
                            <h4><i class="icon-info"></i>@lang('home/index.about_telkom_dds')</h4>
                            <div class="margin-top-20">
                                @foreach($about as $data)
                                    {!!$data->translation($language)->first() ? $data->translation($language)->first()->content : '-'!!}
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        @if(!empty($about[0]))
                            <iframe src="{{ $about[0]->video}}" style="width:100%; height:500px;border:0" allowfullscreen> </iframe>
                        @endif
                    </div>
                </div>
          
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light portlet-fit ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-trophy font-red"></i>
                                    <span class="caption-subject font-red bold uppercase">@lang('general.about_team')</span>
                                </div>
                            </div>

                            <div class="portlet-body">
                                <div class="mt-element-card mt-element-overlay">
                                    <div class="row">
                                        @foreach($teams as $key => $team)
                                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                <div class="mt-card-item">
                                                    <div class="mt-card-avatar mt-overlay-4">
                                                        @php
                                                            $avatar = $team->avatar->url('medium') ?
                                                                (file_exists($_SERVER['DOCUMENT_ROOT'].$team->avatar->url('medium')) ?
                                                                    $team->avatar->url('medium') : asset("img/faces/default_profile.png")) :
                                                                        asset("img/faces/default_profile.png");
                                                        @endphp
                                                        <img src="{{ $avatar }}" class="img-responsive"/>

                                                        <div class="mt-overlay">
                                                            <h2>{{ $team->name }}</h2>
                                                            <div class="mt-info font-white">
                                                                <div class="mt-card-content">
                                                                    <p class="mt-card-desc font-white">{{ $team->position }}</p>

                                                                    <div class="mt-card-social">
                                                                        <ul>
                                                                            <li>
                                                                                <a class="mt-card-btn" href="{{ $team->facebook }}"  target="_blank">
                                                                                    <i class="icon-social-facebook"></i>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a class="mt-card-btn" href="{{ $team->twitter }}" target="_blank">
                                                                                    <i class="icon-social-twitter"></i>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection