<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'last_name' => 'Test Lastname',
            'email' => 'test@example.com',
        ]);

        $this->call([
            ServiceSeeder::class,
        ]);

        $this->call(AdminUserSeeder::class);

        $this->call(LabTestSeeder::class);

        $this->call(ImagingStudySeeder::class);

        $this->call([
            DoctorSeeder::class,
        ]);
    }
}
