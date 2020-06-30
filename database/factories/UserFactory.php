<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pago;
use App\User;
use App\Corte;
use App\Especie;
use App\Mascota;
use App\Mensaje;
use App\Sepomex;
use App\Servicio;
use App\Categoria;
use App\Direccion;
use App\ModeloPago;
use App\Tratamiento;
use App\Veterinario;
use App\Calificacion;
use App\Organizacion;
use App\SubCategoria;
use App\ConsultaMedica;
use App\TipoTratamiento;
use App\ServicioContratado;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

/*----------  tipoTratamientos usara seeder  ----------*/
/*----------  permisos usara seeder  ----------*/
/*----------  tipoUsuarios usara seeder ----------*/
/*----------  sepomex cargar de sepomex ----------*/

/*----------  direcciones  ----------*/
$factory->define(Direccion::class, function (Faker $faker) {
    return [
        'calle' => $faker->streetName,
        'numExt' => $faker->randomNumber(3),
        'numInt' => $faker->optional($weight=0.6, $default='')->randomElement($array=  array( 'a','b','c','d','e','1','2','3')),
        'referencia' => $faker->text($maxNbChars= 150),
        'idSepomex' => Sepomex::inRandomOrder()->first()->id
    ];
});

/*----------  users  ----------*/
$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

/*----------  modelosPago usara seeder ----------*/


/*----------  organizacion  ----------*/
$factory->define(Organizacion::class, function (Faker $faker) {
    return [
        'nombreOrg' => $faker->company,
        'emailOrg' => $faker->unique()->freeEmail,
        'idModeloPago' => ModeloPago::inRandomOrder()->first()->id,
        'idDireccion' => ModeloPago::inRandomOrder()->first()->id
    ];
});

/*----------  cortes   ----------*/
$factory->define(Corte::class, function (Faker $faker) {
	$dateTime=$faker->dateTimeBetween($startDate='-1 years', $endDate= 'now');
	$requiereFactura= $faker->randomElement([Corte::REQUIERE_FACTURA , Corte::NO_REQUIERE_FACTURA]);
    return [
        'fecha' => $dateTime->format('Y-m-d H:i:s'),
        'periodo' => $dateTime->format('Y-m'),
        'monto' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 10000),
        'status' => $faker->randomElement([Corte::STATUS_ATRASADO, Corte::STATUS_PAGADO, Corte::STATUS_POR_PAGAR]),
        'requiereFactura' => $requiereFactura,
        'facturado' => ($requiereFactura==Corte::REQUIERE_FACTURA)? $faker->randomElement([Corte::FACTURA_EMITIDA, Corte::FACTURA_NO_EMITIDA]) : Corte::FACTURA_NO_EMITIDA ,
        'rutaFactura' => 'ND',
        'folioFiscal' => $faker->unique()->uuid,
        'fechaLimitePago' => $dateTime->modify('10 days')->format('Y-m-d H:i:s'),
        'idOrganizacion' => Organizacion::inRandomOrder()->first()->id
    ];
});

/*----------  pagos  ----------*/
$factory->define(Pago::class, function (Faker $faker) {
	$dateTime=$faker->dateTimeBetween($startDate='-1 years', $endDate= 'now');
    return [
        'fecha' => $dateTime->format('Y-m-d H:i:s'),
        'monto' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 10000),
        'metodoPago' => $faker->randomElement([Pago::METODO_PAGO_EFECTIVO, Pago::METODO_PAGO_TARJETA, Pago::METODO_PAGO_TRANSFERENCIA]),
        'status' => $faker->randomElement([Pago::STATUS_PASARELA_APROVADO, Pago::STATUS_PASARELA_RECHAZADO, Pago::STATUS_PASARELA_CANCELADO]),
        'statusPasarela' => $faker->randomElement([Pago::STATUS_PASARELA_APROVADO, Pago::STATUS_PASARELA_RECHAZADO, Pago::STATUS_PASARELA_CANCELADO]),
        'idCorte' => Corte::inRandomOrder()->first()->id
    ];
});

