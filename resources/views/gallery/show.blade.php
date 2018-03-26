<div class="portfolio-content">
    <div class="cbp-l-project-title">{{ $gallery->exists ? ($gallery->translation($language)->first() ? $gallery->translation($language)->first()->caption : '') : null }}</div>
    <div class="cbp-l-project-subtitle">by {{ $gallery->author->exists ? ($gallery->author ? $gallery->author->name : '') : null }}</div>
    <center>
        <img src="{{$gallery->image->url() ? (file_exists($_SERVER['DOCUMENT_ROOT'].$gallery->image->url('zoomed')) ? $gallery->image->url('zoomed') : '/assets/img/gallery/600x600/1.jpg') : '/assets/img/gallery/600x600/1.jpg'}}" alt="" class="image-gallery-detail">
    </center>
    <div class="cbp-l-project-container">
        <div class="cbp-l-project-desc">
            <div class="cbp-l-project-desc-title">
                <span>Deskripsi Foto</span>
            </div>
            <div class="cbp-l-project-desc-text">{{ $gallery->exists ? ($gallery->translation($language)->first() ? $gallery->translation($language)->first()->description : '') : null }}</div>
        </div>
        <div class="cbp-l-project-details">
            <div class="cbp-l-project-details-title">
                <span>Detail Foto</span>
            </div>
            <ul class="cbp-l-project-details-list">
                <li>
                    <strong>Author</strong>{{ $gallery->author->exists ? ($gallery->author ? $gallery->author->name : '') : null }}</li>
                <li>
                    <strong>Tanggal</strong>{{ date("d, F Y",strtotime($gallery->created_at)) }}</li>
                <li>
                    <strong>Kategori</strong>{{ $gallery->category->exists ? ($gallery->category ? $gallery->category->translation($language)->first()->name : '') : null }}</li>
            </ul>
        </div>
    </div>
    <div class="well">
        <h4>Share on : </h4>
        @include('layouts.share', ['url' => request()->fullUrl()])
    </div>
    <br>
    <br>
    <br> 
</div>