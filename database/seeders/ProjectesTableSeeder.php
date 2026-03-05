<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Projecte;
use App\Models\User;
use App\Models\Client;


class ProjectesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = Client::all();
        $users = User::all();

        Projecte::factory(50)->make()->each(function ($project) use ($clients, $users) {
            $project->client_id = $project->client_id ?? $clients->random()->id;
            $project->gestor_id = $project->gestor_id ?? $users->random()->id;
            $project->save();

            $project->usuaris()->attach(
                $users->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
