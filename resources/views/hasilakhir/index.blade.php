@extends('layout.main')

@section('title', 'Siswa Eligible')

@section('breadcrums')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Siswa Eligible</h1>
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
                    <h3 class="card-title">Hanya siswa yang terpilih menjadi eligible</h3>
                </div>
                <div class="col-md-6 text-right">
                    <div class="form-inline float-right">
                        <div class="form-group mr-2">
                            <label for="filter-jurusan" class="mr-2">Filter Jurusan:</label>
                            <select id="filter-jurusan" class="form-control form-control-sm">
                                <option value="">Semua Jurusan</option>
                                @foreach ($jurusan as $j)
                                    <option value="{{ $j->id }}">{{ $j->rombongan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <a href="{{ route('hasilakhir.pdf', ['jurusan_id' => request('jurusan_id')]) }}"
                            class="btn btn-primary btn-sm">
                            <i class="fas fa-download"></i> Download PDF
                        </a>

                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="table-eligible" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="20px">No</th>
                        <th>Nama Siswa</th>
                        <th>NISN</th>
                        <th>Jurusan</th>
                        <th>Total Nilai Pengetahuan</th>
                        <th>Total Nilai Keterampilan</th>
                        <th>Total Nilai Prestasi</th>
                        <th>Total Keseluruhan</th>
                        <th>Peringkat</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($eligibleSiswa as $siswa)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $siswa->namasiswa }}</td>
                            <td>{{ $siswa->nisn }}</td>
                            <td>{{ $siswa->rombongan->rombongan }}</td>
                            <td>{{ $siswa->total_pengetahuan }}</td>
                            <td>{{ $siswa->total_keterampilan }}</td>
                            <td>{{ $siswa->jumlah_prestasi * 10 }} ({{ $siswa->jumlah_prestasi }} prestasi)</td>
                            <td>{{ $siswa->total_keseluruhan }}</td>
                            <td>{{ $siswa->peringkat }}</td>
                            <td class="text-center">
                                <a href="{{ route('hasilakhir.detail.pdf', $siswa->id) }}" class="btn btn-xs btn-info"
                                    title="Download PDF">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
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
            var table = $('#table-eligible').DataTable({
                "order": [
                    [7, "desc"]
                ], // Default sort by Total Keseluruhan descending
                "columnDefs": [{
                        "orderable": false,
                        "targets": [0, 9]
                    } // Disable sorting for No and Aksi columns
                ]
            });

            // Jurusan filter functionality
            $('#filter-jurusan').change(function() {
                var selectedJurusan = $(this).val();

                if (selectedJurusan === '') {
                    table.columns(3).search('').draw();
                } else {
                    // Get jurusan name from option text
                    var jurusanName = $(this).find('option:selected').text();
                    table.columns(3).search(jurusanName).draw();
                }
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
