<div class="form-group{{ $errors->has('caption') ? ' has-error' : '' }}">
    <label for="caption" class="col-md-2 control-label">Judul</label>
    <div class="col-md-10">
        <div class="form-line">
            <input id="caption" type="text" class="form-control border-input" name="caption[1]" value="{{ $slider->exists ? ($slider->translation('id')->first() ? $slider->translation('id')->first()->caption : '-') : '-' }}" required autofocus>
        </div>
    </div>
</div>

<div class="form-group{{ $errors->has('referal_link') ? ' has-error' : '' }}">
    <label for="referal_link" class="col-md-2 control-label">Referal link</label>
    <div class="col-md-10">
        <div class="form-line">
            <input id="referal_link" type="text" class="form-control border-input" name="referal_link[1]" value="{{ $slider->exists ? ($slider->translation('id')->first() ? $slider->translation('id')->first()->referal_link : '-' ) : '-' }}" required autofocus>
        </div>
    </div>
</div>

<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    <label for="description" class="col-md-2 control-label">Deskripsi</label>
    <div class="col-md-10">
        <div class="form-line">
            <textarea id="description" class="form-control border-input" name="description[1]" required autofocus>{!! $slider->exists ? ($slider->translation('id')->first() ? $slider->translation('id')->first()->description : '-') : '-' !!}</textarea>
        </div>
    </div>
</div>