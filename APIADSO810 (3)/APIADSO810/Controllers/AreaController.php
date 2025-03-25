<?php
// Se incluyen los archivos necesarios para la configuración de la base de datos y el modelo de usuario
require_once('Config/database.php');// Archivo donde se maneja la conexión a la base de datos
require_once('Models/Area.php');// Archivo donde se define la clase Area

// Definición del controlador de area
class AreaController {

    // Propiedades privadas para la conexión a la base de datos y la instancia de area
    private $db;
    private $area;

     // Constructor de la clase
    public function __construct() {
        // Se crea una instancia de la clase Database para establecer la conexión a la base de datos
        $database = new Database();
        $this->db = $database->getConnection();

        // Se crea una instancia de la clase area y se le pasa la conexión establecida
        $this->area = new Area($this->db);
    }

    // Obtener todas las áreas
    public function getAreas() {
        $stmt = $this->area->getAll();
        $areas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode(["Estatus" => "Code 200", "areas" => $areas]);
    }

    // Buscar un área por ID
    public function BuscarArea($id) {
        $stmt = $this->area->BuscarArea($id);
        $area = $stmt->fetch(PDO::FETCH_ASSOC);

        echo json_encode($area ? ["Estatus" => "Code 200", "area" => $area] : ["Estatus" => "Code 404", "message" => "Área no encontrada"]);
    }

    // Crear una nueva área
    public function CrearArea($data) {
        $nombre_area = $data['nombre_area'] ?? null;
        $fk_id_sedes = $data['fk_id_sedes'] ?? null;

        if ($nombre_area && $fk_id_sedes) {
            $result = $this->area->CrearArea($nombre_area, $fk_id_sedes);
            echo json_encode(["message" => $result ? "Área creada" : "Error al crear área"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    // Actualizar un área
    public function ActualizarArea($id, $data) {
        $nombre_area = $data['nombre_area'] ?? null;
        $fk_id_sedes = $data['fk_id_sedes'] ?? null;

        if ($nombre_area && $fk_id_sedes) {
            $result = $this->area->ActualizarArea($id, $nombre_area, $fk_id_sedes);
            echo json_encode(["message" => $result ? "Área actualizada" : "Error al actualizar área"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    // Eliminar un área
    public function EliminarArea($id) {
        $result = $this->area->EliminarArea($id);
        echo json_encode(["message" => $result ? "Área eliminada" : "Error al eliminar área"]);
    }
}
