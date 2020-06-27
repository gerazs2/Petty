<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisosSeeder extends Seeder
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
        DB::table('permisos')->insert([
            'nombrePermiso' => 'Agregar servicios',
            'descripcionPermiso' => 'Agregar servicios a la lista de servicios ofrecidos al publico',
            'created_at' => $date
        ]);

        DB::table('permisos')->insert([
            'nombrePermiso' => 'Editar Servicios',
            'descripcionPermiso' => 'Editar servicios de la lista de servicios ofrecidos al publico',
            'created_at' => $date
        ]);

        DB::table('permisos')->insert([
            'nombrePermiso' => 'Eliminar servicios',
            'descripcionPermiso' => 'Eliminar servicios a la lista de servicios ofrecidos al publico',
            'created_at' => $date
        ]);

        DB::table('permisos')->insert([
            'nombrePermiso' => 'Editar datos de la organizacion',
            'descripcionPermiso' => 'Editar datos de la organizacion visibles al publico',
            'created_at' => $date
        ]);

        DB::table('permisos')->insert([
            'nombrePermiso' => 'Acceso a pagos',
            'descripcionPermiso' => 'Tener acceso a la informacion sobre pagos realizados y por realizar de la organizacion',
            'created_at' => $date
        ]);
    }
}
