@extends('layouts.main.master')

@section('content')

<section>
 <div class="container">
        <div class="row">
        <div class="gallery col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h1 class="gallery-title">Gallery</h1>
        </div>

        <div align="center">
            <button class="btn btn-default filter-button active" data-filter="all">All</button>
            @foreach($categories as $category)
              <button class="btn btn-default filter-button" data-filter="{{$category->name}}" onclick="setActive(this, event);">{{$category->name}}</button>
            @endforeach
        </div>
        <br/>

        @foreach($pictures as $picture)
          <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter {{$picture->category()->first()->name}}">
            <div class="hovereffect">
                <img src="{{$picture->image->url('original') ? $picture->image->url('original') : '-'}}" class="img-responsive">
                <div class="overlay">
                   {{-- <h2>Image heading</h2> --}}
                   <p class="info">{{$picture->translation($language)->first() ? $picture->translation($language)->first()->description : '-'}}</p>
                </div>
            </div>
          </div>
        @endforeach

        </div>
    </div>
</section>
{{-- <div id="portfolio">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="title">
          <h2>Gallery</h2>
        </div>
        <!-- ISO section -->
        <div class="iso-section">
          <div class="iso-box-section">
            <div class="iso-box-wrapper col4-iso-box">
              @foreach($pictures as $data)
              <div class="iso-box html photoshop wordpress mobile col-md-4 col-sm-4 col-xs-12"><a href="{{$data->image->url('original') ? $data->image->url('original') : '-'}}" style="height: 220px; width: 100%;" data-lightbox-gallery="portfolio-gallery"><img src="{{$data->image->url('original') ? $data->image->url('original') : '-'}}" style="height: 220px; width: 100%;" alt="portfolio img"></a></div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> --}}
@endsection

