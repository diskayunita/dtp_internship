<fieldset>
    <div class="form-group">
        <label class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            <input placeholder="Name" name="name" value="{!! $user->exists ? $user->name : '' !!}" class="form-control border-input" type="text" required autofocus readonly="" />
        </div>
    </div>
</fieldset>

<fieldset>
    <div class="form-group">
        <label class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input placeholder="Email Address" type="email" name="email" value="{!! $user->exists ? $user->email : '' !!}" class="form-control border-input" required autofocus readonly="" />
        </div>
    </div>
</fieldset>

<fieldset>
    <div class="form-group">
        <label class="col-sm-2 control-label">Mobile Number</label>
        <div class="col-sm-10">
            <input placeholder="Mobile Number" type="tel" name="mobile_number" value="{!! $user->exists ? $user->mobile_number : '' !!}" class="form-control border-input" {!! (Request::route()->getName() == 'admin.user.show') ? 'readonly' : 'required' !!}>
        </div>
    </div>
</fieldset>

<fieldset>
    <div class="form-group">
        <label class="col-sm-2 control-label">Address</label>
        <div class="col-sm-10">
            <input placeholder="Address" type="text" name="address" value="{!! $user->exists ? $user->address : '' !!}" class="form-control border-input" {!! (Request::route()->getName() == 'admin.user.show') ? 'readonly' : 'required' !!}>
        </div>
    </div>
</fieldset>

<fieldset>
    <div class="form-group">
        <label class="col-sm-2 control-label">University</label>
        <div class="col-sm-10">
            <input placeholder="University" type="tel" name="university" value="{!! $user->exists ? $user->university : '' !!}" class="form-control border-input" {!! (Request::route()->getName() == 'admin.user.show') ? 'readonly' : 'required' !!}>
        </div>
    </div>
</fieldset>

<fieldset>
    <div class="form-group">
        <label class="col-sm-2 control-label">NIM</label>
        <div class="col-sm-10">
            <input placeholder="NIM" type="text" name="nim" value="{!! $user->exists ? $user->nim : '' !!}" class="form-control border-input" {!! (Request::route()->getName() == 'admin.user.show') ? 'readonly' : 'required' !!}>
        </div>
    </div>
</fieldset>

<fieldset>
    <div class="form-group">
        <label class="col-sm-2 control-label">Major</label>
        <div class="col-sm-10">
            <input placeholder="Major" type="text" name="major" value="{!! $user->exists ? $user->major : '' !!}" class="form-control border-input" {!! (Request::route()->getName() == 'admin.user.show') ? 'readonly' : 'required' !!}>
        </div>
    </div>
</fieldset>

<fieldset>
    <div class="form-group">
        <label class="col-sm-2 control-label">Faculty</label>
        <div class="col-sm-10">
            <input placeholder="Faculty" type="text" name="faculty" value="{!! $user->exists ? $user->faculty : '' !!}" class="form-control border-input" {!! (Request::route()->getName() == 'admin.user.show') ? 'readonly' : 'required' !!}>
        </div>
    </div>
</fieldset>