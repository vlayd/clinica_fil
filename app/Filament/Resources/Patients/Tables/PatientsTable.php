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
use Illuminate\Support\Facades\Auth;

class PatientsTable
{
    public static function configure(Table $table): Table
    {
        // dd(Auth::user()->can('IsUser:Patient'));
        $actions = ['view', 'edit', 'delete'];
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->where('type', 0))
            ->columns([
                TableHelper::columnImage(),
                TableHelper::columnName(),
                TableHelper::columnEmail(),
                TableHelper::columnActiveToggle()->visible(Auth::user()->can('IsUser:Patient')),
                TableHelper::columnCpf()->toggleable(isToggledHiddenByDefault: true),
                TableHelper::columnBirth()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions(TableHelper::recordActions($actions))
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                //     ForceDeleteBulkAction::make(),
                //     RestoreBulkAction::make(),
                // ]),
            ]);
    }
}
