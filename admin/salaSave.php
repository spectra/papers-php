<?

  include('include/mysql.inc.php');
  include('include/basic.inc.php');

  expires(0);
  header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
  header('Content-Type: text/plain');

  $num = $_POST['numero'];

  $mysql = new Mysql;

  $rs = $mysql->conn->Execute("select * from salas where numero = $num");

  if ($rs->RecordCount() == 1) {
    // alterar
    $sql = $mysql->conn->GetUpdateSQL($rs, $_POST);
  } else {
    // novo
    $sql = $mysql->conn->GetInsertSQL($rs, $_POST);
  }

  $mysql->conn->Execute($sql);

  header('Location: salas');
  echo "ok";
  
?>
