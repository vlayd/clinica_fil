<?php

namespace App\Filament\Resources\Enterprises\Tables;

use App\Filament\Resources\Helpers\TableHelper;
use Filament\Tables\Table;

class EnterprisesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TableHelper::columnName(searchable: false),
                TableHelper::columnCreatedAt(),
                ])
            ->filters([
                //
            ])
            ->recordActions(TableHelper::recordActions(['view', 'edit']))
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
