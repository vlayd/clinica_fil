<?php

namespace App\Filament\Resources\Employes\Schemas;

use App\Enums\UserStatus;
use App\Filament\Resources\Helpers\FormHelper;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class EmployeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
                Section::make('Detalhes Pessoais')
                    ->schema([
                        FormHelper::inputImageUpload(),
                        Group::make([
                            TextInput::make('name')
                                ->required()
                                ->label('Nomes'),
                            FormHelper::inputCpf(),
                            TextInput::make('birth')
                                ->type('date')
                                ->label('Nascimento'),
                        ])->columns(3),
                    ]),
                Section::make('Contatos')
                    ->schema([
                        Group::make([
                            FormHelper::fieldAddressViaCep()
                        ]),
                    ]),
                Section::make('Informações de Acesso')
                    ->schema([
                        Group::make([
                            FormHelper::inputEmail(),
                            ToggleButtons::make('active')->label('Usuário')->default(UserStatus::Não)->inline()
                                ->options(UserStatus::class),
                        ])->columns(2),
                    ]),
                Hidden::make('password')
                    ->dehydrateStateUsing(function ($state, Get $get) {
                        // Garante que o dado salvo não seja nulo caso o usuário não interaja
                        return $state ?? preg_replace('/[^0-9]/', '', $get('cpf'));
                    }),
                Hidden::make('rule')
                    ->dehydrateStateUsing(function ($state) {
                        // Garante que o dado salvo não seja nulo caso o usuário não interaja
                        return $state ?? 2;
                    }),
            ]);
    }
}
