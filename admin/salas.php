<?

require 'include/mysmarty.inc.php';
$smarty = new Smarty;
$smarty->compile_check = true;

include('include/mysql.inc.php');
include('include/basic.inc.php');

expires(0);

$num = str_replace('/', '', $_SERVER['PATH_INFO']);

$mysql = new Mysql;


if ($num != "") {
  $sql = "select * from salas where numero = $num";
  $rs = $mysql->conn->Execute($sql);
  $smarty->assign('sala', $rs->fields);
  $smarty->assign('central', 'sala.tpl');
  $smarty->assign('linkup', 'salas');
} else {
  $sql = 'select * from salas order by numero';
  $rs = $mysql->conn->Execute($sql);
  $smarty->assign('rs', $rs->GetArray());
  $smarty->assign('central', 'listar_salas.tpl');
  $smarty->assign('linkup', '.');
}

$smarty->display('index.tpl');

?>
