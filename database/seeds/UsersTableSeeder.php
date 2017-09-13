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
        DB::table('administrator_companies')->truncate();
        
        DB::table('users')->insert([
            'name' => 'Operaciones',
            'email' => 'operaciones@algo.com',
            'username' => 'operaciones',
            'password' => bcrypt('asdasd'),
            'permission' => 5
        ]);

        DB::table('users')->insert([
            'name' => 'Administrador de Empresas 1',
            'email' => 'aempresas1@algo.com',
            'username' => 'aempresas1',
            'password' => bcrypt('asdasd'),
            'permission' => 3
        ]);

        DB::table('administrator_companies')->insert([
            'user' => 3,
            'company' => 1,
        ]);

        DB::table('administrator_companies')->insert([
            'user' => 3,
            'company' => 3,
        ]);

        DB::table('users')->insert([
            'name' => 'Administrador de Empresas 2',
            'email' => 'aempresas2@algo.com',
            'username' => 'aempresas2',
            'password' => bcrypt('asdasd'),
            'permission' => 3
        ]);

        DB::table('administrator_companies')->insert([
            'user' => 4,
            'company' => 2,
        ]);

        DB::table('administrator_companies')->insert([
            'user' => 4,
            'company' => 4,
        ]);

        DB::table('users')->insert([
            'name' => 'Bancos',
            'email' => 'bancos@algo.com',
            'username' => 'bancos',
            'password' => bcrypt('asdasd'),
            'permission' => 9
        ]);

        DB::table('users')->insert([
            'name' => 'Dispersiones',
            'email' => 'dispersiones@algo.com',
            'username' => 'dispersiones',
            'password' => bcrypt('asdasd'),
            'permission' => 7
        ]);
    }
}
