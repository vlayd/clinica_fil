<?php
namespace App\Filament\Resources\Employes\Tables;

use App\Filament\Resources\Helpers\TableHelper;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
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
                TableHelper::columnImage(),
                TableHelper::columnName(),
                TableHelper::columnCpf(),
                TableHelper::columnEmail(),
                TableHelper::columnBirthDiffDays(),
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
