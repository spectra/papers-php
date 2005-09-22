<?

class Press {
  function load($db, $sql) {
    $rs = $db->conn->Execute($sql);
    return $rs->GetArray();
  }
  
  function loadUnmoderated($db) {
    return Press::load($db,"select * from press where moderado = 0");
  }

  function loadModerated($db) {
    return Press::load($db,"select * from press where moderado = 1");
  }
  
  function loadForNameTags($db) {
    return Press::load($db,"select * from press where moderado = 1 order by nome");
  }

  function loadForPublish($db) {
    return Press::load($db,"select distinct veiculo,cidade,pais, count(*) as num from press where moderado = 1 group by 1");
  }

  function moderate($db, $cod) {
    $db->conn->Execute("update press set moderado = 1 where cod = $cod");
  }
  
  function remove($db, $cod) {
    $db->conn->Execute("delete from press where cod = $cod");
  }

  function insert($db,$fields) {
    $rs = $db->conn->Execute('select nome,veiculo,cargo,registro_profissional,endereco_profissional,pais,estado,cidade,email from press where cod = -1');
    $sql = $db->conn->GetInsertSQL($rs, $fields,false,true);
    $db->conn->Execute($sql);
  }
}

?>
