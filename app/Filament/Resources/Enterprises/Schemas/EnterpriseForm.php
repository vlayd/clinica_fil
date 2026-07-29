<?php

namespace App\Filament\Resources\Enterprises\Schemas;

use App\Filament\Resources\Helpers\FormHelper;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EnterpriseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
                Section::make('Dados da empresa')
                    ->schema([
                        Group::make([
                            FormHelper::inputImageUploadDefault('logo', 'Logo'),
                            FormHelper::inputImageUploadDefault('logo_report', 'Logo para Documentos'),
                            FormHelper::inputImageUploadDefault('icon', 'Ícone'),
                        ])->columns(3),
                        Group::make([
                            FormHelper::inputName(),
                            FormHelper::inputEmail(required: false),
                            FormHelper::inputPhone(),
                        ])->columns(3),
                        Group::make([
                            FormHelper::inputCnpj(),
                            FormHelper::inputDefault('inscricao_estadual', 'Inscrição Estadual'),
                            FormHelper::inputDefault('inscricao_municipal', 'Inscrição Municipal'),
                        ])->columns(3),
                        FormHelper::inputsAddressViaCep(),
                        FormHelper::repeatSocialLinks(),
                    ]),
            ]);
    }
}
