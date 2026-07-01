<?php

namespace App\Filament\Resources\Employes\Schemas;

use App\Enums\BrazilianState;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rule;

class EmployeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
                Section::make('Detalhes Pessoais')
                    ->schema([
                        FileUpload::make('photo')->imagePreviewHeight('350')
                            ->disk('public')
                            // ->preserveFilenames() // Preserve the original file name
                            ->directory('users/fotos')
                            ->image()->extraAttributes(['class' => 'w-1/6 mx-auto'])
                            ->label('Foto'),
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
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->label('E-mail'),
                        TextInput::make('password')
                            ->password()
                            ->required()
                            ->label('Senha'),
                    ]),
            ]);
    }
}
