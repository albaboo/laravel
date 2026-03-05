<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;

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
            'cif' => strtoupper($this->faker->bothify('?#######?')), // Ej: A123456B
            'email_contacte' => $this->faker->unique()->companyEmail(),
            'telefon' => $this->faker->phoneNumber(),
            'direccio' => $this->faker->address(),
            'actiu' => $this->faker->boolean(90), // 90% chance de true
        ];
    }
}
