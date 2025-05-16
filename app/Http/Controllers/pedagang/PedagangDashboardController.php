<?php

namespace App\Http\Controllers\pedagang;

use App\Http\Controllers\Controller;
use App\Models\Kios;
use App\Models\Pasar;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class PedagangDashboardController extends Controller
{
    public function index()
    {
        $pasars = Pasar::all();
        $user = Auth::user();

        return view('pedagang.dashboard', [
            'user' => $user,
            'pasars' => $pasars,
        ]);
    }
}
