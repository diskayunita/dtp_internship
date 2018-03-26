{{-- Event Pupose Indonesian --}}
<div class="tab-pane active" id="id">
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="col-sm-3 control-label">Nama</label>
        <div class="col-sm-9">
            <input placeholder="Nama Tujuan" name="name[1]" value="{!! $purpose->exists ?  ($purpose->translation()->first() ? $purpose->translation('id')->first()->name : '') : '' !!}" class="form-control border-input" type="text" required>
        </div>
    </div>
</div>

{{-- Event Pupose English --}}
<div class="tab-pane" id="en">
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="col-sm-3 control-label">Name</label>
        <div class="col-sm-9">
            <input placeholder="Purpose Name" name="name[0]" value="{!! $purpose->exists ? ($purpose->translation()->first() ? $purpose->translation('en')->first()->name : '') : '' !!}" class="form-control border-input" type="text">
        </div>
    </div>
</div>