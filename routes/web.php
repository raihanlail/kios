<?php

use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\JadwalJanjiController;
use App\Http\Controllers\admin\KiosController;
use App\Http\Controllers\admin\ShowKontrakController;
use App\Http\Controllers\manager\ManagerDashboardController;
use App\Http\Controllers\pedagang\ApplyJadwalJanjiController;
use App\Http\Controllers\pedagang\KontrakController;
use App\Http\Controllers\pedagang\PedagangDashboardController;
use App\Http\Controllers\pedagang\PembayaranController;
use App\Http\Controllers\pedagang\SewaController;
use App\Http\Controllers\pedagang\ShowKiosController;
use App\Http\Controllers\staff\StaffPembayaranController;







use App\Http\Controllers\ProfileController;
use App\Http\Controllers\staff\StaffDashboardController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return redirect()->route('login');
});


Route::middleware(['auth', 'pedagangMiddleware'])->group(function () {
    Route::get('/pedagang/dashboard', [PedagangDashboardController::class, 'index'])->name('pedagang.dashboard');
    Route::get('/pedagang/kios', [ShowKiosController::class, 'index'])->name('pedagang.kios');
    Route::get('/pedagang/kios/filter', [ShowKiosController::class, 'filterByPasar'])->name('pedagang.kios.filter');
    Route::get('/pedagang/kios/{id}', [ShowKiosController::class, 'show'])->name('pedagang.kios.show');
  Route::get('/pedagang/sewa/create/{kios}', [SewaController::class, 'create'])->name('sewa.create');
Route::post('/pedagang/sewa', [SewaController::class, 'store'])->name('sewa.store');
Route::get('/pedagang/sewa', [SewaController::class, 'index'])->name('pedagang.sewa.index');
Route::get('/pedagang/sewa/pembayaran', [PembayaranController::class, 'create'])->name('pembayaran.create');
 Route::post('/pedagang/sewa/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
 Route::get('/kontrak/{kontrak}/download', [KontrakController::class, 'download'])->name('kontrak.download');
 Route::post('pedagang/jadwaljanji', [ApplyJadwalJanjiController::class, 'store'])->name('pedagang.jadwaljanji.store');
 Route::get('pedagang/jadwaljanji', [ApplyJadwalJanjiController::class, 'index'])->name('pedagang.jadwaljanji.index');
   
});
Route::middleware(['auth', 'managerMiddleware'])->group(function () {
    Route::get('/manager/dashboard', [ManagerDashboardController::class, 'index'])->name('manager.dashboard');
    Route::get('/manager/kios', [ManagerDashboardController::class, 'showKios'])->name('manager.kios');
    Route::get('/manager/kios/available', [ManagerDashboardController::class, 'showAvailableKios'])->name('manager.kios.available');
    Route::get('/manager/kios/occupied', [ManagerDashboardController::class, 'showOccupiedKios'])->name('manager.kios.occupied');
    Route::get('/manager/kios/filter', [ManagerDashboardController::class, 'filterByPasar'])->name('manager.kios.filter');
    Route::get('manager/pembayaran', [ManagerDashboardController::class, 'showPembayaran'])->name('manager.pembayaran');
   
});
Route::middleware(['auth', 'adminMiddleware'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/kios', [KiosController::class, 'index'])->name('admin.kios');
    Route::get('/admin/kios/create', [KiosController::class, 'create'])->name('admin.kios.create');
    Route::post('/admin/kios', [KiosController::class, 'store'])->name('admin.kios.store');
    Route::put('/admin/kios/{id}', [KiosController::class, 'update'])->name('admin.kios.update');
    Route::delete('/admin/kios/{id}', [KiosController::class, 'destroy'])->name('admin.kios.destroy');
    Route::get('/admin/kontrak', [ShowKontrakController::class, 'index'])->name('admin.kontrak');
    Route::post('/admin/kontrak/{kontrak}/approve', [ShowKontrakController::class, 'approve'])->name('admin.kontrak.approve');
    Route::get('/admin/kontrak/history', [ShowKontrakController::class, 'history'])->name('admin.kontrak.history');
    Route::get('/admin/jadwaljanji', [JadwalJanjiController::class, 'index'])->name('admin.jadwaljanji.index');
    Route::post('/admin/jadwaljanji/{id}/approve', [JadwalJanjiController::class, 'approve'])->name('admin.jadwaljanji.approve');
    Route::post('/admin/jadwaljanji/{id}/reject', [JadwalJanjiController::class, 'reject'])->name('admin.jadwaljanji.reject');
    Route::get('/admin/jadwaljanji/history', [JadwalJanjiController::class, 'history'])->name('admin.jadwaljanji.history');


   
});
Route::middleware(['auth', 'staffMiddleware'])->group(function () {
    Route::get('/staff/dashboard', [StaffDashboardController::class, 'index'])->name('staff.dashboard');
    Route::get('/staff/pembayaran', [StaffPembayaranController::class, 'index'])->name('staff.pembayaran.index');
    Route::get('/staff/pembayaran/history', [StaffPembayaranController::class, 'history'])->name('staff.pembayaran.history');
    Route::post('/staff/pembayaran/{pembayaran}/approve', [StaffPembayaranController::class, 'approve'])->name('staff.pembayaran.approve');
    Route::post('/staff/pembayaran/{pembayaran}/reject', [StaffPembayaranController::class, 'reject'])->name('staff.pembayaran.reject');
   
});
Route::middleware(['auth', ])->group(function () {
    Route::get('dashboard', [PedagangDashboardController::class, 'index'])->name('dashboard');
    
   
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
