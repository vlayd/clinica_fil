<?php

namespace App\Providers;

use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Login;
use App\Listeners\UpdateLastLoginTimestamp;
use Illuminate\Support\Facades\Event;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        TextColumn::configureUsing(function (TextColumn $textColumn) {
            Event::listen(
                Login::class,
                UpdateLastLoginTimestamp::class
            );
            // if (Str::contains($textColumn->getName(), ['created_at', 'updated_at', 'birth'])) {
            //     $textColumn->date('d/m/Y')->alignCenter();
            // }

            // if (Str::contains($textColumn->getName(), ['status'])) {
            //     $textColumn->badge();
            // }

            // if (Str::contains($textColumn->getName(), ['cpf', 'name', 'email'])) {
            //     $textColumn->searchable();
            // }
        });
    }

}
