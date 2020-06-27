<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoTratamientosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = new DateTime();
        DB::table('tipoTratamientos')->insert([
            'nombre' => 'Rehabilitacion',
            'created_at' => $date
        ]);

        DB::table('tipoTratamientos')->insert([
            'nombre' => 'Vacunacion',
            'created_at' => $date
        ]);

        DB::table('tipoTratamientos')->insert([
            'nombre' => 'Preventivo',
            'created_at' => $date
        ]);

        DB::table('tipoTratamientos')->insert([
            'nombre' => 'Terapia',
            'created_at' => $date
        ]);

        DB::table('tipoTratamientos')->insert([
            'nombre' => 'No aplica',
            'created_at' => $date
        ]);
    }


}
