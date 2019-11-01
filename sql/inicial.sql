-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 23-10-2018 a las 15:58:19
-- Versión del servidor: 5.7.22
-- Versión de PHP: 7.1.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `omega_framework`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenido`
--

CREATE TABLE `contenido` (
  `contenido_id` int(255) NOT NULL,
  `contenido_seccion` int(255) DEFAULT NULL,
  `contenido_tipo` int(255) DEFAULT NULL,
  `contenido_padre` int(255) DEFAULT NULL,
  `contenido_columna_alineacion` int(11) DEFAULT NULL,
  `contenido_columna` varchar(255) DEFAULT NULL,
  `contenido_columna_espacios` int(11) DEFAULT NULL,
  `contenido_disenio` int(11) DEFAULT NULL,
  `contenido_borde` int(11) DEFAULT NULL,
  `contenido_estado` int(11) DEFAULT NULL,
  `contenido_fecha` date DEFAULT NULL,
  `contenido_titulo` varchar(500) DEFAULT NULL,
  `contenido_titulo_ver` int(11) DEFAULT NULL,
  `contenido_imagen` varchar(500) DEFAULT NULL,
  `contenido_fondo_imagen` varchar(50) DEFAULT NULL,
  `contenido_fondo_imagen_tipo` int(11) DEFAULT NULL,
  `contenido_fondo_color` varchar(100) DEFAULT NULL,
  `contenido_introduccion` text,
  `contenido_descripcion` text,
  `contenido_enlace` varchar(500) DEFAULT NULL,
  `contenido_enlace_abrir` int(11) DEFAULT NULL,
  `contenido_vermas` varchar(100) DEFAULT NULL,
  `orden` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `info_pagina`
--

CREATE TABLE `info_pagina` (
  `info_pagina_id` bigint(20) NOT NULL,
  `info_pagina_facebook` varchar(255) DEFAULT NULL,
  `info_pagina_instagram` varchar(255) DEFAULT NULL,
  `info_pagina_twitter` varchar(255) DEFAULT NULL,
  `info_pagina_pinterest` varchar(255) DEFAULT NULL,
  `info_pagina_youtube` varchar(255) DEFAULT NULL,
  `info_pagina_flickr` varchar(255) DEFAULT NULL,
  `info_pagina_linkedin` varchar(255) DEFAULT NULL,
  `info_pagina_google` varchar(255) DEFAULT NULL,
  `info_pagina_telefono` varchar(255) DEFAULT NULL,
  `info_pagina_whatsapp` varchar(255) DEFAULT NULL,
  `info_pagina_correos_contacto` varchar(255) DEFAULT NULL,
  `info_pagina_direccion_contacto` text,
  `info_pagina_informacion_contacto` text,
  `info_pagina_informacion_contacto_footer` text,
  `info_pagina_latitud` varchar(255) DEFAULT NULL,
  `info_pagina_longitud` varchar(255) DEFAULT NULL,
  `info_pagina_zoom` varchar(255) DEFAULT NULL,
  `info_pagina_descripcion` text,
  `info_pagina_tags` text,
  `info_pagina_robot` varchar(500) DEFAULT NULL,
  `info_pagina_sitemap` varchar(500) DEFAULT NULL,
  `info_pagina_scripts` text,
  `info_pagina_metricas` text,
  `orden` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `info_pagina`
--

INSERT INTO `info_pagina` (`info_pagina_id`, `info_pagina_facebook`, `info_pagina_instagram`, `info_pagina_twitter`, `info_pagina_pinterest`, `info_pagina_youtube`, `info_pagina_flickr`, `info_pagina_linkedin`, `info_pagina_google`, `info_pagina_telefono`, `info_pagina_whatsapp`, `info_pagina_correos_contacto`, `info_pagina_direccion_contacto`, `info_pagina_informacion_contacto`, `info_pagina_informacion_contacto_footer`, `info_pagina_latitud`, `info_pagina_longitud`, `info_pagina_zoom`, `info_pagina_descripcion`, `info_pagina_tags`, `info_pagina_robot`, `info_pagina_sitemap`, `info_pagina_scripts`, `info_pagina_metricas`, `orden`) VALUES
(1, 'https://www.facebook.com/OmegaSolucionesWeb/', 'https://www.instagram.com/omegawebsystems/?hl=es-la', '', '', '', '', '', '', '000000 000000 000000', '(+57) 350 708 7228', 'desarollo4@omegawebsystems.com', 'calle falsa 123', '', '', '4.66001', '-74.0607383', '18', 'esta es la descrupcion qye se pondra para el seo', 'zcxzcxzc', '', '', '<!-- Global site tag (gtag.js) - Google Analytics -->\r\n<script async src=\"https://www.googletagmanager.com/gtag/js?id=UA-123186367-1\"></script>\r\n<script>\r\n  window.dataLayer = window.dataLayer || [];\r\n  function gtag(){dataLayer.push(arguments);}\r\n  gtag(\'js\', new Date());\r\n\r\n  gtag(\'config\', \'UA-123186367-1\');\r\n</script>', 'cxzczx xzczxc . zxcxz', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE `log` (
  `log_id` int(11) NOT NULL,
  `log_usuario` varchar(50) DEFAULT NULL,
  `log_tipo` varchar(50) DEFAULT NULL,
  `log_fecha` datetime DEFAULT NULL,
  `log_log` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicidad`
