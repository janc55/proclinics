<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors = [
            [
                'name' => 'Carlos',
                'last_name' => 'Ríos',
                'email' => 'c.rios@clinic.com',
                'document_number' => '7845123',
                'specialty' => 'Medicina General',
                'license_number' => 'MED-001',
            ],
            [
                'name' => 'María',
                'last_name' => 'Gutiérrez',
                'email' => 'm.gutierrez@clinic.com',
                'document_number' => '9213647',
                'specialty' => 'Pediatría',
                'license_number' => 'MED-002',
            ],
            [
                'name' => 'Jorge',
                'last_name' => 'Quispe',
                'email' => 'j.quispe@clinic.com',
                'document_number' => '6432101',
                'specialty' => 'Cardiología',
                'license_number' => 'MED-003',
            ],
            [
                'name' => 'Valeria',
                'last_name' => 'López',
                'email' => 'v.lopez@clinic.com',
                'document_number' => '7589410',
                'specialty' => 'Bioquímica Clínica',
                'license_number' => 'LAB-001',
            ],
            [
                'name' => 'David',
                'last_name' => 'Morales',
                'email' => 'd.morales@clinic.com',
                'document_number' => '8456231',
                'specialty' => 'Radiología',
                'license_number' => 'IMG-001',
            ],
        ];

        foreach ($doctors as $doc) {
            $user = User::create([
                'name' => $doc['name'],
                'last_name' => $doc['last_name'],
                'document_number' => $doc['document_number'],
                'email' => $doc['email'],
                'password' => Hash::make('12345678'),
            ]);

            Doctor::create([
                'user_id' => $user->id,
                'specialty' => $doc['specialty'],
                'license_number' => $doc['license_number'],
                'status' => true,
            ]);
        }

        $this->command->info('👨‍⚕️ 5 doctores creados exitosamente.');
    }
}
