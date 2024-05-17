@extends('admin.master')

@section('title')
    Gallery
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('staff.update', $staffs->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <label>Nama</label><br>
                <input type="text" name="name" id="name" value="{{ $staffs->name }}" class="form-control"><br>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label>Role</label><br>
                <input type="text" name="role" id="role" value="{{ $staffs->role }}" class="form-control"><br>
                @error('role')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="last_education">Pendidikan Terakhir</label>
                <input type="text" name="last_education" id="last_education" value="{{ $staffs->last_education }}" class="form-control"><br>
                @error('last_education')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <br>
                <label>Photo</label><br>
                <input class="form-control" name="image" type="file" id="image"><br>
                <a href="{{ asset('images/staff/' . $staffs->image) }}" class="btn btn-info btn-sm" target="_blank">Lihat Gambar</a>
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <br>
                <input type="submit" value="Save" class="btn btn-success my-3"><br>
            </form>
        </div>
    </div>
@endsection
