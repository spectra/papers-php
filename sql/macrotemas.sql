-- MySQL dump 9.09
--
-- Host: localhost    Database: papers
-- ------------------------------------------------------
-- Server version	4.0.16-log

--
-- Table structure for table `macrotemas`
--

CREATE TABLE macrotemas (
  cod int(10) unsigned NOT NULL auto_increment,
  tstamp timestamp(14) NOT NULL,
  titulo varchar(40) default NULL,
  titulo_en varchar(40) default NULL,
  descr text,
  descr_en text,
  espacos int not null default 0,
  PRIMARY KEY  (cod)
) TYPE=MyISAM;

--
-- Dumping data for table `macrotemas`
--

INSERT INTO macrotemas (cod, tstamp, titulo, titulo_en, descr, descr_en) VALUES (1,20040202190512,'Desenvolvimento','Development','Este tema engloba: linguagens de programação, ferramentas de desenvolvimento, linguagens de script, etc.','This theme includes: program languages, development tools, script languages, etc.');
INSERT INTO macrotemas (cod, tstamp, titulo, titulo_en, descr, descr_en) VALUES (2,20040202193214,'Bancos de Dados','Databases','Questões gerais sobre bancos de dados, comparativos, PostgreSQL, MySQL, Firebird, etc.','General issues about databases, like PostgreSQL, MySQL, Firebird, among others.');
INSERT INTO macrotemas (cod, tstamp, titulo, titulo_en, descr, descr_en) VALUES (3,20040202193346,'Desktop','Desktop','Este tema engloba softwares destinados à uso em desktop ex. gnome, openoffice.org, evolution, kde, blwm, windowmaker, mozilla, etc.','This theme includes softwares and projects to desktops, like Gnome, OpenOffice.org, KDE, Mozilla, among others.');
INSERT INTO macrotemas (cod, tstamp, titulo, titulo_en, descr, descr_en) VALUES (4,20040202193519,'Redes','Network','Serviços de rede como qmail, postfix, ldap, radius, monitoração, apache, tomcat, etc.','Network stuff, like Qmail, Postfix, LDAP, Radius, monitoring, servers, routing, etc.');
INSERT INTO macrotemas (cod, tstamp, titulo, titulo_en, descr, descr_en) VALUES (5,20040202193612,'Segurança','Security','Ferramentas de segurança, firewall, sistemas de detecção de intrusos, política de segurança de sistemas, etc.','Security tools, firewall, intrusion detection, policies, crypto, etc.');
INSERT INTO macrotemas (cod, tstamp, titulo, titulo_en, descr, descr_en) VALUES (6,20040202193816,'Cases','Cases','Apresentação de projetos que usaram software livre, migrações, ex: telecentros, migração da empresa X, etc.','Presentations of successful works where free software has been used, like migrations, etc.');
INSERT INTO macrotemas (cod, tstamp, titulo, titulo_en, descr, descr_en) VALUES (7,20040202194132,'Comunidade','Community','Projetos sociais relacionados à comunidade de software livre, como ONGs, grupos de usuários, etc.','Social projects linked to the free software community, like NGOs, users groups, etc.');
INSERT INTO macrotemas (cod, tstamp, titulo, titulo_en, descr, descr_en) VALUES (8,20040202194812,'Governos','Governments','Casos governamentais de implementação e uso de software livre, projetos de lei, plano de migração, estratégias e decisões de governos sobre o software livre.','Government cases about free software implementation, projects of laws, migration plans, strategies and decisions about free software.');
INSERT INTO macrotemas (cod, tstamp, titulo, titulo_en, descr, descr_en) VALUES (9,20040202195606,'Política / Filosofia','Politics / Philosophy','Questões políticas e filosóficas em torno de software livre, como licenciamento, discussões não-técnicas, vantagens no uso do software livre, etc.','Political and philosophical issues around free software, like licensing, non-technical talks, advantages with the free software use, etc.');
INSERT INTO macrotemas (cod, tstamp, titulo, titulo_en, descr, descr_en) VALUES (10,20040202195731,'Inclusão Social / Digital','Digital / Social Inclusion','Temas relacionados à inclusão social e inclusão digital: mulheres e software livre, software livre e inclusão digital, etc.','Talks linked to digital and social inclusion, like free software and women, tele-centers, etc.');
INSERT INTO macrotemas (cod, tstamp, titulo, titulo_en, descr, descr_en) VALUES (11,20050508224900,'Organização','Organization','Espaço reservado à organização do evento','Space reserved to the event\'s organization');

