<li class="{{ (is_null(Request::route()->getName())) ? 'active' : '' }}">
	<a href="/" class="text-uppercase">
        @lang('main_navigation.home')
    </a>
</li>

<li class="{{ (Request::route()->getName() == 'about_page') ? 'active' : '' }}">
	<a href="{{ route('about_page') }}" class="text-uppercase">
        @lang('main_navigation.about')
    </a>
</li>

<li class="{{ (Request::route()->getName() == 'gallery_page') ? 'active' : '' }}">
	<a href="{{ route('gallery_page') }}" class="text-uppercase">
        @lang('main_navigation.gallery')
    </a>
</li>

<li class="{{ (Request::route()->getName() == 'all-article') ? 'active' : '' }}">
    <a href="{{ route('all-article') }}" class="text-uppercase">
        @lang('main_navigation.news')
    </a>
</li>

{{--<li class="{{ (Request::route()->getName() == 'all-showcase') ? 'active' : '' }}">
    <a href="{{ route('all-showcase') }}" class="text-uppercase">
        @lang('main_navigation.product')
    </a>
</li>--}}

<li class="{{ (Request::route()->getName() == 'contact_page') ? 'active' : '' }}">
    <a href="{{ route('contact_page') }}" class="text-uppercase">
        @lang('main_navigation.contact_us')
    </a>
</li>


@if(Auth::guest())
<li class="{{ (Request::route()->getName() == 'login-register') ? 'active' : '' }}">
	<a href="{{ route('login-register') }}" class="text-uppercase">
        @lang('main_navigation.login_register')
    </a>
</li>
@endif
@if(Auth::check())
<li class="{{ Request::is('event*') ? 'active' : '' }}">
	<a href="{{ route('event.index') }}" class="text-uppercase">
        @lang('main_navigation.my_event')
    </a>
</li>
@endif