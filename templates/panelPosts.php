<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Panel de Usuarios | VulnSocial</title>
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
            <div class="col-2">
                <nav class="nav flex-column">
                    <a class="nav-link" href="../index.php"><img src="../img/logo.svg" alt="logo" class="mb-3" width="40" height="40"></a>
                    <a class="nav-link" href="../index.php">Home</a>
                    <?php if (isset($_SESSION['username'])): ?>
                        <!-- Mostrar si el usuario está logueado -->
                        <p>Logueado como <?php echo htmlspecialchars($_SESSION['username']); ?></p>
                    <?php else: ?>
                        <!-- Mostrar si el usuario no está logueado -->
                        <a class="nav-link" href="templates/login.html">Login</a>
                        <a class="nav-link" href="templates/register.html">Register</a>
                    <?php endif; ?>
                </nav>
            </div>

            <div class="col-9">
                <h1>Panel de Posts</h1>
                <hr>
                <table class="table table-striped" id="postsTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Post</th>
                            <th>user_id</th>
                            <th>Fecha</th>
                            <th>Eliminar</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody id="postsBody">
                        <!-- Aquí se llenarán los datos de usuarios mediante JavaScript -->
                    </tbody>
                </table>
            </div>
            <!-- Modal de edición de post -->
            <div class="modal fade" id="editPostModal" tabindex="-1" aria-labelledby="editPostModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editPostModalLabel">Editar Post</h5>
                        </div>
                        <div class="modal-body">
                            <form id="editPostForm">
                                <input type="hidden" id="editPostId" name="id">
                                <div class="mb-3">
                                    <label for="editPostContent" class="form-label">Contenido</label>
                                    <textarea class="form-control" id="editPostContent" name="content" rows="4"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="editUserId" class="form-label">ID de Usuario</label>
                                    <input type="text" class="form-control" id="editPostUserId" name="user_id">
                                </div>
                                <div class="mb-3">
                                    <label for="editFecha" class="form-label">Fecha</label>
                                    <input type="date" class="form-control" id="editFecha" name="fecha">
                                </div>
                                <button type="button" class="btn btn-primary" id="savePostChanges">Guardar</button>
                                <button type="button" class="btn btn-primary ms-1" data-dismiss="modal" id="cerrar">Cerrar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/posts.js"></script>
</body>
</html>
