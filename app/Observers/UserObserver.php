<?php

namespace App\Observers;

use App\Models\User;
use App\Models\ClientType;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {

        $clientTypes = [
            ['user_id' => $user->id, 'type' => 'Клиент', 'weight' => 1],
            ['user_id' => $user->id, 'type' => 'Поставщик', 'weight' => 2],
            ['user_id' => $user->id, 'type' => 'Конкурент', 'weight' => 3],
            ['user_id' => $user->id, 'type' => 'Партнер', 'weight' => 4],
            ['user_id' => $user->id, 'type' => 'Другое', 'weight' => 5],
        ];

        // Пакетное создание записей
        ClientType::insert($clientTypes);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
