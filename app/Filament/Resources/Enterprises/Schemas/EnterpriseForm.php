<?php

namespace App\Filament\Resources\Enterprises\Schemas;

use App\Filament\Resources\Helpers\FormHelper;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EnterpriseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                FormHelper::inputCnpj(),
                TextInput::make('inscricao_estadual'),
                TextInput::make('inscricao_municipal'),
                FormHelper::inputEmail(),
                TextInput::make('phone')
                    ->tel(),
                TextInput::make('logo'),
                TextInput::make('logo_report'),
                TextInput::make('icon'),
                TextInput::make('active')
                    ->required()
                    ->numeric()
                    ->default(1),
                TextInput::make('street'),
                TextInput::make('number'),
                TextInput::make('complement'),
                TextInput::make('neighborhood'),
                TextInput::make('city'),
                TextInput::make('state'),
                TextInput::make('zip_code'),
                TextInput::make('social_links'),
            ]);
    }
}
