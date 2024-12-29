<?php
session_start();
include_once "../../config/config.php"; // Incluye la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['username'];
    $postContent = $_POST['post'];

    // Validar que el contenido del post no esté vacío
    if (empty($postContent)) {
        echo json_encode(["success" => false, "message" => "El contenido del post no puede estar vacío."]);
        exit;
    }

    // Inserción vulnerable a SQL Injection (no recomendado para producción)
    $sql = "INSERT INTO posts (username, content) VALUES ('$username', '$postContent')";
    $stmt = $pdo->query($sql);

    if ($stmt) {
        // Respuesta JSON válida
        echo json_encode([
            "success" => true,
            "message" => "Post insertado con éxito.",
            "username" => $username,
            "content" => $postContent,
            "created_at" => date('Y-m-d H:i:s') // Agregar la fecha y hora actual
        ]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al insertar el post."]);
    }
}
?>
