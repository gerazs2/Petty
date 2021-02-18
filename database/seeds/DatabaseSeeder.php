<?php

use App\Pago;
use App\User;
use App\Corte;
use App\Especie;
use App\Mascota;
use App\Mensaje;
use App\Permiso;
use App\Sepomex;
use App\Servicio;
use App\Categoria;
use App\Direccion;
use App\ModeloPago;
use App\TipoUsuario;
use App\Tratamiento;
use App\Veterinario;
use App\Calificacion;
use App\Organizacion;
use App\SubCategoria;
use App\TipoServicio;
use App\ConsultaMedica;
use App\TipoTratamiento;
use App\ServicioContratado;
use App\OrganizacionUsuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        
        /*----------  Vaciamos la DB y deshabilitamos temporalmente la revision de llaves foraneas  ----------*/
        /*
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Calificacion::truncate();
        Categoria::truncate();
        ConsultaMedica::truncate();
        Corte::truncate();
        Direccion::truncate();
        Especie::truncate();
        Mascota::truncate();
        Mensaje::truncate();
        ModeloPago::truncate();
        Organizacion::truncate();
        Pago::truncate();
        Permiso::truncate();
        //Sepomex::truncate();
        Servicio::truncate();
        ServicioContratado::truncate();
        SubCategoria::truncate();
        TipoServicio::truncate();
        TipoTratamiento::truncate();
        TipoUsuario::truncate();
        Tratamiento::truncate();
        User::truncate();
        Veterinario::truncate();
        DB::table('mascotaVeterinario')->truncate();
        DB::table('permisosTipo')->truncate();
        DB::table('servicioTipo')->truncate();
        DB::table('organizacionUsuario')->truncate();
        DB::table('especieServicio')->truncate();

        /*----------  Ejecutamos los Seeders  ----------*/
        /**
         *
         * se ejecutan los seeders previamente definidos en la carpeta 'database/seeds'
         * pasamos como parametro la clase del Seeder que se pretende ejecutar
         */
        /*
        $this->call(CategoriasSeeder::class);
        $this->call(EspeciesSeeder::class);
        $this->call(ModelosPagoSeeder::class);
        $this->call(PermisosSeeder::class);
        $this->call(SubcategoriasSeeder::class);
        $this->call(TipoTratamientosSeeder::class);
        $this->call(TipoUsuariosSeeder::class);

        /*----------  Ejecutamos los factories  ----------*/
        /**
         *
         * se ejecutan los factories previamente definidos en la carpeta 'database/factories'
         * primer parametro: La clase del MODELO que se pretende llenar
         * segundo parametro: El número de registros que se desean almacenar
         *
         */
        /*
        factory(Direccion::class, 100)->create(); 
        factory(User::class, 100)->create();
        factory(Organizacion::class, 80)->create()->each(
            function($organizacion){
                $usuarios = User::all()->random(mt_rand(1, 3))->pluck('id'); //obtenemos un numero aleatorio de colecciones de mascotas para relacionarlos con el registro del veterinario
                $esAdmin = mt_rand(0,1) == 1;
                $organizacion->usuariosOrganizacion()->attach($usuarios, ['esAdmin' => $esAdmin]); //insertamos las relaciones en la tabla pivote
            }
        );
        factory(Corte::class, 150)->create();
        factory(Pago::class, 120)->create();
        
        factory(Servicio::class, 10000)->create()->each(
            function($servicio){
                $especies = Especie::all()->random(mt_rand(1,3))->pluck('id');
                $servicio->especiesServicio()->attach($especies);
            }
        );
        */
        /*
        factory(Mascota::class, 150)->create();
        factory(Veterinario::class, 80)->create()->each(
            function($veterinario){// se ejecuta esta funcion cada vez que se inserta un registro devolviendo el registro insertado como tal
                $mascotas = Mascota::all()->random(mt_rand(1, 5))->pluck('id'); //obtenemos un numero aleatorio de colecciones de mascotas para relacionarlos con el registro del veterinario
                $puedeEditar = mt_rand(0,1) == 1;
                $veterinario->permisoVeterinarios()->attach($mascotas, ['puedeEditar' => $puedeEditar]); //insertamos las relaciones en la tabla pivote
            }
        );
        factory(Tratamiento::class, 100)->create();
        factory(ConsultaMedica::class, 150)->create();
        factory(ServicioContratado::class, 150)->create();
        factory(Mensaje::class, 100)->create();
        
        */
        /*
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
        ]);
        */

        

        //factory(OrganizacionUsuario::class, 1000)->create();

    }
}
