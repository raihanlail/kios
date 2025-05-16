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
        $validated = $request->validate([
            'sewa_id' => 'required|exists:sewas,id',
            'tanggal' => 'required|date',
        ]);

        $jadwalJanji = JadwalJanji::create([
            'sewa_id' => $validated['sewa_id'],
            'tanggal' => $validated['tanggal'],
            'status' => 'pending'
        ]);

       return redirect()->route('pedagang.jadwaljanji.index')->with('success', 'Jadwal janji berhasil dibuat.');
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
