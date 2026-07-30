<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum Gender: string implements HasLabel
{
    case Masculino = '1';
    case Ferminino = '2';

    public function getLabel(): string|Htmlable|null
    {
        return $this->name;
    }
}
