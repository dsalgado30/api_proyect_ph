<?php
class Detalle
{
    private $connect;
    private $table = 'detalle';

    public $id;
    public $movimiento;
    public $fk_id_elemento;
    public $asignado;
    public $estado;
    public $retorno;
    public $fecha;
    public $fk_id_ficha;

    public function __construct($db)
    {
        $this->connect = $db;
    }

    // Obtener todos los detalles
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        return $stmt->execute() ? $stmt : false;
    }

    // Obtener un detalle por ID
    public function BuscarDetalle($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute() ? $stmt : false;
    }

    // Crear un nuevo detalle
    public function CrearDetalle($movimiento, $fk_id_elemento, $asignado, $estado, $retorno, $fecha, $fk_id_ficha)
    {
        $query = "INSERT INTO " . $this->table . " (movimiento, fk_id_elemento, asignado, estado, retorno, fecha, fk_id_ficha) 
                  VALUES (:movimiento, :fk_id_elemento, :asignado, :estado, :retorno, :fecha, :fk_id_ficha)";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':movimiento', $movimiento);
        $stmt->bindParam(':fk_id_elemento', $fk_id_elemento, PDO::PARAM_INT);
        $stmt->bindParam(':asignado', $asignado);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':retorno', $retorno);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':fk_id_ficha', $fk_id_ficha, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Actualizar un detalle existente
    public function ActualizarDetalle($id, $movimiento, $fk_id_elemento, $asignado, $estado, $retorno, $fecha, $fk_id_ficha)
    {
        $query = "UPDATE " . $this->table . " 
                  SET movimiento = :movimiento, fk_id_elemento = :fk_id_elemento, asignado = :asignado, estado = :estado, 
                      retorno = :retorno, fecha = :fecha, fk_id_ficha = :fk_id_ficha 
                  WHERE id = :id";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':movimiento', $movimiento);
        $stmt->bindParam(':fk_id_elemento', $fk_id_elemento, PDO::PARAM_INT);
        $stmt->bindParam(':asignado', $asignado);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':retorno', $retorno);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':fk_id_ficha', $fk_id_ficha, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Eliminar un detalle
    public function EliminarDetalle($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
