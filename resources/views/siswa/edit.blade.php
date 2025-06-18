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
            <form action="{{ url('siswa/edit') }}" method="post">
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
                                    <label>NAMA SISWA</label>
                                    <input type="text" class="form-control" name="namasiswa" id="namasiswa"
                                        autocomplete="off" value="{{ $row->namasiswa }}" required>
                                    <input type="hidden" name="id" value="{{ $row->id }}">
                                </div>
                                <div class="form-group">
                                    <label>NISN</label>
                                    <input type="text" class="form-control" name="nisn" id="nisn"
                                        autocomplete="off" value="{{ $row->nisn }}" required>
                                </div>
                                <div class="form-group">
                                    <label>JENIS KELAMIN</label>
                                    <input type="text" class="form-control" name="jeniskelamin" id="jeniskelamin"
                                        autocomplete="off" value="{{ $row->jeniskelamin }}" required>
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
