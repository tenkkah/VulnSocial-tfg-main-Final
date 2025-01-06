<?php
session_start();
include "../../config/config.php"; 

try {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['action'])) {
            if ($_GET['action'] === 'listaPosts') {
                // Parámetros de paginación
                $page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Página actual
                $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 5; // Límite de posts por página
            
                if ($page < 1) $page = 1; // Validar que la página sea mayor o igual a 1
                if ($limit < 1) $limit = 5; // Validar que el límite sea mayor o igual a 1
            
                $offset = ($page - 1) * $limit; // Calcular el offset
            
                // Consulta para obtener el total de registros
                $countSql = "SELECT COUNT(*) AS total FROM posts";
                $stmt = $pdo->prepare($countSql);
                $stmt->execute();
                $totalRecords = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
                // Calcular el total de páginas
                $totalPages = ceil($totalRecords / $limit);
            
                // Consulta para obtener los posts con paginación
                $sql = "SELECT p.*, u.username, u.avatar 
                        FROM posts p 
                        JOIN users u ON p.user_id = u.id 
                        ORDER BY p.fecha DESC 
                        LIMIT :limit OFFSET :offset";
                $stmt = $pdo->prepare($sql);
            
                // Bind de parámetros
                $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            
                $stmt->execute();
                $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
                // Respuesta JSON con los posts, total de páginas y total de registros
                echo json_encode([
                    'posts' => $posts,
                    'totalPages' => $totalPages,
                    'totalRecords' => $totalRecords,
                    'currentPage' => $page
                ]);
            }
            
            
              elseif (isset($_GET['id'])) {
                $userId = $_GET['id'];

                $sql = "SELECT * FROM posts WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$userId]);
                $post = $stmt->fetch(PDO::FETCH_ASSOC);

                // Verificar si el usuario existe
                if ($post) {
                    // Devolver los datos del usuario en formato JSON
                    echo json_encode($post);
                } else {
                    // Usuario no encontrado
                    echo json_encode(["error" => "Post no encontrado"]);
                }
            }elseif ($_GET['action'] === 'obtenerPost' && isset($_GET['id'])) {
                // Obtener el ID del post
                $postId = $_GET['id'];

                // Consulta para obtener un solo post
                $sql = "SELECT p.*, u.username FROM posts p JOIN users u ON p.user_id = u.id WHERE p.id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$postId]);
                $post = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($post) {
                    echo json_encode($post);
                } else {
                    echo json_encode(["error" => "Post no encontrado"]);
                }

            } elseif ($_GET['action'] === 'obtenerRespuestas' && isset($_GET['post_id'])) {
                // Obtener el ID del post desde los parámetros
                $post_id = intval($_GET['post_id']); // Asegurarse de que sea un número válido
                
                // Consulta para obtener las respuestas asociadas al post
                $sql = "SELECT r.id,r.user_id, r.content, r.fecha, u.username, u.avatar
                        FROM respuestas r 
                        JOIN users u ON r.user_id = u.id 
                        WHERE r.post_id = ? 
                        ORDER BY r.fecha ASC";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$post_id]);
                $respuestas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
                // Verificar si se encontraron respuestas
                if ($respuestas) {
                    echo json_encode([
                        "success" => true,
                        "respuestas" => $respuestas
                    ]);
                } else {
                    echo json_encode([
                        "success" => false,
                        "message" => "No hay respuestas para este post."
                    ]);
                }
                exit(); 
            }
        }            
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_GET['action']) && $_GET['action'] === 'actualizarPost') {
            $data = json_decode(file_get_contents('php://input'), true);

            if (isset($data['id'], $data['content'],$data['fecha'], $data['user_id'])) {
                $id = $data['id'];
                $content = $data['content'];
                $user_id = $data['user_id'];
                $fecha = $data['fecha'];

                $sql = "UPDATE posts SET content = ?, user_id = ?, fecha = ? WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $success = $stmt->execute([$content, $user_id, $fecha, $id]);

                if ($success) {
                    echo json_encode(["success" => true]);
                } else {
                    echo json_encode(["success" => false, "message" => "Error al actualizar el post"]);
                }
            } else {
                echo json_encode(["success" => false, "message" => "Datos incompletos"]);
            }
        } elseif (isset($_GET['action']) && $_GET['action'] === 'addReply') {
            // Agregar respuesta a un post
            $data = json_decode(file_get_contents('php://input'), true);
        
            if (isset($data['post_id'], $data['content'])) {
                $post_id = $data['post_id'];
                $content = $data['content'];
        
                // Asegúrate de que el usuario está logueado y obtener su ID de la sesión
                if (isset($_SESSION['id'])) {
                    $user_id = $_SESSION['id']; // Obtener el user_id de la sesión del usuario logueado
        
                    if (!empty($content)) {
                        // Insertar la respuesta en la tabla de respuestas
                        $sql = "INSERT INTO respuestas (post_id, user_id, content, fecha) VALUES (?, ?, ?, NOW())";
                        $stmt = $pdo->prepare($sql);
                        $success = $stmt->execute([$post_id, $user_id, $content]);
        
                        if ($success) {
                            echo json_encode(["success" => true, "message" => "Respuesta agregada con éxito"]);
                        } else {
                            echo json_encode(["success" => false, "message" => "Error al agregar la respuesta"]);
                        }
                    } else {
                        echo json_encode(["success" => false, "message" => "Error: se requiere texto para la respuesta"]);
                    }
                } else {
                    echo json_encode(["success" => false, "message" => "El usuario no está logueado"]);
                }
            } else {
                echo json_encode(["success" => false, "message" => "Datos incompletos para la respuesta"]);
            }
        }
        
        
    }
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
