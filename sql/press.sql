create table press (
cod int(10) unsigned not null auto_increment,
nome varchar(50) not null,
veiculo varchar(50) not null,
cargo varchar(30),
registro_profissional varchar(30),
endereco_profissional varchar(100),
pais varchar(30) not null,
estado varchar(30) not null,
cidade varchar(30) not null,
email varchar(50) not null,
moderado int(1) not null default 0,
primary key (cod)
);
