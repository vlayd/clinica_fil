<?php

namespace App\Filament\Resources\Helpers;

use Carbon\Carbon;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
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

    public static function columnImage($make = 'photo')
    {
        return ImageColumn::make($make)->defaultImageUrl(url('storage/images/no-foto2.png'))
            ->disk('public')
            ->label('')
            ->circular()
            ->alignCenter()
            ->width('50px');
    }

    public static function columnName($make = 'name')
    {
        return TextColumn::make($make)
            ->label('Nome')
            ->searchable()
            // ->toggleable(isToggledHiddenByDefault: false)
            ->sortable();
    }

    public static function columnCpf($make = 'cpf')
    {
        return TextColumn::make($make)
            ->label('CPF')
            ->searchable()
            ->alignCenter();
    }

    public static function columnEmail($make = 'email')
    {
        return TextColumn::make($make)
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

    public static function columnCreatedAt($make = 'created_at')
    {
        return TextColumn::make($make)
            ->label('Data de criação')
            ->date('d/m/Y')
            ->alignCenter()
            ->sortable();
    }

    public static function columnUpdatedAt($make = 'updated_at')
    {
        return TextColumn::make($make)
            ->label('Data de atualização')
            ->alignCenter()
            ->isoDate('L');
    }

    public static function columnBirth($make = 'birth')
    {
        return TextColumn::make($make)
            ->label('Nascimento')
            ->alignCenter()
            ->date('d/m/Y')
            ->sortable()
            ->searchable();
    }

    public static function columnBirthAge($make = 'birth')
    {
        return TextColumn::make($make)
            ->label('Idade')
            ->alignCenter()
            ->sortable()
            ->formatStateUsing(fn($state) => Carbon::parse($state)->age . ' anos');
    }

    public static function columnIsUser($make = 'password')
    {
        return IconColumn::make($make)
            ->alignCenter()
            ->label('Usuário')
            // ->boolean()
            // ->trueIcon('fas-check-circle')
            // ->falseIcon('fas-xmark-circle')
            // ->trueColor('success')
            // ->falseColor('danger')
            ->tooltip(fn($state): string => !empty($state) ? 'É usuário' : 'Não é usuário')
            ->searchable()
            ->sortable()
            ->icon(fn($state): string => !empty($state) ? 'fas-check-circle' : 'fas-times-circle');
    }

    public static function columnBirthDiffDays($make = 'birth')
    {
        return TextColumn::make($make)
            ->label('Aniversário')
            ->color(function ($state) {
                return self::diffInDays($state)['color'];
            })
            ->alignCenter()
            ->dateTooltip('d/m')
            ->formatStateUsing(function ($state) {
                return self::diffInDays($state)['text'];
            });
    }

    public static function columnActiveToggle($make = 'active')
    {
        return ToggleColumn::make($make)
            ->label('Ativo')
            ->alignCenter();
    }

    public static function columnActiveBadge($make = 'active')
    {
        return TextColumn::make($make)
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
