<?php

namespace ChatGPT\vistas;

class VistaBlog {

    public static function mostrarBlog($articulos) {
        include 'cabecera.php';
        ?>
        <div class="container my-5">
            <h2 class="text-center mb-5">Blog de Artículos</h2>
            <div class="row">
                <?php
                foreach ($articulos as $articulo) {
                    ?>
                    <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                        <div class="card shadow-lg border-light">
                            <img src="<?php echo './img/' . htmlspecialchars($articulo->getImg()); ?>" class="card-img-top" alt="Imagen de <?php echo htmlspecialchars($articulo->getTitulo()); ?>">
                            <div class="card-body">
                                <h5 class="card-title" style="font-size: 1rem; font-weight: bold;"><?php echo htmlspecialchars($articulo->getTitulo()); ?></h5>
                                <p class="card-text" style="font-size: 1.2rem; max-height: 200px; overflow: hidden;">
                                    <?php echo nl2br(htmlspecialchars($articulo->getTexto())); ?>
                                </p>
                                <a href="#" class="btn btn-primary btn-lg">Leer más</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
        include 'pie.php';
    }
}
