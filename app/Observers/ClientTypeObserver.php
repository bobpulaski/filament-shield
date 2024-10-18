<?php

namespace App\Observers;

use App\Models\ClientType;

class ClientTypeObserver
{
    /**
     * Handle the ClientType "created" event.
     */
    public function creating(ClientType $clientType): void
    {
        if (auth()->hasUser()) {
            $clientType->user_id = auth()->id();
        }
    }

    /**
     * Handle the ClientType "updated" event.
     */
    public function updated(ClientType $clientType): void
    {
        //
    }

    /**
     * Handle the ClientType "deleted" event.
     */
    public function deleted(ClientType $clientType): void
    {
        //
    }

    /**
     * Handle the ClientType "restored" event.
     */
    public function restored(ClientType $clientType): void
    {
        //
    }

    /**
     * Handle the ClientType "force deleted" event.
     */
    public function forceDeleted(ClientType $clientType): void
    {
        //
    }
}
