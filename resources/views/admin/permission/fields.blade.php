<!-- Nama Category -->
<fieldset>
    <div class="form-group">
        <label class="col-sm-3 control-label">Name</label>
        <div class="col-sm-9">
            <input placeholder="Name" name="name" value="{!! $permission->exists ? $permission->name : '' !!}" class="form-control border-input" type="text" required>
        </div>
    </div>
</fieldset>
<!-- /Nama Category -->

<!-- Description Category -->
<fieldset>
    <div class="form-group">
        <label class="col-sm-3 control-label">Display Name</label>
        <div class="col-sm-9">
            <input placeholder="Display Name" name="display_name" value="{!! $permission->exists ? $permission->display_name : '' !!}" class="form-control border-input" type="text" required>
        </div>
    </div>
</fieldset>
<!-- /Description Category -->

<!-- Description Category -->
<fieldset>
    <div class="form-group">
        <label class="col-sm-3 control-label">Decription</label>
        <div class="col-sm-9">
            <textarea placeholder="Decription" name="description" class="form-control border-input" required>{!! $permission->exists ? $permission->description : '' !!}</textarea>
        </div>
    </div>
</fieldset>
<!-- /Description Category -->