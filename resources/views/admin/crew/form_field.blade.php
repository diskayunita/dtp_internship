<div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
    @php
        $avatar = $crew->avatar->url('medium') ?
            (file_exists($_SERVER['DOCUMENT_ROOT'].$crew->avatar->url('medium')) ?
                $crew->avatar->url('medium') : asset("img/faces/default_profile.png")) :
                    asset("img/faces/default_profile.png");
    @endphp
    <label for="avatar" class="col-md-2 control-label">Avatar</label>
    <div class="col-md-10">
        <img  id="show-avatar" src="{{ $avatar }}" width="510" height="510" class="img img-thumbnail">
        <div class="form-line">
            <input id="avatar" type="file" class="form-control border-input" name="avatar" value="" autofocus>
        </div>
    </div>
</div>

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">Name</label>
    <div class="col-md-10">
        <input type="text" name="name" class="form-control border-input" value="{{ $crew->exists ? ($crew->name ? $crew->name : '') : '' }}" required autofocus="">
    </div>
</div>

<div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
    <label for="gender" class="col-md-2 control-label">Gender</label>
    <div class="col-md-10">
        <select name="gender" id="gender" class="form-control border-input" required>
            <option value="" {{ $crew->exists ? $crew->gender == '' ? 'selected' : '' : 'selected' }}>-- Select Gender --</option>
            <option value="male" {{ $crew->exists ? $crew->gender == 'male' ? 'selected' : '' : '' }}>Male</option>
            <option value="female" {{ $crew->exists ? $crew->gender == 'female' ? 'selected' : '' : '' }}>Female</option>
        </select>
    </div>
</div>

<div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
    <label for="position" class="col-md-2 control-label">Position</label>
    <div class="col-md-10">
        <input type="text" name="position" class="form-control border-input" value="{{ $crew->exists ? ($crew->position ? $crew->position : '') : '' }}" required autofocus="">
    </div>
</div>

<div class="form-group{{ $errors->has('facebook') ? ' has-error' : '' }}">
    <label for="facebook" class="col-md-2 control-label">Facebook</label>
    <div class="col-md-10">
        <input type="text" name="facebook" class="form-control border-input" value="{{ $crew->exists ? ($crew->facebook ? $crew->facebook : '') : '' }}" autofocus="">
    </div>
</div>

<div class="form-group{{ $errors->has('twitter') ? ' has-error' : '' }}">
    <label for="twitter" class="col-md-2 control-label">Twitter</label>
    <div class="col-md-10">
        <input type="text" name="twitter" class="form-control border-input" value="{{ $crew->exists ? ($crew->twitter ? $crew->twitter : '') : '' }}" autofocus="">
    </div>
</div>