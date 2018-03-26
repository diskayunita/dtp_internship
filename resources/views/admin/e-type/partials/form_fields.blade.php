{{-- Event Pupose Indonesian --}}
<div class="tab-pane active" id="id">
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="col-sm-3 control-label">Nama Kunjungan</label>
        <div class="col-sm-9">
            <input placeholder="Nama Kunjungan" name="nameTrans[1]" value="{!! $type->exists ?  ($type->translation()->first() ? $type->translation('id')->first()->name : '') : '' !!}" class="form-control border-input" type="text" required>
        </div>
    </div>
    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
      <label class="col-sm-3 control-label">Deskripsi</label>
      <div class="col-sm-9">
        <textarea placeholder="Deskripsi" name="descriptionTrans[1]" class="form-control border-input" required>{!! $type->exists ?  ($type->translation()->first() ? $type->translation('id')->first()->description : '') : '' !!}</textarea>
      </div>
    </div>
</div>

{{-- Event Pupose English --}}
<div class="tab-pane" id="en">
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="col-sm-3 control-label">Event Purpose Name</label>
        <div class="col-sm-9">
            <input placeholder="Event purpose Name" name="nameTrans[0]" value="{!! $type->exists ? ($type->translation()->first() ? $type->translation('en')->first()->name : '') : '' !!}" class="form-control border-input" type="text">
        </div>
    </div>
    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
      <label class="col-sm-3 control-label">Decription</label>
      <div class="col-sm-9">
        <textarea placeholder="Decription" name="descriptionTrans[0]" class="form-control border-input">{!! $type->exists ? ($type->translation()->first() ? $type->translation('en')->first()->description : '') : '' !!}</textarea>
      </div>
    </div>
</div>