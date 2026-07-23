<?php

namespace App\Filament\Resources\Enterprises\Schemas;

use App\Models\Enterprise;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class EnterpriseInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('cnpj')
                    ->placeholder('-'),
                TextEntry::make('inscricao_estadual')
                    ->placeholder('-'),
                TextEntry::make('inscricao_municipal')
                    ->placeholder('-'),
                TextEntry::make('email')
                    ->label('Email address')
                    ->placeholder('-'),
                TextEntry::make('phone')
                    ->placeholder('-'),
                TextEntry::make('logo')
                    ->placeholder('-'),
                TextEntry::make('logo_report')
                    ->placeholder('-'),
                TextEntry::make('icon')
                    ->placeholder('-'),
                TextEntry::make('active')
                    ->numeric(),
                TextEntry::make('street')
                    ->placeholder('-'),
                TextEntry::make('number')
                    ->placeholder('-'),
                TextEntry::make('complement')
                    ->placeholder('-'),
                TextEntry::make('neighborhood')
                    ->placeholder('-'),
                TextEntry::make('city')
                    ->placeholder('-'),
                TextEntry::make('state')
                    ->placeholder('-'),
                TextEntry::make('zip_code')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Enterprise $record): bool => $record->trashed()),
            ]);
    }
}
