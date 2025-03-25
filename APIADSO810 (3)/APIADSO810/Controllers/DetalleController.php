<?php
// Se incluyen los archivos necesarios para la configuración de la base de datos y el modelo de Detalle
require_once('Config/database.php'); // Archivo donde se maneja la conexión a la base de datos
require_once('Models/Detalle.php'); // Archivo donde se define la clase Detalle

// Definición del controlador de detalle
class DetalleController
{
    // Propiedades privadas para la conexión a la base de datos y la instancia de Detalle
    private $db;
    private $detalle;

    // Constructor de la clase
    public function __construct()
    {
        // Se crea una instancia de la clase Database para establecer la conexión a la base de datos
        $database = new Database();
        $this->db = $database->getConnection();
        
        // Se crea una instancia de la clase Detalle y se le pasa la conexión establecida
        $this->detalle = new Detalle($this->db);
    }

    // Método para obtener la lista de detalles
    public function getDetalles()
    {
        // Llama al método getAll() del modelo Detalle, que devuelve todos los detalles
        $stmt = $this->detalle->getAll();
        $detalles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retorna la respuesta en formato JSON
        echo json_encode([
            'Estatus' => 'Code 200',
            'detalles' => $detalles
        ]);
    }

    // Obtener un detalle por ID
    public function BuscarDetalle($id)
    {
        $stmt = $this->detalle->BuscarDetalle($id);
        $detalle = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($detalle) {
            echo json_encode(["Estatus" => "Code 200", "detalle" => $detalle]);
        } else {
            echo json_encode(["Estatus" => "Code 404", "message" => "Detalle no encontrado"]);
        }
    }

    // Crear un nuevo detalle
    public function CrearDetalle($data)
    {
        $movimiento = $data['movimiento'] ?? null;
        $fk_id_elemento = $data['fk_id_elemento'] ?? null;
        $asignado = $data['asignado'] ?? null;
        $estado = $data['estado'] ?? null;
        $retorno = $data['retorno'] ?? null;
        $fecha = $data['fecha'] ?? null;
        $fk_id_ficha = $data['fk_id_ficha'] ?? null;

        if ($movimiento && $fk_id_elemento && $asignado && $estado && $retorno && $fecha && $fk_id_ficha) {
            $result = $this->detalle->CrearDetalle($movimiento, $fk_id_elemento, $asignado, $estado, $retorno, $fecha, $fk_id_ficha);
            echo json_encode(["message" => $result ? "Detalle creado" : "Error al crear detalle"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    // Actualizar un detalle
    public function ActualizarDetalle($id, $data)
    {
        $movimiento = $data['movimiento'] ?? null;
        $fk_id_elemento = $data['fk_id_elemento'] ?? null;
        $asignado = $data['asignado'] ?? null;
        $estado = $data['estado'] ?? null;
        $retorno = $data['retorno'] ?? null;
        $fecha = $data['fecha'] ?? null;
        $fk_id_ficha = $data['fk_id_ficha'] ?? null;

        if ($movimiento && $fk_id_elemento && $asignado && $estado && $retorno && $fecha && $fk_id_ficha) {
            $result = $this->detalle->ActualizarDetalle($id, $movimiento, $fk_id_elemento, $asignado, $estado, $retorno, $fecha, $fk_id_ficha);
            echo json_encode(["message" => $result ? "Detalle actualizado" : "Error al actualizar detalle"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    // Eliminar un detalle
    public function EliminarDetalle($id)
    {
        $result = $this->detalle->EliminarDetalle($id);
        echo json_encode(["message" => $result ? "Detalle eliminado" : "Error al eliminar detalle"]);
    }
}
