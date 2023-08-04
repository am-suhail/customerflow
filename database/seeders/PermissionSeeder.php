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
        Permission::create([
            'id'  => 1,
            'name' => 'modify general settings',
            'group_name' => 'app-settings'
        ]);
        Permission::create([
            'id'  => 2,
            'name' => 'modify dashboard settings',
            'group_name' => 'app-settings'
        ]);
        Permission::create([
            'id'  => 3,
            'name' => 'modify finance settings',
            'group_name' => 'app-settings'
        ]);

        Permission::create([
            'id'  => 4,
            'name' => 'modify master data',
            'group_name' => 'master-data'
        ]);

        Permission::create([
            'id'  => 5,
            'name' => 'view revenue',
            'group_name' => 'revenue'
        ]);
        Permission::create([
            'id'  => 6,
            'name' => 'add revenue',
            'group_name' => 'revenue'
        ]);
        Permission::create([
            'id'  => 7,
            'name' => 'edit revenue',
            'group_name' => 'revenue'
        ]);
        Permission::create([
            'id'  => 8,
            'name' => 'delete revenue',
            'group_name' => 'revenue'
        ]);
        Permission::create([
            'id'  => 9,
            'name' => 'export revenue',
            'group_name' => 'revenue'
        ]);

        Permission::create([
            'id'  => 10,
            'name' => 'view expense',
            'group_name' => 'expense'
        ]);
        Permission::create([
            'id'  => 11,
            'name' => 'add expense',
            'group_name' => 'expense'
        ]);
        Permission::create([
            'id'  => 12,
            'name' => 'edit expense',
            'group_name' => 'expense'
        ]);
        Permission::create([
            'id'  => 13,
            'name' => 'delete expense',
            'group_name' => 'expense'
        ]);
        Permission::create([
            'id'  => 14,
            'name' => 'export expense',
            'group_name' => 'expense'
        ]);

        Permission::create([
            'id'  => 15,
            'name' => 'view user',
            'group_name' => 'user'
        ]);
        Permission::create([
            'id'  => 16,
            'name' => 'add user',
            'group_name' => 'user'
        ]);
        Permission::create([
            'id'  => 17,
            'name' => 'edit user',
            'group_name' => 'user'
        ]);
        Permission::create([
            'id'  => 18,
            'name' => 'suspend user',
            'group_name' => 'user'
        ]);

        Permission::create([
            'id'  => 19,
            'name' => 'view employee',
            'group_name' => 'employee'
        ]);
        Permission::create([
            'id'  => 20,
            'name' => 'add employee',
            'group_name' => 'employee'
        ]);
        Permission::create([
            'id'  => 21,
            'name' => 'edit employee',
            'group_name' => 'employee'
        ]);
        Permission::create([
            'id'  => 22,
            'name' => 'suspend employee',
            'group_name' => 'employee'
        ]);

        Permission::create([
            'id'  => 23,
            'name' => 'view report',
            'group_name' => 'report'
        ]);
        Permission::create([
            'id'  => 24,
            'name' => 'access country report',
            'group_name' => 'country-report'
        ]);
        Permission::create([
            'id'  => 25,
            'name' => 'export country report',
            'group_name' => 'country-report'
        ]);

        Permission::create([
            'id'  => 26,
            'name' => 'access company report',
            'group_name' => 'company-report'
        ]);
        Permission::create([
            'id'  => 27,
            'name' => 'export company report',
            'group_name' => 'company-report'
        ]);

        Permission::create([
            'id'  => 28,
            'name' => 'access branch report',
            'group_name' => 'branch-report'
        ]);
        Permission::create([
            'id'  => 29,
            'name' => 'export branch report',
            'group_name' => 'branch-report'
        ]);

        Permission::create([
            'id'  => 30,
            'name' => 'view company',
            'group_name' => 'company'
        ]);
        Permission::create([
            'id'  => 31,
            'name' => 'add company',
            'group_name' => 'company'
        ]);
        Permission::create([
            'id'  => 32,
            'name' => 'edit company',
            'group_name' => 'company'
        ]);
        Permission::create([
            'id'  => 33,
            'name' => 'delete company',
            'group_name' => 'company'
        ]);
        Permission::create([
            'id'  => 34,
            'name' => 'export company',
            'group_name' => 'company'
        ]);

        Permission::create([
            'id'  => 35,
            'name' => 'view branch',
            'group_name' => 'branch'
        ]);
        Permission::create([
            'id'  => 36,
            'name' => 'add branch',
            'group_name' => 'branch'
        ]);
        Permission::create([
            'id'  => 37,
            'name' => 'edit branch',
            'group_name' => 'branch'
        ]);
        Permission::create([
            'id'  => 38,
            'name' => 'delete branch',
            'group_name' => 'branch'
        ]);
        Permission::create([
            'id'  => 39,
            'name' => 'export branch',
            'group_name' => 'branch'
        ]);
        
        // $role = Role::create(['name' => 'Super Admin']);
        // $role->givePermissionTo(Permission::all());
    }
}
