<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users  = [
            [
                'name' => 'Paul Phillip Villarosa',
                'email' => 'ppvillarosa@gmail.com',
                'password' => bcrypt('secret'),
            ],
            [
                'name' => 'Jeiel Araneta',
                'email' => 'jeielaraneta@gmail.com',
                'password' => bcrypt('secret'),
            ]
        ];
        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }
    }
}
