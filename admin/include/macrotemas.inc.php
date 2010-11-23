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

  function adicionar($db, $titulo, $titulo_en, $descr, $descr_en, $espacos) {
    $rs = $db->conn->Execute('select titulo,titulo_en,descr,descr_en,espacos from macrotemas where cod = -1');

    $r['titulo'] = $titulo;
    $r['titulo_en'] = $titulo_en;
    $r['descr'] = $descr;
    $r['descr_en'] = $descr_en;
    $r['espacos'] = $espacos;
 
    $sql = $db->conn->GetInsertSQL($rs,$r);
    
    if (! $db->conn->Execute($sql)) {
      echo "Ocorreu um erro incluindo macrotema no banco.";
      exit;
    }
    header("Location: macrotemas");
  }
}
?>
