<?php
class Ficha
{
    private $connect;
    private $table = 'ficha';

    public $id_ficha;
    public $numero_ficha;
    public $fk_id_programa;
    public $fk_id_municipio;
    public $fk_id_sede;

    public function __construct($db)
    {
        $this->connect = $db;
    }

    // Obtener todas las fichas
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        return $stmt->execute() ? $stmt : false;
    }

    // Obtener una ficha por ID
    public function BuscarFicha($id_ficha)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_ficha = :id_ficha";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_ficha', $id_ficha, PDO::PARAM_INT);
        return $stmt->execute() ? $stmt : false;
    }

    // Crear una nueva ficha
    public function CrearFicha($numero_ficha, $fk_id_programa, $fk_id_municipio, $fk_id_sede)
    {
        $query = "INSERT INTO " . $this->table . " 
                  (numero_ficha, fk_id_programa, fk_id_municipio, fk_id_sede) 
                  VALUES (:numero_ficha, :fk_id_programa, :fk_id_municipio, :fk_id_sede)";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':numero_ficha', $numero_ficha);
        $stmt->bindParam(':fk_id_programa', $fk_id_programa, PDO::PARAM_INT);
        $stmt->bindParam(':fk_id_municipio', $fk_id_municipio, PDO::PARAM_INT);
        $stmt->bindParam(':fk_id_sede', $fk_id_sede, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Actualizar una ficha
    public function ActualizarFicha($id_ficha, $numero_ficha, $fk_id_programa, $fk_id_municipio, $fk_id_sede)
    {
        $query = "UPDATE " . $this->table . " 
                  SET numero_ficha = :numero_ficha, fk_id_programa = :fk_id_programa, 
                      fk_id_municipio = :fk_id_municipio, fk_id_sede = :fk_id_sede 
                  WHERE id_ficha = :id_ficha";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_ficha', $id_ficha, PDO::PARAM_INT);
        $stmt->bindParam(':numero_ficha', $numero_ficha);
        $stmt->bindParam(':fk_id_programa', $fk_id_programa, PDO::PARAM_INT);
        $stmt->bindParam(':fk_id_municipio', $fk_id_municipio, PDO::PARAM_INT);
        $stmt->bindParam(':fk_id_sede', $fk_id_sede, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Eliminar una ficha
    public function EliminarFicha($id_ficha)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id_ficha = :id_ficha";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_ficha', $id_ficha, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
