<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'josenegretti55@gmail.com'],
            [
                'name' => 'José Alfredo',
                'last_name' => 'Negretti Cortés',
                'email' => 'josenegretti55@gmail.com',
                'password' => Hash::make('12345678'),
            ]
        );

        // Si estás usando Spatie y ya existe el rol "Admin", lo asigna
        if (class_exists(Role::class)) {
            $adminRole = Role::firstOrCreate(['name' => 'Admin']);
            $user->assignRole($adminRole);
        }

        $this->command->info('✅ Usuario administrador creado: josenegretti55@gmail.com / 12345678');
    }
}
