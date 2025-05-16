<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\KontrakDigital;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



class ShowKontrakController extends Controller
{
    public function index()
    {
        $kontrak = KontrakDigital::with(['sewa', 'sewa.pedagang'])
            ->whereNull('file_kontrak')
            ->latest()
            ->get();

        return view('admin.kontrak', compact('kontrak'));
    }

    public function history(Request $request)
{
    $search = $request->input('search');
    
    $kontrak = KontrakDigital::with(['sewa', 'sewa.pedagang'])
        ->whereNotNull('file_kontrak')
        ->when($search, function ($query) use ($search) {
            $query->whereHas('sewa.pedagang', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            })
            ->orWhereHas('sewa.kios', function ($q) use ($search) {
                $q->where('nama_kios', 'like', "%{$search}%")
                  ->orWhere('nomor_kios', 'like', "%{$search}%");
            })
            ->orWhereHas('sewa.kios.pasar', function ($q) use ($search) {
                $q->where('nama_pasar', 'like', "%{$search}%");
            });
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

    return view('admin.kontrak-history', compact('kontrak'));
}

    public function approve(KontrakDigital $kontrak)
{
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        abort(403);
    }

    // Update kontrak yang sudah ada
    $kontrak->update([
        'admin_id' => Auth::id(),
        'status' => 'active',
        'isi_kontrak' => $this->generateKontrakContent($kontrak),
        'file_kontrak' => $this->generatePdfKontrak($kontrak)
    ]);

    // Update status terkait
    $kontrak->sewa->update(['status' => 'approved']);
    $kontrak->sewa->kios->update(['status' => 'occupied']);

    return redirect()->route('admin.kontrak')
        ->with('success', 'Kontrak berhasil disetujui');
}

    protected function generatePdfKontrak($pembayaran)
    {
        $pdf = Pdf::loadView('pdf.kontrak', [
            'sewa' => $pembayaran->sewa,
            'pedagang' => $pembayaran->sewa->pedagang,
            'kios' => $pembayaran->sewa->kios,
        ]);

        // Simpan PDF ke storage
        $filePath = "kontrak/kontrak-sewa-{$pembayaran->sewa_id}.pdf";
        Storage::disk('public')->put($filePath, $pdf->output());

        return $filePath;
    }
   protected function generateKontrakContent($kontrak)
{
    return "KONTRAK SEWA KIOS\n\n" .
           "Nomor: KONTRAK/{$kontrak->sewa_id}\n" .
           
           
           
           "Harga sewa: Rp " . number_format($kontrak->sewa->kios->harga_sewa, 0, ',', '.') . "/bulan";
}
    public function download(KontrakDigital $kontrak)
    {
        // Pastikan user yang mengakses adalah pemilik sewa atau admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }

        $path = storage_path("app/public/{$kontrak->file_kontrak}");

        return response()->download($path, "kontrak-sewa-{$kontrak->sewa_id}.pdf");
    }
}
