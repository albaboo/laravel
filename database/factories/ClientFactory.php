<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\User;
use App\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Client>
 */
class ClientFactory extends Factory
{
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->company(),
            'cif' => strtoupper($this->faker->bothify('?#######?')),
            'email_contacte' => $this->faker->unique()->companyEmail(),
            'telefon' => $this->faker->phoneNumber(),
            'direccio' => $this->faker->address(),
            'actiu' => $this->faker->boolean(80),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Client $client) {
            $user = User::create([
                'name' => $client->nombre . ' (usuari)',
                'email' => $client->email_contacte,
                'password' => bcrypt('password'),
                'rol' => Role::CLIENT
            ]);
            $client->update(['user_id' => $user->id]);
        });
    }
}
