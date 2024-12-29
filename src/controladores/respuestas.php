<?php
session_start();
include "../../config/config.php"; // Incluye la conexión a la base de datos

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verifica si se ha pasado el ID del post a eliminar
        $data = json_decode(file_get_contents('php://input'), true); // Obtiene el cuerpo de la solicitud

        if (isset($data['id'])) {
            $postId = (int)$data['id'];

            // Prepara y ejecuta la consulta para eliminar el post
            $sql = "DELETE FROM respuestas WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $postId, PDO::PARAM_INT);
            $stmt->execute();

            // Verifica si se eliminó alguna fila
            if ($stmt->rowCount() > 0) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'No se encontró la respuesta']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'ID de la respuesta no proporcionado']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    }
} catch (PDOException $e) {
    // En caso de error, devolver un mensaje de error en JSON
    echo json_encode(["error" => $e->getMessage()]);
}
?>
