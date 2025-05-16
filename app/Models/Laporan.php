<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $fillable = [
        'manager_id',
        'jenis_laporan',
        'tanggal_laporan',
        'isi_laporan',
        'file_laporan'
    ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
}
