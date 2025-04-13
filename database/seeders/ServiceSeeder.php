<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            ['name' => 'Medicina General', 'base_price' => 100],
            ['name' => 'Pediatría', 'base_price' => 120],
            ['name' => 'Ginecología', 'base_price' => 150],
            ['name' => 'Laboratorio Clínico', 'base_price' => 80],
            ['name' => 'Imagenología', 'base_price' => 200],
        ];

        foreach ($services as $service) {
            Service::firstOrCreate(['name' => $service['name']], $service);
        }
    }
}
