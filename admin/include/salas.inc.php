<?

class Salas {

  function carregar($db) {
    $rs = $db->conn->Execute("select * from salas");
    return $rs->GetArray();
  }

  function carregarNaoVazias($db) {
    $rs = $db->conn->Execute("select * from salas where exists (select 1 from grade where grade.sala = salas.numero)");
    return $rs->GetArray();
  }

}

?>
