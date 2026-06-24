<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Models\User;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;
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
            'todos' => Tab::make(label: 'Todos')
                ->icon(Heroicon::ListBullet)
                ->badge(User::count())
                ->modifyQueryUsing(fn(Builder $query) => $query),
            'ativos' => Tab::make(label: 'Ativos')
                ->icon(Heroicon::CheckCircle)
                ->badge(User::where('active', 1)->count())
                ->badgeColor('success')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('active', true)),
            'inativos' => Tab::make(label: 'Inativos')
                ->badge(User::where('active', 0)->count())
                ->badgeColor('danger')
                ->icon(Heroicon::XCircle)
                ->modifyQueryUsing(fn(Builder $query) => $query->where('active', false))
        ];
    }
}
