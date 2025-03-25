<?php
class Programa
{
    private $connect;
    private $table = 'programa';

    public $id_programa;
    public $nombre_programa;

    public function __construct($db)
    {
        $this->connect = $db;
    }

    // Obtener todos los programas
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        return $stmt->execute() ? $stmt : false;
    }

    // Obtener un programa por ID
    public function BuscarPrograma($id_programa)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_programa = :id_programa";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_programa', $id_programa, PDO::PARAM_INT);
        return $stmt->execute() ? $stmt : false;
    }

    // Crear un nuevo programa
    public function CrearPrograma($nombre_programa)
    {
        $query = "INSERT INTO " . $this->table . " (nombre_programa) VALUES (:nombre_programa)";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':nombre_programa', $nombre_programa);
        return $stmt->execute();
    }

    // Actualizar un programa
    public function ActualizarPrograma($id_programa, $nombre_programa)
    {
        $query = "UPDATE " . $this->table . " SET nombre_programa = :nombre_programa WHERE id_programa = :id_programa";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_programa', $id_programa, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_programa', $nombre_programa);
        return $stmt->execute();
    }

    // Eliminar un programa
    public function EliminarPrograma($id_programa)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id_programa = :id_programa";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_programa', $id_programa, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
