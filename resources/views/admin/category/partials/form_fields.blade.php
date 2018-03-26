{{-- Event Pupose Indonesian --}}
<div class="tab-pane active" id="id">
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="col-sm-3 control-label">Nama</label>
        <div class="col-sm-9">
            <input placeholder="Nama Category" name="nameTrans[1]" value="{!! $category->exists ?  ($category->translation()->first() ? $category->translation('id')->first()->name : '') : '' !!}" class="form-control border-input" type="text" required>
        </div>
    </div>
    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
      <label class="col-sm-3 control-label">Decription</label>
      <div class="col-sm-9">
        <textarea placeholder="Deskripsi" name="descriptionTrans[1]" class="form-control border-input" required>{!! $category->exists ?  ($category->translation()->first() ? $category->translation('id')->first()->description : '') : '' !!}</textarea>
      </div>
    </div>
</div>

{{-- Event Pupose English --}}
<div class="tab-pane" id="en">
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="col-sm-3 control-label">Name</label>
        <div class="col-sm-9">
            <input placeholder="Category Name" name="nameTrans[0]" value="{!! $category->exists ? ($category->translation()->first() ? $category->translation('en')->first()->name : '') : '' !!}" class="form-control border-input" type="text">
        </div>
    </div>
    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
      <label class="col-sm-3 control-label">Decription</label>
      <div class="col-sm-9">
        <textarea placeholder="Decription" name="descriptionTrans[0]" class="form-control border-input" required>{!! $category->exists ? ($category->translation()->first() ? $category->translation('en')->first()->description : '') : '' !!}</textarea>
      </div>
    </div>
</div>