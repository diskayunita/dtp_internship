<form class="register-form" role="form" method="POST" action="{{ route('register') }}" {{-- style="display: {{$register ? 'block' : 'none'}}; --}}">
    {{ csrf_field() }}
    <h3 class="font-red-thunderbird">@lang('register.title')</h3>
    <p class="hint"> @lang('register.command'): </p>
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="control-label visible-ie8 visible-ie9">@lang('register.name')</label>
        <input class="form-control placeholder-no-fix" minlength="5" maxlength="30" value="{{ old('name') }}" type="text" placeholder="@lang('register.name')" name="name" required autofocus/>
        
        @if ($errors->has('name'))
        <span class="help-block">
          <strong>{{ $errors->first('name') }}</strong>
        </span>
        @endif

    </div>
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label class="control-label visible-ie8 visible-ie9">@lang('register.email')</label>
        <input class="form-control placeholder-no-fix" value="{{ old('email') }}" type="text" placeholder="@lang('register.email')" name="email" required autofocus/>
        
        @if ($errors->has('email'))
        <span class="help-block">
          <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif

    </div>
    <div class="form-group{{ $errors->has('mobile_number') ? ' has-error' : '' }}">
        <label class="control-label visible-ie8 visible-ie9">Mobile Phone</label>
        <input class="form-control placeholder-no-fix bfh-phone" value="{{ old('mobile_number') }}" type="text" placeholder="@lang('register.mobile_number')" name="mobile_number" data-format="ddddddddddddd" required autofocus/>
        
        @if ($errors->has('mobile_number'))
        <span class="help-block">
          <strong>{{ $errors->first('mobile_number') }}</strong>
        </span>
        @endif
    </div>
        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
        <label class="control-label visible-ie8 visible-ie9">@lang('register.address')</label>
        <textarea class="form-control" type="text" placeholder="@lang('register.address')" name="address" required autofocus>{{ old('address') }}</textarea>
        
        @if ($errors->has('address'))
        <span class="help-block">
          <strong>{{ $errors->first('address') }}</strong>
        </span>
        @endif

    </div>
    <div class="form-group{{ $errors->has('university') ? ' has-error' : '' }}">
        <label class="control-label visible-ie8 visible-ie9">@lang('register.university')</label>
        <select name="university" class="form-control" required autofocus>
            <option value="" {{old('university') == '' ? 'selected' : ''}}>-- @lang('register.university') --</option>
            <option value="Binus University" {{old('university') == 'BinusUniversity' ? 'selected' : ''}}>Bina Nusantara University</option>
            <option value="Telkom University" {{old('university') == 'TelkomUniversity' ? 'selected' : ''}}>Telkom University</option>
            <option value="President University" {{old('university') == 'PresidentUniversity' ? 'selected' : ''}}>President University</option>
        </select>
        
        @if ($errors->has('university'))
        <span class="help-block">
          <strong>{{ $errors->first('university') }}</strong>
        </span>
        @endif

    </div>
    <div class="form-group{{ $errors->has('nim') ? ' has-error' : '' }}">
        <label class="control-label visible-ie8 visible-ie9">@lang('register.nim')</label>
        <input class="form-control placeholder-no-fix" type="text" value="{{ old('nim') }}" placeholder="@lang('register.nim')" name="nim" required autofocus/>
        
        @if ($errors->has('nim'))
        <span class="help-block">
          <strong>{{ $errors->first('nim') }}</strong>
        </span>
        @endif

    </div>
    <div class="form-group{{ $errors->has('major') ? ' has-error' : '' }}">
        <label class="control-label visible-ie8 visible-ie9">@lang('register.major')</label>
        <input class="form-control placeholder-no-fix" type="text" value="{{ old('major') }}" placeholder="@lang('register.major')" name="major" required autofocus/>
        
        @if ($errors->has('major'))
        <span class="help-block">
          <strong>{{ $errors->first('major') }}</strong>
        </span>
        @endif

    </div>
    <div class="form-group{{ $errors->has('faculty') ? ' has-error' : '' }}">
        <label class="control-label visible-ie8 visible-ie9">@lang('register.faculty')</label>
        <input class="form-control placeholder-no-fix" type="text" value="{{ old('faculty') }}" placeholder="@lang('register.faculty')" name="faculty" required autofocus/>
        
        @if ($errors->has('faculty'))
        <span class="help-block">
          <strong>{{ $errors->first('faculty') }}</strong>
        </span>
        @endif

    </div>

    <p class="hint"> @lang('register.enterpassword'): </p>
    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label class="control-label visible-ie8 visible-ie9">@lang('register.password')</label>
        <input class="form-control placeholder-no-fix" type="password" value="{{ old('password') }}" autocomplete="off" id="register_password" placeholder="@lang('register.password')" name="password" required autofocus/>
        
        @if ($errors->has('password'))
        <span class="help-block">
          <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif

    </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">@lang('register.password_confirmation')</label>
        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="@lang('register.password_confirmation')" name="password_confirmation" required autofocus/>
    </div>
    <div class="form-group margin-top-20 margin-bottom-20">
        <label class="mt-checkbox mt-checkbox-outline">
            <input type="checkbox" name="tnc" required/> @lang('register.agreement')
            <a href="javascript:;">@lang('register.service') </a> &
            <a href="javascript:;">@lang('register.privacy') </a>
            <span></span>
        </label>
        <div id="register_tnc_error"> </div>
    </div>
    <div class="form-actions">
        <button type="button" id="register-back-btn" class="btn grey-cascade btn-outline">@lang('register.back')</button>
        <button type="submit" id="register-submit-btn" class="btn red-thunderbird uppercase pull-right">Submit</button>
    </div>
</form>