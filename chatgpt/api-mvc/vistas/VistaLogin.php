<?php

namespace ChatGPT\vistas;

class VistaLogin {

    public static function render($error) {

        include "cabecera.php";
        ?>
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <!-- Formulario de Login -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header text-center bg-primary text-white">
                            <h4 class="mb-0">Iniciar sesión</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="index.php">
                                <div class="mb-3">
                                    <?php
                                    if ($error === "Este usuario no existe") {
                                        echo "<p class='text-danger'>{$error}</p>";
                                    }
                                    ?>
                                    <label for="emailLogin" class="form-label">Correo electrónico</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control" id="emailLogin" name="email" placeholder="Ingresa tu correo" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="passwordLogin" class="form-label">Contraseña</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        <input type="password" class="form-control" id="passwordLogin" name="password" placeholder="Ingresa tu contraseña" required>
                                    </div>
                                </div>
                                <button type="submit" name="login" class="btn btn-primary w-100">Iniciar sesión</button>
                            </form>
                            <div class="text-center mt-3">
                                <p>¿No tienes cuenta? <a href="#registerForm" class="toggle-btn">Regístrate aquí</a></p>
                            </div>
                        </div>
                    </div>

                    <!-- Formulario de Registro -->
                    <div class="card shadow-sm" id="registerForm">
                        <div class="card-header text-center bg-secondary text-white">
                            <h4 class="mb-0">Registrarse</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="index.php">
                                <?php
                                if ($error === "Este usuario ya existe") {
                                    echo "<p class='text-danger'>{$error}</p>";
                                }
                                ?>
                                <div class="mb-3">
                                    <label for="emailRegister" class="form-label">Correo Electrónico</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control" id="emailRegister" name="email" placeholder="Ingresa tu correo" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="passwordRegister" class="form-label">Contraseña</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        <input type="password" class="form-control" minlength="8" id="passwordRegister" name="password" placeholder="Ingresa tu contraseña" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-secondary w-100" name="registro">Registrarse</button>
                            </form>
                            <div class="text-center mt-3">
                                <p>¿Ya tienes cuenta? <a href="#emailLogin" class="toggle-btn">Inicia sesión aquí</a></p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <?php
        include "pie.php";
    }

}
