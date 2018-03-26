<!-- Nama Category -->

<div class="form-group">
  <label class="col-sm-3 control-label">Name</label>
  <div class="col-sm-9">
    <input placeholder="Name" name="name" value="{!! $category->exists ? $category->name : '' !!}" class="form-control border-input" type="text" required>
  </div>
</div>

<!-- /Nama Category -->

<!-- Description Category -->

<div class="form-group">
  <label class="col-sm-3 control-label">Decription</label>
  <div class="col-sm-9">
    
    <textarea placeholder="Decription" name="description" class="form-control border-input" required>{!! $category->exists ? $category->description : '' !!}</textarea>
  </div>
</div>

<!-- /Description Category -->