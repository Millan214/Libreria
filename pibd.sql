-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-11-2021 a las 16:06:18
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pibd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `cod_libro` int(11) NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `autor` varchar(100) DEFAULT NULL,
  `editorial` varchar(100) DEFAULT NULL,
  `fecha_insercion` date DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `deleted` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`cod_libro`, `titulo`, `autor`, `editorial`, `fecha_insercion`, `imagen`, `deleted`) VALUES
(1, 'El fin de la eternidad', 'Isaac Asimov', 'Best Seller', '2021-11-01', './img/el-fin-de-la-eternidad.jpg', NULL),
(2, 'Preludio a la fundación', 'Isaac Asimov', 'Best Seller', '2021-11-01', './img/preludio-a-la-fundacion.jpg', NULL),
(3, 'Yo, Robot', 'Isaac Asimov', 'Best Seller', '2021-11-01', './img/yo-robot.jpg', NULL),
(4, 'Bobedas de acero', 'Isaac Asimov', 'Best Seller', '2021-11-01', './img/bobedas-de-acero.jpg', NULL),
(5, 'El sol desnudo', 'Isaac Asimov', 'Best Seller', '2021-11-01', './img/el-sol-desnudo.jpg', NULL),
(6, 'Los robots del amanecer', 'Isaac Asimov', 'Best Seller', '2021-11-01', './img/los-robots-del-amanecer.jpg', NULL),
(7, 'Robots e Imperio', 'Isaac Asimov', 'Best Seller', '2021-11-01', './img/robots-e-imperio.jpg', NULL),
(8, 'En la arena estelar', 'Isaac Asimov', 'Best Seller', '2021-11-01', './img/en-la-arena-estelar.jpg', NULL),
(9, 'Las corrientes del espacio', 'Isaac Asimov', 'Best Seller', '2021-11-01', './img/las-corrientes-del-espacio.jpg', NULL),
(10, 'Un guijarro en el cielo', 'Isaac Asimov', 'Best Seller', '2021-11-01', './img/un-guijarro-en-el-cielo.jpg', NULL),
(11, 'Hacia la fundacion', 'Isaac Asimov', 'Best Seller', '2021-11-01', './img/hacia-la-fundacion.jpg', NULL),
(12, 'Fundación', 'Isaac Asimov', 'Best Seller', '2021-11-01', './img/fundacion.jpg', NULL),
(13, 'Fundación e Imperio', 'Isaac Asimov', 'Best Seller', '2021-11-01', './img/fundacion-e-imperio.jpg', NULL),
(14, 'Segunda Fundación', 'Isaac Asimov', 'Best Seller', '2021-11-01', './img/segunda-fundacion.jpg', NULL),
(15, 'Los limites de la fundacion', 'Isaac Asimov', 'Best Seller', '2021-11-01', './img/los-limites-de-la-fundacion.jpg', NULL),
(16, 'Fundacion y tierra', 'Isaac Asimov', 'Best Seller', '2021-11-01', './img/fundacion-y-tierra.jfif', NULL),
(17, 'Amanecer rojo', 'Pierce Brown', 'RBA', '2021-11-01', './img/amanecer-rojo.jpg', NULL),
(18, 'Hijo dorado', 'Pierce Brown', 'RBA', '2021-11-01', './img/hijo-dorado.jpg', NULL),
(19, 'Mañana azul', 'Pierce Brown', 'RBA', '2021-11-01', './img/manana-azul.jpg', NULL),
(20, 'Oro y ceniza', 'Pierce Brown', 'RBA', '2021-11-01', './img/oro-y-ceniza.jpg', NULL),
(21, 'En las montañas de la locura', 'H.P. Lovecraft', 'Minotauro', '2021-11-01', './img/en-las-montanas-de-la-locura.jpg', NULL),
(22, '1984', 'George Orwell', 'RBA', '2021-11-01', './img/1984.jpg', NULL),
(23, 'Dune', 'Frank Herberts', 'Debolsillo', '2021-11-01', './img/dune.jpg', NULL),
(24, 'Guía del autoestopista galáctico', 'Douglas Adams', 'Anagrama', '2021-11-01', './img/guia-del-autoestopista-galactico.jpg', NULL),
(25, 'El problema de los tres cuerpos', 'Liu Cixin', 'RBA', '2021-11-01', './img/el-problema-de-los-tres-cuerpos.jpg', NULL),
(26, 'ILLUMINAE. Expediente_01', 'Amie Kaufman', 'ALFAGUARA', '2021-11-01', './img/illuminae.jpg', NULL),
(27, 'GEMINA. Expediente_02', 'Amie Kaufman', 'Oneworld tions', '2021-11-01', './img/gemina.jpg', NULL),
(28, 'OBSIDIO. Expediente_03', 'Amie Kaufman', 'Oneworld tions', '2021-11-01', './img/obsidio.jpg', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `cod_prestamo` int(11) NOT NULL,
  `cod_libro` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `prestado` date DEFAULT NULL,
  `devuelto` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `login` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `tipo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`login`, `password`, `nombre`, `apellidos`, `email`, `tipo`) VALUES
('millan214', '263fec58861449aacc1c328a4aff64aff4c62df4a2d50b3f207fa89b6e242c9aa778e7a8baeffef85b6ca6d2e7dc16ff0a760d59c13c238f6bcdc32f8ce9cc62', 'millan', 'martinez', 'milmararco@gmail.com', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`cod_libro`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`cod_prestamo`),
  ADD KEY `cod_libro` (`cod_libro`),
  ADD KEY `login` (`login`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`login`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `cod_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `prestamos_ibfk_1` FOREIGN KEY (`cod_libro`) REFERENCES `libros` (`cod_libro`),
  ADD CONSTRAINT `prestamos_ibfk_2` FOREIGN KEY (`login`) REFERENCES `usuarios` (`login`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
