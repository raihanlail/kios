<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalJanji;
use Illuminate\Http\Request;


class JadwalJanjiController extends Controller
{
    public function index()
    {
        $jadwalJanjis = JadwalJanji::with('sewa')->where('status', 'pending')->get();
        return view('admin.jadwal-janji', compact('jadwalJanjis'));
    }

    public function approve(Request $request, $id)
    {
        $jadwalJanji = JadwalJanji::findOrFail($id);
        $jadwalJanji->status = 'accepted';
        $jadwalJanji->save();

        return redirect()->route('admin.jadwaljanji.history')->with('success', 'Jadwal janji berhasil disetujui.');
    }

    public function reject(Request $request, $id)
    {
        $jadwalJanji = JadwalJanji::findOrFail($id);
        $jadwalJanji->status = 'rejected';
        $jadwalJanji->save();

        return redirect()->route('admin.jadwaljanji.history')->with('success', 'Jadwal janji berhasil ditolak.');
    }

    public function history()
    {
        $jadwalJanjis = JadwalJanji::with('sewa')->where('status', '!=', 'pending')->paginate(10);
        return view('admin.jadwal-janji-history', compact('jadwalJanjis'));
    }
}
