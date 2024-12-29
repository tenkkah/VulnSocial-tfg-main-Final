<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VulnSocial</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilosChat.css">
    <link rel="icon" href="../img/logo.svg" type="image/svg+xml">
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container mt-4">
        <div class="row h-100">
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

            <div class="col-10 h-100 d-flex justify-content-center align-items-center">
            <div class="wrapper">
                <section class="users">
                    <div class="content">
                        <div class="details">
                        <img src="../avatar/<?php echo htmlspecialchars($_SESSION['avatar']); ?>" class="profile-pic" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; border: 2px solid #ccc; margin-bottom: 10px;">
                            <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                            <p>  <?php echo htmlspecialchars($_SESSION['status']); ?></p>
                        </div>
                    </div>
                    <div class="search">
                        <span class="text">Seleccione un usuario para iniciar el chat</span>
                        <input type="text" placeholder="Ingrese el nombre para buscar ...">
                        <button><i class="fas fa-search"></i></button>
                    </div>
                    <div class="users-list">

                    </div>
                </section>
            </div>
            </div>
        </div>
    </div>
    
    <script src="../js/usuariosSearch.js"></script>
</body>
</html>