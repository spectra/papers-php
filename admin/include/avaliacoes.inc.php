<?

class Avaliacoes {

  /* Calculo do escore: veja
     http://twiki.softwarelivre.org/bin/view/Fisl7/Classifica%e7%e3oDasPropostas
     para detalhes.
  */

  function media_e_desvio($db, $macrotema) {
    $sql = "
select
  avg(a1.confianca * a1.recomendacao *
      (a1.relevancia * 0.2 + a1.qualidade * 0.5 + a1.experiencia * 0.3 )) as average,
  stddev(a1.confianca * a1.recomendacao *
      (a1.relevancia * 0.2 + a1.qualidade * 0.5 + a1.experiencia * 0.3 )) as standard_deviation
from avaliacoes a1
     join propostas p1 on p1.cod = a1.proposta
     join pessoas pe1 on pe1.cod = p1.pessoa
where p1.tema = $macrotema and
      p1.tipo = 's' and
      p1.status in ('p','a','i','r') and
      (select count(*)
       from avaliacoes
            join propostas p2 on p2.cod = avaliacoes.proposta
       where p2.tema = p1.tema and
             p2.tipo = 's' and
             p2.status in ('p','a','i','r') and
             avaliador = a1.avaliador
       )
       =
       (select count(*)
        from propostas p3
        where p3.tema = p1.tema and
              p3.tipo = 's' and
              p3.status in ('p','a','i','r')
       )
";

    $rs= $db->conn->Execute($sql);
    $rsa = $rs->GetArray();
    $avg = $rsa[0]['average'];
    $stddev = $rsa[0]['standard_deviation'];
    return array($avg, $stddev);
  }

  function ranking($db, $macrotema) {
    
    $md = Avaliacoes::media_e_desvio($db, $macrotema);
    $avg = $md[0];
    $stddev = $md[1];

    $sql = "
select
  a1.proposta as cod,
  p1.titulo as titulo,
  pe1.nome as autor,
  (((avg( a1.confianca * a1.recomendacao *
       (a1.relevancia * 0.2 + a1.qualidade * 0.5 + a1.experiencia * 0.3 )
     ) - $avg ) / $stddev) * 100) + 500 as score
from avaliacoes a1
     join propostas p1 on p1.cod = a1.proposta
     join pessoas pe1 on pe1.cod = p1.pessoa
where p1.tema = $macrotema and
      p1.tipo = 's' and
      p1.status = 'i' and
      (select count(*)
       from avaliacoes
            join propostas p2 on p2.cod = avaliacoes.proposta
       where p2.tema = p1.tema and
             p2.tipo = 's' and
             p2.status in ('p','a','i','r') and
             avaliador = a1.avaliador)
       =
       (select count(*)
        from propostas p3
        where p3.tema = p1.tema and
              p3.tipo = 's' and 
              p3.status in ('p','a','i','r')
       )
group by a1.proposta
order by score desc
";
    $rs = $db->conn->Execute($sql);
    return $rs->GetArray();
  }

  function ranking_todas($db, $macrotema) {

    $md = Avaliacoes::media_e_desvio($db, $macrotema);
    $avg = $md[0];
    $stddev = $md[1];

    $sql = "
select
  a1.proposta as cod,
  p1.titulo as titulo,
  pe1.nome as autor,
  (avg( a1.confianca * a1.recomendacao *
       (a1.relevancia * 0.2 + a1.qualidade * 0.5 + a1.experiencia * 0.3 )
     ) - $avg ) / $stddev as score
from avaliacoes a1
     join propostas p1 on p1.cod = a1.proposta
     join pessoas pe1 on pe1.cod = p1.pessoa
where p1.tema = $macrotema and
      p1.tipo = 's' and
      p1.status in ('p','a','i','r') and
      (select count(*)
       from avaliacoes
            join propostas p2 on p2.cod = avaliacoes.proposta
       where p2.tema = p1.tema and
             p2.tipo = 's' and
             p2.status in ('p','a','i','r') and
             avaliador = a1.avaliador)
       =
       (select count(*)
        from propostas p3
        where p3.tema = p1.tema and
              p3.tipo = 's' and 
              p3.status in ('p','a','i','r')
       )
group by a1.proposta
order by score desc
";
  
    $rs = $db->conn->Execute($sql);
    return $rs->GetArray();
  }

  function aprovadas($db, $macrotema) {
    $sql = "
        select
          propostas.cod,
          titulo,
          pessoas.nome as autor,
          propostas.score as score,
          propostas.status as status
          from propostas
          join pessoas on propostas.pessoa = pessoas.cod
          where propostas.tema = $macrotema
                and propostas.status in ('p','a')
          order by score desc
          ";
    $rs = $db->conn->Execute($sql);
    return $rs->GetArray();
  }

  function recusadas($db, $macrotema) {
    $sql = "
        select
          propostas.cod,
          titulo,
          pessoas.nome as autor,
          propostas.score as score,
          propostas.status as status
          from propostas
          join pessoas on propostas.pessoa = pessoas.cod
          where propostas.tema = $macrotema
                and propostas.status = 'r'
          order by score desc
          ";
    $rs = $db->conn->Execute($sql);
    return $rs->GetArray();
  }

  /* Retorna a posicao no ranking da proposta

     Recebe: $ranking_array  -- array do macrotema em que eh necessario
                                procurar a proposta
             $proposta       -- codigo da proposta procurada

     Eh uma pena, mas o PHP naum tem um array_search decente. Que
     saudades do Ruby...
  */
  function ranking_position($ranking_array, $proposta) {
    $position = 0;

    while (list($key, $val) = each($ranking_array)) {
      if ($ranking_array[$key]['cod'] == $proposta) {
        $position = $key + 1;
        break;
      }
    }

    return $position;
  }

  function confirmadas($db, $macrotema) {
    $sql = "
        select
          propostas.cod,
          titulo,
          pessoas.nome as autor,
          propostas.score as score,
          propostas.status as status,
          propostas.descricao as descricao,
          propostas.resumo as resumo
          from propostas
          join pessoas on propostas.pessoa = pessoas.cod
          where propostas.tema = $macrotema
                and propostas.confirmada = 1
          order by score desc
          ";
    $rs = $db->conn->Execute($sql);
    return $rs->GetArray();
  }

}

?>
