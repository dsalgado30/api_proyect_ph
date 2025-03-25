<?php
// Se incluyen los archivos necesarios para la configuración de la base de datos y el modelo de Rol
require_once('Config/database.php'); // Archivo donde se maneja la conexión a la base de datos
require_once('Models/Rol.php'); // Archivo donde se define la clase Rol

// Definición del controlador de rol
class RolController
{
    // Propiedades privadas para la conexión a la base de datos y la instancia de Rol
    private $db;
    private $rol;

    // Constructor de la clase
    public function __construct()
    {
        // Se crea una instancia de la clase Database para establecer la conexión a la base de datos
        $database = new Database();
        $this->db = $database->getConnection();
        
        // Se crea una instancia de la clase Rol y se le pasa la conexión establecida
        $this->rol = new Rol($this->db);
    }

    // Método para obtener la lista de roles
    public function getRoles()
    {
        // Llama al método getAll() del modelo Rol, que devuelve todos los roles
        $stmt = $this->rol->getAll();
        $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retorna la respuesta en formato JSON
        echo json_encode([
            'Estatus' => 'Code 200',
            'roles' => $roles
        ]);
    }

    // Obtener un rol por ID
    public function BuscarRol($id)
    {
        $stmt = $this->rol->BuscarRol($id);
        $rol = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($rol) {
            echo json_encode(["Estatus" => "Code 200", "rol" => $rol]);
        } else {
            echo json_encode(["Estatus" => "Code 404", "message" => "Rol no encontrado"]);
        }
    }

    // Crear un nuevo rol
    public function CrearRol($data)
    {
        $nombre_rol = $data['nombre_rol'] ?? null;

        if ($nombre_rol) {
            $result = $this->rol->CrearRol($nombre_rol);
            echo json_encode(["message" => $result ? "Rol creado" : "Error al crear rol"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    // Actualizar un rol
    public function ActualizarRol($id, $data)
    {
        $nombre_rol = $data['nombre_rol'] ?? null;

        if ($nombre_rol) {
            $result = $this->rol->ActualizarRol($id, $nombre_rol);
            echo json_encode(["message" => $result ? "Rol actualizado" : "Error al actualizar rol"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    // Eliminar un rol
    public function EliminarRol($id)
    {
        $result = $this->rol->EliminarRol($id);
        echo json_encode(["message" => $result ? "Rol eliminado" : "Error al eliminar rol"]);
    }
}
