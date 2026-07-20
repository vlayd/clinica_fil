<?php

namespace App\Filament\Resources\Agreements\Schemas;

use App\Filament\Resources\Helpers\FormHelper;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AgreementForm
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
