<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalJanji extends Model
{
    protected $table = 'jadwal_janjis';
    protected $fillable = ['sewa_id', 'status', 'tanggal'];

    public function sewa()
    {
        return $this->belongsTo(Sewa::class);
    }
}
