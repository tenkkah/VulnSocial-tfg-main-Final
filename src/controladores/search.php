<?php
    session_start();
    include "../../config/config.php"; // Incluye la conexión a la base de datos

try {
    $outgoing_id = $_SESSION['id'];
    $searchTerm = $_POST['searchTerm'];

    // Consulta para buscar usuarios que coincidan con el término de búsqueda
    $sql = "SELECT * FROM users WHERE id != :outgoing_id AND username LIKE :searchTerm";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':outgoing_id', $outgoing_id, PDO::PARAM_INT);
    $searchTermWildcard = '%' . $searchTerm . '%';
    $stmt->bindParam(':searchTerm', $searchTermWildcard, PDO::PARAM_STR);
    $stmt->execute();
    
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    header('Content-Type: application/json'); // Especificar el tipo de contenido
    echo json_encode($usuarios); // Devolver como JSON
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>




