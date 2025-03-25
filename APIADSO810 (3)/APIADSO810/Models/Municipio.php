<?php
class Municipio
{
    private $connect;
    private $table = 'municipio';

    public $id_municipio;
    public $nombre_municipio;

    public function __construct($db)
    {
        $this->connect = $db;
    }

    // Obtener todos los municipios
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        return $stmt->execute() ? $stmt : false;
    }

    // Obtener un municipio por ID
    public function BuscarMunicipio($id_municipio)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_municipio = :id_municipio";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_municipio', $id_municipio, PDO::PARAM_INT);
        return $stmt->execute() ? $stmt : false;
    }

    // Crear un nuevo municipio
    public function CrearMunicipio($nombre_municipio)
    {
        $query = "INSERT INTO " . $this->table . " (nombre_municipio) VALUES (:nombre_municipio)";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':nombre_municipio', $nombre_municipio);
        return $stmt->execute();
    }

    // Actualizar un municipio
    public function ActualizarMunicipio($id_municipio, $nombre_municipio)
    {
        $query = "UPDATE " . $this->table . " SET nombre_municipio = :nombre_municipio WHERE id_municipio = :id_municipio";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_municipio', $id_municipio, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_municipio', $nombre_municipio);
        return $stmt->execute();
    }

    // Eliminar un municipio
    public function EliminarMunicipio($id_municipio)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id_municipio = :id_municipio";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_municipio', $id_municipio, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
