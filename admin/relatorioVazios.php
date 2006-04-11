<?

require 'Smarty.class.php';
$smarty = new Smarty;
$smarty->compile_check = true;

include('include/mysql.inc.php');
include('include/basic.inc.php');
include('include/grade.inc.php');

expires(0);

$mysql = new Mysql;

$vazios = Grade::conflitos($mysql);

$smarty->assign('central', 'relatorioVazios.tpl');
$smarty->assign('vazios', $vazios);

$smarty->assign('linkup', '.');

$smarty->display('index.tpl');

?>
