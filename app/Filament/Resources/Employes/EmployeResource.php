<?php

namespace App\Filament\Resources\Employes;

use App\Filament\Resources\Employes\Pages\CreateEmploye;
use App\Filament\Resources\Employes\Pages\EditEmploye;
use App\Filament\Resources\Employes\Pages\ListEmployes;
use App\Filament\Resources\Employes\Pages\ViewEmploye;
use App\Filament\Resources\Employes\Schemas\EmployeForm;
use App\Filament\Resources\Employes\Schemas\EmployeInfolist;
use App\Filament\Resources\Employes\Tables\EmployesTable;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;
use Override;

class EmployeResource extends Resource
{
    protected static ?string $model = User::class;

    // protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string|BackedEnum|null $navigationIcon = 'fas-hospital-user';

    protected static ?string $recordTitleAttribute = 'name';

   protected static string|UnitEnum|null $navigationGroup = 'Pessoas';

    protected static ?int $navigationSort = 2;

    public static function getModelLabel(): string
    {
        return 'Funcionários';
    }

    public static function form(Schema $schema): Schema
    {
        return EmployeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return EmployeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EmployesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEmployes::route('/'),
            'create' => CreateEmploye::route('/create'),
            'view' => ViewEmploye::route('/{record}'),
            'edit' => EditEmploye::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
