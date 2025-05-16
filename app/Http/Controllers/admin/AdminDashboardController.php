<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalJanji;
use App\Models\Kios;
use App\Models\KontrakDigital;
use Illuminate\Http\Request;




class AdminDashboardController extends Controller
{
    public function index()
    {
        $available_kios = Kios::where('status', 'available')->get();
        $occupied_kios = Kios::where('status', 'occupied')->get();
        $accepted_contracts = KontrakDigital::whereNotNull('file_kontrak')->count();
        $pending_contracts = KontrakDigital::whereNull('file_kontrak')->count();
        $accepted_jadwal = JadwalJanji::where('status', 'accepted')->count();
        $pending_jadwal = JadwalJanji::where('status', 'pending')->count();
        $count_available = $available_kios->count();
        $count_occupied = $occupied_kios->count();


        return view('admin.dashboard', compact('available_kios', 'occupied_kios', 'count_available', 'count_occupied', 'accepted_contracts', 'pending_contracts', 'accepted_jadwal', 'pending_jadwal'));
        
    }

    public function show()
    {
        return view('admin.show');
    }

    public function edit()
    {
        return view('admin.edit');
    }

    public function update()
    {
        return view('admin.update');
    }
}
