-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-05-2024 a las 19:19:47
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `animalianza`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `animal`
--

CREATE TABLE `animal` (
  `id_animal` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `especie` varchar(50) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `sexo` varchar(10) DEFAULT NULL,
  `raza` varchar(100) DEFAULT NULL,
  `id_protectora` int(11) DEFAULT NULL,
  `info_adicional` text DEFAULT NULL,
  `caso_especial` enum('si','no') DEFAULT NULL,
  `ruta_imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `animal`
--

INSERT INTO `animal` (`id_animal`, `nombre`, `especie`, `edad`, `sexo`, `raza`, `id_protectora`, `info_adicional`, `caso_especial`, `ruta_imagen`) VALUES
(54, 'simbilla2', 'gato', 1, '', 'negro', NULL, 'kjdjkdjukdhudehfekhfehjfej', NULL, '../images/uploads/ejemplo.jpeg'),
(55, 'ejemplo2', 'gato', 2, NULL, 'simba', NULL, 'una tia xula', NULL, '../images/uploads/ejemplo.jpeg'),
(56, 'ejemplo3', 'gato', 5, NULL, 'simba', NULL, 'holahola', NULL, '../images/uploads/ejemplo.jpeg'),
(57, 'ejemplo4', 'gato', 99, NULL, 'simba', NULL, 'hola', NULL, '../images/uploads/ejemplo.jpeg'),
(58, 'ejemplo5', 'gato', 333, NULL, 'simba', NULL, 'hola', NULL, '../images/uploads/ejemplo.jpeg'),
(59, 'simbilla2', 'perro', 1, NULL, 'negro', NULL, '', NULL, '../images/uploads/logo.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `donaciones`
--

CREATE TABLE `donaciones` (
  `id_donacion` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `cantidad` decimal(10,2) DEFAULT NULL,
  `metodo_pago` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `id_evento` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `ruta_imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`id_evento`, `nombre`, `descripcion`, `fecha`, `estado`, `ruta_imagen`) VALUES
