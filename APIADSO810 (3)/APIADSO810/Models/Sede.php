<?php
class Sede
{
    private $connect;
    private $table = 'sede';

    public $id_sedes;
    public $nombre_sede;
    public $fk_id_centro;

    public function __construct($db)
    {
        $this->connect = $db;
    }

    // Obtener todas las sedes
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        return $stmt->execute() ? $stmt : false;
    }

    // Obtener una sede por ID
    public function BuscarSede($id_sedes)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_sedes = :id_sedes";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_sedes', $id_sedes, PDO::PARAM_INT);
        return $stmt->execute() ? $stmt : false;
    }

    // Crear una nueva sede
    public function CrearSede($nombre_sede, $fk_id_centro)
    {
        $query = "INSERT INTO " . $this->table . " (nombre_sede, fk_id_centro) VALUES (:nombre_sede, :fk_id_centro)";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':nombre_sede', $nombre_sede);
        $stmt->bindParam(':fk_id_centro', $fk_id_centro, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Actualizar una sede
    public function ActualizarSede($id_sedes, $nombre_sede, $fk_id_centro)
    {
        $query = "UPDATE " . $this->table . " SET nombre_sede = :nombre_sede, fk_id_centro = :fk_id_centro WHERE id_sedes = :id_sedes";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_sedes', $id_sedes, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_sede', $nombre_sede);
        $stmt->bindParam(':fk_id_centro', $fk_id_centro, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Eliminar una sede
    public function EliminarSede($id_sedes)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id_sedes = :id_sedes";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_sedes', $id_sedes, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
