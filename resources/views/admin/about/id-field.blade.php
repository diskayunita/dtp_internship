<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
  <label for="content" class="col-md-2 control-label">Isi</label>
  <div class="col-md-10">
    <div class="form-line">
      <textarea id="content[1]" type="text" class="content_id form-control" name="content[1]" autofocus>
        {{ $about->exists ? ($about->translation('id')->first() ? $about->translation('id')->first()->content : '') : '' }}
      </textarea>
    </div>
  </div>
</div>
