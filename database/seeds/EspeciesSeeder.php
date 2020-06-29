<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EspeciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $date = new DateTime();
        DB::table('especies')->insert([
            'tipoEspecie' => 'Caninos',
            'created_at' => $date
        ]);

        $date = new DateTime();
        DB::table('especies')->insert([
            'tipoEspecie' => 'Felinos',
            'created_at' => $date
        ]);

        $date = new DateTime();
        DB::table('especies')->insert([
            'tipoEspecie' => 'Equinos',
            'created_at' => $date
        ]);

        $date = new DateTime();
        DB::table('especies')->insert([
            'tipoEspecie' => 'Aves',
            'created_at' => $date
        ]);

        $date = new DateTime();
        DB::table('especies')->insert([
            'tipoEspecie' => 'Reptiles',
            'created_at' => $date
        ]);

        $date = new DateTime();
        DB::table('especies')->insert([
            'tipoEspecie' => 'Anfibios',
            'created_at' => $date
        ]);
    }
}
