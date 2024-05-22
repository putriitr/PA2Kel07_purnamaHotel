@extends('admin.master')

@section('title')
    Galery
@endsection

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{route('gallery.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <label>Nama</label></br>
                <input type="text" name="name" id="name" class="form-control"></br>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <label for="description">Deskripsi</label>
                <input type="text" name="description" id="description" class="form-control"></br>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <input class="form-control" name="image" type="file" id="image">
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <br>
                <input type="submit" value="Save" class="btn btn-success"></br>
            </form>

        </div>
    </div>
@endsection
