<?php

namespace ChatGPT\modelos;

require_once __DIR__ . '/ConexionBD.php';
use ChatGPT\modelos\Usuario;
use ChatGPT\modelos\ConexionBD;
use ChatGPT\controladores\ControladorBlog;
use PDO;
use PDOException;

class ModeloArticulos {

    // Metodo para obtener los artículos
    public static function obtenerArticulos() {
        $conexion = new ConexionBD();
        $stmt = $conexion->getConexion()->prepare("SELECT * FROM articulos");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'ChatGPT\modelos\Articulo');
        $articulos = $stmt->fetchAll();
        $conexion->cerrarConexion();

        // Asegúrate de que la propiedad 'imagen' esté correctamente asignada
        foreach ($articulos as $articulo) {
            // Usamos el setter para establecer el valor de la propiedad 'imagen'
            $articulo->setImg($articulo->getImg());
        }

        return $articulos;
    }

    // Metodo para guardar los artículos
    public function guardarArticulos($articulo) {
        $conexion = new ConexionBD();

        // Consulta SQL para insertar los datos en la base de datos
        $sql = "INSERT INTO articulos (titulo, texto, img, fecha) 
                VALUES (?, ?, ?, ?)";

        $stmt = $conexion->getConexion()->prepare($sql);
        $stmt->bindParam(1, $articulo->getTitulo());
        $stmt->bindParam(2, $articulo->getTexto());
        $stmt->bindParam(3, $articulo->getImg());
        $stmt->bindParam(4, $articulo->getFecha());

        $stmt->execute();
        $conexion->cerrarConexion();
    }
}
