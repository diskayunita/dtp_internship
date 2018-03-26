<!-- Nama Category -->
<div class="form-group">
    <label class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
        <input placeholder="Name" name="name" value="{!! $admin->exists ? $admin->name : '' !!}" class="form-control border-input" type="text" required>
    </div>
</div>
<!-- /Nama Category -->

<!-- Description Category -->
<div class="form-group">
    <label class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
        <input placeholder="Email" name="email" value="{!! $admin->exists ? $admin->email : '' !!}" class="form-control border-input" type="text" required>
    </div>
</div>
<!-- /Description Category -->

<!-- Description Category -->
<div class="form-group">
    <label class="col-sm-2 control-label">Role</label>
    <div class="col-sm-10">
        <select class="form-control border-input" name="role" required>
            <option value="">-- Select --</option>
            @foreach($roles as $role)
                <option value="{{$role->id}}" {!! $admin->role == $role->id ? 'selected' : '' !!}>{{$role->name}}</option>
            @endforeach
        </select>
    </div>
</div>
<!-- /Description Category -->


<div class="form-group">
    <label class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
        <input id="password" type="password" class="form-control border-input" name="password" required>
    </div>
</div>


<div class="form-group">
    <label class="col-sm-2 control-label">Password Confirm</label>
    <div class="col-sm-10">
        <input id="password-confirm" type="password" class="form-control border-input" name="password_confirmation" required>
    </div>
</div>