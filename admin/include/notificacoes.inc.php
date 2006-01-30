<?

class Notificacoes {

  function _load($db, $status, $extraCond="") {
    $sql = "select
              propostas.cod as cod,
              propostas.titulo as title,
              pessoas.cod as pcod,
              pessoas.nome as name,
              pessoas.email as email,
              propostas.idioma as language
            from
              propostas
              join pessoas on propostas.pessoa = pessoas.cod
            where
              propostas.status in $status
              $extraCond
              
            union

            select
              propostas.cod as cod,
              propostas.titulo as title,
              pessoas.cod as pcod,
              pessoas.nome as name,
              pessoas.email as email,
              propostas.idioma as language
            from
              propostas
              join copalestrantes on copalestrantes.proposta = propostas.cod
              join pessoas on copalestrantes.pessoa = pessoas.cod
            where
              propostas.status in $status
              $extraCond
              
              ";
    $rs = $db->conn->Execute($sql);
    return $rs->GetArray();
  }

  function aprovadas($db) {
    return Notificacoes::_load($db,"('a','p')","and tipo = 's'");
  }

  function recusadas($db) {
    return Notificacoes::_load($db,"('r')", "and tipo = 's'");
  }

  function aceitas_nao_confirmadas($db) {
    return Notificacoes::_load($db, "('a','p')", "and tipo = 's' and ISNULL(propostas.confirmada)");
  }
  
  function convidados($db) {
    $sql = "select
              propostas.cod as cod,
              propostas.titulo as title,
              pessoas.cod as pcod,
              pessoas.nome as name,
              pessoas.email as email,
              propostas.idioma as language,
              count(copalestrantes.proposta)
            from
              propostas
              join pessoas on propostas.pessoa = pessoas.cod
              left outer join copalestrantes on (propostas.cod = copalestrantes.proposta)
            where
              propostas.tipo in ('c','v','p')
              and propostas.confirmada is null
              group by propostas.cod
              having count(copalestrantes.proposta) = 0
              ";
    $rs = $db->conn->Execute($sql);
    return $rs->GetArray();
  }

}

?>
