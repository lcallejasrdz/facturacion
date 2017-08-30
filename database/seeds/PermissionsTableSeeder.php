<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'slug' => 'root',
            'name' => 'Root'
        ]);

        DB::table('permissions')->insert([
            'slug' => 'direction',
            'name' => 'Dirección'
        ]);

        DB::table('permissions')->insert([
            'slug' => 'companies_administrator',
            'name' => 'Administrador de Empresas'
        ]);

        DB::table('permissions')->insert([
            'slug' => 'operations_direction',
            'name' => 'Dirección de Operaciones'
        ]);

        DB::table('permissions')->insert([
            'slug' => 'operations',
            'name' => 'Operaciones'
        ]);

        DB::table('permissions')->insert([
            'slug' => 'dispersions_direction',
            'name' => 'Dirección de Dispersiones'
        ]);

        DB::table('permissions')->insert([
            'slug' => 'dispersions',
            'name' => 'Dispersiones'
        ]);

        DB::table('permissions')->insert([
            'slug' => 'banks_direction',
            'name' => 'Dirección de Bancos'
        ]);

        DB::table('permissions')->insert([
            'slug' => 'banks',
            'name' => 'Bancos'
        ]);
    }
}
