<?php
// Definición de la clase User para manejar la información de los usuarios en la base de datos
class User
{
    // Propiedad privada para almacenar la conexión a la base de datos
    private $connect;

    // Nombre de la tabla en la base de datos
    private $table = 'usuarios';

    // Propiedades públicas que representan las columnas de la tabla users
    public $id_usuario;
    public $nombres;
    public $identificacion;
    public $apellidos;
    public $correo;
    public $fk_id_area;
    public $fk_id_rol;

    // Constructor de la clase, recibe la conexión a la base de datos como parámetro
    public function __construct($db)
    {
        $this->connect = $db;
    }

    // Método para obtener todos los usuarios de la base de datos
    public function getAll()
    {

        // Consulta SQL para seleccionar todos los registros de la tabla users
        $query = "SELECT * FROM " . $this->table; // Se agregó un espacio después de "FROM" para evitar errores

        // Prepara la consulta SQL
        $stmt = $this->connect->prepare($query);

        // Ejecuta la consulta y maneja posibles errores
        if ($stmt->execute()) {
            return $stmt; // Retorna el resultado si la consulta es exitosa
        } else {
            // Captura los errores en la consulta SQL y los muestra
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

   // Obtener un usuario por ID_usuario
   public function BuscarUsuario($id_usuario)
   {
       $query = "SELECT * FROM " . $this->table . " WHERE id_usuario = :id_usuario";
       $stmt = $this->connect->prepare($query);
       $stmt ->bindParam(':id_usuario',$id_usuario, PDO::PARAM_INT);
       if ($stmt->execute()) {
        return $stmt; // Retorna el resultado si la consulta es exitosa
    } else {
        // Captura los errores en la consulta SQL y los muestra
        $errors = $stmt->errorInfo();
        die("Error en la consulta SQL: " . $errors[2]);
    }
   }

   // Crear un nuevo usuario
   public function CrearUsuario($nombres, $identificacion)
   {
       $query = "INSERT INTO usuarios (nombres, identificacion, apellidos, correo ,fk_id_area, fk_id_rol) VALUES (:nombres, :identificacion, :apellidos, :correo, :fk_id_area, fk_id_rol)";
       $stmt = $this->connect->prepare($query);
       $stmt->bindParam(':nombres', $nombres);
       $stmt->bindParam(':identificacion', $identificacion);
       $stmt->bindParam(':apellidos', $apellidos);
       $stmt->bindParam(':correo', $correo);$stmt->bindParam(':fk_id_area', $fk_id_area);$stmt->bindParam(':fk_id_rol', $fk_id_rol);
       
       if ($stmt->execute()) {
        return $stmt; // Retorna el resultado si la consulta es exitosa
    } else {
        // Captura los errores en la consulta SQL y los muestra
        $errors = $stmt->errorInfo();
        die("Error en la consulta SQL: " . $errors[2]);
    }
   }
   
   // Actualizar usuario
   public function ActualizarUsuario($id_usuario, $nombres, $identificacion)
   {
       $query = "UPDATE " . $this->table . " SET nombres = ?, identificacion = ?, apellidos = ?, correo = ?,fk_id_area = ?, fk_id_rol= ? WHERE id_usuario = ?";
       $stmt = $this->connect->prepare($query);

       if ($stmt->execute([$nombres, $identificacion, $apellidos, $correo , $fk_id_area, $fk_id_rol,$id_usuario])) {
        return $stmt; // Retorna el resultado si la consulta es exitosa
    } else {
        // Captura los errores en la consulta SQL y los muestra
        $errors = $stmt->errorInfo();
        die("Error en la consulta SQL: " . $errors[2]);
    }
   }

   // Eliminar usuario
   public function EliminarUsuario($id_usuario)
   {
       $query = "DELETE FROM " . $this->table . " WHERE id_usuario = :";
       $stmt = $this->connect->prepare($query);

       if ($stmt->execute([$id_usuario])) {
        return $stmt; // Retorna el resultado si la consulta es exitosa
    } else {
        // Captura los errores en la consulta SQL y los muestra
        $errors = $stmt->errorInfo();
        die("Error en la consulta SQL: " . $errors[2]);
    }
       
   }
}
    

