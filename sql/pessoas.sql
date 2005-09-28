-- MySQL dump 9.09
--
-- Host: localhost    Database: papers
-- ------------------------------------------------------
-- Server version	4.0.16-log

--
-- Table structure for table `pessoas`
--

CREATE TABLE pessoas (
  cod int(10) unsigned NOT NULL auto_increment,
  tstamp timestamp(14) NOT NULL,
  dthora datetime NOT NULL default '0000-00-00 00:00:00',
  nome varchar(50) NOT NULL default '',
  email varchar(50) NOT NULL default '',
  passwd varchar(64) default NULL,
  org varchar(50) default NULL,
  cidade varchar(30) default NULL,
  estado varchar(30) default NULL,
  pais varchar(30) default NULL,
  fone varchar(30) default NULL,
  rg varchar(15) default NULL,
  rg_orgao varchar(15) default NULL,
  cpf varchar(11) default NULL,
  passaporte varchar(30) default NULL,
  coment text,
  fotourl varchar(255) default NULL,
  biografia text,
  sexo enum('m','f') not null default 'm',
  nickname varchar(30),
  comentadm text,
  status enum('i','a','r','d','p') NOT NULL default 'i',
  pago tinyint(3) unsigned NOT NULL default '0',
  vl_viagem float unsigned NOT NULL default '0',
  vl_hotel float unsigned NOT NULL default '0',
  vl_alimen float unsigned NOT NULL default '0',
  vl_outros float NOT NULL default '0',
  PRIMARY KEY  (cod),
  UNIQUE KEY email (email),
  KEY nome (nome),
  KEY status (status),
  KEY pago (pago)
) TYPE=MyISAM;

