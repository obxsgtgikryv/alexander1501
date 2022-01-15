-- Nombre de la base de datos
CREATE DATABASE IF NOT EXISTS `db_uptnmls`;
USE `db_uptnmls`;


-- Modelo de la tabla
CREATE TABLE IF NOT EXISTS `empleados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) NOT NULL DEFAULT '',
  `Apellido` varchar(50) NOT NULL DEFAULT '',
  `Correo` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;


-- Datos de prueba
INSERT INTO `empleados`
  (`id`, `Nombre`, `Apellido`, `Correo`)
  VALUES
	(1, 'Jane', 'Doe', 'jane@host.com'),
	(2, 'John', 'Doe', 'john1@host.com'),
	(3, 'John', 'John', 'john2@host.com');
