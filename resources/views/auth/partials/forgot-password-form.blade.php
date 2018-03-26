<form class="forget-form" action="{{ route('password.email') }}" method="post" {{-- style="display: {{$forgot ? 'block' : 'none'}};" --}}>
                        {{ csrf_field() }}
    <h3 class="font-red-thunderbird">@lang('forgot.forget') ?</h3>
    <p class="font-grey-cascade"> @lang('forgot.command'). </p>
    <div class="form-group">
        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="@lang('forgot.email')" name="email" /> </div>
    <div class="form-actions">
        <button type="button" id="back-btn" class="btn grey-cascade btn-outline">@lang('forgot.back')</button>
        <button type="submit" class="btn red-thunderbird uppercase pull-right">Submit</button>
    </div>
</form>
