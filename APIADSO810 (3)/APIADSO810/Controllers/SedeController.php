<?php
// Se incluyen los archivos necesarios para la configuración de la base de datos y el modelo de Sede
require_once('Config/database.php'); // Archivo donde se maneja la conexión a la base de datos
require_once('Models/Sede.php'); // Archivo donde se define la clase Sede

// Definición del controlador de sede
class SedeController
{
    // Propiedades privadas para la conexión a la base de datos y la instancia de Sede
    private $db;
    private $sede;

    // Constructor de la clase
    public function __construct()
    {
        // Se crea una instancia de la clase Database para establecer la conexión a la base de datos
        $database = new Database();
        $this->db = $database->getConnection();
        
        // Se crea una instancia de la clase Sede y se le pasa la conexión establecida
        $this->sede = new Sede($this->db);
    }

    // Método para obtener la lista de sedes
    public function getSedes()
    {
        // Llama al método getAll() del modelo Sede, que devuelve todas las sedes
        $stmt = $this->sede->getAll();
        $sedes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retorna la respuesta en formato JSON
        echo json_encode([
            'Estatus' => 'Code 200',
            'sedes' => $sedes
        ]);
    }

    // Obtener una sede por ID
    public function BuscarSede($id)
    {
        $stmt = $this->sede->BuscarSede($id);
        $sede = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($sede) {
            echo json_encode(["Estatus" => "Code 200", "sede" => $sede]);
        } else {
            echo json_encode(["Estatus" => "Code 404", "message" => "Sede no encontrada"]);
        }
    }

    // Crear una nueva sede
    public function CrearSede($data)
    {
        $nombre_sede = $data['nombre_sede'] ?? null;
        $fk_id_centro = $data['fk_id_centro'] ?? null;

        if ($nombre_sede && $fk_id_centro) {
            $result = $this->sede->CrearSede($nombre_sede, $fk_id_centro);
            echo json_encode(["message" => $result ? "Sede creada" : "Error al crear sede"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    // Actualizar una sede
    public function ActualizarSede($id, $data)
    {
        $nombre_sede = $data['nombre_sede'] ?? null;
        $fk_id_centro = $data['fk_id_centro'] ?? null;

        if ($nombre_sede && $fk_id_centro) {
            $result = $this->sede->ActualizarSede($id, $nombre_sede, $fk_id_centro);
            echo json_encode(["message" => $result ? "Sede actualizada" : "Error al actualizar sede"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    // Eliminar una sede
    public function EliminarSede($id)
    {
        $result = $this->sede->EliminarSede($id);
        echo json_encode(["message" => $result ? "Sede eliminada" : "Error al eliminar sede"]);
    }
}
