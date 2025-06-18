{{-- @dd($siswa[0]->nisn, $row) --}}
@extends('layout.main')

@section('title', 'Siswa')

@section('breadcrums')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Edit Siswa</h1>
        </div>
        <div class="col-sm-6">
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <form action="{{ url('prestasi/edit/' . $row->id) }}" method="POST">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <div class="ml-auto">
                                    <a href="{{ url('prestasi') }}" class="btn btn-default">
                                        <i class="fas fa fa-reply"></i> Kembali </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @csrf
                        <input type="hidden" value="{{ $row->id }}" name="id">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>NISN</label>
                                    {{-- <input type="text" class="form-control" name="nisn" id="nisn"
                                        autocomplete="off" required> --}}
                                    <select name="nisn" id="nisn" class="form-control">
                                        @foreach ($siswa as $sis)
                                            <option value="{{ $sis->nisn }}"
                                                {{ $row->nisn_siswa == $sis->nisn ? 'selected' : '' }}>{{ $sis->nisn }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>NAMA PRESTASI</label>
                                    <input type="text" class="form-control" name="namaPrestasi" id="namaPrestasi"
                                        value="{{ $row->nama_prestasi }}" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label>JENIS</label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="internasional"
                                            {{ $row->international == 'international' ? 'selected' : '' }}>Internasional
                                        </option>
                                        <option value="nasional" {{ $row->international == 'nasional' ? 'selected' : '' }}>
                                            Nasional</option>
                                        <option value="provinsi" {{ $row->international == 'provinsi' ? 'selected' : '' }}>
                                            Provinsi</option>
                                        <option value="kabupaten"
                                            {{ $row->international == 'kabupaten' ? 'selected' : '' }}>Kabupaten</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal" id="tanggal"
                                        value="{{ $row->tanggal }}" autocomplete="off" required>
                                    </input>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
