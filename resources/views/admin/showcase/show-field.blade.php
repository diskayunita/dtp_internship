<div class="tab-pane active" id="id">
    <div class="form-group">
        <label for="title" class="col-md-2">Judul</label>
            <div class="col-md-10">
                <p>{{ $showcase->translation('id')->first() ? $showcase->translation('id')->first()->title : '-' }}</p>
        </div>
    </div>

    <div class="form-group">
        <label for="content" class="col-md-2">Isi</label>
        <div class="col-md-10">
            {!! $showcase->translation('id')->first() ? $showcase->translation('id')->first()->content : '' !!}
        </div>
    </div>

    <div class="form-group">
        <label for="image" class="col-md-2">Gambar</label>
        <div class="col-md-10">
            <img  id="showgambar-id" src="{{ $showcase ? $showcase->image->url() : asset('image/showcase/default.png') }}" width="510" height="510" class="img img-thumbnail">
        </div>
    </div>

    <div class="form-group">
        <label for="image_desc" class="col-md-2">Deskripsi Gambar</label>
        <div class="col-md-10">
            <p>
                {!! $showcase->translation('id')->first() ? $showcase->translation('id')->first()->image_desc : '' !!}
            </p>
        </div>
    </div>
</div>

<div class="tab-pane" id="en">
    <div class="form-group">
        <label for="title" class="col-md-2">Title</label>
        <div class="col-md-10">
            <p>{{ $showcase->translation('en')->first() ? $showcase->translation('en')->first()->title : '-' }}</p>
        </div>
    </div>

    <div class="form-group">
        <label for="content" class="col-md-2">Content</label>
        <div class="col-md-10">
            <div class="form-line">
                {!! $showcase->translation('id')->first() ? ($showcase->translation('en')->first() ? $showcase->translation('en')->first()->content : '') : '' !!}
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="image" class="col-md-2">Image</label>
        <div class="col-md-10">
            <img  id="showgambar-en" src="{{ $showcase->translation('id')->first() ? $showcase->image->url() : asset('image/article/default.png') }}" width="510" height="510" class="img img-thumbnail">
        </div>
    </div>

    <div class="form-group">
        <label for="image_desc" class="col-md-2">Image Description</label>
        <div class="col-md-10">
            <p>
                {{ $showcase->translation('id')->first() ? ($showcase->translation('en')->first() ? $showcase->translation('en')->first()->image_desc : '') : '' }}
            </p>
        </div>
    </div>
</div>


{{-- <div class="form-group">
    <label class="col-md-2">Category</label>
    <div class="col-md-10">
        <p>{{$showcase->category()->first()->name}}</p>
    </div>
</div> --}}