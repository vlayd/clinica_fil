<?php
namespace App\Filament\Resources\Employes\Tables;

use App\Filament\Resources\Helpers\TableHelper;
use Filament\Tables\Filters\TrashedFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class EmployesTable
{
    public static function configure(Table $table): Table
    {
        // dd(Auth::user()->getAllPermissions()->pluck('name')->toArray());
        // dd(Auth::user()->getRoleNames()->implode(','));
        // dd(Auth::user()->can('ResetPassword:User'));
        // dd('teste');
        // $user = new User;
        // $action = $user->getActions('EmployesTable');
        // dd(auth()->user()->enterprise_id);

        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->where('enterprise_id', auth()->user()->enterprise_id)->whereNot('id', Auth::id())->whereNot('type', 0))
            ->columns([
                TableHelper::columnImage(),
                TableHelper::columnName(),
                TableHelper::columnEmail(),
                TableHelper::columnTextBadge('positions.name', 'Cargo'),
                TableHelper::columnTextBadge('enterprises.name', 'Tempo'),
                TableHelper::columnActiveToggle()
                    ->visible(Auth::user()->can('IsUser:Employe')),
                TableHelper::columnCpf()->toggleable(isToggledHiddenByDefault: true),
                TableHelper::columnBirth()->toggleable(isToggledHiddenByDefault: true),
                // TableHelper::columnBirthDiffDays()->toggleable(isToggledHiddenByDefault: true),
                // TableHelper::columnBirthAge()->toggleable(isToggledHiddenByDefault: true),
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
