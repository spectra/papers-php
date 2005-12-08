<?

  include('include/mysql.inc.php');
  include('include/basic.inc.php');

  expires(0);
  header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
  header('Content-Type: text/plain');

  $mysql = new Mysql;
 
  foreach($_POST as $key => $val) {
    if (preg_match("/avaliador_era_([0-9]+)/", $key, $matches)) {
      $cod = $matches[1];

      // deixando de ser avaliador
      if ($_POST["avaliador_era_$cod"] && !$_POST["avaliador_$cod"]) {
        $mysql->conn->Execute("delete from avaliador where pessoa = $cod");
      }

      // passando a ser avaliador
      if (!$_POST["avaliador_era_$cod"] && $_POST["avaliador_$cod"]) {
        $mysql->conn->Execute("insert into avaliador values($cod)");
      }
      
      // $mysql->conn->Execute($sql);
    }
  }
  
  // voltar para a lista de propostas para avaliar:
  header("Location: avaliadores");

?>
