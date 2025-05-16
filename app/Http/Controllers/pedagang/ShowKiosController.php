<?php

namespace App\Http\Controllers\pedagang;

use App\Http\Controllers\Controller;
use App\Models\Kios;
use App\Models\Pasar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;




class ShowKiosController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pasars = Pasar::all(); // Tambahkan ini untuk mengambil semua pasar
        
        // Default: tampilkan semua kios tersedia
        $available_kios = Kios::with('pasar')
                            ->where('status', 'available')
                            ->get();
        
        $occupied_kios = Kios::with('pasar')
                           ->where('status', 'occupied')
                           ->get();

        return view('pedagang.kios', [
            'user' => $user,
            'pasars' => $pasars,
            'available_kios' => $available_kios,
            'occupied_kios' => $occupied_kios,
        ]);
    }

    // Tambahkan method untuk filter
   public function filterByPasar(Request $request)
{
    $user = Auth::user();
    $pasars = Pasar::all();
    $pasar_id = $request->input('pasar_id');
    
    $query = Kios::with('pasar');
    
    if ($pasar_id) {
        $query->where('pasar_id', $pasar_id);
    }
    
    $available_kios = $query->clone()->where('status', 'available')->get();
    $occupied_kios = $query->clone()->where('status', 'occupied')->get();

    return view('pedagang.kios', [
        'user' => $user,
        'pasars' => $pasars,
        'available_kios' => $available_kios,
        'occupied_kios' => $occupied_kios,
        'selected_pasar' => $pasar_id
    ]);
}

    public function show($id)
    {
        $kios = Kios::with('pasar')->findOrFail($id);
        return view('pedagang.kios-show', compact('kios'));
    }
}
