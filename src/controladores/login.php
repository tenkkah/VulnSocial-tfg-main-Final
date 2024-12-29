<?php
session_start();
include_once "../../config/config.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta vulnerable a SQL Injection
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $stmt = $pdo->query($sql);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Si el usuario existe, crear la sesión
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['password'] = $user['password'];
        $_SESSION['id'] = $user['id'];
        $_SESSION['avatar'] = $user['avatar'];
        $_SESSION['admin'] = $user['admin']; // Guardar si el usuario es admin

        $status = "Activo ahora";

        // Actualizar el estado del usuario en la base de datos
        $updateSql = "UPDATE users SET status = :status WHERE id = :id";
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->execute([
            ':status' => $status,
            ':id' => $user['id']
        ]);

        $_SESSION['status'] = $status;

        echo json_encode([
            "success" => true,
            "idUsuario" => $user['id'],
            "isAdmin" => $user['admin'],
            "email" => $user['email'],
            "avatar" => $user['avatar'],
            "status" => $status
        ]);
    } else {
        // Si falla, devolver un error
        echo json_encode(["success" => false, "message" => "Email o contraseña incorrecta"]);
    }
}
?>
