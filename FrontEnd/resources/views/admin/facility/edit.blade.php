@extends('admin.master')

@section('title')
    Fasilitas
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('facility.update', $facilities->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <label>Nama</label><br>
                <input type="text" name="name" id="name" value="{{ $facilities->name }}" class="form-control"><br>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="description">Deskripsi</label>
                <input type="text" name="description" id="description" value="{{ $facilities->description }}" class="form-control"><br>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label>Harga Sewa</label><br>
                <input type="text" name="rent_price" id="rent_price" value="{{ $facilities->rent_price }}" class="form-control">
                @error('rent_price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <br>
                <label>Gambar</label><br>
                <input class="form-control" name="image" type="file" id="image"><br>
                <a href="{{ asset('images/facility/' . $facilities->image) }}" class="btn btn-info btn-sm"
                    target="_blank">Lihat Gambar</a>
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <br>
                <input type="submit" value="Save" class="btn btn-success my-3"><br>
            </form>
        </div>
    </div>
@endsection
