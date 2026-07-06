<?php

namespace App\Filament\Resources\Helpers;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;

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
            ->label('CPF')
            ->disabled(fn (Get $get) => !empty($get('cpf')));
    }
}
