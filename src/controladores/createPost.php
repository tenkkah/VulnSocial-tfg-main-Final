<?php
session_start();
include_once "../../config/config.php"; // Conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['id'])) {
        $userId = $_SESSION['id'];
        $postContent = !empty($_POST['post']) ? $_POST['post'] : null; // Texto opcional

        // Extraer hashtags del contenido del post
        preg_match_all('/#(\w+)/', $postContent, $matches);
        $hashtags = array_unique($matches[0]); // Extrae hashtags y elimina duplicados

        // Eliminar los hashtags del contenido para que no se muestren como texto
        $postContent = preg_replace('/#\w+/', '', $postContent);

        // Manejo de archivos multimedia (imágenes, videos, otros)
        $mediaPath = null;
        if (isset($_FILES['media']) && $_FILES['media']['error'] === 0) {
            $extension = pathinfo($_FILES['media']['name'], PATHINFO_EXTENSION);
            $mediaName = uniqid("uploaded_") . "." . $extension;
            $targetPath = "../../uploads/" . $mediaName;

            // Mover el archivo al directorio de destino
            if (move_uploaded_file($_FILES['media']['tmp_name'], $targetPath)) {
                $mediaPath = $mediaName; // Almacena solo el nombre del archivo
            } else {
                echo json_encode(["success" => false, "message" => "Error al subir el archivo"]);
                exit;
            }
        }

        // Verifica si hay al menos un contenido para insertar (texto o archivo multimedia)
        if ($postContent || $mediaPath) {
            try {
                // Convertir los hashtags a formato JSON para almacenarlos en la base de datos
                $hashtagsJson = json_encode($hashtags);

                // Inserción en la base de datos
                $stmt = $pdo->prepare("INSERT INTO posts (user_id, content, media_path, hashtags, fecha) VALUES (:user_id, :content, :media_path, :hashtags, NOW())");
                $stmt->execute([
                    'user_id' => $userId,
                    'content' => $postContent,
                    'media_path' => $mediaPath,
                    'hashtags' => $hashtagsJson
                ]);

                echo json_encode(["success" => true, "message" => "Post creado con éxito"]);
            } catch (PDOException $e) {
                echo json_encode(["success" => false, "message" => "Error de base de datos: " . $e->getMessage()]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Error: se requiere texto o archivo multimedia para el post"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Error: usuario no logueado"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Método no permitido"]);
}
?>
