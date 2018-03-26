<div class="tab-pane active" id="id">
    <div class="form-group">
        <label for="title" class="col-md-2 control-label">Judul</label>
        <div class="col-md-10">
            <p>{{ $article->translation('id')->first() ? $article->translation('id')->first()->title : '-' }}</p>
        </div>
    </div>

    <div class="form-group">
        <label for="content" class="col-md-2 control-label">Isi</label>
        <div class="col-md-10">
            {!! $article->translation('id')->first() ? $article->translation('id')->first()->content : '' !!}
        </div>
    </div>

    <div class="form-group">
        <label for="image" class="col-md-2 control-label">Gambar</label>
        <div class="col-md-10">
            <img  id="showgambar-id" src="{{ $article->first() ? $article->first()->image->url() : asset('image/article/default.png') }}" width="510" height="510" class="img img-thumbnail">
        </div>
    </div>

    <div class="form-group">
        <label for="image_desc" class="col-md-2 control-label">Deskripsi Gambar</label>
        <div class="col-md-10">
            <p>
                {!! $article->translation('id')->first() ? $article->translation('id')->first()->image_desc : '' !!}
            </p>
        </div>
    </div>
</div>

<div class="tab-pane" id="en">
    <div class="form-group">
        <label for="title" class="col-md-2 control-label">Title</label>
        <div class="col-md-10">
            <p>{{ $article->translation('en')->first() ? $article->translation('en')->first()->title : '-' }}</p>
        </div>
    </div>

    <div class="form-group">
        <label for="content" class="col-md-2 control-label">Content</label>
        <div class="col-md-10">
            <div class="form-line">
                {!! $article->translation('id')->first() ? ($article->translation('en')->first() ? $article->translation('en')->first()->content : '') : '' !!}
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="image" class="col-md-2 control-label">Image</label>
        <div class="col-md-10">
            <img  id="showgambar-en" src="{{ $article->translation('id')->first() ? $article->image->url() : asset('image/article/default.png') }}" width="510" height="510" class="img img-thumbnail">
        </div>
    </div>

    <div class="form-group">
        <label for="image_desc" class="col-md-2 control-label">Image Description</label>
        <div class="col-md-10">
            <p>
                {{ $article->translation('id')->first() ? ($article->translation('en')->first() ? $article->translation('en')->first()->image_desc : '') : '' }}
            </p>
        </div>
    </div>
</div>


<div class="form-group">
    <label class="col-md-2 control-label">Category</label>
    <div class="col-md-10">
        <p>{{$article->category()->first()->name}}</p>
    </div>
</div>