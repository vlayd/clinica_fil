<?php

namespace App\Filament\Resources\Agreements;

use App\Filament\Resources\Agreements\Pages\CreateAgreement;
use App\Filament\Resources\Agreements\Pages\EditAgreement;
use App\Filament\Resources\Agreements\Pages\ListAgreements;
use App\Filament\Resources\Agreements\Pages\ViewAgreement;
use App\Filament\Resources\Agreements\Schemas\AgreementForm;
use App\Filament\Resources\Agreements\Schemas\AgreementInfolist;
use App\Filament\Resources\Agreements\Tables\AgreementsTable;
use App\Models\Agreement;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class AgreementResource extends Resource
{
    protected static ?string $model = Agreement::class;

    protected static string|BackedEnum|null $navigationIcon = 'fas-id-card';

    protected static ?string $recordTitleAttribute = 'name';

   protected static string|UnitEnum|null $navigationGroup = 'Gerenciar';

    protected static ?int $navigationSort = 3;

    public static function getModelLabel(): string
    {
        return 'Convênios';
    }

    public static function form(Schema $schema): Schema
    {
        return AgreementForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AgreementInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AgreementsTable::configure($table);
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
            'index' => ListAgreements::route('/'),
            // 'create' => CreateAgreement::route('/create'),
            'view' => ViewAgreement::route('/{record}'),
            // 'edit' => EditAgreement::route('/{record}/edit'),
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
