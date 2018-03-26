<section class="gallery">
    <div class="container">
      <div id="owl-demo">
        @foreach($galleries as $key=>$gallery)
        <div class="item">
          <div class="owl-gallery">
            <a href="{{$gallery->image->url('zoomed') ? (file_exists($_SERVER['DOCUMENT_ROOT'].$gallery->image->url('zoomed')) ? $gallery->image->url('zoomed') : '/assets/img/gallery/1200x900/'.$key.'.jpg') : '/assets/img/gallery/1200x900/'.$key.'.jpg'}}" title="{{$gallery->translation($language)->first()->caption}}">
                <div class="cbp-caption-defaultWrap">
                    <img src="{{$gallery->image->url('notzoom') ? (file_exists($_SERVER['DOCUMENT_ROOT'].$gallery->image->url('notzoom')) ? $gallery->image->url('notzoom') : '/assets/img/gallery/1200x900/'.$key.'.jpg') : '/assets/img/gallery/1200x900/'.$key.'.jpg'}}" alt="" class="img-responsive gallerySlide">
                </div>
            </a>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>


<!-- GALLERY -->
