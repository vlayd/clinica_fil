<?php

namespace App\Filament\Resources\Employes\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Gabrielmoura\LaravelCep\CepService;

class EmployeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
                Section::make('Detalhe do Pessoais')
                    ->schema([
                        FileUpload::make('image')
                            ->disk('public')
                            ->directory('fotos/employes')
                            ->image()
                            ->label('Foto do Funcionário'),
                        Group::make([
                            TextInput::make('name')
                                ->required()
                                ->label('Nomes'),
                            TextInput::make('cpf')
                                ->required()
                                ->label('CPF')
                                ->disabled(),
                            TextInput::make('birth')
                                ->required()->type('date')
                                ->label('Nascimento'),
                        ])->columns(4),
                    ]),
                Section::make('Contatos')
                    ->schema([
                        Group::make([
                            Fieldset::make('Endereço')
                                ->relationship('address')
                                ->schema([
                                    TextInput::make('cep')
                                        ->live(false)
                                        ->afterStateUpdated(function (?string $state, Set $set){
                                            if (strlen($state) === 8) {
                                            }
                                        })
                                        ->label('CEP'),
                                    TextInput::make('logradouro')
                                        ->label('Logradouro'),
                                    TextInput::make('bairro')
                                        ->label('Bairro'),
                                    TextInput::make('localidade')
                                        ->label('Cidade'),
                                ]),
                        ]),
                    ]),
            ]);
    }
}
