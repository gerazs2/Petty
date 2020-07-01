<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ApiResponser;

    /**
     *
     * Esta clase la extiende el controlador base de laravel.
     * Se aplicaría para generalizar las respuestas, codigos y mensajes
     * que devolverá el API
     *
     */
    

    /**
     * solicitud aceptada, la respuesta contiene informacion y/o la solicitud
     * fue realizada de manera satisfactoria.
     * especificamente para métodos GET,PUT o DELETE
     */
    const CODE_OK = 200;
    const MESSAGE_OK_ = 'Ok';

    /**
     * la solicitud de creación de algún registro fue satisfactoria
     * especificamente para el método POST 
     */
    const CODE_CREATED = 201;
    const MESSAGE_CREATED = 'Creación exitosa.';

    /**
     * se realizó la solicitud de manera satosfactoria pero no se 
     * encontraron datos para devolver en la respuesta
     *
     */
    const CODE_NO_CONTENT = 204;
    const MESSAGE_NO_CONTENT = 'No se encontraron registros.';

    /**
     * se realizó la solicitud pero ocurrió algún error debido a que no
     * se proporcionaron los parametros necesarios o se enviaron con información
     * errónea.
     */
    const CODE_BAD_REQUEST = 400;
    const MESSAGE_BAD_REQUEST = 'No se pudo realizar la solicitud. ';

    /**
     * el cliente no se ha autentificado para realizar alguna petición o sus 
     * credenciales son erróneas
     */
    const CODE_UNAUTHORIZED = 401;
    const MESSAGE_UNAUTHORIZED = 'Credenciales incorrectas.';

    /**
     * el cliente intenta realizar una petición de la cual no tiene los 
     * privilegios suficientes, por ejemplo intentar obtener  o modificar 
     * informacion de otro usuario.
     */
    const CODE_FORBIDDEN = 403;
    const MESSAGE_FORBIDDEN = 'No tiene permisos necesarios. ';

    /**
     * la ruta o destino al que intenta acceder no existe.
     */
    const CODE_NOT_FOUND = 404;
    const MESSAGE_NOT_FOUND = 'Ruta o endpoint no encontrado.';

    /**
     * se produce cuando el método de la solicitud no es el admitido 
     * para la petición que el cliente intenta hacer.
     */
    const CODE_METHOD_NOT_ALLOWED = 405;
    const MESSAGE_METHOD_NOT_ALLOWED = 'El método de la petición HTTP no es el correcto. ';

    /**
     * el cliente ha solicitado la respuesta en un formato no permitido
     */    
    const CODE_NOT_ACCEPTABLE = 406;
    const MESSAGE_NOT_ACCEPTABLE = 'No se puede devolver la respuesta en el formato solicitado en la petición. ';

    /**
     * ha ocurrido un problema al intentar modificar algun registro o
     * no se ha podido modificar en ese momento por diversos motivos.
     *
     */
    const CODE_CONFLICT = 409;
    const MESSAGE_OK = 'No se ha podido modificar el registro debido a un conflicto. ';

    /**
     * el formato especificado en la cabecera 'content-type' en la peticion no es 
     * permitido
     */
    const CODE_UNSUPPORTED_MEDIA_TYPE = 415;
    const MESSAGE_UNSUPPORTED_MEDIA_TYPE = 'El formato especificado en la cabecera content-type no es permitido.';

    /**
     * ocurrió un error interno del servidor
     */
    const CODE_INTERNAL_SERVER_ERROR = 500;
    const MESSAGE_INTERNAL_SERVER_ERROR = 'Ocurrió un error interno en el servidor. ';



}
