<?php

namespace App\Filament\Resources\Positions\Tables;

use App\Filament\Resources\Helpers\TableHelper;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class PositionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TableHelper::columnName(),
                TableHelper::columnDescription(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions(TableHelper::recordActions())
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                //     ForceDeleteBulkAction::make(),
                //     RestoreBulkAction::make(),
                // ]),
            ]);
    }
}
