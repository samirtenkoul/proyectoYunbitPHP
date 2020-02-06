DROP TABLE IF EXISTS `autorizados`;
CREATE TABLE `autorizados` (
  `usuario` varchar(25) NOT NULL,
  `contrasenia` varchar(32) NOT NULL,
  `correo` varchar(25) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `apellidos` varchar(70) NOT NULL,
  PRIMARY KEY (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `autorizados` (`usuario`, `contrasenia`, `correo`, `nombre`, `apellidos`) VALUES
('admin', 'admin', 'admin@admin.com', 'Boss', 'Super Boss'),
('jose', 'jose', 'jose@empresa.com', 'Ana', 'Jose Cruz'),
('ana', 'ana', 'ana@gmail.com', 'Ana', 'García González');



DROP TABLE IF EXISTS  clientes;
CREATE TABLE clientes (
  id int auto_increment NOT NULL,
  nombre varchar(255) NOT NULL,
  direccion varchar(255) NOT NULL,
  telf varchar(20) NOT NULL,
  foto varchar(255) NOT NULL,
  tipo char(1) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



