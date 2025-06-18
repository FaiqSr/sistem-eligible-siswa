@extends('layout.main')

@section('title', 'Surat Keputusan')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Pembuatan Surat Keputusan</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('surat.generate') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nomor_surat">Nomor Surat</label>
                    <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" required>
                </div>
                <div class="form-group">
                    <label for="nama_kepala">Nama Kepala Sekolah</label>
                    <input type="text" class="form-control" id="nama_kepala" name="nama_kepala" required>
                </div>
                <div class="form-group">
                    <label for="jurusan_id">Jurusan</label>
                    <select class="form-control" id="jurusan_id" name="jurusan_id" required>
                        <option value="">Pilih Jurusan</option>
                        @foreach ($jurusan as $j)
                            <option value="{{ $j->id }}">{{ $j->rombongan }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-file-pdf"></i> Generate PDF
                </button>
            </form>
        </div>
    </div>
@endsection
