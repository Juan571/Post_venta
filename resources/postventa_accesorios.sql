-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 26-03-2015 a las 09:10:59
-- Versión del servidor: 5.5.38
-- Versión de PHP: 5.4.36-0+deb7u1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `postventa_accesorios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agencias`
--

CREATE TABLE IF NOT EXISTS `agencias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agencia` varchar(100) CHARACTER SET latin1 NOT NULL,
  `agencia_id` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `agencia_id` (`agencia_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `agencias`
--

INSERT INTO `agencias` (`id`, `agencia`, `agencia_id`, `activo`) VALUES
(1, 'Oficina Comercial 1', 1, 1),
(2, 'Oficina Comercial 2', 2, 1),
(3, 'Agente Autorizado 1', 1, 1),
(4, 'Agente Autorizado 2', 1, 1),
(5, 'Agente Autorizado 3', 2, 1),
(6, 'Agente Autorizado 4', 2, 1),
(7, 'Ofcina Comercial 3', 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colores`
--

CREATE TABLE IF NOT EXISTS `colores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color` varchar(20) CHARACTER SET latin1 NOT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `colores`
--

INSERT INTO `colores` (`id`, `color`, `activo`) VALUES
(1, 'N/A', 1),
(2, 'Blanco', 1),
(3, 'Amarillo', 1),
(4, 'Azul', 1),
(5, 'Rojo', 1),
(6, 'Anaranjado', 1),
(7, 'Vinotinto', 1),
(8, 'Negro', 1),
(9, 'Morado', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_inventario`
--

CREATE TABLE IF NOT EXISTS `detalles_inventario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inventario_id` int(11) NOT NULL,
  `modelo_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `inventario_id` (`inventario_id`,`modelo_id`),
  KEY `modelo_id` (`modelo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `detalles_inventario`
--

INSERT INTO `detalles_inventario` (`id`, `inventario_id`, `modelo_id`, `cantidad`) VALUES
(1, 1, 6, 15),
(2, 1, 7, 15),
(3, 2, 7, 14),
(4, 2, 6, 12),
(5, 3, 6, 12),
(6, 3, 5, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE IF NOT EXISTS `equipos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `solicitante_id` int(11) NOT NULL,
  `modelo_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `imei` varchar(20) CHARACTER SET latin1 NOT NULL,
  `serial` varchar(20) CHARACTER SET latin1 NOT NULL,
  `tecnologia_id` int(11) NOT NULL,
  `factura` varchar(20) CHARACTER SET latin1 NOT NULL,
  `fecha_compra` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `operadora_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `solicitante_id` (`solicitante_id`),
  KEY `modelo_id` (`modelo_id`),
  KEY `color_id` (`color_id`),
  KEY `tecnologia_id` (`tecnologia_id`),
  KEY `operadora_id` (`operadora_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id`, `solicitante_id`, `modelo_id`, `color_id`, `imei`, `serial`, `tecnologia_id`, `factura`, `fecha_compra`, `operadora_id`) VALUES
(8, 9, 1, 1, '1111111', '123456', 1, '123213', '2011-11-11 04:30:00', 1),
(9, 9, 1, 1, '1111111', 's/n', 1, '123213', '2011-11-11 04:30:00', 1),
(10, 9, 1, 1, '1111111', '12345', 1, '123213', '2011-11-11 04:30:00', 1),
(11, 9, 1, 1, '1111111', 'serial', 1, '123213', '2011-11-11 04:30:00', 1),
(12, 9, 1, 1, '1111111', '123123123', 1, '123213', '2011-11-11 04:30:00', 1),
(13, 9, 1, 1, '1111111', '154878', 1, '123213', '2011-11-11 04:30:00', 1),
(14, 9, 1, 1, '1111111', '123321456', 1, '123213', '2011-11-11 04:30:00', 1),
(15, 9, 1, 1, '1111111', '111111111111', 1, '123213', '2011-11-11 04:30:00', 1),
(16, 9, 1, 1, '1111111', '111', 1, '123213', '2011-11-11 04:30:00', 1),
(17, 9, 1, 1, '1111111', '23123', 1, '123213', '2011-11-11 04:30:00', 1),
(18, 9, 1, 1, '1111111', '1111', 1, '123213', '2011-11-11 04:30:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE IF NOT EXISTS `inventario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto` varchar(100) NOT NULL,
  `tipo_producto_id` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo_producto_id` (`tipo_producto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `producto`, `tipo_producto_id`, `activo`) VALUES
(1, 'Batería', 1, 1),
(2, 'Cable USB', 1, 1),
(3, 'Auriculares', 1, 1),
(4, 'Tarjeta Micro SD', 1, 1),
(5, 'Cargador', 1, 1),
(6, 'CD Controlador', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelos`
--

CREATE TABLE IF NOT EXISTS `modelos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modelo` varchar(50) CHARACTER SET latin1 NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `modelos`
--

INSERT INTO `modelos` (`id`, `modelo`, `descripcion`, `activo`) VALUES
(1, 'V8200', 'Android Vergatario', 1),
(2, 'S202', 'Amigo', 1),
(3, 'S188', 'Amigo 2', 1),
(4, 'VC507X', 'Caribe', 1),
(5, 'N720', 'Caribe 2', 1),
(6, 'V791', 'Caribe 3', 1),
(7, 'X991', 'Gran Vergatario', 1),
(8, 'F310', 'Gran Vergatario 2', 1),
(9, 'S186', 'S186', 1),
(10, 'V865M', 'Telepatria', 1),
(11, 'C366', 'Vergatario', 1),
(12, 'S265', 'Vergatario 2', 1),
(13, 'S133', 'Vergatario 3', 1),
(14, 'VTD9977A', 'Victoria', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivos_reemplazo`
--

CREATE TABLE IF NOT EXISTS `motivos_reemplazo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `motivo` varchar(50) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `motivos_reemplazo`
--

INSERT INTO `motivos_reemplazo` (`id`, `motivo`, `activo`) VALUES
(1, 'Defecto de Fábrica', 1),
(2, 'Dañado', 1),
(3, 'Ausente', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operadoras`
--

CREATE TABLE IF NOT EXISTS `operadoras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `operadora` varchar(50) CHARACTER SET latin1 NOT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `operadoras`
--

INSERT INTO `operadoras` (`id`, `operadora`, `activo`) VALUES
(1, 'Movilnet', 1),
(2, 'Digitel', 1),
(3, 'Movistar', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_asignaciones`
--

CREATE TABLE IF NOT EXISTS `orden_asignaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `codigo_orden` varchar(100) NOT NULL,
  `observacion` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Pendiente 2=Incompleto 3=Procesado',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Volcado de datos para la tabla `orden_asignaciones`
--

INSERT INTO `orden_asignaciones` (`id`, `fecha`, `codigo_orden`, `observacion`, `estatus`) VALUES
(35, '2015-03-03', '123', 'zcxczxsdaasd', 1),
(36, '2015-03-03', '123321', 'dasdsasda', 2),
(37, '2015-03-03', 'weew22', 'asddsa', 3),
(38, '2015-03-24', 'vcxxvcvxc', 'sfdsdfsdfsdf', 3),
(39, '2015-03-04', '789', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimientos`
--

CREATE TABLE IF NOT EXISTS `seguimientos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tipo_estado_id` int(11) NOT NULL,
  `solicitudes_accesorios_id` int(11) NOT NULL,
  `observaciones` varchar(100) NOT NULL,
  `agencias_id` int(11) NOT NULL,
  `solicitudes_accesorios_inventario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo_estado_id` (`tipo_estado_id`),
  KEY `solicitudes_accesorios_id` (`solicitudes_accesorios_id`),
  KEY `agencias_id` (`agencias_id`),
  KEY `solicitudes_accesorios_inventario_id` (`solicitudes_accesorios_inventario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=192 ;

--
-- Volcado de datos para la tabla `seguimientos`
--

INSERT INTO `seguimientos` (`id`, `fecha`, `tipo_estado_id`, `solicitudes_accesorios_id`, `observaciones`, `agencias_id`, `solicitudes_accesorios_inventario_id`) VALUES
(184, '2015-03-20 17:05:39', 1, 70, '', 1, 0),
(185, '2015-03-20 17:10:19', 1, 71, '', 1, 0),
(186, '2015-03-26 12:47:06', 2, 71, '', 0, 58),
(187, '2015-03-26 12:47:06', 2, 71, '', 0, 59),
(188, '2015-03-26 12:47:06', 2, 71, '', 0, 60),
(189, '2015-03-26 12:50:08', 6, 70, 'no aplica', 0, 55),
(190, '2015-03-26 12:50:08', 6, 70, 'no aplica', 0, 56),
(191, '2015-03-26 12:50:08', 6, 70, 'no aplica', 0, 57);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitantes`
--

CREATE TABLE IF NOT EXISTS `solicitantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(10) CHARACTER SET latin1 NOT NULL,
  `nombres` varchar(80) CHARACTER SET latin1 NOT NULL,
  `apellidos` varchar(80) CHARACTER SET latin1 NOT NULL,
  `direccion` varchar(150) CHARACTER SET latin1 NOT NULL,
  `parroquia_id` int(11) NOT NULL,
  `telefono_fijo` varchar(15) CHARACTER SET latin1 NOT NULL,
  `telefono_movil` varchar(15) CHARACTER SET latin1 NOT NULL,
  `correo` varchar(320) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parroquia_id` (`parroquia_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `solicitantes`
--

INSERT INTO `solicitantes` (`id`, `cedula`, `nombres`, `apellidos`, `direccion`, `parroquia_id`, `telefono_fijo`, `telefono_movil`, `correo`) VALUES
(1, '16193438', 'William', 'Cabrera', 'Sector la Rosa, Calle Las Mercedes, Casa #170', 221, '02122900898', '04125926487', ''),
(5, '20551067', 'Juan Diego', 'Romero B', 'Antiguo Aeropuerto', 221, '0269 -000-00 00', '0426 555 55 55', 'jromero@juan.com'),
(6, '11784366', 'Orlando', 'Chirinos', 'Comunidad Cardón', 222, '02692912945', '04165555555', ''),
(7, '17310357', 'ysabel', 'zarraga', 'sdjkncejve n', 220, '026945699845', '04261631650', 'ysabelzarraga@gmail.com'),
(8, '22604830', 'alexander', 'nuñez', 'margaras', 219, '563245659745', '219648165189', 'ysabelzarraga@gmail.com'),
(9, '20296572', 'pedro', 'lugo', 'coro', 26, '156494455', '5485215851', 'ysabelzarraga@gmail.com'),
(10, '19058760', 'Adriana', 'Mata', 'Antiguo Aeropuerto', 221, '02692222222', '04162222222', 'correo@correo.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes_accesorios`
--

CREATE TABLE IF NOT EXISTS `solicitudes_accesorios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equipo_id` int(11) NOT NULL,
  `fecha_solicitud` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usuario_id` int(11) NOT NULL,
  `tipo_estado_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `equipo_id` (`equipo_id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `tipo_estado_id` (`tipo_estado_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=72 ;

--
-- Volcado de datos para la tabla `solicitudes_accesorios`
--

INSERT INTO `solicitudes_accesorios` (`id`, `equipo_id`, `fecha_solicitud`, `usuario_id`, `tipo_estado_id`) VALUES
(70, 18, '2015-03-26 12:50:08', 22, 6),
(71, 16, '2015-03-26 12:47:06', 22, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes_accesorios_inventario`
--

CREATE TABLE IF NOT EXISTS `solicitudes_accesorios_inventario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `solicitud_accesorios_id` int(11) NOT NULL,
  `inventario_id` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `motivo_id` int(11) NOT NULL,
  `observaciones` varchar(100) NOT NULL,
  `aprobado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `solicitud_accesorios_id` (`solicitud_accesorios_id`),
  KEY `inventario_id` (`inventario_id`),
  KEY `motivo_id` (`motivo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

--
-- Volcado de datos para la tabla `solicitudes_accesorios_inventario`
--

INSERT INTO `solicitudes_accesorios_inventario` (`id`, `solicitud_accesorios_id`, `inventario_id`, `descripcion`, `motivo_id`, `observaciones`, `aprobado`) VALUES
(55, 70, 1, '', 1, '', 0),
(56, 70, 2, '', 2, '', 0),
(57, 70, 3, '', 3, '', 0),
(58, 71, 1, '', 1, '', 1),
(59, 71, 2, '', 2, '', 1),
(60, 71, 3, '', 3, '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tecnologias`
--

CREATE TABLE IF NOT EXISTS `tecnologias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tecnologia` varchar(50) CHARACTER SET latin1 NOT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tecnologias`
--

INSERT INTO `tecnologias` (`id`, `tecnologia`, `activo`) VALUES
(1, 'CDMA', 1),
(2, 'GSM', 1),
(3, 'UMTS/WCDMA', 1),
(4, 'LTE', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_estados`
--

CREATE TABLE IF NOT EXISTS `tipos_estados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `tipos_estados`
--

INSERT INTO `tipos_estados` (`id`, `estado`) VALUES
(1, 'Pendiente'),
(2, 'Procesado'),
(3, 'Despachado'),
(4, 'En Oficina Comercial'),
(5, 'Entregado'),
(6, 'Denegado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_productos`
--

CREATE TABLE IF NOT EXISTS `tipos_productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(150) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tipos_productos`
--

INSERT INTO `tipos_productos` (`id`, `descripcion`, `activo`) VALUES
(1, 'Accesorio', 1),
(2, 'Parte y Pieza', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_usuarios`
--

CREATE TABLE IF NOT EXISTS `tipos_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tipos_usuarios`
--

INSERT INTO `tipos_usuarios` (`id`, `descripcion`) VALUES
(1, 'Administrador'),
(2, 'Movilnet'),
(3, 'Agencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transacciones`
--

CREATE TABLE IF NOT EXISTS `transacciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `detalles_inventario_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '0',
  `orden_asignaciones_id` int(11) NOT NULL,
  `recibido` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=En tramite 1=recibido',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Volcado de datos para la tabla `transacciones`
--

INSERT INTO `transacciones` (`id`, `detalles_inventario_id`, `cantidad`, `orden_asignaciones_id`, `recibido`) VALUES
(25, 4, 2323, 35, 0),
(26, 1, 23, 35, 0),
(27, 5, 34, 35, 0),
(28, 4, 34, 38, 0),
(29, 1, 34, 38, 0),
(30, 2, 20, 39, 0),
(31, 1, 10, 39, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(10) NOT NULL,
  `nombres` varchar(80) NOT NULL,
  `apellidos` varchar(80) NOT NULL,
  `correo` varchar(320) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `agencia_id` int(11) NOT NULL,
  `tipo_usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `agencia_id` (`agencia_id`),
  KEY `tipo_usuario_id` (`tipo_usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `cedula`, `nombres`, `apellidos`, `correo`, `clave`, `agencia_id`, `tipo_usuario_id`) VALUES
(1, '16193438', 'William', 'Cabrera', 'wcabrera@vtelca.gob.ve', '202cb962ac59075b964b07152d234b70', 3, 1),
(2, '20551067', 'Juan', 'Romero', 'jromero@vtelca.gob.ve', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(3, '11784366', 'Orlando', 'Chirinos', 'chirinoso@vtelca.gob.ve', 'e10adc3949ba59abbe56e057f20f883e', 5, 1),
(20, '17310357', 'Ysabel', 'Zarraga', 'yzarraga@vtelca.gob.ve', '5fb37f5652dcd3cdf39745813b60c37b', 1, 1),
(21, '19058760', 'Adriana', 'Mata', 'amata@vtelca.gob.ve', 'f7da6bb62d527153c77441a0a444c214', 1, 1),
(22, '20296572', 'Pedro', 'Lugo', 'plugo@vtelca.gob.ve', 'a6d7fb66f6af9823668940beb1426337', 1, 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `agencias`
--
ALTER TABLE `agencias`
  ADD CONSTRAINT `agencias_ibfk_1` FOREIGN KEY (`agencia_id`) REFERENCES `agencias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalles_inventario`
--
ALTER TABLE `detalles_inventario`
  ADD CONSTRAINT `detalles_inventario_ibfk_1` FOREIGN KEY (`inventario_id`) REFERENCES `inventario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalles_inventario_ibfk_2` FOREIGN KEY (`modelo_id`) REFERENCES `modelos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD CONSTRAINT `equipos_ibfk_1` FOREIGN KEY (`solicitante_id`) REFERENCES `solicitantes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `equipos_ibfk_2` FOREIGN KEY (`modelo_id`) REFERENCES `modelos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `equipos_ibfk_3` FOREIGN KEY (`color_id`) REFERENCES `colores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `equipos_ibfk_4` FOREIGN KEY (`tecnologia_id`) REFERENCES `tecnologias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `equipos_ibfk_5` FOREIGN KEY (`operadora_id`) REFERENCES `operadoras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`tipo_producto_id`) REFERENCES `tipos_productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `seguimientos`
--
ALTER TABLE `seguimientos`
  ADD CONSTRAINT `seguimientos_ibfk_1` FOREIGN KEY (`tipo_estado_id`) REFERENCES `tipos_estados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seguimientos_ibfk_2` FOREIGN KEY (`solicitudes_accesorios_id`) REFERENCES `solicitudes_accesorios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
