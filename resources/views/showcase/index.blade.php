@extends('layouts.main.telkom')
@section('title')
  <title>Telkom DDS | Product</title>
@endsection
@section('content')
<div class="page-head">
    <div class="container">
        <div class="page-title">
        </div>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <div class="page-content-inner">
            <div class="row">
                @foreach($showcases as $key => $showcase)
                    <div class="col-md-3 col-sm-6">
                        <div class="thumbnail center-cropped">
                            <img class="showcase-image img-responsive" src="{{$showcase->image->url('medium') ? (file_exists($_SERVER['DOCUMENT_ROOT'].$showcase->image->url('medium')) ? $showcase->image->url('medium') : 'assets/img/gallery/1200x900/'.$key++.'.jpg') : 'assets/img/gallery/400x300/'.$key++.'.jpg'}}">
                            <center>
                                <h4>{{str_limit($showcase->translation($language)->first()->title, 50)}}</h4>
                            </center>
                            <p class="product-content-dds"></p>
                            <hr class="line">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <center>
                                        <a href="{{route('single-showcase',$showcase->translation($language)->first()->slug )}}" >
                                            <button class="btn btn-product-dds" >@lang('general.view_detail')</button>
                                        </a>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection