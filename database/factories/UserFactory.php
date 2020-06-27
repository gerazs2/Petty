<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Corte;
use App\Direccion;
use App\ModeloPago;
use App\Organizacion;
use App\Pago;
use App\Sepomex;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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
        'numInt' => $faker->optional($weight=0.6, $default=null)->randomElement($array=  array( 'a','b','c','d','e','1','2','3')),
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

/*----------  tipoServicios posible no aplica  ----------*/

/*----------  especies no apllica  ----------*/

/*----------  mascotas  ----------*/

/*----------  veterinarios  ----------*/

/*----------  tratamientos  ----------*/

/*----------  consultasMedicas  ----------*/

/*----------  serviciosContratados  ----------*/

/*----------  mensajes  ----------*/

/*----------  calificaciones  ----------*/

/*----------  mascotaVeterinario  ----------*/

/*----------  permisosTipo  ----------*/

/*----------  serviciosTipo  ----------*/

/*----------  organizacionUsuario  ----------*/

/*----------  especieServicio  ----------*/