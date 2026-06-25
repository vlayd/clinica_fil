<?php

namespace App\Filament\Resources\Employes\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class EmployeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image')->disk('public')->directory('fotos/employes')->image()->label('Foto do Funcionário')
            ]);
    }
}
