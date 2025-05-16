<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasar extends Model
{
    

    protected $fillable = [
        'nama_pasar',
        'alamat',
        'no_telp',
        'jumlah_kios',
        'created_at',
        'updated_at',
    ];

    public function kios()
    {
        return $this->hasMany(Kios::class, 'pasar_id', 'id');
    }
}
