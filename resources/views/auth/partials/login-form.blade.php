    @if($status = Session::get('status'))
      <div class="alert alert-info">
        {{$status }}
      </div>
    @endif
    <form class="login-form" action="{{ route('login') }}" method="post" {{-- style="display: {{$login ? 'block' : 'none'}};  " --}}>
    {{ csrf_field() }}
        <h3 class="form-title font-red-thunderbird">@lang('login.title')</h3>
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span> Enter your registered email and password. </span>
        </div>
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="control-label visible-ie8 visible-ie9">Username</label>
            <input id="email" class="form-control form-control-solid placeholder-no-fix" type="email" autocomplete="off" placeholder="@lang('login.email')" name="email" value="{{ old('email') }}" required autofocus/> 
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
        </div>
        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input id="password" class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="@lang('login.password')" name="password" required /> 
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
        </div>
        <div class="form-actions">
            <button type="submit" class="btn red-thunderbird uppercase">@lang('login.title')</button>
            <label class="rememberme check mt-checkbox mt-checkbox-outline">
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} />@lang('login.remember')
                <span></span>
            </label>
            <a href="javascript:;" id="forget-password" class="forget-password">@lang('login.forgot_password')?</a>
        </div>
        <div class="login-options">
            <h4>@lang('login.social')</h4>
                <div class="socicons text-right">
                    <a href="{{url('auth/facebook')}}" class="socicon-btn socicon-btn-circle socicon-sm socicon-solid bg-blue bg-hover-grey-salsa font-white bg-hover-white socicon-facebook tooltips" data-original-title="Facebook"></a>
                    <a href="{{url('auth/twitter')}}" class="socicon-btn socicon-btn-circle socicon-sm socicon-solid bg-green bg-hover-grey-salsa font-white bg-hover-white socicon-twitter tooltips" data-original-title="Twitter"></a>
                </div>
        </div>
        <div class="create-account">
            <p>
                <a href="javascript:;" id="register-btn" class="btn btn-block uppercase">@lang('login.signup')</a>
            </p>
        </div>
    </form>