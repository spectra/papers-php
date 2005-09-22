<?

class Macrotemas {
  function carregar($db) {
    $rs = $db->conn->Execute('select cod, titulo, espacos from macrotemas');
    return $rs->GetArray();
  }

  function encontrar($db, $cod) {
    $rs = $db->conn->Execute("select * from macrotemas where cod = $cod");
    $rsa = $rs->GetArray();
    return $rsa[0];
  }
}

?>
