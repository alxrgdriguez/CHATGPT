<?php

namespace ChatGPT\modelos;
require_once __DIR__ . '/ConexionBD.php';  // Usar la ruta relativa correcta
use ChatGPT\modelos\Usuario;
use ChatGPT\modelos\ConexionBD;

use \PDO;
use PDOException;

class ModeloUsuarios {

    // Metodo para obtener los usuarios
    public static function usuarioExiste($usuario)
    {
        $conexion = new ConexionBD();
        $stmt= $conexion->getConexion()->prepare("SELECT * FROM usuarios WHERE email=?");
        $stmt->bindValue(1, $usuario->getEmail());
        $stmt->execute();
        $conexion->cerrarConexion();
        // Si es uno se ha insertado en base de datos
        return $stmt->rowCount() == 1;
    }

    // Metodo para obtener el usuario por email
    public static function registrarUsuario($usuario)
    {
        $conexion = new ConexionBD();
        $stmt= $conexion->getConexion()->prepare("INSERT INTO usuarios(email, password) VALUES (?,?)");
        $stmt->bindValue(1, $usuario->getEmail());
        $stmt->bindValue(2, $usuario->getPassword());
        $stmt->execute();
        $idSesion = $usuario->getEmail();
        $conexion->cerrarConexion();
        // Si es uno se ha insertado en base de datos
        return $idSesion;

    }

    // Metodo para obtener el usuario por email
    public static function obtenerUsuarioPorEmail($email)
    {
        $conexion = new ConexionBD();

        $stmt = $conexion->getConexion()->prepare("SELECT * FROM usuarios 
                        WHERE email = ?");
        $stmt->bindValue(1, $email);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'ChatGPT\modelos\Usuario');
        $stmt->execute(); //La ejecución de la consulta
        $usuario = $stmt->fetch();

        $conexion->cerrarConexion();

        if($stmt->rowCount() == 0){//Si no hay resultados, devuelve null
            return null;
        }else{
            return $usuario;
        }
    }
}


