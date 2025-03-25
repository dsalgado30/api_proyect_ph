<?php
class UsuarioFicha
{
    private $connect;
    private $table = 'usuarioficha';

    public $id;
    public $fk_id_usuario;
    public $fk_id_ficha;

    public function __construct($db)
    {
        $this->connect = $db;
    }

    public function getUsuarioFicha()
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

    public function BuscarUsuarioFicha($id)
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

    public function CrearUsuarioFicha($fk_id_usuario, $fk_id_ficha)
    {
        $query = "INSERT INTO " . $this->table . " (fk_id_usuario, fk_id_ficha) VALUES (:fk_id_usuario, :fk_id_ficha)";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':fk_id_usuario', $fk_id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':fk_id_ficha', $fk_id_ficha, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function ActualizarUsuarioFicha($id, $fk_id_usuario, $fk_id_ficha)
    {
        $query = "UPDATE " . $this->table . " SET fk_id_usuario = :fk_id_usuario, fk_id_ficha = :fk_id_ficha WHERE id = :id";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':fk_id_usuario', $fk_id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':fk_id_ficha', $fk_id_ficha, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function EliminarUsuarioFicha($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
