<nav class="px-0 mx-4 mt-4 shadow-none navbar navbar-main navbar-expand-lg position-sticky top-1 border-radius-xl z-index-sticky"
    id="navbarBlur" data-scroll="true">
    <div class="px-3 py-1 container-fluid">
        @yield('breadcrumb')
        <div class="mt-0 mt-sm-0 me-md-0 me-sm-4" id="navbar">
            <ul class="navbar-nav justify-content-end">
                <li class="px-2 nav-item d-flex align-items-center">
                    <a href="{{ route('user.edit',Auth::user()->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-sm bg-gradient-info">
                            {{Auth::user()->roles[0]->name}}
                        </button>
                    </a>
                </li>
                <li class="nav-item d-flex align-items-center" title="Log out">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm bg-gradient-danger" 
                        >
                            <i class="fa-solid fa-sign-out"></i>
                        </button>
                    </form>
                </li>`
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="p-0 nav-link text-body" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