(8, 'locuraA', 'a ver que ponemos aqui hola hola hola k pasa hola', '2024-04-30', NULL, NULL),
(11, 'lofi ', 'lofi', '2024-06-06', NULL, NULL),
(12, 'lofe', 'lofe', '2024-05-28', NULL, NULL),
(13, 'holo', 'hola', '2024-05-24', NULL, NULL),
(14, 'locuraaaaa', 'locura', '2024-05-18', 'pasado', NULL),
(15, 'locuronnnnn', 'locuron', '2024-05-22', 'actual', NULL),
(16, 'whatsapp 3', 'whatsapp2', '2024-05-03', 'actual', '../images/uploads/ejemplo.jpeg'),
(17, 'fefsdsfd', 'fdsfsdf', '2024-05-17', 'actual', '../images/uploads/ejemplo.jpeg'),
(18, 'fefsdsfd', 'fdsfsdf', '2024-05-17', 'actual', '../images/uploads/logo.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id` int(11) NOT NULL,
  `id_animal` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `id_login` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipo_login` enum('usuario','protectora') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`id_login`, `username`, `password`, `tipo_login`) VALUES
(1, 'hola', 'hola', 'usuario'),
(2, 'que', 'que', 'protectora'),
(3, 'holo', 'holo', 'protectora'),
(7, 'paula', 'paula', 'protectora'),
(8, 'paula2', 'paula2', 'protectora'),
(9, 'petra', 'petra', 'protectora'),
(10, 'juani', 'juani', 'protectora'),
(11, 'juani2', 'hola', 'protectora'),
(12, 'juani2', 'e', 'protectora'),
(13, 'epa', 'epa', 'protectora'),
(14, 'epa', '2', 'protectora'),
(16, 'lasi', '', 'usuario'),
(17, 'lasi2', '', 'usuario'),
(19, 'ejemplito', 'ejemplo', 'protectora'),
(20, 'ejemplito2', 'hola', 'protectora'),
(21, 'ejemplito2', 'hola', 'protectora'),
(22, 'jhsakhsakhjdskj', '123', 'protectora'),
(23, 'jhsakhsakhjdskj', '123', 'protectora'),
(24, 'jhsakhsakhjdskj', '12', 'protectora'),
(25, 'ejemplo', 'ejemplo', 'protectora'),
(26, 'ejemplo2', '123', 'protectora');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `id_protectora` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `ruta_imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre`, `descripcion`, `id_protectora`, `precio`, `ruta_imagen`) VALUES
(10, 'ejemplomod', 'ejemplomod', NULL, 999.00, '../images/uploads/logo.png'),
(11, 'ejemplo', 'ejemplo', NULL, 34.00, '../images/uploads/ejemplo.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `protectora`
--

CREATE TABLE `protectora` (
  `id_protectora` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `acepta_adopciones` tinyint(1) DEFAULT NULL,
  `acepta_acogidas` tinyint(1) DEFAULT NULL,
  `acepta_voluntarios` tinyint(1) DEFAULT NULL,
  `id_login` int(11) NOT NULL,
  `info_prote` text DEFAULT NULL,
  `info_relevante` text DEFAULT NULL,
  `ruta_imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `protectora`
--

INSERT INTO `protectora` (`id_protectora`, `nombre`, `direccion`, `telefono`, `email`, `acepta_adopciones`, `acepta_acogidas`, `acepta_voluntarios`, `id_login`, `info_prote`, `info_relevante`, `ruta_imagen`) VALUES
(14, 'JHSKJSKJS', 'hola', NULL, 'hola@hola.com', NULL, NULL, NULL, 23, 'adasd', '', '../images/uploads/663ca82bc113b.jpeg'),
(15, 'JHSKJSKJS', 'hola', NULL, 'hola@hola.com', NULL, NULL, NULL, 24, 'sdfsdffssfd', '', '../images/uploads/663ca8c14e1b4.png'),
(16, 'ejemplo', 'jdfsjfhsdj', NULL, 'ejemplo@ejemplo.com', NULL, NULL, NULL, 25, 'sñdkasflkjads', '', '../images/uploads/663cad782ea3c.jpeg'),
(17, 'ejemplo', 'jdfsjfhsdj', NULL, 'ejemplo@ejemplo.com', NULL, NULL, NULL, 26, 'asd', '', '../images/uploads/663cad9b37ddf.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_acogida`
--

CREATE TABLE `solicitud_acogida` (
  `id_solicitud_acogida` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_animal` int(11) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_acogida_usuario`
--

CREATE TABLE `solicitud_acogida_usuario` (
  `id_solicitud_acogida` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_animal` int(11) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_adopcion`
--

CREATE TABLE `solicitud_adopcion` (
  `id_solicitud_adopcion` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_animal` int(11) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_adopcion_usuario`
--

CREATE TABLE `solicitud_adopcion_usuario` (
  `id_solicitud_adopcion` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_animal` int(11) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_voluntariado`
--

CREATE TABLE `solicitud_voluntariado` (
  `id_solicitud_voluntariado` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_protectora` int(11) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_voluntariado_usuario`
--

CREATE TABLE `solicitud_voluntariado_usuario` (
  `id_solicitud_voluntariado` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_protectora` int(11) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `id_login` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `direccion`, `telefono`, `email`, `id_login`) VALUES
(1, 'lasi', '', '3939393', 'lasi@lasi.com', 16),
(2, 'lasi2', '', '3939393', 'lasi@lasi.com', 17);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`id_animal`),
  ADD KEY `id_protectora` (`id_protectora`);

--
-- Indices de la tabla `donaciones`
--
ALTER TABLE `donaciones`
  ADD PRIMARY KEY (`id_donacion`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id_evento`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_protectora` (`id_protectora`);

--
-- Indices de la tabla `protectora`
--
ALTER TABLE `protectora`
  ADD PRIMARY KEY (`id_protectora`),
  ADD KEY `id_login` (`id_login`);

--
-- Indices de la tabla `solicitud_acogida`
--
ALTER TABLE `solicitud_acogida`
  ADD PRIMARY KEY (`id_solicitud_acogida`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_animal` (`id_animal`);

--
-- Indices de la tabla `solicitud_acogida_usuario`
--
ALTER TABLE `solicitud_acogida_usuario`
  ADD PRIMARY KEY (`id_solicitud_acogida`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_animal` (`id_animal`);

--
-- Indices de la tabla `solicitud_adopcion`
--
ALTER TABLE `solicitud_adopcion`
  ADD PRIMARY KEY (`id_solicitud_adopcion`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_animal` (`id_animal`);

--
-- Indices de la tabla `solicitud_adopcion_usuario`
--
ALTER TABLE `solicitud_adopcion_usuario`
  ADD PRIMARY KEY (`id_solicitud_adopcion`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_animal` (`id_animal`);

--
-- Indices de la tabla `solicitud_voluntariado`
--
ALTER TABLE `solicitud_voluntariado`
  ADD PRIMARY KEY (`id_solicitud_voluntariado`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_protectora` (`id_protectora`);

--
-- Indices de la tabla `solicitud_voluntariado_usuario`
--
ALTER TABLE `solicitud_voluntariado_usuario`
  ADD PRIMARY KEY (`id_solicitud_voluntariado`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_protectora` (`id_protectora`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_login` (`id_login`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `animal`
--
ALTER TABLE `animal`
  MODIFY `id_animal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `donaciones`
--
ALTER TABLE `donaciones`
  MODIFY `id_donacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `protectora`
--
ALTER TABLE `protectora`
  MODIFY `id_protectora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `solicitud_acogida`
--
ALTER TABLE `solicitud_acogida`
  MODIFY `id_solicitud_acogida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud_acogida_usuario`
--
ALTER TABLE `solicitud_acogida_usuario`
  MODIFY `id_solicitud_acogida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud_adopcion`
--
ALTER TABLE `solicitud_adopcion`
  MODIFY `id_solicitud_adopcion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud_adopcion_usuario`
--
ALTER TABLE `solicitud_adopcion_usuario`
  MODIFY `id_solicitud_adopcion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud_voluntariado`
--
ALTER TABLE `solicitud_voluntariado`
  MODIFY `id_solicitud_voluntariado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud_voluntariado_usuario`
--
ALTER TABLE `solicitud_voluntariado_usuario`
  MODIFY `id_solicitud_voluntariado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `protectora`
--
ALTER TABLE `protectora`
  ADD CONSTRAINT `protectora_ibfk_1` FOREIGN KEY (`id_login`) REFERENCES `login` (`id_login`);

--
-- Filtros para la tabla `solicitud_acogida`
--
ALTER TABLE `solicitud_acogida`
  ADD CONSTRAINT `solicitud_acogida_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `solicitud_acogida_ibfk_2` FOREIGN KEY (`id_animal`) REFERENCES `animal` (`id_animal`);

--
-- Filtros para la tabla `solicitud_acogida_usuario`
--
ALTER TABLE `solicitud_acogida_usuario`
  ADD CONSTRAINT `solicitud_acogida_usuario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `solicitud_acogida_usuario_ibfk_2` FOREIGN KEY (`id_animal`) REFERENCES `animal` (`id_animal`);

--
-- Filtros para la tabla `solicitud_adopcion`
--
ALTER TABLE `solicitud_adopcion`
  ADD CONSTRAINT `solicitud_adopcion_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `solicitud_adopcion_ibfk_2` FOREIGN KEY (`id_animal`) REFERENCES `animal` (`id_animal`);

--
-- Filtros para la tabla `solicitud_adopcion_usuario`
--
ALTER TABLE `solicitud_adopcion_usuario`
  ADD CONSTRAINT `solicitud_adopcion_usuario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `solicitud_adopcion_usuario_ibfk_2` FOREIGN KEY (`id_animal`) REFERENCES `animal` (`id_animal`);

--
-- Filtros para la tabla `solicitud_voluntariado_usuario`
--
ALTER TABLE `solicitud_voluntariado_usuario`
  ADD CONSTRAINT `solicitud_voluntariado_usuario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_login`) REFERENCES `login` (`id_login`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
