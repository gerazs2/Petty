<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoUsuariosSeeder extends Seeder
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
        DB::table('tipoUsuarios')->insert([
            'tipoUsuario' => 'Subcuenta',
            'descripcionUsuario' => 'Cuenta creada unicamente para hacer uso de los servicios que presta la organizacion',
            'created_at' => $date
        ]);

        DB::table('tipoUsuarios')->insert([
            'tipoUsuario' => 'Administrador',
            'descripcionUsuario' => 'Cuenta con todos los permisos permitidos para administrar la cuenta de la organizacion',
            'created_at' => $date
        ]);

        DB::table('tipoUsuarios')->insert([
            'tipoUsuario' => 'Consumidor',
            'descripcionUsuario' => 'Cuenta creada unicamente para contratar los servicios ofrecidos en la aplicacion',
            'created_at' => $date
        ]);
    }
}
