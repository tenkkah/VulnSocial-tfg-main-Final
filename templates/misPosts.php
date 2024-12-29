<?php
session_start();
// Conexión a la base de datos
include_once "../config/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Manager | VulnSocial</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="icon" href="../img/logo.svg" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
                        <img src="../avatar/<?php echo htmlspecialchars($_SESSION['avatar']); ?>" alt="Avatar de <?php echo htmlspecialchars($_SESSION['username']); ?>" class="profile-pic" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover; border: 2px solid #ccc; margin-right: 10px;">
                        <p>Logueado como <?php echo htmlspecialchars($_SESSION['username']); ?></p>
                    <?php else: ?>
                        <a class="nav-link" href="../templates/login.html">Login</a>
                        <a class="nav-link" href="../templates/register.html">Register</a>
                    <?php endif; ?>
                </nav>
            </div>

            <!-- Contenido principal -->
            <div class="col-10">

                <!-- Tabs para alternar entre posts creados y likes -->
                <ul class="nav nav-tabs" id="postsTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="mis-posts-tab" data-bs-toggle="tab" data-bs-target="#mis-posts" type="button" role="tab" aria-controls="mis-posts" aria-selected="true">
                            Mis Posts
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="likes-posts-tab" data-bs-toggle="tab" data-bs-target="#likes-posts" type="button" role="tab" aria-controls="likes-posts" aria-selected="false">
                            Mis Likes
                        </button>
                    </li>
                </ul>

                <!-- Contenedores dinámicos para las pestañas -->
                <div class="tab-content mt-4">
                    <!-- Contenedor de posts creados -->
                    <div class="tab-pane fade show active" id="mis-posts" role="tabpanel" aria-labelledby="mis-posts-tab">
                        <div id="misPostsContainer">
                            <p class="text-muted">Cargando tus posts...</p>
                        </div>
                    </div>

                    <!-- Contenedor de posts con likes -->
                    <div class="tab-pane fade" id="likes-posts" role="tabpanel" aria-labelledby="likes-posts-tab">
                        <div id="likesPostsContainer">
                            <p class="text-muted">Cargando los posts que te gustan...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/misPosts.js"></script>
</body>
</html>
