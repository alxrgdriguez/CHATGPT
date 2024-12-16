<?php

namespace ChatGPT\controladores;

use ChatGPT\modelos\ModeloArticulos;
use ChatGPT\modelos\Usuario;
use ChatGPT\vistas\VistaBlog;
use ChatGPT\vistas\VistaGestionAdministrativa;

class controladorBlog {

    public static function mostrarBlog() {
        // Obtener los artículos del blog
        $articulos = ModeloArticulos::obtenerArticulos();
        VistaBlog::mostrarBlog($articulos);
    }

    public static function mostrarAdministracion()
    {
        VistaGestionAdministrativa::mostrarAdministracion();
    }


}
