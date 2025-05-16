<?php

namespace App\Http\Controllers\pedagang;
use App\Http\Controllers\Controller;

use App\Models\Kios;
use App\Models\Sewa;
use App\Models\Pembayaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SewaController extends Controller
{
    public function create(Kios $kios)
    {
        // Validasi ketersediaan kios dan hak akses
        if ($kios->status !== 'available') {
            return back()->with('error', 'Kios ini tidak tersedia untuk disewa');
        }

        return view('pedagang.sewa', [
            'kios' => $kios,
            'min_date' => now()->format('Y-m-d'),
            'max_date' => now()->addYear()->format('Y-m-d'),
            'user' => Auth::user() // Untuk pre-fill data user jika diperlukan
        ]);
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'kios_id' => 'required|exists:kios,id',
        'no_ktp' => 'required|numeric|digits:16',
        'no_telp' => 'required|numeric|digits_between:10,15',
        'tanggal_mulai' => 'required|date|after_or_equal:today',
        'durasi' => 'required|integer|min:1|max:12',
        'catatan' => 'nullable|string|max:500',
    ]);

    $kios = Kios::findOrFail($request->kios_id);
    $user = Auth::user();

    if ($kios->status !== 'available') {
        return back()->with('error', 'Maaf, kios ini sudah tidak tersedia')->withInput();
    }

    // KONVERSI DURASI KE INTEGER
    $durasi = (int)$request->durasi;
    
    $sewa = null;
    DB::transaction(function () use ($request, $kios, $user, $durasi, &$sewa) {
        $sewa = Sewa::create([
            'kios_id' => $kios->id,
            'pedagang_id' => $user->id,
            'no_ktp' => $request->no_ktp,
            'no_telp' => $request->no_telp,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => Carbon::parse($request->tanggal_mulai)
                                  ->addMonths($durasi),
            'status' => 'pending',
            'durasi' => (int)$request->durasi,
            'catatan' => $request->catatan,
        ]);

        
    });

    return redirect()->route('pembayaran.create', ['sewa_id' => $sewa->id])
                   ->with('success', 'Silahkan lanjutkan ke proses pembayaran');
}

public function index()
{
    $sewa = Sewa::where('pedagang_id', Auth::id())
        ->with(['kios', 'pembayaran'])
        ->orderBy('created_at', 'desc')
        ->get();

    return view('pedagang.sewa-data', [
        'sewa' => $sewa
    ]);
}
}