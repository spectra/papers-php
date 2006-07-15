<?

class Horarios {

  function carregar($db) {
    $rs = $db->conn->Execute("select numero, substring(inicio,1,5) as inicio, substring(final,1,5) as final from horarios order by numero");
    return $rs->GetArray();
  }

}

?>
