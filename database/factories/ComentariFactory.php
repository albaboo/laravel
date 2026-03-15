<?php

namespace Database\Factories;

use App\Models\Comentari;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComentariFactory extends Factory
{
    protected $model = Comentari::class;

    public function definition(): array
    {
        return [
            'ticket_id' => Ticket::factory(),
            'autor_id' => User::factory(),
            'text' => $this->faker->paragraph(),
        ];
    }
}
