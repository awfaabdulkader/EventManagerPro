@extends('layouts.headerapp')


@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Notifications</h2>

    @if($notifications->isEmpty())
        <p class="text-gray-600">No notifications available.</p>
    @else
        @foreach($notifications as $notification)
            <div class="p-4 mb-4 text-sm bg-gray-200 rounded-lg">
                {{ $notification->data['message'] }}
                
            </div>
        @endforeach

        <button id="markAllRead" class="px-4 py-2 bg-green-500 text-white rounded">Mark All as Read</button>
    @endif
</div>

<script>
    document.getElementById('markAllRead')?.addEventListener('click', function() {
        fetch("{{ route('notifications.markAsRead') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
        }).then(response => response.json()).then(data => {
            location.reload();
        });
    });
</script>
@endsection
