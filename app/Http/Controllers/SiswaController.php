<?php

namespace App\Http\Controllers;

use App\Mapel;
use App\Nilai;
use App\Prestasi;
use App\Rombongan;
use App\Siswa;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $data = Siswa::with('rombongan')->get();

        return view('siswa.index', ['data' => $data]);
    }

    public function create()
    {
        $jurusan = Rombongan::get();

        return view('siswa.add', ['jurusan' => $jurusan]);
    }

    public function add(Request $request)
    {
        DB::table('tbl_siswa')->insert([
            'jurusan' => $request->jurusan,
            'namasiswa' => $request->namasiswa,
            'nisn' => $request->nisn,
            'jeniskelamin' => $request->jeniskelamin,
        ]);

        return redirect('siswa/index')->with('add_sukses', 1);
    }

    public function edit($id)
    {
        $row = Siswa::with('rombongan')->find($id);
        $jurusan = Rombongan::get();
        return view('siswa.edit', [
            'row' => $row,
            'jurusan' => $jurusan,
        ]);
    }

    public function update(Request $request)
    {

        DB::table('tbl_siswa')
            ->where('id', $request->id)
            ->update([
                'namasiswa' => $request->namasiswa,
                'nisn' => $request->nisn,
                'jeniskelamin' => $request->jeniskelamin,
            ]);

        return redirect('siswa/index')->with('edit_sukses', 1);
    }

    public function delete($id)
    {
        DB::table('tbl_siswa')->where('id', $id)->delete();

        return redirect()->back()->with('delete_sukses', 1);
    }

    public function rombonganbelajar()
    {
        $data = DB::table('tbl_rombongan')->get();

        return view('siswa.rombongan', ['data' => $data]);
    }
}
