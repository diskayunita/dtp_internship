<div class="form-group{{ $errors->has('caption') ? ' has-error' : '' }}">
    <label for="title" class="col-md-2 control-label">Caption</label>
    <div class="col-md-10">
        <div class="form-line">
            <input id="caption" type="text" class="form-control border-input" name="caption[0]" value="{{ $gallery->exists ? ($gallery->translation('en')->first() ? $gallery->translation('en')->first()->caption : '') : null }}" autofocus>
        </div>
    </div>
</div> 

<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    <label for="description" class="col-md-2 control-label">Description</label>
    <div class="col-md-10">
        <div class="form-line">
            <textarea id="description" class="form-control border-input" name="description[0]" autofocus>{{ $gallery->exists ? ($gallery->translation('en')->first() ? $gallery->translation('en')->first()->description : '') : '' }}</textarea>
        </div>
    </div>
</div>