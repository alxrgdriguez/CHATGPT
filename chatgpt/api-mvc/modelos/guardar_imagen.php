<?php

// Asegúrate de tener las rutas correctas para las clases que usas
require_once './ModeloUsuarios.php';

// Obtener la URL de la imagen desde la solicitud POST
$data = json_decode(file_get_contents('php://input'), true);
$imageUrl = $data['imageUrl'];

// Validar si la URL es válida
if (empty($imageUrl)) {
    echo json_encode(['success' => false, 'message' => 'URL de imagen inválida.']);
    exit;
}

try {
    // Llamar a la función de guardar la imagen
    $imagePath = guardarImagenEnServidor($imageUrl);

    // Devolver la ruta de la imagen guardada
    echo json_encode(['success' => true, 'imagePath' => $imagePath]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

function guardarImagenEnServidor($imageUrl) {
    // Obtener los datos de la imagen desde la URL
    $imageData = file_get_contents($imageUrl);

    // Comprobar si la descarga de la imagen fue exitosa
    if ($imageData === false) {
        throw new Exception("No se pudo descargar la imagen.");
    }

    // Generar un nombre único para la imagen
    $imageName = 'image_' . time() . '.jpg';

    // Ruta donde guardarás la imagen (en la carpeta 'img' del proyecto)
    $imagePath = '../img/' . $imageName;

    // Guardar la imagen en el servidor
    if (file_put_contents($imagePath, $imageData) === false) {
        throw new Exception("No se pudo guardar la imagen en el servidor.");
    }

    return $imagePath;
}


?>

