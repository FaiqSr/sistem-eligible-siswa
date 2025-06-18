<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        return view('home.home');
    }

    public function profil()
    {
        return view('home.profil');
    }

    public function ganti_setting()
    {
        return view('home.ganti_setting');
    }

    public function reset_usersetting(Request $request)
    {
        $request->validate([
            'namasekolah' => 'required',
            'alamat' => 'required',
            'akreditasi' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $setting = DB::table('tbl_setting')->where('id', 1)->first();

        $data = [
            'namasekolah' => $request->namasekolah,
            'alamat' => $request->alamat,
            'akreditasi' => $request->akreditasi,
        ];

        // Handle file upload
        if ($request->hasFile('foto')) {
            // Delete old file if exists
            if ($setting->foto && Storage::exists('public/setting/' . $setting->foto)) {
                Storage::delete('public/setting/' . $setting->foto);
            }

            // Store new file
            $filename = time() . '.' . $request->foto->extension();
            $request->foto->storeAs('public/setting', $filename);
            $data['foto'] = $filename;
        }

        DB::table('tbl_setting')->where('id', 1)->update($data);

        return redirect()->back()->with('edit_sukses', true);
    }
    public function deleteFoto()
    {
        $setting = DB::table('tbl_setting')->where('id', 1)->first();

        if ($setting->foto && Storage::exists('public/setting/' . $setting->foto)) {
            Storage::delete('public/setting/' . $setting->foto);
        }

        DB::table('tbl_setting')->where('id', 1)->update(['foto' => null]);

        return redirect()->back()->with('edit_sukses', true);
    }
}
