<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
  <label for="title" class="col-md-2 control-label">Judul</label>
  <div class="col-md-10">
    <div class="form-line">
      <input id="title" type="text" class="title_id form-control border-input" name="title[1]" value="{{ $article->exists ? ($article->translation('id')->first() ? $article->translation('id')->first()->title : '-') : '' }}" required autofocus>
    </div>
  </div>
</div>
<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
  <label for="content" class="col-md-2 control-label">Isi</label>
  <div class="col-md-10">
    <div class="form-line">
      <textarea id="content[1]" type="text" class="content_id form-control" name="content[1]" required="" autofocus="">
        {!! $article->exists ? ($article->translation('id')->first() ? $article->translation('id')->first()->content : '') : '' !!}
      </textarea>
    </div>
  </div>
</div>
<div class="form-group{{ $errors->has('image_desc') ? ' has-error' : '' }}">
  <label for="image_desc" class="col-md-2 control-label">Deskripsi Gambar</label>
  <div class="col-md-10">
    <div class="form-line">
      <textarea id="image_desc" class="image_desc_id form-control border-input" name="image_desc[1]" required autofocus>{!! $article->exists ? ($article->translation('id')->first() ? $article->translation('id')->first()->image_desc : '') : '-' !!}</textarea>
    </div>
  </div>
</div>