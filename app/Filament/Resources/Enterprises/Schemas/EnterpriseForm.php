<?php

namespace App\Filament\Resources\Enterprises\Schemas;

use App\Filament\Resources\Helpers\FormHelper;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;

class EnterpriseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
        ->columns(null)
            ->components([
                Group::make([
                    FormHelper::inputImageUploadAvatar('logo', 'Logo'),
                    FormHelper::inputImageUploadAvatar('logo_report', 'Logo para Documentos'),
                    FormHelper::inputImageUploadAvatar('icon', 'Ícone'),
                ])->columns(3),
                TextInput::make('name')
                    ->required(),
                FormHelper::inputCnpj(),
                TextInput::make('inscricao_estadual'),
                TextInput::make('inscricao_municipal'),
                FormHelper::inputEmail(),
                TextInput::make('phone')
                    ->tel(),

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
