-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-01-2025 a las 10:42:29
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
(151, 2, 200),
(154, 2, 201),
(170, 2, 209),
(152, 3, 200),
(156, 3, 202),
(164, 3, 206),
(165, 4, 207),
(155, 5, 202),
(161, 5, 205),
(153, 6, 201),
(167, 6, 208),
(136, 7, 47),
(149, 7, 201),
(195, 7, 203),
(197, 7, 204),
(249, 7, 209),
(157, 8, 203),
(219, 8, 204),
(222, 8, 209),
(159, 9, 204),
(218, 9, 207),
(169, 9, 209),
(160, 10, 204),
(162, 11, 205),
(168, 11, 208),
(217, 11, 209),
(216, 11, 215),
(214, 11, 216),
(245, 54, 208);

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
(48, 3, 8, 'Buenas Jane', '2025-01-10 12:13:16'),
(49, 3, 8, 'Te quiero dar unos consejos y para la experiencia del usuario son palabras claras en las webs', '2025-01-10 12:13:39'),
(50, 3, 8, 'Tambien posicionar con SEO tu página principal', '2025-01-10 12:13:50'),
(51, 8, 3, 'Hola Liam!', '2025-01-10 12:14:30'),
(52, 8, 3, 'Pero como podria hacer que mi página sea más atractiva?', '2025-01-10 12:14:48'),
(53, 3, 8, 'Te recomiendo usar paletas de colores que sea una web minimalista, con tipografías legibles también', '2025-01-10 12:15:14'),
(54, 8, 3, 'Muchas gracias haré eso para poder mejorar mi web.', '2025-01-10 12:15:29'),
(55, 11, 3, 'Buenas', '2025-01-10 12:16:55'),
(56, 11, 3, 'Yo tengo experiencia con el desarrollo en React Native', '2025-01-10 12:17:03'),
(57, 3, 11, 'Hola que tal?', '2025-01-10 12:17:14'),
(58, 3, 11, 'Esque estoy haciendo un proyecto para el TFG de DAM en React Native', '2025-01-10 12:17:31'),
(59, 3, 11, 'Y no se como empezar a estudiarlo', '2025-01-10 12:17:38'),
(60, 11, 3, 'Te recomiendo primero que te leas la documentación que ofrece, una vez hayas entendido las bases empieza por cosas sencillas, y poco a poco vas implementando lo que vayas aprendiendo', '2025-01-10 12:18:13'),
(61, 11, 3, 'Muchas personas empiezan viendo vídeos que también se aprende pero te recomiendo que empieces leyendo', '2025-01-10 12:18:36'),
(62, 11, 3, 'Sobretodo documentación y practicando mucho', '2025-01-10 12:18:46'),
(63, 3, 11, 'Genial, pues eso haré, cualquier avance que haga en mi proyecto te iré comentando', '2025-01-10 12:19:03'),
(64, 8, 6, 'Hola Liam', '2025-01-10 12:20:46'),
(65, 8, 6, 'Donde es el evento?', '2025-01-10 12:20:49'),
(66, 8, 6, 'Ya que me gustaría ir si es este finde semana', '2025-01-10 12:21:00'),
(67, 6, 8, 'Buenas Charlie', '2025-01-10 12:21:06'),
(68, 6, 8, 'Los eventos de ciberseguridad y de IT se suelen hacer en La Nave en Villaverde, localizado en Madrid', '2025-01-10 12:21:28'),
(69, 8, 6, 'A que hora es y que día?', '2025-01-10 12:21:40'),
(70, 6, 8, 'Es desde el día 11 de Enero al 13 de Enero de 10 a 20', '2025-01-10 12:22:01'),
(71, 6, 8, 'Van a haber charlas sobre ciberseguridad, ponencias, talleres de ciberseguridad y luego habrá fiesta en un local', '2025-01-10 12:22:28'),
(72, 8, 6, 'Se necesitan entradas para acceder?', '2025-01-10 12:22:41'),
(73, 6, 8, 'Si', '2025-01-10 12:22:43'),
(74, 6, 8, 'Las entradas valen 30 euros', '2025-01-10 12:22:48'),
(75, 8, 6, 'Pues genial alli estaré!!', '2025-01-10 12:22:55'),
(78, 6, 8, 'Buenas', '2025-01-13 10:30:46'),
(79, 6, 8, 'Al final fue al evento?', '2025-01-13 10:30:53'),
(80, 8, 6, 'Si! Estuvo genial hubo charlas de ciberseguridad', '2025-01-13 10:31:05');

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
(47, 'good job!', 15, '2024-10-04 22:00:00', NULL, NULL, 1),
(200, 'Estoy aprendiendo SQL, ¿alguien más aquí lo hace?', 2, '2025-01-09 09:00:00', '[\"#SQLLearning\"]', NULL, 2),
(201, '¡Nuevo video tutorial sobre ciberseguridad! Échenle un vistazo.', 5, '2025-01-09 10:00:00', '[\"#Ciberseguridad\"]', 'ciberseguridad.mp4', 1),
(202, 'Acabo de ver un gran documental sobre inteligencia artificial, altamente recomendable.', 3, '2025-01-09 11:15:00', '[\"#IA\"]', 'video1.mp4', 2),
(203, 'Hoy comí una pizza increíble. ¿Cuál es su pizza favorita?', 6, '2025-01-09 12:45:00', '[\"#Comida\"]', 'pizza.jpg', 2),
(204, 'He lanzado una nueva app que me ayuda a gestionar mis tareas diarias, ¿alguien la ha probado?', 7, '2025-01-09 13:30:00', '[\"#TechApp\"]', '', 4),
(205, 'El clima está increíble hoy. ¿Alguien va a salir a caminar?', 4, '2025-01-09 14:00:00', '[\"#Clima\"]', NULL, 2),
(206, 'Estoy buscando recomendaciones de libros sobre programación, en mi caso recomiendo este de aquí. ¿Alguien tiene algo para recomendar?', 9, '2025-01-09 14:30:00', '[\"#Libros\"]', 'libros.jpg', 1),
(207, '¿Qué opinan de la última actualización de iOS?', 10, '2025-01-09 15:00:00', '[\"#iOS\"]', 'ios_update.jpg', 2),
(208, 'Este fin de semana se realiza un evento de tecnología en mi ciudad, ¡no me lo quiero perder!', 8, '2025-01-09 15:30:00', '[\"#EventoTech\"]', NULL, 3),
(209, '¿Alguien tiene experiencia con el desarrollo de apps móviles en React Native?', 11, '2025-01-09 16:00:00', '[\"#ReactNative\"]', '', 5),
(210, 'Nuevo post sobre ciberseguridad: Siempre actualiza tus sistemas.', 5, '2025-01-05 11:30:00', '[\"#ciberseguridad\"]', '', 2),
(211, '¿Has probado el nuevo framework para desarrollo web?', 8, '2025-01-06 13:15:00', '[\"#frameworks\"]', NULL, 0),
(212, '¡El futuro del desarrollo de software está aquí! Aprende con IA.', 9, '2025-01-07 15:45:00', '[\"#desarrolloweb\"]', '', 5),
(213, '¡El café es lo mejor para programar!', 2, '2025-01-08 08:00:00', '[\"#programacion\"]', NULL, 1),
(214, 'Un gran artículo sobre la importancia de la seguridad en redes.', 4, '2025-01-09 09:30:00', '[\"#redes\"]', '', 3),
(215, 'Cómo crear aplicaciones web seguras desde el inicio.', 6, '2025-01-10 12:00:00', '[\"#seguridad\"]', NULL, 2),
(216, 'Consejos para mejorar la experiencia de usuario en tu sitio web.', 3, '2025-01-11 10:30:00', '[\"#UX\"]', '', 2);

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
(1001, 200, 3, 'Yo también estoy aprendiendo SQL, es genial.', '2025-01-09 09:30:00'),
(1002, 201, 2, '¡Claro! Acabo de ver el video y fue excelente, lo recomiendo mucho.', '2025-01-09 10:30:00'),
(1003, 202, 6, '¡Totalmente! La IA está cambiando el mundo, ¿quién sabe qué vendrá después?', '2025-01-09 11:30:00'),
(1004, 203, 5, 'La pizza de pepperoni es mi favorita, pero también me encanta la de cuatro quesos.', '2025-01-09 12:00:00'),
(1005, 204, 7, 'No he probado la app, pero se ve interesante. ¿Cómo se llama?', '2025-01-09 13:45:00'),
(1006, 205, 9, 'El clima aquí también está increíble. Perfecto para una caminata.', '2025-01-09 14:15:00'),
(1007, 206, 4, 'Te recomiendo \"Clean Code\" de Robert C. Martin, es excelente.', '2025-01-09 14:45:00'),
(1008, 207, 8, 'La actualización de iOS tiene algunos cambios interesantes, pero también me ha dado problemas con algunas apps.', '2025-01-09 15:15:00'),
(1009, 208, 6, '¡Qué suerte! Yo también me quiero apuntar, ¿cómo puedo hacerlo?', '2025-01-09 15:45:00'),
(1010, 209, 3, 'He trabajado un poco con React Native, es muy potente. ¿Qué te gustaría saber?', '2025-01-09 16:30:00'),
(1011, 200, 7, '¡SQL es increíble! Me encanta trabajar con bases de datos.', '2025-01-09 09:45:00'),
(1012, 201, 6, 'Yo también soy fan de los tutoriales, siempre aprendo algo nuevo.', '2025-01-09 10:45:00'),
(1013, 202, 10, 'Sí, los avances en IA son impresionantes. ¿Has probado algún modelo de GPT?', '2025-01-09 11:45:00'),
(1014, 203, 8, 'La pizza de bacon es mi favorita. ¿Y la tuya?', '2025-01-09 12:30:00'),
(1015, 204, 9, 'La app se llama TaskMaster. ¡Pruébala, está buenísima!', '2025-01-09 13:50:00'),
(1016, 205, 11, 'Hoy es perfecto para salir a caminar, lo haré más tarde.', '2025-01-09 14:25:00'),
(1017, 206, 2, '¡Gracias por la recomendación! Lo agregaré a mi lista de lectura.', '2025-01-09 14:50:00'),
(1018, 207, 4, 'Todavía no he probado la nueva actualización, pero lo haré pronto.', '2025-01-09 15:20:00'),
(1019, 208, 3, '¡Ojalá hubiera algo similar por aquí! Estaré atento.', '2025-01-09 15:40:00'),
(1020, 209, 5, 'Estoy empezando con React Native. Si tienes algún consejo, ¡será bienvenido!', '2025-01-09 16:10:00'),
(1021, 200, 5, 'SQL es básico para todo desarrollador, sigue adelante.', '2025-01-09 09:00:00'),
(1022, 201, 4, '¡Ese tutorial está bien hecho! Aprendí mucho.', '2025-01-09 09:15:00'),
(1023, 202, 11, 'La IA está revolucionando la tecnología, es fascinante.', '2025-01-09 10:50:00'),
(1024, 203, 3, 'Pizza de champiñones es mi preferida.', '2025-01-09 11:40:00'),
(1025, 204, 5, '¿Tiene integración con calendarios? Eso sería útil.', '2025-01-09 13:00:00'),
(1026, 205, 6, '¿Dónde sueles caminar? Me gustan los parques grandes.', '2025-01-09 13:35:00'),
(1027, 206, 7, 'Otro gran libro es \"The Pragmatic Programmer\".', '2025-01-09 14:00:00'),
(1028, 207, 9, 'iOS siempre innova, aunque a veces me da problemas.', '2025-01-09 14:30:00'),
(1029, 208, 2, 'Espero que publiquen videos del evento.', '2025-01-09 15:15:00'),
(1030, 209, 8, 'Yo estoy comenzando con React Native, ¿algún consejo?', '2025-01-09 15:50:00'),
(1031, 210, 4, 'Actualizar los sistemas es clave para evitar problemas.', '2025-01-05 11:00:00'),
(1032, 211, 5, 'Sí, lo probé y tiene muchas herramientas útiles.', '2025-01-06 13:00:00'),
(1033, 212, 7, 'La IA está cambiando la forma en que desarrollamos.', '2025-01-07 15:00:00'),
(1034, 213, 3, '¡El café es mi combustible diario para programar!', '2025-01-08 08:00:00'),
(1035, 214, 6, 'Es importante concienciar sobre la seguridad en redes.', '2025-01-09 09:00:00'),
(1036, 215, 2, 'Crear apps seguras desde el inicio es lo ideal.', '2025-01-10 11:30:00'),
(1037, 216, 8, 'UX es fundamental para retener a los usuarios.', '2025-01-11 10:00:00'),
(1039, 208, 7, '¡El evento suena genial! Me encantaría asistir.', '2025-01-09 15:00:00'),
(1040, 209, 10, 'React Native es genial, pero la curva de aprendizaje puede ser un poco empinada.', '2025-01-09 15:45:00'),
(1117, 216, 54, 'Tiene que ser una web responsive para mejorar la experiencia del usuario', '2025-01-13 10:28:15');

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
(2, 'john_doe', 'john.doe@gmail.com', 'password123', 0, 'Desconectado', 'foto3.jpg'),
(3, 'jane_doe', 'jane.doe@gmail.com', 'password456', 0, 'Desconectado', 'foto1.jpg'),
(4, 'michael_smith', 'michael.smith@gmail.com', 'michaelpass', 0, 'Desconectado', 'foto4.jpg'),
(5, 'emma_watson', 'emma.watson@gmail.com', 'emma2024', 0, 'Desconectado', 'foto5.jpg'),
(6, 'charbrown', 'charbrown@gmail.com', 'charlie123', 0, 'Activo ahora', 'foto6.jpg'),
(7, 'aitorgg', 'aitor@gmail.com', 'aitor', 0, 'Desconectado', 'rana.jpg'),
(8, 'liam_gallagher', 'liam.gallagher@gmail.com', 'liam098', 0, 'Desconectado', 'foto7.jpg'),
(9, 'olivia_rodriguez', 'olivia.rodriguez@gmail.com', 'olivia654', 0, 'Desconectado', 'foto12.jpg'),
(10, 'noah_harris', 'noah.harris@gmail.com', 'noah321', 0, 'Desconectado', 'foto8.jpg'),
(11, 'sophia_loren', 'sophia.loren@gmail.com', 'sophia789', 0, 'Desconectado', 'foto2.jpg'),
(15, 'manager', 'manager@gmail.com', 'manager1234', 2, 'Desconectado', 'Tigre.jpg'),
(38, 'sergio', 'sergio@gmail.com', '12345678', 0, 'Desconectado', 'rana.jpg'),
(39, 'ana12', 'ana@gmail.com', '12345678', 0, 'Desconectado', 'Tigre.jpg'),
(54, 'sara2002', 'sara@gmail.com', '12345678', 1, 'Desconectado', 'avatar_6784ea7fabce70.75867249.jpg');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de la tabla `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1118;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

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
