<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatGPT API</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .card {
            border-radius: 15px;
            overflow: hidden;
        }

        .card-img-top {
            height: 400px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .card-img-top:hover {
            transform: scale(1.05);  /* Al hacer hover, la imagen se amplía un poco */
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 1.8rem;
            font-weight: bold;
            color: #333;
        }

        .card-text {
            font-size: 1.2rem;
            color: #555;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            font-size: 1.1rem;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>
<header class="p-3 text-bg-dark">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="index.php?accion=mostrarBlog" class="nav-link px-2 text-white">Blog</a></li>
                <?php
                if (isset($_SESSION['usuario'])) {
                    $nombreUsuario = $_SESSION['usuario']['email'];
                    echo '
                        <li><a href="index.php?accion=mostrarAdministracion" class="nav-link px-2 text-white">Gestion Administrativa</a></li>
                    ';
                }
                ?>
            </ul>

            <?php
            if (isset($_SESSION['usuario'])) {
                $nombreUsuario = $_SESSION['usuario']['email'];
                echo '
                    
                    <div class="d-flex align-items-center">
                        <button class="btn btn-dark mx-3 me-2 d-flex align-items-center shadow-lg border-0 rounded-pill px-2 py-2" type="button">
                            <i class="fas fa-user-circle fs-4 me-2"></i> ' . ($nombreUsuario) . '
                        </button>
                        <a href="index.php?accion=cerrarSesion" class="btn btn-danger me-4 px-3 mx-2">
                            <i class="fas fa-sign-out-alt mt-2"></i> Cerrar sesión
                        </a>
                    </div>';
            }
            ?>
        </div>
    </div>
</header>