/*----------  categorias usara seeder  ----------*/
/*----------  subcategorias usara seeder ----------*/

/*----------  servicios  ----------*/
$factory->define(Servicio::class, function (Faker $faker) {
    $dateTime=$faker->dateTimeBetween($startDate='-1 years', $endDate= 'now');
    return [
        'nombreServicio' => $faker->jobTitle,
        'horaApertura' => $faker->time($format='H:i'),
        'horaCierre' => $faker->time($format='H:i'),
        'descripcion' => $faker->paragraph($nbSentences=1),
        'precioBase' => $faker->randomFloat($nbMaxDecimals = 2, $min = 100, $max = 5000),
        'servicioContinuo' => $faker->randomElement([Servicio::CON_SERVICIO_CONTINUO, Servicio::SIN_SERVICIO_CONTINUO]),
        'idUsuario' => User::inRandomOrder()->first()->id,
        'idSubcategoria' => SubCategoria::inRandomOrder()->first()->id
    ];
});


/*----------  tipoServicios posible necesario replantear con el equipo  ----------*/
/*----------  especies usara seeder  ----------*/

/*----------  mascotas  ----------*/
$factory->define(Mascota::class, function (Faker $faker) {
    return [
        'nombreMascota' => $faker->firstName($gender = null),
        'fechaNacimiento' => $faker->dateTimeBetween($startDate='-5 years', $endDate= 'now')->format('Y-m-d H:i:s'),
        'raza' => $faker->streetName,
        'color' => $faker->colorName,
        'peso' => $faker->randomFloat($nbMaxDecimals = 3, $min = 1, $max = 100),
        'tamaño' => $faker->randomElement([Mascota::TAMANO_CHICO, Mascota::TAMANO_MEDIANO, Mascota::TAMANO_GRANDE]),
        'sexo' => $faker->randomElement([Mascota::SEXO_MACHO, Mascota::SEXO_HEMBRA]),
        'senParticulares' => $faker->sentence($nbWords = 8 , $variableNbWords = true),
        'idEspecie' => Especie::inRandomOrder()->first()->id,
        'idUsuario' => User::inRandomOrder()->first()->id
    ];
});


/*----------  veterinarios  ----------*/
$factory->define(Veterinario::class, function (Faker $faker) {
    return [
        'cedula' => $faker->numerify('CED-###'),
        'curriculum' => $faker->text($maxNbChars = 550),
        'titulo' => $faker->jobTitle,
        'experiencia' => $faker->text($maxNbChars = 550),
        'universidad' => $faker->company,
        'idUsuario' => User::inRandomOrder()->first()->id
    ];
});

/*----------  tratamientos  ----------*/
$factory->define(Tratamiento::class, function (Faker $faker) {
    return [
        'fechaTratamiento' => $faker->dateTimeBetween($startDate='-5 years', $endDate= 'now')->format('Y-m-d H:i:s'),
        'nombreTratamiento' => $faker->bs,
        'etiqueta' => $faker->sentence($nbWords = 8, $variableNbWords = true),
        'proximoTratamiento' => $faker->dateTimeBetween($startDate='-5 years', $endDate= 'now')->format('Y-m-d H:i:s'),
        'idTipoTratamiento' => TipoTratamiento::inRandomOrder()->first()->id,
        'idMascota' => Mascota::inRandomOrder()->first()->id,
        'idVeterinario' => Veterinario::inRandomOrder()->first()->id
    ];
});

