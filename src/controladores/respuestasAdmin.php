<?php
session_start();
include "../../config/config.php"; 

try {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['action'])) {
            if ($_GET['action'] === 'listaRespuestas') {
                // Consulta para obtener todas las respuestas
                $sql = "SELECT r.*, u.username FROM respuestas r JOIN users u ON r.user_id = u.id ORDER BY r.fecha ASC";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $respuestas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                echo json_encode($respuestas);
            } elseif ($_GET['action'] === 'obtenerRespuesta' && isset($_GET['id'])) {
                // Obtener datos de una respuesta específica
                $respuestaId = $_GET['id'];

                $sql = "SELECT r.*, u.username FROM respuestas r JOIN users u ON r.user_id = u.id WHERE r.id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$respuestaId]);
                $respuesta = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($respuesta) {
                    echo json_encode($respuesta);
                } else {
                    echo json_encode(["error" => "Respuesta no encontrada"]);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Acción no válida.']);
            }
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_GET['action'])) {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if ($_GET['action'] === 'actualizarRespuesta') {
                // Actualizar datos de una respuesta
                if (isset($data['id'], $data['respuesta'], $data['user_id'], $data['post_id'], $data['fecha'])) {
                    $id = $data['id'];
                    $respuesta = $data['respuesta'];
                    $user_id = $data['user_id'];
                    $post_id = $data['post_id'];
                    $fecha = date('Y-m-d', strtotime($data['fecha']));  // Formato de fecha correcto
    
                    $sql = "UPDATE respuestas SET content = ?, user_id = ?, post_id = ?, fecha = ? WHERE id = ?";
                    $stmt = $pdo->prepare($sql);
                    $success = $stmt->execute([$respuesta, $user_id, $post_id, $fecha, $id]);
    
                    if ($success) {
                        echo json_encode(["success" => true, "message" => "Respuesta actualizada correctamente."]);
                    } else {
                        echo json_encode(["success" => false, "message" => "Error al actualizar la respuesta."]);
                    }
                } else {
                    echo json_encode(["success" => false, "message" => "Datos incompletos."]);
                }
            } elseif ($_GET['action'] === 'eliminarRespuesta') {
                // Eliminar una respuesta
                if (isset($data['id'])) {
                    $respuestaId = $data['id'];

                    $sql = "DELETE FROM respuestas WHERE id = ?";
                    $stmt = $pdo->prepare($sql);
                    $success = $stmt->execute([$respuestaId]);

                    if ($success && $stmt->rowCount() > 0) {
                        echo json_encode(["success" => true, "message" => "Respuesta eliminada correctamente."]);
                    } else {
                        echo json_encode(["success" => false, "message" => "No se encontró la respuesta."]);
                    }
                } else {
                    echo json_encode(["success" => false, "message" => "ID de la respuesta no proporcionado."]);
                }
            } elseif ($_GET['action'] === 'agregarRespuesta') {
                // Agregar una nueva respuesta
                if (isset($data['post_id'], $data['content'], $data['user_id'])) {
                    $post_id = $data['post_id'];
                    $respuesta = $data['content'];
                    $user_id = $data['user_id'];

                    $sql = "INSERT INTO respuestas (post_id, user_id, content, fecha) VALUES (?, ?, ?, NOW())";
                    $stmt = $pdo->prepare($sql);
                    $success = $stmt->execute([$post_id, $user_id, $respuesta]);

                    if ($success) {
                        echo json_encode(["success" => true, "message" => "Respuesta agregada correctamente."]);
                    } else {
                        echo json_encode(["success" => false, "message" => "Error al agregar la respuesta."]);
                    }
                } else {
                    echo json_encode(["success" => false, "message" => "Datos incompletos para la respuesta."]);
                }
            }
        } else {
            echo json_encode(["success" => false, "message" => "Acción no válida."]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error en el servidor.', 'error' => $e->getMessage()]);
}
?>
