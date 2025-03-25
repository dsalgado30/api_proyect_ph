<?php
// Se incluyen los archivos necesarios para la configuración de la base de datos y el modelo de Movimiento
require_once('Config/database.php'); // Archivo donde se maneja la conexión a la base de datos
require_once('Models/Movimiento.php'); // Archivo donde se define la clase Movimiento

// Definición del controlador de movimiento
class MovimientoController
{
    // Propiedades privadas para la conexión a la base de datos y la instancia de Movimiento
    private $db;
    private $movimiento;

    // Constructor de la clase
    public function __construct()
    {
        // Se crea una instancia de la clase Database para establecer la conexión a la base de datos
        $database = new Database();
        $this->db = $database->getConnection();
        
        // Se crea una instancia de la clase Movimiento y se le pasa la conexión establecida
        $this->movimiento = new Movimiento($this->db);
    }

    // Método para obtener la lista de movimientos
    public function getMovimientos()
    {
        // Llama al método getAll() del modelo Movimiento, que devuelve todos los movimientos
        $stmt = $this->movimiento->getAll();
        $movimientos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retorna la respuesta en formato JSON
        echo json_encode([
            'Estatus' => 'Code 200',
            'movimientos' => $movimientos
        ]);
    }

    // Obtener un movimiento por ID
    public function BuscarMovimiento($id)
    {
        $stmt = $this->movimiento->BuscarMovimiento($id);
        $movimiento = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($movimiento) {
            echo json_encode(["Estatus" => "Code 200", "movimiento" => $movimiento]);
        } else {
            echo json_encode(["Estatus" => "Code 404", "message" => "Movimiento no encontrado"]);
        }
    }

    // Crear un nuevo movimiento
    public function CrearMovimiento($data)
    {
        $fk_id_usuario = $data['fk_id_usuario'] ?? null;
        $fk_id_elemento = $data['fk_id_elemento'] ?? null;
        $fecha = $data['fecha'] ?? null;
        $responsable = $data['responsable'] ?? null;
        $pedir = $data['pedir'] ?? null;
        $suministrar = $data['suministrar'] ?? null;
        $devolver = $data['devolver'] ?? null;

        if ($fk_id_usuario && $fk_id_elemento && $fecha && $responsable && $pedir && $suministrar && $devolver) {
            $result = $this->movimiento->CrearMovimiento($fk_id_usuario, $fk_id_elemento, $fecha, $responsable, $pedir, $suministrar, $devolver);
            echo json_encode(["message" => $result ? "Movimiento creado" : "Error al crear movimiento"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    // Actualizar un movimiento
    public function ActualizarMovimiento($id, $data)
    {
        $fk_id_usuario = $data['fk_id_usuario'] ?? null;
        $fk_id_elemento = $data['fk_id_elemento'] ?? null;
        $fecha = $data['fecha'] ?? null;
        $responsable = $data['responsable'] ?? null;
        $pedir = $data['pedir'] ?? null;
        $suministrar = $data['suministrar'] ?? null;
        $devolver = $data['devolver'] ?? null;

        if ($fk_id_usuario && $fk_id_elemento && $fecha && $responsable && $pedir && $suministrar && $devolver) {
            $result = $this->movimiento->ActualizarMovimiento($id, $fk_id_usuario, $fk_id_elemento, $fecha, $responsable, $pedir, $suministrar, $devolver);
            echo json_encode(["message" => $result ? "Movimiento actualizado" : "Error al actualizar movimiento"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    // Eliminar un movimiento
    public function EliminarMovimiento($id)
    {
        $result = $this->movimiento->EliminarMovimiento($id);
        echo json_encode(["message" => $result ? "Movimiento eliminado" : "Error al eliminar movimiento"]);
    }
}
