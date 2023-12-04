<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cliente;
use App\Models\Asesore;
use App\Models\Proyecto;



/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proyecto>
 */
class ProyectoFactory extends Factory
{
    protected $model = Proyecto::class; 

    public function definition(): array
    {
        return [
            'idClientes' => function () {
                return Cliente::inRandomOrder()->first()->id_cliente;
            },
            'idAsesores' => function () {
                return Asesore::inRandomOrder()->first()->id_asesor;
            },
            'Nombre' => $this->faker->unique()->word,
            'Riesgo' => $this->faker->numberBetween(1, 5),
        ];
    }
}