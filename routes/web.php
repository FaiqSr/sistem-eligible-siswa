<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::post('login', 'AuthController@login')->name('login');
Route::get('logout', 'AuthController@logout')->name('logout');

Route::group(['middleware' => 'CheckLoginMiddleware'], function () {
    //Home
    Route::get('dashboard', 'DashboardController@index')->name('dashboard_admin');
    Route::get('profil', 'DashboardController@profil')->name('profil');

    Route::get('ganti_setting', 'DashboardController@ganti_setting')->name('ganti_setting');
    Route::post('ganti_setting/resetsetting', 'DashboardController@reset_usersetting')->name('ganti_setting/resetsetting');
    Route::get('/ganti_setting/delete-foto', 'DashboardController@deleteFoto')->name('ganti_setting/delete-foto');

    // USER
    Route::get('pengguna/index', 'PenggunaController@index')->name('pengguna/index');
    Route::get('pengguna/add', 'PenggunaController@create')->name('add');
    Route::post('pengguna/add', 'PenggunaController@add')->name('add');
    Route::get('pengguna/edit/{id}', 'PenggunaController@edit')->name('pengguna/edit');
    Route::post('pengguna/edit', 'PenggunaController@update')->name('pengguna/edit');
    Route::get('pengguna/pengguna/delete/{id}', 'PenggunaController@delete')->name('pengguna/pengguna/delete');

    // SISWA
    Route::get('siswa/index', 'SiswaController@index')->name('siswa/index');
    Route::get('siswa/add', 'SiswaController@create')->name('add');
    Route::post('siswa/add', 'SiswaController@add')->name('add');
    Route::get('siswa/edit/{id}', 'SiswaController@edit')->name('siswa/edit');
    Route::post('siswa/edit', 'SiswaController@update')->name('siswa/edit');
    Route::get('siswa/siswa/delete/{id}', 'SiswaController@delete')->name('siswa/siswa/delete');
    Route::get('siswa/rombonganbelajar', 'SiswaController@rombonganbelajar')->name('siswa/rombonganbelajar');

    // NILAI
    Route::get('nilai', 'NilaisiswaController@showNilaiSiswa')->name('nilai/inputNilaiSiswa');
    Route::get('nilai/add', 'NilaisiswaController@showAddNilaiSiswa')->name('nilai/add');
    Route::post('nilai/add', 'NilaisiswaController@addNilaiSiswa')->name('nilai/add');
    Route::get('nilai/edit/{id}', 'NilaisiswaController@showNilaiSiswaIndividu')->name('nilai/individu');
    Route::get('/siswa/{siswa_id}/nilai/{mapel_id}/edit', 'NilaisiswaController@edit')->name('nilai.edit');
    Route::put('/siswa/{siswa_id}/nilai/{mapel_id}', 'NilaisiswaController@update')->name('nilai.update');
    Route::get('/siswa/{id}', 'NilaisiswaController@showNilaiSiswaIndividu')->name('siswa.show');
    Route::get('/siswa/{id}/edit', 'NilaisiswaController@edit')->name('siswa.edit');

    // HASIL AKHIR
    Route::get('hasilakhir', 'NilaisiswaController@showHasilAkhir')->name('hasilakhir');
    Route::get('/hasilakhir/pdf', 'NilaisiswaController@downloadPdfHasilAkhir')->name('hasilakhir.pdf');
    Route::get('/hasilakhir/{id}/pdf', 'NilaisiswaController@downloadPdfPerSiswa')->name('hasilakhir.detail.pdf');

    // PRESTASI
    Route::get('prestasi', 'NilaisiswaController@showInputPrestasiSiswa')->name('siswa/inputPrestasiSiswa');
    Route::get('prestasi/add', 'NilaisiswaController@showAddPrestasiSiswa')->name('prestasi/add');
    Route::post('prestasi/add', 'NilaisiswaController@addPrestasiSiswa')->name('prestasi/add');
    Route::get('prestasi/edit/{id}', 'NilaisiswaController@showEditPrestasiSiswa')->name('prestasi/edit');
    Route::post('prestasi/edit/{id}', 'NilaisiswaController@editPrestasiSiswa')->name('prestasi/edit');

    // SURAT
    Route::group(['prefix' => 'surat', 'as' => 'surat.'], function () {
        Route::get('/', 'SuratController@index')->name('index');
        Route::post('/generate', 'SuratController@generate')->name('generate');
    });
});
