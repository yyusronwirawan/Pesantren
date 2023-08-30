<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\SetingController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\JadwalKegiatanController;
use App\Http\Controllers\Auth\ForgotPasswordController;

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

Route::get('/', [DashboardController::class, 'homeContent'])->name('homeContent');
Route::get('about', [DashboardController::class, 'about'])->name('about');
Route::get('gallery-content', [DashboardController::class, 'tampilContent'])->name('gallery-content.tampilContent');
Route::get('info', [DashboardController::class, 'infoContent'])->name('infoContent');
Route::get('info/{id}', [DashboardController::class, 'infoDetail'])->name('info.detail');
// Grafik
Route::get('/grafik-santri', [App\Http\Controllers\AkunController::class, 'grafik'])->name('grafik-santri');
// Login
Route::get('/login-page', [App\Http\Controllers\LoginController::class, 'index'])->name('login-page');
Route::post('/postlogin', [App\Http\Controllers\LoginController::class, 'postlogin'])->name('postlogin');
Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
// Forgot password
Route::get('forget-password', [ForgotPasswordController::class, 'ForgetPassword'])->name('ForgetPasswordGet');
Route::post('forget-password', [ForgotPasswordController::class, 'ForgetPasswordStore'])->name('ForgetPasswordPost');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'ResetPassword'])->name('ResetPasswordGet');
Route::post('reset-password', [ForgotPasswordController::class, 'ResetPasswordStore'])->name('ResetPasswordPost');

