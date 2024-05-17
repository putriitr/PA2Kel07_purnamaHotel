@extends('admin.master')

@section('title')
    Fasilitas
@endsection

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{route('facility.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <label>Nama</label></br>
                <input type="text" name="name" id="name" class="form-control"></br>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="description">Deskripsi</label>
                <input type="text" name="description" id="description" class="form-control"></br>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label>Harga Sewa</label></br>
                <input type="text" name="rent_price" id="rent_price" class="form-control"></br>
                @error('rent_price')
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
