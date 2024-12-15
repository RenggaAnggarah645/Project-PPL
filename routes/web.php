<?php


use App\Http\Controllers\Bimbingan2021Controller;
use App\Http\Controllers\Bimbingan2022Controller;
use App\Http\Controllers\Bimbingan2023Controller;
use App\Http\Controllers\Bimbingan2024Controller;
use App\Http\Controllers\CRUDDosenPAController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\CRUDKaprodiController;
use App\Http\Controllers\CRUDDosenController;
use App\Http\Controllers\CRUDMahasiswaController;
use App\Http\Controllers\DataDosenController;
use App\Http\Controllers\DataKaprodiController;
use App\Http\Controllers\PembimbingAkademikController;
use App\Http\Controllers\DataMahasiswa2021Controller;
use App\Http\Controllers\DataMahasiswa2022Controller;
use App\Http\Controllers\DataMahasiswa2023Controller;
use App\Http\Controllers\DataMahasiswa2024Controller;
use App\Http\Controllers\BimbinganController;
use App\Http\Controllers\DataMahasiswaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Rute untuk halaman login
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    // Rute untuk halaman mahasiswa, operator, dan kaprodi
    Route::get('/-mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.dashboard');
    Route::get('/operator', [OperatorController::class, 'index']);
    Route::get('/kaprodi', [KaprodiController::class, 'index']);
    Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Rute untuk CRUD Kaprodi
    Route::get('/kaprodi-management', [CRUDKaprodiController::class, 'index'])->name('kaprodi.index');
    Route::post('/kaprodi-management', [CRUDKaprodiController::class, 'store'])->name('kaprodi.store');
    Route::delete('/kaprodi-management/{id}', [CRUDKaprodiController::class, 'destroy'])->name('kaprodi.destroy');

    // Rute untuk CRUD Dosen
    Route::get('/dosen-management', [CRUDDosenController::class, 'index'])->name('dosen.index');
    Route::post('/dosen-management', [CRUDDosenController::class, 'store'])->name('dosen.store');
    Route::delete('/dosen-management/{id}', [CRUDDosenController::class, 'destroy'])->name('dosen.destroy');
    Route::post('/dosen/import', [CRUDDosenController::class, 'import'])->name('dosen.import');

    // Rute untuk CRUD Mahasiswa
    Route::get('/mahasiswa-management', [CRUDMahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::post('/mahasiswa-management', [CRUDMahasiswaController::class, 'store'])->name('mahasiswa.store');
    Route::delete('/mahasiswa-management/{id}', [CRUDMahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
    Route::post('/mahasiswa-data/import', [CRUDMahasiswaController::class, 'import'])->name('mahasiswa.import');

    // Rute untuk CRUD Data Kaprodi
    Route::get('/data-kaprodi', [DataKaprodiController::class, 'index'])->name('data_kaprodi.index');
    Route::post('/data-kaprodi', [DataKaprodiController::class, 'store'])->name('data_kaprodi.store');
    Route::delete('/data-kaprodi/{id}', [DataKaprodiController::class, 'destroy'])->name('data_kaprodi.destroy');
    Route::get('/data-kaprodi/{id}/edit', [DataKaprodiController::class, 'edit'])->name('data_kaprodi.edit');
    Route::put('/data-kaprodi/{id}', [DataKaprodiController::class, 'update'])->name('data_kaprodi.update');
    Route::post('/data-kaprodi/{id}/toggle-status', [DataKaprodiController::class, 'toggleStatus'])->name('data_kaprodi.toggleStatus');

    // Rute untuk CRUD Data Dosen
    Route::get('/data-dosen', [DataDosenController::class, 'index'])->name('data_dosen.index');
    Route::post('/data-dosen', [DataDosenController::class, 'store'])->name('data_dosen.store');
    Route::delete('/data-dosen/{id}', [DataDosenController::class, 'destroy'])->name('data_dosen.destroy');
    Route::get('/data-dosen/{id}/edit', [DataDosenController::class, 'edit'])->name('data_dosen.edit');
    Route::put('/data-dosen/{id}', [DataDosenController::class, 'update'])->name('data_dosen.update');
    Route::post('/data-dosen/{id}/toggle-status', [DataDosenController::class, 'toggleStatus'])->name('data_dosen.toggleStatus');
    Route::post('/data-dosen/import', [DataDosenController::class, 'import'])->name('data_dosen.import');



    // Rute untuk CRUD Data Mahasiswa 
    Route::get('/mahasiswa', [DataMahasiswaController::class, 'index'])->name('data_mahasiswa.index');
    Route::post('/mahasiswa', [DataMahasiswaController::class, 'store'])->name('data_mahasiswa.store');
    Route::get('/mahasiswa/{id}/edit', [DataMahasiswaController::class, 'edit'])->name('data_mahasiswa.edit');
    Route::put('/mahasiswa/{id}', [DataMahasiswaController::class, 'update'])->name('data_mahasiswa.update');
    Route::delete('/mahasiswa/{id}', [DataMahasiswaController::class, 'destroy'])->name('data_mahasiswa.destroy');
    Route::post('/mahasiswa/{id}/toggle-status', [DataMahasiswaController::class, 'toggleStatus'])->name('data_mahasiswa.toggleStatus');
    // Rute untuk mengimpor data mahasiswa dari file Excel
    Route::post('/data-mahasiswa/import', [DataMahasiswaController::class, 'import'])->name('data_mahasiswa.import');


    // Rute untuk proses bimbingan
    Route::get('/bimbingan', [BimbinganController::class, 'index'])->name('bimbingan.index'); // Menampilkan daftar bimbingan
    Route::get('/bimbingan/kaprodi', [BimbinganController::class, 'indexKaprodi'])->name('bimbingan.indexKaprodi'); // Menampilkan daftar bimbingan untuk Kaprodi
    Route::get('/bimbingan/mahasiswa', [BimbinganController::class, 'indexMahasiswa'])->name('bimbingan.indexMahasiswa'); // Menampilkan daftar bimbingan untuk mahasiswa
    Route::get('/bimbingan/create', [BimbinganController::class, 'create'])->name('bimbingan.create'); // Halaman untuk menambah bimbingan
    Route::post('/bimbingan', [BimbinganController::class, 'store'])->name('bimbingan.store'); // Menyimpan bimbingan baru
    Route::get('/bimbingan/{bimbingan}/edit', [BimbinganController::class, 'edit'])->name('bimbingan.edit'); // Halaman edit bimbingan
    Route::put('/bimbingan/{bimbingan}', [BimbinganController::class, 'update'])->name('bimbingan.update'); // Update bimbingan
    Route::delete('/bimbingan/{bimbingan}', [BimbinganController::class, 'destroy'])->name('bimbingan.destroy'); // Menghapus bimbingan
    Route::get('/bimbingan/export', [BimbinganController::class, 'export'])->name('bimbingan.export'); // Mengekspor hasil bimbingan ke PDF
    Route::get('/bimbingan/{nama_dosen}', [BimbinganController::class, 'showByDosen'])->name('bimbingan.showByDosen');

    //route pembimbing akademik halaman kaprodi
    Route::get('/pembimbing-akademik', [PembimbingAkademikController::class, 'index'])->name('pembimbing-akademik.index');
    Route::get('/pembimbing-akademik-PA', [PembimbingAkademikController::class, 'indexPA'])->name('pembimbing-akademik-PA.indexPA');
    Route::post('/pembimbing-akademik/store', [PembimbingAkademikController::class, 'storePembimbing'])->name('pembimbing-akademik.store');
    Route::post('/pembimbing-akademik/store-multiple', [PembimbingAkademikController::class, 'storeMultiple'])->name('pembimbing-akademik.storeMultiple');
    Route::get('/pembimbing-akademik/print', [PembimbingAkademikController::class, 'printPDF'])->name('pembimbing-akademik.print');

    //route bimbingan
    Route::get('bimbingan/dosen/{nama_dosen}', [BimbinganController::class, 'showByDosen'])->name('bimbingan.dosen');
    Route::get('bimbingan/dosen-Kaprodi/{nama_dosen}', [BimbinganController::class, 'showByDosenKaprodi'])->name('bimbingan.dosenKaprodi');
    Route::get('bimbingan/dosen-Mahasiswa/{nama_dosen}', [BimbinganController::class, 'showByDosenMahasiswa'])->name('bimbingan.dosenMahasiswa');
    Route::get('bimbingan/export/{id}', [BimbinganController::class, 'export'])->name('bimbingan.export');
    Route::get('bimbingan/detail/{id}', [BimbinganController::class, 'show'])->name('bimbingan.show');
    Route::get('bimbingan/detail-Kaprodi/{id}', [BimbinganController::class, 'showKaprodi'])->name('bimbingan.showKaprodi');
    Route::get('bimbingan/detail-Mahasiswa/{id}', [BimbinganController::class, 'showMahasiswa'])->name('bimbingan.showMahasiswa');
    Route::get('/api/mahasiswa/{npm}', [BimbinganController::class, 'getMahasiswaByNpm']);

});
