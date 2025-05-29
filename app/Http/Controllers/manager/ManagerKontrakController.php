<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use App\Models\BuktiKontrak;
use App\Models\KontrakDigital;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ManagerKontrakController extends Controller
{
    public function index()
    {
        $kontrak = KontrakDigital::with(['sewa', 'sewa.pedagang'])
            ->whereHas('sewa', function($query) {
                $query->where('status', 'approved');
            })
            ->where('manager_acc', 'pending')
            ->latest()
            ->paginate(10);

        return view('manager.kontrak', compact('kontrak'));
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

    public function approve( Request $request, KontrakDigital $kontrak )
    {
        $kontrak->update([
            'manager_acc' => 'accepted'
        ]);
         return redirect()->route('manager.kontrak')
            ->with('success', 'kontrak berhasil disetujui ');

    }
    public function download(KontrakDigital $kontrak)
    {
        $path = storage_path('app/public/' . $kontrak->file_kontrak);
        
        return response()->download($path, 'kontrak-sewa-' . $kontrak->sewa_id . '.pdf');
    }

    

}
