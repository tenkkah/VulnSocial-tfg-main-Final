<?php
session_start();
include_once "../../config/config.php"; // Incluye la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validaciones básicas del lado del servidor
    if (empty($username) || empty($email) || empty($password)) {
        echo json_encode(["success" => false, "message" => "Todos los campos son obligatorios."]);
        exit;
    }

    // Verificar si el usuario o correo ya existen
    $sql = "SELECT * FROM users WHERE username = :username OR email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['username' => $username, 'email' => $email]);
    $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingUser) {
        if ($existingUser['username'] === $username) {
            echo json_encode(["success" => false, "message" => "El nombre de usuario ya está en uso."]);
        } elseif ($existingUser['email'] === $email) {
            echo json_encode(["success" => false, "message" => "El correo ya está registrado."]);
        }
        exit;
    }

    // Procesar la subida de avatar
    $avatarName = null; // Por defecto, no hay avatar
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $avatarTmpPath = $_FILES['avatar']['tmp_name'];
        $originalAvatarName = $_FILES['avatar']['name'];
        $avatarExt = pathinfo($originalAvatarName, PATHINFO_EXTENSION);

        // Validar el tipo de archivo
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array(strtolower($avatarExt), $allowedExtensions)) {
            echo json_encode(["success" => false, "message" => "El formato de imagen no es válido."]);
            exit;
        }

        // Asignar un nombre único al archivo y moverlo
        $avatarName = uniqid("avatar_", true) . "." . $avatarExt;
        $avatarUploadPath = "../../avatar/" . $avatarName;

        // Mover el archivo a la carpeta avatar
        if (move_uploaded_file($avatarTmpPath, $avatarUploadPath)) {
            // Guardar solo el nombre del archivo en la base de datos
        } else {
            echo json_encode(["success" => false, "message" => "Error al subir el avatar."]);
            exit;
        }
    }

    // Inserción del nuevo usuario
    $sql = "INSERT INTO users (username, email, password, admin, avatar) VALUES (:username, :email, :password, 0, :avatar)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'username' => $username,
        'email' => $email,
        'password' => $password,
        'avatar' => $avatarName // Guardar solo el nombre del archivo
    ]);

    if ($stmt) {
        echo json_encode(["success" => true, "message" => "Registro exitoso!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al registrar al usuario."]);
    }
}
?>
