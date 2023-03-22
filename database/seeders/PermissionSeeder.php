<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'modify general settings', 'group_name' => 'app-settings']);
        Permission::create(['name' => 'modify dashboard settings', 'group_name' => 'app-settings']);
        Permission::create(['name' => 'modify finance settings', 'group_name' => 'app-settings']);

        Permission::create(['name' => 'modify master data', 'group_name' => 'master-data']);

        Permission::create(['name' => 'view revenue', 'group_name' => 'revenue']);
        Permission::create(['name' => 'add revenue', 'group_name' => 'revenue']);
        Permission::create(['name' => 'edit revenue', 'group_name' => 'revenue']);
        Permission::create(['name' => 'delete revenue', 'group_name' => 'revenue']);
        Permission::create(['name' => 'export revenue', 'group_name' => 'revenue']);

        Permission::create(['name' => 'view expense', 'group_name' => 'expense']);
        Permission::create(['name' => 'add expense', 'group_name' => 'expense']);
        Permission::create(['name' => 'edit expense', 'group_name' => 'expense']);
        Permission::create(['name' => 'delete expense', 'group_name' => 'expense']);
        Permission::create(['name' => 'export expense', 'group_name' => 'expense']);

        Permission::create(['name' => 'view user', 'group_name' => 'user']);
        Permission::create(['name' => 'add user', 'group_name' => 'user']);
        Permission::create(['name' => 'edit user', 'group_name' => 'user']);
        Permission::create(['name' => 'suspend user', 'group_name' => 'user']);

        Permission::create(['name' => 'view employee', 'group_name' => 'employee']);
        Permission::create(['name' => 'add employee', 'group_name' => 'employee']);
        Permission::create(['name' => 'edit employee', 'group_name' => 'employee']);
        Permission::create(['name' => 'suspend employee', 'group_name' => 'employee']);

        Permission::create(['name' => 'view report', 'group_name' => 'report']);
        Permission::create(['name' => 'access country report', 'group_name' => 'country-report']);
        Permission::create(['name' => 'export country report', 'group_name' => 'country-report']);

        Permission::create(['name' => 'access company report', 'group_name' => 'company-report']);
        Permission::create(['name' => 'export company report', 'group_name' => 'company-report']);

        Permission::create(['name' => 'access branch report', 'group_name' => 'branch-report']);
        Permission::create(['name' => 'export branch report', 'group_name' => 'branch-report']);

        Permission::create(['name' => 'view company', 'group_name' => 'company']);
        Permission::create(['name' => 'add company', 'group_name' => 'company']);
        Permission::create(['name' => 'edit company', 'group_name' => 'company']);
        Permission::create(['name' => 'delete company', 'group_name' => 'company']);
        Permission::create(['name' => 'export company', 'group_name' => 'company']);

        Permission::create(['name' => 'view branch', 'group_name' => 'branch']);
        Permission::create(['name' => 'add branch', 'group_name' => 'branch']);
        Permission::create(['name' => 'edit branch', 'group_name' => 'branch']);
        Permission::create(['name' => 'delete branch', 'group_name' => 'branch']);
        Permission::create(['name' => 'export branch', 'group_name' => 'branch']);

        // $role = Role::create(['name' => 'Super Admin']);
        // $role->givePermissionTo(Permission::all());
    }
}
