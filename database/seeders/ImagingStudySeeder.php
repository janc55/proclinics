<?php

namespace Database\Seeders;

use App\Models\Imaging\ImagingStudy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImagingStudySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $studies = [
            [
                'name' => 'Rayos X de Tórax',
                'description' => 'Evaluación de pulmones, costillas y corazón.',
                'price' => 80.00,
            ],
            [
                'name' => 'Ecografía Abdominal',
                'description' => 'Estudio por ultrasonido de órganos abdominales.',
                'price' => 100.00,
            ],
            [
                'name' => 'Tomografía de Cráneo',
                'description' => 'Evaluación detallada del cerebro y cráneo.',
                'price' => 350.00,
            ],
            [
                'name' => 'Resonancia Magnética de Columna',
                'description' => 'Visualización de vértebras, discos y médula espinal.',
                'price' => 600.00,
            ],
            [
                'name' => 'Mamografía',
                'description' => 'Detección temprana de cáncer de mama.',
                'price' => 120.00,
            ],
        ];

        foreach ($studies as $study) {
            ImagingStudy::firstOrCreate(['name' => $study['name']], $study);
        }

        $this->command->info('📷 Estudios de imagen cargados correctamente.');
    }
}
