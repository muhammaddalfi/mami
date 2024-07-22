<?php

use App\Http\Controllers\BadDebController;
use App\Http\Controllers\BasecampController;
use App\Http\Controllers\CalendarsController;
use App\Http\Controllers\DashboardBaddebt;
use App\Http\Controllers\DashboardCluster;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardKeluhanController;
use App\Http\Controllers\DashboardMontir;
use App\Http\Controllers\DashboardPiutang;
use App\Http\Controllers\HaloController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\JenisKegiatanController;
use App\Http\Controllers\JenisKeluhanController;
use App\Http\Controllers\KategoriDebt;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KeluhanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LaporanDebt;
use App\Http\Controllers\LaporanIncident;
use App\Http\Controllers\LaporanPmController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MppController;
use App\Http\Controllers\OltController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\PMController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RadiusController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\UplineController;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'home'])->name('home.dashboard');
});

Route::group(['middleware' => ['role:Admin']], function () {
    Route::get('/material', [MaterialController::class,'home'])->name('material.dashboard');
    Route::post('/material/store', [MaterialController::class, 'store']);
    Route::get('/material/fetch', [MaterialController::class, 'material']);
    Route::get('/material/edit/{id}', [MaterialController::class, 'edit']);
    Route::put('/material/update/{id}', [MaterialController::class, 'update']);
    Route::delete('/material/delete/{id}', [MaterialController::class, 'destroy']);
    Route::get('/material/show/{id}', [MaterialController::class, 'show']);

    Route::get('/basecamp', [BasecampController::class,'home'])->name('basecamp.dashboard');
    Route::post('/basecamp/store', [BasecampController::class, 'store']);
    Route::get('/basecamp/fetch', [BasecampController::class, 'basecamp']);
    Route::get('/basecamp/edit/{id}', [BasecampController::class, 'edit']);
    Route::put('/basecamp/update/{id}', [BasecampController::class, 'update']);
    Route::delete('/basecamp/delete/{id}', [BasecampController::class, 'destroy']);
    Route::get('/basecamp/show/{id}', [BasecampController::class, 'show']);

    Route::get('/perusahaan', [PerusahaanController::class,'home'])->name('perusahaan.dashboard');
    Route::post('/perusahaan/store', [PerusahaanController::class, 'store']);
    Route::get('/perusahaan/fetch', [PerusahaanController::class, 'perusahaan']);
    Route::get('/perusahaan/edit/{id}', [PerusahaanController::class, 'edit']);
    Route::put('/perusahaan/update/{id}', [PerusahaanController::class, 'update']);
    Route::delete('/perusahaan/delete/{id}', [PerusahaanController::class, 'destroy']);
    Route::get('/perusahaan/show/{id}', [PerusahaanController::class, 'show']);

    Route::get('/role', [RoleController::class, 'index'])->name('role.index');
    Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
    Route::get('/role/fetch', [RoleController::class, 'fetch']);
    Route::post('/role', [RoleController::class, 'store']);
    Route::get('/role/{id}', [RoleController::class, 'edit']);
    Route::put('/role/{id}', [RoleController::class, 'update']);
    Route::delete('/role/{id}', [RoleController::class, 'destroy']);

    Route::get('/permission', [PermissionController::class, 'index'])->name('permission.index');
    Route::get('/permission/fetch', [PermissionController::class, 'fetch']);
    Route::post('/permission', [PermissionController::class, 'store']);
    Route::get('/permission/{id}', [PermissionController::class, 'edit']);
    Route::put('/permission/{id}', [PermissionController::class, 'update']);
    Route::delete('/permission/{id}', [PermissionController::class, 'destroy']);

    Route::get('/laporan/raw',[LaporanIncident::class,'export'])->name('export.raw');
});

Route::group(['middleware' => ['permission:Incident permission']], function () { 
    Route::get('/incident', [IncidentController::class,'home'])->name('incident.dashboard');
    Route::post('/incident/store', [IncidentController::class, 'store']);
    Route::get('/incident/fetch', [IncidentController::class, 'fetch']);
    Route::get('/incident/edit/{id}', [IncidentController::class, 'edit']);
    Route::put('/incident/update/{id}', [IncidentController::class, 'update']);
    Route::delete('/incident/delete/{id}', [IncidentController::class, 'destroy']);
    Route::get('/incident/show/{id}', [IncidentController::class, 'show']);

});

Route::group(['middleware' => ['permission:Laporan permission']], function () { 
    Route::get('/laporan',[LaporanIncident::class,'index'])->name('laporan.index');
    Route::get('/laporan/show/{id}', [LaporanIncident::class, 'show']);
    Route::get('/laporan/search', [LaporanIncident::class, 'search'])->name('laporan.search');

});

Route::group(['middleware' => ['permission:Pengguna permission']], function(){
    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna.dashboard');
    Route::post('/pengguna/store', [PenggunaController::class, 'store']);
    Route::get('/pengguna/fetch', [PenggunaController::class, 'fetch']);
    Route::get('/pengguna/edit/{id}', [PenggunaController::class,'edit']);
    Route::put('/pengguna/update/{id}', [PenggunaController::class,'update']);
    Route::delete('/pengguna/delete/{id}', [PenggunaController::class, 'destroy']);
});


require __DIR__ . '/auth.php';
