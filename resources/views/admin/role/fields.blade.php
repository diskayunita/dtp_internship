<!-- Nama Category -->
<fieldset>
    <div class="form-group">
        <label class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            {!! $role->exists ? $role->name : '' !!}
        </div>
    </div>
</fieldset>
<!-- /Nama Category -->

<!-- Description Category -->
<fieldset>
    <div class="form-group">
        <label class="col-sm-2 control-label">Display Name</label>
        <div class="col-sm-10">
            {!! $role->exists ? $role->display_name : '' !!}
        </div>
    </div>
</fieldset>
<!-- /Description Category -->

<!-- Description Category -->
<fieldset>
    <div class="form-group">
        <label class="col-sm-2 control-label">Decription</label>
        <div class="col-sm-10">
            {!! $role->exists ? $role->description : '' !!}
        </div>
    </div>
</fieldset>
<!-- /Description Category -->