<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

include "../config/config.php";

try {
    // Verificar si se recibe el parámetro `id` en la URL
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $userId = $_GET['id'];

        // Consulta para obtener los datos del usuario
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userId]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Verificar si el usuario existe
        if (!$usuario) {
            // Redirigir si no se encuentra al usuario
            header("Location: usuarios.php?error=UsuarioNoEncontrado");
            exit;
        }
    } else {
        // Redirigir si no se proporciona un ID válido
        header("Location: usuarios.php?error=IDInvalido");
        exit;
    }
} catch (PDOException $e) {
    // Manejar errores de base de datos
    die("Error en la base de datos: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilosChat.css">
    <link rel="icon" href="../img/logo.svg" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="wrapper-chat">
        <section class="chat-area">
            <header>
                <a href="usuarios.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <!-- Mostrar la imagen del usuario -->
                <div class="details">
                    <!-- Mostrar el nombre completo y el estado del usuario -->
                    <img src="../avatar/<?php echo htmlspecialchars($usuario['avatar']); ?>" class="profile-pic" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; border: 2px solid #ccc; margin-bottom: 10px;">
                    <span><?php echo htmlspecialchars($usuario['username']); ?></span>
                    <p><?php echo htmlspecialchars($usuario['status']);?></p>
                </div>
            </header>
            <div class="chat-box">
                <!-- Aquí irán los mensajes del chat -->
            </div>
            <form action="#" class="typing-area">
                <!-- Campo oculto con el ID del usuario actual -->
                <input type="text" class="incoming_id" name="incoming_id" value="<?php echo htmlspecialchars($userId); ?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Escribe un mensaje aquí ..." autocomplete="off">
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>
    
    <script src="../js/chat.js"></script>
</body>
</html>
