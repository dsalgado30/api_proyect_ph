<?php
class Elemento
{
    private $connect;
    private $table = 'elemento';

    public $id_elemento;
    public $nombre_elemento;
    public $stock;
    public $clasificacion;
    public $ficha_tecnica;
    public $uso;
    public $estado;
    public $serial;
    public $fk_id_bodega;

    public function __construct($db)
    {
        $this->connect = $db;
    }

    // Obtener todos los elementos
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        return $stmt->execute() ? $stmt : false;
    }

    // Obtener un elemento por ID
    public function BuscarElemento($id_elemento)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_elemento = :id_elemento";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_elemento', $id_elemento, PDO::PARAM_INT);
        return $stmt->execute() ? $stmt : false;
    }

    // Crear un nuevo elemento
    public function CrearElemento($nombre_elemento, $stock, $clasificacion, $ficha_tecnica, $uso, $estado, $serial, $fk_id_bodega)
    {
        $query = "INSERT INTO " . $this->table . " 
        (nombre_elemento, stock, clasificacion, ficha_tecnica, uso, estado, serial, fk_id_bodega) 
        VALUES (:nombre_elemento, :stock, :clasificacion, :ficha_tecnica, :uso, :estado, :serial, :fk_id_bodega)";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':nombre_elemento', $nombre_elemento);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':clasificacion', $clasificacion);
        $stmt->bindParam(':ficha_tecnica', $ficha_tecnica);
        $stmt->bindParam(':uso', $uso);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':serial', $serial);
        $stmt->bindParam(':fk_id_bodega', $fk_id_bodega, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Actualizar un elemento existente
    public function ActualizarElemento($id_elemento, $nombre_elemento, $stock, $clasificacion, $ficha_tecnica, $uso, $estado, $serial, $fk_id_bodega)
    {
        $query = "UPDATE " . $this->table . " 
                  SET nombre_elemento = :nombre_elemento, stock = :stock, clasificacion = :clasificacion, 
                      ficha_tecnica = :ficha_tecnica, uso = :uso, estado = :estado, serial = :serial, 
                      fk_id_bodega = :fk_id_bodega 
                  WHERE id_elemento = :id_elemento";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_elemento', $id_elemento, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_elemento', $nombre_elemento);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':clasificacion', $clasificacion);
        $stmt->bindParam(':ficha_tecnica', $ficha_tecnica);
        $stmt->bindParam(':uso', $uso);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':serial', $serial);
        $stmt->bindParam(':fk_id_bodega', $fk_id_bodega, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Eliminar un elemento
    public function EliminarElemento($id_elemento)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id_elemento = :id_elemento";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_elemento', $id_elemento, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
