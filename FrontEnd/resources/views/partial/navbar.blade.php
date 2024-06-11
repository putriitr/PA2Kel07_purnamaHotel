<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
    <a href="#" class="navbar-brand p-0 d-flex align-items-center">
        <img src="{{ asset('/web/img/logo1.png') }}" alt="Purnama Balige" style="width: 60px; height: 60px; margin-right: 10px;">
        <div>
            <h4 class="text-primary m-0">Purnama Balige</h4>
            <small>Hotel & Restaurant</small>
        </div>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ms-auto py-0 pe-4">
            <li class="nav-item"><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
            <li class="nav-item"><a href="{{ route('facility') }}" class="nav-link {{ request()->routeIs('facility') ? 'active' : '' }}">Facility</a></li>
            <li class="nav-item"><a href="{{ route('gallery') }}" class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}">Gallery</a></li>
            <li class="nav-item"><a href="{{ route('announcement') }}" class="nav-link {{ request()->routeIs('announcement') ? 'active' : '' }}">Announcement</a></li>
            <li class="nav-item"><a href="{{ route('room') }}" class="nav-link {{ request()->routeIs('room') ? 'active' : '' }}">Room n Suite</a></li>
            <li class="nav-item"><a href="{{ route('staff') }}" class="nav-link {{ request()->routeIs('staff') ? 'active' : '' }}">Our Team</a></li>
            <li class="nav-item"><a href="/contact" class="nav-link {{ request()->is('contact') ? 'active' : '' }}">Contact Us</a></li>

            @if (Auth::guard('customers')->check())
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">{{ Auth::guard('customers')->user()->unreadNotifications->count() }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">
                            {{ Auth::guard('customers')->user()->unreadNotifications->count() }} Notifications</span>
                        <div class="dropdown-divider"></div>
                        @forelse (Auth::guard('customers')->user()->unreadNotifications as $item)
                            <a href="/announcement" class="dropdown-item bg-lg">
                                <i class="fa fa-check mr-2" aria-hidden="true"></i> Pengumuman {{ $item->data['nama'] }}
                                <span class="float-end text-muted text-sm" style="word-wrap: break-word"> &nbsp;
                                    @if ($item->created_at->diffInSeconds() < 60)
                                        {{ $item->created_at->diffInSeconds() }} detik
                                    @elseif ($item->created_at->diffInMinutes() < 60)
                                        {{ $item->created_at->diffInMinutes() }} menit
                                    @elseif ($item->created_at->diffInHours() < 24)
                                        {{ $item->created_at->diffInHours()}} jam
                                    @else
                                    {{ $item->created_at->diffInDays() }} hari
                                    @endif
                                </span>
                            </a>
                            <a href="{{ route('markasread', $item->id) }}" class="float-right text-muted text-sm">Tandai Sudah Dibaca</a>
                            <div class="dropdown-divider"></div>
                        @empty
                            <a href="#" class="dropdown-item">
                                <i class="fa fa-check mr-2" aria-hidden="true"></i> Tidak Ada Notifikasi
                            </a>
                            <div class="dropdown-divider"></div>
                        @endforelse
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('customer.logout') }}">Logout</a></li>
                    </ul>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link {{ request()->is('login') ? 'active' : '' }} ">Login</a>
                </li>
            @endif
        </ul>
    </div>
</nav>
