<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuktiKontrak extends Model
{
    protected $fillable = [
        'kontrak_id',
        'keterangan'
    ];

    public function kontrak()
    {
        return $this->belongsTo(KontrakDigital::class, 'kontrak_id');
    }
}
