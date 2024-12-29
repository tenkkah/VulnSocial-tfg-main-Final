<?php
session_start();
include_once "../../config/config.php";

if (!isset($_SESSION['id'])) {
    echo "error=not_logged_in";
    exit;
}

$userId = $_SESSION['id'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Verificar si se ha subido una nueva imagen de perfil
if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
    $avatar = $_FILES['profile_picture'];
    $uploadDir = "../../avatar/"; // Directorio donde se guardarán las imágenes
    $uploadFileName = basename($avatar['name']); // Solo el nombre del archivo
    $uploadFile = $uploadDir . $uploadFileName; // Ruta completa para mover el archivo
    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

    // Verificar el tipo de imagen
    $allowedTypes = ["jpg", "jpeg", "png", "gif"];
    if (in_array($imageFileType, $allowedTypes)) {
        // Mover la imagen al directorio de carga
        if (move_uploaded_file($avatar['tmp_name'], $uploadFile)) {
            // Si la imagen se sube correctamente, actualizamos el avatar en la base de datos
            $sql = "UPDATE users SET username = '$username', email = '$email', avatar = '$uploadFileName' WHERE id = $userId";
        } else {
            echo "error=upload_failed";
            exit;
        }
    } else {
        echo "error=invalid_file_type";
        exit;
    }
} else {
    // Si no se sube una nueva imagen, solo actualizamos los datos del perfil
    if (!empty($password)) {
        $sql = "UPDATE users SET username = '$username', email = '$email', password = '$password' WHERE id = $userId";
    } else {
        $sql = "UPDATE users SET username = '$username', email = '$email' WHERE id = $userId";
    }
}

$pdo->query($sql);

// Actualizar la sesión con los nuevos datos
$_SESSION['username'] = $username;
$_SESSION['email'] = $email;
$_SESSION['password'] = $password;

// Si se subió una imagen, actualizamos también el avatar en la sesión
if (isset($uploadFileName)) {
    $_SESSION['avatar'] = $uploadFileName;
}

// Respuesta de éxito
echo "success=1";
exit;
?>
