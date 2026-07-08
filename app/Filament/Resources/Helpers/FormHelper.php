<?php

namespace App\Filament\Resources\Helpers;

use App\Rules\CpfRule;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use App\Enums\BrazilianState;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Fieldset;
use Illuminate\Support\Facades\Validator;

class FormHelper
{
    public static function inputImageUpload()
    {
        return FileUpload::make('photo')
            ->imagePreviewHeight('350')
            ->disk('public')
            ->directory('users/photos')
            ->image()
            ->extraAttributes(['class' => 'w-1/6 mx-auto'])
            ->label('Foto');
    }

    public static function inputCpf()
    {
        return TextInput::make('cpf')
            ->required()
            ->label('CPF')->mask('999.999.999-99')
            ->live(debounce: 500)
            ->unique(ignoreRecord: true) // Adiciona a validação ao enviar o formulário, garantindo que o CPF seja único no banco de dados
            ->afterStateUpdated(function (?string $state, TextInput $component) {
                if (blank($state)) {
                    return;
                }
                // Remove caracteres não numéricos do CPF
                $cpf = preg_replace('/[^0-9]/', '', (string) $state);
                if (strlen($cpf) === 11) {
                    // Remove erros anteriores caso o usuário corrija o CPF depois de errar ou dispara outro erro
                    $component->getLivewire()->resetErrorBag($component->getStatePath());
                    // Cria um validador manual do Laravel aplicando a sua Rule personalizada
                    $validator = Validator::make(
                        ['cpf' => $state],
                        ['cpf' => [new CpfRule()]],
                    );

                    if ($validator->fails()) {
                        // Dispara o erro da Rule personalizada
                        $component->getLivewire()->addError($component->getStatePath(), $validator->errors()->first('cpf'));
                        return;
                    }
                }
            })
            ->validationMessages([
                'unique' => 'Este CPF já está cadastrado em nosso sistema.',
            ])
            ->disabledOn('edit')
            ->dehydrated(false)
            ->rule([new CpfRule]);
    }

    public static function fieldAddressViaCep()
    {
        return Fieldset::make('Endereço')
            ->schema([
                TextInput::make('zip_code')
                    ->live(false)
                    ->mask('99999-999')
                    ->afterStateUpdated(function (?string $state, Set $set) {
                        $cep = preg_replace('/[^0-9]/', '', $state);
                        $url = "https://viacep.com.br/ws/{$cep}/json/";
                        if (strlen($cep) === 8) {
                            $response = file_get_contents($url);
                            $data = json_decode($response, true);

                            if (isset($data['logradouro'])) {
                                $set('street', $data['logradouro']);
                            }
                            if (isset($data['bairro'])) {
                                $set('neighborhood', $data['bairro']);
                            }
                            if (isset($data['localidade'])) {
                                $set('city', $data['localidade']);
                            }
                            if (isset($data['uf'])) {
                                $set('state', $data['uf']);
                            }
                        }
                    })
                    ->label('CEP')
                    ->columnSpan(1),
                TextInput::make('street')
                    ->label('Logradouro')
                    ->columnSpan(4),
                TextInput::make('number')
                    ->label('Número')
                    ->columnSpan(1),
                TextInput::make('complement')
                    ->label('Complemento')
                    ->columnSpan(3),
                TextInput::make('neighborhood')
                    ->label('Bairro')
                    ->columnSpan(3),
                TextInput::make('city')
                    ->label('Cidade')
                    ->columnSpan(4),
                Select::make('state')
                    ->options(BrazilianState::class)
                    ->label('UF')
                    ->columnSpan(2)
            ])->columns(6);
    }

    public static function inputEmail()
    {
        return TextInput::make('email')
            ->email()
            ->required()
            ->unique(ignoreRecord: true)
            ->label('E-mail')
            ->validationMessages([
                'email' => 'E-mail inválido.',
                'unique' => 'Este e-mail já está em uso.',
            ]);
    }
}
