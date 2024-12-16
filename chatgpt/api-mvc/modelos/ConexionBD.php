<?php

namespace ChatGPT\modelos;

use \PDO;
use PDOException;

class ConexionBD {

    private $conexion;

    public function __construct() {

        // Cambiar el host a 'db' (el nombre del servicio de MariaDB en Docker Compose)
        $host = 'mariadb_chatgpt'; // 'db' es el nombre del servicio de MariaDB en docker-compose.yml
        $puerto = '3306'; // El puerto interno en el contenedor (no necesitas especificarlo aquí si usas la red interna de Docker)
        $db = 'Blog'; // Nombre de la base de datos
        $usuario = 'root'; // Usuario de la base de datos
        $clave = 'toor'; // Contraseña del usuario

        try {
            if ($this->conexion == null) {
                $this->conexion = new PDO("mysql:host=$host;dbname=$db;port=$puerto", $usuario, $clave);
                $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            }

        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
        }

    }

    /**
     * Obtener la conexión a la base de datos
     */
    public function getConexion() {
        return $this->conexion;
    }

    /**
     * Cerrar la conexión a la base de datos
     */
    public function cerrarConexion() {
        $this->conexion = null;
    }

}
