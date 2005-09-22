create table horarios (
  numero int unsigned not null,
  inicio time not null,
  final time not null,
  -- chave primária:
  primary key (numero)
);
