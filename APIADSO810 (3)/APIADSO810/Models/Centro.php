<?php
class Centro
{
    private $connect;
    private $table = 'centro';

    public $id_centro;
    public $nombre_centro;
    public $fk_id_municipio;

    public function __construct($db)
    {
        $this->connect = $db;
    }

    // Obtener todos los centros
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        return $stmt->execute() ? $stmt : false;
    }

    // Obtener un centro por ID
    public function BuscarCentro($id_centro)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_centro = :id_centro";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_centro', $id_centro, PDO::PARAM_INT);
        return $stmt->execute() ? $stmt : false;
    }

    // Crear un nuevo centro
    public function CrearCentro($nombre_centro, $fk_id_municipio)
    {
        $query = "INSERT INTO " . $this->table . " (nombre_centro, fk_id_municipio) VALUES (:nombre_centro, :fk_id_municipio)";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':nombre_centro', $nombre_centro);
        $stmt->bindParam(':fk_id_municipio', $fk_id_municipio, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Actualizar un centro existente
    public function ActualizarCentro($id_centro, $nombre_centro, $fk_id_municipio)
    {
        $query = "UPDATE " . $this->table . " SET nombre_centro = :nombre_centro, fk_id_municipio = :fk_id_municipio WHERE id_centro = :id_centro";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_centro', $id_centro, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_centro', $nombre_centro);
        $stmt->bindParam(':fk_id_municipio', $fk_id_municipio, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Eliminar un centro
    public function EliminarCentro($id_centro)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id_centro = :id_centro";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_centro', $id_centro, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
