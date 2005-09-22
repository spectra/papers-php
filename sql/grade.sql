create table grade (
  dia int not null,
  sala int not null,
  horario int not null,
  proposta int(10) unsigned not null,
  -- chave primária:
  primary key (dia,sala,horario)
);
