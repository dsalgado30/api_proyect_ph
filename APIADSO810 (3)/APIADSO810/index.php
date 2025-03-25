<?php
// Permitir solicitudes desde cualquier origen para evitar restricciones de CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE");
header("Content-Type: application/json; charset=UTF-8");

// Función de autoload para cargar automáticamente controladores y modelos
spl_autoload_register(function ($className) {
    $directories = ['controllers/', 'models/', 'core/'];
    foreach ($directories as $directory) {
        $file = __DIR__ . "/$directory$className.php";
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
    throw new Exception("Clase '$className' no encontrada.");
});


// Obtiene la URI de la solicitud y la divide en segmentos utilizando "/"
$request = explode("/", trim($_SERVER['REQUEST_URI'], "/"));

// Extrae el recurso solicitado y el ID si está presente
$resource = $request[1] ?? null;
$id = $request[2] ?? null;

// Obtiene el método HTTP de la solicitud
$method = $_SERVER["REQUEST_METHOD"];

// Cargar las rutas desde el archivo `routes.php`
$routes = include("routes/routes.php");



// Verificar si el recurso y el método existen en las rutas
if (isset($routes[$resource][$method])) {
    // Extraer el nombre del controlador y el método de la ruta
    list($controllerName, $methodName) = explode("@", $routes[$resource][$method]);


    
    // Ruta del archivo del controlador
    $controllerPath = "controllers/$controllerName.php";

    // Verificar si el archivo del controlador existe
    if (!file_exists($controllerPath)) {
        echo json_encode(["error" => "Controlador '$controllerName' no encontrado"]);
        exit;
    }

    // Incluir el archivo del controlador
    require_once $controllerPath;

    // Crear instancia del controlador
    $controller = new $controllerName();

    // Obtener datos de la solicitud si es necesario
    $data = json_decode(file_get_contents("php://input"), true);

    // Ejecutar el método del controlador con los parámetros adecuados
    $response = null;
    if ($id) {
        $response = $controller->$methodName($id, $data);
    } else {
        $response = ($method === "GET") ? $controller->$methodName() : $controller->$methodName($data);
    }

    // Responder en formato JSON
    echo json_encode($response);
} else {
    // Si la ruta no está definida, devolver un mensaje de error
    echo json_encode(["error" => "Recurso '$resource' no encontrado o método '$method' no permitido"]);
}
