<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proyecto;
use Database\Factories\ProyectoFactory;

class ProyectoSeeder extends Seeder
{
    public function run(): void
    {
        ProyectoFactory::factoryForModel(Proyecto::class)
        ->count(50)
        ->create();    
    }
}
