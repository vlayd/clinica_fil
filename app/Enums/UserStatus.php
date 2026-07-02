<?php

namespace App\Enums;

use BackedEnum;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;

enum UserStatus: string implements HasColor, HasIcon, HasLabel
{
    case Sim = '1';
    case Não = '0';

    public function getLabel(): string|Htmlable|null
    {
        return match ($this) {
            self::Sim => 'Sim',
            self::Não => 'Não',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Sim => 'success',
            self::Não => 'danger',
        };
    }

    public function getIcon(): string|BackedEnum|Htmlable|null
    {
        return match ($this) {
            self::Sim => Heroicon::OutlinedCheckCircle,
            self::Não => Heroicon::OutlinedXCircle,
        };
    }
}
