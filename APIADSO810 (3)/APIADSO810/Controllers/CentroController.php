<?php
// Se incluyen los archivos necesarios para la configuración de la base de datos y el modelo de centro
require_once('Config/database.php'); // Archivo donde se maneja la conexión a la base de datos
require_once('Models/Centro.php'); // Archivo donde se define la clase Centro

// Definición del controlador de centro
class CentroController
{
    // Propiedades privadas para la conexión a la base de datos y la instancia de Centro
    private $db;
    private $centro;

    // Constructor de la clase
    public function __construct()
    {
        // Se crea una instancia de la clase Database para establecer la conexión a la base de datos
        $database = new Database();
        $this->db = $database->getConnection();
        
        // Se crea una instancia de la clase Centro y se le pasa la conexión establecida
        $this->centro = new Centro($this->db);
    }

    // Método para obtener la lista de centros
    public function getCentros()
    {
        // Llama al método getAll() del modelo Centro, que devuelve todos los centros
        $stmt = $this->centro->getAll();
        $centros = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retorna la respuesta en formato JSON
        echo json_encode([
            'Estatus' => 'Code 200',
            'centros' => $centros
        ]);
    }

    // Obtener un centro por ID
    public function BuscarCentro($id)
    {
        $stmt = $this->centro->BuscarCentro($id);
        $centro = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($centro) {
            echo json_encode(["Estatus" => "Code 200", "centro" => $centro]);
        } else {
            echo json_encode(["Estatus" => "Code 404", "message" => "Centro no encontrado"]);
        }
    }

    // Crear un nuevo centro
    public function CrearCentro($data)
    {
        $nombre_centro = $data['nombre_centro'] ?? null;
        $fk_id_municipio = $data['fk_id_municipio'] ?? null;

        if ($nombre_centro && $fk_id_municipio) {
            $result = $this->centro->CrearCentro($nombre_centro, $fk_id_municipio);
            echo json_encode(["message" => $result ? "Centro creado" : "Error al crear centro"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    // Actualizar un centro
    public function ActualizarCentro($id, $data)
    {
        $nombre_centro = $data['nombre_centro'] ?? null;
        $fk_id_municipio = $data['fk_id_municipio'] ?? null;

        if ($nombre_centro && $fk_id_municipio) {
            $result = $this->centro->ActualizarCentro($id, $nombre_centro, $fk_id_municipio);
            echo json_encode(["message" => $result ? "Centro actualizado" : "Error al actualizar centro"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    // Eliminar un centro
    public function EliminarCentro($id)
    {
        $result = $this->centro->EliminarCentro($id);
        echo json_encode(["message" => $result ? "Centro eliminado" : "Error al eliminar centro"]);
    }
}
