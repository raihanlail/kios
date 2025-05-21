<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
use App\Models\Kios;
use App\Models\KontrakDigital;
use App\Models\Pembayaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Storage;




class StaffPembayaranController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::with(['sewa', 'sewa.pedagang'])
            ->where('status', 'pending')
            ->latest()
            ->paginate(10);

        return view('staff.data', compact('pembayaran'));
    }

    public function history()
    {
        $pembayaran = Pembayaran::with(['sewa', 'sewa.pedagang'])
            ->latest()
            ->paginate(10);

        return view('staff.history', compact('pembayaran'));
    }
    public function downloadHistoryPdf()
{
    $pembayaran = Pembayaran::with(['sewa', 'sewa.pedagang'])
        ->latest()
        ->get(); // Gunakan get() bukan paginate() untuk semua data

    $pdf = Pdf::loadView('pdf.staff', compact('pembayaran'));
    
    return $pdf->download('laporan-pembayaran-'.now()->format('Y-m-d').'.pdf');
}

    public function approve(Pembayaran $pembayaran)
    {
        // Validasi admin
        if (!Auth::check() || Auth::user()->role !== 'staff') {
            abort(403);
        }

        DB::transaction(function () use ($pembayaran) {
            // Update status pembayaran
            $pembayaran->update(['status' => 'verified']);
            
            // Update status sewa
           // $pembayaran->sewa->update(['status' => 'approved']);

            // Buat kontrak digital
            KontrakDigital::create([
                'sewa_id' => $pembayaran->sewa_id,
                'admin_id' => auth()->user()->id,
                'isi_kontrak' => null,
                'file_kontrak' => null,
                'status' => 'active'
            ]);

            // TODO: Kirim notifikasi ke pedagang
        });

        return redirect()->route('staff.pembayaran.index')
            ->with('success', 'Pembayaran berhasil disetujui dan kontrak telah dibuat');
    }

    public function reject(Request $request, Pembayaran $pembayaran)
    {
        $pembayaran->update([
            'status' => 'rejected',
            'catatan_admin' => $request->catatan
        ]);

        return back()->with('success', 'Pembayaran ditolak');
    }

    
    }

