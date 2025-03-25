<?php
class Movimiento
{
    private $connect;
    private $table = 'movimiento';

    public $id_movimientos;
    public $fk_id_usuario;
    public $fk_id_elemento;
    public $fecha;
    public $responsable;
    public $pedir;
    public $suministrar;
    public $devolver;

    public function __construct($db)
    {
        $this->connect = $db;
    }

    // Obtener todos los movimientos
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        return $stmt->execute() ? $stmt : false;
    }

    // Obtener un movimiento por ID
    public function BuscarMovimiento($id_movimientos)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_movimientos = :id_movimientos";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_movimientos', $id_movimientos, PDO::PARAM_INT);
        return $stmt->execute() ? $stmt : false;
    }

    // Crear un nuevo movimiento
    public function CrearMovimiento($fk_id_usuario, $fk_id_elemento, $fecha, $responsable, $pedir, $suministrar, $devolver)
    {
        $query = "INSERT INTO " . $this->table . " 
                  (fk_id_usuario, fk_id_elemento, fecha, responsable, pedir, suministrar, devolver) 
                  VALUES (:fk_id_usuario, :fk_id_elemento, :fecha, :responsable, :pedir, :suministrar, :devolver)";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':fk_id_usuario', $fk_id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':fk_id_elemento', $fk_id_elemento, PDO::PARAM_INT);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':responsable', $responsable);
        $stmt->bindParam(':pedir', $pedir);
        $stmt->bindParam(':suministrar', $suministrar);
        $stmt->bindParam(':devolver', $devolver);
        return $stmt->execute();
    }

    // Actualizar un movimiento
    public function ActualizarMovimiento($id_movimientos, $fk_id_usuario, $fk_id_elemento, $fecha, $responsable, $pedir, $suministrar, $devolver)
    {
        $query = "UPDATE " . $this->table . " 
                  SET fk_id_usuario = :fk_id_usuario, fk_id_elemento = :fk_id_elemento, 
                      fecha = :fecha, responsable = :responsable, pedir = :pedir, 
                      suministrar = :suministrar, devolver = :devolver
                  WHERE id_movimientos = :id_movimientos";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_movimientos', $id_movimientos, PDO::PARAM_INT);
        $stmt->bindParam(':fk_id_usuario', $fk_id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':fk_id_elemento', $fk_id_elemento, PDO::PARAM_INT);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':responsable', $responsable);
        $stmt->bindParam(':pedir', $pedir);
        $stmt->bindParam(':suministrar', $suministrar);
        $stmt->bindParam(':devolver', $devolver);
        return $stmt->execute();
    }

    // Eliminar un movimiento
    public function EliminarMovimiento($id_movimientos)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id_movimientos = :id_movimientos";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_movimientos', $id_movimientos, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
