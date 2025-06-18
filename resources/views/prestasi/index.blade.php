@extends('layout.main')

@section('title', 'siswa')

@section('breadcrums')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>siswa</h1>
        </div>
        <div class="col-sm-6">
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ url('prestasi/add') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Data
                    </a>
                </div>
                <div class="col-md-6">
                    <div class="form-group float-right">
                        <label for="filter-jurusan" class="mr-2">Filter Jurusan:</label>
                        <select id="filter-jurusan" class="form-control form-control-sm" style="width: 150px;">
                            <option value="">Semua Jurusan</option>
                            <option value="IPA">IPA</option>
                            <option value="IPS">IPS</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="table1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="20px">No</th>
                        <th>NAMA SISWA</th>
                        <th>NISN</th>
                        <th>TYPE</th>
                        <th>NAMA PRESTASI</th>
                        <th>TANGGAL</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr data-jurusan="{{ $item->siswa->rombongan->rombongan }}">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->siswa->namasiswa }}</td>
                            <td>{{ $item->siswa->nisn }}</td>
                            <td>{{ $item->type }}</td>
                            <td>{{ $item->nama_prestasi }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td class="text-center">
                                <a href="{{ url('prestasi/edit/' . $item->id) }}" class="btn btn-xs btn-warning"
                                    title="Edit"><i class="fas fa-edit"></i> </a>
                                <button onclick="del({{ $item->id }})" class="btn btn-xs btn-danger" title="Hapus"><i
                                        class="fas fa-trash"></i> </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Initialize DataTable if you're using it
            $('#table1').DataTable();

            // Jurusan filter functionality
            $('#filter-jurusan').change(function() {
                var selectedJurusan = $(this).val();

                $('#table1 tbody tr').each(function() {
                    var rowJurusan = $(this).data('jurusan');

                    if (selectedJurusan === '' || rowJurusan === selectedJurusan) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            function add_sukses() {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000
                });

                Toast.fire({
                    icon: 'success',
                    title: ' &nbsp; Tambah Data Berhasil'
                });
            }

            function edit_sukses() {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000
                });

                Toast.fire({
                    icon: 'success',
                    title: ' &nbsp; Update Data Berhasil'
                });
            }

            function delete_sukses() {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000
                });

                Toast.fire({
                    icon: 'success',
                    title: ' &nbsp; Hapus Data Berhasil'
                });
            }

            window.del = function(id) {
                Swal.fire({
                    title: "Ingin Menghapus Data ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ url('siswa/siswa/delete') }}/" + id;
                    }
                });
            }
        });

        @if (session('add_sukses'))
            add_sukses();
        @endif

        @if (session('edit_sukses'))
            edit_sukses();
        @endif

        @if (session('delete_sukses'))
            delete_sukses();
        @endif
    </script>
@endsection
