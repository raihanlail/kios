<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontrakDigital extends Model
{
    
    protected $fillable = [
        'sewa_id',
        'admin_id',
        'isi_kontrak',
        'file_kontrak',
        'status',
        'manager_acc'
    ];

    public function sewa()
    {
        return $this->belongsTo(Sewa::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
