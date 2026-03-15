<?php

namespace Database\Seeders;

use App\Models\Projecte;
use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        Projecte::all()->each(function ($projecte) {
            Ticket::factory(rand(0,3))->create([
                'projecte_id' => $projecte->id,
                'creador_id' => $projecte->gestor_id,
            ]);
        });
    }
}
