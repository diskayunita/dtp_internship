<div class="tab-pane active" id="id">
    <div class="form-group{{ $errors->has('caption') ? ' has-error' : '' }}">
        <label for="title" class="col-md-2 control-label">Keterangan</label>
        <div class="col-md-10">
            <div class="form-line">
                <p>{{ $gallery->exists ? ($gallery->translation('en')->first() ? $gallery->translation('en')->first()->caption : '') : null }}</p>
            </div>
        </div>
    </div>

    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
        <label for="description" class="col-md-2 control-label">Deskripsi</label>
        <div class="col-md-10">
            <div class="form-line">
                {!! $gallery->exists ? ($gallery->translation('en')->first() ? $gallery->translation('en')->first()->description : '') : '' !!}
            </div>
        </div>
    </div>
</div>

<div class="tab-pane" id="en">
    <div class="form-group{{ $errors->has('caption') ? ' has-error' : '' }}">
        <label for="title" class="col-md-2 control-label">Caption</label>
        <div class="col-md-10">
            <div class="form-line">
                <p>{{ $gallery->exists ? ($gallery->translation('en')->first() ? $gallery->translation('en')->first()->caption : '') : null }}</p>
            </div>
        </div>
    </div>

    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
        <label for="description" class="col-md-2 control-label">Description</label>
        <div class="col-md-10">
            <div class="form-line">
                {!! $gallery->exists ? ($gallery->translation('en')->first() ? $gallery->translation('en')->first()->description : '') : '' !!}
            </div>
        </div>
    </div>
</div>