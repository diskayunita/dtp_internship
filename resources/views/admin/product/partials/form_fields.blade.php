{{-- Event Product Indonesian --}}
<div class="tab-pane active" id="id">
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="col-sm-3 control-label">Nama</label>
        <div class="col-sm-9">
            <input placeholder="Nama Product of Interest" name="name[1]" value="{!! $product->exists ?  ($product->translation()->first() ? $product->translation('id')->first()->name : '') : '' !!}" class="form-control border-input" type="text" required>
        </div>
    </div>
</div>

{{-- Event Product English --}}
<div class="tab-pane" id="en">
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="col-sm-3 control-label">Name</label>
        <div class="col-sm-9">
            <input placeholder="Name of Product of Interest" name="name[0]" value="{!! $product->exists ? ($product->translation()->first() ? $product->translation('en')->first()->name : '') : '' !!}" class="form-control border-input" type="text">
        </div>
    </div>
</div>