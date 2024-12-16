<?php

// Aquí se incluyen las clases necesarias
use ChatGPT\modelos\Articulo;
use ChatGPT\modelos\ModeloArticulos;

require_once './ModeloArticulos.php';
require_once './Articulo.php';
header('Content-Type: application/json');

try {
// Obtener datos desde el cuerpo de la solicitud POST
$data = json_decode(file_get_contents('php://input'), true);

// Verificar si los datos necesarios están presentes
if (isset($data['contenido'], $data['ruta_imagen'], $data['tema_blog'])) {

    // Crear una instancia de la clase Articulo
    $articulo = new Articulo();
    $articulo->setTitulo($data['tema_blog']); // Establecer el título
    $articulo->setTexto($data['contenido']); // Establecer el contenido generado
    $articulo->setImg($data['ruta_imagen']); // Establecer la imagen
    $articulo->setFecha(date('Y-m-d H:i:s'));  // Fecha actual

    // Crear una instancia de ModeloArticulos
    $modeloArticulos = new ModeloArticulos();

    $modeloArticulos->guardarArticulos($articulo);
}
    echo json_encode(['success' => true, 'message' => 'Post guardado con éxito']);
} catch (Exception $e) {
    // Si ocurre un error, devuelve una respuesta JSON con el error
    echo json_encode(['success' => false, 'message' => 'Error al guardar el post: ' . $e->getMessage()]);
}


?>
