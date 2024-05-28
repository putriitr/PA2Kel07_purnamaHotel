<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
</nav>

<!-- Notifications Dropdown Menu -->
<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">
            {{ Auth::guard('admin')->user()->unreadNotifications->count() }}
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu dropdown-menu-right">
        <span class="dropdown-item dropdown-header">
            {{ Auth::guard('admin')->user()->unreadNotifications->count() }} Notifikasi
        </span>
        <div class="dropdown-divider"></div>
        @forelse (Auth::guard('admin')->user()->unreadNotifications as $item)
            @if ($item->type === 'App\Notifications\OffersNotification')
                <div class="notification-item">
                    <a href="#" class="dropdown-item bg-lg">
                        <i class="fa fa-check mr-2" aria-hidden="true"></i> {{ $item->data['name'] ?? 'Unknown' }}
                        Melakukan Pendaftaran
                        <span class="float-end text-muted text-sm" style="word-wrap: break-word">
                            @if ($item->created_at->diffInSeconds() < 60)
                                {{ $item->created_at->diffInSeconds() }} detik
                            @elseif ($item->created_at->diffInMinutes() < 60)
                                {{ $item->created_at->diffInMinutes() }} menit
                            @elseif ($item->created_at->diffInHours() < 24)
                                {{ $item->created_at->diffInHours() }} jam
                            @else
                                {{ $item->created_at->diffInDays() }} hari
                            @endif
                        </span>
                    </a>
                    <a href="{{ route('mark', $item->id) }}" class="float-right text-muted text-sm">Tandai Sudah
                        Dibaca</a>
                </div>
                <div class="dropdown-divider"></div>
            @elseif ($item->type === 'App\Notifications\PaymentNotification')
                <div class="notification-item">
                    <a href="/admin/admin/payments" class="dropdown-item bg-lg">
                        <i class="fa fa-check mr-2" aria-hidden="true"></i> {{ $item->data['name'] ?? 'Customer' }}
                        Melakukan Pembayaran
                        <span class="float-end text-muted text-sm" style="word-wrap: break-word">
                            @if ($item->created_at->diffInSeconds() < 60)
                                {{ $item->created_at->diffInSeconds() }} detik
                            @elseif ($item->created_at->diffInMinutes() < 60)
                                {{ $item->created_at->diffInMinutes() }} menit
                            @elseif ($item->created_at->diffInHours() < 24)
                                {{ $item->created_at->diffInHours() }} jam
                            @else
                                {{ $item->created_at->diffInDays() }} hari
                            @endif
                        </span>
                    </a>
                    <a href="{{ route('markasread', $item->id) }}" class="float-right text-muted text-sm">Tandai Sudah
                        Dibaca</a>
                </div>
                <div class="dropdown-divider"></div>
            @endif
        @empty
            <div class="notification-item">
                <a href="#" class="dropdown-item">
                    <i class="fa fa-check mr-2" aria-hidden="true"></i> Tidak Ada Notifikasi
                </a>
            </div>
            <div class="dropdown-divider"></div>
        @endforelse
    </div>
</li>
