/*
SQLyog - Free MySQL GUI v5.11
Host - 5.7.14 : Database - duralex
*********************************************************************
Server version : 5.7.14
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `client` */

/*Table structure for table `specialty` */

DROP TABLE IF EXISTS `specialty`;

CREATE TABLE `specialty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `specialty` */

insert into `specialty` (`id`,`name`) values (1,'Accidente');
insert into `specialty` (`id`,`name`) values (2,'Carcel');
insert into `specialty` (`id`,`name`) values (3,'Familia');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `lawyer` */

/*Table structure for table `status` */

DROP TABLE IF EXISTS `status`;

CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `status` */

insert into `status` (`id`,`description`) values (1,'Agendada');
insert into `status` (`id`,`description`) values (2,'Anulada');
insert into `status` (`id`,`description`) values (3,'Confirmada');
insert into `status` (`id`,`description`) values (4,'Perdida');
insert into `status` (`id`,`description`) values (5,'Realizada');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rut` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `user` */

insert into `user` (`id`,`rut`,`name`,`password`,`role`) values (1,18467768,'Matthew Scheihing','5f4dcc3b5aa765d61d8327deb882cf99',0);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `attention` */