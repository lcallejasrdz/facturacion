<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Luis Eduardo Callejas',
            'email' => 'lcallejasrdz@gmail.com',
            'username' => 'lcallejas',
            'password' => bcrypt('asdasd'),
            'permission' => 1
        ]);
    }
}
