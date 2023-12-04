<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    protected $model = Cliente::class;

    public function definition(): array
    {
        return [
            'nombre_cliente' => $this->faker->unique()->name,
            'nit' => $this->faker->unique()->numerify('###########'),
            'direccion' => $this->faker->unique()->sentence(1), 
            'telefono' => $this->faker->unique()->phoneNumber,
            'actividad_comercial' => $this->faker->unique()->sentence(3),
            'codigo_ciuu' => $this->faker->unique()->numerify('####'),
        ];
    }

    
}
