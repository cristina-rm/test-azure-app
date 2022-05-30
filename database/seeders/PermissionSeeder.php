<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
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
        DB::transaction(function () {
            Role::create(['name' => 'Admin']);
            Role::create(['name' => 'User Manager']);
            Role::create(['name' => 'Trainer']);
            Role::create(['name' => 'User']);

            $permission1 = Permission::create(['name' => 'Manage users']);
            $permission1->syncRoles(['Admin', 'User Manager']);

            $permission2 = Permission::create(['name' => 'Manage roles']);
            $permission2->syncRoles(['Admin']);

            $permission3 = Permission::create(['name' => 'Manage permissions']);
            $permission3->syncRoles(['Admin']);

            $permission4 = Permission::create(['name' => 'Manage activities']);
            $permission4->syncRoles(['Admin', 'User Manager', 'Trainer', 'User']);
        });

        // php artisan db:seed --class=PermissionSeeder
    }
}
