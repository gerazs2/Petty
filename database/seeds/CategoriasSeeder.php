<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasSeeder extends Seeder
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
        DB::table('categorias')->insert([
            'nombreCategoria' => 'Servicio médico',
            'descripcionCategoria' => 'Para servicios como consultas médicas, cirugías, rehabilitaciones, etc.',
            'created_at' => $date
        ]);

        DB::table('categorias')->insert([
            'nombreCategoria' => 'Estetica y belleza',
            'descripcionCategoria' => 'Para servicios como cortes, baños, limpieza dental, spa, etc.',
            'created_at' => $date
        ]);

        DB::table('categorias')->insert([
            'nombreCategoria' => 'Hospedaje',
            'descripcionCategoria' => 'Hospedaje para mascotas',
            'created_at' => $date
        ]);

        DB::table('categorias')->insert([
            'nombreCategoria' => 'Entrenamiento',
            'descripcionCategoria' => 'Adiestramiento para mascotas',
            'created_at' => $date
        ]);

        DB::table('categorias')->insert([
            'nombreCategoria' => 'Paseos',
            'descripcionCategoria' => 'Servicio de paseo de mascotas',
            'created_at' => $date
        ]);
    }
}
