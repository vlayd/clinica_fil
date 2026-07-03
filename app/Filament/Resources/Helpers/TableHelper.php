<?php

namespace App\Filament\Resources\Helpers;

use Carbon\Carbon;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

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

    public static function columnCreatedAt()
    {
        return TextColumn::make('created_at')
            ->label('Data de criação')
            ->date('d/m/Y')
            ->alignCenter()
            ->sortable();
    }

    public static function columnUpdatedAt()
    {
        return TextColumn::make('updated_at')
            ->label('Data de atualização')
            ->alignCenter()
            ->isoDate('L');
    }

    public static function columnBirth()
    {
        return TextColumn::make('birth')
            ->label('Data de nascimento')
            ->alignCenter()
            ->since();
    }

    public static function columnBirthAge()
    {
        return TextColumn::make('birth')
            ->label('Idade')
            ->alignCenter()
            ->formatStateUsing(fn($state) => Carbon::parse($state)->age . ' anos');
    }

    public static function columnBirthDiffDays()
    {
        return TextColumn::make('birth')
            ->label('Aniversário')
            ->color(function ($state) {
                self::diffInDays($state)['color'];
            })
            ->alignCenter()
            ->formatStateUsing(function ($state) {
                return self::diffInDays($state)['text'];
            });
    }

    public static function columnActiveToggle()
    {
        return ToggleColumn::make('active')
            ->label('Ativo')
            ->alignCenter();
    }

    public static function columnActiveBadge()
    {
        return TextColumn::make('active')
            ->label('Ativo')
            ->alignCenter()
            ->color(fn(bool $state): string => $state ? 'success' : 'danger')
            ->formatStateUsing(fn(bool $state): string => $state ? 'Sim' : 'Não');
    }

    private static function diffInDays(string $state)
    {
        $diffInDaysCurrentYear = Carbon::parse($state)->setYear(Carbon::now()->year)->diffInDays(Carbon::now()->toDateString());
        $diffInDaysNextYear = Carbon::parse($state)->setYear(Carbon::now()->year)->addYear()->diffInDays(Carbon::now()->toDateString());
        if ($diffInDaysCurrentYear < 0) {
            if ($diffInDaysCurrentYear == -1) return ["text" => "É amanhã!", "color" => "danger"];
            return ["text" => "Faltam " . abs($diffInDaysCurrentYear) . " dias", "color" => "danger"];
        } else {
            if ($diffInDaysCurrentYear == 0) return ["text" => "Parabéns!", "color" => "success"];
            if ($diffInDaysCurrentYear == 1) return ["text" => "Foi ontem!", "color" => "warning"];
            elseif ($diffInDaysCurrentYear > 180) return ["text" => "Faltam " . abs($diffInDaysNextYear) . " dias", "color" => "danger"];
            else return ["text" => "Passaram {$diffInDaysCurrentYear} dias", "color" => "warning"];
        }
    }
}
