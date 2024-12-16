<?php

namespace ChatGPT\controladores;

use ChatGPT\modelos\ModeloUsuarios;
use ChatGPT\modelos\Usuario;
use ChatGPT\vistas\VistaLogin;

class controladorUsuarios {
    public static function registrarUsuario($email, $password)
    {
        $usuario = new Usuario(0, $email, $password);
        // Verificar si el usuario existe
        $usuarioExiste = ModeloUsuarios::usuarioExiste($usuario);
        if($usuarioExiste){
            controladorUsuarios::mostrarLogin("Este usuario ya existe");
            exit();
        }

        // Hashear password
        $passwordHash = password_hash($usuario->getPassword(), PASSWORD_BCRYPT);
        $usuario->setPassword($passwordHash);
        $usuarioId = ModeloUsuarios::registrarUsuario($usuario);
        if($usuarioId){
            $_SESSION['usuario'] = array('id' => $usuarioId, 'email' => $usuario->getEmail());
            header("Location: index.php?accion=mostrarBlog");
            exit();
        }
    }

    public static function mostrarLogin($error) {
        VistaLogin::render($error);
    }

    public static function loginUsuario($email, $password)
    {
        $usuario = ModeloUsuarios::obtenerUsuarioPorEmail($email);
        if($usuario === null){
            controladorUsuarios::mostrarLogin("Este usuario no existe");
            exit();
        }

        if (password_verify($password, $usuario->getPassword())) {
            $_SESSION['usuario'] = array(
                'email' => $usuario->getEmail()
            );
            header("Location: index.php?accion=mostrarBlog");
            exit();
        } else {
            controladorUsuarios::mostrarLogin("Este usuario ya existe");
        }
    }
}
