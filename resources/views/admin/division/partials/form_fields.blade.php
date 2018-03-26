{{-- Event Pupose Indonesian --}}
<div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
    @php
        $avatar = $division->avatar->url('medium') ?
            (file_exists($_SERVER['DOCUMENT_ROOT'].$division->avatar->url('medium')) ?
                $division->avatar->url('medium') : asset("img/faces/default_profile.png")) :
                    asset("img/faces/default_profile.png");
    @endphp
    <label for="avatar" class="col-md-2 control-label">Icon</label>
    <div class="col-md-10">
        <img  id="showgambar-en" src="{{ $avatar }}" width="510" height="510" class="img img-thumbnail">
        <div class="form-line">
            <input id="avatar" type="file" class="form-control border-input" name="avatar" value="" autofocus>
        </div>
    </div>
</div>
<div class="tab-pane active" id="id">
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="col-sm-3 control-label">Nama</label>
        <div class="col-sm-9">
            <input placeholder="Nama division" name="nameTrans[1]" value="{!! $division->exists ?  ($division->translation()->first() ? $division->translation('id')->first()->name : '') : '-' !!}" class="form-control border-input" type="text" required>
        </div>
    </div>
    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
      <label class="col-sm-3 control-label">Deskripsi</label>
      <div class="col-sm-9">
        <textarea placeholder="Deskripsi" name="descriptionTrans[1]" class="form-control border-input" required>{!! $division->exists ?  ($division->translation()->first() ? $division->translation('id')->first()->description : '') : '-' !!}</textarea>
      </div>
    </div>
</div>

{{-- Event Pupose English --}}
<div class="tab-pane" id="en">
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="col-sm-3 control-label">Name</label>
        <div class="col-sm-9">
            <input placeholder="division Name" name="nameTrans[0]" value="{!! $division->exists ? ($division->translation()->first() ? $division->translation('en')->first()->name : '') : '-' !!}" class="form-control border-input" type="text">
        </div>
    </div>
    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
      <label class="col-sm-3 control-label">Decription</label>
      <div class="col-sm-9">
        <textarea placeholder="Decription" name="descriptionTrans[0]" class="form-control border-input" required>{!! $division->exists ? ($division->translation()->first() ? $division->translation('en')->first()->description : '') : '-' !!}</textarea>
      </div>
    </div>
</div>