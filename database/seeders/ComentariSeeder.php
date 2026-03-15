<?php

namespace Database\Seeders;

use App\Models\Comentari;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

class ComentariSeeder extends Seeder
{
    public function run(): void
    {
        Ticket::all()->each(function ($ticket) {
            $numComentaris = rand(0, 4);
            Comentari::factory($numComentaris)->create([
                'ticket_id' => $ticket->id,
                'autor_id' => User::inRandomOrder()->first()->id,
            ]);
        });
    }
}
