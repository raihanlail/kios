<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sewa extends Model
{
    protected $fillable = [
        'kios_id',
        'pedagang_id',
        'no_ktp',
        'no_telp',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'durasi',
        'catatan',
    ];

    public function kios()
    {
        return $this->belongsTo(Kios::class);
    }

    public function pedagang()
    {
        return $this->belongsTo(User::class, 'pedagang_id');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }
    public function kontrak()
{
    return $this->hasOne(KontrakDigital::class);
}
}
