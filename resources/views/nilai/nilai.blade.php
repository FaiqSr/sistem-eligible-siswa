@extends('layout.main')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3>Daftar Nilai per Semester - {{ $siswa->namasiswa }} (NISN: {{ $siswa->nisn }})</h3>
                </div>
            </div>
            <div class="card-body">
                @foreach ($dataPerSemester as $semesterData)
                    <div class="mb-4">
                        <h4 class="bg-light p-2">Semester {{ $semesterData['semester'] }}</h4>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Mata Pelajaran</th>
                                    <th class="text-center">Nilai Pengetahuan</th>
                                    <th class="text-center">Nilai Keterampilan</th>
                                    <th class="text-center">Rata-rata</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($semesterData['mata_pelajaran'] as $index => $mapel)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $mapel['nama_mapel'] }}</td>
                                        <td
                                            class="text-center {{ $mapel['nilai_pengetahuan'] >= 75 ? 'text-success' : 'text-danger' }}">
                                            {{ $mapel['nilai_pengetahuan'] }}
                                        </td>
                                        <td
                                            class="text-center {{ $mapel['nilai_keterampilan'] >= 75 ? 'text-success' : 'text-danger' }}">
                                            {{ $mapel['nilai_keterampilan'] }}
                                        </td>
                                        <td class="text-center font-weight-bold">
                                            {{ $mapel['rata_rata'] }}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('nilai.edit', ['siswa_id' => $siswa->nisn, 'mapel_id' => $mapel['id']]) }}"
                                                class="btn btn-sm btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach

                @if (count($dataPerSemester) === 0)
                    <div class="alert alert-info">
                        Belum ada data nilai untuk siswa ini.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
