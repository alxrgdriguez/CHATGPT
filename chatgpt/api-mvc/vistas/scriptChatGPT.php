<script>
    let contenidoGenerado = "";
    let rutaImagen = "";

    // Evento para cuando el formulario se envía
    document.getElementById('formularioBlog').addEventListener('submit', async function(event) {
        event.preventDefault(); // Prevenir el refresco de la página
        const API_KEY_OPENAI = document.getElementById('apikey').value;

        const temaBlog = document.getElementById('contenidoBlog').value;
        if (!temaBlog.trim()) {
            alert('Por favor, ingresa un tema para el blog.');
            return;
        }
        <?php
        // Para que los errores de PHP no sean visibles en HTML y se manejen apropiadamente
        ini_set('display_errors', 0);
        error_reporting(E_ALL);

        header('Content-Type: application/json');  // Asegúrate de que la respuesta siempre sea JSON

        // Si hay un error, manejarlo y devolverlo como JSON
        try {
        ?>
            // Llamada a la API de OpenAI para generar el contenido en español
            const textoGenerado = await obtenerContenidoGenerado(temaBlog, API_KEY_OPENAI);

            // Llamada a la API de OpenAI para generar la imagen
            const urlImagenGenerada = await obtenerImagenGenerada(temaBlog, API_KEY_OPENAI);

            // Guardar la imagen en el servidor
            rutaImagen = await guardarImagenEnServidor(urlImagenGenerada);

            // Mostrar los resultados generados
            mostrarResultados(textoGenerado, "api-mvc/" +rutaImagen);
            <?php

        } catch (Exception $e) {
            // Si ocurre un error, devolverlo en formato JSON
            echo "Error: " . $e->getMessage();
        }
        ?>

    });

    // Función para obtener el contenido generado desde OpenAI
    async function obtenerContenidoGenerado(tema, API_KEY_OPENAI) {
        const response = await fetch('https://api.openai.com/v1/chat/completions', {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${API_KEY_OPENAI}`, // Usamos la variable con la clave API
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                model: "gpt-3.5-turbo", // Modelo recomendado
                messages: [
                    {
                        role: "system",
                        content: "Eres un asistente que ayuda a crear contenido para un blog en español."
                    },
                    {
                        role: "user",
                        content: `Escribe un artículo en español sobre el tema: ${tema}`
                    }
                ],
                max_tokens: 300,
                temperature: 0.7
            })
        });

        const data = await response.json();
        const text = data.choices[0]?.message?.content.trim() || "No se pudo generar el contenido.";
        return text;
    }

    // Función para obtener la imagen generada desde OpenAI
    async function obtenerImagenGenerada(tema, API_KEY_OPENAI) {
        const imageResponse = await fetch('https://api.openai.com/v1/images/generations', {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${API_KEY_OPENAI}`,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                prompt: `Crea una imagen visualmente atractiva sobre: ${tema}`,
                n: 1,
                size: "512x512"
            })
        });

        const imageData = await imageResponse.json();

        // Verificar si la propiedad 'data' existe y tiene al menos un elemento
        if (imageData.data && imageData.data.length > 0) {
            const imageUrl = imageData.data[0].url;
            return imageUrl;
        } else {
            console.error("No se pudo generar la imagen, datos inválidos:", imageData);
            return "https://via.placeholder.com/512";  // Imagen predeterminada si no se puede generar
        }
    }


    // Función para guardar la imagen en el servidor
    async function guardarImagenEnServidor(imageUrl) {
        // Enviar la solicitud POST al servidor para guardar la imagen
        const response = await fetch('./modelos/guardar_imagen.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                imageUrl: imageUrl  // URL de la imagen que se quiere descargar y guardar
            })
        });

        const data = await response.json();
        if (!data.success) {
            throw new Error('Error al guardar la imagen en el servidor');
        }
        return data.imagePath;  // Ruta de la imagen guardada en el servidor
    }

    // Función para mostrar los resultados en la página
    function mostrarResultados(textoGenerado, rutaImagen) {
        contenidoGenerado = textoGenerado;
        document.getElementById('textoGenerado').textContent = textoGenerado;
        document.getElementById('imagenGenerada').src = rutaImagen;
        document.getElementById('seccionResultados').classList.remove('d-none');
        document.getElementById('botonGuardar').classList.remove('d-none');  // Mostrar el botón de guardar
    }

    // Evento para guardar el post en la base de datos
    document.getElementById('botonGuardar').addEventListener('click', async function() {
        const temaBlog = document.getElementById('contenidoBlog').value;
        try {
            const response = await fetch('./modelos/procesar_articulos.php', {  // Cambia aquí la URL
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    contenido: contenidoGenerado,
                    ruta_imagen: rutaImagen,
                    tema_blog: temaBlog
                })
            });
            // Log para inspeccionar la respuesta
            const responseText = await response.text();  // Obtener la respuesta como texto primero
            window.location.href = "index.php?accion=mostrarBlog";


        } catch (error) {
            window.location.href = "index.php?accion=mostrarBlog";
        }
    });




</script>