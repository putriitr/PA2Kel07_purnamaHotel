@extends('admin.master')

@section('title')
    Staff Hotel
@endsection

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{route('staff.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <label>Nama</label></br>
                <input type="text" name="name" id="name" class="form-control"></br>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label>Role</label></br>
                <input type="text" name="role" id="role" class="form-control"></br>
                @error('role')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="last_education">Pendidikan Terakhir</label>
                <input type="text" name="last_education" id="last_education" class="form-control"></br>
                @error('last_education')
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
