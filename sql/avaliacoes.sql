create table avaliacoes (
  proposta int(10) unsigned not null,
  avaliador char(16) not null,
  confianca float not null,
  relevancia int not null,
  qualidade int not null,
  experiencia int not null,
  recomendacao float not null,
  comentarios_autor text,
  comentarios_comite text,
  -- chave primária:
  primary key (proposta,avaliador)
);
