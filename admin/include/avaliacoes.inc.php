<?

class Avaliacoes {

  /* Calculo do escore composto (score)

     parametros:  confianca     1.0, 1.5, 2.0
                  recomendacao  1.0, 1.5, 1.75, 2.0
                  relevancia    1, 2, 3, 4, 5
                  qualidade     1, 2, 3, 4, 5
                  experiencia   1, 2, 3, 4, 5

     e_bruto = (relevancia * 0.5) + (qualidade * 0.25) + (experiencia * 0.25)

     score = (confianca * recomendacao * e_bruto)

     Conforme: http://twiki.softwarelivre.org/bin/view/Fisl6/Crit%E9rioDeJulgamento

  */

  function ranking($db, $macrotema) {
    $sql = "
        select
          proposta as cod,
          titulo,
          pessoas.nome as autor,
          avg(confianca * recomendacao *
              ((relevancia * 0.5 ) +
               (qualidade * 0.25 ) +
               (experiencia * 0.25 )
               )
              ) as score,
          propostas.status as status
          from avaliacoes
          join propostas on avaliacoes.proposta = propostas.cod
          join pessoas on propostas.pessoa = pessoas.cod
          where propostas.tema = $macrotema
                and propostas.status = 'i'
          group by proposta
          order by score desc
          ";
    $rs = $db->conn->Execute($sql);
    return $rs->GetArray();
  }

  function ranking_todas($db, $macrotema) {
    $sql = "
        select
          proposta as cod,
          titulo,
          pessoas.nome as autor,
          avg(confianca * recomendacao *
              ((relevancia * 0.5 ) +
               (qualidade * 0.25 ) +
               (experiencia * 0.25 )
               )
              ) as score,
          propostas.status as status
          from avaliacoes
          join propostas on avaliacoes.proposta = propostas.cod
          join pessoas on propostas.pessoa = pessoas.cod
          where propostas.tema = $macrotema
          group by proposta
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
