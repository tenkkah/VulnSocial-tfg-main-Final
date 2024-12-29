-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-12-2024 a las 14:05:15
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

--
-- Volcado de datos para la tabla `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`) VALUES
(75, 7, 59),
(125, 38, 56),
(126, 38, 59),
(129, 39, 139);

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
(27, 7, 1, 'hola', '2024-12-07 15:52:26'),
(33, 1, 7, 'holis', '2024-12-13 20:40:17'),
(40, 38, 7, 'buenas sergio', '2024-12-23 16:57:06'),
(41, 7, 38, 'hola aitor!!', '2024-12-23 16:57:11'),
(42, 38, 7, 'que tal estas?', '2024-12-23 16:57:19'),
(43, 7, 39, 'buenas aitor', '2024-12-23 17:07:51'),
(44, 39, 7, 'que tal', '2024-12-23 17:07:54'),
(45, 39, 7, 'que vas  a hacer esta noche?', '2024-12-23 17:08:03');

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
(4, 'Hey, you! Yes, you! Stop asking questions and <a href=\"/?next=https://www.google.com\" target=\"_blank\">Google it yourself!</a>', 1, '2024-10-21 22:00:00', NULL, NULL, 0),
(47, 'good job!', 15, '2024-10-04 22:00:00', NULL, NULL, 0),
(56, '<a href=\"\" onmousedown=\"var name = \'&#39;;alert(1)//\'; alert(\'smthg\')\">Link</a>', 7, '2024-11-14 08:00:39', NULL, NULL, 2),
(59, 'Why?', 7, '2024-11-21 17:29:43', NULL, NULL, 3),
(139, ' esto es un xss <a href=\"\" onmousedown=\"var name = \'&#39;;alert(1)//\'; alert(\'smthg\')\">Link</a>', 38, '2024-12-23 16:56:04', '[\"#xss\"]', NULL, 1),
(140, ' esto es un nuevo post', 38, '2024-12-23 16:56:26', '[\"#hola\"]', 'uploaded_6769963a71d0d.jpg', 0),
(143, ' esto es una vulnerabilidad', 7, '2024-12-23 17:11:10', '[\"#xss\"]', NULL, 0),
(144, ' wow', 7, '2024-12-23 17:11:24', '[\"#BrokenAccessControl\"]', NULL, 0),
(145, ' esto es un hashtag', 7, '2024-12-23 17:11:41', '[\"#hola\"]', NULL, 0);

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
(16, 56, 7, 'Soy el admin', '2024-11-17 02:07:57'),
(44, 140, 39, 'wow que animalada', '2024-12-23 17:06:00'),
(45, 139, 7, 'que vulnerabilidad más increíble', '2024-12-29 13:04:48');

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
(7, 'aitorgg', 'aitor@gmail.com', 'aitor', 0, 'Activo ahora', 'rana.jpg'),
(15, 'manager', 'manager@gmail.com', 'manager1234', 2, 'Desconectado', 'Tigre.jpg'),
(38, 'sergio', 'sergio@gmail.com', '12345678', 0, 'Desconectado', 'rana.jpg'),
(39, 'ana12', 'ana@gmail.com', '12345678', 0, 'Desconectado', 'Tigre.jpg');

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
  ADD KEY `likes_ibfk_2` (`post_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

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
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

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
