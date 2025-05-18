<?php

namespace App\Observers;

use App\Models\Sewa;

class SewaObserver
{
    /**
     * Handle the Sewa "created" event.
     */
    public function created(Sewa $sewa): void
    {
        //
    }
    public function updating(Sewa $sewa)
    {
        // Cek jika tanggal_selesai adalah hari ini dan status masih approved
        if ($sewa->isDirty('tanggal_selesai') && 
            $sewa->tanggal_selesai->isToday() && 
            $sewa->status === 'approved') {
            $sewa->status = 'pending';
        }
    }

    /**
     * Handle the Sewa "updated" event.
     */
    public function updated(Sewa $sewa): void
    {
        //
    }

    /**
     * Handle the Sewa "deleted" event.
     */
    public function deleted(Sewa $sewa): void
    {
        //
    }

    /**
     * Handle the Sewa "restored" event.
     */
    public function restored(Sewa $sewa): void
    {
        //
    }

    /**
     * Handle the Sewa "force deleted" event.
     */
    public function forceDeleted(Sewa $sewa): void
    {
        //
    }
}
