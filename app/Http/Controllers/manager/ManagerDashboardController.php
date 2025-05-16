<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use App\Models\Kios;
use App\Models\Pasar;
use App\Models\Pembayaran;
use App\Models\Sewa;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class ManagerDashboardController extends Controller
{
    public function index(Request $request)
{
    $pasars = Pasar::all();
    $pasar_id = $request->input('pasar_id');

    // Query dasar untuk semua kios
    $kiosQuery = Kios::query();
    
    // Filter jika pasar dipilih
    if ($pasar_id) {
        $kiosQuery->where('pasar_id', $pasar_id);
    }

    // Hitung statistik
    $totalKios = $kiosQuery->count();
    $kiosTerjual = $kiosQuery->clone()->whereHas('sewa', function($q) {
        $q->where('status', 'approved');
    })->count();
    $kiosTersedia = $totalKios - $kiosTerjual;

    // Hitung pendapatan dengan filter
    $totalPendapatan = Pembayaran::when($pasar_id, function($q) use ($pasar_id) {
            $q->whereHas('sewa.kios', function($q) use ($pasar_id) {
                $q->where('pasar_id', $pasar_id);
            });
        })
        ->where('status', 'verified')
        ->sum('jumlah');

    return view('manager.dashboard', compact(
        'totalKios',
        'kiosTerjual',
        'kiosTersedia',
        'totalPendapatan',
        'pasars',
        'pasar_id'
    ));
}

    public function showKios()
    {
        $kios = Kios::with('pasar')->paginate(10);
        $pasars = Pasar::all();
        return view('manager.kios', compact('kios', 'pasars'));
    }

    public function showAvailableKios()
    {
        $kios = Kios::with('pasar')->where('status', 'available')->paginate(10);
        return view('manager.kios-available', compact('kios'));
    }
    public function showOccupiedKios()
    {
        $kios = Kios::with('pasar')->where('status', 'occupied')->paginate(10);
        return view('manager.kios-occupied', compact('kios'));
    }

    public function filterByPasar(Request $request)
{
   
    $pasars = Pasar::all();
    $pasar_id = $request->input('pasar_id');
    
    $query = Kios::with('pasar');
    
    if ($pasar_id) {
        $query->where('pasar_id', $pasar_id);
    }
    
    $available_kios = $query->clone()->where('status', 'available')->get();
    $occupied_kios = $query->clone()->where('status', 'occupied')->get();

    return view('manager.kios', [
        
        'pasars' => $pasars,
        'available_kios' => $available_kios,
        'occupied_kios' => $occupied_kios,
        'selected_pasar' => $pasar_id
    ]);
}

 public function showPembayaran()
    {
        $pembayaran = Pembayaran::with(['sewa.kios.pasar', 'sewa.pedagang'])
            
            ->latest()
            ->paginate(10);

        return view('manager.pembayaran', compact('pembayaran'));
    }

    public function show()
    {
        return view('manager.show');
    }

    public function edit()
    {
        return view('manager.edit');
    }

    public function update()
    {
        return view('manager.update');
    }
}
