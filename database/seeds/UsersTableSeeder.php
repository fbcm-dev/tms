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
                'password' => bcrypt('secret'),
                'username' => User::generateUsername('Paul Phillip', 'Nava', 'Villarosa')
            ],
            [
                'name' => 'Jeiel Araneta',
                'email' => 'jeielaraneta@gmail.com',
                'password' => bcrypt('secret'),
                'username' => User::generateUsername('Jeiel', '', 'Araneta')
            ]
        ];
        foreach ($users as $user) {
            $u = new User;
            $u->name = $user['name'];
            $u->username = $user['username'];
            $u->email = $user['email'];
            $u->password = bcrypt('secret');
            $u->save();

            $u->assignRole('superuser');
        }
    }
}
