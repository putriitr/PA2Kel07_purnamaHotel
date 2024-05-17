@extends('admin.master')

@section('title', 'Edit Announcement Category')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('announcementcategory.update', $announcementcategory->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <label for="name">Judul</label><br>
                <input type="text" name="name" id="name" value="{{ old('name', $announcementcategory->name) }}" class="form-control"><br>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label for="description">Isi</label><br>
                <textarea name="description" id="editor" class="form-control" cols="30" rows="10">{{ old('description', $announcementcategory->description) }}</textarea><br>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn btn-success my-3">Save</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
