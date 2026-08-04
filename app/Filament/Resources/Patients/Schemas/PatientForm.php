<?php

namespace App\Filament\Resources\Patients\Schemas;

use App\Enums\UserStatus;
use App\Filament\Resources\Helpers\FormHelper;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextInputColumn;

class PatientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
                Section::make('Detalhes Pessoais')
                    ->schema([
                        FormHelper::inputImageUpload(),
                        FormHelper::inputGender()->extraAttributes([
                            'class' => 'flex justify-center items-center',
                        ]),
                        Group::make([
                            FormHelper::inputName(),
                            FormHelper::inputCpf(),
                            TextInput::make('birth')
                                ->type('date')
                                ->label('Nascimento'),
                        ])->columns(3),
                        Fieldset::make('Responsável')->columns(2)
                            ->relationship('responsible')
                                ->schema([
                                    FormHelper::inputDefault('name', 'Nome'),
                                    FormHelper::inputCpfDefault(),
                                ]),
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
                Section::make('Informações Importantes')
                    ->schema([
                        Group::make([
                            Select::make('agreements')
                            ->relationship('agreements', 'name')->multiple()->preload(),
                            Select::make('agreements')
                            ->relationship('agreements', 'name')->multiple()->preload(),
                        ])->columns(2),
                    ]),
                Hidden::make('password')
                    ->dehydrateStateUsing(function ($state, Get $get) {
                        // Garante que o dado salvo não seja nulo caso o usuário não interaja
                        return $state ?? preg_replace('/[^0-9]/', '', $get('cpf'));
                    }),
                Hidden::make('type')
                    ->dehydrateStateUsing(function ($state) {
                        // Garante que o dado salvo não seja nulo caso o usuário não interaja
                        return $state ?? 2;
                    }),
            ]);
    }
}
