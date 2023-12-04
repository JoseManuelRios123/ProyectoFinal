<?php

// En AsesoreFactory.php
namespace Database\Factories;

use App\Models\Asesore;
use Illuminate\Database\Eloquent\Factories\Factory;

class AsesoreFactory extends Factory
{
    protected $model = Asesore::class;

    public function definition(): array
    {
        return [
            'nombre_asesor' => $this->faker->unique()->name,
            'profesion_asesor' => $this->faker->randomElement(['Profesional SST', 'Tecnologo SST', 'Tecnico SST']),
            'licencia_asesor' => $this->faker->unique()->bothify('#########'),
        ];
    }
}
