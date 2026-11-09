<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // ---------- Permissions ----------
        $permissions = [
            'view dashboard',
            'manage users',
            'delete user',
            'manage mahasiswa',
            'delete mahasiswa',
            'manage matakuliah',
            'delete matakuliah',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // ---------- Roles ----------
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $staff = Role::firstOrCreate(['name' => 'Staf']);

        // Admin gets everything
        $admin->syncPermissions(Permission::all());

        // Staff gets only read‑only permissions (no delete)
        $staff->syncPermissions([
            'view dashboard',
            'manage users',
            'manage mahasiswa',
            'manage matakuliah',
        ]);
    }
}
