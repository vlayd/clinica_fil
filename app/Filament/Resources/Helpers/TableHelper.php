<?php

namespace App\Filament\Resources\Helpers;

use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;

class TableHelper
{
    public static function recordActions(array $buttons = ['view', 'edit', 'delete']): array
    {
        $actionView = [];
        $actions = [
            'view' => ViewAction::make()->label('')->iconButton()->color('primary'),
            'edit' => EditAction::make()->label('')->iconButton()->color('warning'),
            'delete' => DeleteAction::make()->label('')->iconButton()->color('danger'),
            'restore' => RestoreAction::make()->label('')->iconButton()->color('danger'),
            'resetPassword' => Action::make('resetPassword')
                ->label('')
                ->tooltip('Resetar senha')
                ->requiresConfirmation()
                ->modalHeading('Redefinir senha?')
                ->modalDescription('A senha do usuário será redefinida para os números do CPF. Deseja continuar?')
                ->icon('fas-user-lock')
                ->extraAttributes(['style' => 'margin-right: 55px;'])
                ->iconButton()
                // ->disabled(true)
                ->color('success')
                ->modalSubmitActionLabel('Redefinir')
                ->modalIcon('fas-key')
                ->modalIconColor('warning')
                ->action(function ($record) {
                    // Remove caracteres especiais (pontos e traços) do CPF
                    $cpfLimpo = preg_replace('/[^0-9]/', '', $record->cpf);
                    if (empty($cpfLimpo)) {
                        Notification::make()
                            ->title('Erro ao resetar senha')
                            ->body('O usuário não possui um CPF cadastrado ou válido.')
                            ->danger()
                            ->send();
                        return;
                    }

                    // Atualiza a senha e salva
                    $record->password = Hash::make($cpfLimpo);
                    $record->save();

                    Notification::make()
                        ->title('Senha resetada com sucesso!')
                        ->body('A nova senha é o CPF do usuário.')
                        ->success()
                        ->send();
                }),
        ];
        foreach ($buttons as $button) {
            $actionView[] = $actions[$button];
        }
        return $actionView;
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

    public static function columnLastLoginAt($make = 'last_login_at')
    {
        return TextColumn::make($make)
            ->placeholder('Nunca')
            ->label('Último acesso')
            ->since()
            ->alignCenter()
            ->isoDateTimeTooltip('LLL')
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
            ->tooltip(function ($record): string {
                $state = $record->active; // Assuming 'password' is the field name
                return $state;
            })
            ->searchable()
            ->sortable()
            // ->icon(fn($state): string => !empty($state) ? 'fas-check-circle' : 'fas-times-circle');
            ->icon(function ($record): string {
                $state = $record->active; // Assuming 'password' is the field name
                if (empty($state)) {
                    return 'fas-check-circle';
                }
                return 'fas-times-circle';
            });
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
            ->label('Usuário')
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
