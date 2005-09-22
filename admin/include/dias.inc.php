<?

class Dias {
  function carregar($db) {
    $rs = $db->conn->Execute("select * from dias");
    return $rs->GetArray();
  }
}

?>
