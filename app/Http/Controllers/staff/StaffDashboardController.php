<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
use App\Models\Kios;
use App\Models\Pembayaran;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;


class StaffDashboardController extends Controller
{
    public function index()
    {
        $pending_pembayaran = Pembayaran::where('status', 'pending')->count();
        $verified_pembayaran = Pembayaran::where('status', 'verified')->count();
        $total_pembayaran = Pembayaran::count();
        $total_pendapatan = Pembayaran::where('status', 'verified')->sum('jumlah');

        return view('staff.dashboard', compact('pending_pembayaran', 'verified_pembayaran', 'total_pembayaran', 'total_pendapatan'));
    }
    public function generateReport()
    {
        return view('staff.generate-report');
    }

    public function show()
    {
        return view('staff.show');
    }

    public function edit()
    {
        return view('staff.edit');
    }

    public function update()
    {
        return view('staff.update');
    }
}
