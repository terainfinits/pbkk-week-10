<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Spatie\Permission\Models\Role;
use Faker\Factory as Faker;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // ==== Roles ---------------------------------------------------------
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $staffRole = Role::firstOrCreate(['name' => 'Staf']);

        // ==== Users ---------------------------------------------------------
        $admin = User::factory()->create([
            'name'  => 'Admin Demo',
            'email' => 'admin@demo.local',
            'password' => bcrypt('password')
        ]);
        $admin->assignRole($adminRole);

        $staff = User::factory()->create([
            'name'  => 'Staf Demo',
            'email' => 'staff@demo.local',
            'password' => bcrypt('password')
        ]);
        $staff->assignRole($staffRole);

        // ==== Mahasiswa (students) -----------------------------------------
        Mahasiswa::factory()->count(50)->create();

        // ==== Mata Kuliah (courses) ----------------------------------------
        Matakuliah::factory()->count(20)->create();
    }
}
