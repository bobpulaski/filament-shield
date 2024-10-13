<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasColor;

enum ClientStatus: int implements HasLabel
{
    case Open = 1;
    case Progress = 2;

        public function getLabel (): ?string
        {
            return match ($this) {
                self::Open => 'Новый',
                self::Progress => 'Progress',
        };
    }
}
