<?php

namespace App\Filament\Resources\Helpers;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class TableHelper
{
    public static function recordActions()
    {
        return [
            ViewAction::make()->label('')->iconButton()->color('primary'),
            EditAction::make()->label('')->iconButton()->color('warning'),
            DeleteAction::make()->label('')->iconButton()->color('danger'),
            RestoreAction::make()->label('')->iconButton()->color('danger'),
        ];
    }

    public static function columnImage()
    {
        return ImageColumn::make('photo')->defaultImageUrl(url('storage/images/no-foto2.png'))
            ->disk('public')
            ->label('')
            ->circular()
            ->alignCenter()
            ->width('50px');
    }

    public static function columnName()
    {
        return TextColumn::make('name')
            ->label('Nome')
            ->searchable()
            ->sortable();
    }

    public static function columnCpf()
    {
        return TextColumn::make('cpf')
            ->label('CPF')
            ->searchable()
            ->alignCenter();
    }

    public static function columnEmail()
    {
        return TextColumn::make('email')
            ->label('E-mail')
            ->searchable()
            ->alignCenter();
    }

    public static function columnDefault(string $name, string $label, bool $center = false)
    {
        return TextColumn::make($name)
            ->label($label)
            ->alignCenter($center);
    }

    public static function columnDate(string $name, string $label)
    {
        return TextColumn::make($name)
            ->label($label)
            ->date('d/m/Y')
            ->alignCenter()
            ->sortable()
            ->searchable();
    }
}
