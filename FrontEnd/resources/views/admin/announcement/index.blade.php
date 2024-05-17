@extends('admin.master')

@section('title', 'Announcements')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('announcement.create') }}" class="btn btn-success mb-3">Create Announcement</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($announcements as $announcement)
                    <tr>
                        <td>{{ $announcement->title }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($announcement->content, 50) }}</td>
                        <td>{{ $announcement->category->name }}</td>
                        <td>
                            <img src="{{ asset('images/announcement/' . $announcement->image) }}" alt="Image" width="100">
                        </td>
                        <td>
                            <a href="{{ route('announcement.edit', $announcement->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('announcement.destroy', $announcement->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
