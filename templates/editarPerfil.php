<?php
session_start();
// Verificar si el usuario está logueado
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

// Obtener datos actuales del usuario desde la sesión o desde la base de datos
$username = htmlspecialchars($_SESSION['username']);
$email = htmlspecialchars($_SESSION['email']);
$password = htmlspecialchars($_SESSION['password']); // Evitar mostrar la contraseña directamente por seguridad
$avatar = htmlspecialchars($_SESSION['avatar']); // Imagen por defecto si no tiene avatar

// Aquí iría la lógica para guardar los cambios en la base de datos (omitir en este código)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Perfil | VulnSocial</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="icon" href="../img/logo.svg" type="image/svg+xml">
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <!-- Menú de navegación -->
            <div class="col-2">
                <nav class="nav flex-column">
                    <a class="nav-link" href="../index.php"><img src="../img/logo.svg" alt="logo" class="mb-3" width="40" height="40"></a>
                    <a class="nav-link" href="../index.php">Home</a>
                </nav>
            </div>

            <!-- Contenido principal -->
            <div class="col-10 d-flex">
                <!-- Mitad izquierda con mensaje -->
                <div class="w-50 d-flex flex-column justify-content-center align-items-center bg-light p-4 border-end">
                    <h1 class="text-success">Edita tu Perfil</h1>
                    <p class="text-secondary">Actualiza tu información personal de manera segura.</p>
                </div>

                <!-- Mitad derecha con el formulario centrado -->
                <div class="w-50 d-flex justify-content-center align-items-center p-4">
                    <div>
                        <h1 class="text-center">Editar Perfil</h1>
                        <hr>
                        <form id="editProfileForm" method="POST" onsubmit="submitForm(event)" enctype="multipart/form-data">
                            <div class="mb-3" style="text-align: center;">
                                <img id="profile-preview" src="../avatar/<?php echo htmlspecialchars($avatar); ?>" alt="Imagen de perfil" class="profile-pic" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 2px solid #ccc; margin-bottom: 10px;" onclick="document.getElementById('file-input').click();">
                                <input type="file" id="file-input" style="display: none;" accept="image/*">
                            </div>

                            <div class="mb-3">
                                <label for="profile_picture">Imagen de perfil</label>
                                <input type="file" id="profile_picture" name="profile_picture" accept="image/*" onchange="previewImage(event);">
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Nombre de usuario</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Nueva contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>">
                                <button type="button" class="btn btn-outline-secondary mt-2" onclick="togglePassword()">Mostrar</button>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Guardar cambios</button>
                            <a href="../index.php" class="btn btn-secondary w-100 mt-2">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/editProfile.js"></script>
</body>
</html>

