@extends('admin.master')

@section('title', 'Edit Gallery Category')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('gallerycategory.update', $gallerycategory->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <label for="name">Nama</label><br>
                <input type="text" name="name" id="name" value="{{ old('name', $gallerycategory->name) }}" class="form-control"><br>
                @error('name')
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
