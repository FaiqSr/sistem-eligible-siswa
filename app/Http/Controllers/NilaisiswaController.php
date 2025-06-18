<?php

namespace App\Http\Controllers;

use App\Mapel;
use App\Nilai;
use App\Prestasi;
use App\Rombongan;
use App\Siswa;
use Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class NilaisiswaController extends Controller
{
    //     public function index()
    //     {
    //         $data = DB::table('tbl_nilai')->get();

    //         return view('nilai.index', ['data' => $data]);
    //     }

    //     public function create()
    //     {
    //         return view('nilai.add');
    //     }

    //     public function add(Request $request)
    //     {
    //         DB::table('tbl_nilai')->insert([
    //             'idsiswa' => $request->idsiswa,
    //             'semester1' => $request->semester1,
    //             'semester2' => $request->semester2,
    //             'semester3' => $request->semester3,
    //             'semester4' => $request->semester4,
    //             'semester5' => $request->semester5,
    //         ]);

    //         return redirect('nilai/index')->with('add_sukses', 1);
    //     }

    //     public function edit($id)
    //     {
    //         $row = DB::table('tbl_nilai')->where('tbl_nilai.id', $id)->first();

    //         return view('nilai.edit', [
    //             'row' => $row,
    //         ]);
    //     }

    //     public function update(Request $request)
    //     {
    //         DB::table('tbl_nilai')
    //             ->where('id', $request->id)
    //             ->update([
    //                 'idsiswa' => $request->idsiswa,
    //                 'semester1' => $request->semester1,
    //                 'semester2' => $request->semester2,
    //                 'semester3' => $request->semester3,
    //                 'semester4' => $request->semester4,
    //                 'semester5' => $request->semester5,
    //             ]);

    //         return redirect('nilai/index')->with('edit_sukses', 1);
    //     }

    //     public function delete($id)
    //     {
    //         DB::table('tbl_nilai')->where('id', $id)->delete();

    //         return redirect()->back()->with('delete_sukses', 1);
    //     }

    //     public function rombonganbelajar()
    //     {
    //         $data = DB::table('tbl_rombongan')->get();

    //         return view('nilai.rombongan', ['data' => $data]);
    //     }


    public function showInputPrestasiSiswa()
    {

        $siswa = Prestasi::get();

        return view('prestasi.index', ['data' => $siswa]);
    }

    public function showNilaiSiswa()
    {
        // Ambil data siswa dengan relasi nilai dan mapel, diurutkan oleh NISN
        $siswas = Siswa::with(['nilai.mapel'])
            ->orderBy('nisn')
            ->get();

        // Format data untuk view
        $data = [];

        foreach ($siswas as $siswa) {
            $row = [
                'id' => $siswa->id,
                'nama' => $siswa->namasiswa ?? '-',
                'nisn' => $siswa->nisn ?? '-',
                'semester' => []
            ];

            // Inisialisasi array semester 1-5
            for ($sem = 1; $sem <= 5; $sem++) {
                $row['semester'][$sem] = [
                    'keterampilan' => [
                        'total' => 0,
                        'count' => 0,
                        'rata' => '-'
                    ],
                    'pengetahuan' => [
                        'total' => 0,
                        'count' => 0,
                        'rata' => '-'
                    ]
                ];
            }

            // Hitung total nilai per semester
            if ($siswa->nilai) {
                foreach ($siswa->nilai as $nilai) {
                    if ($nilai->mapel) {
                        $semester = $nilai->mapel->semester;

                        if ($semester >= 1 && $semester <= 5) {
                            // Hitung nilai keterampilan
                            if (is_numeric($nilai->nilai_keterampilan)) {
                                $row['semester'][$semester]['keterampilan']['total'] += $nilai->nilai_keterampilan;
                                $row['semester'][$semester]['keterampilan']['count']++;
                            }

                            // Hitung nilai pengetahuan
                            if (is_numeric($nilai->nilai_pengetahuan)) {
                                $row['semester'][$semester]['pengetahuan']['total'] += $nilai->nilai_pengetahuan;
                                $row['semester'][$semester]['pengetahuan']['count']++;
                            }
                        }
                    }
                }
            }

            // Hitung rata-rata per semester
            for ($sem = 1; $sem <= 5; $sem++) {
                // Rata-rata keterampilan
                if ($row['semester'][$sem]['keterampilan']['count'] > 0) {
                    $row['semester'][$sem]['keterampilan']['rata'] =
                        round($row['semester'][$sem]['keterampilan']['total'] /
                            $row['semester'][$sem]['keterampilan']['count'], 2);
                }

                // Rata-rata pengetahuan
                if ($row['semester'][$sem]['pengetahuan']['count'] > 0) {
                    $row['semester'][$sem]['pengetahuan']['rata'] =
                        round($row['semester'][$sem]['pengetahuan']['total'] /
                            $row['semester'][$sem]['pengetahuan']['count'], 2);
                }
            }

            $data[] = $row;
        }

        return view('nilai.index', compact('data'));
    }

    public function showAddNilaiSiswa()
    {
        $mataPelajaran = Mapel::get();
        $nisnSiswa = DB::table('tbl_siswa')->select('nisn')->get();

        return view('nilai.add', ['data' => $mataPelajaran, 'nisn' => $nisnSiswa]);
    }

    public function showNilaiSiswaIndividu($id)
    {
        // Ambil data siswa beserta nilai dan mata pelajaran
        $siswa = Siswa::with(['nilai' => function ($query) {
            $query->with('mapel')
                ->orderBy('id_mapel');
        }])
            ->where('nisn', $id)
            ->firstOrFail();

        // Kelompokkan data per semester
        $dataPerSemester = [];

        foreach ($siswa->nilai as $nilai) {
            $semester = $nilai->mapel->semester;

            if (!isset($dataPerSemester[$semester])) {
                $dataPerSemester[$semester] = [
                    'semester' => $semester,
                    'mata_pelajaran' => []
                ];
            }

            $dataPerSemester[$semester]['mata_pelajaran'][] = [
                'id' => $nilai->mapel->id,
                'nama_mapel' => $nilai->mapel->nama_mapel,
                'nilai_pengetahuan' => $nilai->nilai_pengetahuan,
                'nilai_keterampilan' => $nilai->nilai_keterampilan,
                'rata_rata' => round(($nilai->nilai_pengetahuan + $nilai->nilai_keterampilan) / 2, 2)
            ];
        }

        // Urutkan berdasarkan semester
        ksort($dataPerSemester);

        return view('nilai.nilai', [
            'siswa' => $siswa,
            'dataPerSemester' => $dataPerSemester
        ]);
    }

    public function edit($siswa_id, $mapel_id)
    {
        $siswa = Siswa::where('nisn', $siswa_id)->first();
        $mapel = Mapel::where('id', $mapel_id)->first();

        $nilai = Nilai::where('nisn_siswa', $siswa->nisn)
            ->where('id_mapel', $mapel_id)
            ->first();

        return view('nilai.edit', compact('siswa', 'mapel', 'nilai'));
    }
    public function update(Request $request, $siswa_id, $mapel_id)
    {
        $request->validate([
            'nilai_pengetahuan' => 'required|numeric|min:0|max:100',
            'nilai_keterampilan' => 'required|numeric|min:0|max:100'
        ]);

        $siswa = Siswa::where('nisn', $siswa_id)->first();

        Nilai::updateOrCreate(
            [
                'nisn_siswa' => $siswa->nisn,
                'id_mapel' => $mapel_id
            ],
            [
                'nilai_pengetahuan' => $request->nilai_pengetahuan,
                'nilai_keterampilan' => $request->nilai_keterampilan
            ]
        );

        return redirect()->route('siswa.show', $siswa_id)
            ->with('success', 'Nilai berhasil diperbarui');
    }

    public function addNilaiSiswa(Request $request)
    {
        $validated = $request->validate([
            'nisn' => 'required',
            'id_mapel' => 'required',
            'nilai_keterampilan' => 'required',
            'nilai_pengetahuan' => 'required',
        ]);

        $siswa = Siswa::where('nisn', $validated['nisn'])->first();

        if (!$siswa) {
            return redirect()->back()->with('Siswa tidak terdaftar', 1);
        }

        $mapel = Mapel::where('id', $validated['id_mapel'])->first();

        if (!$mapel) {
            return redirect()->back()->with('Mata pelajaran tidak terdaftar', 1);
        }

        $nilai = Nilai::where('nisn_siswa', $validated['nisn'])->where('id_mapel', $validated['id_mapel'])->first();

        if ($nilai) {
            return redirect()->back()->with('error', 'Nilai sudah ada');
        }

        Nilai::create([
            'nisn_siswa' => $validated['nisn'],
            'id_mapel' => $validated['id_mapel'],
            'nilai_keterampilan' => $validated['nilai_keterampilan'],
            'nilai_pengetahuan' => $validated['nilai_pengetahuan'],
        ]);
        return redirect('nilai')->with('add_sukses', 1);
    }

    public function showAddPrestasiSiswa()
    {
        $nisn = DB::table('tbl_siswa')->select('nisn')->get();
        return view('prestasi.add', compact('nisn'));
    }

    public function addPrestasiSiswa(Request $request)
    {
        $validated = $request->validate([
            'nisn' => 'required',
            'type' => 'required',
            'namaPrestasi' => 'required',
            'tanggal' => 'required',
        ]);


        $siswa = Siswa::where('nisn', $validated['nisn'])->first();


        if (!$siswa) {
            return redirect()->back()->with('Siswa tidak terdaftar', 1);
        }

        Prestasi::create([
            'nisn_siswa' => $validated['nisn'],
            'type' => $validated['type'],
            'nama_prestasi' => $validated['namaPrestasi'],
            'tanggal' => $validated['tanggal'],
        ]);

        return redirect('prestasi')->with('add_sukses', 1);
    }

    public function showEditPrestasiSiswa($id)
    {
        $row = Prestasi::where('id', $id)->first();
        $siswa = Siswa::get();
        return view('prestasi.edit', compact('row', 'siswa'));
    }

    public function editPrestasiSiswa(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'id' => 'required',
            'nisn' => 'required',
            'namaPrestasi' => 'required',
            'type' => 'required',
            'tanggal' => 'required'
        ]);

        $prestasi = Prestasi::where('id', $request->id)->first();
        $prestasi->update([
            'nisn_siswa' => $request->nisn,
            'nama_prestasi' => $request->namaPrestasi,
            'type' => $request->type,
            'tanggal' => $request->tanggal,
        ]);

        return redirect('prestasi')->with('success');
    }


    public function showHasilAkhir()
    {
        $jurusan = Rombongan::all();

        $eligibleSiswa = Siswa::with(['nilai', 'prestasi', 'rombongan'])
            ->select(
                'tbl_siswa.id',
                'tbl_siswa.namasiswa',
                'tbl_siswa.nisn',
                'tbl_siswa.jurusan',
                DB::raw('COALESCE(SUM(tbl_nilai.nilai_pengetahuan), 0) as total_pengetahuan'),
                DB::raw('COALESCE(SUM(tbl_nilai.nilai_keterampilan), 0) as total_keterampilan'),
                DB::raw('COUNT(tbl_prestasi_siswa.id) as jumlah_prestasi'),
                DB::raw('COALESCE(SUM(tbl_nilai.nilai_pengetahuan), 0) + 
                       COALESCE(SUM(tbl_nilai.nilai_keterampilan), 0) + 
                       (COUNT(tbl_prestasi_siswa.id) * 10) as total_keseluruhan')
            )
            ->leftJoin('tbl_nilai', 'tbl_siswa.nisn', '=', 'tbl_nilai.nisn_siswa')
            ->leftJoin('tbl_prestasi_siswa', 'tbl_siswa.nisn', '=', 'tbl_prestasi_siswa.nisn_siswa')
            ->groupBy('tbl_siswa.id', 'tbl_siswa.namasiswa', 'tbl_siswa.nisn', 'tbl_siswa.jurusan')
            ->havingRaw('(COALESCE(SUM(tbl_nilai.nilai_pengetahuan), 0) + 
                        COALESCE(SUM(tbl_nilai.nilai_keterampilan), 0)) / 
                        GREATEST(COUNT(DISTINCT tbl_nilai.id_mapel) * 2, 1) > 70')
            ->orderByDesc('total_keseluruhan')
            ->get()
            ->map(function ($siswa, $index) {
                $siswa->peringkat = $index + 1;
                return $siswa;
            });

        return view('hasilakhir.index', compact('eligibleSiswa', 'jurusan'));
    }


    public function downloadPdfHasilAkhir(Request $request)
    {
        // Ambil parameter filter jurusan jika ada
        $jurusanId = $request->input('jurusan_id');

        // Query data siswa eligible
        $query = Siswa::with(['rombongan', 'nilai', 'prestasi'])
            ->select(
                'tbl_siswa.id',
                'tbl_siswa.namasiswa',
                'tbl_siswa.nisn',
                'tbl_siswa.jurusan',
                DB::raw('COALESCE(SUM(tbl_nilai.nilai_pengetahuan), 0) as total_pengetahuan'),
                DB::raw('COALESCE(SUM(tbl_nilai.nilai_keterampilan), 0) as total_keterampilan'),
                DB::raw('COUNT(tbl_prestasi_siswa.id) as jumlah_prestasi'),
                DB::raw('COALESCE(SUM(tbl_nilai.nilai_pengetahuan), 0) + 
                   COALESCE(SUM(tbl_nilai.nilai_keterampilan), 0) + 
                   (COUNT(tbl_prestasi_siswa.id) * 10) as total_keseluruhan')
            )
            ->leftJoin('tbl_nilai', 'tbl_siswa.nisn', '=', 'tbl_nilai.nisn_siswa')
            ->leftJoin('tbl_prestasi_siswa', 'tbl_siswa.nisn', '=', 'tbl_prestasi_siswa.nisn_siswa')
            ->groupBy('tbl_siswa.id', 'tbl_siswa.namasiswa', 'tbl_siswa.nisn', 'tbl_siswa.jurusan')
            ->havingRaw('(COALESCE(SUM(tbl_nilai.nilai_pengetahuan), 0) + 
                    COALESCE(SUM(tbl_nilai.nilai_keterampilan), 0)) / 
                    GREATEST(COUNT(DISTINCT tbl_nilai.id_mapel) * 2, 1) > 75')
            ->orderByDesc('total_keseluruhan');

        // Filter berdasarkan jurusan jika dipilih
        if ($jurusanId) {
            $query->where('tbl_siswa.jurusan', $jurusanId);
        }

        $siswaEligible = $query->get();

        // Tambahkan peringkat
        $rank = 1;
        $siswaEligible = $siswaEligible->map(function ($siswa) use (&$rank) {
            $siswa->peringkat = $rank++;
            return $siswa;
        });

        // Data untuk header PDF
        $setting = DB::table('tbl_setting')->first();

        $data = [
            'title' => 'Daftar Siswa Eligible',
            'date' => date('d/m/Y'),
            'siswaEligible' => $siswaEligible,
            'jurusan' => $jurusanId ? Rombongan::find($jurusanId)->rombongan : 'Semua Jurusan',
            'nama_sekolah' => $setting->namasekolah ?? 'Sekolah',
            'alamat_sekolah' => $setting->alamat ?? '-'
        ];

        $pdf = PDF::loadView('pdf.siswa_eligible', $data);
        return $pdf->download('siswa_eligible_' . date('Ymd') . '.pdf');
    }

    public function downloadPdfPerSiswa($id)
    {
        $siswa = Siswa::with(['rombongan', 'nilai.mapel', 'prestasi'])->findOrFail($id);

        // Hitung total nilai
        $totalPengetahuan = $siswa->nilai->sum('nilai_pengetahuan');
        $totalKeterampilan = $siswa->nilai->sum('nilai_keterampilan');
        $jumlahPrestasi = $siswa->prestasi->count();
        $totalKeseluruhan = $totalPengetahuan + $totalKeterampilan + ($jumlahPrestasi * 10);

        $setting = DB::table('tbl_setting')->first();

        $data = [
            'title' => 'Detail Siswa Eligible',
            'date' => date('d/m/Y'),
            'siswa' => $siswa,
            'total_pengetahuan' => $totalPengetahuan,
            'total_keterampilan' => $totalKeterampilan,
            'jumlah_prestasi' => $jumlahPrestasi,
            'total_keseluruhan' => $totalKeseluruhan,
            'nama_sekolah' => $setting->namasekolah ?? 'Sekolah',
            'alamat_sekolah' => $setting->alamat ?? '-'
        ];

        $pdf = PDF::loadView('pdf.siswa_eligible_detail', $data);
        return $pdf->download('siswa_eligible_' . $siswa->nisn . '_' . date('Ymd') . '.pdf');
    }
}
