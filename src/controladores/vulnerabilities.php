<?php
include "../../config/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['query'])) {
    $query = $_GET['query'];

    // Busca hashtags que coincidan con el término de búsqueda
    $sql = "SELECT hashtag FROM vulnerabilities WHERE hashtag LIKE :query";
    $stmt = $pdo->prepare($sql);
    $search = '%' . $query . '%';
    $stmt->bindParam(':query', $search, PDO::PARAM_STR);
    $stmt->execute();

    $hashtags = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($hashtags);
}
?>
