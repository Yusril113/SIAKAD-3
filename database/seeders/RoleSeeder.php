<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (['admin', 'lecturer', 'student'] as $r) {
            Role::firstOrCreate(['name' => $r]);
        }
        $this->call(RoleSeeder::class);
        $adminRole = Role::where('name', 'admin')->first();
        User::firstOrCreate(
            ['email' => 'admin@siakad.test'],
            ['name' => 'Admin', 'password' => bcrypt('password'), 'role_id' => $adminRole->id, 'is_active' => true]
        );
    }
}
