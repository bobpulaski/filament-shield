<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Enums\ClientStatus;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

use App\Models\Scopes\UserRoomScope;
use App\Observers\ClientObserver;


#[ScopedBy([UserRoomScope::class])]
#[ObservedBy([ClientObserver::class])]

class Client extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => ClientStatus::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function persons(): HasMany
    {
        return $this->hasMany(Person::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(ClientType::class);
    }
}
