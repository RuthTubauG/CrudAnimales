-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-09-2023 a las 00:00:35
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mascotas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `animales`
--

CREATE TABLE `animales` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `especie` varchar(20) NOT NULL,
  `raza` varchar(30) NOT NULL,
  `edad` int(3) NOT NULL,
  `img` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `animales`
--

INSERT INTO `animales` (`id`, `nombre`, `especie`, `raza`, `edad`, `img`) VALUES
  (1, 'Diva', 'Canina', 'Dogo burdeos', 2, 'https://cdn.pixabay.com/photo/2015/04/27/21/04/dog-742647_640.jpg'),
	(2, 'Luna', 'Canina', 'Pastor Belga', 4, 'https://i.pinimg.com/originals/22/58/84/22588408f395719404b22302044451ba.jpg'),
	(5, 'Kiba', 'Canina', 'Pitbull', 6, 'https://i.pinimg.com/736x/c5/b9/75/c5b97573be7144268f618fc88e61cd44.jpg'),
	(6, 'Linda', 'Mamífero', 'Conejo Cabeza de Leon', 1, 'https://imagenes.20minutos.es/files/image_640_auto/uploads/imagenes/2023/04/30/el-peludo-conejo-de-cabeza-de-leon-enano.jpeg'),
	(7, 'Manchitas', 'Mamífero', 'Conejo Belier', 3, 'https://t2.ea.ltmcdn.com/es/razas/5/9/4/belier_495_0_orig.jpg'),
	(8, 'Bolita', 'Mamífero', 'Conejo Enano', 6, 'https://t2.ea.ltmcdn.com/es/posts/6/8/0/razas_de_conejos_enanos_o_toy_24086_600_square.jpg'),
	(9, 'Misty', 'Felino', 'Siamés', 3, 'https://www.eltiempo.com/files/article_vertical_content_new/uploads/2023/02/14/63eb9a4dd0145.jpeg'),
	(10, 'Reina', 'Felino', 'Bosque de Noruega', 4, 'https://upload.wikimedia.org/wikipedia/commons/9/97/Blaffido01.jpg'),
	(11, 'Miny', 'Felino', 'Bombay', 2, 'https://www.mundogato.net/wp-content/uploads/gato-bombay-cachorro.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `animales`
--
ALTER TABLE `animales`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `animales`
--
ALTER TABLE `animales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
