<?

require 'Smarty.class.php';
$smarty = new Smarty;
$smarty->compile_check = true;

include('include/mysql.inc.php');
include('include/basic.inc.php');

expires(0);

$num = str_replace('/', '', $_SERVER['PATH_INFO']);

$mysql = new Mysql;


if ($num != "") {
  $sql = "select * from horarios where numero = $num";
  $rs = $mysql->conn->Execute($sql);
  $smarty->assign('horario', $rs->fields);
  $smarty->assign('central', 'horario.tpl');
  $smarty->assign('linkup', 'horarios');
} else {
  $sql = 'select * from horarios order by numero';
  $rs = $mysql->conn->Execute($sql);
  $smarty->assign('rs', $rs->GetArray());
  $smarty->assign('central', 'listar_horarios.tpl');
  $smarty->assign('linkup', '.');
}

$smarty->display('index.tpl');

?>
