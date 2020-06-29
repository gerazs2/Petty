<?php


use App\Categoria;
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
        $idCategoriaServicioMedico = Categoria::where('nombreCategoria', 'Servicio médico')->value('id');
        $idCategoriaBelleza = Categoria::where('nombreCategoria', 'Estetica y belleza')->value('id');
        $idCategoriaHospedaje = Categoria::where('nombreCategoria', 'Hospedaje')->value('id');
        $idCategoriaEntrenamiento = Categoria::where('nombreCategoria', 'Entrenamiento')->value('id');
        $idCategoriaPaseos = Categoria::where('nombreCategoria', 'Paseos')->value('id');

        $date = new DateTime();
        
        DB::table('subcategorias')->insert([
            'nombreSubCat' => 'Cirugias',
            'descripcionSubCat' => 'Cirugías especializadas para mascotas',
            'idCategoria' => $idCategoriaServicioMedico,
            'created_at' => $date
        ]);

        DB::table('subcategorias')->insert([
            'nombreSubCat' => 'Especialidad',
            'descripcionSubCat' => 'Servicios de médicos veterinarios especialistas',
            'idCategoria' => $idCategoriaServicioMedico,
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
            'idCategoria' => $idCategoriaServicioMedico,
            'created_at' => $date
        ]);

        DB::table('subcategorias')->insert([
            'nombreSubCat' => 'Estudios en laboratorio',
            'descripcionSubCat' => 'Para servicios como consultas médicas, cirugías, rehabilitaciones, etc.',
            'idCategoria' => $idCategoriaServicioMedico,
            'created_at' => $date
        ]);

        DB::table('subcategorias')->insert([
            'nombreSubCat' => 'Ultrasonido',
            'descripcionSubCat' => 'Para servicios como consultas médicas, cirugías, rehabilitaciones, etc.',
            'idCategoria' => $idCategoriaServicioMedico,
            'created_at' => $date
        ]);

        DB::table('subcategorias')->insert([
            'nombreSubCat' => 'Higiene',
            'descripcionSubCat' => 'Para servicios como consultas médicas, cirugías, rehabilitaciones, etc.',
            'idCategoria' => $idCategoriaBelleza,
            'created_at' => $date
        ]);

        DB::table('subcategorias')->insert([
            'nombreSubCat' => 'Cortes',
            'descripcionSubCat' => 'Para servicios como consultas médicas, cirugías, rehabilitaciones, etc.',
            'idCategoria' => $idCategoriaBelleza,
            'created_at' => $date
        ]);

        DB::table('subcategorias')->insert([
            'nombreSubCat' => 'Spa',
            'descripcionSubCat' => 'Para servicios como consultas médicas, cirugías, rehabilitaciones, etc.',
            'idCategoria' => $idCategoriaBelleza,
            'created_at' => $date
        ]);

        DB::table('subcategorias')->insert([
            'nombreSubCat' => 'Acupuntura',
            'descripcionSubCat' => 'Para servicios como consultas médicas, cirugías, rehabilitaciones, etc.',
            'idCategoria' => $idCategoriaBelleza,
            'created_at' => $date
        ]);

        DB::table('subcategorias')->insert([
            'nombreSubCat' => 'Aromaterapia',
            'descripcionSubCat' => 'Para servicios como consultas médicas, cirugías, rehabilitaciones, etc.',
            'idCategoria' => $idCategoriaBelleza,
            'created_at' => $date
        ]);

        DB::table('subcategorias')->insert([
            'nombreSubCat' => 'Hospedaje',
            'descripcionSubCat' => 'Para servicios de hospedaje como hoteles o alojamiento temporal para mascotas',
            'idCategoria' => $idCategoriaHospedaje,
            'created_at' => $date
        ]);

        DB::table('subcategorias')->insert([
            'nombreSubCat' => 'Entrenamiento',
            'descripcionSubCat' => 'Para servicios de adiestramiento para mascotas',
            'idCategoria' => $idCategoriaEntrenamiento,
            'created_at' => $date
        ]);

        DB::table('subcategorias')->insert([
            'nombreSubCat' => 'Paseos',
            'descripcionSubCat' => 'Para servicios de paseos de mascotas',
            'idCategoria' => $idCategoriaPaseos,
            'created_at' => $date
        ]);

    }
}
