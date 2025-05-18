<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Sewa;
use Carbon\Carbon;
use Illuminate\Http\Request;



class ManageSewaController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->toDateString();
        
        $sewa = Sewa::with(['kios', 'pedagang'])
            ->where('status', 'approved')
            ->whereDate('tanggal_selesai', '<=', $today)
            ->orderBy('tanggal_selesai', 'asc')
            ->paginate(10);
            
        return view('admin.sewa', compact('sewa'));
    }
}
