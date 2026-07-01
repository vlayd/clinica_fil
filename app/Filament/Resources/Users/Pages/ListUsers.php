<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Models\User;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Override;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    #[Override]
    public function getTabs(): array
    {
        return [
            'funcionarios' => Tab::make(label: 'Funcionários')
                ->icon(Heroicon::ListBullet)
                ->badge(User::whereNot('id', Auth::id())->whereNot('password', null)->whereNot('rule', 0)->count())
                ->modifyQueryUsing(fn(Builder $query) => $query->whereNot('rule', 0)),
            'clientes' => Tab::make(label: 'Clientes')
                ->icon(Heroicon::CheckCircle)
                ->badge(User::whereNot('id', Auth::id())->whereNot('password', null)->where('rule', 0)->count())
                ->badgeColor('success')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('rule', 0)),
        ];
    }
}
