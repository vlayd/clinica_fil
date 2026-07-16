<?php

namespace App\Filament\Resources\Roles;

use App\Filament\Resources\Helpers\TableHelper;
use App\Filament\Resources\Roles\Pages\ListRoles;
use BezhanSalleh\FilamentShield\Resources\Roles\Pages\CreateRole;
use BezhanSalleh\FilamentShield\Resources\Roles\Pages\EditRole;
// use BezhanSalleh\FilamentShield\Resources\Roles\Pages\ListRoles;
use BezhanSalleh\FilamentShield\Resources\Roles\Pages\ViewRole;
use BezhanSalleh\FilamentShield\Support\Utils;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use BezhanSalleh\FilamentShield\Resources\Roles\RoleResource as RolesRoleResource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RoleResource extends RolesRoleResource
{
    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->whereNot('name', 'super_admin'))
            ->columns([
                TextColumn::make('name')
                    ->weight(FontWeight::Medium)
                    ->label(__('filament-shield::filament-shield.column.name'))
                    ->formatStateUsing(fn (string $state): string => Str::headline($state))
                    ->searchable(),
                TextColumn::make('guard_name')
                    ->badge()
                    ->color('warning')
                    ->label(__('filament-shield::filament-shield.column.guard_name')),
                TextColumn::make('team.name')
                    ->default('Global')
                    ->badge()
                    ->color(fn (mixed $state): string => str($state)->contains('Global') ? 'gray' : 'primary')
                    ->label(__('filament-shield::filament-shield.column.team'))
                    ->searchable()
                    ->alignCenter()
                    ->visible(fn (): bool => static::shield()->isCentralApp() && Utils::isTenancyEnabled()),
                TextColumn::make('permissions_count')
                    ->badge()
                    ->label(__('filament-shield::filament-shield.column.permissions'))
                    ->counts('permissions')
                    ->alignCenter()
                    ->color('primary'),
                TableHelper::columnUpdatedAt(),
            ])
            ->filters([
                //
            ])
            ->recordActions(TableHelper::recordActions())
            ->toolbarActions([
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRoles::route('/'),
            'create' => CreateRole::route('/create'),
            'edit' => EditRole::route('/{record}/edit'),
            'view' => ViewRole::route('/{record}'),
        ];
    }
}
