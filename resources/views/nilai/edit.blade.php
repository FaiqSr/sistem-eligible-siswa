@extends('layout.main')

@section('title', 'Edit Nilai Siswa')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Edit Nilai - {{ $siswa->namasiswa }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('nilai.update', ['siswa_id' => $siswa->nisn, 'mapel_id' => $mapel->id]) }}"
                    method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Mata Pelajaran</label>
                        <input type="text" class="form-control" value="{{ $mapel->nama_mapel }}" readonly>
                    </div>

                    <div class="form-group">
                        <label>Semester</label>
                        <input type="text" class="form-control" value="{{ $mapel->semester }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="nilai_pengetahuan">Nilai Pengetahuan</label>
                        <input type="number" class="form-control" id="nilai_pengetahuan" name="nilai_pengetahuan"
                            value="{{ $nilai->nilai_pengetahuan ?? '' }}" min="0" max="100" required>
                    </div>

                    <div class="form-group">
                        <label for="nilai_keterampilan">Nilai Keterampilan</label>
                        <input type="number" class="form-control" id="nilai_keterampilan" name="nilai_keterampilan"
                            value="{{ $nilai->nilai_keterampilan ?? '' }}" min="0" max="100" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('siswa.show', $siswa->nisn) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
