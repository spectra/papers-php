<?

  include('include/mysql.inc.php');
  include('include/basic.inc.php');

  expires(0);
  header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
  header('Content-Type: text/plain');

  $mysql = new Mysql;
 
  foreach($_POST as $key => $val) {
    if (preg_match("/espacos_([0-9]+)/", $key, $matches)) {
      $cod = $matches[1];
      $sql = "update macrotemas set espacos = $val where cod = $cod";
      $mysql->conn->Execute($sql);
    }
  }
  
  // voltar para a lista de propostas para avaliar:
  header("Location: macrotemas");

?>
