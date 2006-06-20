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
  $sql = "select * from dias where numero = $num";
  $rs = $mysql->conn->Execute($sql);
  $smarty->assign('dia', $rs->fields);
  $smarty->assign('central', 'dia.tpl');
  $smarty->assign('linkup', 'dias');
} else {
  $sql = 'select * from dias order by numero';
  $rs = $mysql->conn->Execute($sql);
  $smarty->assign('rs', $rs->GetArray());
  $smarty->assign('central', 'listar_dias.tpl');
  $smarty->assign('linkup', '.');
}

$smarty->display('index.tpl');

?>
