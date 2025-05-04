<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crea los roles con guard_name 'web' (por defecto)
        Role::create(['name' => 'admin',  'guard_name' => 'web']);
        Role::create(['name' => 'editor', 'guard_name' => 'web']);
        Role::create(['name' => 'viewer', 'guard_name' => 'web']);
        // User::factory(10)->withPersonalTeam()->create();

        $admin = User::factory()->withPersonalTeam()->create([
            'name'     => 'Test User',
            'email'    => 'testuser@example.com',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('admin');

        // Usuarios de prueba
        for ($i = 1; $i <= 20; $i++) {
            $user = User::factory()->withPersonalTeam()->create([
                'name'     => "Test User $i",
                'email'    => "testuser{$i}@example.com",
                'password' => bcrypt('password'),
            ]);

            $user->assignRole('viewer');
        }
    }
}
