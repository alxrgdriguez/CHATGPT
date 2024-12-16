<?php

namespace ChatGPT;

use ChatGPT\controladores\controladorBlog;
use ChatGPT\controladores\controladorUsuarios;



session_start();
//session_destroy();


/**
 * AUTOLOAD
 */
spl_autoload_register(function ($class) {
    //echo $class."<br>";
    //echo substr($class, strpos($class,"\\")+1);
    $ruta = substr($class, strpos($class,"\\")+1);
    $ruta = str_replace("\\", "/", $ruta);
    include_once "./" . $ruta . ".php";
});

// Comprobar enlaces
if (isset($_GET['accion'])) {
    if (strcmp($_GET['accion'], "mostrarBlog") == 0) {
        controladorBlog::mostrarBlog();
    }

    if (strcmp($_GET['accion'], "cerrarSesion") == 0) {
        session_destroy();
        header("Location: index.php");
        exit();
    }

    if (strcmp($_GET['accion'], "generarBlog") == 0) {
        $tituloBlog = $_POST['temaBlog'];

        controladorBlog::generarBlog($_POST['contenidoBlog']);
    }

    if (strcmp($_GET['accion'], "mostrarAdministracion") == 0) {
        controladorBlog::mostrarAdministracion();
    }

}elseif ($_POST){
    if (isset($_POST['registro'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        controladorUsuarios::registrarUsuario($email, $password);

    }

    if (isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        controladorUsuarios::loginUsuario($email, $password);

    }
}else{

    if (isset($_SESSION['usuario'])) {
        header("Location: index.php?accion=mostrarBlog");
        exit();
    // Si no volvemos a la pagina de inicio
    }else{
        controladorUsuarios::mostrarLogin("");
    }
}

