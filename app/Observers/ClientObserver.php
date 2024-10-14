<?php

namespace App\Observers;

use App\Models\Client;

class ClientObserver
{
    /**
     * Handle the Client "creatING" event.
     */
    public function creating(Client $client): void
    {
        if (auth()->hasUser()) {
            $client->user_id = auth()->id();
        }
    }

    public function created(Client $client): void
    {

    }

    /**
     * Handle the Client "updatED" event.
     */
    public function updated(Client $client): void
    {
        //
    }

    /**
     * Handle the Client "deleted" event.
     */
    public function deleted(Client $client): void
    {
        //
    }

    /**
     * Handle the Client "restored" event.
     */
    public function restored(Client $client): void
    {
        //
    }

    /**
     * Handle the Client "force deleted" event.
     */
    public function forceDeleted(Client $client): void
    {
        //
    }
}
