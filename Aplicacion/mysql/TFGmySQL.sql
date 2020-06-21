-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 19-06-2020 a las 18:04:24
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tfg`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `cont` int(255) NOT NULL,
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `caminar` int(5) NOT NULL,
  `pie` int(5) NOT NULL,
  `sentado` int(5) NOT NULL,
  `ibaa` int(5) NOT NULL,
  `actividad` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`cont`, `id`, `fecha`, `caminar`, `pie`, `sentado`, `ibaa`, `actividad`) VALUES
(2, 16, '2020-05-04', 5, 1, 94, 0, 'Nula'),
(3, 16, '2020-05-24', 40, 8, 52, 5, 'Baja'),
(4, 16, '2020-05-06', 4, 2, 94, 0, 'Nula'),
(5, 16, '2020-05-08', 9, 1, 90, 0, 'Nula'),
(6, 16, '2020-05-10', 11, 1, 88, 0, 'Nula'),
(7, 16, '2020-05-12', 15, 2, 83, 0, 'Nula'),
(8, 16, '2020-05-14', 13, 6, 81, 0, 'Nula'),
(9, 16, '2020-05-16', 17, 5, 78, 0, 'Nula'),
(10, 16, '2020-05-18', 26, 4, 70, 5, 'Baja'),
(11, 16, '2020-05-20', 33, 6, 61, 5, 'Baja'),
(12, 16, '2020-05-22', 36, 7, 57, 5, 'Baja'),
(13, 18, '2020-06-15', 2, 3, 95, 0, 'Nula');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `apellidos` varchar(40) NOT NULL,
  `dni` varchar(40) NOT NULL,
  `fechaNacimineto` varchar(40) NOT NULL,
  `sexo` varchar(40) NOT NULL,
  `notasMedicas` varchar(100) NOT NULL,
  `IndiceBarthel` varchar(40) NOT NULL,
  `idMedico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `nombre`, `apellidos`, `dni`, `fechaNacimineto`, `sexo`, `notasMedicas`, `IndiceBarthel`, `idMedico`) VALUES
(14, 'Clementina', 'Inventada', '12345678-F', '1950-07-03', 'femenino', 'La paciente tiene un estado general bueno. Actividades a realizar caminar , sentarse y estar de pie.', 'moderada', 7),
(15, 'Pedro', 'Algun', '12345566-P', '1951-04-01', 'masculino', 'Exploracion del paciente positiva. Puede realizar cualquier ejercicio del centro.', 'leve', 7),
(16, 'Agustin', 'Jofre Millet', '1234567', '1950-07-03', 'masculino', 'El paciente se encuentra capacitado para realizar actividad física de rehabilitación', 'moderada', 7),
(18, 'Demo', 'Demo', '1234567-L', '1950-07-03', 'masculino', 'Notas medicas', 'total', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombreUsuario` varchar(40) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `apellidos` varchar(40) NOT NULL,
  `numeroColegiado` varchar(40) NOT NULL,
  `password` varchar(80) NOT NULL,
  `rol` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombreUsuario`, `nombre`, `apellidos`, `numeroColegiado`, `password`, `rol`) VALUES
(7, 'medico@medico.com', 'Agustin', '', '', '$2y$10$iGOlod/W0Bz5kujCO2XuJeqYtvQWt5QCePqBz0i/ZhwwVAHbZx1k2', 'user');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`cont`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `cont` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
