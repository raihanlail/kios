<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use App\Models\Kios;
use App\Models\Pasar;
use App\Models\Pembayaran;
use App\Models\Sewa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



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

    public function showKios( Request $request)
    {
       $pasars = Pasar::all();
    $pasar_id = $request->input('pasar_id');
    
    $query = Kios::with('pasar');
    
    if ($pasar_id) {
        $query->where('pasar_id', $pasar_id);
    }
    
    $kios = $query->paginate(10);

    return view('manager.kios', [
        'kios' => $kios,
        'pasars' => $pasars,
        'selected_pasar' => $pasar_id
    ]);
    }

    public function showAvailableKios(Request $request)
    {
        $pasars = Pasar::all();
        $pasar_id = $request->input('pasar_id');
        
        $query = Kios::with('pasar')->where('status', 'available');
        
        if ($pasar_id) {
            $query->where('pasar_id', $pasar_id);
        }
        
        $kios = $query->paginate(10);

        return view('manager.kios-available', [
            'kios' => $kios,
            'pasars' => $pasars,
            'selected_pasar' => $pasar_id
        ]);
    }

    public function showOccupiedKios(Request $request)
    {
        $pasars = Pasar::all();
        $pasar_id = $request->input('pasar_id');
        
        $query = Kios::with('pasar')->where('status', 'occupied');
        
        if ($pasar_id) {
            $query->where('pasar_id', $pasar_id);
        }
        
        $kios = $query->paginate(10);

        return view('manager.kios-occupied', [
            'kios' => $kios,
            'pasars' => $pasars,
            'selected_pasar' => $pasar_id
        ]);
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
        $pembayaran = Pembayaran::with(['sewa.kios.pasar', 'sewa.pedagang', 'sewa.kontrak'])
            
            ->latest()
            ->paginate(10);

        return view('manager.pembayaran', compact('pembayaran'));
    }

     public function downloadHistoryPdf()
{
    $pembayaran = Pembayaran::with(['sewa', 'sewa.pedagang'])
        ->latest()
        ->get(); // Gunakan get() bukan paginate() untuk semua data

    $pdf = Pdf::loadView('pdf.staff', compact('pembayaran'));
    
    return $pdf->download('laporan-pembayaran-'.now()->format('Y-m-d').'.pdf');
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

    public function approve(Pembayaran $pembayaran)
    {
        if (!Auth::check() || Auth::user()->role !== 'manager') {
            abort(403);
        }

        // Update kontrak through pembayaran->sewa relationship
        $pembayaran->sewa->kontrak->update([
            'manager_id' => Auth::id(),
            'status' => 'active',
            'isi_kontrak' => $this->generateKontrakContent($pembayaran->sewa),
            'file_kontrak' => $this->generatePdfKontrak($pembayaran->sewa)
        ]);

        // Update status terkait
        $pembayaran->sewa->update(['status' => 'approved']);
        $pembayaran->sewa->kios->update(['status' => 'occupied']);

        return redirect()->route('manager.pembayaran')
            ->with('success', 'Pembayaran dan kontrak berhasil disetujui');
    }

    protected function generatePdfKontrak($sewa)
    {
        $pdf = Pdf::loadView('pdf.kontrak', [
            'sewa' => $sewa,
            'pedagang' => $sewa->pedagang,
            'kios' => $sewa->kios,
        ]);

        $filePath = "kontrak/kontrak-sewa-{$sewa->id}.pdf";
        Storage::disk('public')->put($filePath, $pdf->output());

        return $filePath;
    }

    protected function generateKontrakContent($sewa)
    {
        return "KONTRAK SEWA KIOS\n\n" .
               "Nomor: KONTRAK/{$sewa->id}\n" .
               "Harga sewa: Rp " . number_format($sewa->kios->harga_sewa, 0, ',', '.') . "/bulan";
    }
}
