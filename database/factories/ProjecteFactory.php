<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Projecte;
use App\Models\User;
use DateMalformedStringException;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Projecte>
 */
class ProjecteFactory extends Factory
{
    protected $model = Projecte::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws DateMalformedStringException
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-1 year', 'now');
        $estimatedEndDate = (clone $startDate)->modify('+'.rand(30, 180).' days');

        return [
            'client_id' => Client::inRandomOrder()->first()->id,
            'gestor_id' => User::factory(),
            'nom' => $this->faker->catchPhrase(),
            'descripcio' => $this->faker->paragraph(),
            'codi_projecte' => strtoupper($this->faker->bothify('PROJ-#####')),
            'estat' => $this->faker->randomElement([
                Projecte::PLANIFICACIO,
                Projecte::EN_CURS,
                Projecte::PAUSAT,
                Projecte::FINALIZAT,
                Projecte::CANCELAT,
            ]),
            'data_inici' => $startDate,
            'data_fi_prevista' => $estimatedEndDate,
            'data_fi_real' => $this->faker->dateTimeBetween($startDate, $estimatedEndDate),
            'pressupost_hores_estimades' => $this->faker->numberBetween(50, 500),
            'pressupost_hores_reals' => $this->faker->randomFloat(2, 50, 500),
        ];
    }
}
