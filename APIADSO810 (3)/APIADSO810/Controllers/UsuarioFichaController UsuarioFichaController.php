<?php
// Se incluyen los archivos necesarios para la configuración de la base de datos y el modelo de UsuarioFicha
require_once('Config/database.php'); // Archivo donde se maneja la conexión a la base de datos
require_once('Models/UsuarioFicha.php'); // Archivo donde se define la clase UsuarioFicha

// Definición del controlador de UsuarioFicha
class UsuarioFichaController
{
    // Propiedades privadas para la conexión a la base de datos y la instancia de UsuarioFicha
    private $db;
    private $usuarioFicha;

    // Constructor de la clase
    public function __construct()
    {
        // Se crea una instancia de la clase Database para establecer la conexión a la base de datos
        $database = new Database();
        $this->db = $database->getConnection();
        
        // Se crea una instancia de la clase UsuarioFicha y se le pasa la conexión establecida
        $this->usuarioFicha = new UsuarioFicha($this->db);
    }

    // Método para obtener la lista de relaciones usuario-ficha
    public function getUsuarioFicha()
    {
        // Llama al método getAll() del modelo UsuarioFicha, que devuelve todas las relaciones
        $stmt = $this->usuarioFicha->getAll();
        $usuarioFicha = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retorna la respuesta en formato JSON
        echo json_encode([
            'Estatus' => 'Code 200',
            'usuario_ficha' => $usuarioFicha
        ]);
    }

    // Obtener una relación usuario-ficha por ID
    public function BuscarUsuarioFicha($id)
    {
        $stmt = $this->usuarioFicha->BuscarUsuarioFicha($id);
        $usuarioFicha = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuarioFicha) {
            echo json_encode(["Estatus" => "Code 200", "usuario_ficha" => $usuarioFicha]);
        } else {
            echo json_encode(["Estatus" => "Code 404", "message" => "Relación no encontrada"]);
        }
    }

    // Crear una nueva relación usuario-ficha
    public function CrearUsuarioFicha($data)
    {
        $fk_id_usuario = $data['fk_id_usuario'] ?? null;
        $fk_id_ficha = $data['fk_id_ficha'] ?? null;

        if ($fk_id_usuario && $fk_id_ficha) {
            $result = $this->usuarioFicha->CrearUsuarioFicha($fk_id_usuario, $fk_id_ficha);
            echo json_encode(["message" => $result ? "Relación creada" : "Error al crear relación"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    // Actualizar una relación usuario-ficha
    public function ActualizarUsuarioFicha($id, $data)
    {
        $fk_id_usuario = $data['fk_id_usuario'] ?? null;
        $fk_id_ficha = $data['fk_id_ficha'] ?? null;

        if ($fk_id_usuario && $fk_id_ficha) {
            $result = $this->usuarioFicha->ActualizarUsuarioFicha($id, $fk_id_usuario, $fk_id_ficha);
            echo json_encode(["message" => $result ? "Relación actualizada" : "Error al actualizar relación"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    // Eliminar una relación usuario-ficha
    public function EliminarUsuarioFicha($id)
    {
        $result = $this->usuarioFicha->EliminarUsuarioFicha($id);
        echo json_encode(["message" => $result ? "Relación eliminada" : "Error al eliminar relación"]);
    }
}
