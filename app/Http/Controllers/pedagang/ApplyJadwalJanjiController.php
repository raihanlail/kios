<?php

namespace App\Http\Controllers\pedagang;

use App\Http\Controllers\Controller;
use App\Models\JadwalJanji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;




class ApplyJadwalJanjiController extends Controller
{
  public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'sewa_id' => 'required|exists:sewas,id',
            'tanggal' => 'required|date|unique:jadwal_janjis,tanggal',
        ]);

        $existingAppointment = JadwalJanji::where('tanggal', $validated['tanggal'])->first();
        
        if ($existingAppointment) {
            return redirect()->back()->with('error', 'Tanggal tersebut sudah dipilih oleh user lain. Silakan pilih tanggal lain.');
        }

        $jadwalJanji = JadwalJanji::create([
            'sewa_id' => $validated['sewa_id'],
            'tanggal' => $validated['tanggal'],
            'status' => 'pending'
        ]);

        return redirect()->route('pedagang.jadwaljanji.index')->with('success', 'Jadwal janji berhasil dibuat.');
        
    } catch (\Illuminate\Validation\ValidationException $e) {
        return redirect()->back()
            ->withErrors($e->validator)
            ->with('error', 'Tanggal ini tidak tersedia. Silahkan pilih tanggal lain');
    }
}

    public function index()
    {
        $jadwalJanjis = JadwalJanji::with('sewa')
            ->whereHas('sewa', function($query) {
                $query->where('pedagang_id', Auth::id());
            })
            ->latest()
            ->get();
        return view('pedagang.jadwal-janji', compact('jadwalJanjis'));
    }
}
