<?php

namespace App\Filament\Resources\Positions\Schemas;

use App\Filament\Resources\Helpers\FormHelper;
use Filament\Schemas\Schema;

class PositionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
                FormHelper::inputName(),
                FormHelper::inputDescription(),
            ]);
    }
}