--

CREATE TABLE `publicidad` (
  `publicidad_id` int(11) NOT NULL,
  `publicidad_seccion` int(255) DEFAULT NULL,
  `publicidad_nombre` varchar(500) DEFAULT NULL,
  `publicidad_fecha` date DEFAULT NULL,
  `publicidad_imagen` varchar(500) DEFAULT NULL,
  `publicidad_color_fondo` varchar(255) DEFAULT NULL,
  `publicidad_video` text,
  `publicidad_posicion` varchar(255) DEFAULT NULL,
  `publicidad_descripcion` text,
  `publicidad_estado` int(11) DEFAULT NULL,
  `publicidad_click` int(255) DEFAULT NULL,
  `publicidad_enlace` varchar(500) DEFAULT NULL,
  `publicidad_tipo_enlace` int(11) DEFAULT NULL,
  `publicidad_texto_enlace` varchar(255) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `user_id` bigint(20) NOT NULL,
  `user_date` date DEFAULT NULL,
  `user_names` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_level` int(11) DEFAULT NULL,
  `user_state` int(11) DEFAULT NULL,
  `user_user` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_current_user` bigint(20) DEFAULT NULL,
  `user_code` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`user_id`, `user_date`, `user_names`, `user_email`, `user_level`, `user_state`, `user_user`, `user_password`, `user_delete`, `user_current_user`, `user_code`) VALUES
(1, '2018-07-17', 'Administrador', 'gerencia@omegawebsystems.com', 1, 1, 'admin', '$2y$10$VeJHNcqUyreZxgoDzdfzc./.iBnzrBnqlYD47RaCW7IT0FHGvF3yG', 1, 1, '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contenido`
--
ALTER TABLE `contenido`
  ADD PRIMARY KEY (`contenido_id`);

--
-- Indices de la tabla `info_pagina`
--
ALTER TABLE `info_pagina`
  ADD PRIMARY KEY (`info_pagina_id`);

--
-- Indices de la tabla `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indices de la tabla `publicidad`
--
ALTER TABLE `publicidad`
  ADD PRIMARY KEY (`publicidad_id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contenido`
--
ALTER TABLE `contenido`
  MODIFY `contenido_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `info_pagina`
--
ALTER TABLE `info_pagina`
  MODIFY `info_pagina_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `log`
--
ALTER TABLE `log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `publicidad`
--
ALTER TABLE `publicidad`
  MODIFY `publicidad_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
