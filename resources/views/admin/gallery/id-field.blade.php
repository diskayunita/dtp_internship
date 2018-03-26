<div class="form-group{{ $errors->has('caption') ? ' has-error' : '' }}">
    <label for="title" class="col-md-2 control-label">Keterangan</label>
    <div class="col-md-10">
        <div class="form-line">
            <input id="caption" type="text" class="form-control border-input" name="caption[1]" value="{{ $gallery->exists ? ($gallery->translation('id')->first() ? $gallery->translation('id')->first()->caption : '-') : '-' }}" autofocus>
        </div>
    </div>
</div>

<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    <label for="description" class="col-md-2 control-label">Deskripsi</label>
    <div class="col-md-10">
        <div class="form-line">
            <textarea id="description" class="form-control border-input" name="description[1]" autofocus>{{ $gallery->exists ? ($gallery->translation('id')->first() ? $gallery->translation('id')->first()->description : '') : '-' }}</textarea>
        </div>
    </div>
</div>