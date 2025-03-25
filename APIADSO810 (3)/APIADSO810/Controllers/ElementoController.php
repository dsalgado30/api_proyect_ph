<?php
// Se incluyen los archivos necesarios para la configuración de la base de datos y el modelo de Elemento
require_once('Config/database.php'); // Archivo donde se maneja la conexión a la base de datos
require_once('Models/Elemento.php'); // Archivo donde se define la clase Elemento

// Definición del controlador de elemento
class ElementoController
{
    // Propiedades privadas para la conexión a la base de datos y la instancia de Elemento
    private $db;
    private $elemento;

    // Constructor de la clase
    public function __construct()
    {
        // Se crea una instancia de la clase Database para establecer la conexión a la base de datos
        $database = new Database();
        $this->db = $database->getConnection();
        
        // Se crea una instancia de la clase Elemento y se le pasa la conexión establecida
        $this->elemento = new Elemento($this->db);
    }

    // Método para obtener la lista de elementos
    public function getElementos()
    {
        // Llama al método getAll() del modelo Elemento, que devuelve todos los elementos
        $stmt = $this->elemento->getAll();
        $elementos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retorna la respuesta en formato JSON
        echo json_encode([
            'Estatus' => 'Code 200',
            'elementos' => $elementos
        ]);
    }

    // Obtener un elemento por ID
    public function BuscarElemento($id)
    {
        $stmt = $this->elemento->BuscarElemento($id);
        $elemento = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($elemento) {
            echo json_encode(["Estatus" => "Code 200", "elemento" => $elemento]);
        } else {
            echo json_encode(["Estatus" => "Code 404", "message" => "Elemento no encontrado"]);
        }
    }

    // Crear un nuevo elemento
    public function CrearElemento($data)
    {
        $nombre_elemento = $data['nombre_elemento'] ?? null;
        $stock = $data['stock'] ?? null;
        $clasificacion = $data['clasificacion'] ?? null;
        $ficha_tecnica = $data['ficha_tecnica'] ?? null;
        $uso = $data['uso'] ?? null;
        $estado = $data['estado'] ?? null;
        $serial = $data['serial'] ?? null;
        $fk_id_bodega = $data['fk_id_bodega'] ?? null;

        if ($nombre_elemento && $stock !== null && $clasificacion && $ficha_tecnica && $uso && $estado && $serial && $fk_id_bodega) {
            $result = $this->elemento->CrearElemento($nombre_elemento, $stock, $clasificacion, $ficha_tecnica, $uso, $estado, $serial, $fk_id_bodega);
            echo json_encode(["message" => $result ? "Elemento creado" : "Error al crear elemento"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    // Actualizar un elemento
    public function ActualizarElemento($id, $data)
    {
        $nombre_elemento = $data['nombre_elemento'] ?? null;
        $stock = $data['stock'] ?? null;
        $clasificacion = $data['clasificacion'] ?? null;
        $ficha_tecnica = $data['ficha_tecnica'] ?? null;
        $uso = $data['uso'] ?? null;
        $estado = $data['estado'] ?? null;
        $serial = $data['serial'] ?? null;
        $fk_id_bodega = $data['fk_id_bodega'] ?? null;

        if ($nombre_elemento && $stock !== null && $clasificacion && $ficha_tecnica && $uso && $estado && $serial && $fk_id_bodega) {
            $result = $this->elemento->ActualizarElemento($id, $nombre_elemento, $stock, $clasificacion, $ficha_tecnica, $uso, $estado, $serial, $fk_id_bodega);
            echo json_encode(["message" => $result ? "Elemento actualizado" : "Error al actualizar elemento"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    // Eliminar un elemento
    public function EliminarElemento($id)
    {
        $result = $this->elemento->EliminarElemento($id);
        echo json_encode(["message" => $result ? "Elemento eliminado" : "Error al eliminar elemento"]);
    }
}
