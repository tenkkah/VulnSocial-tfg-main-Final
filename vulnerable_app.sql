-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-12-2024 a las 21:38:29
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `vulnerable_app`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`, `created_at`) VALUES
(1, 1, 7, 'Ahora si', '2024-12-07 15:52:26'),
(2, 1, 7, 'Buenas admin', '2024-12-07 15:52:26'),
(3, 7, 15, 'Buenas!', '2024-12-07 15:52:26'),
(4, 15, 7, 'Buenas tio', '2024-12-07 15:52:26'),
(5, 15, 7, 'que tal', '2024-12-07 15:52:26'),
(6, 15, 7, 'holi', '2024-12-07 15:52:26'),
(9, 1, 15, 'Buenas admin soy el manager', '2024-12-07 15:52:26'),
(10, 1, 15, 'asdf', '2024-12-07 15:52:26'),
(18, 15, 7, 'Soy Aitor GG', '2024-12-07 15:52:26'),
(19, 7, 15, 'Buenas Aitor encantado de conocerte', '2024-12-07 15:52:26'),
(22, 18, 7, 'Buenas', '2024-12-07 15:52:26'),
(27, 7, 1, 'hola', '2024-12-07 15:52:26'),
(29, 18, 8, 'Buenas', '2024-12-07 15:54:42'),
(30, 8, 18, 'buenas test', '2024-12-07 15:55:21'),
(31, 18, 7, 'Holaa', '2024-12-09 17:44:24'),
(32, 7, 18, 'Que tal estas?', '2024-12-09 17:45:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `content` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `hashtags` text DEFAULT NULL,
  `media_path` varchar(255) DEFAULT NULL,
  `likes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`id`, `content`, `user_id`, `fecha`, `hashtags`, `media_path`, `likes`) VALUES
