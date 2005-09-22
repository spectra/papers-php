<?

class Salas {

  function carregar($db) {
    $rs = $db->conn->Execute("select * from salas");
    return $rs->GetArray();
  }

}

?>
