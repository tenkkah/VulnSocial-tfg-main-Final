<?php
session_start();
// Conexión a la base de datos
include_once "../config/config.php";

// Consultas de datos para los gráficos
$query = $pdo->query("SELECT u.username, COUNT(p.id) AS total_posts FROM users u JOIN posts p ON u.id = p.user_id GROUP BY u.username");
$postsPorUsuario = $query->fetchAll(PDO::FETCH_ASSOC);

$query = $pdo->query("SELECT DATE(fecha) AS fecha, COUNT(id) AS publicaciones_por_dia FROM posts GROUP BY DATE(fecha)");
$publicacionesPorDia = $query->fetchAll(PDO::FETCH_ASSOC);

$query = $pdo->query("SELECT u.username, COUNT(p.id) AS cantidad_posts FROM users u JOIN posts p ON u.id = p.user_id GROUP BY u.username ORDER BY cantidad_posts DESC LIMIT 5");
$usuariosMasActivos = $query->fetchAll(PDO::FETCH_ASSOC);

$query = $pdo->query("SELECT AVG(cantidad_posts) AS promedio_posts FROM (SELECT COUNT(p.id) AS cantidad_posts FROM posts p GROUP BY p.user_id) AS subconsulta");
$promedioPostsPorUsuario = $query->fetch(PDO::FETCH_ASSOC)['promedio_posts'];

$query = $pdo->query("SELECT DATE_FORMAT(fecha, '%Y-%m') AS mes, COUNT(id) AS cantidad_posts FROM posts GROUP BY mes ORDER BY mes");
$postsPorMes = $query->fetchAll(PDO::FETCH_ASSOC);

$query = $pdo->query("SELECT u.username, COUNT(p.id) AS posts_recientes FROM users u JOIN posts p ON u.id = p.user_id WHERE p.fecha >= DATE_SUB(NOW(), INTERVAL 30 DAY) GROUP BY u.username ORDER BY posts_recientes DESC LIMIT 5");
$topUsuariosRecientes = $query->fetchAll(PDO::FETCH_ASSOC);

$query = $pdo->query("SELECT username, status FROM users WHERE status LIKE '%Activo%'");
$usuariosActivos = $query->fetchAll(PDO::FETCH_ASSOC);

$query = $pdo->query("SELECT u.username, COUNT(m.msg_id) AS total_messages_sent FROM users u JOIN messages m ON u.id = m.outgoing_msg_id GROUP BY u.username");
$mensajesEnviadosYRecibidos = $query->fetchAll(PDO::FETCH_ASSOC);

$query = $pdo->query("SELECT u.username, COUNT(m.msg_id) AS total_messages_received FROM users u JOIN messages m ON u.id = m.incoming_msg_id GROUP BY u.username");
$mensajesRecibidosPorUsuario = $query->fetchAll(PDO::FETCH_ASSOC);

$query = $pdo->query("SELECT p.id, COUNT(r.id) AS total_responses FROM posts p LEFT JOIN respuestas r ON p.id = r.post_id GROUP BY p.id");
$respuestasPorPost = $query->fetchAll(PDO::FETCH_ASSOC);

$query = $pdo->query("SELECT COUNT(id) AS posts_por_fecha  FROM posts WHERE fecha BETWEEN '2024-01-01' AND '2024-11-30'");
$postsRangoFechas = $query->fetchAll(PDO::FETCH_ASSOC);

$query = $pdo->query("SELECT AVG(responses) AS promedio_respuestas_por_post FROM (SELECT COUNT(r.id) AS responses FROM posts p LEFT JOIN respuestas r ON p.id = r.post_id GROUP BY p.id) AS subconsulta");
$promedioRespuestasPorPost = $query->fetchAll(PDO::FETCH_ASSOC);

$query = $pdo->query("SELECT u.username, COUNT(p.id) AS posts_recientes FROM users u JOIN posts p ON u.id = p.user_id WHERE p.fecha > CURDATE() - INTERVAL 7 DAY GROUP BY u.username");
$postsRecientes = $query->fetchAll(PDO::FETCH_ASSOC);

$query = $pdo->query("SELECT u.username, COUNT(l.id) AS total_likes FROM users u JOIN posts p ON u.id = p.user_id JOIN likes l ON p.id = l.post_id GROUP BY u.username");
$likesPorUsuario = $query->fetchAll(PDO::FETCH_ASSOC);


$query = $pdo->query("SELECT p.id, p.content, u.username, COUNT(l.id) AS total_likes FROM posts p JOIN likes l ON p.id = l.post_id JOIN users u ON p.user_id = u.id GROUP BY p.id ORDER BY total_likes DESC LIMIT 5");
$topPostsLikes = $query->fetchAll(PDO::FETCH_ASSOC);

$query = $pdo->query("SELECT u.username, COUNT(m.msg_id) AS total_messages_sent FROM users u JOIN messages m ON u.id = m.outgoing_msg_id GROUP BY u.username");
$mensajesEnviados = $query->fetchAll(PDO::FETCH_ASSOC);

