<?php
session_start();
include_once "../../config/config.php"; 

if (isset($_SESSION['id'])) {
    try {
        $status = "Desconectado";

        // Actualizar el estado en la base de datos
        $updateSql = "UPDATE users SET status = :status WHERE id = :id";
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->execute([
            ':status' => $status,
            ':id' => $_SESSION['id']
        ]);
    } catch (PDOException $e) {
        // Manejo de errores en caso de fallo
        error_log("Error actualizando el estado del usuario: " . $e->getMessage());
    }
}

// Destruir todas las variables de sesión y la sesión
session_unset();
session_destroy();

// Limpiar el localStorage y redirigir al login
echo "<script>
    localStorage.clear();
    window.location.href = '../../templates/login.html';
</script>";

exit();
?>
