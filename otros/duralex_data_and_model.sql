/*
SQLyog - Free MySQL GUI v5.11
Host - 5.6.17 : Database - duralex
*********************************************************************
Server version : 5.6.17
*/

SET NAMES utf8;

SET SQL_MODE='';

create database if not exists `duralex`;

USE `duralex`;

/*Table structure for table `client` */

DROP TABLE IF EXISTS `client`;

CREATE TABLE `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rut` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `admission_date` date NOT NULL,
  `person_type` char(1) NOT NULL,
  `address` varchar(128) NOT NULL,
  `phone` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `client` */

insert into `client` (`id`,`rut`,`name`,`admission_date`,`person_type`,`address`,`phone`) values (1,17249381,'JosÃ© Luis Cariqueo','2017-07-11','N','c4db5d9776552ada1760b42b06d94d84',79685745),(2,15959653,'Juan Morales','2017-07-11','J','64e222ffe5427a207545e3597fde9925',79685755),(3,19179787,'Eliana JerÃ©z','2017-07-11','N','f92990c9038954b813bc88a1d3f2d5ed',79685777),(4,23581642,'MÃ³nica RodrÃ­guez','2017-07-11','J','c29fd01ccd8d079c3564e7374f7bb8bc',79685774);


/*Table structure for table `specialty` */

DROP TABLE IF EXISTS `specialty`;

CREATE TABLE `specialty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `specialty` */

insert into `specialty` (`id`,`name`) values (1,'Accidente'),(2,'Blanqueo de capitales'),(3,'Constitucional'),(4,'Consumidores y Usuarios'),(5,'Defensor'),(6,'Familia'),(7,'Penal');

/*Table structure for table `status` */

DROP TABLE IF EXISTS `status`;

CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `status` */

insert into `status` (`id`,`description`) values (1,'Agendada'),(2,'Anulada'),(3,'Confirmada'),(4,'Perdida'),(5,'Realizada');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rut` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `user` */

insert into `user` (`id`,`rut`,`name`,`password`,`role`) values (1,12111111,'Pablo Vargas','5f4dcc3b5aa765d61d8327deb882cf99',0),(2,11111111,'Alexis Veas','5f4dcc3b5aa765d61d8327deb882cf99',2),(3,18467768,'Carol Wilson','5f4dcc3b5aa765d61d8327deb882cf99',3),(4,17249381,'JosÃ© Luis Cariqueo','5f4dcc3b5aa765d61d8327deb882cf99',1);

/*Table structure for table `lawyer` */

DROP TABLE IF EXISTS `lawyer`;

CREATE TABLE `lawyer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rut` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `hire_date` date NOT NULL,
  `specialty_id` int(11) NOT NULL,
  `hour_value` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_lawyer` (`specialty_id`),
  CONSTRAINT `lawyer_ibfk_1` FOREIGN KEY (`specialty_id`) REFERENCES `specialty` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `lawyer` */

insert into `lawyer` (`id`,`rut`,`name`,`hire_date`,`specialty_id`,`hour_value`) values (1,17249381,'Kevin Zuta','2017-07-11',2,30000),(2,19230630,'Raimundo Soto','2017-07-11',7,60000),(3,18467768,'Matthew Scheihing','2017-07-11',4,50000);


/*Table structure for table `attention` */

DROP TABLE IF EXISTS `attention`;

CREATE TABLE `attention` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `client_id` int(11) NOT NULL,
  `lawyer_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_attention1` (`status_id`),
  KEY `FK_attention2` (`client_id`),
  KEY `FK_attention3` (`lawyer_id`),
  CONSTRAINT `attention_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `attention_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `attention_ibfk_3` FOREIGN KEY (`lawyer_id`) REFERENCES `lawyer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `attention` */

insert into `attention` (`id`,`date`,`client_id`,`lawyer_id`,`status_id`) values (1,'2017-07-28',2,1,1),(2,'2017-07-11',1,2,1),(3,'2017-05-05',4,3,5),(4,'2017-07-12',3,2,2);
