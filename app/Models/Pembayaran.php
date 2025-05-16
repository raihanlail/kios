<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'sewa_id',
        'staff_id',
        'jumlah',
        'bukti_pembayaran',
        'status',
        'metode_pembayaran',
        'tanggal_pembayaran',
        'catatan_admin',
    ];

    public function sewa()
    {
        return $this->belongsTo(Sewa::class);
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }
}
