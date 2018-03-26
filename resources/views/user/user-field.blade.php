<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} col-md-12">
  <div class="col-md-12 inputGroupContainer">
    <label class="control-label">@lang('register.name')</label>
    <input class="form-control placeholder-no-fix"  value="{{ old('name') ? old('name') : $user->name ? $user->name : null }}" type="text" placeholder="@lang('register.name')" name="name" required autofocus/>
    
    @if ($errors->has('name'))
    <span class="help-block">
      <strong>{{ $errors->first('name') }}</strong>
    </span>
    @endif
  </div>
</div>
<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} col-md-12">
  <div class="col-md-12 inputGroupContainer">
    <label class="control-label">@lang('register.email')</label>
    <input class="form-control placeholder-no-fix" value="{{ old('email') ? old('email') : $user->email ? $user->email : null  }}" type="text" placeholder="@lang('register.email')" {{-- name="email" --}} readonly/>
    
    @if ($errors->has('email'))
    <span class="help-block">
      <strong>{{ $errors->first('email') }}</strong>
    </span>
    @endif
  </div>
</div>
<div class="form-group{{ $errors->has('mobile_number') ? ' has-error' : '' }} col-md-12">
  <div class="col-md-12 inputGroupContainer">
    <label class="control-label">@lang('register.mobile_number')</label>
    <input class="form-control placeholder-no-fix bfh-phone" value="{{ old('mobile_number') ? old('mobile_number') : $user->mobile_number ? $user->mobile_number : null  }}" type="text" placeholder="081200001234" name="mobile_number" data-format="ddddddddddddd" required autofocus/>
    
    @if ($errors->has('mobile_number'))
    <span class="help-block">
      <strong>{{ $errors->first('mobile_number') }}</strong>
    </span>
    @endif
  </div>
</div>
<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }} col-md-12">
  <div class="col-md-12 inputGroupContainer">
    <label class="control-label">@lang('register.address')</label>
    <textarea class="form-control" placeholder="@lang('register.address')" name="address" required autofocus>{{ old('address') ? old('address') : $user->address ? $user->address : null  }}</textarea>
    
    @if ($errors->has('address'))
    <span class="help-block">
      <strong>{{ $errors->first('address') }}</strong>
    </span>
    @endif
  </div>
</div>
<div class="form-group{{ $errors->has('university') ? ' has-error' : '' }} col-md-12">
  <div class="col-md-12 inputGroupContainer">
    <label class="control-label">@lang('register.university')</label>
    @php
      $university = (old('university') ? old('university') : $user->university ? $user->university : null);
    @endphp
    <select name="university" class="form-control" required>
        <option value="" {{$university == null ? 'selected' : ''}}>-- @lang('register.university') --</option>
        <option value="Binus University" {{$university == 'BinusUniversity' ? 'selected' : ''}}>Binus University</option>
        <option value="Telkom University" {{$university == 'TelkomUniversity' ? 'selected' : ''}}>Telkom University</option>
        <option value="President University" {{$university == 'PresidentUniversity' ? 'selected' : ''}}>President University</option>
    </select>
    
    @if ($errors->has('university'))
    <span class="help-block">
      <strong>{{ $errors->first('university') }}</strong>
    </span>
    @endif
  </div>
</div>
<div class="form-group{{ $errors->has('nim') ? ' has-error' : '' }} col-md-12">
  <div class="col-md-12 inputGroupContainer">
    <label class="control-label">@lang('register.nim')</label>
    <input class="form-control placeholder-no-fix" type="text" value="{{ old('nim') ? old('nim') : $user->nim ? $user->nim : null }}" placeholder="@lang('register.nim')" name="nim" required autofocus/>
    
    @if ($errors->has('nim'))
    <span class="help-block">
      <strong>{{ $errors->first('nim') }}</strong>
    </span>
    @endif
  </div>
</div>
<div class="form-group{{ $errors->has('major') ? ' has-error' : '' }} col-md-12">
  <div class="col-md-12 inputGroupContainer">
    <label class="control-label">@lang('register.major')</label>
    <input class="form-control placeholder-no-fix" type="text" value="{{ old('major') ? old('major') : $user->major ? $user->major : null }}" placeholder="@lang('register.major')" name="major" required autofocus/>
    
    @if ($errors->has('major'))
    <span class="help-block">
      <strong>{{ $errors->first('major') }}</strong>
    </span>
    @endif
  </div>
</div>
<div class="form-group{{ $errors->has('faculty') ? ' has-error' : '' }} col-md-12">
  <div class="col-md-12 inputGroupContainer">
    <label class="control-label">@lang('register.faculty')</label>
    <input class="form-control placeholder-no-fix" type="text" value="{{ old('faculty') ? old('faculty') : $user->faculty ? $user->faculty : null }}" placeholder="@lang('register.faculty')" name="faculty" required autofocus/>
    
    @if ($errors->has('faculty'))
    <span class="help-block">
      <strong>{{ $errors->first('faculty') }}</strong>
    </span>
    @endif
  </div>
</div>
