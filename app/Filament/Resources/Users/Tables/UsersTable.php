<?php

namespace App\Filament\Resources\Users\Tables;

use App\Filament\Resources\Helpers\TableHelper;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
// dd(Auth::id());

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->whereNot('id', Auth::id())->where('enterprise_id', auth()->user()->enterprise_id)->whereNot('active', 0))
            ->columns([
                TableHelper::columnImage(),
                TableHelper::columnName(),
                TableHelper::columnEmail(),
                TableHelper::columnRoleBadge()
                    ->action(
                        Action::make('editNível')
                            ->modalHeading('Alterar Nível')
                            ->modalWidth('md')
                            ->fillForm(fn($record): array => [
                                'roles.name' => $record->{'roles.name'},
                            ])
                            ->schema([
                                Select::make('roles')->relationship('roles', 'name')
                            ])
                    )
                    ->hidden(fn($livewire) => $livewire->activeTab == 'clientes'),
                TableHelper::columnLastLoginAt(),
            ])
            ->filters([
                //
            ])
            ->recordActions(TableHelper::recordActions(['resetPassword']))
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
