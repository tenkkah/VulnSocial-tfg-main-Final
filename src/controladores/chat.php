<?php
include "../../config/config.php"; 

// Verificar si se proporciona un ID de usuario
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo json_encode(['error' => 'ID de usuario no válido.']);
    exit;
}

$userId = intval($_GET['id']);
$action = $_GET['action'] ?? null;

try {
    if ($action === 'obtenerPosts') {
        // Obtener los posts del usuario
        $stmt = $pdo->prepare("SELECT * FROM posts WHERE user_id = :userId ORDER BY fecha DESC");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($posts) {
            echo json_encode($posts);
        } else {
            echo json_encode(['error' => 'Este usuario no tiene posts.']);
        }
    } else {
        // Obtener la información del usuario
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :userId");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            echo json_encode($user);
        } else {
            echo json_encode(['error' => 'Usuario no encontrado.']);
        }
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
}
?>
