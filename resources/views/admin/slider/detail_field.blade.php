{{-- Indonesian Tab Pane --}}
<div class="tab-pane active" id="id">
    <div class="form-group{{ $errors->has('caption') ? ' has-error' : '' }}">
        <label for="title" class="col-md-2 control-label">Keterangan</label>
        <div class="col-md-10">
            <div class="form-line">
                <p>{{ $slider->exists ? ($slider->translation('en')->first() ? $slider->translation('en')->first()->caption : '') : null }}</p>
            </div>
        </div>
    </div>

    <div class="form-group{{ $errors->has('referal_link') ? ' has-error' : '' }}">
        <label for="referal_link" class="col-md-2 control-label">Referal Link</label>
        <div class="col-md-10">
            <div class="form-line">
                <p>{{ $slider->exists ? ($slider->translation('en')->first() ? $slider->translation('en')->first()->referal_link : '') : '' }}</p>
            </div>
        </div>
    </div>

    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
        <label for="description" class="col-md-2 control-label">Deskripsi</label>
        <div class="col-md-10">
            <div class="form-line">
                {!! $slider->exists ? ($slider->translation('en')->first() ? $slider->translation('en')->first()->description : '') : '' !!}
            </div>
        </div>
    </div>
</div>

{{-- English Tab Pane --}}
<div class="tab-pane" id="en">
    <div class="form-group{{ $errors->has('caption') ? ' has-error' : '' }}">
        <label for="title" class="col-md-2 control-label">Caption</label>
        <div class="col-md-10">
            <div class="form-line">
                <p>{{ $slider->exists ? ($slider->translation('en')->first() ? $slider->translation('en')->first()->caption : '') : null }}</p>
            </div>
        </div>
    </div>

    <div class="form-group{{ $errors->has('referal_link') ? ' has-error' : '' }}">
        <label for="referal_link" class="col-md-2 control-label">Referal Link</label>
        <div class="col-md-10">
            <div class="form-line">
                <p>{{ $slider->exists ? ($slider->translation('en')->first() ? $slider->translation('en')->first()->referal_link : '') : '' }}</p>
            </div>
        </div>
    </div>

    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
        <label for="description" class="col-md-2 control-label">Description</label>
        <div class="col-md-10">
            <div class="form-line">
                {!! $slider->exists ? ($slider->translation('en')->first() ? $slider->translation('en')->first()->description : '') : '' !!}
            </div>
        </div>
    </div>
</div>