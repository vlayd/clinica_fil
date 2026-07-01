<?php
namespace App\Filament\Resources\Employes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class EmployesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->whereNot('id', Auth::id())->whereNot('rule', 0))
            ->columns([
                ImageColumn::make('photo')
                    ->disk('public')
                    ->label('Foto')
                    ->circular()
                    ->alignCenter(),
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
            ->recordActions([
                ViewAction::make()->label('')->iconButton()->color('primary'),
                EditAction::make()->label('')->iconButton()->color('warning'),
                DeleteAction::make()->label('')->iconButton()->color('danger'),
                RestoreAction::make()->label('')->iconButton()->color('danger'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
