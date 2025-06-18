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
                    <a href="{{ url('nilai/add') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Data
                    </a>
                </div>
                <div class="col-md-6">
                    <div class="form-group float-right">
                        <input type="text" id="searchInput" class="form-control"
                            placeholder="Cari nama siswa atau NISN..." style="width: 250px;">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="nilaiTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th rowspan="2" width="20px">No</th>
                        <th rowspan="2">NAMA SISWA</th>
                        <th rowspan="2">NISN</th>
                        @for ($i = 1; $i <= 5; $i++)
                            <th colspan="2" class="text-center">SEMESTER {{ $i }}</th>
                        @endfor
                        <th rowspan="2">Aksi</th>
                    </tr>
                    <tr>
                        @for ($i = 1; $i <= 5; $i++)
                            <th>Pengetahuan</th>
                            <th>Keterampilan</th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $index => $row)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $row['nama'] }}</td>
                            <td>{{ $row['nisn'] }}</td>

                            @for ($sem = 1; $sem <= 5; $sem++)
                                <td
                                    class="{{ is_numeric($row['semester'][$sem]['pengetahuan']['rata']) ? 'text-primary font-weight-bold' : '' }}">
                                    {{ $row['semester'][$sem]['pengetahuan']['rata'] }}
                                </td>
                                <td
                                    class="{{ is_numeric($row['semester'][$sem]['keterampilan']['rata']) ? 'text-success font-weight-bold' : '' }}">
                                    {{ $row['semester'][$sem]['keterampilan']['rata'] }}
                                </td>
                            @endfor
                            <td class="text-center">
                                <a href="{{ url('nilai/edit/' . $row['nisn']) }}" class="btn btn-xs btn-warning"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ 3 + 5 * 2 + 1 }}" class="text-center">Tidak ada data siswa</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Initialize search functionality
            $('#searchInput').keyup(function() {
                var searchText = $(this).val().toLowerCase();

                $('#nilaiTable tbody tr').each(function() {
                    var namaSiswa = $(this).find('td:eq(1)').text().toLowerCase();
                    var nisn = $(this).find('td:eq(2)').text().toLowerCase();

                    if (namaSiswa.includes(searchText) || nisn.includes(searchText)) {
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

            @if (session('add_sukses'))
                add_sukses();
            @endif

            @if (session('edit_sukses'))
                edit_sukses();
            @endif

            @if (session('delete_sukses'))
                delete_sukses();
            @endif
        });
    </script>
@endsection
