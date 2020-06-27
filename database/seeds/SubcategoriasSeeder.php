<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcategoriasSeeder extends Seeder
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
        DB::table('subcategorias')->insert([
            'nombreSubCat' => 'Consulta general',
            'descripcionSubCat' => 'Consultas médicas en general',
            'idCategoria' => 'Para servicios como consultas médicas, cirugías, rehabilitaciones, etc.',
            'created_at' => $date
        ]);

        DB::table('subcategorias')->insert([
            'nombreSubCat' => 'Cirugias',
            'descripcionSubCat' => 'Cirugías especializadas para mascotas',
            'idCategoria' => 'Para servicios como consultas médicas, cirugías, rehabilitaciones, etc.',
            'created_at' => $date
        ]);

        DB::table('subcategorias')->insert([
            'nombreSubCat' => 'Especialidad',
            'descripcionSubCat' => 'Servicios de médicos veterinarios especialistas',
            'idCategoria' => 'Para servicios como consultas médicas, cirugías, rehabilitaciones, etc.',
            'created_at' => $date
        ]);

        DB::table('subcategorias')->insert([
            'nombreSubCat' => 'Rehabilitación',
            'descripcionSubCat' => 'Rehabilitaciones para mascotas',
            'idCategoria' => 'Para servicios como consultas médicas, cirugías, rehabilitaciones, etc.',
            'created_at' => $date
        ]);

        DB::table('subcategorias')->insert([
            'nombreSubCat' => 'Rayos X',
            'descripcionSubCat' => 'Rayos X ',
            'idCategoria' => 'Para servicios como consultas médicas, cirugías, rehabilitaciones, etc.',
            'created_at' => $date
        ]);

        DB::table('subcategorias')->insert([
            'nombreSubCat' => 'Estudios en laboratorio',
            'descripcionSubCat' => 'Para servicios como consultas médicas, cirugías, rehabilitaciones, etc.',
            'idCategoria' => 'Para servicios como consultas médicas, cirugías, rehabilitaciones, etc.',
            'created_at' => $date
        ]);

        DB::table('subcategorias')->insert([
            'nombreSubCat' => 'Ultrasonido',
            'descripcionSubCat' => 'Para servicios como consultas médicas, cirugías, rehabilitaciones, etc.',
            'idCategoria' => 'Para servicios como consultas médicas, cirugías, rehabilitaciones, etc.',
            'created_at' => $date
        ]);

        DB::table('subcategorias')->insert([
            'nombreSubCat' => 'Higiene',
            'descripcionSubCat' => 'Para servicios como consultas médicas, cirugías, rehabilitaciones, etc.',
            'idCategoria' => 'Para servicios como consultas médicas, cirugías, rehabilitaciones, etc.',
            'created_at' => $date
        ]);

        DB::table('subcategorias')->insert([
            'nombreSubCat' => 'Cortes',
            'descripcionSubCat' => 'Para servicios como consultas médicas, cirugías, rehabilitaciones, etc.',
            'idCategoria' => 'Para servicios como consultas médicas, cirugías, rehabilitaciones, etc.',
            'created_at' => $date
        ]);

        DB::table('subcategorias')->insert([
            'nombreSubCat' => 'Spa',
            'descripcionSubCat' => 'Para servicios como consultas médicas, cirugías, rehabilitaciones, etc.',
            'idCategoria' => 'Para servicios como consultas médicas, cirugías, rehabilitaciones, etc.',
            'created_at' => $date
        ]);

        DB::table('subcategorias')->insert([
            'nombreSubCat' => 'Acupuntura',
            'descripcionSubCat' => 'Para servicios como consultas médicas, cirugías, rehabilitaciones, etc.',
            'idCategoria' => 'Para servicios como consultas médicas, cirugías, rehabilitaciones, etc.',
            'created_at' => $date
        ]);

        DB::table('subcategorias')->insert([
            'nombreSubCat' => 'Aromaterapia',
            'descripcionSubCat' => 'Para servicios como consultas médicas, cirugías, rehabilitaciones, etc.',
            'idCategoria' => 'Para servicios como consultas médicas, cirugías, rehabilitaciones, etc.',
            'created_at' => $date
        ]);

    }
}
