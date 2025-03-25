<?php
// Se incluyen los archivos necesarios para la configuración de la base de datos y el modelo de Programa
require_once('Config/database.php'); // Archivo donde se maneja la conexión a la base de datos
require_once('Models/Programa.php'); // Archivo donde se define la clase Programa

// Definición del controlador de programa
class ProgramaController
{
    // Propiedades privadas para la conexión a la base de datos y la instancia de Programa
    private $db;
    private $programa;

    // Constructor de la clase
    public function __construct()
    {
        // Se crea una instancia de la clase Database para establecer la conexión a la base de datos
        $database = new Database();
        $this->db = $database->getConnection();
        
        // Se crea una instancia de la clase Programa y se le pasa la conexión establecida
        $this->programa = new Programa($this->db);
    }

    // Método para obtener la lista de programas
    public function getProgramas()
    {
        // Llama al método getAll() del modelo Programa, que devuelve todos los programas
        $stmt = $this->programa->getAll();
        $programas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retorna la respuesta en formato JSON
        echo json_encode([
            'Estatus' => 'Code 200',
            'programas' => $programas
        ]);
    }

    // Obtener un programa por ID
    public function BuscarPrograma($id)
    {
        $stmt = $this->programa->BuscarPrograma($id);
        $programa = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($programa) {
            echo json_encode(["Estatus" => "Code 200", "programa" => $programa]);
        } else {
            echo json_encode(["Estatus" => "Code 404", "message" => "Programa no encontrado"]);
        }
    }

    // Crear un nuevo programa
    public function CrearPrograma($data)
    {
        $nombre_programa = $data['nombre_programa'] ?? null;

        if ($nombre_programa) {
            $result = $this->programa->CrearPrograma($nombre_programa);
            echo json_encode(["message" => $result ? "Programa creado" : "Error al crear programa"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    // Actualizar un programa
    public function ActualizarPrograma($id, $data)
    {
        $nombre_programa = $data['nombre_programa'] ?? null;

        if ($nombre_programa) {
            $result = $this->programa->ActualizarPrograma($id, $nombre_programa);
            echo json_encode(["message" => $result ? "Programa actualizado" : "Error al actualizar programa"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    // Eliminar un programa
    public function EliminarPrograma($id)
    {
        $result = $this->programa->EliminarPrograma($id);
        echo json_encode(["message" => $result ? "Programa eliminado" : "Error al eliminar programa"]);
    }
}
