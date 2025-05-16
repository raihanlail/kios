<?php

namespace App\Http\Controllers\pedagang;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Sewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;






class PembayaranController extends Controller
{
    public function create(Request $request)
    {
        $sewa = Sewa::with('kios')
                   ->where('id', $request->sewa_id)
                   ->where('pedagang_id', Auth::id())
                   ->where('status', 'pending')
                   ->firstOrFail();

        return view('pedagang.bayar', [
            'sewa' => $sewa,
            'total_pembayaran' => $sewa->kios->harga_sewa * $sewa->durasi
        ]);
    }

public function store(Request $request)
{
    Log::debug('Pembayaran Request:', $request->all());
    
    try {
        $validator = Validator::make($request->all(), [
            'sewa_id' => 'required|exists:sewas,id',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'metode_pembayaran' => 'required|in:transfer,ewallet',
        ]);

        if ($validator->fails()) {
            Log::error('Validation Failed:', [
                'errors' => $validator->errors()->toArray(),
                'input' => $request->all()
            ]);
            return back()->withErrors($validator)->withInput();
        }

        Log::debug('Auth User:', [Auth::user()]);
        
        $sewa = Sewa::with(['kios', 'pedagang'])
            ->where('id', $request->sewa_id)
            ->where('pedagang_id', Auth::id())
            ->where('status', 'pending')
            ->first();

        if (!$sewa) {
            Log::error('Sewa Not Found or Invalid Status:', [
                'sewa_id' => $request->sewa_id,
                'user_id' => Auth::id(),
                'expected_status' => 'pending',
                'actual_status' => $sewa ? $sewa->status : null
            ]);
            return back()->with('error', 'Data sewa tidak valid atau status tidak sesuai')->withInput();
        }

        if (!$request->hasFile('bukti_pembayaran')) {
            Log::error('Bukti Pembayaran File Missing');
            return back()->with('error', 'File bukti pembayaran tidak ditemukan')->withInput();
        }

        $buktiFile = $request->file('bukti_pembayaran');
        if (!$buktiFile->isValid()) {
            Log::error('Invalid File Upload:', [
                'error' => $buktiFile->getErrorMessage()
            ]);
            return back()->with('error', 'File tidak valid: ' . $buktiFile->getErrorMessage())->withInput();
        }

        $buktiPath = $buktiFile->store('bukti_pembayaran', 'public');
        Log::debug('File Stored:', ['path' => $buktiPath]);

        $jumlah = $sewa->kios->harga_sewa * $sewa->durasi;
        $pembayaran = Pembayaran::create([
            'sewa_id' => $sewa->id,
            'jumlah' => $jumlah,
            'bukti_pembayaran' => $buktiPath,
            'status' => 'pending',
            'metode_pembayaran' => $request->metode_pembayaran,
            'tanggal_pembayaran' => now(),
            'catatan_admin' => "pembayaran dari pedagang {$sewa->pedagang->name}",
        ]);

        if (!$pembayaran) {
            throw new \Exception('Failed to create payment record');
        }

        if (!$sewa->update(['status' => 'pending'])) {
            throw new \Exception('Failed to update sewa status');
        }

        Log::info('Pembayaran Created Successfully:', [
            'pembayaran_id' => $pembayaran->id,
            'sewa_id' => $sewa->id,
            'jumlah' => $jumlah
        ]);

        return redirect()->route('pedagang.sewa.index')
            ->with('success', 'Pembayaran berhasil dikirim!');

    } catch (\Illuminate\Database\QueryException $e) {
        Log::error('Database Error:', [
            'error' => $e->getMessage(),
            'sql' => $e->getSql(),
            'bindings' => $e->getBindings()
        ]);
        return back()->with('error', 'Terjadi kesalahan database')->withInput();
    } catch (\Exception $e) {
        Log::error('Unexpected Error:', [
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]);
        return back()->with('error', 'Terjadi kesalahan sistem')->withInput();
    }
}
}
