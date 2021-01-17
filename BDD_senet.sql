-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: PMYSQL130.dns-servicio.com:3306
-- Tiempo de generación: 30-05-2020 a las 19:28:21
-- Versión del servidor: 5.7.30
-- Versión de PHP: 7.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `7552822_senet2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(10) UNSIGNED NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_passwd` varchar(255) NOT NULL,
  `account_reg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `account_enabled` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `account_token` varchar(150) NOT NULL,
  `account_lat` double NOT NULL,
  `account_lon` double NOT NULL,
  `account_ciudad` varchar(150) NOT NULL,
  `account_email` varchar(150) NOT NULL,
  `account_provincia` varchar(150) NOT NULL,
  `account_cp` int(25) NOT NULL,
  `account_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `accounts`
--

INSERT INTO `accounts` (`account_id`, `account_name`, `account_passwd`, `account_reg_time`, `account_enabled`, `account_token`, `account_lat`, `account_lon`, `account_ciudad`, `account_email`, `account_provincia`, `account_cp`, `account_address`) VALUES
(8, 'usuario1', '$2y$10$MaFhWrn67xc5RoxZRsV5i.5772bFSwBMubcmqUukFRk81ad./1ho.', '2020-05-24 10:53:47', 1, 'e2d3d858d35ba45a00b1ee9498fd8b21', 41.6525424, -0.9071346, 'Zaragoza', 'matoo_4@hotmail.com', 'Zaragoza', 50017, 'Calle de Barcelona, 7, Zaragoza, España'),
(9, 'carolina', '$2y$10$ZqJp3jaFYzO/nq3qDaz3de/QaHqPYHbJhT07S8paBhEbaGcBxaRJ2', '2020-05-24 11:18:15', 1, '23f86907b2660c8582e12ef53683c42d', 40.3248677, -3.8580115, 'Móstoles', 'carolaina10@hotmail.com', 'Madrid', 28937, 'Calle Barcelona'),
(11, 'usuario2', '$2y$10$RVME5qYUo0irvTCPyvtuFez5VV7hmrac1Q6DFKjBED2.FfJFlsp6W', '2020-05-24 15:34:03', 1, 'defe67954d524d99d3b053db7ec9d32f', 40.4226962, -3.6778641, 'Madrid', 'mchopplet@gmail.com', 'Madrid', 28009, 'Calle Duque de Sesto'),
(15, 'usuario3', '$2y$10$BRlBSON5dGt0NoqTKiUC2.Rrht0jAEHqTGYWwjIrgFIKflGjb8NHa', '2020-05-30 17:01:14', 1, 'c1420074fd50616b12487972c95c1b02', 40.4018742, -3.6715933, 'Madrid', 'carolina.miguelezfer@gmail.com', 'Madrid', 28007, 'Calle de Catalina Suárez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `account_sessions`
--

CREATE TABLE `account_sessions` (
  `session_id` varchar(255) NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `account_sessions`
--

INSERT INTO `account_sessions` (`session_id`, `account_id`, `login_time`) VALUES
('096b88248f325cdff8bc71226fbb7f2d', 13, '2020-05-30 15:57:14'),
('3160e80c4e3c49168cb1055f24ee2018', 12, '2020-05-30 15:31:27'),
('350732635d5745947b6a123e8fe94040', 8, '2020-05-24 17:44:23'),
('4adda6d25b1c29dba1a289819bbbcebb', 8, '2020-05-24 10:55:20'),
('4beef0e15e4b2c4da89ebb0276156ede', 11, '2020-05-24 15:34:18'),
('5c56f5a1e4d12a867b05109662825649', 9, '2020-05-24 11:18:36'),
('5e5d0e0a5cbc0d4638147e12ea3bbce6', 9, '2020-05-24 11:18:36'),
('6ef5d64716cbd2b2a03a806300a0bb24', 8, '2020-05-28 17:53:48'),
('7603549b24dec7bf585af3a6fc84cb28', 14, '2020-05-30 16:23:32'),
('7md5nirgeomnil3m0un2fo1rp7', 1, '2020-05-15 18:02:50'),
('92a0f28467cf1323899d97ad4801b0cd', 9, '2020-05-25 16:50:24'),
('9384bb4322e7b8b4d6e79f5cf1ef6260', 8, '2020-05-24 10:55:32'),
('ae542fd0caf248df2ae8ab94d927ff25', 15, '2020-05-30 17:01:59'),
('bc6d520f65de8bd1cc995f7bb34a958a', 7, '2020-05-23 17:43:35'),
('bddc211c3fa7b35ffab2088af8e08240', 9, '2020-05-24 11:18:50'),
('e274b12295a40fab772be6b31d6005b7', 7, '2020-05-23 17:43:36'),
('fc58739dc082a1f719348f57d8d63309', 7, '2020-05-23 17:43:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegoprecio`
--

CREATE TABLE `juegoprecio` (
  `idJuego` int(10) NOT NULL,
  `idPrecioJuego` int(10) NOT NULL,
  `idUsuario` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `juegoprecio`
--

INSERT INTO `juegoprecio` (`idJuego`, `idPrecioJuego`, `idUsuario`) VALUES
(1, 1, 1),
(1, 2, 2),
(2, 3, 1),
(3, 4, 1),
(4, 5, 2),
(2, 6, 10),
(5, 7, 10),
(3, 8, 8),
(4, 9, 9),
(1, 10, 9),
(4, 11, 11),
(5, 12, 9),
(1, 13, 13),
(1, 14, 14),
(6, 15, 14),
(4, 16, 15),
(1, 17, 15),
(7, 18, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegousuario`
--

CREATE TABLE `juegousuario` (
  `idJuego` int(10) NOT NULL,
  `idUsuario` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `juegousuario`
--

INSERT INTO `juegousuario` (`idJuego`, `idUsuario`) VALUES
(1, 1),
(1, 2),
(2, 1),
(3, 1),
(4, 2),
(2, 10),
(5, 10),
(3, 8),
(4, 9),
(1, 9),
(4, 11),
(5, 9),
(1, 13),
(1, 14),
(6, 14),
(4, 15),
(1, 15),
(7, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precio`
--

CREATE TABLE `precio` (
  `idPrecioJuego` int(10) NOT NULL,
  `product_finSemana` decimal(25,0) NOT NULL,
  `product_mes` double NOT NULL,
  `product_precioDia` double NOT NULL,
  `product_precioSemana` double NOT NULL,
  `product_venta` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `precio`
--

INSERT INTO `precio` (`idPrecioJuego`, `product_finSemana`, `product_mes`, `product_precioDia`, `product_precioSemana`, `product_venta`) VALUES
(1, '18', 75, 1.25, 5, 15.46),
(2, '9', 136.2, 4.54, 31.78, 25),
(4, '10', 150, 5, 35, 5),
(5, '5', 79.5, 2.65, 18.55, 20),
(6, '3', 37.5, 1.25, 8.75, 25),
(7, '2', 22.5, 0.75, 5.25, 15.46),
(9, '6', 90, 3, 21, 25.48),
(10, '2', 29.7, 0.99, 6.93, 30),
(11, '3', 37.5, 1.25, 8.75, 19),
(12, '2', 30, 1, 7, 15),
(13, '5', 75, 2.5, 17.5, 25),
(14, '18', 270, 9, 63, 25),
(15, '10', 150, 5, 35, 58),
(17, '3', 40.8, 1.36, 9.52, 55),
(18, '17', 258, 8.6, 60.2, 44.6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_age` int(10) NOT NULL,
  `product_category` varchar(60) NOT NULL,
  `product_description` varchar(6000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `product_image` varchar(60) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_playersMax` int(10) NOT NULL,
  `product_playersMin` int(10) NOT NULL,
  `product_time` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`product_id`, `product_age`, `product_category`, `product_description`, `product_image`, `product_name`, `product_playersMax`, `product_playersMin`, `product_time`) VALUES
(1, 8, 'Juego de tablero contemporáneos', '7 Wonders Duel es un juego completo en el universo de 7 Wonders, diseñado específicamente para 2 jugadores.', '7WondersDuel.png', '7_WONDERS_DUEL', 2, 2, 30),
(2, 5, 'Juego de dados', 'Los jugadores quieren atraer a nuevos habitantes a su reino, cumpliendo, con tres tiradas de dados, las diferentes condiciones que se indican en las cartas; la cartas especiales proporcinan ventajas, pero hay que tener cuidado con los locos del pueblo y los dragones; aquel que consiga los mejores habitantes al final, será el ganador y hará prosperar a su reino; un complejo juego de dados. ', 'rey.jpg', 'El Rey de los Dados', 4, 2, 15),
(3, 8, 'Juego de dados', 'Mercury Games se enorgullece de anunciar la reimpresión de Alban Viards Clinic en una nueva edición Deluxe! Inspirado en el clásico P.C. juego: Hospital Temático, Clínica hizo un gran chapuzón en 2014 cuando se lanzó en un formato hecho a mano en el Spiel. Ahora, por primera vez, Clinic vuelve en una edición de lujo que es más grande y mejor que nunca! Clínica: Deluxe Edition cuenta con todas las nuevas obras de arte del famoso diseñador gráfico, Ian OToole y reglas actualizadas. ¡Dirigir tu propio hospital nunca ha sido tan divertido! ', 'clinicdeluxe_caja.png', 'Clinic Deluxe Edition ', 6, 2, 25),
(4, 8, 'Juego de tablero contemporáneos', 'Catan es un juego de mesa para toda la familia que se ha convertido en un fenómeno mundial. Desde su aparición en Alemania ha vendido más que muchos de los juegos más tradicionales. Se trata de un juego que aúna la estrategia, la astucia y la capacidad para negociar y en el que los jugadores tratan de colonizar una isla, Catán, rica en recursos naturales. Construyendo pueblos, estableciendo rutas comerciales, etc… Catan ha vendido más de 2 millones de ejemplares en Europa y América. Por si esto no fuera bastante, ha sido galardonado en Alemania y Estados Unidos como Juego del Año. El juego básico de Catan, a la venta desde hace más de 10 años en España, ha marcado un hito en toda Europa en cuanto a juego de planificación, colaboración y, por supuesto, diversión. No hace falta comentar que es la única pieza indispensable de Catan en tu ludoteca. A partir del básico se abre todo el abanico de expansiones que la isla de Catán te ofrece.', 'catan.jpg', 'CATAN', 4, 2, 25),
(5, 12, 'Juego de tablero tradicionales', 'La Edición Clásica de este juego de Trivial Pursuit es el mismo juego que conoces y que te encanta, pero con un diseño retro de los años 80.\r\n\r\nEste juego de Trivial Pursuit incluye el juego y el tablero clásicos y contiene 2.400 preguntas en seis categorías: geografía, entretenimiento, historia, arte y literatura, ciencias y naturaleza, y deportes y pasatiempos.', 'trivial.jpg', 'TRIVIAL_PURSUIT', 6, 2, 30),
(6, 6, 'Juego de tablero contemporáneos', 'descripcion', '', 'nuevo juego', 5, 2, 25),
(7, 8, 'Juego de guerra', 'Nuevo', '', 'Juego', 4, 2, 6);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`),
  ADD UNIQUE KEY `account_name` (`account_name`);

--
-- Indices de la tabla `account_sessions`
--
ALTER TABLE `account_sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Indices de la tabla `precio`
--
ALTER TABLE `precio`
  ADD PRIMARY KEY (`idPrecioJuego`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `precio`
--
ALTER TABLE `precio`
  MODIFY `idPrecioJuego` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