Route::group(['middleware' => ['auth', 'ceklevel:admin']], function () {
    Route::get('/dashboard-admin', [App\Http\Controllers\AkunController::class, 'countAkun'])->name('dashboard-admin');
    // Profil saya
    Route::get('profil-admin', [App\Http\Controllers\ProfilController::class, 'tampilAdmin'])->name('profil-admin');
    Route::put('/update-password/{id?}', 'LoginController@updatePassword')->name('update-password');
    Route::put('/update-foto/{id?}', 'ProfilController@updateGambarAdmin')->name('update-foto');
    Route::put('/update-admin/{id?}', 'ProfilController@updateAdmin')->name('update-admin');

    // Data Kelas
    Route::get('data-kelas', [App\Http\Controllers\AkunController::class, 'datakelas'])->name('data-kelas.index');
    Route::put('/data-kelas/update/{id}', 'AkunController@updatekelas')->name('data-kelas.update');
    Route::post('/data-kelas/import', 'AkunController@UpdateKelasImport')->name('data-kelas.UpdateKelasImport');
    Route::post('/data-kelas/search', 'AkunController@search')->name('search-admin');


    // Data Akun
    Route::get('data-akun', [App\Http\Controllers\AkunController::class, 'index'])->name('data-akun.index');
    Route::post('/data-akun/create', 'AkunController@create')->name('data-akun.create');
    Route::post('/data-akun/store', 'AkunController@store')->name('data-akun.store');
    Route::get('/data-akun/edit/{id?}', 'AkunController@edit')->name('data-akun.edit');
    Route::put('/data-akun/update/{id?}', 'AkunController@update')->name('data-akun.update');
    Route::delete('/data-akun/destroy/{id?}', 'AkunController@destroy')->name('data-akun.destroy');

    // Setting Aplikasi
    Route::get('setting-aplikasi', [SetingController::class, 'index'])->name('setting-aplikasi.index');
    Route::put('/setting-aplikasi/banner/update/{id}', [SetingController::class, 'update_banner'])->name('setting-aplikasi.banner');
    Route::put('/setting-aplikasi/update/{id}', [SetingController::class, 'update'])->name('setting-aplikasi.update');
    Route::put('/setting-aplikasi/maintenantce/{id}', [SetingController::class, 'maintenance'])->name('setting-aplikasi.maintenance');

    // Data pengumuman
    Route::get('data-pengumuman', [App\Http\Controllers\PengumumanController::class, 'pengumuman'])->name('data-pengumuman.index');
    Route::post('/data-pengumuman/create', 'PengumumanController@create')->name('data-pengumuman.create');
    Route::post('/data-pengumuman/store', 'PengumumanController@store')->name('data-pengumuman.store');
    Route::get('/data-pengumuman/show/{id}', 'PengumumanController@show')->name('data-pengumuman.show');
    Route::get('/data-pengumuman/edit/{id}', 'PengumumanController@edit')->name('data-pengumuman.edit');
    Route::put('/data-pengumuman/update/{id}', 'PengumumanController@update')->name('data-pengumuman.update');
    Route::delete('/data-pengumuman/destroy/{id}', 'PengumumanController@destroy')->name('data-pengumuman.destroy');
    Route::post('/data-pengumuman/search', 'PengumumanController@search')->name('search');

    // Data Galeri
    Route::get('data-galeri', [GaleriController::class, 'galeri'])->name('data-galeri.index');
    Route::post('/data-galeri/create', 'GaleriController@create')->name('data-galeri.create');
    Route::post('/data-galeri/store', 'GaleriController@store')->name('data-galeri.store');
    Route::get('/data-galeri/show/{id}', 'GaleriController@show')->name('data-galeri.show');
    Route::get('/data-galeri/edit/{id}', 'GaleriController@edit')->name('data-galeri.edit');
    Route::put('/data-galeri/update/{id}', 'GaleriController@update')->name('data-galeri.update');
    Route::delete('/data-galeri/destroy/{id}', 'GaleriController@destroy')->name('data-galeri.destroy');
    Route::post('/data-galeri/search', 'GaleriController@search')->name('search');
    // Data mapel

    Route::get('data-mapel', [App\Http\Controllers\MapelController::class, 'index'])->name('data-mapel');
    Route::post('/data-mapel/create', 'MapelController@create')->name('data-mapel.create');
    Route::post('/data-mapel/store', 'MapelController@store')->name('data-mapel.store');
    Route::get('/data-mapel/edit/{id?}', 'MapelController@edit')->name('data-mapel.edit');
    Route::put('/data-mapel/update/{id?}', 'MapelController@update')->name('data-mapel.update');
    Route::delete('/data-mapel/destroy/{id?}', 'MapelController@destroy')->name('data-mapel.destroy');
    // Data prestasi
    Route::get('data-prestasi', [App\Http\Controllers\PrestasiController::class, 'index'])->name('data-prestasi');
    Route::post('/data-prestasi/create', 'PrestasiController@create')->name('data-prestasi.create');
    Route::post('/data-prestasi/store', 'PrestasiController@store')->name('data-prestasi.store');
    Route::get('/data-prestasi/edit/{id?}', 'PrestasiController@edit')->name('data-prestasi.edit');
    Route::put('/data-prestasi/update/{id?}', 'PrestasiController@update')->name('data-prestasi.update');
    Route::delete('/data-prestasi/destroy/{id?}', 'PrestasiController@destroy')->name('data-prestasi.destroy');
    // Data alumni
    Route::get('data-alumni', [App\Http\Controllers\AlumniController::class, 'index'])->name('data-alumni');
    Route::post('/data-alumni/create', 'AlumniController@create')->name('data-alumni.create');
    Route::post('/data-alumni/store', 'AlumniController@store')->name('data-alumni.store');
    Route::get('/data-alumni/edit/{id?}', 'AlumniController@edit')->name('data-alumni.edit');
    Route::put('/data-alumni/update/{id?}', 'AlumniController@update')->name('data-alumni.update');
    Route::delete('/data-alumni/destroy/{id?}', 'AlumniController@destroy')->name('data-alumni.destroy');
    // Data kegiatan
    Route::get('data-kegiatan', [App\Http\Controllers\JadwalKegiatanController::class, 'index'])->name('data-kegiatan');
    Route::post('/data-kegiatan/create', 'JadwalKegiatanController@create')->name('data-kegiatan.create');
    Route::post('/data-kegiatan/store', 'JadwalKegiatanController@store')->name('data-kegiatan.store');
    Route::get('/data-kegiatan/edit/{id?}', 'JadwalKegiatanController@edit')->name('data-kegiatan.edit');
    Route::put('/data-kegiatan/update/{id?}', 'JadwalKegiatanController@update')->name('data-kegiatan.update');
    Route::delete('/data-kegiatan/destroy/{id?}', 'JadwalKegiatanController@destroy')->name('data-kegiatan.destroy');
});


