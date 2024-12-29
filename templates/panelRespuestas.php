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
                <h1>Panel de Respuestas</h1>
                <hr>
                <table class="table table-striped" id="respuestasTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ID_POST</th>
                            <th>ID_USER</th>
                            <th>Respuesta</th>
                            <th>Fecha</th>
                            <th>Eliminar</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody id="respuestasTbody">
                        <!-- Aquí se llenarán los datos de usuarios mediante JavaScript -->
                    </tbody>
                </table>
            </div>
            <!-- Modal de edición de post -->
            <div class="modal fade" id="editRespuestaModal" tabindex="-1" aria-labelledby="editRespuestaModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editRespuestaModalLabel">Editar Respuesta</h5>
                        </div>
                        <div class="modal-body">
                            <form id="editUserForm">
                                <input type="hidden" id="editId" name="id">
                                <div class="mb-3">
                                    <label for="editIdPost" class="form-label">ID de post</label>
                                    <input type="text" class="form-control" id="editIdPost" name="post_id" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="editIdUsuario" class="form-label">ID de usuario</label>
                                    <input type="text" class="form-control" id="editIdUsuario" name="user_id" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="editRespuesta" class="form-label">Respuesta</label>
                                    <textarea class="form-control" id="editRespuesta" name="content"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="editFecha" class="form-label">Fecha</label>
                                    <input type="date" class="form-control" id="editFecha" name="fecha">
                                </div>
                                <button type="button" class="btn btn-primary" id="saveChanges">Guardar</button>
                                <button type="button" class="btn btn-primary ms-1" data-dismiss="modal" id="cerrar">Cerrar</button>
                            </form>
                        </div>
                    </div>
                </div>
</div>

        </div>
    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/respuestas.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
