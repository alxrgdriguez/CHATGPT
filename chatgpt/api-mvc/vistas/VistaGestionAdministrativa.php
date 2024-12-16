<?php

namespace ChatGPT\vistas;

class VistaGestionAdministrativa {

    public static function mostrarAdministracion()
    {
        include 'cabecera.php';
        ?>
        <div class="container mt-5">
            <h1 class="mb-4">Crear un Post para el Blog</h1>
            <form id="formularioBlog">
                <div class="mb-3">
                    <input type="text" id="apikey" class="form-control" placeholder="API Key">
                    <label for="contenidoBlog" class="form-label">Tema del Blog</label>
                    <textarea class="form-control" id="contenidoBlog" rows="6" placeholder="Escribe el tema de tu post aquí..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Generar</button>
                <button type="button" id="botonGuardar" class="btn btn-success d-none">Guardar</button>
                <button type="reset" class="btn btn-secondary">Limpiar</button>
            </form>

            <!-- Sección para mostrar el contenido generado -->
            <div id="seccionResultados" class="mt-5 d-none">
                <h2>Contenido Generado</h2>
                <p id="textoGenerado"></p>
                <h3>Imagen Generada</h3>
                <img id="imagenGenerada" class="img-fluid" alt="Imagen generada">
            </div>
        </div>

        <!-- Bootstrap Bundle con Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

        <?php include 'scriptChatGPT.php'; ?>
        <?php
        include 'pie.php';
    }
}
?>
