<?php

namespace App\Filament\Resources\Users\Tables;

use App\Filament\Resources\Helpers\TableHelper;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->whereNot('id', Auth::id())->whereNot('password', null))
            ->columns([
                TableHelper::columnImage(),
                TableHelper::columnName(),
                TableHelper::columnEmail(),
                TableHelper::columnActiveToggle(),
                TableHelper::columnCreatedAt(),
                TableHelper::columnUpdatedAt(),
            ])
            ->filters([
                //
            ])
            ->recordActions(TableHelper::recordActions())
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
