<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar URL - VirusTotal</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="icon" href="../img/logo.svg" type="image/svg+xml">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Estilos para el diseño atractivo del input y el botón */
        body {
            background-color: #f4f7fa; /* Fondo suave para el cuerpo */
            font-family: 'Arial', sans-serif;
        }

        .container {
            padding-top: 10vh;
            align-items: center;
            height: 100vh; /* Usamos el 100% de la altura de la pantalla */
            text-align: center;
        }



        h1 {
            color: #4a90e2;
            margin-bottom: 30px;
        }

        input[type="text"] {
            width: 80%;
            padding: 12px;
            font-size: 16px;
            border-radius: 8px;
            border: 2px solid #4a90e2;
            margin-bottom: 20px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #1c60b8; /* Color al enfocar */
        }

        button {
            padding: 12px 20px;
            font-size: 16px;
            color: white;
            background-color: #4a90e2;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #1c60b8; /* Cambio de color cuando el cursor pasa sobre el botón */
        }

        button:active {
            background-color: #145a8c; /* Color más oscuro al hacer clic */
        }

        #resultContainer {
            margin-top: 20px;
        }

        .inofensivo {
            background-color: #d4edda; /* Verde claro */
            color: #155724; /* Verde oscuro */
            border: 1px solid #c3e6cb;
        }

        .malicioso {
            background-color: #f8d7da; /* Rojo claro */
            color: #721c24; /* Rojo oscuro */
            border: 1px solid #f5c6cb;
        }

        .sospechoso {
            background-color: #fff3cd; /* Amarillo claro */
            color: #856404; /* Amarillo oscuro */
            border: 1px solid #ffeeba;
        }

        .no-detectado {
            background-color: #e2e3e5; /* Gris claro */
            color: #383d41; /* Gris oscuro */
            border: 1px solid #d6d8db;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <div class="row">
        <!-- Menú lateral -->
        <div class="col-md-3 col-lg-2">
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
        <div class="col-md-9 col-lg-10">
            <h1>Verificación de URL en VirusTotal</h1>
            <input type="text" id="urlInput" placeholder="Introduce la URL a verificar" />
            <button onclick="verifyUrl()">Verificar</button>
            <div class="row">
                <div id="resultContainer"></div>
            </div>
        </div>
    </div>
</div>

<script src="../js/api.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
