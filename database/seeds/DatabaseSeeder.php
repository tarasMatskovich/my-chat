<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(\App\User::class)->create(
            [
                'email' => 'sarthak@gmail.com',
                'first_name' => 'Sarthak'
            ]
        );

        factory(\App\User::class)->create(
            [
                'email' => 'bitfumes@gmail.com',
                'first_name' => 'Bitfumes'
            ]
        );

        factory(\App\User::class)->create(
            [
                'email' => 'ankur@gmail.com',
                'first_name' => 'Ankur'
            ]
        );
    }
}
