@extends('admin.master')

@section('title')
    Staff
@endsection

@push('css')
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css" rel="stylesheet" />
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });

        function deleteConfirmation(event) {
            event.preventDefault();
            const form = event.target.form;

            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
@endpush

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <a href="{{ route('staff.create') }}" class="btn btn-success mb-3" title="Add New Facility">
            <i class="fa fa-plus" aria-hidden="true"></i> Add New
        </a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Pendidikan Terakhir</th>
                    <th>Photo</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($staffs as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->role }}</td>
                    <td>{{ $item->last_education }}</td>
                    <td><img src="{{ asset('images/staff/'.$item->image) }}" alt="{{ $item->name }}" height="100px"></td>
                    <td>
                        <form action="{{ route('staff.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <a href="{{ route('staff.edit', $item->id) }}" class="btn btn-success">Edit</a>
                            <button class="btn btn-danger btn-delete">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('staff.index') }}" class="btn btn-success mb-3" title="Back">
            <i aria-hidden="true"></i> Back
        </a>
    </div>
@endsection
