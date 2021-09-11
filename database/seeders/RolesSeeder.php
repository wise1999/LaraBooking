<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{

    public function run()
    {
        $role1 = Role::create(['name' => 'user']);
        $role2 = Role::create(['name' => 'admin']);

        $user = \App\Models\User::factory()->create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user'),
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
        ]);
        $user->assignRole($role2);
    }
}