Route::group(['middleware' => ['auth', 'ceklevel:pengurus,pendidik']], function () {
    Route::get('/dashboard-pengurus', [App\Http\Controllers\SantriController::class, 'countData'])->name('dashboard-pengurus');
    // Profil saya
    Route::get('akun-saya', [App\Http\Controllers\ProfilController::class, 'tampilPengurus'])->name('akun-saya');
    Route::put('/akun-saya/update/{id?}', 'ProfilController@updatePengurus')->name('akun-saya.update');
    Route::put('/password-pengurus/{id?}', 'LoginController@passwordPengurus')->name('password-pengurus');

    // Data Tagihan
    Route::get('data-tagihan', [App\Http\Controllers\TagihanController::class, 'viewPengurus'])->name('data-tagihan.viewPengurus');
    Route::delete('/data-tagihan/destroy/{id?}', [App\Http\Controllers\TagihanController::class, 'destroy'])->name('data-tagihan.destroy');
    Route::post('/data-tagihan/store', [App\Http\Controllers\TagihanController::class, 'store'])->name('data-tagihan.store');
    Route::post('/data-tagihan/cetak-perbulan', [App\Http\Controllers\TagihanController::class, 'cetak_perbulan'])->name('data-tagihan.cetak-perbulan');
    Route::post('data-tagihan', [App\Http\Controllers\TagihanController::class, 'cari_data'])->name('data-tagihan.cari_data');
    // Data Pembayaran
    Route::get('data-pembayaran', [App\Http\Controllers\PembayaranController::class, 'index'])->name('data-pembayaran.index');
    Route::post('/data-pembayaran/create', 'PembayaranController@create')->name('data-pembayaran.create');
    Route::post('/data-pembayaran/store', 'PembayaranController@store')->name('data-pembayaran.store');
    Route::get('/data-pembayaran/edit/{id?}', 'PembayaranController@edit')->name('data-pembayaran.edit');
    Route::put('/data-pembayaran/update/{id?}', 'PembayaranController@update')->name('data-pembayaran.update');
    Route::delete('/data-pembayaran/destroy/{id?}', 'PembayaranController@destroy')->name('data-pembayaran.destroy');
    Route::get('/data-pembayaran/cetak-form', 'PembayaranController@cetakForm')->name('data-pembayaran.cetak-form');
    Route::get('/data-pembayaran/cetak-pertanggal/{tglawal}/{tglakhir}', 'PembayaranController@cetakPertanggal')->name('data-pembayaran.cetak-pertanggal');
    Route::post('/data-pembayaran/search', 'PembayaranController@search')->name('search');
    Route::get('/data-pembayaran/laporan-perbulan', 'PembayaranController@cetak_perbulan')->name('data-pembayaran.laporan-perbulan');
    Route::get('/data-pembayaran/laporan-all', 'PembayaranController@cetak_all')->name('data-pembayaran.laporan-all');
    // Data hafalan
    Route::get('data-hafalan', [App\Http\Controllers\HafalanController::class, 'index'])->name('data-hafalan.index');
    Route::post('/data-hafalan/create', 'HafalanController@create')->name('data-hafalan.create');
    Route::post('/data-hafalan/store', 'HafalanController@store')->name('data-hafalan.store');
    Route::get('/data-hafalan/edit/{id?}', 'HafalanController@edit')->name('data-hafalan.edit');
    Route::put('/data-hafalan/update/{id?}', 'HafalanController@update')->name('data-hafalan.update');
    Route::delete('/data-hafalan/destroy/{id?}', 'HafalanController@destroy')->name('data-hafalan.destroy');
    Route::post('/data-hafalan/cari', 'HafalanController@cari')->name('cari');
    Route::get('/data-hafalan/cetak-form', 'HafalanController@cetakForm')->name('data-hafalan.cetak-form');
    Route::get('/data-hafalan/cetak-hafalan/{tglawal}/{tglakhir}', 'HafalanController@cetakPertanggal')->name('data-hafalan.cetak-pertanggal');
    // Data santri
    Route::get('santri', [App\Http\Controllers\SantriController::class, 'santriPengurus'])->name('santri');
    // Content
    Route::get('data-content', [App\Http\Controllers\PengumumanController::class, 'index'])->name('data-content.index');
    Route::post('/data-content/create', 'PengumumanController@create')->name('data-content.create');
    Route::post('/data-content/store', 'PengumumanController@store')->name('data-content.store');
    Route::get('/data-content/edit/{id?}', 'PengumumanController@edit')->name('data-content.edit');
    Route::put('/data-content/update/{id?}', 'PengumumanController@update')->name('data-content.update');
    Route::delete('/data-content/destroy/{id?}', 'PengumumanController@destroy')->name('data-content.destroy');
    Route::post('/data-content/search', 'PengumumanController@search')->name('search');
    // Informasi pribadi
    Route::get('data-informasi', [App\Http\Controllers\InformasiPribadiController::class, 'index'])->name('data-informasi.index');
    Route::post('/data-informasi/create', 'InformasiPribadiController@create')->name('data-informasi.create');
    Route::post('/data-informasi/store', 'InformasiPribadiController@store')->name('data-informasi.store');
    Route::get('/data-informasi/edit/{id?}', 'InformasiPribadiController@edit')->name('data-informasi.edit');
    Route::put('/data-informasi/update/{id?}', 'InformasiPribadiController@update')->name('data-informasi.update');
    Route::delete('/data-informasi/destroy/{id?}', 'InformasiPribadiController@destroy')->name('data-informasi.destroy');
    Route::post('/data-informasi/search', 'InformasiPribadiController@search')->name('search');
    // Data nilai
    Route::get('data-nilai', [App\Http\Controllers\NilaiController::class, 'index'])->name('data-nilai');
    Route::post('data-nilai', [App\Http\Controllers\NilaiController::class, 'tampil_nilai_guru'])->name('data-nilai');
    Route::post('/data-nilai/store', 'NilaiController@store')->name('data-nilai.store');
    Route::get('/data-nilai/edit/{id?}', 'NilaiController@edit')->name('data-nilai.edit');
    Route::put('/data-nilai/update/{id?}', 'NilaiController@update')->name('data-nilai.update');
    Route::delete('/data-nilai/destroy/{id?}', 'NilaiController@destroy')->name('data-nilai.destroy');
    Route::get('/data-nilai/cetak', 'NilaiController@cetak')->name('data-nilai.cetak');
    Route::get('/data-nilai/cetak-all', 'NilaiController@cetak_nilai_guru')->name('data-nilai.cetak_all');
    Route::post('/data-nilai/import', 'NilaiController@importNilai')->name('data-nilai.importNilai');
    Route::post('/data-nilai/export', 'NilaiController@export')->name('data-nilai.export');
});


