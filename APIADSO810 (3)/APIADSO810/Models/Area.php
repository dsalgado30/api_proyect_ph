<?php
class Area
{
    private $connect;
    private $table = 'area';

    public $id_area;
    public $nombre_area;
    public $fk_id_sedes;

    public function __construct($db)
    {
        $this->connect = $db;
    }

    // Obtener todas las áreas
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        return $stmt->execute() ? $stmt : false;
    }

    // Obtener un área por ID
    public function BuscarArea($id_area)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_area = :id_area";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_area', $id_area, PDO::PARAM_INT);
        return $stmt->execute() ? $stmt : false;
    }

    // Crear una nueva área
    public function CrearArea($nombre_area, $fk_id_sedes)
    {
        $query = "INSERT INTO " . $this->table . " (nombre_area, fk_id_sedes) VALUES (:nombre_area, :fk_id_sedes)";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':nombre_area', $nombre_area);
        $stmt->bindParam(':fk_id_sedes', $fk_id_sedes, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Actualizar un área existente
    public function ActualizarArea($id_area, $nombre_area, $fk_id_sedes)
    {
        $query = "UPDATE " . $this->table . " SET nombre_area = :nombre_area, fk_id_sedes = :fk_id_sedes WHERE id_area = :id_area";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_area', $id_area, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_area', $nombre_area);
        $stmt->bindParam(':fk_id_sedes', $fk_id_sedes, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Eliminar un área
    public function EliminarArea($id_area)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id_area = :id_area";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_area', $id_area, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
