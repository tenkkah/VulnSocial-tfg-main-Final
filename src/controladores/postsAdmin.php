<?php
session_start();
include "../../config/config.php"; // Incluye la conexión a la base de datos

try {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['action'])) {
            if ($_GET['action'] === 'listaPosts') {
                // Consulta a la base de datos para obtener todos los usuarios
                $sql = "SELECT * FROM posts ORDER BY id ASC";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Devolver los datos en formato JSON
                echo json_encode($usuarios);

            } 
        }
    }
} catch (PDOException $e) {
    // En caso de error, devolver un mensaje de error en JSON
    echo json_encode(["error" => $e->getMessage()]);
}
?>
