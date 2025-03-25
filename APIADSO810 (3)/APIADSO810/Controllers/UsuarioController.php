<?php
// Se incluyen los archivos necesarios para la configuración de la base de datos y el modelo de usuario
require_once('Config/database.php'); // Archivo donde se maneja la conexión a la base de datos
require_once('Models/Usuario.php'); // Archivo donde se define la clase User

// Definición del controlador de usuario
class UsuarioController
{
    // Propiedades privadas para la conexión a la base de datos y la instancia de User
    private $db;
    private $user;

    // Constructor de la clase
    public function __construct()
    {
        // Se crea una instancia de la clase Database para establecer la conexión a la base de datos
        $database = new Database();
        $this->db = $database->getConnection();
        
        // Se crea una instancia de la clase User y se le pasa la conexión establecida
        $this->user = new User($this->db);
    }

   // Método para obtener la lista de usuarios
   public function getUsuarios()
   {
       // Llama al método getAll() del modelo User, que devuelve todos los usuarios
       $stmt = $this->user->getAll();

       // Obtiene los resultados en un array asociativo
       $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

       // Retorna la respuesta en formato JSON con código de estado 200 y la lista de usuarios
       echo json_encode([
           'Estatus' => 'Code 200',
           'users' => $users
       ]);
   }

    // Obtener un usuario por ID
    public function BuscarUsuario($id)
    {
        $stmt = $this->user->BuscarUsuario($id);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            echo json_encode(["Estatus" => "Code 200", "users" => $user]);
        } else {
            echo json_encode(["Estatus" => "Code 404", "message" => "Usuario no encontrado"]);
        }
    }

    // Crear un nuevo usuario
    public function CrearUsuario($data)
    {
        $nombres = $data['nombres'] ?? null;
        $identificacion = $data['identificacion'] ?? null;
        $apellidos = $data['apellidos'] ?? null;
        $correo = $data['correo'] ?? null;
        $fk_id_area = $data['fk_id_area'] ?? null;
        $fk_id_rol = $data['fk_id_rol'] ?? null;


        if ($nombres && $identificacion && $apellidos && $correo && $fk_id_area && $fk_id_rol) {
            $result = $this->user->CrearUsuario($nombres, $identificacion,$apellidos,$correo,$fk_id_area,$fk_id_rol);
            echo json_encode(["message" => $result ? "Usuario creado" : "Error al crear usuario"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }


    // Actualizar un usuario
    public function ActualizarUsuario($id, $data)
    {
        $nombres = $data['nombres'] ?? null;
        $identificacion = $data['identificacion'] ?? null;
        $apellidos = $data['apellidos'] ?? null;
        $correo = $data['correo'] ?? null;
        $fk_id_area = $data['fk_id_area'] ?? null;
        $fk_id_rol = $data['fk_id_rol'] ?? null;

        if ($nombres && $identificacion && $apellidos && $correo && $fk_id_area && $fk_id_rol) {
            $result = $this->user->ActualizarUsuario($id, $nombres, $identificacion);
            echo json_encode(["message" => $result ? "Usuario actualizado" : "Error al actualizar usuario"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    
    // Eliminar un usuario
    public function EliminarUsuario($id)
    {
        $result = $this->user->EliminarUsuario($id);
        echo json_encode(["message" => $result ? "Usuario eliminado" : "Error al eliminar usuario"]);
    }
}

//json_encode-Retorna la representación JSON del valor dado