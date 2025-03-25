<?php
class UsuarioBodega
{
    private $connect;
    private $table = 'usuariobodega';

    public $id;
    public $fk_id_usuario;
    public $fk_id_bodega;

    public function __construct($db)
    {
        $this->connect = $db;
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        if ($stmt->execute()) {
            return $stmt;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function BuscarUsuarioBodega($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $stmt;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function CrearUsuarioBodega($fk_id_usuario, $fk_id_bodega)
    {
        $query = "INSERT INTO " . $this->table . " (fk_id_usuario, fk_id_bodega) VALUES (:fk_id_usuario, :fk_id_bodega)";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':fk_id_usuario', $fk_id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':fk_id_bodega', $fk_id_bodega, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function ActualizarUsuarioBodega($id, $fk_id_usuario, $fk_id_bodega)
    {
        $query = "UPDATE " . $this->table . " SET fk_id_usuario = :fk_id_usuario, fk_id_bodega = :fk_id_bodega WHERE id = :id";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':fk_id_usuario', $fk_id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':fk_id_bodega', $fk_id_bodega, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function EliminarUsuarioBodega($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
