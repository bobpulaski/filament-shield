<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use Filament\Actions;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\CreateRecord;

class CreateClient extends CreateRecord
{
    protected static string $resource = ClientResource::class;

    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     $data['user_id'] = auth()->id(); // Сохранение ID текущего пользователя
    //     return $data;
    // }
}
