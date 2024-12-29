<?php
session_start();
include '../../config/config.php'; // Conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($_SESSION['id']) && isset($data['postId'])) {
        $userId = $_SESSION['id'];
        $postId = intval($data['postId']);

        // Comprobar si el usuario ya dio like
        $checkQuery = $pdo->prepare("SELECT * FROM likes WHERE user_id = ? AND post_id = ?");
        $checkQuery->execute([$userId, $postId]);
        $liked = $checkQuery->rowCount() > 0;

        if ($liked) {
            // Si ya dio like, eliminarlo
            $deleteQuery = $pdo->prepare("DELETE FROM likes WHERE user_id = ? AND post_id = ?");
            $deleteQuery->execute([$userId, $postId]);
        } else {
            // Si no dio like, agregarlo
            $insertQuery = $pdo->prepare("INSERT INTO likes (user_id, post_id) VALUES (?, ?)");
            $insertQuery->execute([$userId, $postId]);
        }

        // Actualizar el número total de likes en la tabla de posts
        $countQuery = $pdo->prepare("SELECT COUNT(*) AS total FROM likes WHERE post_id = ?");
        $countQuery->execute([$postId]);
        $likes = $countQuery->fetch(PDO::FETCH_ASSOC)['total'];

        $updatePostQuery = $pdo->prepare("UPDATE posts SET likes = ? WHERE id = ?");
        $updatePostQuery->execute([$likes, $postId]);

        echo json_encode([
            "success" => true,
            "liked" => !$liked,
            "likes" => $likes
        ]);
        exit;
    }
}

// Si es una solicitud GET para obtener el estado de los likes, ya que cuando hago log off y log in de nuevo volver a mostrar mis likes pintados
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
    $postId = isset($_GET['postId']) ? intval($_GET['postId']) : 0;

    if ($postId > 0) {
        $checkQuery = $pdo->prepare("SELECT * FROM likes WHERE user_id = ? AND post_id = ?");
        $checkQuery->execute([$userId, $postId]);
        $liked = $checkQuery->rowCount() > 0;
        echo json_encode([
            "liked" => $liked
        ]);
        exit;
    }
}


// Manejar solicitudes GET para obtener los posts con likes
if (isset($_GET['likedPosts']) && $_GET['likedPosts'] === 'true') {
    $userId = $_SESSION['id']; // Obtén el ID del usuario logueado

    // Modificamos la consulta para obtener también el nombre del usuario y las fotos/videos/hashtags
    $query = "
        SELECT posts.*, users.username, users.avatar, posts.media_path, posts.hashtags
        FROM posts
        INNER JOIN likes ON posts.id = likes.post_id
        INNER JOIN users ON posts.user_id = users.id
        WHERE likes.user_id = ?
        ORDER BY posts.fecha DESC;

    ";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$userId]);
    $likedPosts = $stmt->fetchAll(PDO::FETCH_ASSOC); // Cambié $stmt->fetch_all() a fetchAll()

    echo json_encode(['success' => true, 'likedPosts' => $likedPosts]);
    exit;
}




echo json_encode(["success" => false]);
?>
