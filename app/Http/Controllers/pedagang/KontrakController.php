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
      

        $path = storage_path('app/public/' . $kontrak->file_kontrak);
        
        return response()->download($path, 'kontrak-sewa-' . $kontrak->sewa_id . '.pdf');
    }
}
