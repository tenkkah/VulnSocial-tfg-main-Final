<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil del Usuario | VulnSocial</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="icon" href="../img/logo.svg" type="image/svg+xml">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <!-- Menú lateral -->
            <div class="col-2">
                <nav class="nav flex-column">
                    <a class="nav-link" href="../index.php"><img src="../img/logo.svg" alt="logo" class="mb-3" width="40" height="40"></a>
                    <a class="nav-link" href="../index.php">Home</a>
                    <?php if (isset($_SESSION['username'])): ?>
                        <p>Logueado como <?php echo htmlspecialchars($_SESSION['username']); ?></p>
                    <?php else: ?>
                        <a class="nav-link" href="../templates/login.html">Login</a>
                        <a class="nav-link" href="../templates/register.html">Register</a>
                    <?php endif; ?>
                </nav>
            </div>

            <!-- Contenido principal -->
            <div class="col-9">
                <div id="userInfo">
                    <!-- Aquí se mostrará la información del usuario -->
                </div>
                <div id="userPosts">
                    <!-- Aquí se mostrarán los posts del usuario -->
                </div>
            </div>
        </div>
    </div>

    <script src="../js/perfil.js"></script>
</body>
</html>
