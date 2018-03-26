<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
  <label for="content" class="col-md-2 control-label">Content</label>
  <div class="col-md-10">
    <div class="form-line">
      <textarea id="content[0]" type="text" class="content_en form-control" name="content[0]" autofocus>
        {{ $about->exists ? ($about->translation('en')->first() ? $about->translation('en')->first()->content : '') : '' }}
      </textarea>
    </div>
  </div>
</div>
