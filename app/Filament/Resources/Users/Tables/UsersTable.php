<?php

namespace App\Filament\Resources\Users\Tables;

use App\Filament\Resources\Helpers\TableHelper;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
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
                TextColumn::make('name')
                    ->label('Nome'),
                TextColumn::make('email')
                    ->label('E-mail'),
                ToggleColumn::make('active')
                    ->label('Ativo')
                    ->alignCenter(),
                    // ->badge()
                    // ->color(fn(bool $state): string => $state ? 'success' : 'danger')
                    // ->formatStateUsing(fn(bool $state): string => $state ? 'Sim' : 'Não'),
                TextColumn::make('created_at')
                    ->label('Data de criação')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Data de atualização')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