/*----------  consultasMedicas  ----------*/
$factory->define(ConsultaMedica::class, function (Faker $faker) {
    return [
        'diagnostico' => $faker->text($maxNbChars = 100),
        'tratamiento' => $faker->text($maxNbChars = 150),
        'comentarios' => $faker->sentence($nbWords = 8, $variableNbWords = true),
        'fechaConsulta' => $faker->dateTimeBetween($startDate='-5 years', $endDate= 'now')->format('Y-m-d H:i:s'),
        'idMascota' => Mascota::inRandomOrder()->first()->id,
        'idVeterinario' => Veterinario::inRandomOrder()->first()->id
    ];
});


/*----------  serviciosContratados  ----------*/
$factory->define(ServicioContratado::class, function (Faker $faker) {
    return [
        'nombreServicio' => $faker->sentence($nbWords = 8, $variableNbWords = true),
        'descripcion' => $faker->text($maxNbChars = 350),
        'precioBase' => $faker->randomFloat($nbMaxDecimals = 2, $min = 100, $max = 5000),
        'observacinesFinales' => $faker->paragraph($nbSentences=1),
        'statusServicio' => $faker->randomElement([
            ServicioContratado::STATUS_SERVICIO_TERMINADO, 
            ServicioContratado::STATUS_SERVICIO_PENDIENTE,
            ServicioContratado::STATUS_SERVICIO_CANCELADO,
            ServicioContratado::STATUS_SERVICIO_RECLAMO
        ]),
        'costoFinal' => $faker->randomFloat($nbMaxDecimals = 2, $min = 100, $max = 5000),
        'fechaContrato' => $faker->dateTimeBetween($startDate='-5 years', $endDate= 'now')->format('Y-m-d H:i:s'),
        'fechaTermino' => $faker->dateTimeBetween($startDate='-5 years', $endDate= 'now')->format('Y-m-d H:i:s'),
        'fechaEjecucion' => $faker->dateTimeBetween($startDate='-5 years', $endDate= 'now')->format('Y-m-d H:i:s'),
        'idUsuarioContrato' => User::inRandomOrder()->first()->id,
        'idMascota' => Mascota::inRandomOrder()->first()->id,
        'idSubcategoria' => SubCategoria::inRandomOrder()->first()->id
    ];
});

/*----------  mensajes  ----------*/
$factory->define(Mensaje::class, function (Faker $faker) {
    return [
        'idUsuarioEmisor' => User::inRandomOrder()->first()->id,
        'idUsuarioReceptor' => User::inRandomOrder()->first()->id,
        'idServicioContratado' => ServicioContratado::inRandomOrder()->first()->id,
        'mensaje' => $faker->paragraph($nbSentences=3),
        'fechaEnvio' => $faker->dateTimeBetween($startDate='-5 years', $endDate= 'now')->format('Y-m-d H:i:s')
    ];
});

/*----------  calificaciones  ----------*/
$factory->define(Calificacion::class, function (Faker $faker) {
    return [
        'calificacion' => $faker->numberBetween($min = 1, $max = 5),
        'comentario' => $faker->text($maxNbChars = 500),
        'fechaCalificacion' => $faker->dateTimeBetween($startDate='-5 years', $endDate= 'now')->format('Y-m-d H:i:s'),
        'idServicio' => Servicio::inRandomOrder()->first()->id,
        'idUsuarioContrato' => User::inRandomOrder()->first()->id,
        'idUsuarioPrestador' => User::inRandomOrder()->first()->id,
        'idServicioContratado' => ServicioContratado::inRandomOrder()->first()->id
    ];
});

/*----------  mascotaVeterinario  ----------*/
/*   NO EXISTE MODELO
$factory->define(Calificacion::class, function (Faker $faker) {
    return [
        'idMascota' => Mascota::inRandomOrder()->first()->id,
        'idVeterinario' => Veterinario::inRandomOrder()->first()->id,
        'puedeEditar' => $faker->randomElement([true, false])
    ];
});
*/

/*----------  permisosTipo  ----------*/


/*----------  serviciosTipo  ----------*/

/*----------  organizacionUsuario  ----------*/

/*----------  especieServicio  ----------*/