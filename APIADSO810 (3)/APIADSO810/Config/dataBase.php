<?php

// Definición de la clase encargada de la conexión a la base de datos
class dataBase
{

    // Propiedades privadas para la configuración de la conexión
    private $host = "localhost";  // Servidor donde se encuentra la base de datos
    private $user = "root";       // Usuario de la base de datos (por defecto en XAMPP es "root")
    private $pass = "";           // Contraseña del usuario (vacía por defecto en XAMPP)
    private $dbname = "proyecto_formativo"; // Nombre de la base de datos a la que se conectará

    // Propiedad pública que almacenará la conexión a la base de datos
    public $connect;

    // Método para establecer la conexión a la base de datos
    public function getConnection()
    {
        // Inicializa la conexión como null para asegurarse de que no haya conexiones previas activas
        $this->connect = null;

        try {
            // Se crea una instancia de PDO con los datos de conexión
            $this->connect = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);

            // Configura PDO para que genere excepciones en caso de error
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Establece la codificación de caracteres en UTF-8 para evitar problemas con caracteres especiales
            $this->connect->exec("SET CHARACTER SET utf8");
        } catch (PDOException $e) {
            // Captura y muestra cualquier error que ocurra durante la conexión
            echo "Error: " . $e->getMessage();
        }

        // Devuelve la conexión establecida (o null en caso de fallo)
        return $this->connect;
    }
}
