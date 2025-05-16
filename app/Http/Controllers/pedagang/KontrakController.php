<?php

namespace App\Http\Controllers\pedagang;

use App\Http\Controllers\Controller;
use App\Models\BuktiKontrak;
use App\Models\KontrakDigital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class KontrakController extends Controller
{
     public function download(KontrakDigital $kontrak)
    {
        // Pastikan user yang mengakses adalah pemilik sewa atau admin
         if (!Auth::check() || Auth::user()->role !== 'pedagang') {
            abort(403);
        }

        $path = storage_path('app/public/' . $kontrak->file_kontrak);
        
        return response()->download($path, 'kontrak-sewa-' . $kontrak->sewa_id . '.pdf');
    }
}
