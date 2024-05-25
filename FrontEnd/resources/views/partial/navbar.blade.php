<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
    <a href="" class="navbar-brand p-0 d-flex align-items-center">
        <img src="{{ asset('/web/img/logo1.png') }}" alt="Purnama Balige"
            style="width: 60px; height: 60px; margin-right: 10px;">
        <div>
            <h4 class="text-primary m-0">Purnama Balige</h4>
            <small>Hotel & Restaurant</small>
        </div>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0 pe-4">
            <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('facility') }}" class="nav-item nav-link {{ request()->routeIs('facility') ? 'active' : '' }}">Facility</a>
            <a href="{{ route('gallery') }}" class="nav-item nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}">Gallery</a>
            <a href="{{ route('announcement') }}" class="nav-item nav-link {{ request()->routeIs('announcement') ? 'active' : '' }}">Announcement</a>
            <a href="{{ route('room') }}" class="nav-item nav-link {{ request()->routeIs('room') ? 'active' : '' }}">Room n Suite</a>
            <a href="/contact" class="nav-item nav-link {{ request()->is('contact') ? 'active' : '' }}">Contact</a>
        </div>

        @if (Auth::guard('customers')->check())
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="{{ route('customer.logout') }}">Logout</a></li>
                </ul>
            </div>
        @else
            <a href="{{ route('customer.login') }}" class="btn btn-primary py-2 px-4">Login</a>
        @endif
    </div>


</nav>
