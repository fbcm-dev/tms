<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Log;

class RolesPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles_permissions = [
        	'superuser' => [
        		'superuser'
        	],
        	'member_manager' => [
        		'can add member',
        		'can edit member',
        		'can delete member',
        	],
        	'checker' => [
        		'can check record',
        		'can delete record',
        		'can update record',
        		'can generate report',
        	],
        	'encoder' => [
        		'can encode record',
        		'can update record',
        	]
        ];

        foreach ($roles_permissions as $role => $permissions) {
            $role = Role::create(['name' => $role]);

            echo "> Role created: " . $role->name . "\n";

        	foreach ($permissions as $permission) {
        		Permission::firstOrCreate(['name' => $permission]);
                echo "=> Permission created: " . $permission . "\n";
        	}

        	$role->givePermissionTo($permissions);
            echo "\n";
        }
    }
}
