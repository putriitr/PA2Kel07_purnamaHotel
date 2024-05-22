@extends('admin.master')

@section('title', 'Rooms')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('room.create') }}" class="btn btn-success mb-3">Create Room</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Capacity</th>
                    <th>Facility</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                    <tr>
                        <td>{{ $room->name }}</td>
                        <td>{{ $room->category->name ?? 'No Category' }}</td>
                        <td>
                            <img src="{{ asset('images/rooms/' . $room->image) }}" alt="Room Image" width="100">
                        </td>
                        <td>{{ $room->price }}</td>
                        <td>{{ $room->capacity }}</td>
                        <td>{{ $room->facility }}</td>
                        <td>
                            <a href="{{ route('room.edit', $room->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('room.destroy', $room->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
