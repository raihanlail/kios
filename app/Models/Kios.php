<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kios extends Model
{
    protected $fillable = [
        'pasar_id',
        'nama_kios',
        'lokasi',
        'description',
        'ukuran',
        'harga_sewa',
        'status',
        'image',
        'created_at',
        'updated_at',
    ];

    public function pasar()
    {
        return $this->belongsTo(Pasar::class, 'pasar_id', 'id');
    }

    public function sewa()
    {
        return $this->hasOne(Sewa::class, 'kios_id', 'id');
    }
}
