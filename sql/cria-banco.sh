#!/bin/sh

TABELAS="avaliacoes.sql
copalestrantes.sql
dias.sql
grade.sql
horarios.sql
macrotemas.sql
mesa.sql
pessoas.sql
press.sql
propostas.sql
salas.sql
"

for each in $TABELAS
do
  cat $each
done
