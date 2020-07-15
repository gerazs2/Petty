<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'superadministrador' => [
            'calificacion' => 'l,v,c,a,e',
            'categoria' => 'l,v,c,a,e',
            'consulta-medica' => 'l,v,c,a,e',
            'corte' => 'l,v,c,a,e',
            'direccion' => 'l,v,c,a,e',
            'especie' => 'l,v,c,a,e',
            'mascota' => 'l,v,c,a,e',
            'mensaje' => 'l,v,c,a,e',
            'modelo-pago' => 'l,v,c,a,e',
            'organizacion' => 'l,v,c,a,e',
            'pago' => 'l,v,c,a,e',
            'sepomex' => 'l,v,c,a,e',
            'servicio' => 'l,v,c,a,e',
            'servicio-contratado' => 'l,v,c,a,e',
            'subcategoria' => 'l,v,c,a,e',
            'tipo-servicio' => 'l,v,c,a,e',
            'tipo-tratamiento' => 'l,v,c,a,e',
            'tratamiento' => 'l,v,c,a,e',
            'user' => 'l,v,c,a,e',
            'veterinario' => 'l,v,c,a,e'
        ],
        'administrador' => [
            'calificacion' => 'l,v,c,a,e',
            'categoria' => 'l,v,c,a,e',
            'consulta-medica' => 'l,v,c,a,e',
            'corte' => 'l,v,c,a,e',
            'direccion' => 'l,v,c,a,e',
            'especie' => 'l,v,c,a,e',
            'mascota' => 'l,v,c,a,e',
            'mensaje' => 'l,v,c,a,e',
            'modelo-pago' => 'l,v,c,a,e',
            'organizacion' => 'l,v,c,a,e',
            'pago' => 'l,v,c,a,e',
            'sepomex' => 'l,v,c,a,e',
            'servicio' => 'l,v,c,a,e',
            'servicio-contratado' => 'l,v,c,a,e',
            'subcategoria' => 'l,v,c,a,e',
            'tipo-servicio' => 'l,v,c,a,e',
            'tipo-tratamiento' => 'l,v,c,a,e',
            'tratamiento' => 'l,v,c,a,e',
            'veterinario' => 'l,v,c,a,e'
        ],
        'prestador_vet' => [
            'calificacion' => 'v',
            'categoria' => 'l,v',
            'consulta-medica' => 'l,v',
            'corte' => 'v',
            'direccion' => 'l,v',
            'especie' => 'l,v',
            'mascota' => 'l,v',
            'mensaje' => 'l,v,c,e',
            'modelo-pago' => 'v',
            'organizacion' => 'v,c,a',
            'pago' => 'v,c',
            'sepomex' => 'v,c',
            'servicio' => 'l,v,c,a,e',
            'servicio-contratado' => 'l,v,c,a',
            'subcategoria' => 'l,v',
            'tipo-servicio' => 'l,v',
            'tipo-tratamiento' => 'l,v',
            'tratamiento' => 'l,v,c,a,e',
            'user' => 'v',
            'veterinario' => 'v,c,a,e'
        ],
        'solicitante' => [
            'calificacion' => 'v',
            'categoria' => 'l,v',
            'consulta-medica' => 'l,v',
            'corte' => 'v',
            'direccion' => 'l,v',
            'especie' => 'l,v',
            'mascota' => 'l,v',
            'mensaje' => 'l,v,c,e',
            'modelo-pago' => 'v',
            'organizacion' => 'v,c,a',
            'pago' => 'v,c',
            'sepomex' => 'v,c',
            'servicio' => 'l,v,c,a,e',
            'servicio-contratado' => 'l,v,c,a',
            'subcategoria' => 'l,v',
            'tipo-servicio' => 'l,v',
            'tipo-tratamiento' => 'l,v',
            'tratamiento' => 'l,v,c,a,e',
            'user' => 'v',
            'veterinario' => 'v,c,a,e'
        ],
        'inicial' => [
        ]
    ],

    'permissions_map' => [
        'l' => 'listar',
        'v' => 'ver',
        'c' => 'crear',
        'a' => 'actualizar',
        'e' => 'eliminar'
    ]
];
