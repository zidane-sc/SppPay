<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::match(["GET", "POST"], "/register", function(){
    return redirect("/login");
})->name("register");

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/calender', 'HomeController@calender')->name('calender');

// User
Route::get('users/{id}/profile', 'UserController@profile')->name('users.profile');
Route::resource('users', 'UserController');

// Jurusan
Route::get('/jurusan/trash', 'JurusanController@trash')->name('jurusan.trash');
Route::post('/jurusan/{id}/restore', 'JurusanController@restore')->name('jurusan.restore');
Route::delete('/jurusan/{id}/delete-permanent', 'JurusanController@deletePermanent')->name('jurusan.delete-permanently');
Route::resource('jurusan', 'JurusanController');

// Kelas
Route::resource('kelas', 'KelasController');

// Siswa
Route::resource('siswa', 'SiswaController');

// SPP
Route::resource('spp', 'SppController');

// Pembayaran SPP
Route::get('/pembayaran/cetak_bukti', 'PembayaranController@cetakBukti')->name('pembayaran.cetak');
Route::resource('pembayaran', 'PembayaranController');

// Database backup
Route::get('/backup-database', function () {
    Artisan::call('backup:run');
    return redirect()->route('home')->with('sukses', 'database successfully backup');
})->name('backup');

// Laporan
// --Siswa
Route::get('/laporan/siswa', 'LaporanController@siswa')->name('laporan.siswa');
Route::get('/laporan/cetak/siswa', 'LaporanController@siswaCetak')->name('laporan.siswa_cetak');

// --Spp
Route::get('/laporan/spp', 'LaporanController@spp')->name('laporan.spp');
Route::get('/laporan/cetak/spp', 'LaporanController@sppCetak')->name('laporan.spp_cetak');



