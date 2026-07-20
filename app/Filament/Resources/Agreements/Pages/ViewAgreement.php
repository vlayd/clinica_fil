<?php

namespace App\Filament\Resources\Agreements\Pages;

use App\Filament\Resources\Agreements\AgreementResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAgreement extends ViewRecord
{
    protected static string $resource = AgreementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
