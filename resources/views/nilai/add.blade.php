@extends('layout.main')

@section('title', 'siswa')

@section('breadcrums')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Tambah Data</h1>
        </div>
        <div class="col-sm-6">
        </div>
    </div>
@endsection

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="row">
        <div class="col">
            <form action="{{ url('nilai/add') }}" method="post">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <div class="ml-auto">
                                    <a href="{{ url('siswa/index') }}" class="btn btn-default">
                                        <i class="fas fa fa-reply"></i> Kembali </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>NISN</label>
                                    <select name="nisn" id="nisn" class="form-control">
                                        <option value="" selected>Pilih NISN</option>
                                        @foreach ($nisn as $siswa)
                                            <option value="{{ $siswa->nisn }}">{{ $siswa->nisn }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>JURUSAN</label>
                                    <select name="jurusan" id="jurusan" class="form-control" required>
                                        <option value="">-- Pilih Jurusan --</option>
                                        <option value="IPA">IPA</option>
                                        <option value="IPS">IPS</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>SEMESTER</label>
                                    <select name="semester" id="semester" class="form-control">
                                        <option value="">-- Pilih Semester --</option>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}">Semester {{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Mata Pelajaran</label>
                                    <select name="id_mapel" id="id_mapel" class="form-control">
                                        <option value="">-- Pilih Mapel --</option>
                                        @foreach ($data as $item)
                                            <option value="{{ $item->id }}" data-semester="{{ $item->semester }}"
                                                data-jurusan="{{ $item->rombongan->rombongan }}">
                                                {{ $item->nama_mapel }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>NILAI KETERAMPILAN</label>
                                    <input type="text" class="form-control" name="nilai_keterampilan"
                                        id="nilai_keterampilan" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label>NILAI PENGETAHUAN</label>
                                    <input type="text" class="form-control" name="nilai_pengetahuan"
                                        id="nilai_pengetahuan" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('script')

    <script>
        function filterMapel() {
            var selectedSemester = $('#semester').val();
            var selectedJurusan = $('#jurusan').val();

            $('#id_mapel option').each(function() {
                var optionSemester = $(this).data('semester');
                var optionJurusan = $(this).data('jurusan');

                // Tampilkan hanya jika semester dan jurusan cocok
                if (
                    (!selectedSemester || optionSemester == selectedSemester) &&
                    (!selectedJurusan || optionJurusan == selectedJurusan)
                ) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            // Reset dropdown setelah filter
            $('#id_mapel').val('');
        }

        $(document).ready(function() {
            $('#semester, #jurusan').on('change', filterMapel);

            // Trigger saat halaman load
            filterMapel();
        });
    </script>
@endsection
