<div class="form-group{{ $errors->has('caption') ? ' has-error' : '' }}">
    <label for="title" class="col-md-2 control-label">Caption</label>
    <div class="col-md-10">
        <div class="form-line">
            <input id="caption" type="text" class="form-control border-input" name="caption[0]" value="{{ $slider->exists ? ($slider->translation('en')->first() ? $slider->translation('en')->first()->caption : '') : null }}" autofocus>
        </div>
    </div>
</div>

<div class="form-group{{ $errors->has('referal_link') ? ' has-error' : '' }}">
    <label for="referal_link" class="col-md-2 control-label">Referal Link</label>
    <div class="col-md-10">
        <div class="form-line">
            <input id="referal_link" type="text" class="form-control border-input" name="referal_link[0]" value="{{ $slider->exists ? ($slider->translation('en')->first() ? $slider->translation('en')->first()->referal_link : '-') : '-' }}" autofocus>
        </div>
    </div>
</div>

<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    <label for="description" class="col-md-2 control-label">Description</label>
    <div class="col-md-10">
        <div class="form-line">
            <textarea id="description" class="form-control border-input" name="description[0]" autofocus>{{ $slider->exists ? ($slider->translation('en')->first() ? $slider->translation('en')->first()->description : '') : '' }}</textarea>
        </div>
    </div>
</div>