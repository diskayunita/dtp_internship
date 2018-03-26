<div class="page-header">
    <div class="page-header-top">
        <div class="container">
            <div class="page-logo">
                <a href="">
                    <img src="{{asset('assets/img/DDS-logo.png')}}" alt="logo" class="logo-default">
                </a>
                <a href="{{ url('/') }}" target="_blank">
                    <img src="{{asset('assets/img/Telkom-logo.png')}}" alt="logo" class="logo-right">
                </a>
            </div>
            <div class="page-nav">
                <a href="javascript:;" class="menu-toggler"></a>
                <div class="dropdown">
                    <button class="btn btn-lang dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                        @if(session('locale') == 'id')
                            <img alt="" class="" src="{{asset('assets/img/flags/id.png')}}">
                        @else
                            <img alt="" class="" src="{{asset('assets/img/flags/us.png')}}">
                        @endif
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{route('language_option','id')}}">
                                <img alt="" class="" src="{{asset('assets/img/flags/id.png')}}">
                            </a>
                        </li>
                        <li>
                            <a href="{{route('language_option','en')}}">
                                <img alt="" class="" src="{{asset('assets/img/flags/us.png')}}">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="page-header-menu">
        <div class="container p-l-0">
            <div class="hor-menu  ">
                <ul class="nav navbar-nav">
                    @include('layouts.main.partials.menu')
                </ul>
                <ul class="nav navbar-nav pull-right">
                    @if( Auth::check()  && count($hasEventNotif)>=1)
                    <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown menu-dark separated">
                        <a href="javascript:;" class="padding-s">
                            <i data-count="2" class="glyphicon glyphicon-bell notification-icon"></i><span class="badge badge-event label-success">{{ count($hasEventNotif) }}</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            @foreach($hasEventNotif as $key => $value)
                                <li>

                                    <a href="{!! route('event.response', [$value->id]) !!}" style="margin-right: 50px;">
                                        @if($value['approval']=='approved')
                                            <span class="badge label-success">{{ ucfirst($value['approval']) }}</span>
                                        @elseif($value['approval']=='revision')
                                            <span class="badge label-danger">{{ ucfirst($value['approval']) }}</span>
                                        @elseif($value['approval']=='reject')
                                            <span class="badge label-warning">{{ ucfirst($value['approval']) }}</span>
                                        @else
                                            <span class="badge label-info">{{ ucfirst($value['approval']) }}</span>
                                        @endif <h5>{{ ucfirst($value['title']) }}</h5>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    @endif


                    <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown menu-dark separated">
                        <a href="javascript:;" class="padding-s">
                            @if(session('locale') == 'id')
                                <img alt="" class="" src="{{asset('assets/img/flags/id.png')}}"> Indonesia
                            @else
                                <img alt="" class="" src="{{asset('assets/img/flags/us.png')}}"> English
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default dropdown-menu-lang">
                            <li>
                                <a href="{{route('language_option','en')}}">
                                    <img alt="" class="" src="{{asset('assets/img/flags/us.png')}}"></i> English</a>
                            </li>
                            <li>
                                <a href="{{route('language_option','id')}}">
                                    <img alt="" class="" src="{{asset('assets/img/flags/id.png')}}"></i> Indonesia</a>
                            </li>
                        </ul>
                    </li>

                    @if(Auth::check())
                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown menu-dark menu-profile">
                            <a href="javascript:;" class="padding-s">
                                {{ Auth::user()->name }} {{-- <img alt="" class="img-circle" src="{{asset('assets/img/avatar9.jpg')}}"> --}}
                                <img alt="" class="avatar-small img-circle" src="{{useravatar()->url('small') ? (file_exists($_SERVER['DOCUMENT_ROOT'].useravatar()->url('small')) ? useravatar()->url('small') : asset("img/faces/default_profile.png")) : asset("img/faces/default_profile.png")}}">
                                <!-- <span class="arrow"></span> -->
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="{{route('user.profile')}}">
                                        <i class="icon-user"></i>  @lang('general.my_profile') </a>
                                </li>
                                <li>
                                    <a href="{{route('event.index')}}">
                                        <i class="icon-calendar"></i> @lang('main_navigation.my_event') </a>
                                </li>
                                {{--<li>
                                    <a href="{{route('message')}}">
                                        <i class="icon-envelope"></i>  @lang('general.my_message') </a>
                                </li>--}}
                                <li class="divider"> </li>
                                <li>
                                    @if(Auth::check())
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon-key"></i> @lang('general.logout')
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    @else
                                        <a href="#"><i class="icon-key"></i> @lang('general.login')</a>
                                    @endif
                                    <ul class="dropdown-menu dropdown-menu-default">
                                        <li>
                                            <a href="{{route('user.profile')}}">
                                                <i class="icon-user"></i> My Profile </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <i class="icon-calendar"></i> My Calendar </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <i class="icon-envelope-open"></i> My Inbox
                                                <span class="badge badge-danger"> 3 </span>
                                            </a>
                                        </li>
                                        <li class="divider"> </li>
                                        <li>
                                            @if(Auth::check())
                                                <a href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                                                    <i class="icon-key"></i> @lang('general.logout')
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                </form>
                                            @else
                                                <a href="#">
                                                    <i class="icon-key"></i> @lang('general.login')</a>
                                            @endif
                              
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>

                {{-- <form class="search-form" action="page_general_search.html" method="GET">

                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                    <span class="input-group-btn">
                      <a href="javascript:;" class="btn submit">
                        <i class="icon-magnifier"></i>
                      </a>
                    </span>
                  </div>
                </form> --}}
            </div>
        </div>
    </div>
</div>