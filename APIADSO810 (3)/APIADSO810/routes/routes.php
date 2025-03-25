<?php
//El archivo routes.ph devuelve un array asociativo.
return [
    // "areas" es la calve del recurso
    "areas" => [
        //El valor es otro array que asocia cada método HTTP (GET, POST, PUT, DELETE) con una acción en un controlador.
        "GET"    => "AreaController@getAreas", 
        "POST"   => "AreaController@CrearArea",
        // El @ separa el nombre del controlador y el método que se debe ejecutar.
        
        //AreaController es la clase que maneja las areas y ActualizarArea es el es el método dentro de AreaController que se ejecuta cuando alguien hace la peticion.
        "PUT"    => "AreaController@ActualizarArea",
        "DELETE" => "AreaController@EliminarArea"
        //se utiliza El formato "Controlador@Método; se usa para indicar qué clase (controlador) y qué método se debe ejecutar cuando se llame a esa ruta." 
    ],
    "bodegas" => [
        "GET"    => "BodegaController@getBodegas",
        "POST"   => "BodegaController@CrearBodega",
        "PUT"    => "BodegaController@ActualizarBodega",
        "DELETE" => "BodegaController@EliminarBodega"
    ],
    "centros" => [
        "GET"    => "CentroController@getCentros",
        "POST"   => "CentroController@CrearCentro",
        "PUT"    => "CentroController@ActualizarCentro",
        "DELETE" => "CentroController@EliminarCentro"
    ],
    "detalles" => [
        "GET"    => "DetalleController@getDetalles",
        "POST"   => "DetalleController@CrearDetalle",
        "PUT"    => "DetalleController@ActualizarDetalle",
        "DELETE" => "DetalleController@EliminarDetalle"
    ],
    "elementos" => [
        "GET"    => "ElementoController@getElementos",
        "POST"   => "ElementoController@CrearElemento",
        "PUT"    => "ElementoController@ActualizarElemento",
        "DELETE" => "ElementoController@EliminarElemento"
    ],
    "fichas" => [
        "GET"    => "FichaController@getFichas",
        "POST"   => "FichaController@CrearFicha",
        "PUT"    => "FichaController@ActualizarFicha",
        "DELETE" => "FichaController@EliminarFicha"
    ],
    "movimientos" => [
        "GET"    => "MovimientoController@getMovimientos",
        "POST"   => "MovimientoController@CrearMovimiento",
        "PUT"    => "MovimientoController@ActualizarMovimiento",
        "DELETE" => "MovimientoController@EliminarMovimiento"
    ],
    "municipios" => [
        "GET"    => "MunicipioController@getMunicipios",
        "POST"   => "MunicipioController@CrearMunicipio",
        "PUT"    => "MunicipioController@ActualizarMunicipio",
        "DELETE" => "MunicipioController@EliminarMunicipio"
    ],
    "programas" => [
        "GET"    => "ProgramaController@getProgramas",
        "POST"   => "ProgramaController@CrearPrograma",
        "PUT"    => "ProgramaController@ActualizarPrograma",
        "DELETE" => "ProgramaController@EliminarPrograma"
    ],
    "roles" => [
        "GET"    => "RolController@getRoles",
        "POST"   => "RolController@CrearRol",
        "PUT"    => "RolController@ActualizarRol",
        "DELETE" => "RolController@EliminarRol"
    ],
    "sedes" => [
        "GET"    => "SedeController@getSedes",
        "POST"   => "SedeController@CrearSede",
        "PUT"    => "SedeController@ActualizarSede",
        "DELETE" => "SedeController@EliminarSede"
    ],
    "usuarios" => [
        "GET"    => "UsuarioController@getUsuarios",
        "POST"   => "UsuarioController@CrearUsuario",
        "PUT"    => "UsuarioController@ActualizarUsuario",
        "DELETE" => "UsuarioController@EliminarUsuario"
    ],
    "usuariob" => [
        "GET"    => "UsuarioBodegaController@getUsuarioBodegas",
        "POST"   => "UsuarioBodegaController@CrearUsuarioBodega",
        "PUT"    => "UsuarioBodegaController@ActualizarUsuarioBodega",
        "DELETE" => "UsuarioBodegaController@EliminarUsuarioBodega"
    ],
    "usuariof" => [
        "GET"    => "UsuarioFichaController@getUsuarioFicha",
        "POST"   => "UsuarioFichaController@CrearUsuarioFicha",
        "PUT"    => "UsuarioFichaController@ActualizarUsuarioFicha",
        "DELETE" => "UsuarioFichaController@EliminarUsuarioFicha"
    ]
];
