<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Projecte extends Model
{
    use HasFactory;

    protected $table = 'projectes';

    protected $fillable = [
        'client_id',
        'gestor_id',
        'nom',
        'descripcio',
        'codi_projecte',
        'estat',
        'data_inici',
        'data_fi_prevista',
        'data_fi_real',
        'pressupost_hores_estimades',
        'pressupost_hores_reals',
    ];

    protected $casts = [
        'data_inici' => 'date',
        'data_fi_prevista' => 'date',
        'data_fi_real' => 'date',
        'pressupost_hores_estimades' => 'integer',
        'pressupost_hores_reals' => 'decimal:2',
    ];

    public const PLANIFICACIO = 'PLANIFICACIO';
    public const EN_CURS = 'EN_CURS';
    public const PAUSAT = 'PAUSAT';
    public const FINALIZAT = 'FINALIZAT';
    public const CANCELAT = 'CANCELAT';

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function gestor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'gestor_id');
    }

    public function usuaris(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function configuracio(): HasOne
    {
        return $this->hasOne(ConfiguracioProjecte::class);
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
