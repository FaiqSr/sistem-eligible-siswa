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
    <div class="row">
        <div class="col-md-6">
            <form action="{{ url('prestasi/add') }}" method="post">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <div class="ml-auto">
                                    <a href="{{ url('prestasi/') }}" class="btn btn-default">
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
                                        <option value="">Pilih NISN</option>
                                        @foreach ($nisn as $item)
                                            <option value="{{ $item->nisn }}">{{ $item->nisn }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>NAMA PRESTASI</label>
                                    <input type="text" class="form-control" name="namaPrestasi" id="namaPrestasi"
                                        autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label>JENIS</label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="internasional">Internasional</option>
                                        <option value="nasional">Nasional</option>
                                        <option value="provinsi">Provinsi</option>
                                        <option value="kabupaten">Kabupaten</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal" id="tanggal"
                                        autocomplete="off" required>
                                    </input>
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