$query = $pdo->query("SELECT u.username, COUNT(m.msg_id) AS total_messages_received FROM users u JOIN messages m ON u.id = m.incoming_msg_id GROUP BY u.username");
$mensajesRecibidos = $query->fetchAll(PDO::FETCH_ASSOC);

$query = $pdo->query("SELECT AVG(total_likes) AS promedio_likes FROM (SELECT COUNT(l.id) AS total_likes FROM posts p LEFT JOIN likes l ON p.id = l.post_id GROUP BY p.id) AS subconsulta");
$promedioLikesPorPost = $query->fetch(PDO::FETCH_ASSOC)['promedio_likes'];






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Manager | VulnSocial</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="icon" href="../img/logo.svg" type="image/svg+xml">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                        <p>Logueado como <?php echo htmlspecialchars($_SESSION['username']); ?></p>
                    <?php else: ?>
                        <a class="nav-link" href="../templates/login.html">Login</a>
                        <a class="nav-link" href="../templates/register.html">Register</a>
                    <?php endif; ?>
                </nav>
            </div>

            <!-- Contenido principal -->
            <div class="col-9">
                <h1 class="text-center my-4">Dashboard Manager</h1>
                <div class="row">
                    <div class="col-md-6 mb-4"><canvas id="postsPorUsuarioChart"></canvas></div>
                    <div class="col-md-6 mb-4"><canvas id="publicacionesPorDiaChart"></canvas></div>
                    <div class="col-md-6 mb-4"><canvas id="usuariosMasActivosChart"></canvas></div>
                    <div class="col-md-6 mb-4"><canvas id="promedioPostsPorUsuarioChart"></canvas></div>
                    <div class="col-md-6 mb-4"><canvas id="postsPorMesChart"></canvas></div>
                    <div class="col-md-6 mb-4"><canvas id="topUsuariosRecientesChart"></canvas></div>

                    <div class="col-md-6 mb-4"><canvas id="mensajesEnviadosYRecibidosChart"></canvas></div>

                    <div class="col-md-6 mb-4"><canvas id="mensajesRecibidosPorUsuarioChart"></canvas></div>

                    <div class="col-md-6 mb-4"><canvas id="respuestasPorPostChart"></canvas></div>



                    <div class="col-md-6 mb-4"><canvas id="promedioRespuestasPorPostChart"></canvas></div>

                    <div class="col-md-6 mb-4"><canvas id="postsRecientesChart"></canvas></div>

                    <div class="col-md-6 mb-4"><canvas id="likesPorUsuarioChart"></canvas></div>
                    <div class="col-md-6 mb-4"><canvas id="likesPorFechaChart"></canvas></div>
                    <div class="col-md-6 mb-4"><canvas id="topPostsLikesChart"></canvas></div>
                    <div class="col-md-6 mb-4"><canvas id="mensajesEnviadosChart"></canvas></div>
                    <div class="col-md-6 mb-4"><canvas id="mensajesRecibidosChart"></canvas></div>
                    <div class="col-md-6 mb-4"><canvas id="promedioLikesPorPostChart"></canvas></div>

                </div>
            </div>
        </div>
    </div>    

    <script>
        // Variables de datos de PHP a JavaScript
        const postsPorUsuario = <?php echo json_encode($postsPorUsuario); ?>;
        const publicacionesPorDia = <?php echo json_encode($publicacionesPorDia); ?>;
        const usuariosMasActivos = <?php echo json_encode($usuariosMasActivos); ?>;
        const promedioPostsPorUsuario = <?php echo json_encode($promedioPostsPorUsuario); ?>;
        const postsPorMes = <?php echo json_encode($postsPorMes); ?>;
        const topUsuariosRecientes = <?php echo json_encode($topUsuariosRecientes); ?>;
        const usuariosActivos = <?php echo json_encode($usuariosActivos); ?>;
        const mensajesEnviadosYRecibidos = <?php echo json_encode($mensajesEnviadosYRecibidos); ?>;
        const mensajesRecibidosPorUsuario = <?php echo json_encode($mensajesRecibidosPorUsuario); ?>;
        const respuestasPorPost = <?php echo json_encode($respuestasPorPost); ?>;

        const postsRangoFechas = <?php echo json_encode($postsRangoFechas); ?>;
        const promedioRespuestasPorPost = <?php echo json_encode($promedioRespuestasPorPost); ?>;
        const postsRecientes = <?php echo json_encode($postsRecientes); ?>;

        const likesPorUsuario = <?php echo json_encode($likesPorUsuario); ?>;
        const topPostsLikes = <?php echo json_encode($topPostsLikes); ?>;
        const mensajesEnviados = <?php echo json_encode($mensajesEnviados); ?>;
        const mensajesRecibidos = <?php echo json_encode($mensajesRecibidos); ?>;
        const promedioLikesPorPost = <?php echo json_encode($promedioLikesPorPost); ?>;
    </script>

    <script src="../js/dashboard.js"></script>
</body>
</html>
