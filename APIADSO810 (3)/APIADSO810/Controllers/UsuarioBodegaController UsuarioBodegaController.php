<?php
// Se incluyen los archivos necesarios para la configuración de la base de datos y el modelo de UsuarioBodega
require_once('Config/database.php'); // Archivo donde se maneja la conexión a la base de datos
require_once('Models/UsuarioBodega.php'); // Archivo donde se define la clase UsuarioBodega

// Definición del controlador de UsuarioBodega
class UsuarioBodegaController
{
    // Propiedades privadas para la conexión a la base de datos y la instancia de UsuarioBodega
    private $db;
    private $usuarioBodega;

    // Constructor de la clase
    public function __construct()
    {
        // Se crea una instancia de la clase Database para establecer la conexión a la base de datos
        $database = new Database();
        $this->db = $database->getConnection();
        
        // Se crea una instancia de la clase UsuarioBodega y se le pasa la conexión establecida
        $this->usuarioBodega = new UsuarioBodega($this->db);
    }

    // Método para obtener la lista de relaciones usuario-bodega
    public function getUsuarioBodega()
    {
        // Llama al método getAll() del modelo UsuarioBodega, que devuelve todas las relaciones
        $stmt = $this->usuarioBodega->getAll();
        $usuarioBodega = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retorna la respuesta en formato JSON
        echo json_encode([
            'Estatus' => 'Code 200',
            'usuario_bodega' => $usuarioBodega
        ]);
    }

    // Obtener una relación usuario-bodega por ID
    public function BuscarUsuarioBodega($id)
    {
        $stmt = $this->usuarioBodega->BuscarUsuarioBodega($id);
        $usuarioBodega = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuarioBodega) {
            echo json_encode(["Estatus" => "Code 200", "usuario_bodega" => $usuarioBodega]);
        } else {
            echo json_encode(["Estatus" => "Code 404", "message" => "Relación no encontrada"]);
        }
    }

    // Crear una nueva relación usuario-bodega
    public function CrearUsuarioBodega($data)
    {
        $fk_id_usuario = $data['fk_id_usuario'] ?? null;
        $fk_id_bodega = $data['fk_id_bodega'] ?? null;

        if ($fk_id_usuario && $fk_id_bodega) {
            $result = $this->usuarioBodega->CrearUsuarioBodega($fk_id_usuario, $fk_id_bodega);
            echo json_encode(["message" => $result ? "Relación creada" : "Error al crear relación"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    // Actualizar una relación usuario-bodega
    public function ActualizarUsuarioBodega($id, $data)
    {
        $fk_id_usuario = $data['fk_id_usuario'] ?? null;
        $fk_id_bodega = $data['fk_id_bodega'] ?? null;

        if ($fk_id_usuario && $fk_id_bodega) {
            $result = $this->usuarioBodega->ActualizarUsuarioBodega($id, $fk_id_usuario, $fk_id_bodega);
            echo json_encode(["message" => $result ? "Relación actualizada" : "Error al actualizar relación"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    // Eliminar una relación usuario-bodega
    public function EliminarUsuarioBodega($id)
    {
        $result = $this->usuarioBodega->EliminarUsuarioBodega($id);
        echo json_encode(["message" => $result ? "Relación eliminada" : "Error al eliminar relación"]);
    }
}
