<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home | VulnSocial</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" href="img/logo.svg" type="image/svg+xml">
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-2" id="nav-container">
                <nav class="nav flex-column">
                    <a class="nav-link" href="./index.php"><img src="img/logo.svg" alt="logo" class="mb-3" width="40" height="40"></a>
                    <a class="nav-link" href="index.php">Home</a>
                    <a class="nav-link" href="templates/instrucciones.php" id="instrucciones">Instrucciones del laboratorio</a>
                    <a class="nav-link" href="templates/api_interact.php">API Interactiva</a>
                    <?php if (isset($_SESSION['username'])): ?>
                    <a class="nav-link" href="templates/usuarios.php">Chat</a>
                        <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1): ?>
                            <a class="nav-link" href="templates/panelUsuarios.php">Panel de usuarios</a>
                            <a class="nav-link" href="templates/panelPosts.php">Panel de posts</a>
                            <a class="nav-link" href="templates/panelRespuestas.php">Panel de respuestas</a>
                        <?php elseif (isset($_SESSION['admin']) && $_SESSION['admin'] == 2): ?>
                            <a class="nav-link" href="templates/dashboard.php">Panel de Manager</a>
                        <?php endif; ?>
                        
                        <!-- Mostrar si el usuario está logueado -->
                        <div class="dropdown">
                            <span class="nav-link dropdown-toggle" id="userDropdown" onclick="toggleDropdown()">
                                <?php echo htmlspecialchars($_SESSION['username']); ?>
                            </span>
                            <div id="dropdownMenu" class="dropdown-menu" style="display: none;">
                                <a class="dropdown-item" href="templates/editarPerfil.php">Editar perfil</a>
                                <a class="dropdown-item" href="templates/misPosts.php">Mis Posts</a>
                                <a class="dropdown-item" href="src/controladores/logout.php">Cerrar sesión</a>
                            </div>
                        </div>

                        
                        
                    <?php else: ?>
                        <!-- Mostrar si el usuario no está logueado -->
                        <a class="nav-link" href="templates/login.html">Login</a>
                        <a class="nav-link" href="templates/register.html">Register</a>
                    <?php endif; ?>
                </nav>

            </div>
            <div class="col-9">
                <h1>Home</h1>
                <hr>

                <!-- Formulario de post (se muestra solo si está logueado) -->
                <?php if (isset($_SESSION['username'])): ?>
                    <form action="/post" method="POST" enctype="multipart/form-data" id="postForm">
                        <div class="input-group mb-3">
                            <textarea class="form-control rounded" id="post" name="post" placeholder="What's on your mind?" rows="3"></textarea>
                            <!-- Contenedor de sugerencias de hashtags -->
                            <div id="autocompleteContainer" class="autocomplete-container"></div>
                            <!-- Campo para seleccionar el archivo -->
                            <input type="file" name="media" accept="image/*,video/*" class="form-control mt-2"> <!-- Cambiado 'image' a 'media' -->
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary rounded">Post</button>
                            </div>
                        </div>
                    </form>



                    

                <?php else: ?>
                    <p>Please login to post something.</p>
                <?php endif; ?>
                <!-- Contenedor para los posts -->
                <div id="postsContainer">

                </div>
                <div id="paginationContainer" class="mt-3"></div>
            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
