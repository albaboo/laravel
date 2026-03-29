<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistreTemps extends Model
{
    use HasFactory;

    protected $table = 'registre_temps';

    protected $fillable = [
        'ticket_id',
        'user_id',
        'data',
        'hores',
        'descripcio'
    ];

    protected $casts = [
        'data' => 'date',
        'hores' => 'decimal:2'
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
