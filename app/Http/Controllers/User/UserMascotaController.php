<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserMascotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $mascotas = $user->mascotas;
        return $this->showOne($mascotas, Controller::MESSAGE_OK_, Controller::CODE_OK);
    }

    
}
