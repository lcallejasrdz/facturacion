<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('companies')->truncate();
    	
        DB::table('companies')->insert([
            'name' => 'Empresa 1',
            'disperser' => 'No',
        ]);

        DB::table('companies')->insert([
            'name' => 'Empresa 2',
            'disperser' => 'No',
        ]);

        DB::table('companies')->insert([
            'name' => 'Dispersora 1',
            'disperser' => 'Si',
        ]);
        
        DB::table('companies')->insert([
            'name' => 'Dispersora 2',
            'disperser' => 'Si',
        ]);
    }
}
