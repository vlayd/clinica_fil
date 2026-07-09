<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\AvatarProviders\UiAvatarsProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Override;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
                            'name',
                            'email',
                            'email_verified_at',
                            'password',
                            'rule',
                            'active',
                            'photo',
                            'cpf',
                            'birth',
                            'rg',
                            'phone',
                            'cellphone',
                            'street',
                            'number',
                            'complement',
                            'neighborhood',
                            'city',
                            'state',
                            'last_login_at',
                            'zip_code'];


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    #[Override]
    public function canAccessPanel(Panel $panel): bool
    {
        $active = $this->active;
        if (!$active) {
            Filament::auth()->logout();
            session()->invalidate();
            session()->regenerateToken();
        }
        DB::table('users')
            ->where('id', $this->id)
            ->update(['last_login_at' => now()]);

        return $active;
    }

     public function getFilamentAvatarUrl(): ?string
    {
        // Altere 'avatar_url' para o nome da coluna que você usa no banco
        if ($this->photo) {
            return  Storage::url('storage/users/photos/' . $this->photo);
        }

        // Gera um avatar padrão com as iniciais do nome caso não tenha foto
        return (new UiAvatarsProvider())->get($this);
    }
}
