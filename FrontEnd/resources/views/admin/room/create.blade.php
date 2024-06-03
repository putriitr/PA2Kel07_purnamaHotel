@extends('admin.master')

@section('title', 'Create Room')

@section('content')
    <div class="container">
        <form action="{{ route('room.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="room_category_id">Category</label>
                <select name="room_category_id" id="room_category_id" class="form-control" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('room_category_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" class="form-control" id="image">
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" class="form-control" id="price" value="{{ old('price') }}">
                @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="capacity" class="form-label">Capacity</label>
                <input type="number" name="capacity" class="form-control" id="capacity" value="{{ old('capacity') }}">
                @error('capacity')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="room_number" class="form-label">Room number</label>
                <input type="string" name="room_number" class="form-control" id="room_number" value="{{ old('room_number') }}">
                @error('room_number')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="size" class="form-label">Size</label>
                <input type="number" name="size" class="form-control" id="size" value="{{ old('size') }}">
                @error('size')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="facility" class="form-label">Facility</label>
                <textarea name="facility" class="form-control" id="facility">{{ old('facility') }}</textarea>
                @error('facility')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Create</button>
        </form>
    </div>
@endsection