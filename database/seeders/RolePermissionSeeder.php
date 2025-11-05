<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // User management
            'view-users',
            'create-users',
            'edit-users',
            'delete-users',

            // Client management
            'view-clients',
            'create-clients',
            'edit-clients',
            'delete-clients',

            // Vehicle management
            'view-vehicles',
            'create-vehicles',
            'edit-vehicles',
            'delete-vehicles',

            // Reminder management
            'view-reminders',
            'create-reminders',
            'edit-reminders',
            'delete-reminders',
            'send-reminders',

            // Payment management
            'view-payments',
            'create-payments',
            'refund-payments',

            // Service request management
            'view-service-requests',
            'create-service-requests',
            'edit-service-requests',
            'delete-service-requests',

            // Notification management
            'view-notifications',
            'send-notifications',

            // Settings management
            'view-settings',
            'edit-settings',

            // Audit logs
            'view-audit-logs',

            // Reports
            'view-reports',
            'export-reports',

            // Dashboard
            'view-admin-dashboard',
            'view-client-dashboard',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions

        // Super Admin - has all permissions
        $superAdmin = Role::create(['name' => 'super_admin']);
        $superAdmin->givePermissionTo(Permission::all());

        // Admin - most permissions except critical ones
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo([
            'view-users', 'edit-users',
            'view-clients', 'create-clients', 'edit-clients',
            'view-vehicles', 'create-vehicles', 'edit-vehicles',
            'view-reminders', 'create-reminders', 'edit-reminders', 'send-reminders',
            'view-payments', 'create-payments',
            'view-service-requests', 'edit-service-requests',
            'view-notifications', 'send-notifications',
            'view-reports', 'export-reports',
            'view-admin-dashboard',
        ]);

        // Agent - limited permissions
        $agent = Role::create(['name' => 'agent']);
        $agent->givePermissionTo([
            'view-clients', 'edit-clients',
            'view-vehicles', 'edit-vehicles',
            'view-reminders', 'edit-reminders',
            'view-service-requests', 'edit-service-requests',
            'view-admin-dashboard',
        ]);

        // Client - minimal permissions
        $client = Role::create(['name' => 'client']);
        $client->givePermissionTo([
            'view-vehicles',
            'view-reminders',
            'view-payments',
            'create-service-requests',
            'view-service-requests',
            'view-client-dashboard',
        ]);
    }
}
