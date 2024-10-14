<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasColor;

enum ClientStatus: int implements HasLabel, HasColor, HasIcon
{
    case New = 1;
    case Progress = 2;
    case Active = 3;
    case Lost = 4;
    case Returned = 5;
    case Foreign = 6;
    case Nontarget = 7;
    case Eliminated = 8;


        public function getLabel (): ?string
        {
            return match ($this) {
                self::New => 'Новый',
                self::Progress => 'В разработке',
                self::Active => 'Активный',
                self::Lost => 'Потерянный',
                self::Returned => 'Возвращенный',
                self::Foreign => 'Чужой',
                self::Nontarget => 'Нецелевой',
                self::Eliminated => 'Ликвидирован',
        };
    }

        public function getColor (): string | array | null
        {
            return match ($this) {
                self::New => Color::hex('#adb5bd'),
                self::Progress => Color::hex('#2d728f'),
                self::Active => Color::hex('#02c39a'),
                self::Lost => Color::hex('#dd1c1a'),
                self::Returned => Color::hex('#5c8001'),
                self::Foreign => Color::hex('#533e2d'),
                self::Nontarget => Color::hex('#bba0b2'),
                self::Eliminated => Color::hex('#ffee32'),
            };
        }

        public function getIcon(): ?string
        {
            return match ($this) {
                self::New => 'heroicon-o-stop',
                self::Progress => 'heroicon-o-eye',
                self::Active => 'heroicon-o-pencil',
                self::Lost => 'heroicon-o-x-mark',
                self::Returned => 'heroicon-o-arrow-uturn-left',
                self::Foreign => 'heroicon-o-divide',
                self::Nontarget => 'heroicon-o-question-mark-circle',
                self::Eliminated => 'heroicon-o-x-mark',
            };
        }
}
