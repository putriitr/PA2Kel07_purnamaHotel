@extends('admin.master')

@section('title')
    Announcement Category
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('roomcategory.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label>Nama Kategori</label>
            <input type="text" name="name" id="name" class="form-control">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label>Deskripsi Kategori</label>
            <textarea name="description" id="editor" class="form-control" cols="30" rows="10"></textarea>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <input type="submit" value="Save" class="btn btn-success mt-3">
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
