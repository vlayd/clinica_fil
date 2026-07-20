<?php

namespace App\Filament\Resources\Employes\Pages;

use App\Filament\Resources\Employes\EmployeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Override;

class ViewEmploye extends ViewRecord
{
    protected static string $resource = EmployeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }

    #[Override]
    protected function resolveRecord(int|string $key): Model
    {
        return parent::resolveRecord(Crypt::decryptString($key));
    }
}
