<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
  <label for="title" class="col-md-2 control-label">Title</label>
  <div class="col-md-10">
    <div class="form-line">
      <input id="title" type="text" class="title_en form-control border-input" name="title[0]" value="{{ $article->exists ? ($article->translation('en')->first() ? $article->translation('en')->first()->title : '') : '' }}" autofocus>
    </div>
  </div>
</div>
<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
  <label for="content" class="col-md-2 control-label">Content</label>
  <div class="col-md-10">
    <div class="form-line">
      <textarea id="content[0]" type="text" class="content_en form-control" name="content[0]" autofocus>
        {{ $article->exists ? ($article->translation('en')->first() ? $article->translation('en')->first()->content : '') : '' }}
      </textarea>
    </div>
  </div>
</div>
<div class="form-group{{ $errors->has('image_desc') ? ' has-error' : '' }}">
  <label for="image_desc" class="col-md-2 control-label">Image Description</label>
  <div class="col-md-10">
    <div class="form-line">
      <textarea id="image_desc" class="image_desc_en form-control border-input" name="image_desc[0]" autofocus>{{ $article->exists ? ($article->translation('en')->first() ? $article->translation('en')->first()->image_desc : '') : '' }}</textarea>
    </div>
  </div>
</div>