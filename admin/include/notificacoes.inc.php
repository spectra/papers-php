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
              ";
    $rs = $db->conn->Execute($sql);
    return $rs->GetArray();
  }

  function aprovadas($db) {
    return Notificacoes::_load($db,"('a','p')");
  }

  function recusadas($db) {
    return Notificacoes::_load($db,"('r')");
  }

  function prorrogadas($db) {
    return Notificacoes::_load($db, "('a','p')", "and tipo = 's' and ISNULL(propostas.confirmada)");
  }

  function desistencias($db) {
    return Notificacoes::prorrogadas($db);
  }

  function novas_aprovadas($db) {
    return Notificacoes::prorrogadas($db);
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

  function coordenadoresDeMesa($db) {
    $sql = "select distinct
              propostas.cod as cod,
              propostas.titulo as title,
              pessoas.cod as pcod,
              pessoas.nome as name,
              pessoas.email as email,
              propostas.idioma as language
            from
              propostas
              join grade on grade.proposta = propostas.cod
              join mesa on mesa.proposta = propostas.cod
              join pessoas on pessoas.cod = mesa.pessoa
    ";
    $rs = $db->conn->Execute($sql);
    return $rs->GetArray();

  }

}

?>
