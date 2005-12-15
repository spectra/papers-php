<?

class Avaliacoes {

  /* Calculo do escore padrao
     Conforme
     http://twiki.softwarelivre.org/bin/view/Fisl7/ClassificaçãoDasPropostas
  */

  function _n_propostas_por_trilha($db, $trilha) {
    $sql = "
        select COUNT(*)
        from `propostas`
        where tema = '$trilha'
        ";
    $count = $db->conn->GetOne($sql);
    return $count;
  }

  function _n_por_avaliador_por_trilha($db, $trilha, $avaliador) {
    $sql = "
        select COUNT(*)
        from `avaliacoes`
        join propostas on avaliacoes.proposta = propostas.cod
        where propostas.tema = '$trilha'
          and avaliacoes.avaliador = '$avaliador'
        ";
    $count = $db->conn->CacheGetOne($sql);
    return $count;
  }

  function _incluidas_por_trilha($db, $trilha) {
    $completas = Array();
    $n_avaliacoes = Array();
    $n_propostas = _n_propostas_por_trilha($db, $trilha);

    $sql = "
        select
          proposta,
          avaliador,
          (confianca * recomendacao * ((relevancia * 0.2) + (qualidade * 0.5) + (experiencia * 0.3)) ) as escore_composto
        from `avaliacoes`
        join propostas on avaliacoes.proposta = propostas.cod
        where propostas.tema = '$trilha'
        ";
    $rs = $db->conn->Execute($sql);
    $avaliacoes = $rs->GetArray();

    # O avaliador avaliou completamente a proposta?
    foreach($avaliacoes as $avaliacao) {
      if (_n_por_avaliador_por_trilha($db, $trilha, $avaliacao['avaliador']) == $n_propostas) {
        $completas[] = $avaliacao;
      }
    }

    return $completas;
  }

  function _escore_medio_por_proposta($incluidas, $proposta) {
    $counter = 0;
    $sum = 0;
    foreach($incluidas as $avaliacao) {
      if ($avaliacao['proposta'] == $proposta) {
        $sum += $avaliacao['escore_composto'];
        $counter += 1;
      }
    }
    return ($sum / $counter);
  }

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
