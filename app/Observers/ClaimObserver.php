<?php

namespace App\Observers;

use App\Models\Claim;

class ClaimObserver
{
    /**
     * Handle the Claim "created" event.
     */
    public function created(Claim $claim): void
    {
        $claim->runAiValidation(); 
    }

    /**
     * Handle the Claim "updated" event.
     */
    public function updated(Claim $claim): void
    {
       
    }

    /**
     * Handle the Claim "deleted" event.
     */
    public function deleted(Claim $claim): void
    {
        //
    }

    /**
     * Handle the Claim "restored" event.
     */
    public function restored(Claim $claim): void
    {
        //
    }

    /**
     * Handle the Claim "force deleted" event.
     */
    public function forceDeleted(Claim $claim): void
    {
        //
    }
}
