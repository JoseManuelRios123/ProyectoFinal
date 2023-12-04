<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Asesore;
use Database\Factories\AsesoreFactory;

class AsesoreSeeder extends Seeder
{
    public function run(): void
    {
        AsesoreFactory::factoryForModel(Asesore::class)
        ->count(25)
        ->create();
        AsesoreFactory::factoryForModel(Asesore::class)
        ->count(5)
        ->create();
    }
}


