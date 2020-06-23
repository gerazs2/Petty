<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/



//Route::apiResource('users', 'User\UserCotroller');




// Ruta de Mascota
Route::apiresource('mascota','Mascota\MascotaController');
// Ruta de servicio
Route::apiresource('servicio','Servicio\ServicioController');
// Ruta De Calificacion
Route::apiresource('calificacion','Calificacion\CalificacionController');
// Ruta De Categoria
Route::apiresource('categoria','Categoria\CategoriaController');
// Ruta De Especie
Route::apiresource('especie','Especie\EspecieController');
// Ruta De Tratamiento 
Route::apiresource('tratamiento','Tratamiento\TratamientoController');
// Ruta De Consulta Medica
Route::apiresource('consultaMedica','ConsultaMedica\ConsultaMedicaController');
// Ruta De Direccion
Route::apiresource('direccion','Direccion\DireccionController');
// Ruta De Permiso
Route::apiresource('permiso','Permiso\PermisoController');
// Ruta De Mensaje
Route::apiresource('mensaje','Mensaje\MensajeController');
// Ruta De Corte
Route::apiresource('corte','Corte\CorteController');
// Ruta De Organizacion
Route::apiresource('organizacion','Organizacion\OrganizacionController');
// Ruta De SubCategoria
Route::apiresource('subCategoria','SubCategoria\SubCategoriaController');
// Ruta De Pago
Route::apiresource('pago','Pago\PagoController');
// Ruta Modelo Pago
Route::apiresource('modeloPago','ModeloPago\ModeloPagoController');
// Ruta Servicio Contratado
Route::apiresource('servicioContratado','ServicioContratado\ServicioContratadoController');
// Ruta Tipo Servicio
Route::apiresource('tipoServicio','TipoServicio\TipoServicioController');
// Ruta Tipo Tratamiento
Route::apiresource('tipoTratamiento','TipoTratamiento\TipoTratamientoController');
// Ruta Veterinario
Route::apiresource('veterinario','Veterinario\VeterinarioController');