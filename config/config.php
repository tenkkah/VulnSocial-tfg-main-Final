<?php
// Configuración de la base de datos
$host = 'localhost';  // Cambia si es necesario
$dbname = 'vulnerable_app';  // Nombre de la base de datos
$username = 'root';  // Usuario
$password = '';  // Contraseña

try {
    // Conexión usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
