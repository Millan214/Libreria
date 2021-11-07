-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-11-2021 a las 14:39:48
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
  `deleted` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`titulo`, `autor`, `editorial`, `fecha_insercion`, `url_imagen`, `unidades` ,`borrado_virtual`) VALUES
('El fin de la eternidad', 'Isaac Asimov', 'Best Seller', NOW(), './img/el-fin-de-la-eternidad.jpg', NULL , NULL),
('Preludio a la fundación', 'Isaac Asimov', 'Best Seller', NOW(), './img/preludio-a-la-fundacion.jpg', NULL , NULL),
('Yo, Robot', 'Isaac Asimov', 'Best Seller', NOW(), './img/yo-robot.jpg', NULL , NULL),
('Bobedas de acero', 'Isaac Asimov', 'Best Seller', NOW(), './img/bobedas-de-acero.jpg', NULL , NULL),
('El sol desnudo', 'Isaac Asimov', 'Best Seller', NOW(), './img/el-sol-desnudo.jpg', NULL , NULL),
('Los robots del amanecer', 'Isaac Asimov', 'Best Seller', NOW(), './img/los-robots-del-amanecer.jpg', NULL , NULL),
('Robots e Imperio', 'Isaac Asimov', 'Best Seller', NOW(), './img/robots-e-imperio.jpg', NULL , NULL),
('En la arena estelar', 'Isaac Asimov', 'Best Seller', NOW(), './img/en-la-arena-estelar.jpg', NULL , NULL),
('Las corrientes del espacio', 'Isaac Asimov', 'Best Seller', NOW(), './img/las-corrientes-del-espacio.jpg', NULL , NULL),
( 'Un guijarro en el cielo', 'Isaac Asimov', 'Best Seller', NOW(), './img/un-guijarro-en-el-cielo.jpg', NULL , NULL),
( 'Hacia la fundacion', 'Isaac Asimov', 'Best Seller', NOW(), './img/hacia-la-fundacion.jpg', NULL , NULL),
( 'Fundación', 'Isaac Asimov', 'Best Seller', NOW(), './img/fundacion.jpg', NULL , NULL),
( 'Fundación e Imperio', 'Isaac Asimov', 'Best Seller', NOW(), './img/fundacion-e-imperio.jpg', NULL , NULL),
( 'Segunda Fundación', 'Isaac Asimov', 'Best Seller', NOW(), './img/segunda-fundacion.jpg', NULL , NULL),
( 'Los limites de la fundacion', 'Isaac Asimov', 'Best Seller', NOW(), './img/los-limites-de-la-fundacion.jpg', NULL , NULL),
( 'Fundacion y tierra', 'Isaac Asimov', 'Best Seller', NOW(), './img/fundacion-y-tierra.jfif', NULL , NULL),
( 'Amanecer rojo', 'Pierce Brown', 'RBA', NOW(), './img/amanecer-rojo.jpg', NULL , NULL),
( 'Hijo dorado', 'Pierce Brown', 'RBA', NOW(), './img/hijo-dorado.jpg', NULL , NULL),
( 'Mañana azul', 'Pierce Brown', 'RBA', NOW(), './img/manana-azul.jpg', NULL , NULL),
( 'Oro y ceniza', 'Pierce Brown', 'RBA', NOW(), './img/oro-y-ceniza.jpg', NULL , NULL),
( 'En las montañas de la locura', 'H.P. Lovecraft', 'Minotauro', NOW(), './img/en-las-montanas-de-la-locura.jpg', NULL , NULL),
( '1984', 'George Orwell', 'RBA', NOW(), './img/1984.jpg', NULL , NULL),
( 'Dune', 'Frank Herberts', 'Debolsillo', NOW(), './img/dune.jpg', NULL , NULL),
( 'Guía del autoestopista galáctico', 'Douglas Adams', 'Anagrama', NOW(), './img/guia-del-autoestopista-galactico.jpg', NULL , NULL),
( 'El problema de los tres cuerpos', 'Liu Cixin', 'RBA', NOW(), './img/el-problema-de-los-tres-cuerpos.jpg', NULL , NULL),
( 'ILLUMINAE. Expediente_01', 'Amie Kaufman', 'ALFAGUARA', NOW(), './img/illuminae.jpg', NULL , NULL),
( 'GEMINA. Expediente_02', 'Amie Kaufman', 'Oneworld tions', NOW(), './img/gemina.jpg', NULL , NULL),
( 'OBSIDIO. Expediente_03', 'Amie Kaufman', 'Oneworld tions', NOW(), './img/obsidio.jpg', NULL , NULL);

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

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`cod_prestamo`, `cod_libro`, `login`, `prestado`, `devuelto`) VALUES
(1, 1, 'millan214', '2021-11-05', '2021-11-05'),
(2, 5, 'millan214', '2021-11-05', NULL),
(3, 4, 'millan214', '2021-11-05', NULL),
(9, 2, 'millan214', '2021-11-05', NULL),
(10, 22, 'millan214', '2021-11-05', '2021-11-05');

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
  `tipo` varchar(30) NOT NULL,
  `deleted` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`login`, `password`, `nombre`, `apellidos`, `email`, `tipo`, `deleted`) VALUES
('millan214', '263fec58861449aacc1c328a4aff64aff4c62df4a2d50b3f207fa89b6e242c9aa778e7a8baeffef85b6ca6d2e7dc16ff0a760d59c13c238f6bcdc32f8ce9cc62', 'millan', 'martinez', 'milmararco@gmail.com', 'admin', NULL);

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
  MODIFY `cod_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `cod_prestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
