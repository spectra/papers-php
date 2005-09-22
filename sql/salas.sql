create table salas (
  numero int unsigned not null,
  descricao char(30) not null,
  detalhes text,
  -- chave primária:
  primary key (numero)
);
