<?php

namespace Database\Seeders;

use App\Models\Laboratory\LabTest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LabTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tests = [
            [
                'name' => 'Hemograma Completo',
                'description' => 'Evaluación general de las células sanguíneas.',
                'unit' => null,
                'reference_min' => null,
                'reference_max' => null,
                'reference_text' => 'Valores varían según edad y sexo',
                'price' => 30.00,
            ],
            [
                'name' => 'Glucosa en Sangre',
                'description' => 'Medición de azúcar en sangre.',
                'unit' => 'mg/dL',
                'reference_min' => 70,
                'reference_max' => 100,
                'reference_text' => null,
                'price' => 15.00,
            ],
            [
                'name' => 'Colesterol Total',
                'description' => 'Medición del colesterol total en sangre.',
                'unit' => 'mg/dL',
                'reference_min' => 125,
                'reference_max' => 200,
                'reference_text' => null,
                'price' => 20.00,
            ],
            [
                'name' => 'Triglicéridos',
                'description' => 'Medición de triglicéridos en sangre.',
                'unit' => 'mg/dL',
                'reference_min' => 35,
                'reference_max' => 150,
                'reference_text' => null,
                'price' => 20.00,
            ],
            [
                'name' => 'Urea',
                'description' => 'Evaluación de función renal.',
                'unit' => 'mg/dL',
                'reference_min' => 10,
                'reference_max' => 50,
                'reference_text' => null,
                'price' => 25.00,
            ],
        ];

        foreach ($tests as $test) {
            LabTest::firstOrCreate(['name' => $test['name']], $test);
        }

        $this->command->info('🧪 Exámenes de laboratorio básicos cargados.');
    }
}
