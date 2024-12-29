<?php
session_start();
include "../../config/config.php"; 

try {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['action'])) {
            if ($_GET['action'] === 'listaUsuarios') {
                // Consulta a la base de datos para obtener todos los usuarios
                $sql = "SELECT * FROM users ORDER BY id ASC";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

                echo json_encode($usuarios);

            } elseif ($_GET['action'] === 'obtenerUsuario' && isset($_GET['id'])) {
                $userId = $_GET['id'];

                // Consulta para obtener un solo usuario
                $sql = "SELECT * FROM users WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$userId]);
                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

                // Verificar si el usuario existe
                if ($usuario) {
                    // Devolver los datos del usuario en formato JSON
                    echo json_encode($usuario);
                } else {
                    // Usuario no encontrado
                    echo json_encode(["error" => "Usuario no encontrado"]);
                }
            } elseif ($_GET['action'] === 'usuariosParaChat') {
                $outgoing_id = $_SESSION['id'];
                $search = isset($_GET['search']) ? $_GET['search'] : '';
                
                $sql = "SELECT u.*, 
                        (SELECT msg FROM messages 
                         WHERE (incoming_msg_id = u.id OR outgoing_msg_id = u.id) 
                         AND (incoming_msg_id = :outgoing_id OR outgoing_msg_id = :outgoing_id)
                         ORDER BY msg_id DESC 
                         LIMIT 1) as last_message
                        FROM users u
                        WHERE u.id != :outgoing_id";
                
                if (!empty($search)) {
                    $sql .= " AND u.username LIKE :search";
                }
                
                $sql .= " ORDER BY u.id DESC";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':outgoing_id', $outgoing_id, PDO::PARAM_INT);
                
                if (!empty($search)) {
                    $searchParam = "%" . $search . "%";
                    $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
                }
                
                $stmt->execute();
                $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
                echo json_encode($usuarios); // Devolver en formato JSON
            }
            
            
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_GET['action']) && $_GET['action'] === 'actualizarUsuario') {
            $data = json_decode(file_get_contents('php://input'), true);

            // Verificar que los datos estén completos
            if (isset($data['id'], $data['username'], $data['email'],$data['password'], $data['admin'])) {
                $id = $data['id'];
                $username = $data['username'];
                $email = $data['email'];
                $admin = $data['admin'];
                $password = $data['password'];

                // Consulta para actualizar el usuario
                $sql = "UPDATE users SET username = ?, email = ?, password = ?, admin = ? WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $success = $stmt->execute([$username, $email,$password, $admin, $id]);

                // Devolver el resultado en formato JSON
                if ($success) {
                    echo json_encode(["success" => true]);
                } else {
                    echo json_encode(["success" => false, "message" => "Error al actualizar el usuario"]);
                }
            } else {
                echo json_encode(["success" => false, "message" => "Datos incompletos"]);
            }
        } 
    }
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
