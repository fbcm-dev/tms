<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use TMS\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'superuser']);
        $permission = Permission::create(['name' => 'superuser']);

        $users  = [
            [
                'name' => 'Paul Phillip Villarosa',
                'email' => 'ppvillarosa@gmail.com',
            ],
            [
                'name' => 'Jeiel Araneta',
                'email' => 'jeielaraneta@gmail.com',
            ]
        ];
        foreach ($users as $user) {
            $u = new User;
            $u->name = $user['name'];
            $u->email = $user['email'];
            $u->save();

            $u->assignRole('superuser');
        }
    }
}
