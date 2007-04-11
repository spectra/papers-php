<?

include("include/mysql.inc.php");
include("include/pessoas.inc.php");

header("Content-Type: text/plain  plain;charset=iso-8859-1");

$mysql = new Mysql;

$sql = "  select
            pessoas.nome,
            pessoas.org,
            pessoas.cidade,
            pessoas.estado,
            pessoas.pais,
            pessoas.email,
            dias.descricao as dia,
            salas.descricao as sala,
            horarios.inicio as horario,
            propostas.titulo as titulo
          from
            pessoas
            join propostas on propostas.pessoa = pessoas.cod
            join grade on grade.proposta = propostas.cod
            join dias on grade.dia = dias.numero
            join horarios on grade.horario = horarios.numero
            join salas on grade.sala = salas.numero
        union
          select
            pessoas.nome,
            pessoas.org,
            pessoas.cidade,
            pessoas.estado,
            pessoas.pais,
            pessoas.email,
            dias.descricao as dia,
            horarios.inicio as horario,
            salas.descricao as sala,
            propostas.titulo as titulo
          from pessoas
            join copalestrantes on pessoas.cod = copalestrantes.pessoa
            join propostas on propostas.cod = copalestrantes.proposta
            join grade on grade.proposta = propostas.cod
            join dias on grade.dia = dias.numero
            join horarios on grade.horario = horarios.numero
            join salas on grade.sala = salas.numero
        order by 1
       ";

$rs = $mysql->conn->Execute($sql);

$palestrantes = $rs->GetArray();

foreach ($palestrantes as $palestrante) {
  extract($palestrante);
  echo "\t$dia\t$sala\t$horario\t$nome\t$titulo\n";
}

?>