Route::group(['middleware' => ['auth', 'ceklevel:santri']], function () {
    Route::get('pengumuman/{id}', [DashboardController::class, 'PengumumanDetail'])->name('pengumuman.detail');
    Route::get('/tagihan', [TagihanController::class, 'tagihan'])->name('tagihan');
    Route::post('/tagihan', [TagihanController::class, 'detail'])->name('detail');
    Route::get('/jadwal', [App\Http\Controllers\JadwalKegiatanController::class, 'jadwalKegiatan'])->name('jadwal');
    Route::get('/waiting-payment/{id}', [TagihanController::class, 'waiting'])->name('waiting');
    Route::post('/payment', [TagihanController::class, 'payment'])->name('payment');
    Route::get('/cetak-kwitansi/{id}', [PembayaranController::class, 'cetak'])->name('cetak');
    Route::get('/tagihan/edit/{id?}', 'PembayaranController@editTagihan')->name('tagihan.edit');
    Route::get('dashboard', [DashboardController::class, 'homeUser'])->name('homeUser');
    Route::get('hafalan-santri', [App\Http\Controllers\HafalanController::class, 'hafalan'])->name('hafalan-santri.hafalan');
    Route::get('hafalan-santri/cetak', [App\Http\Controllers\HafalanController::class, 'cetak'])->name('hafalan-santri.cetak');

    Route::put('/upload/update/{id?}', 'UploadController@update')->name('upload.update');

    Route::get('detail-riwayat/{id?}', [App\Http\Controllers\PembayaranController::class, 'detail'])->name('detail-riwayat.riwayat');
    Route::get('riwayat-pembayaran', [App\Http\Controllers\PembayaranController::class, 'riwayat'])->name('riwayat-pembayaran.riwayat');
    Route::get('riwayat-pembayaran/cetak-perbulan', [App\Http\Controllers\PembayaranController::class, 'cetak_perbulan_user'])->name('riwayat-pembayaran.cetak_perbulan_user');
    Route::get('riwayat-pembayaran/cetak-pertahun', [App\Http\Controllers\PembayaranController::class, 'cetak_pertahun_user'])->name('riwayat-pembayaran.cetak_pertahun_user');
    Route::get('riwayat-pembayaran/cetak-all', [App\Http\Controllers\PembayaranController::class, 'cetak_all_user'])->name('riwayat-pembayaran.cetak_all_user');
    Route::post('riwayat-pembayaran', [App\Http\Controllers\PembayaranController::class, 'cari_data_riwayat'])->name('riwayat-pembayaran.cari_data_riwayat');

    Route::get('tutorial', [App\Http\Controllers\PembayaranController::class, 'tutorial']);
    Route::get('upload', [App\Http\Controllers\UploadController::class, 'index'])->name('upload.index');
    Route::get('nilai', [App\Http\Controllers\NilaiController::class, 'tampilUser'])->name('nilai');
    Route::post('nilai', [App\Http\Controllers\NilaiController::class, 'tampil_nilai'])->name('nilai');
    Route::get('nilai/cetak-nilai', [App\Http\Controllers\NilaiController::class, 'cetak_nilai'])->name('nilai.cetak_nilai');
    Route::get('nilai/cetak-nilai-all', [App\Http\Controllers\NilaiController::class, 'cetak_nilai_all'])->name('nilai.cetak_nilai_all');
    Route::get('nilai/cetak-nilai-pelajaran', [App\Http\Controllers\NilaiController::class, 'cetak_nilai_pelajaran'])->name('nilai.cetak_nilai_pelajaran');

    Route::get('info-santri', [App\Http\Controllers\InformasiPribadiController::class, 'show'])->name('info-santri.index');
    Route::get('info-santri/{id}', [App\Http\Controllers\InformasiPribadiController::class, 'detail'])->name('info-santri.detail');
    Route::get('profil-user', [App\Http\Controllers\ProfilController::class, 'tampilUser'])->name('profil-user');
    Route::put('/profil-user/update/{id?}', 'ProfilController@updateUser')->name('profil-user.update');
    Route::put('/password-user/{id?}', 'LoginController@passwordUser')->name('password-user');
});

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
});
Auth::routes();
