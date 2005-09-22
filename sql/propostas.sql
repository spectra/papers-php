-- MySQL dump 9.09
--
-- Host: localhost    Database: papers
-- ------------------------------------------------------
-- Server version	4.0.16-log

--
-- Table structure for table `propostas`
--

CREATE TABLE propostas (
  cod int(10) unsigned NOT NULL auto_increment,
  tstamp timestamp(14) NOT NULL,
  dthora datetime NOT NULL default '0000-00-00 00:00:00',
  titulo varchar(200) NOT NULL default '',
  descricao text NOT NULL,
  tema int(10) unsigned NOT NULL default '0',
  pessoa int(10) unsigned NOT NULL default '0',
  publicoalvo text NOT NULL,
  comentarios text,
  coapresentadores text,
  resumo text NOT NULL,
  browser varchar(255) default NULL,
  ip_proxy varchar(15) default NULL,
  idioma char(2) NOT NULL default '',
  ip varchar(15) default NULL,
  status enum('i','a','r','d','p','c') NOT NULL default 'i',
  espaco int(10) unsigned default NULL,
  comadm text,
  aprovado tinyint(4) default NULL,
  autoriza_video tinyint(4) default NULL,
  confirmada tinyint(4) default NULL,
  score float default NULL,
  PRIMARY KEY  (cod),
  UNIQUE KEY espaco (espaco),
  KEY tema (tema),
  KEY pessoa (pessoa),
  KEY dthora (dthora),
  KEY idioma (idioma),
  KEY status (status)
) TYPE=MyISAM;

