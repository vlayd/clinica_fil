<?php
namespace App\Filament\Resources\Employes\Tables;

use App\Filament\Resources\Helpers\TableHelper;
use App\Models\User;
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
        dd(Auth::user()->getAllPermissions()->pluck('name')->toArray());
        // dd(Auth::user()->getRoleNames()->implode(','));
        // dd(Auth::user()->can('ResetPassword:User'));
        $user = new User;
        $action = $user->getActions('EmployesTable');
        // dd($action);

        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->whereNot('id', Auth::id())->whereNot('type', 0))
            ->columns([
                TableHelper::columnImage(),
                TableHelper::columnName(),
                TableHelper::columnEmail(),
                TableHelper::columnActiveToggle(),
                TableHelper::columnCpf()->toggleable(isToggledHiddenByDefault: true),
                TableHelper::columnBirth()->toggleable(isToggledHiddenByDefault: true),
                // TableHelper::columnBirthDiffDays()->toggleable(isToggledHiddenByDefault: true),
                // TableHelper::columnBirthAge()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions(TableHelper::recordActions($action))
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
