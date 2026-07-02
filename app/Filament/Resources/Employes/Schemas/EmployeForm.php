<?php

namespace App\Filament\Resources\Employes\Schemas;

use App\Enums\BrazilianState;
use App\Enums\UserStatus;
use App\Filament\Resources\Helpers\FormHelper;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
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
                                ->required()->type('date')
                                ->label('Nascimento'),
                        ])->columns(3),
                    ]),
                Section::make('Contatos')
                    ->schema([
                        Group::make([
                            Fieldset::make('Endereço')
                                ->schema([
                                    TextInput::make('address_cep')
                                        ->live(false)
                                        ->afterStateUpdated(function (?string $state, Set $set) {
                                            $cep = preg_replace('/[^0-9]/', '', $state);
                                            $url = "https://viacep.com.br/ws/{$cep}/json/";
                                            if (strlen($cep) === 8) {
                                                $response = file_get_contents($url);
                                                $data = json_decode($response, true);

                                                if (isset($data['logradouro'])) {
                                                    $set('address_logradouro', $data['logradouro']);
                                                }
                                                if (isset($data['bairro'])) {
                                                    $set('address_bairro', $data['bairro']);
                                                }
                                                if (isset($data['localidade'])) {
                                                    $set('address_cidade', $data['localidade']);
                                                }
                                                if (isset($data['uf'])) {
                                                    $set('address_uf', $data['uf']);
                                                }
                                            }
                                        })
                                        ->label('CEP')
                                        ->columnSpan(3),
                                    TextInput::make('address_logradouro')
                                        ->label('Logradouro')
                                        ->columnSpan(3),
                                    TextInput::make('address_bairro')
                                        ->label('Bairro')
                                        ->columnSpan(3),
                                    TextInput::make('address_cidade')
                                        ->label('Cidade')
                                        ->columnSpan(2),
                                    Select::make('address_uf')
                                        ->required()
                                        ->options(BrazilianState::class)
                                        ->label('UF')
                                        ->columnSpan(1)
                                ])->columns(6),
                        ]),
                    ]),
                Section::make('Informações de Acesso')
                    ->schema([
                        Group::make([
                            TextInput::make('email')
                                ->email()
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->label('E-mail'),
                            ToggleButtons::make('active')->label('Usuário')->default(UserStatus::Não)->inline()
                                ->options(UserStatus::class),
                        ])->columns(2),
                    ]),
                Hidden::make('password')->default(function (Get $get) {
                    // Se o valor do hidden atual for nulo, busca o valor do outro input
                    return $get('password') ?? preg_replace('/[^0-9]/', '', $get('cpf'));
                })
                    ->dehydrateStateUsing(function ($state, Get $get) {
                        // Garante que o dado salvo não seja nulo caso o usuário não interaja
                        return $state ?? preg_replace('/[^0-9]/', '', $get('cpf'));
                    }),
            ]);
    }
}
