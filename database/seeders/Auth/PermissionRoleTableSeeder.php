<?php

namespace Database\Seeders\Auth;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

/**
 * Class PermissionRoleTableSeeder.
 */
class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        // Create Roles
        $super_admin = Role::create(['id' => '1', 'name' => 'super admin']);
        $deliveryman = Role::create(['id' => '2', 'name' => 'deliveryman']);
        $manager = Role::create(['id' => '3', 'name' => 'client']);

        // Create Permissions
        Permission::firstOrCreate(['name' => 'view_backend']);
        Permission::firstOrCreate(['name' => 'add_cars']);
        Permission::firstOrCreate(['name' => 'view_cars']);
        Permission::firstOrCreate(['name' => 'edit_cars']);
        Permission::firstOrCreate(['name' => 'delete_cars']);

        Permission::firstOrCreate(['name' => 'add_parcels']);
        Permission::firstOrCreate(['name' => 'view_parcels']);
        Permission::firstOrCreate(['name' => 'edit_parcels']);
        Permission::firstOrCreate(['name' => 'delete_parcels']);

        $permissions = Permission::defaultPermissions();

        foreach ($permissions as $perms) {
            Permission::firstOrCreate(['name' => $perms]);
        }
        // Assign Permissions to Roles
        $super_admin->givePermissionTo(Permission::all());
        $deliveryman->givePermissionTo('view_backend', 'add_cars', 'view_cars', 'edit_cars', 'delete_cars');
        $manager->givePermissionTo('view_backend',  'add_parcels', 'view_parcels', 'edit_parcels', 'delete_parcels');

        Schema::enableForeignKeyConstraints();
    }
}
