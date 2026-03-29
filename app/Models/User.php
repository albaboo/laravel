<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Role;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tarifa_hora',
        'rol'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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
            'tarifa_hora' => 'decimal:2',
            'rol' => Role::class,
        ];
    }

    public function projectesGestionats(): HasMany
    {
        return $this->hasMany(Projecte::class);
    }

    public function projectes(): BelongsToMany
    {
        return $this->belongsToMany(Projecte::class)->withTimestamps();
    }

    public function client(): HasOne
    {
        return $this->hasOne(Client::class);
    }

    public function ticketsCreats(): HasMany
    {
        return $this->hasMany(Ticket::class, 'creador_id');
    }

    public function comentaris(): HasMany
    {
        return $this->hasMany(Comentari::class, 'autor_id');
    }

    public function registresTemps()
    {
        return $this->hasMany(RegistreTemps::class);
    }

    public function hasAnyRole(array $roles): bool
    {
        return in_array($this->rol, $roles);
    }
}
