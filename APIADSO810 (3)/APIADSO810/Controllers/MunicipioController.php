<?php
// Se incluyen los archivos necesarios para la configuración de la base de datos y el modelo de Municipio
require_once('Config/database.php'); // Archivo donde se maneja la conexión a la base de datos
require_once('Models/Municipio.php'); // Archivo donde se define la clase Municipio

// Definición del controlador de municipio
class MunicipioController
{
    // Propiedades privadas para la conexión a la base de datos y la instancia de Municipio
    private $db;
    private $municipio;

    // Constructor de la clase
    public function __construct()
    {
        // Se crea una instancia de la clase Database para establecer la conexión a la base de datos
        $database = new Database();
        $this->db = $database->getConnection();
        
        // Se crea una instancia de la clase Municipio y se le pasa la conexión establecida
        $this->municipio = new Municipio($this->db);
    }

    // Método para obtener la lista de municipios
    public function getMunicipios()
    {
        // Llama al método getAll() del modelo Municipio, que devuelve todos los municipios
        $stmt = $this->municipio->getAll();
        $municipios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retorna la respuesta en formato JSON
        echo json_encode([
            'Estatus' => 'Code 200',
            'municipios' => $municipios
        ]);
    }

    // Obtener un municipio por ID
    public function BuscarMunicipio($id)
    {
        $stmt = $this->municipio->BuscarMunicipio($id);
        $municipio = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($municipio) {
            echo json_encode(["Estatus" => "Code 200", "municipio" => $municipio]);
        } else {
            echo json_encode(["Estatus" => "Code 404", "message" => "Municipio no encontrado"]);
        }
    }

    // Crear un nuevo municipio
    public function CrearMunicipio($data)
    {
        $nombre_municipio = $data['nombre_municipio'] ?? null;

        if ($nombre_municipio) {
            $result = $this->municipio->CrearMunicipio($nombre_municipio);
            echo json_encode(["message" => $result ? "Municipio creado" : "Error al crear municipio"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    // Actualizar un municipio
    public function ActualizarMunicipio($id, $data)
    {
        $nombre_municipio = $data['nombre_municipio'] ?? null;

        if ($nombre_municipio) {
            $result = $this->municipio->ActualizarMunicipio($id, $nombre_municipio);
            echo json_encode(["message" => $result ? "Municipio actualizado" : "Error al actualizar municipio"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    // Eliminar un municipio
    public function EliminarMunicipio($id)
    {
        $result = $this->municipio->EliminarMunicipio($id);
        echo json_encode(["message" => $result ? "Municipio eliminado" : "Error al eliminar municipio"]);
    }
}
