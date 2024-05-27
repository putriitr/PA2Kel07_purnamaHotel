@section('content')
<div class="container">
    <h1>Notifications</h1>
    @if($notifications->isEmpty())
        <p>No new notifications.</p>
    @else
        <ul class="list-group">
            @foreach ($notifications as $notification)
                <li class="list-group-item">
                    {{ $notification->data['message'] }}
                    <a href="{{ route('markNotificationAsRead', $notification->id) }}" class="btn btn-sm btn-primary float-end">Mark as read</a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
