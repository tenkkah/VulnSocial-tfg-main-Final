<?php
session_start();
include "../../config/config.php";

if (!isset($_SESSION['id'])) {
    header("Location: login.php"); 
    exit();
}

if (isset($_SESSION['id'])) {

    // Obtenemos el ID del usuario emisor (outgoing) desde la sesión
    $outgoing_id = $_SESSION['id'];

    // Obtenemos los datos del POST
    $incoming_id = isset($_POST['incoming_id']) ? trim($_POST['incoming_id']) : null;
    $message = isset($_POST['message']) ? trim($_POST['message']) : null;

    if (!empty($message)) {
        try {
            // Preparamos la consulta para insertar el mensaje
            $sql = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, created_at) VALUES (:incoming_id, :outgoing_id, :message, NOW())";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':incoming_id' => $incoming_id,
                ':outgoing_id' => $outgoing_id,
                ':message' => $message
            ]);
        } catch (PDOException $e) {
            die("Error al insertar el mensaje: " . $e->getMessage());
        }
    }
} else {
    header("location: ../../templates/login.php");
    exit;
}
?>
