@extends('layouts.main.telkom')
@section('title')
  <title>Telkom DDS | Homepage</title>
@endsection
@section('style')
  <style type="text/css">
    .img-thumb-big{
      height: 350px;
      margin: auto;
      background-size: 100%;
      background-position: center;
    }
    .grey-bg-big{
      height: 350px;
    }
    .mfp-bg{
      z-index: 16000003 !important;
    }
    .mfp-wrap{
      z-index: 16000004 !important;
    }
  </style>
@endsection
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
        {{-- ARTICLE LIST --}}
        @include('home.partials.home-article')
      </div>
    </div>
  </div>

  <div class="page-content">
    <div class="container">
      <div class="page-conten-inner">
        @include('home.partials.home-calendar')
      </div>
    </div>
  </div>

  <div class="page-content">
    <div class="container">
      <div class="page-content-inner">
        <hr>
        @include('home.partials.home-gallery')
      </div>
    </div>
  </div>
@endsection