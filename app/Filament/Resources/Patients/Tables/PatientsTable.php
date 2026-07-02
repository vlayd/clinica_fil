<?php

namespace App\Filament\Resources\Patients\Tables;

use App\Filament\Resources\Helpers\TableHelper;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PatientsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->where('rule', 0))
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('cpf')
                    ->label('CPF')
                    ->alignCenter()
                    ->searchable(),
                TextColumn::make('birth')
                    ->label('Nascimento')
                    ->alignCenter()
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions(TableHelper::recordActions())
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
