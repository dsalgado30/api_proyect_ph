<?php
// Se incluyen los archivos necesarios para la configuración de la base de datos y el modelo de centro
require_once('Config/database.php');// Archivo donde se maneja la conexión a la base de datos
require_once('Models/Bodega.php'); // Archivo donde se define la clase Bodega

// Definición del controlador de bodega
class BodegaController {

    // Propiedades privadas para la conexión a la base de datos y la instancia de bodega

    private $db;
    private $bodega;


    // Constructor de la clase
    public function __construct() {
        // Se crea una instancia de la clase Database para establecer la conexión a la base de datos
        $database = new Database();
        $this->db = $database->getConnection();

        // Se crea una instancia de la clase User y se le pasa la conexión establecida
        $this->bodega = new Bodega($this->db);
    }

    // Obtener todas las bodegas
    public function getBodegas() {
        $stmt = $this->bodega->getAll();
        $bodegas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(["Estatus" => "Code 200", "bodegas" => $bodegas]);
    }

    // Buscar una bodega por ID
    public function BuscarBodega($id) {
        $stmt = $this->bodega->BuscarBodega($id);
        $bodega = $stmt->fetch(PDO::FETCH_ASSOC);

        echo json_encode($bodega ? ["Estatus" => "Code 200", "bodega" => $bodega] : ["Estatus" => "Code 404", "message" => "Bodega no encontrada"]);
    }

    // Crear una nueva bodega
    public function CrearBodega($data) {
        $nombre_bodega = $data['nombre_bodega'] ?? null;
        $fk_id_sede = $data['fk_id_sede'] ?? null;

        if ($nombre_bodega && $fk_id_sede) {
            $result = $this->bodega->CrearBodega($nombre_bodega, $fk_id_sede);
            echo json_encode(["message" => $result ? "Bodega creada" : "Error al crear bodega"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    // Actualizar una bodega
    public function ActualizarBodega($id, $data) {
        $nombre_bodega = $data['nombre_bodega'] ?? null;
        $fk_id_sede = $data['fk_id_sede'] ?? null;

        if ($nombre_bodega && $fk_id_sede) {
            $result = $this->bodega->ActualizarBodega($id, $nombre_bodega, $fk_id_sede);
            echo json_encode(["message" => $result ? "Bodega actualizada" : "Error al actualizar bodega"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    // Eliminar una bodega
    public function EliminarBodega($id) {
        $result = $this->bodega->EliminarBodega($id);
        echo json_encode(["message" => $result ? "Bodega eliminada" : "Error al eliminar bodega"]);
    }
}
?>
