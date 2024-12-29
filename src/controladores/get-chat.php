<?php
session_start();
include "../../config/config.php"; // Conexión a la base de datos

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_GET['action']) && $_GET['action'] === 'obtenerMensajes') {
            if (isset($_SESSION['id'], $_POST['incoming_id'])) {
                $outgoing_id = $_SESSION['id'];
                $incoming_id = $_POST['incoming_id'];

                // Consulta para obtener los mensajes entre dos usuarios
                $sql = "SELECT messages.*, DATE_FORMAT(messages.created_at, '%H:%i') AS formatted_time
                        FROM messages 
                        LEFT JOIN users ON users.id = messages.outgoing_msg_id
                        WHERE (outgoing_msg_id = :outgoing_id AND incoming_msg_id = :incoming_id)
                           OR (outgoing_msg_id = :incoming_id AND incoming_msg_id = :outgoing_id)
                        ORDER BY msg_id";
                $stmt = $pdo->prepare($sql);

                // Vincular parámetros
                $stmt->bindParam(':outgoing_id', $outgoing_id, PDO::PARAM_INT);
                $stmt->bindParam(':incoming_id', $incoming_id, PDO::PARAM_INT);
                $stmt->execute();

                // Procesar los mensajes
                $mensajes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $output = "";

                if (!empty($mensajes)) {
                    foreach ($mensajes as $mensaje) {
                        if ($mensaje['outgoing_msg_id'] === $outgoing_id) {
                            $output .= '<div class="chat outgoing">
                                            <div class="details">
                                                <p>' . htmlspecialchars($mensaje['msg']) . '</p>
                                                <span class="time">' . htmlspecialchars($mensaje['formatted_time']) . '</span>
                                            </div>
                                        </div>';
                        } else {
                            $output .= '<div class="chat incoming">
                                            <div class="details">
                                                <p>' . htmlspecialchars($mensaje['msg']) . '</p>
                                                <span class="time">' . htmlspecialchars($mensaje['formatted_time']) . '</span>
                                            </div>
                                        </div>';
                        }
                    }
                } else {
                    $output .= '<div class="text">No hay mensajes disponibles. Una vez que envíe el mensaje, aparecerán aquí.</div>';
                }

                // Devolver los mensajes procesados
                echo $output;
            } else {
                echo json_encode(["error" => "Datos faltantes o sesión no válida"]);
            }
        }
    }
} catch (PDOException $e) {
    // Manejar errores de conexión o consulta
    echo json_encode(["error" => $e->getMessage()]);
}
?>
