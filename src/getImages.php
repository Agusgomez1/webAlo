<?php
$baseFolder = "src/img/fotografialo/";  // Carpeta base donde están las imágenes
$categories = ["congresos", "eventos_sociales", "workshops"];  // Nombres de las carpetas
$images = [];

foreach ($categories as $category) {
    $folderPath = $baseFolder . $category . "/";
    $files = glob($folderPath . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);

    foreach ($files as $file) {
        $images[] = [
            "category" => $category,  // Guarda la categoría
            "src" => $file,
            "alt" => ucfirst($category)  // Primera letra en mayúscula
        ];
    }
}

// Devolver en formato JSON
header("Content-Type: application/json");
echo json_encode($images);
