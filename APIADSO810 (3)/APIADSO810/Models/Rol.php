<?php
class Rol
{
    private $connect;
    private $table = 'rol';

    public $id_rol;
    public $nombre_rol;

    public function __construct($db)
    {
        $this->connect = $db;
    }

    // Obtener todos los roles
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        return $stmt->execute() ? $stmt : false;
    }

    // Obtener un rol por ID
    public function BuscarRol($id_rol)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_rol = :id_rol";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
        return $stmt->execute() ? $stmt : false;
    }

    // Crear un nuevo rol
    public function CrearRol($nombre_rol)
    {
        $query = "INSERT INTO " . $this->table . " (nombre_rol) VALUES (:nombre_rol)";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':nombre_rol', $nombre_rol);
        return $stmt->execute();
    }

    // Actualizar un rol
    public function ActualizarRol($id_rol, $nombre_rol)
    {
        $query = "UPDATE " . $this->table . " SET nombre_rol = :nombre_rol WHERE id_rol = :id_rol";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_rol', $nombre_rol);
        return $stmt->execute();
    }

    // Eliminar un rol
    public function EliminarRol($id_rol)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id_rol = :id_rol";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
        return $stmt->execute();
    }
}

