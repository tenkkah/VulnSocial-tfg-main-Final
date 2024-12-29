<?php
session_start();  // Asegúrate de iniciar la sesión

include "../../config/config.php";  // Conexión a la base de datos

// Verificar si el ID de usuario está en la sesión
if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];  // Obtener el ID del usuario de la sesión

    // Obtener los posts del usuario
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE user_id = :userId ORDER BY FECHA DESC");
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();
    
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($posts);  // Devolver los posts en formato JSON

    
} else {
    echo json_encode(['error' => 'No se ha iniciado sesión o no se encontró el ID del usuario.']);
}
?>
