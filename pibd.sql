--
-- Base de datos: `biblioteca`
--
DROP DATABASE IF EXISTS biblioteca;

CREATE DATABASE biblioteca;

USE biblioteca;
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `login` varchar(128) NOT NULL PRIMARY KEY,
  `password` varchar(128) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `apellido1` varchar(128) NOT NULL,
  `apellido2` varchar(128),
  `email` varchar(128) NOT NULL,
  `tipo` varchar(128) NOT NULL,
  `ID_session` varchar(128)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `cod_libro` int PRIMARY KEY AUTO_INCREMENT,
  `titulo` varchar(128) NOT NULL,
  `autor` varchar(128) NOT NULL,
  `editorial` varchar(128) NOT NULL,
  `fecha_insercion` datetime NOT NULL,
  `url_imagen` varchar(128) NOT NULL,
  `unidades` int(11),
  `borrado_virtual` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `cod_prestamo` int NOT NULL AUTO_INCREMENT,
  `cod_libro` int NOT NULL,
  `login` varchar(128) NOT NULL,
  `prestado` datetime NOT NULL,
  `devuelto` datetime DEFAULT NULL,
  PRIMARY KEY (`cod_prestamo`,`cod_libro`,`login`),
  FOREIGN KEY (`cod_libro`) REFERENCES `libros`(`cod_libro`),
  FOREIGN KEY (`login`) REFERENCES `usuarios`(`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
INSERT INTO `usuarios`(`login`, `password`, `nombre`, `apellido1`, `apellido2`, `email`, `tipo`) VALUES ('usuario1','1234','usuario1','apellido1','apellido2','usuario1@mail.com','usuario');
INSERT INTO `usuarios`(`login`, `password`, `nombre`, `apellido1`, `apellido2`, `email`, `tipo`) VALUES ('usuario2@mail.com','1234','usuario2','apellido3','','usuario2@mail.com','usuario');
INSERT INTO `libros`(`titulo`, `autor`, `editorial`, `fecha_insercion`, `url_imagen`, `unidades`, `borrado_virtual`) VALUES ('DWES','Profe','IESJC','2021-11-05 21:11:06','img/libro.jpg',2,NULL);
INSERT INTO `libros`(`titulo`, `autor`, `editorial`, `fecha_insercion`, `url_imagen`, `borrado_virtual`) VALUES ('DWEC','Profe','IESJC','2021-11-05 21:11:06','img/libro.jpg',NULL);
COMMIT;