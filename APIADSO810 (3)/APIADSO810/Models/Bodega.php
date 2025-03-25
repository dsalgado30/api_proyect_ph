<?php
class Bodega
{
    private $connect;
    private $table = 'bodega';

    public $id_bodega;
    public $nombre_bodega;
    public $fk_id_sede;

    public function __construct($db)
    {
        $this->connect = $db;
    }

    // Obtener todas las bodegas
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        return $stmt->execute() ? $stmt : false;
    }

    // Obtener una bodega por ID
    public function BuscarBodega($id_bodega)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_bodega = :id_bodega";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_bodega', $id_bodega, PDO::PARAM_INT);
        return $stmt->execute() ? $stmt : false;
    }

    // Crear una nueva bodega
    public function CrearBodega($nombre_bodega, $fk_id_sede)
    {
        $query = "INSERT INTO " . $this->table . " (nombre_bodega, fk_id_sede) VALUES (:nombre_bodega, :fk_id_sede)";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':nombre_bodega', $nombre_bodega);
        $stmt->bindParam(':fk_id_sede', $fk_id_sede, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Actualizar una bodega existente
    public function ActualizarBodega($id_bodega, $nombre_bodega, $fk_id_sede)
    {
        $query = "UPDATE " . $this->table . " SET nombre_bodega = :nombre_bodega, fk_id_sede = :fk_id_sede WHERE id_bodega = :id_bodega";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_bodega', $id_bodega, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_bodega', $nombre_bodega);
        $stmt->bindParam(':fk_id_sede', $fk_id_sede, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Eliminar una bodega
    public function EliminarBodega($id_bodega)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id_bodega = :id_bodega";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_bodega', $id_bodega, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
