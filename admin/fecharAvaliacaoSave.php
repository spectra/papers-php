<?

  include('include/mysql.inc.php');
  include('include/basic.inc.php');

  expires(0);
  header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
  header('Content-Type: text/plain');

  $mysql = new Mysql;

  foreach($_POST as $key => $val) {
    if (preg_match("/status([0-9]+)/", $key, $matches)) {
      $cod = $matches[1];
      $score = $_POST["score$cod"];
      $sql = "update propostas set status = '$val', score = $score where cod = $cod";
      $mysql->conn->Execute($sql);
    }
  }

  // voltar para a lista
  header("Location: fecharAvaliacao");

?>
