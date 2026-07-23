<?php

namespace App\Filament\Resources\Enterprises;

use App\Filament\Resources\Enterprises\Pages\CreateEnterprise;
use App\Filament\Resources\Enterprises\Pages\EditEnterprise;
use App\Filament\Resources\Enterprises\Pages\ListEnterprises;
use App\Filament\Resources\Enterprises\Pages\ViewEnterprise;
use App\Filament\Resources\Enterprises\Schemas\EnterpriseForm;
use App\Filament\Resources\Enterprises\Schemas\EnterpriseInfolist;
use App\Filament\Resources\Enterprises\Tables\EnterprisesTable;
use App\Models\Enterprise;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class EnterpriseResource extends Resource
{
    protected static ?string $model = Enterprise::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

   protected static string|UnitEnum|null $navigationGroup = 'Gerenciar';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return EnterpriseForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return EnterpriseInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EnterprisesTable::configure($table);
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
            'index' => ListEnterprises::route('/'),
            'create' => CreateEnterprise::route('/create'),
            'view' => ViewEnterprise::route('/{record}'),
            'edit' => EditEnterprise::route('/{record}/edit'),
        ];
    }
}
