<?php

namespace App\Filament\Resources\Helpers;

use App\Rules\CpfRule;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

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
            ->afterStateUpdated(function (?string $state, TextInput $component) {
                if (blank($state)) {
                    return;
                }
                // Remove caracteres não numéricos do CPF
                $cpf = preg_replace('/[^0-9]/', '', (string) $state);
                if (strlen($cpf) === 11) {
                    // Cria um validador manual do Laravel aplicando a sua Rule personalizada
                    $validator = Validator::make(
                        ['cpf' => $state],
                        ['cpf' => [new CpfRule]],
                    );
                    // dd($validator->fails());

                    if ($validator->fails()) {
                        $validator->fails("cpf inválido");
                        // Alvo correto: adiciona o erro diretamente no estado do Livewire associado a este campo
                        $component->getLivewire()->addError($component->getStatePath(), 'CPF inválido.');
                        return;
                    }
                    // Remove erros anteriores caso o usuário corrija o CPF depois de errar
                    $component->getLivewire()->resetErrorBag($component->getStatePath());
                }
            })
            ->validationMessages([
                'cpf' => 'CPF inválido.',
            ])
            ->disabledOn('edit')
            ->rule([new CpfRule]);
    }
}
