<?php
echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Fichero Malicioso</title>
    <style>
        body {
            background-color: #333;
            color: white;
            font-family: Arial, sans-serif;
            text-align: center;
            padding-top: 50px;
        }
        .warning {
            font-size: 50px;
            font-weight: bold;
            color: red;
        }
        .message {
            font-size: 30px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class='warning'>¡CUIDADO! Este archivo podría ser peligroso</div>
    <div class='message'>
        Esto es un fichero malicioso. <br>El contenido ha sido ejecutado en tu navegador.
    </div>
    <script>
        // Mostrar un mensaje emergente en el navegador
        alert('¡Alerta! Estás ejecutando un archivo malicioso. No confíes en esta fuente.');
        
        // Redirigir a una página peligrosa
        setTimeout(function() {
            window.location.href = 'https://www.example.com'; // Página de redirección
        }, 5000);
    </script>
</body>
</html>";
?>
