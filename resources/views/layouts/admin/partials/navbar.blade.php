<nav class="navbar navbar-default">
    <div class="container-fluid">

        <div class="navbar-minimize">
            <button id="minimizeSidebar" class="btn btn-primary btn-fill btn-icon">
                <i class="ti-more-alt"></i>
            </button>
        </div>

        <div class="navbar-header">
            <button type="button" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar bar1"></span>
                <span class="icon-bar bar2"></span>
                <span class="icon-bar bar3"></span>
            </button>
            <a class="navbar-brand" href="#">{{$title}}</a>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a class="btn btn-primary btn-wd" href="{{ url('/admin/logout') }}">
                        <span class="btn-label">
                            <i class="ti-lock"></i>
                        </span>
                        Logout
                    </a>
                </li>
            </ul>
        </div>

    </div>
</nav>