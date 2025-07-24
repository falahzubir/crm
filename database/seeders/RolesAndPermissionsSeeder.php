<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
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
        
        Permission::firstOrCreate(['name' => 'permission.update']);
        Permission::firstOrCreate(['name' => 'view.customer_list']);
        Permission::firstOrCreate(['name' => 'view.roles']);

        // create roles and assign created permissions
        $role = Role::firstOrCreate(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        //giverole to user
        $user = \App\Models\User::find(1);
        $user->assignRole('admin');
    }
}
