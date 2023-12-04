<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cliente;
use Database\Factories\ClienteFactory;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        ClienteFactory::factoryForModel(Cliente::class)
        ->count(25)
        ->create();
        ClienteFactory::factoryForModel(Cliente::class)
        ->count(5)
        ->create();
    }
}

