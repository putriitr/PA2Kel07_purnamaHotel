@extends('admin.master')

@section('title', 'Kategori Pengumuman')

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
        <a href="{{ route('announcementcategory.create') }}" class="btn btn-success mb-3" title="Add New Announcement Category">
            <i class="fa fa-plus" aria-hidden="true"></i> Add New
        </a>
        <table class="table table-bordered" id="myTable">
            <thead>
                <tr>
                    <th style="width:25%">Nama</th>
                    <th style="width:60%">Deskripsi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($announcementcategories as $key => $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{!! Illuminate\Support\Str::limit(strip_tags($item->description), 30) !!}</td>
                        <td>
                            <form action="{{ route('announcementcategory.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <a href="{{ route('announcementcategory.edit', $item->id) }}" class="btn btn-success">Edit</a>
                                <button class="btn btn-danger" onclick="deleteConfirmation(event)">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Data Tidak Ada</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <a href="{{ route('announcementcategory.index') }}" class="btn btn-success mb-3" title="Back">
            <i class="fa fa-plus" aria-hidden="true"></i> Kembali
        </a>
    </div>
@endsection
