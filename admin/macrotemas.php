<?

require 'Smarty.class.php';
$smarty = new Smarty;
$smarty->compile_check = true;

include('include/mysql.inc.php');
include('include/basic.inc.php');

expires(0);

$smarty->assign('title', 'Número de propostas por macro-tema');

$smarty->assign('user', $user);
$smarty->assign('linkup', '.');

$mysql = new Mysql;

$sql = "select * from macrotemas";

$rs = $mysql->conn->Execute($sql);
$smarty->assign('rs', $rs->GetArray());

$smarty->assign('central', 'macrotemas.tpl');

$smarty->display('index.tpl');
  
?>

