<?php
namespace Database\Factories;

use App\Models\Projecte;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TicketFactory extends Factory
{

    protected $model = Ticket::class;

    public function definition(): array
    {
        return [
            'projecte_id' => Projecte::factory(),
            'creador_id' => User::factory(),
            'codi_ticket' => strtoupper(Str::random(8)),
            'titol' => $this->faker->sentence(5),
            'descripcio' => $this->faker->paragraph(),
            'estat' => $this->faker->randomElement(['NOU', 'OBERT', 'TANCAT']),
        ];
    }
}
