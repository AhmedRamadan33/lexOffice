<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public const PERMISSIONS = [
        'manage-clients',
        'manage-cases',
        'manage-sessions',
        'manage-invoices',
        'manage-expenses',
        'manage-tasks',
        'manage-documents',
        'manage-users',
        'manage-branches',
        'manage-settings',
        'view-all-branches',
        'view-activity-log',
    ];

    public function run(): void
    {
        foreach (self::PERMISSIONS as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $admin = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $admin->syncPermissions(self::PERMISSIONS);

        $lawyer = Role::firstOrCreate(['name' => 'Lawyer', 'guard_name' => 'web']);
        $lawyer->syncPermissions([
            'manage-clients',
            'manage-cases',
            'manage-sessions',
            'manage-tasks',
            'manage-documents',
        ]);

        $secretary = Role::firstOrCreate(['name' => 'Secretary', 'guard_name' => 'web']);
        $secretary->syncPermissions([
            'manage-clients',
            'manage-cases',
            'manage-sessions',
            'manage-tasks',
            'manage-documents',
        ]);

        $accountant = Role::firstOrCreate(['name' => 'Accountant', 'guard_name' => 'web']);
        $accountant->syncPermissions([
            'manage-invoices',
            'manage-expenses',
        ]);
    }
}
