<?php
// Se incluyen los archivos necesarios para la configuración de la base de datos y el modelo de Ficha
require_once('Config/database.php'); // Archivo donde se maneja la conexión a la base de datos
require_once('Models/Ficha.php'); // Archivo donde se define la clase Ficha

// Definición del controlador de ficha
class FichaController
{
    // Propiedades privadas para la conexión a la base de datos y la instancia de Ficha
    private $db;
    private $ficha;

    // Constructor de la clase
    public function __construct()
    {
        // Se crea una instancia de la clase Database para establecer la conexión a la base de datos
        $database = new Database();
        $this->db = $database->getConnection();
        
        // Se crea una instancia de la clase Ficha y se le pasa la conexión establecida
        $this->ficha = new Ficha($this->db);
    }

    // Método para obtener la lista de fichas
    public function getFichas()
    {
        // Llama al método getAll() del modelo Ficha, que devuelve todas las fichas
        $stmt = $this->ficha->getAll();
        $fichas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retorna la respuesta en formato JSON
        echo json_encode([
            'Estatus' => 'Code 200',
            'fichas' => $fichas
        ]);
    }

    // Obtener una ficha por ID
    public function BuscarFicha($id)
    {
        $stmt = $this->ficha->BuscarFicha($id);
        $ficha = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($ficha) {
            echo json_encode(["Estatus" => "Code 200", "ficha" => $ficha]);
        } else {
            echo json_encode(["Estatus" => "Code 404", "message" => "Ficha no encontrada"]);
        }
    }

    // Crear una nueva ficha
    public function CrearFicha($data)
    {
        $numero_ficha = $data['numero_ficha'] ?? null;
        $fk_id_programa = $data['fk_id_programa'] ?? null;
        $fk_id_municipio = $data['fk_id_municipio'] ?? null;
        $fk_id_sede = $data['fk_id_sede'] ?? null;

        if ($numero_ficha && $fk_id_programa && $fk_id_municipio && $fk_id_sede) {
            $result = $this->ficha->CrearFicha($numero_ficha, $fk_id_programa, $fk_id_municipio, $fk_id_sede);
            echo json_encode(["message" => $result ? "Ficha creada" : "Error al crear ficha"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    // Actualizar una ficha
    public function ActualizarFicha($id, $data)
    {
        $numero_ficha = $data['numero_ficha'] ?? null;
        $fk_id_programa = $data['fk_id_programa'] ?? null;
        $fk_id_municipio = $data['fk_id_municipio'] ?? null;
        $fk_id_sede = $data['fk_id_sede'] ?? null;

        if ($numero_ficha && $fk_id_programa && $fk_id_municipio && $fk_id_sede) {
            $result = $this->ficha->ActualizarFicha($id, $numero_ficha, $fk_id_programa, $fk_id_municipio, $fk_id_sede);
            echo json_encode(["message" => $result ? "Ficha actualizada" : "Error al actualizar ficha"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    // Eliminar una ficha
    public function EliminarFicha($id)
    {
        $result = $this->ficha->EliminarFicha($id);
        echo json_encode(["message" => $result ? "Ficha eliminada" : "Error al eliminar ficha"]);
    }
}