(1, 'Hola', 2, '2024-10-31 23:00:00', NULL, NULL, 0),
(2, 'Happy coding! But don\'t forget to take a break in between :)', 4, '2024-10-19 22:00:00', NULL, NULL, 0),
(3, 'The best way to learn is to teach.', 2, '2024-10-20 22:00:00', NULL, NULL, 0),
(4, 'Hey, you! Yes, you! Stop asking questions and <a href=\"/?next=https://www.google.com\" target=\"_blank\">Google it yourself!</a>', 1, '2024-10-21 22:00:00', NULL, NULL, 0),
(5, 'Practice makes perfect. So practice, practice, practice!', 4, '2024-10-21 23:14:53', NULL, NULL, 0),
(6, 'A hacker is someone who loves to solve problems.', 5, '2024-10-21 23:14:53', NULL, NULL, 0),
(47, 'good job!', 15, '2024-10-04 22:00:00', NULL, NULL, 0),
(56, '<a href=\"\" onmousedown=\"var name = \'&#39;;alert(1)//\'; alert(\'smthg\')\">Link</a>', 7, '2024-11-14 08:00:39', NULL, NULL, 0),
(59, 'Why?', 7, '2024-11-21 17:29:43', NULL, NULL, 0),
(85, 'este es un post con un  ', 7, '2024-12-03 21:47:05', '[\"#xss\"]', NULL, 0),
(86, 'vamos a probar a hacer otra vulnerabilidad en el login  ', 7, '2024-12-03 21:47:42', '[\"#sqlinjection\"]', NULL, 0),
(87, 'buenas tardes', 7, '2024-12-03 22:04:59', '[]', NULL, 0),
(98, '<a href=\"\" onmousedown=\"var name = \'&;;alert(1)//\'; alert(\'Hacking you\')\">Link</a>', 7, '2024-12-06 20:12:58', '[\"#39\"]', NULL, 0),
(101, '', 7, '2024-12-07 16:06:59', '[]', 'uploaded_675472a33d257.mp4', 0),
(102, '', 7, '2024-12-07 16:07:04', '[]', 'uploaded_675472a8bfe25.png', 0),
(103, '', 7, '2024-12-07 16:09:40', '[]', 'uploaded_6754734423318.jpg', 0),
(106, '<a href=\"\" onmousedown=\"var name = \'&;;alert(1)//\'; alert(\'smthg\')\">Link</a>', 7, '2024-12-07 16:15:36', '[\"#39\"]', NULL, 0),
(109, '', 7, '2024-12-07 22:47:51', '[]', 'uploaded_6754d097015dc.mp4', 0),
(110, '', 7, '2024-12-08 00:45:30', '[]', 'uploaded_6754ec2a336b9.php', 0),
(112, 'Hoy hacía mucho frío', 18, '2024-12-09 17:45:24', '[]', NULL, 0),
(113, 'Buenas mirad mi foto de perfil!', 23, '2024-12-10 16:25:32', '[]', NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`id`, `post_id`, `user_id`, `content`, `fecha`) VALUES
(1, 56, 7, 'hola', '2024-11-13 23:00:00'),
(2, 1, 2, 'Buenas Argus esto es una respuesta', '2024-11-13 23:00:00'),
(9, 1, 2, 'respuesta 3 a argus', '2024-11-15 23:24:38'),
(10, 56, 7, 'Buenas ', '2024-11-16 12:18:31'),
(16, 56, 7, 'Soy el admin', '2024-11-17 02:07:57'),
(17, 1, 2, 'Soy el ADMIN argus', '2024-11-18 17:36:00'),
(22, 87, 7, 'hola', '2024-12-05 10:52:32'),
(29, 98, 8, 'buenas aitor', '2024-12-07 15:06:49'),
(30, 87, 8, 'buenas tardes', '2024-12-07 15:21:08'),
(31, 109, 7, 'que buen video!', '2024-12-07 22:48:03'),
(32, 110, 8, 'Buenas Aitor', '2024-12-08 11:29:29'),
(33, 110, 8, 'Hola', '2024-12-08 12:47:47'),
(34, 106, 8, 'enlaces?', '2024-12-08 22:25:56'),
(35, 112, 7, 'Sobretodo por la mañana', '2024-12-09 18:05:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `admin`, `status`, `avatar`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', 1, 'Desconectado', 'descarga (2).jpg'),
(2, 'argus', 'argus@gmail.com', 'argus', 0, 'Desconectado', 'Tigre.jpg'),
(3, 'zeus', 'zeus@gmail.com', 'zeus', 0, 'Desconectado', 'Tigre.jpg'),
(4, 'pluto', 'pluto@gmail.com', 'pluto', 0, 'Desconectado', 'Tigre.jpg'),
(5, 'ares', 'ares@gmail.com', 'ares', 0, 'Desconectado', 'Tigre.jpg'),
(7, 'aitorgg', 'aitor@gmail.com', 'aitor', 0, 'Desconectado', '3216015.jpg'),
(8, 'test', 'test@gmail.com', 'test', 0, 'Activo ahora', 'Tigre.jpg'),
(15, 'manager', 'manager@gmail.com', 'manager1234', 2, 'Desconectado', 'Tigre.jpg'),
(18, 'Fernando', 'fernando@gmail.com', 'fernando1234', 0, 'Desconectado', 'Tigre.jpg'),
(19, 'Login', 'loginhack10@gmail.com', 'Login1234', 0, 'Desconectado', 'Tigre.jpg'),
(23, 'Gustavo', 'gustavo@gmail.com', 'gustavo12345', 0, 'Desconectado', 'images.jpg'),
(26, 'descarga', 'descarga@gmail.com', 'descarga123', 0, 'Activo ahora', 'avatar_6758a659ee79d2.87410267.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vulnerabilities`
--

CREATE TABLE `vulnerabilities` (
  `id` int(11) NOT NULL,
  `hashtag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vulnerabilities`
--

INSERT INTO `vulnerabilities` (`id`, `hashtag`) VALUES
(10, '#BrokenAccessControl'),
(5, '#BrokenAuthentication'),
(8, '#ComponentsWithKnownVulnerabilities'),
(3, '#CSRF'),
(4, '#InsecureDeserialization'),
(9, '#InsufficientLoggingAndMonitoring'),
(7, '#SecurityMisconfiguration'),
(6, '#SensitiveDataExposure'),
(2, '#sqlinjection'),
(1, '#xss');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`post_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indices de la tabla `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `fk_outgoing_user` (`outgoing_msg_id`),
  ADD KEY `fk_incoming_user` (`incoming_msg_id`);

--
-- Indices de la tabla `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vulnerabilities`
--
ALTER TABLE `vulnerabilities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hashtag` (`hashtag`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `vulnerabilities`
--
ALTER TABLE `vulnerabilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Filtros para la tabla `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_incoming_user` FOREIGN KEY (`incoming_msg_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_outgoing_user` FOREIGN KEY (`outgoing_msg_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `respuestas_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `respuestas_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
