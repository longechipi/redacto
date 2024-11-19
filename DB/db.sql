CREATE TABLE `users` (
  `id_user` int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL UNIQUE,
  `correo` varchar(100) NOT NULL UNIQUE,
  `telefono` varchar(100) NULL,
  `clave` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP()
);
INSERT INTO users(nombre, apellido, usuario, correo, telefono, clave)
VALUES('JEAN', 'CASTILLO', 'castilloacostajean@gmail.com', 'castilloacostajean@gmail.com', '04242974834', 
'$2y$10$6uHKeRwjOaqRnEQzXXkzle9WU3KHD0KR2NHZEcrEDvtk7X/rs/W5m')
---------------------------------------------------------------------------
CREATE TABLE `estatus` (
  `id_sta` int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `nom_sta` varchar(50) NOT NULL
);
INSERT INTO estatus (nom_sta)VALUES('INACTIVO')
---------------------------------------------------------------------------
CREATE TABLE `privilegios` (
  `id_pri` int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `nom_pri` varchar(50) NOT NULL,
  `id_sta` int NOT NULL,
  FOREIGN KEY (`id_sta`) REFERENCES `estatus` (`id_sta`)
);
INSERT INTO privilegios(nom_pri, id_sta)VALUES('ADMINISTRADOR', 1)
---------------------------------------------------------------------------
CREATE TABLE `users_privilegios` (
  `id_upri` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_pri` int NOT NULL,
  PRIMARY KEY (`id_upri`),
  FOREIGN KEY (`id_user`) REFERENCES `users`(`id_user`),
  FOREIGN KEY (`id_pri`) REFERENCES `privilegios`(`id_pri`)
);
INSERT INTO users_privilegios(id_user, id_pri)VALUES(1, 1)
---------------------------------------------------------------------------
CREATE TABLE `users_status` (
  `id_usta` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_sta` int NOT NULL,
  PRIMARY KEY (`id_usta`, `id_user`),
  FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  FOREIGN KEY (`id_sta`) REFERENCES `estatus` (`id_sta`)
);
INSERT INTO users_status(id_user, id_sta)VALUES(1, 1)

---------------------------------------------------------------------------
CREATE TABLE `tipo_persona` (
  `id_per` int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `tip_per` varchar(50) NOT NULL,
  `id_sta` int NOT NULL,
  FOREIGN KEY (`id_sta`) REFERENCES `estatus` (`id_sta`)
);
---------------------------------------------------------------------------
CREATE TABLE `per_natural` (
  `id_nat` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `tip_per` int NOT NULL,
  `nombre1` varchar(50) NOT NULL,
  `nombre2` varchar(50) NULL,
  `apellido1` varchar(50) NOT NULL,
  `apellido2` varchar(50) NULL,
  `nac` varchar(1) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `civil` varchar(20) NOT NULL,
  `nom_conyuge` varchar(50) NOT NULL,
  `apel_conyuge` varchar(50) NOT NULL,
  `cedula_conyuge` varchar(10) NOT NULL,
  `id_sta` int NOT NULL,
  FOREIGN KEY (`id_sta`) REFERENCES `estatus` (`id_sta`),
  FOREIGN KEY (`id_user`) REFERENCES `users`(`id_user`)
);
---------------------------------------------------------------------------
CREATE TABLE `per_juridico` (
  `id_jur` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `tip_per` int NOT NULL,
  `nom_empresa` varchar(200) NOT NULL,
  `rif` varchar(50) NOT NULL,
  `fec_registro` DATE NOT NULL,
  `nom_registro` varchar(200) NULL,
  `tomo` varchar(50) NOT NULL,
  `nro` varchar(50) NOT NULL,
  `protocolo` varchar(50) NOT NULL,
  `expediente` varchar(50) NOT NULL,
  `id_sta` int NOT NULL,
  FOREIGN KEY (`id_sta`) REFERENCES `estatus` (`id_sta`),
  FOREIGN KEY (`id_user`) REFERENCES `users`(`id_user`)
);
---------------------------------------------------------------------------
CREATE TABLE `per_sucesion` (
  `id_suc` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `tip_per` int NOT NULL,
  `nom_sucesion` varchar(200) NOT NULL,
  `rif` varchar(50) NOT NULL,
  `certi_solv` varchar(200) NULL,
  `id_sta` int NOT NULL,
  FOREIGN KEY (`id_sta`) REFERENCES `estatus` (`id_sta`),
  FOREIGN KEY (`id_user`) REFERENCES `users`(`id_user`)
);
---------------------------------------------------------------------------
CREATE TABLE `vehiculo_venta` (
  `id_ven` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `reg_vehiculo` varchar(200) NOT NULL,
  `fec_certi` DATE NOT NULL,
  `clase` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `anio` int NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `placa` varchar(50) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `uso` varchar(50) NOT NULL,
  `serial_carro` varchar(50) NOT NULL,
  `serial_motor` varchar(50) NOT NULL,
  `id_sta` int NOT NULL,
  FOREIGN KEY (`id_sta`) REFERENCES `estatus` (`id_sta`),
  FOREIGN KEY (`id_user`) REFERENCES `users`(`id_user`)
);
---------------------------------------------------------------------------
CREATE TABLE `forma_pago` (
  `id_pag` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `tip_pago` varchar(50) NOT NULL,
  `id_sta` int NOT NULL,
  FOREIGN KEY (`id_sta`) REFERENCES `estatus` (`id_sta`)
);
INSERT forma_pago(tip_pago, id_sta)VALUES('TRANSFERENCIA', 1)
---------------------------------------------------------------------------
CREATE TABLE `banco` (
  `id_ban` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `banco` int NOT NULL,
  `id_sta` int NOT NULL,
  FOREIGN KEY (`id_sta`) REFERENCES `estatus` (`id_sta`)
);
---------------------------------------------------------------------------
CREATE TABLE `importe_venta` (
  `id_imp` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_ven` int NOT NULL,
  `id_user` int NOT NULL,
  `id_pag` int NOT NULL,
  `banco` int NOT NULL,
  `titular_cuenta` varchar(100) NULL,
  `referencia` varchar(100) NULL,
  `cheque` varchar(100) NULL,
  `nro_cuenta` varchar(20) NULL,
  `capture` varchar(100) NULL,
  `id_sta` int NOT NULL,
  FOREIGN KEY (`id_ven`) REFERENCES `vehiculo_venta` (`id_ven`),
  FOREIGN KEY (`id_user`) REFERENCES `users`(`id_user`),
  FOREIGN KEY (`id_pag`) REFERENCES `forma_pago` (`id_pag`),
  FOREIGN KEY (`id_sta`) REFERENCES `estatus` (`id_sta`)
  
);
---------------------------------------------------------------------------
CREATE TABLE `correlativo` (
  `est` varchar(2) NOT NULL,
  `cod` int NOT NULL,
  `anio` int NOT NULL 
);
---------------------------------------------------------------------------
CREATE TABLE `tasa` (
  `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `moneda` varchar(3) NOT NULL,
  `fecha` DATE NOT NULL,
  `valor` varchar(10) NOT NULL
);