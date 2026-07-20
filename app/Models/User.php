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
use Filament\Models\Contracts\HasAvatar;
use Filament\AvatarProviders\UiAvatarsProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Override;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

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
        // dd(Storage::url($this->photo));
        if (!empty($this->photo)) {
            return  Storage::url($this->photo);
        }

        // Gera um avatar padrão com as iniciais do nome caso não tenha foto
        // return  Storage::url('storage/images/no-foto2.png');
        return asset('images/no-foto2.png');
    }

    // public function getActions(string $type) {
    //     $auth =  Auth::user();
    //     if($type == 'EmployesTable'){
    //         // return Auth::user()->getRoleNames()->implode(',');
    //         if($auth->getRoleNames()->implode(',') == 'super_admin') return ['view', 'edit', 'delete'];
    //         $action = [];
    //         if($auth->can('View:Employe')) $action[] = 'view';
    //         if($auth->can('Update:Employe')) $action[] = 'edit';
    //         if($auth->can('Delete:Employe')) $action[] = 'delete';
    //         return $action;
    //     }
    // }
}
