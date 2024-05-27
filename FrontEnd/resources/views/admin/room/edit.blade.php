@extends('admin.master')

@section('title', 'Edit Room')

@section('content')
    <div class="container">
        <form action="{{ route('room.update', $room->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $room->name }}">
            </div>
            <div class="mb-3">
                <label for="room_category_id" class="form-label">Category</label>
                <select name="room_category_id" class="form-control" id="room_category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $room->room_category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" class="form-control" id="image">
                <img src="{{ asset('images/rooms/' . $room->image) }}" alt="Room Image" width="100">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" class="form-control" id="price" value="{{ $room->price }}">
            </div>
            <div class="mb-3">
                <label for="room_number" class="form-label">Room number</label>
                <input name="room_number" class="form-control" id="room_number" value="{{ $room->room_number }}">
            </div>
            <div class="mb-3">
                <label for="capacity" class="form-label">Capacity</label>
                <input type="number" name="capacity" class="form-control" id="capacity" value="{{ $room->capacity }}">
            </div>
            <div class="mb-3">
                <label for="facility" class="form-label">Facility</label>
                <textarea name="facility" class="form-control" id="facility">{{ $room->facility }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
