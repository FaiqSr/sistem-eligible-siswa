<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa;
use App\Rombongan;
use Pdf;
use Illuminate\Support\Facades\DB;

class SuratController extends Controller
{
    public function index()
    {
        $jurusan = Rombongan::all();
        return view('surat.index', compact('jurusan'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required',
            'nama_kepala' => 'required',
            'jurusan_id' => 'required|exists:tbl_rombongan,id'
        ]);

        // Tambahkan tanggal saat ini
        $tanggal = now()->format('d F Y');

        $dataSekolah = DB::table('tbl_setting')->first();

        $data = [
            'nama_sekolah' => $dataSekolah->namasekolah,
            'alamat_sekolah' => $dataSekolah->alamat,
            'nomor_surat' => $request->nomor_surat,
            'nama_kepala' => $request->nama_kepala,
            'jurusan' => Rombongan::find($request->jurusan_id)->rombongan,
            'tanggal' => $tanggal, // Pastikan variabel ini dikirim
            'siswa_eligible' => $this->getSiswaEligible($request->jurusan_id)
        ];

        $pdf = PDF::loadView('surat.template', $data);
        return $pdf->download('surat_keputusan_' . $data['jurusan'] . '.pdf');
    }

    private function getSiswaEligible($jurusan_id)
    {
        return Siswa::with(['nilai', 'prestasi'])
            ->where('jurusan', $jurusan_id)
            ->select(
                'tbl_siswa.id',
                'tbl_siswa.namasiswa',
                'tbl_siswa.nisn',
                DB::raw('COALESCE(SUM(tbl_nilai.nilai_pengetahuan), 0) as total_pengetahuan'),
                DB::raw('COALESCE(SUM(tbl_nilai.nilai_keterampilan), 0) as total_keterampilan'),
                DB::raw('COUNT(tbl_prestasi_siswa.id) as jumlah_prestasi'),
                DB::raw('COALESCE(SUM(tbl_nilai.nilai_pengetahuan), 0) + 
                       COALESCE(SUM(tbl_nilai.nilai_keterampilan), 0) + 
                       (COUNT(tbl_prestasi_siswa.id) * 10) as total_keseluruhan')
            )
            ->leftJoin('tbl_nilai', 'tbl_siswa.nisn', '=', 'tbl_nilai.nisn_siswa')
            ->leftJoin('tbl_prestasi_siswa', 'tbl_siswa.nisn', '=', 'tbl_prestasi_siswa.nisn_siswa')
            ->groupBy('tbl_siswa.id', 'tbl_siswa.namasiswa', 'tbl_siswa.nisn')
            ->havingRaw('(COALESCE(SUM(tbl_nilai.nilai_pengetahuan), 0) + 
                        COALESCE(SUM(tbl_nilai.nilai_keterampilan), 0)) / 
                        GREATEST(COUNT(DISTINCT tbl_nilai.id_mapel) * 2, 1) > 75')
            ->orderByDesc('total_keseluruhan')
            ->get()
            ->map(function ($siswa, $index) {
                $siswa->peringkat = $index + 1;
                return $siswa;
            });
    }
}
